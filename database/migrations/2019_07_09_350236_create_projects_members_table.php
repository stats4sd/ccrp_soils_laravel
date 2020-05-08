<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('project_id');
            $table->bigInteger('user_id');
            $table->tinyInteger('admin')->default(0);
            $table->unique(['project_id', 'user_id']);
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
        Schema::dropIfExists('projects_members');
    }
}
