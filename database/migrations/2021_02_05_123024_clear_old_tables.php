<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClearOldTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('plots');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('plots', function (Blueprint $table) {
            $table->id('id');
            $table->string('plot_name', 250);
            $table->string('plot_gradient', 100)->nullable();
            $table->string('farmer_kn_soil', 250)->nullable();
            $table->string('soil_texture', 100)->nullable();
            $table->string('farmer_id', 50);
            $table->decimal('latitude', 30, 15)->nullable();
            $table->decimal('longitude', 30, 15)->nullable();
            $table->decimal('altitude', 30, 15)->nullable();
            $table->decimal('accuracy', 30, 15)->nullable();
            $table->timestamps();
        });
    }
}
