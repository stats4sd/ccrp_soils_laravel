<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id');
            $table->string('component', 75);
            $table->string('type', 75);
            $table->text('action');
            $table->longText('content');
            $table->text('primary_link');
            $table->bigInteger('item_id');
            $table->bigInteger('secondary_item_id')->nullable();
            $table->dateTime('date_recorded');
            $table->tinyInteger('hide_sitewide')->default(0);
            $table->integer('mptt_left')->default(0);
            $table->integer('mptt_right')->default(0);
            $table->tinyInteger('is_spam')->default(0);

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
        Schema::dropIfExists('activity');
    }
}
