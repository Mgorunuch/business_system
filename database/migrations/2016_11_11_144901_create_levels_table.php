<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


class CreateLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('full')->default(0);
            $table->integer('users_count')->default(0);
            $table->integer('last_empty')->default(1);
            $table->integer('max_users')->default(0);
            $table->timestamps();
        });

        $statement = "ALTER TABLE levels AUTO_INCREMENT = 0;";
        DB::unprepared($statement);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('levels');
    }
}
