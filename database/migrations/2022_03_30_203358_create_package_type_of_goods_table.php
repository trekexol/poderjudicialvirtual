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
        Schema::create('package_type_of_goods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_package');
            $table->unsignedBigInteger('id_type_of_good');
           
            $table->decimal('unit',64,2);
            $table->string('description',100)->nullable();
            $table->decimal('value',64,2);
            $table->decimal('tariff',64,2);
            $table->decimal('charge',64,2);

            $table->foreign('id_package')->references('id')->on('packages');
            $table->foreign('id_type_of_good')->references('id')->on('type_of_goods');
            
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
        Schema::dropIfExists('package_type_of_goods');
    }
};
