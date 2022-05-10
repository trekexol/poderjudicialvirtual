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
        Schema::create('tulas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_office_agency');
            $table->unsignedBigInteger('id_agent');
            $table->unsignedBigInteger('id_destination_state');

            $table->unsignedBigInteger('id_guide')->nullable();
           
            $table->decimal('dimension_width',64,2);
            $table->decimal('dimension_length',64,2);
            $table->decimal('dimension_high',64,2);
            $table->decimal('weight',64,2);
            $table->string('type_of_service',15);
            $table->string('loose_packages',3);
            $table->string('record',40);

            $table->decimal('cubic_foot',64,2);
            $table->decimal('volume',64,2);
            $table->decimal('loadable_weight',64,2);
            $table->string('class',10);
            $table->string('reference',50)->nullable();
            $table->integer('number_of_packages')->nullable();

            $table->string('status',20)->nullable();

            $table->foreign('id_office_agency')->references('id')->on('agencies');
            $table->foreign('id_agent')->references('id')->on('agents');
            $table->foreign('id_destination_state')->references('id')->on('states');
            $table->foreign('id_guide')->references('id')->on('guides');
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
        Schema::dropIfExists('tulas');
    }
};
