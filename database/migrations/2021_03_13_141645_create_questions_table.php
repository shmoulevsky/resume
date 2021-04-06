<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('question', 65535);
            $table->text('description', 65535)->nullable();
            $table->smallinteger('points');
            $table->smallinteger('sort');
            $table->tinyInteger('type');
            $table->boolean('is_active');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('questions');
    }
}
