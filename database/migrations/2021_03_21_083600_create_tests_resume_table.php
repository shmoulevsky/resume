<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsResumeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests_resume', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 36);       
            $table->foreignId('test_id')->references('id')->on('tests')->onDelete('cascade');
            $table->foreignId('resume_id')->references('id')->on('resume')->onDelete('cascade');
            $table->foreignId('company_id')->references('id')->on('companies')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests_resume');
    }
}
