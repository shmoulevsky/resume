<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_answers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('answer', 65535);
            $table->smallinteger('points');
            $table->smallinteger('sort');
            $table->boolean('is_active');
            $table->tinyInteger('number')->nullable();
            $table->foreignId('question_id')->references('id')->on('questions')->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('question_answers');
    }
}
