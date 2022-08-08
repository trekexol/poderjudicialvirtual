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
        Schema::create('client_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_client');
            $table->unsignedBigInteger('id_bank');

            $table->date('date');  
            $table->string('type',25);  
            $table->string('transferred_from',100);
            $table->string('confirmation',30);
            $table->decimal('amount',64,10);
            $table->string('observation',100)->nullable();

            $table->string('status',40)->nullable();

            $table->foreign('id_client')->references('id')->on('clients');
            $table->foreign('id_bank')->references('id')->on('banks');
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
        Schema::dropIfExists('client_payments');
    }
};
