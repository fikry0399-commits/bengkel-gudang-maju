<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('username', 'password');
        $remember = $request->boolean('remember');
        if (Auth::attempt($credentials, $remember)) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $user->load('role');
            if (is_null($user->email_verified_at)) {
                Auth::logout();
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Email belum diverifikasi. Silakan cek email Anda.'
                ], 403);
            }
            $request->session()->regenerate();
            $redirectUrl = '/';
            $roleName = $user->role?->role_name;
            if ($roleName === 'admin') {
                $redirectUrl = '/dashboard';
            } elseif ($roleName === 'murid') {
                $redirectUrl = '/home';
            }else if($roleName === 'pengajar'){
                $redirectUrl = '/dashboard';
            }
            return response()->json([
                'status'   => 'success',
                'message'  => 'berhasil login',
                'redirect' => $redirectUrl
            ], 200);
        }
        return response()->json([
            'status'  => 'error',
            'message' => 'Gagal Login username / password salah'
        ], 401);
    }
    

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json([
            'status'   => 'success',
            'message'  => 'Berhasil logout',
            'redirect' => url('/login')
        ], 200);
    }
    public function register()
    {
        return view('admin.register');
    }
    public function registerProses(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'agree'    => 'accepted'
        ]);
       $user = User::create([
            'name'       => $request->name,
            'username'   => $request->username,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role_id'    => 2
        ]);
        event(new Registered($user));
        return response()->json([
            'status'   => 'success',
            'message'  => 'Registrasi berhasil! Silakan check email untuk verifikasi akun.',
            'redirect' => '/register'
        ], 200);
    }

    public function forgotPassword()
    {
        return view('admin.forgot-password');
    }

public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $status = Password::broker()->sendResetLink(
            $request->only('email')
        );
        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'status'  => true,
                'message' => 'Link reset password berhasil dikirim ke email Anda.'
            ]);
        }
        return response()->json([
            'status'  => false,
            'message' => 'Kami tidak dapat menemukan pengguna dengan alamat email tersebut.'
        ], 400);
    }
    public function resetPasswordView(Request $request, string $token){
    return view('admin.reset-password', [
                'token' => $token,
                'email' => $request->email
            ]);
    }

public function resetPasswordProses(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        $status = Password::broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );
        if ($status == Password::PASSWORD_RESET) {
            return response()->json([
                'status' => true,
                'message' => 'Password berhasil diubah! Mengalihkan ke halaman login...'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => __($status) 
        ], 400);
    }
}
