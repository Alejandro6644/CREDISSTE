<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'primer_nombre' => 'Laura', 'segundo_nombre' => 'Jacqueline',
                'primer_apellido' => 'Orozco', 'segundo_apellido' => 'Ramirez',
                'id_trabajador' => '19280761', 'password' => 'pw2311'
            ],
            [
                'primer_nombre' => 'Juan', 'segundo_nombre' => 'Carlos',
                'primer_apellido' => 'Oloarte', 'segundo_apellido' => 'Limón',
                'id_trabajador' => '19280762', 'password' => 'pw2310'
            ],
            [
                'primer_nombre' => 'Daniel', 'segundo_nombre' => 'Eduardo',
                'primer_apellido' => 'Gonzalez', 'segundo_apellido' => 'Ramirez',
                'id_trabajador' => '16280763', 'password' => 'pw2312'
            ],
        ];

        foreach ($data as $item) {
            $user = new User;
            $user->primer_nombre = $item['primer_nombre'];
            $user->segundo_nombre = $item['segundo_nombre'];
            $user->primer_apellido = $item['primer_apellido'];
            $user->segundo_apellido =$item['segundo_apellido'];
            $user->id_trabajador = $item['id_trabajador'];
            $user->password = bcrypt($item['password']);
            $user->id_municipio = '4';
            $user->id_institucion = rand(1, 20);
            $user->id_role = 1;
            $user->encrypt_id                       = encrypt($user->id);
            $user->save();
        }
    }
}
