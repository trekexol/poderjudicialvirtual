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
        Schema::create('client_recipients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_client');
            $table->unsignedBigInteger('id_country');

            $table->string('email',100);
            $table->string('name',50);
            $table->string('identification_card',20);
            $table->string('direction1',100);
            $table->string('direction2',100)->nullable();
            $table->string('phone',20);
            $table->string('observation',100)->nullable();

            $table->string('status',40)->nullable();

            $table->foreign('id_client')->references('id')->on('clients');
            $table->foreign('id_country')->references('id')->on('countries');
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
        Schema::dropIfExists('client_recipients');
    }
};
