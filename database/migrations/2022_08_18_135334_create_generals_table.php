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
        Schema::create('generals', function (Blueprint $table) {
            $table->id();
            $table->string('name',250);
            $table->string('legal_name',250);
            $table->string('direction',250);
            $table->string('direction2',250);
            $table->string('direction3',250);
            $table->string('phone',100);
            $table->string('contact',250);
            $table->string('email',250);
            $table->string('currency',20);
            
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
        Schema::dropIfExists('generals');
    }
};
