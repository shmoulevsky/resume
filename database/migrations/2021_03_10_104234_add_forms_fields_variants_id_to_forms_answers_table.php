<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFormsFieldsVariantsIdToFormsAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forms_answers', function (Blueprint $table) {
            $table->unsignedBigInteger('forms_fields_variants_id')->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forms_answers', function (Blueprint $table) {
            $table->dropColumn('forms_fields_variants_id');
        });
    }
}
