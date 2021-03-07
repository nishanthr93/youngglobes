<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddYgToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('dob')->after('avatar')->nullable();
            $table->string('designation')->after('dob')->nullable();
            $table->integer('gender')->after('designation')->nullable();
            $table->string('country')->after('gender')->nullable();
            $table->string('fav_color')->after('country')->nullable();
            $table->string('fav_actor')->after('fav_color')->nullable();
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
            $table->dropColumn('dob');
            $table->dropColumn('designation');
            $table->dropColumn('gender');
            $table->dropColumn('country');
            $table->dropColumn('fav_color');
            $table->dropColumn('fav_actor');
        });
    }
}
