<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Javier',
            'last_name' => 'Mejia',
            'email' => 'javiermejia3112@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Jorge.31'),
            'state' => 'Activo', // Asegúrate de que el valor sea un string
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
