<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXlsFormsChoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xls_forms_choices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('list_name')->nullable();
            $table->string('name')->nullable();
            $table->text('label::english');
            $table->text('label::espanol');
            $table->bigInteger('form_id')->nullable();
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
        Schema::dropIfExists('xls_forms_choices');
    }
}
