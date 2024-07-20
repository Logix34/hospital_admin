<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('first_name','100');
            $table->string('last_name','100')->nullable();
            $table->string('phone_no','20');
            $table->string('national_id','20');
            $table->integer('user_type');
            $table->string('address');
            $table->string('gender');
            $table->string('web_address')->nullable();
            $table->integer('is_logged_in')->default(0);
            $table->integer('is_delete')->default(0);
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
