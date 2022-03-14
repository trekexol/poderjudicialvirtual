<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_city');
          
            $table->string('code',30);
            $table->string('name',50);
            $table->string('type',15)->default('no_comercial');
            $table->string('direction',150);
            $table->string('phone',20);
            $table->string('contact_person',50);
            $table->decimal('rate',64,2);
            $table->string('virtual_payment',15)->default('no');

            $table->foreign('id_city')->references('id')->on('cities');
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
        Schema::dropIfExists('agencies');
    }
}
