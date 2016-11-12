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
            $table->string('profile_image')->default('/images/default/profile.png');
            $table->string('name')->unique();
            $table->string('full_name')->nullable();
            $table->string('country_code')->nullable();
            $table->string('city')->nullable();
            $table->string('sex')->nullable();
            $table->string('status_message')->nullable();
            $table->integer('pocket_id')->nullable();
            $table->integer('position_id')->nullable();
            $table->integer('reffer_id')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('status')->default(2);
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
