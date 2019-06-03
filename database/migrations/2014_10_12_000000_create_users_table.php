<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('name');
            $table->string('lastname');
            $table->string('avatar')->default('default.jpg'); 
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->date('birth')->nullable();
            $table->string('zip')->nullable();
            $table->string('city');
            $table->string('street')->nullable();
            $table->integer('phone')->default(0);
            $table->string('lat');
            $table->string('lon');
            $table->string('password')->nullable();
            $table->longText('bio')->nullable();
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
