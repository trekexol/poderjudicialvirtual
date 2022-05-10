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
        Schema::create('master_guides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_agency');
            $table->unsignedBigInteger('id_airline');
            $table->unsignedBigInteger('id_carrier');
            $table->unsignedBigInteger('id_transmitter_agent')->nullable();
            $table->unsignedBigInteger('id_airline_destiny');
            $table->unsignedBigInteger('id_consignee_agent')->nullable();

            $table->string('reference');
            $table->string('knowledge_number');
            
            $table->decimal('amount');
            $table->string('weight_unit');
            $table->decimal('net_weight');
            $table->decimal('loadable_weight');
            $table->boolean('contains_dangerous_goods');


            $table->foreign('id_agency')->references('id')->on('agencies');
            $table->foreign('id_airline')->references('id')->on('airlines');
            $table->foreign('id_carrier')->references('id')->on('carriers');
            $table->foreign('id_transmitter_agent')->references('id')->on('agents');
            $table->foreign('id_airline_destiny')->references('id')->on('airlines');
            $table->foreign('id_consignee_agent')->references('id')->on('agents');
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
        Schema::dropIfExists('master_guides');
    }
};
