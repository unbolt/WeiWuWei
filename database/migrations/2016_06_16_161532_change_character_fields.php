<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCharacterFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Change the character_id field to character_name and add a character_server field
             $table->renameColumn('character_id', 'character_name');
             $table->string('character_server')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Reverse the changes
             $table->renameColumn('character_name', 'character_id');
             $table->dropColumn('character_server');
        });
    }
}
