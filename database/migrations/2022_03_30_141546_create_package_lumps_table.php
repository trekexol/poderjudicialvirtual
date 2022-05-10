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
        Schema::create('package_lumps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_package');
            $table->unsignedBigInteger('id_type_of_packaging');
           
            $table->decimal('amount',64,2);
            $table->decimal('bulk_weight',64,2);
            $table->decimal('length_weight',64,2);
            $table->decimal('width_weight',64,2);
            $table->decimal('high_weight',64,2);
            $table->string('description',100)->nullable();

            $table->string('status',20)->nullable();
            
            $table->foreign('id_package')->references('id')->on('packages');
            $table->foreign('id_type_of_packaging')->references('id')->on('type_of_packagings');
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
        Schema::dropIfExists('package_lumps');
    }
};
