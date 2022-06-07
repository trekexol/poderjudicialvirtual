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
            $table->unsignedBigInteger('id_wharehouse_origin');
            $table->unsignedBigInteger('id_wharehouse_destiny');
            $table->unsignedBigInteger('id_destination_state');

            $table->unsignedBigInteger('id_master_guide')->nullable();
           
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

            $table->foreign('id_wharehouse_origin')->references('id')->on('wharehouses');
            $table->foreign('id_wharehouse_destiny')->references('id')->on('wharehouses');
            $table->foreign('id_destination_state')->references('id')->on('states');
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
        Schema::dropIfExists('tulas');
    }
};
