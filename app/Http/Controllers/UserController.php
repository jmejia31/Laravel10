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
    public function __construct()
    {
        $this->middleware('permission:view user', ['only' => ['show']]);
        $this->middleware('permission:index user', ['only' => ['index']]);
        $this->middleware('permission:update user', ['only' => ['update','edit']]);
        $this->middleware('permission:create user', ['only' => ['create','store']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
        $this->middleware('permission:toggleUserStatus user', ['only' => ['toggleUserStatus']]);
    }

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
            ]);
            $user = User::create([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            // esta funcion es para SELECCION DE ROLES UNICA
            $user->syncRoles([$request->role]);
            return redirect()->route('users.view')->with('status', 'User Created Successfully with roles');
        }

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
            'role' => 'required|string|exists:roles,name', // Asegúrate de que el rol exista
            'state' => 'required|string|in:Activo,Inactivo', // Asegúrate de que el estado sea válido
        ]);
        // Actualizar el usuario con los nuevos datos
        $user->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'state' => $request->state, // Agregar esta línea para actualizar el estado
        ]);
        // Actualizar el rol del usuario si es necesario
        if ($request->role !== $user->getRoleNames()->first()) {
            $user->syncRoles($request->role);
        }
        // Redirigir al usuario con un mensaje de éxito
        return redirect()->route('users.edit', ['user' => $user->id])->with('status', 'User Updated Successfully');

    }

    public function destroy($userId)
    {
        //dd($id);
        $user = User::find($userId);
        $user->delete();
        return redirect()->route('users.index')->with('status', 'User Deleted Successfully');

    }
}
