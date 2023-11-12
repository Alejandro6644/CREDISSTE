<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role = new Role;
        $role->nombre = 'Administrador';
        $role->encrypt_id                       = encrypt($role->id);
        $role->save();

        $role = new Role;
        $role->nombre = 'Derechohabiente';
        $role->encrypt_id                       = encrypt($role->id);
        $role->save();

        $role = new Role;
        $role->nombre = 'Moderador';
        $role->encrypt_id                       = encrypt($role->id);
        $role->save();
    }
}
