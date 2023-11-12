<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');      
            $table->text('encrypt_id')->nullable();
            $table->string('primer_nombre',80);
            $table->string('segundo_nombre',80);
            $table->string('primer_apellido',80);
            $table->string('segundo_apellido',80);
            $table->string('id_trabajador',20)->unique();
            $table->text('password',100);
            $table->unsignedBigInteger('id_municipio');
            $table->unsignedBigInteger('id_institucion');
            $table->unsignedBigInteger('id_role');
            $table->integer('status')->default('1');
            $table->timestamps();

            $table->softDeletes();
            $table->foreign('id_municipio')->references('id')->on('municipios');
            $table->foreign('id_institucion')->references('id')->on('instituciones');
            $table->foreign('id_role')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
