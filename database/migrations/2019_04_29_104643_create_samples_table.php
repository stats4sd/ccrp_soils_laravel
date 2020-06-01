<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samples', function (Blueprint $table) {
            $table->string('id', 100);
            $table->string('username', 100)->nullable();
            $table->integer('plot_id')->nullable();
            $table->date('date')->nullable();
            $table->integer('depth')->nullable();
            $table->string('texture', 100)->nullable();
            $table->tinyInteger('at_plot')->nullable();
            $table->string('plot_photo', 100)->nullable();
            $table->decimal('longitude', 25,20)->nullable();
            $table->decimal('latitude', 25,20)->nullable();
            $table->decimal('altitude', 25,20)->nullable();
            $table->decimal('accuracy', 25,20)->nullable();
            $table->text('comment');
            $table->text('community_quick');
            $table->integer('project_id');
            $table->text('farmer_quick');
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
        Schema::dropIfExists('samples');
    }
}
