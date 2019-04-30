<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalysisP extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analysis_p', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sample_id', 100)->nullable();
            $table->date('analysis_date');
            $table->decimal('weight_soil', 10,4)->nullable();
            $table->decimal('vol_extract', 10,4)->nullable();
            $table->decimal('vol_topup', 10,4)->nullable();
            $table->string('cloudy', 100)->nullable();
            $table->decimal('color', 25,20)->nullable();
            $table->decimal('raw_conc', 25,20)->nullable();
            $table->decimal('olsen_p', 25,20)->nullable();
            $table->decimal('blank_water', 6,3)->default(0.000);
            $table->integer('correct_moisture')->default(0);
            $table->decimal('moisture', 6,3)->nullable();
            $table->decimal('olsen_p_corrected', 25,20)->nullable();

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
        Schema::dropIfExists('analysis_p');
    }
}
