<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        return view('profile-users', compact('user'));
    }
    public function profilAdmin()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        return view('admin.users.profile-admin', compact('user'));
    }

public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Simpan data
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Profil berhasil diperbarui.'
        ]);
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
            ]);
            
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($request->hasFile('image')) {
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            $imagePath = $request->file('image')->store('profile_images', 'public');
            
            // Simpan path-nya ke database
            $user->image = $imagePath;
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Foto profil berhasil diperbarui.',
                'image_url' => asset('storage/' . $imagePath)
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'Gagal mengunggah foto'], 400);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed', // otomatis ngecek field new_password_confirmation
        ]);
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'errors' => ['current_password' => ['Password saat ini yang Anda masukkan salah.']]
            ], 422);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password berhasil diubah.'
        ]);
    }
}
