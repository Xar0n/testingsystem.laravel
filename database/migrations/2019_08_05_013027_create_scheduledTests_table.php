<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduledTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduled__tests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('test_id');
            $table->unsignedInteger('group_id');
            $table->time('time');
            $table->dateTime('date_first');
            $table->dateTime('date_last');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scheduled__tests');
    }
}
