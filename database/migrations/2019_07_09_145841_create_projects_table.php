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
            $table->increments('id');
            $table->bigInteger('creator_id');
            $table->string('name', 100)->unique();
            $table->string('slug', 200);
            $table->longText('description');
            $table->string('status', 10)->default('public');
            $table->string('group_invitations')->default('all_members');
            $table->string('image');
            $table->softDeletes();
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
        Schema::dropIfExists('projects');
    }
}
