<?php

namespace Database\Seeders;

use App\Models\Pais;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pais = new Pais;
        $pais->nombre =  'Alemania';
        $pais->clave = 'DE';
        $pais->encrypt_id                       = encrypt($pais->id);
        $pais->save();


        $pais = new Pais;
        $pais->nombre =  'España';
        $pais->clave = 'ES';
        $pais->encrypt_id                       = encrypt($pais->id);
        $pais->save();

        $pais = new Pais;
        $pais->nombre =  'Estados Unidos';
        $pais->clave = 'US';
        $pais->encrypt_id                       = encrypt($pais->id);
        $pais->save();

        $pais = new Pais;
        $pais->nombre =  'México';
        $pais->clave = 'MX';
        $pais->encrypt_id                       = encrypt($pais->id);
        $pais->save();
    }
}
