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
        Schema::create('xlsforms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('file')->nullable();
            $table->string('default_language')->nullable();
            $table->dateTimeTz('version');
            $table->string('kobo_version_id')->nullable();
            $table->string('instance_name')->nullable();
            $table->string('link_page')->nullable();
            $table->text('description')->nullable();
            $table->text('media')->nullable();
            $table->json('content')->nullable();
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
