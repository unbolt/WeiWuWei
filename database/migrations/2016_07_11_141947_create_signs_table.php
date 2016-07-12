<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signs', function (Blueprint $table) {

            $table->integer('user_id')->unsigned();
            $table->integer('raid_id')->unsigned();
            $table->boolean('accepted');
            $table->string('role');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('raid_id')->references('id')->on('raids');
            $table->index(['user_id', 'raid_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('signs');
    }
}
