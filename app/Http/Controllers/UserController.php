<?php

namespace App\Http\Controllers;

use view;
use App\Models\User;
use App\Http\Requests\UserRequest;
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
        return view('users.create');
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
        $users = User::create([
            'name' => $request->name
        ]);

        return redirect('users/create')->with('status', 'role Created Successfully');
    }
}
