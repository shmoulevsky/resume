<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusIdToResumeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resume', function (Blueprint $table) {
            $table->foreignId('resume_status_id')->references('id')->on('resume_statuses')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resume', function (Blueprint $table) {
            $table->dropForeign('resume_resume_status_id_foreign');
            $table->dropColumn('resume_status_id');
        });
    }
}
