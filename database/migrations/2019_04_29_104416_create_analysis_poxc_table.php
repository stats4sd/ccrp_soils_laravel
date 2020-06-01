<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalysisPoxcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analysis_poxc', function (Blueprint $table) {
            $table->id('id');
            $table->date('analysis_date')->nullable();
            $table->string('sample_id', 50);
            $table->decimal('weight_soil', 6,3)->nullable();
            $table->decimal('color', 25,20)->nullable();
            $table->decimal('color100', 25,20)->nullable();
            $table->decimal('conc_digest', 25,20)->nullable();
            $table->string('cloudy', 50)->nullable();
            $table->decimal('colorimeter', 25,20)->nullable();
            $table->decimal('raw_conc', 25,20)->nullable();
            $table->decimal('poxc_sample', 25,20)->nullable();
            $table->decimal('poxc_soil', 25,20)->nullable();
            $table->integer('correct_moisture')->default(0);
            $table->decimal('moisture', 6,3)->nullable();
            $table->decimal('poxc_soil_corrected', 25,20)->nullable();
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
        Schema::dropIfExists('analysis_poxc');
    }
}
