<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsResultsAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests_results_answers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('answer');
            $table->smallinteger('points');
            $table->boolean('is_right');
            $table->boolean('is_answered');
            $table->foreignId('resume_id')->references('id')->on('resume')->onDelete('cascade')->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->foreignId('question_id')->references('id')->on('questions')->onDelete('cascade')->nullable();
            $table->foreignId('test_result_id')->references('id')->on('test_results')->onDelete('cascade')->nullable();
            $table->foreignId('test_id')->references('id')->on('tests')->onDelete('cascade')->nullable();
            $table->foreignId('company_id')->references('id')->on('companies')->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests_results_answers');
    }
}
