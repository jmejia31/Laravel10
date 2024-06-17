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
        $users = User::all();
        return view('users.index',[
            'users' => $users
        ]);
    }

    public function show()
    {
        $users = User::all();
        return view('users.view',[
            'users' => $users
        ]);
    }

    // public function index()
    // {
    //     $users = User::with('roles')->get();
    //     return view('roles-permisos.user.index',[
    //         'users' => $users
    //     ]);
    // }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create', [
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:20'],
            'roles' => ['required', 'array'],
            'roles.*' => ['required', 'string', 'exists:roles,name'],
            ]);
            $user = User::create([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $user->syncRoles($request->roles);

            return redirect('/users')->with('status', 'User Created Successfully with roles');
        }
}
