<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableResultQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('result__questions', function (Blueprint $table) {
			$table->foreign('result_id')->references('id')->on('results')->onDelete('cascade');
			$table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('result__questions', function (Blueprint $table) {
			$table->dropForeign('result__questions_result_id_foreign');
			$table->dropForeign('result__questions_question_id_foreign');
        });
    }
}
