<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('timer');
            $table->text('questions', 65535);
            $table->smallinteger('points');
			$table->smallinteger('count');
			$table->smallinteger('count_right');
			$table->smallinteger('percent');
			$table->smallinteger('finished_by');
            $table->boolean('is_finished');
			$table->foreignId('company_id')->references('id')->on('companies')->onDelete('cascade')->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->foreignId('test_id')->references('id')->on('tests')->onDelete('cascade')->nullable();
            $table->foreignId('resume_id')->references('id')->on('resume')->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_results');
    }
}
