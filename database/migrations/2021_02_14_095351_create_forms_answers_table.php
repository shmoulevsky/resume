<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms_answers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('answer');
            $table->integer('points');
            $table->boolean('is_active');
            $table->integer('sort');
            $table->foreignId('resume_id')->references('id')->on('resume')->onDelete('cascade')->nullable();
            $table->foreignId('field_id')->references('id')->on('forms_fields')->onDelete('cascade')->nullable();
            $table->foreignId('form_id')->references('id')->on('forms')->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('forms_answers');
    }
}
