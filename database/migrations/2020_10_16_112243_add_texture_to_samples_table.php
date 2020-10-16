<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTextureToSamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('samples', function (Blueprint $table) {
            $table->string('simple_texture')->nullable();
            $table->boolean('ball_yn')->nullable();
            $table->boolean('ribbon_yn')->nullable();
            $table->string('ribbon_break_length')->nullable();
            $table->string('usda_gritty')->nullable();
            $table->string('final_texture_type_usda')->nullable();
            $table->string('second_texture_type_usda')->nullable();
            $table->boolean('ball_yn_fao')->nullable();
            $table->boolean('sausage_yn_fao')->nullable();
            $table->boolean('pencil_fao_yn')->nullable();
            $table->boolean('halfcircle_fao_yn')->nullable();
            $table->string('soil_circle_choice')->nullable();
            $table->string('final_texture_type_fao')->nullable();
            $table->string('second_texture_type_fao')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('samples', function (Blueprint $table) {
            //
        });
    }
}
