<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission; // Asegúrate de que esta línea esté presente

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Asegúrate de que todos los permisos estén creados aquí
        // Puedes crear permisos individuales o en masa, por ejemplo:
        Permission::create(['name' => 'edit articles', 'ngshnsdbnadhgf']);
        // ... crear otros permisos

        // Crear roles y asignar todos los permisos existentes
        $role = Role::create(['name' => 'Administrator']);
        $permissions = Permission::all(); // Obtener todos los permisos
        $role->syncPermissions($permissions); // Asignar todos los permisos al rol

        // Crear usuario
        $user = User::create([
            'name' => 'Javier',
            'last_name' => 'Mejia',
            'email' => 'javiermejia3112@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Jorge.31'),
            'state' => 'Activo',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Asignar rol de Administrator
        $user->assignRole('Administrator');
    }
}
