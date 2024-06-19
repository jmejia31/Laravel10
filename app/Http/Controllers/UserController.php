<?php

namespace App\Http\Controllers;

use view;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('users.index',[
            'users' => $users
        ]);
    }

    public function show()
    {
        $users = User::with('roles')->get();
        return view('users.view', compact('users'));

    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        $user = new User; // Crea una nueva instancia de User
        return view('users.create', [
            'roles' => $roles,
            'user' => $user // Pasa la instancia a la vista
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:20'],
            // esta funcion es para SELECCION DE ROLES UNICA
            'role' => ['required', 'string', 'exists:roles,name'],
            // Esta funcion es para una SELECCION MULTIPLE DE ROLES
            // 'roles' => ['required', 'array'],
            // 'roles.*' => ['required', 'string', 'exists:roles,name'],
            ]);
            $user = User::create([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            // esta funcion es para SELECCION DE ROLES UNICA
            $user->syncRoles([$request->role]);

            // Esta funcion es para una SELECCION MULTIPLE DE ROLES
            // $user->syncRoles($request->roles);
            return redirect('/users')->with('status', 'User Created Successfully with roles');
        }

    // En tu UserController ESTADO ACTIVO E INACTIVO
    // Añade esta FUNVION para establecer el estado por defecto a activo
    public function toggleUserStatus(User $user)
    {
        $user->state = !$user->state;
        $user->save();
        return back()->with('status', 'User status updated successfully');
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.edit',[
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(Request $request, User $user)
{
    // Validar los datos del formulario
    $request->validate([
        'name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
    ]);

    // Actualizar el usuario con los nuevos datos
    $user->update([
        'name' => $request->name,
        'last_name' => $request->last_name,
        'email' => $request->email,
    ]);

    // Redirigir al usuario con un mensaje de éxito
    return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente');
}


}
