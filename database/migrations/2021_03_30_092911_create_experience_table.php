<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience', function (Blueprint $table) {
            
            $table->id();
            $table->timestamps();
            $table->string('company_name',100);
            $table->string('position',50);
            $table->string('period',50);
            $table->text('description',50);
            $table->foreignId('resume_id')->references('id')->on('resume')->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('experience');
    }
}
