<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNationalRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('national_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_wharehouse_origin')->nullable();
            $table->unsignedBigInteger('id_wharehouse_destination')->nullable();

            $table->string('weight_type',10);
            $table->decimal('minimum_weight',64,10);
            $table->decimal('maximum_weight',64,10);
            $table->decimal('price',64,10);
            $table->decimal('rate',64,10);

            $table->string('status',40)->nullable();

            $table->foreign('id_wharehouse_origin')->references('id')->on('wharehouses');
            $table->foreign('id_wharehouse_destination')->references('id')->on('wharehouses');
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
        Schema::dropIfExists('national_rates');
    }
}
