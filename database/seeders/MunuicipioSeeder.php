<?php

namespace Database\Seeders;

use App\Models\Municipio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MunuicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $var[1]='Acambay';
        $var[2]='Acolman';
        $var[3]='Aculco';
        $var[4]='Almoloya de Alquisiras';
        $var[5]='Almoloya de Juárez';
        $var[6]='Almoloya del Río';
        $var[7]='Amanalco';
        $var[8]='Amatepec';
        $var[9]='Amecameca';
        $var[10]='Apaxco';
        $var[11]='Atenco';
        $var[12]='Atizapán';
        $var[13]='Atizapán de Zaragoza';
        $var[14]='Atlacomulco';
        $var[15]='Atlautla';
        $var[16]='Axapusco';
        $var[17]='Ayapango';
        $var[18]='Calimaya';
        $var[19]='Capulhuac';
        $var[20]='Coacalco de Berriozábal';
        $var[21]='Coatepec Harinas';
        $var[22]='Cocotitlán';
        $var[23]='Coyotepec';
        $var[24]='Cuautitlán';
        $var[25]='Chalco';
        $var[26]='Chapa de Mota';
        $var[27]='Chapultepec';
        $var[28]='Chiautla';
        $var[29]='Chicoloapan';
        $var[30]='Chiconcuac';
        $var[31]='Chimalhuacán';
        $var[32]='Donato Guerra';
        $var[33]='Ecatepec de Morelos';
        $var[34]='Ecatzingo';
        $var[35]='Huehuetoca';
        $var[36]='Hueypoxtla';
        $var[37]='Huixquilucan';
        $var[38]='Isidro Fabela';
        $var[39]='Ixtapaluca';
        $var[40]='Ixtapan de la Sal';
        $var[41]='Ixtapan del Oro';
        $var[42]='Ixtlahuaca';
        $var[43]='Xalatlaco';
        $var[44]='Jaltenco';
        $var[45]='Jilotepec';
        $var[46]='Jilotzingo';
        $var[47]='Jiquipilco';
        $var[48]='Jocotitlán';
        $var[49]='Joquicingo';
        $var[50]='Juchitepec';
        $var[51]='Lerma';
        $var[52]='Luvianos';
        $var[53]='Malinalco';
        $var[54]='Melchor Ocampo';
        $var[55]='Metepec';
        $var[56]='Mexicaltzingo';
        $var[57]='Morelos';
        $var[58]='Naucalpan de Juárez';
        $var[59]='Nezahualcóyotl';
        $var[60]='Nextlalpan';
        $var[61]='Nicolás Romero';
        $var[62]='Nopaltepec';
        $var[63]='Ocoyoacac';
        $var[64]='Ocuilan';
        $var[65]='El Oro';
        $var[66]='Otumba';
        $var[67]='Otzoloapan';
        $var[68]='Otzolotepec';
        $var[69]='Ozumba';
        $var[70]='Papalotla';
        $var[71]='La Paz';
        $var[72]='Polotitlán';
        $var[73]='Rayón';
        $var[74]='San Antonio la Isla';
        $var[75]='San Felipe del Progreso';
        $var[76]='San Martín de las Pirámides';
        $var[77]='San Mateo Atenco';
        $var[78]='San Simón de Guerrero';
        $var[79]='Santo Tomás';
        $var[80]='Soyaniquilpan de Juárez';
        $var[81]='Sultepec';
        $var[82]='Tecámac';
        $var[83]='Tejupilco';
        $var[84]='Temamatla';
        $var[85]='Temascalapa';
        $var[86]='Temascalcingo';
        $var[87]='Temascaltepec';
        $var[88]='Temoaya';
        $var[89]='Tenancingo';
        $var[90]='Tenango del Aire';
        $var[91]='Tenango del Valle';
        $var[92]='Teoloyucan';
        $var[93]='Teotihuacán';
        $var[94]='Tepetlaoxtoc';
        $var[95]='Tepetlixpa';
        $var[96]='Tepotzotlán';
        $var[97]='Tequixquiac';
        $var[98]='Texcaltitlán';
        $var[99]='Texcalyacac';
        $var[100]='Texcoco';
        $var[101]='Tezoyuca';
        $var[102]='Tianguistenco';
        $var[103]='Timilpan';
        $var[104]='Tlalmanalco';
        $var[105]='Tlalnepantla de Baz';
        $var[106]='Tlatlaya';
        $var[107]='Toluca';
        $var[108]='Tonanitla';
        $var[109]='Tonatico';
        $var[110]='Tultepec';
        $var[111]='Tultitlán';
        $var[112]='Valle de Bravo';
        $var[113]='Villa de Allende';
        $var[114]='Villa del Carbón';
        $var[115]='Villa Guerrero';
        $var[116]='Villa Victoria';
        $var[117]='Xonacatlán';
        $var[118]='Zacazonapan';
        $var[119]='Zacualpan';
        $var[120]='Zinacantepec';
        $var[121]='Zumpahuacán';
        $var[122]='Zumpango';
        for ( $i = 1 ; $i <= 122 ; $i++ ){
            $municipio = new Municipio;
            $municipio->nombre =  $var[$i];
            $municipio->id_estado = 15;     
            $municipio->encrypt_id                       = encrypt($municipio->id);       
            $municipio->save();
        }
    }
}
