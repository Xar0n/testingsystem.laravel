<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result__questions', function (Blueprint $table) {
            $table->unsignedInteger('result_id');
            $table->unsignedInteger('question_id');
            $table->string('answer', 1000);
            $table->tinyInteger('flag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('result__questions');
    }
}
