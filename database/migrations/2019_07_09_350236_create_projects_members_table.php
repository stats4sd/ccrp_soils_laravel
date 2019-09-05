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
            $table->increments('id');
            $table->bigInteger('project_id');
            $table->bigInteger('user_id');
            $table->bigInteger('inviter_id');
            $table->tinyInteger('is_admin')->default(0);
            // $table->longText('comments')->nullable();
            $table->tinyInteger('is_confirmed')->default(0);
            $table->string('key_confirm');
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
