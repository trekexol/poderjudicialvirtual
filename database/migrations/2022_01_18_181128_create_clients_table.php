<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_country');
            $table->unsignedBigInteger('id_state_received');
            $table->unsignedBigInteger('id_agency');

            $table->unsignedBigInteger('id_code_room');
            $table->unsignedBigInteger('id_code_work');
            $table->unsignedBigInteger('id_code_mobile');
            $table->unsignedBigInteger('id_code_fax')->nullable();

            $table->string('type_cedula',2);
            $table->string('cedula',15);
            $table->string('firstname',30);
            $table->string('firstlastname',30);
            $table->string('secondname',30)->nullable();
            $table->string('secondlastname',30)->nullable();

            $table->string('direction',100);

            $table->string('street_received',100);
            $table->string('urbanization_received',100);

            $table->string('type_direction_received',15);

            $table->string('phone_room',20);
            $table->string('phone_work',20);
            $table->string('phone_mobile',20);
            $table->string('phone_fax',20)->nullable();

            $table->string('company',50)->nullable();
            $table->string('rif',20)->nullable();

            $table->foreign('id_country')->references('id')->on('countries');
            $table->foreign('id_state_received')->references('id')->on('states');
            $table->foreign('id_agency')->references('id')->on('agencies');
            
            $table->foreign('id_code_room')->references('id')->on('making_codes');
            $table->foreign('id_code_work')->references('id')->on('making_codes');
            $table->foreign('id_code_mobile')->references('id')->on('making_codes');
            $table->foreign('id_code_fax')->references('id')->on('making_codes');
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
        Schema::dropIfExists('clients');
    }
}
