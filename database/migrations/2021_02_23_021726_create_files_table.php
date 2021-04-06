<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            Schema::dropIfExists('files');
			$table->bigIncrements('id', true);
			$table->timestamps();
			$table->char('name');
			$table->char('original_name');
			$table->text('description', 65535);
			$table->string('url');
			$table->foreignId('company_id')->references('id')->on('companies')->onDelete('cascade')->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();
			$table->morphs('fileable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
