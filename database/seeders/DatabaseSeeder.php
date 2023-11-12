<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // factory(User::class, 10)->create();
        $this->call(RoleSeeder::class);
        $this->call(PagoSeeder::class);
        $this->call(PaisSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(MunuicipioSeeder::class);
        $this->call(InstitucionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DocumentoSeeder::class);
        $this->call(SugerenciaSeeder::class);
        $this->call(NotificacionSeeder::class);
        $this->call(DetallePagoSeeder::class);

    }
}
