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
        Schema::create('pagos', function (Blueprint $table) {
            $table->bigIncrements('id');      
            $table->text('encrypt_id')->nullable();
            $table->string('identificador',10)->unique();
            $table->date('fechaEmision')->format('dd/mm/yyyy');         
            $table->decimal('sueldoBruto', 8, 2);
            $table->decimal('descuentos', 8, 2);
            $table->decimal('sueldoNeto', 8, 2);
            $table->integer('status')->default('1');
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
};
