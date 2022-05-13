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
            $table->unsignedBigInteger('id_office_agency');
            $table->unsignedBigInteger('id_airline');
            $table->unsignedBigInteger('id_carrier_agent');
            $table->unsignedBigInteger('id_transmitter_agent')->nullable();
            $table->unsignedBigInteger('id_consignee_agent')->nullable();
            $table->unsignedBigInteger('id_position_agent')->nullable();

            $table->string('reference',40)->nullable();
            $table->string('knowledge_number',40);
            
            $table->decimal('amount');
            $table->string('weight_unit',15);
            $table->decimal('net_weight');
            $table->decimal('loadable_weight');
            $table->boolean('contains_dangerous_goods');

            $table->string('destination_airport',100);

            $table->string('flight');
            $table->date('flight_date');

            $table->string('handing_information')->nullable();
            $table->string('nature_and_quanty_of_goods')->nullable();
            $table->string('extra_information')->nullable();
            $table->string('extra_information2')->nullable();

            $table->string('status',20);

            $table->foreign('id_agency')->references('id')->on('agencies');
            $table->foreign('id_airline')->references('id')->on('airlines');
            $table->foreign('id_carrier_agent')->references('id')->on('agents');
            $table->foreign('id_transmitter_agent')->references('id')->on('agents');
            $table->foreign('id_consignee_agent')->references('id')->on('agents');
            $table->foreign('id_position_agent')->references('id')->on('agents');
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
