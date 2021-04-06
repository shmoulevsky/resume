<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResumeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resume', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('last_name');
            $table->string('name');
            $table->string('second_name');
            $table->integer('photo_id')->index()->nullable();
            $table->char('phone', 20);
            $table->char('email', 30);
            $table->text('description');
            $table->integer('points');
            $table->boolean('is_active');
            $table->integer('sort');
            $table->foreignId('form_id')->references('id')->on('forms')->onDelete('cascade')->nullable();
            $table->foreignId('company_id')->references('id')->on('companies')->onDelete('cascade')->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resume');
    }
}
