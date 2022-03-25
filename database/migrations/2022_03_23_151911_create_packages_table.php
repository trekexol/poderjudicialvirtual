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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_agent_shipper');
            $table->unsignedBigInteger('id_agent_vendor');
            $table->unsignedBigInteger('id_client');
            $table->unsignedBigInteger('id_agent_office_location');
            $table->unsignedBigInteger('id_agency');

            $table->string('tracking',250);
            $table->date('arrival_date');
            $table->string('description',100);
            
            $table->foreign('id_agent_shipper')->references('id')->on('agents');
            $table->foreign('id_agent_vendor')->references('id')->on('agents');
            $table->foreign('id_client')->references('id')->on('clients');
            $table->foreign('id_agent_office_location')->references('id')->on('agents');
            $table->foreign('id_agency')->references('id')->on('agencies');
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
        Schema::dropIfExists('packages');
    }
};
