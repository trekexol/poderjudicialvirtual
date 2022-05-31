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
        Schema::create('consolidados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_package');

            $table->string('number_consolidado',100);

            $table->decimal('amount_total',64,2)->nullable();

            $table->string('status',20)->nullable();

            $table->foreign('id_package')->references('id')->on('packages'); 
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
        Schema::dropIfExists('consolidados');
    }
};
