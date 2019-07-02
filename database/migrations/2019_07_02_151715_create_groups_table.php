<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('creator_id');
            $table->string('name', 100)->unique();
            $table->string('slug', 200);
            $table->longText('description');
            $table->string('status', 10)->default('public');
            $table->bigInteger('parent_id')->default(0);
            $table->tinyInteger('enable_forum')->default(1);
            $table->dateTime('date_created');
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
        Schema::dropIfExists('groups');
    }
}
