<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Route;


class roleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view role', ['only' => ['show']]);
        $this->middleware('permission:index role', ['only' => ['index']]);
        $this->middleware('permission:update role', ['only' => ['update','edit']]);  //addPermissionToRole =ES PARA AGREGAR PERMISSIONS A LA FUNTION
        $this->middleware('permission:create role', ['only' => ['create','store','addPermissionToRole','givePermissionToRole']]); //givePermissionToRole = PARA dar permiso para el rol
        $this->middleware('permission:delete role', ['only' => ['destroy']]);
        // $this->middleware('permission:addPermissionToRole role', ['only' => ['addPermissionToRole']]);
        // $this->middleware('permission:givePermissionToRole role', ['only' => ['givePermissionToRole']]);
    }

    // ----------========================================================================

    public function index()
    {
        $roles = role::all();
       //dd($roles);
        return view('role.index', [
            'roles' => $roles
        ]);
    }

        // ----------========================================================================

    public function show()
    {
        $roles = Role::all();
        return view('role.view', compact('roles'));
    }

        // ----------========================================================================

    public function create()
    {
        return view('role.create');
    }

        // ----------========================================================================

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ], [
                'name.unique' => 'Este Rol ya existe.'
            ]
        ]);

        try {$role = Role::create([
            'name' => $request->name,
        ]);

        $this->addToRouteGroup($role); // Llamar función para agregar al grupo de rutas

        return redirect('role/create')->with('status', 'role Created Successfully');
        // $this->addToRouteGroup($role); // Llamar función para agregar al grupo de rutas
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Error inesperado: ' . $e->getMessage()]);
        }
        }

        protected function addToRouteGroup($role)
        {
        $roleName = strtolower($role->name);

        Route::group(['middleware' => ['auth', "role:$roleName"]], function () {
            // Aquí puedes definir las rutas específicas para este nuevo rol si lo deseas
        });
    }

        // ----------========================================================================

    public function edit(role $role)
    {
        return view('role.edit', [
            'role' => $role
        ]);
    }

        // ----------========================================================================

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

        // ----------========================================================================

    public function destroy($roleId)
    {
        //dd($id);
        $role = role::find($roleId);
        $role->delete();
        return redirect('role')->with('status', 'role Deleted Successfully');
    }

        // ----------========================================================================

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

        // ----------========================================================================

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
