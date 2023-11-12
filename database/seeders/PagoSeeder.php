<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Pago;
use Faker\Factory as Faker;
use Carbon\Carbon;

class PagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = array();
        $faker = Faker::create();
        for ($i = 0; $i < 30; $i++) {
            $dia = (rand(1, 31));
            $dia = $dia < 10 ? '0' . $dia : $dia;
            $mes = (rand(1, 12));
            $mes = $mes < 10 ? '0' . $mes : $mes;

            $fecha = $dia . '-' . $mes . '-' . rand(2000, 2023);
            $fecha = strval($fecha);
            echo $fecha;
            $fecha = Carbon::parse($fecha);
            $sueldo = rand(1000, 10000);
            $descuento = rand(100, 2000);
            $identificador = $faker->unique()->regexify('[A-Za-z0-9]{6}');

            $item = array('fechaEmision' => $fecha, 'sueldoBruto' => $sueldo, 'descuentos' => $descuento
            , 'identificador' => $identificador);
            $data[] = $item;
        }

        foreach ($data as $item) {
            $pago = new Pago;
            $pago->identificador = $item['identificador'];
            $pago->fechaEmision =  $item['fechaEmision'];
            $pago->sueldoBruto = $item['sueldoBruto'];
            $pago->descuentos = $item['descuentos'];
            $pago->sueldoNeto = $item['sueldoBruto'] - $item['descuentos'];
            $pago->encrypt_id                       = encrypt($pago->id);
            $pago->save();
        }
    }
}
