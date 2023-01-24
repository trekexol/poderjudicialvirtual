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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_documento',2);
            $table->string('documento_identidad',25);
            $table->string('primer_nombre',50);
            $table->string('segundo_nombre',50);
            $table->string('primer_apellido',50)->nullable();
            $table->string('segundo_apellido',50)->nullable();

            $table->string('direccion',250);

            
            $table->string('estado',40)->default('Activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
