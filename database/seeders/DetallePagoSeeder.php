<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DetallePago;

class DetallePagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $detallePago = new DetallePago;
        $detallePago->id_usuario = 1;
        $detallePago->id_pago = 1;        
        $detallePago->encrypt_id                       = encrypt($detallePago->id);
        $detallePago->save();

        $detallePago = new DetallePago;
        $detallePago->id_usuario = 2;
        $detallePago->id_pago = 2;        
        $detallePago->encrypt_id                       = encrypt($detallePago->id);
        $detallePago->save();

        $detallePago = new DetallePago;
        $detallePago->id_usuario = 3;
        $detallePago->id_pago = 3;        
        $detallePago->encrypt_id                       = encrypt($detallePago->id);
        $detallePago->save();


    }
}
