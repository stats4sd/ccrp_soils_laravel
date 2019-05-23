<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXlsForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xls_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('form_title')->nullable();
            $table->string('form_id')->nullable();
            $table->string('default_language')->nullable();
            $table->dateTimeTz('version');
            $table->string('instance_name')->nullable();
            $table->string('link_page')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('xls_forms');
    }
}
