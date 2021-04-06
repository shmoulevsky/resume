<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsResultsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests_results_categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('questions_categories');
            $table->text('description', 65535);
            $table->foreignId('question_id')->references('id')->on('questions')->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('tests_results_categories');
    }
}
