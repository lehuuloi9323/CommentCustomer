<?php

namespace App\Http\Controllers;
use App\Models\role;
use App\Models\permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    public function list(Request $request){
        $roles = role::all();
        return view('role.list', compact('roles'));
    }

    public function add(Request $request){
        $permissions = permission::all()->groupBy(function ($permission){
            return explode('.', $permission->slug)[0];
        });
        return view('role.add',compact('permissions'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|max: 255|unique:roles',
            'description' => 'required'
        ],
        [
            'required' => ':attribute không được để trống',
            'unique' => 'Quyền đã được tồn tại trên hệ thống'
        ],
        [
            'name' => 'Tên vai trò',
            'description' => 'Mô tả'
        ]);

        // return $request->input('permission_id');
        $role = role::create([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        $role->permissions()->attach($request->input('permission_id'));
        return redirect()->route('role.list')->with('status', 'Thêm vai trò thành công !!');
    }

    public function edit(role $role) {
        // return $role;
        $permissions = permission::all()->groupBy(function ($permission){
            return explode('.', $permission->slug)[0];
        });
        return view('role.edit',compact('permissions', 'role'));
    }
    public function update(role $role, Request $request) {
        // return $permission_id;
        $request->validate([
            'name' => 'required|unique:roles,name,'.$role->id,
            'description' => 'required',
            'permission_id' => 'nullable|array',
            'permission_id*' => 'exists:permission,id'
        ]);

        $role->update([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
    ]);
    $role->permissions()->sync($request->input('permission_id'));

    return redirect()->route('role.list')->with('status', 'Cập nhật quyền thành công');
    }
    public function delete(role $role) {
        $role->delete();
        return redirect()->route('role.list')->with('status', 'Bạn đã xóa quyền thành công');
    }
}
