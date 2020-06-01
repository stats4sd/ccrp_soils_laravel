<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('projects', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('creator_id');
            $table->string('name')->unique();
            $table->string('slug');
            $table->longText('description');
            $table->string('avatar')->default("/images/mystery-group.png");
            $table->boolean('share_data');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
