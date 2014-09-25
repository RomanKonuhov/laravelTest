<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function($table) {
            $table->increments('id');
            $table->string('title')->nullable()->default('');
            $table->string('description')->nullable()->default('');
            $table->string('email')->nullable()->default('');
            $table->string('user_id');
            $table->tinyInteger('state')->default(Job::STATE_PENDING);
            $table->timestamps();

            $table->index('user_id');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jobs');
    }

}
