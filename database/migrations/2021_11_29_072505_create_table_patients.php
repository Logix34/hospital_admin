<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePatients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_patients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('doctor_id');
            $table->string('first_name','100');
            $table->string('last_name','100')->nullable();
            $table->string('phone_number','20');
            $table->string('address');
            $table->string('admit_status');
            $table->integer('age');
            $table->string('gender');
            $table->string('disease');
            $table->integer('weight');
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
        Schema::dropIfExists('table_patients');
    }
}
