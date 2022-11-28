<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Role $role */
        $role = Role::where('identifier', Role::ADMIN)->first();

        User::create([
            'name' => 'O Administrador',
            'email' => env('ADMIN_EMAIL', 'adm@adm.com.br'),
            'password' => Hash::make(env('ADMIN_PASSWD', '12345678')),
            'cpf' => '00000000000',
            'role_id' => $role->id,
        ]);
    }
}
