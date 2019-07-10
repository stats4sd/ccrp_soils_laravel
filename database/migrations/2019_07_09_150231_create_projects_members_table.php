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
            $table->bigInteger('group_id');
            $table->bigInteger('user_id');
            $table->bigInteger('inviter_id');
            $table->tinyInteger('is_admin')->default(0);
            $table->tinyInteger('is_mod')->default(0);
            $table->string('user_title');
            $table->dateTime('date_modified');
            $table->longText('comments');
            $table->tinyInteger('is_confirmed')->default(0);
            $table->tinyInteger('is_banned')->default(0);
            $table->tinyInteger('invite_sent')->default(0);
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
