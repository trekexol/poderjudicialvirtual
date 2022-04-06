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
        Schema::create('type_of_goods', function (Blueprint $table) {
            $table->id();
            $table->string('code',30);
            $table->string('description',100);
            $table->decimal('tariff_rate',64,10)->default(0);
            $table->decimal('tax_percentage',64,10)->default(0);
            $table->decimal('additional_charge',64,10)->default(0);
            
            $table->string('status',40)->nullable();
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
        Schema::dropIfExists('type_of_goods');
    }
};
