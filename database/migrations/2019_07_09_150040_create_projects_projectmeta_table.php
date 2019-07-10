<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsProjectmetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects_projectmeta', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('group_id');
            $table->string('meta_key')->nullable();
            $table->longText('meta_value');
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
        Schema::dropIfExists('projects_projectmeta');
    }
}
