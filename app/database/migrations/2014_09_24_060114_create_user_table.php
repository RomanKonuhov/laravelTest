<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Support\Facades\Cache;

class CreateUserTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function($table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('name');
            $table->string('password', 64)->nullable();
            $table->rememberToken()->nullable();
            $table->tinyInteger('role')->default(User::ROLE_USER);
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
        Schema::drop('users');
    }

}
