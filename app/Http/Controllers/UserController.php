<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Notifications\AdminCreateUserNotification;
class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.user-view');
    }

    public function add()
    {
        return view('admin.users.user-add');
    }

    public function edit($id)
    {
        return view('admin.users.user-edit');
    }

    public function detail($id)
    {
        return view('admin.users.user-detail');
    }

    public function getUsers()
    {
         $users = User::with('role')->latest()->get();
         return response()->json($users);
    }

    public function getUser(int $id)
    {
         $user = User::with('role')->findOrFail($id);
        return response()->json([
            'id'       => $user->id,
            'name'     => $user->name,
            'username' => $user->username,
            'email'    => $user->email,
            'role'     => $user->role,
            'image_url' => $user->image
    ? asset('storage/' . $user->image)
    : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random',
        ]);
    }

    public function update(Request $request, int $id)
    {
            $user = User::findOrFail($id);
            $request->validate([
                'name'     => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username,' . $id,
                'email'    => 'required|email|unique:users,email,' . $id,
                'role_id'  => 'required|exists:roles,id',
                'image'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);
            DB::beginTransaction();
            try{
                if($request->hasFile('image')){
                    if($user->image && Storage::disk('public')->exists($user->image)){
                        Storage::disk('public')->delete($user->image);
                    }
                    $imagePath = $request->file('image')->store('users', 'public');
                    $user->image = $imagePath;
                }
            $user->update([
                'name'     => $request->name,
                'username' => $request->username,
                'email'    => $request->email,
                'role_id'  => $request->role_id,
            ]);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Update data sucessfully'
            ]);
        }catch(\Exception $e){
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => 'Update data failed',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'username'  => 'required|string|max:255|unique:users,username',
            'email'     => 'required|email|unique:users,email',
            'role_id'   => 'required|exists:roles,id',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        DB::beginTransaction();
        try{
            $defaultPassword = Str::random(12);
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('users', 'public');
            }
          $user = User::create([
                'name'                  => $request->name,
                'username'              => $request->username,
                'email'                 => $request->email,
                'role_id'               => $request->role_id,
                'password'              => Hash::make($defaultPassword),
                'image'                 => $imagePath,
                'force_change_password' => true,
            ]);
            $user->notify(new AdminCreateUserNotification($defaultPassword));
            DB::commit();
            return response()->json([
                'status'  => true,
                'message' => 'Create data sucessfully'
            ], 201);
        }catch (\Exception $e) {
            DB::rollBack();
        return response()->json([
            'status'  => false,
            'message' => 'Gagal membuat user',
            'error'   => $e->getMessage()
        ], 500);
        }
    }

    public function destroy(int $id)
    {
        $user = User::findOrFail($id);
        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }
        $user->delete();
        return response()->json([
            'message' => 'Data deleted Successfully'
        ]);
    }

    public function changePasswordByAdmin(Request $request, int $id)
    {
        $request->validate(['new_password' => 'required|min:8|confirmed']); 
        $user = User::findOrFail($id);
        $user->password = Hash::make($request->new_password);
        $user->save();
        
        return response()->json(['status' => 'success', 'message' => 'Password user berhasil direset.']);
    }
}
