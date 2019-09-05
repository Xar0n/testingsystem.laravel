<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableScheduledTests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scheduled__tests', function (Blueprint $table) {
			$table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
			$table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scheduled__tests', function (Blueprint $table) {
			$table->dropForeign('scheduled__tests_test_id_foreign');
			$table->dropForeign('scheduled__tests_group_id_foreign');
        });
    }
}
