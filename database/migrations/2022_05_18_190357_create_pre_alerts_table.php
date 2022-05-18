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
        Schema::create('pre_alerts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_client');

            $table->string('tracking',100);
            $table->string('shipping_type',15);

            $table->string('origin_web',250);
            $table->string('transport_company',250);
            $table->string('package_content',250);
            $table->string('package_remarks',250);
          
            
            $table->string('status',20)->nullable();

            $table->foreign('id_client')->references('id')->on('clients'); 
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
        Schema::dropIfExists('pre_alerts');
    }
};
