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
        Schema::create('package_charges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_package');

            $table->string('concept',100);
            $table->decimal('amount',64,10);

            $table->foreign('id_package')->references('id')->on('packages');
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
        Schema::dropIfExists('package_charges');
    }
};
