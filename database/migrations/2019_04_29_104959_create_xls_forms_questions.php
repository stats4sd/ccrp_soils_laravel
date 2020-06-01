<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXlsFormsQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xls_forms_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->nullable();
            $table->string('name');
            $table->text('hint::english');
            $table->string('relevant')->nullable();
            $table->string('constraint')->nullable();
            $table->string('constraint_message::english')->nullable();
            $table->string('constraint_message::espanol')->nullable();
            $table->string('required')->nullable();
            $table->string('required_message::english')->nullable();
            $table->string('required_message::espanol')->nullable();
            $table->string('appearance')->nullable();
            $table->string('default')->nullable();
            $table->string('calculation')->nullable();
            $table->string('count')->nullable();
            $table->text('label::english')->nullable();
            $table->bigInteger('form_id')->nullable();
            $table->text('label::espanol')->nullable();
            $table->text('hint::espanol')->nullable();
            $table->text('label')->nullable();
            $table->text('hint')->nullable();

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
        Schema::dropIfExists('xls_forms_questions');
    }
}
