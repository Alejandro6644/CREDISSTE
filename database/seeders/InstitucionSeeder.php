<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Institucion;


class InstitucionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            ['nombre' => 'Secretaría de Salud'],
            ['nombre' => 'Instituto Mexicano del Seguro Social'],
            ['nombre' => 'Instituto de Seguridad y Servicios Sociales de los Trabajadores del Estado'],
            ['nombre' => 'Instituto de Seguridad Social para las Fuerzas Armadas Mexicanas'],
            ['nombre' => 'Instituto Nacional de Salud Pública'],
            ['nombre' => 'Comisión Federal para la Protección contra Riesgos Sanitarios'],
            ['nombre' => 'Centro Nacional de la Transfusión Sanguínea'],
            ['nombre' => 'Centro Nacional para la Prevención y el Control del VIH/SIDA'],
            ['nombre' => 'Instituto Nacional de Cancerología'],
            ['nombre' => 'Instituto Nacional de Pediatría'],
            ['nombre' => 'Instituto Nacional de Neurología y Neurocirugía'],
            ['nombre' => 'Instituto Nacional de Cardiología Ignacio Chávez'],
            ['nombre' => 'Instituto Nacional de Geriatría'],
            ['nombre' => 'Hospital General de México'],
            ['nombre' => 'Hospital Infantil de México Federico Gómez'],
            ['nombre' => 'Hospital Juárez de México'],
            ['nombre' => 'Hospital Nacional Homeopático'],
            ['nombre' => 'Hospital Psiquiátrico Infantil Juan N. Navarro'],
            ['nombre' => 'Hospital Psiquiátrico Fray Bernardino Álvarez'],
            ['nombre' => 'Instituto Nacional de Rehabilitación Luis Guillermo Ibarra Ibarra']
        ];

        foreach ($data as $item) {
            $institucion = new Institucion;
            $institucion->nombre =  $item['nombre'];
            $institucion->id_estado = rand(1, 15);     
            $institucion->encrypt_id                       = encrypt($institucion->id);       
            $institucion->save();
        }
    }
}
