<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAdmitPatients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_admit_patients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id');
            $table->integer('patient_id');
            $table->dateTime('admit_date');
            $table->dateTime('discharge_date');
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
        Schema::dropIfExists('table_admit_patients');
    }
}
