<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalysisAggTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analysis_agg', function (Blueprint $table) {
            $table->id('id');
            $table->string('sample_id', 100);
            $table->decimal('weight_soil', 10,4)->nullable();
            $table->decimal('weight_cloth', 10,4)->nullable();
            $table->decimal('weight_stones2mm', 10,4)->nullable();
            $table->decimal('weight_2mm_aggreg', 10,4)->nullable();
            $table->decimal('weight_cloth_250micron', 10,4)->nullable();
            $table->decimal('weight_250micron_aggreg', 10,4)->nullable();
            $table->decimal('pct_stones', 25,20)->nullable();
            $table->decimal('twomm_aggreg_pct', 25,20)->nullable();
            $table->decimal('twofiftymicr_aggreg_pct', 25,20)->nullable();
            $table->decimal('twomm_aggreg_pct_result', 25, 20)->nullable();
            $table->decimal('twofiftymicron_aggreg_pct_result', 25, 20)->nullable();
            $table->decimal('percent_stones', 25, 20)->nullable();
            $table->decimal('total_stableaggregates', 25, 20)->nullable();
            $table->decimal('total_check', 25, 20)->nullable();
            $table->decimal('validation_check', 25, 20)->nullable();
            $table->date('analysis_date');
            $table->timestamps();








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
        Schema::dropIfExists('analysis_agg');
    }
}
