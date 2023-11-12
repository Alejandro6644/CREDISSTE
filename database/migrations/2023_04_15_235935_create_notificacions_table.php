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
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->bigIncrements('id');      
            $table->text('encrypt_id')->nullable();
            $table->string('nombre',80);
            $table->timestamp('fecha');                      
            $table->string('contenido',300);
            $table->string('nombre_archivo',80);
            $table->binary('archivo');        
            $table->integer('status')->default('1');
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->timestamps();

            $table->softDeletes();
            $table->foreign('id_usuario')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notificacions');
    }
};
