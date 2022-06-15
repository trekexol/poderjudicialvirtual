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
        Schema::create('historial_status', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_package')->nullable();
            $table->unsignedBigInteger('id_paddle')->nullable();
            $table->unsignedBigInteger('id_master_guide')->nullable();

            $table->string('description_status',250);

            $table->string('status',100);

            $table->string('number_guide_transport',100)->nullable();

            $table->foreign('id_package')->references('id')->on('packages'); 
            $table->foreign('id_paddle')->references('id')->on('paddles'); 
            $table->foreign('id_master_guide')->references('id')->on('master_guides'); 
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
        Schema::dropIfExists('historial_status');
    }
};
