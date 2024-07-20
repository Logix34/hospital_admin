<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDoctors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name','100');
            $table->string('last_name','100')->nullable();
            $table->string('gender');
            $table->integer('experience')->nullable();
            $table->string('phone_no','20');
            $table->string('email');
            $table->string('national_id','20');
            $table->string('age');
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
        Schema::dropIfExists('table_doctors');
    }
}
