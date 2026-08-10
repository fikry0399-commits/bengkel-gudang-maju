<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.role.role-view');
    }

    public function getRoles(){
         $roles = Role::latest()->get();
         return response()->json($roles);
    }

    public function getRole($id)
    {
        $role = Role::find($id);
        return response()->json($role);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_name' => 'required|unique:roles,role_name',
        ]);

        if ($validator->fails()) {
           return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        Role::create([
            'role_name' => $request->role_name,
            'description' => $request->description
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Role berhasil ditambahkan'
        ]);
    }

  public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_name' => 'required|unique:roles,role_name,' . $request->id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ]);
        }

        Role::findOrFail($request->id)->update([
            'role_name' => $request->role_name,
            'description' => $request->description
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Role berhasil diperbarui'
        ]);
    }

    public function destroy($id)
    {
        Role::findOrFail($id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Role berhasil dihapus'
        ]);
    }

}
