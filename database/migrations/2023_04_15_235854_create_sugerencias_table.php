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
        Schema::create('sugerencias', function (Blueprint $table) {
            $table->bigIncrements('id');      
            $table->text('encrypt_id')->nullable();
            $table->string('contenido',200);
            $table->timestamp('fecha');       
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
        Schema::dropIfExists('sugerencias');
    }
};
