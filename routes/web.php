<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\HistoriTrukController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('index');
// });
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register-proses', [AuthController::class, 'registerProses']);
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login/proses', [AuthController::class, 'authenticate'])->name('login.proses');
    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordView'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPasswordProses'])->name('password.update');
    
});
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profil', [ProfileController::class, 'index'])->name('profil.index');
    Route::get('/profil-admin', [ProfileController::class, 'profilAdmin'])->name('profil.admin');
    Route::post('/profil/update-image', [ProfileController::class, 'updateImage'])->name('profil.update-image');
    Route::post('/profil/update', [ProfileController::class, 'update'])->name('profil.update');
    Route::post('/profil/update-password', [ProfileController::class, 'updatePassword'])->name('profil.update-password');
    Route::resource('kriteria', KriteriaController::class);
    Route::resource('alternatif', AlternatifController::class);
    Route::resource('histori-truk', HistoriTrukController::class);
    Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
    Route::post('/penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');
    Route::match(['get', 'post'], '/penilaian/hitung', [PenilaianController::class, 'hitung'])->name('penilaian.hitung');
    Route::get('/penilaian/hasil', [PenilaianController::class, 'hasil'])->name('penilaian.hasil');
    Route::get('/penilaian/cetak', [PenilaianController::class, 'cetak'])->name('penilaian.cetak');
});
Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
    $user = User::findOrFail($id);
    if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        abort(403, 'Link verifikasi tidak valid atau sudah rusak.');
    }
    if ($user->hasVerifiedEmail()) {
        return redirect('/login')->with('success', 'Email sudah diverifikasi sebelumnya. Silakan login.');
    }
    if ($user->markEmailAsVerified()) {
        event(new Verified($user));
    }
    return redirect('/login')->with('success', 'Email berhasil diverifikasi! Silakan login.');
    
})->middleware(['signed'])->name('verification.verify');
Route::middleware(['auth', 'checkRole:admin'])->group(function () {
    // DASHBOARD
    Route::get('/role', [RoleController::class, 'index']);
    Route::get('/roles', [RoleController::class, 'getRoles']);
    Route::get('/roles/{id}', [RoleController::class, 'getRole']);
    Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');
    Route::post('/roles/update', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    // USER MANAGEMENT
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/users', [UserController::class, 'getUsers']);
    Route::get('/users-edit/{id}', [UserController::class, 'edit']);
    Route::get('/users-detail/{id}', [UserController::class, 'detail']);
    Route::get('/users/{id}', [UserController::class, 'getUser']);
    Route::get('/user-add', [UserController::class, 'add']);
    Route::put('/users/{id}/change-password', [UserController::class, 'changePasswordByAdmin']);
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});
Route::middleware(['auth', 'checkRole:admin,user'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index']);
});
Route::middleware(['auth', 'checkRole:admin,user'])->group(function () {
 
});

Route::middleware(['auth', 'checkRole:admin,user'])->group(function () {
    // CATEGORY
     Route::get('/category', [CategoryController::class, 'index']);
});
