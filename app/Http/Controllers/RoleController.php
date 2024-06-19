<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class roleController extends Controller
{

    public function index()
    {
        $roles = role::all();
       //dd($roles);
        return view('role.index', [
            'roles' => $roles
        ]);
    }

    public function show()
    {
        $roles = Role::all();
        return view('role.view', compact('roles'));
    }

    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);
        $role = Role::create([
            'name' => $request->name
        ]);

        return redirect('role/create')->with('status', 'role Created Successfully');
    }

    public function edit(role $role)
    {
        return view('role.edit', [
            'role' => $role
        ]);
    }

    public function update(Request $request, role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,'.$role->id
            ]
        ]);

        $role->update([
            'name' => $request->name
        ]);

        return redirect('role')->with('status', 'role Updated Successfully');
    }

    public function destroy($roleId)
    {
        //dd($id);
        $role = role::find($roleId);
        $role->delete();
        return redirect('role')->with('status', 'role Deleted Successfully');
    }

    public function addPermissionToRole($roleId)
    {
        $permissions  = Permission::all();
        $role = role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id', $role->id)
                                ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                                ->all();

        return view('role.add-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function givePermissionToRole(Request $request, $roleId)
    {
        $request->validate([
        'permission' => 'required'
        ]);
        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);
        return redirect()->back()->with('status','Permissions added to role');
    }
}
