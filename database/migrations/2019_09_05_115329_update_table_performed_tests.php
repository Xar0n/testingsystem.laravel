<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTablePerformedTests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('performed__tests', function (Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('scheduled_test_id')->references('id')->on('scheduled__tests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('performed__tests', function (Blueprint $table) {
            $table->dropForeign('performed__tests_user_id_foreign');
            $table->dropForeign('performed__tests_scheduled_test_id_foreign');
        });
    }
}
