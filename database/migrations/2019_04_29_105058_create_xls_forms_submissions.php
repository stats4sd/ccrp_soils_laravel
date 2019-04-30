<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXlsFormsSubmissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xls_forms_submissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('record_data');
            $table->bigInteger('form_kobo_id')->nullable();
            $table->string('uuid')->nullable();
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
        Schema::dropIfExists('xls_forms_submissions');
    }
}
