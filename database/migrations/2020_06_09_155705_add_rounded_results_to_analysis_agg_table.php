<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoundedResultsToAnalysisAggTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('analysis_agg', function (Blueprint $table) {
            $table->decimal('twomm_aggreg_pct_result', 25, 20);
            $table->decimal('twofiftymicron_aggreg_pct_result', 25, 20);
            $table->decimal('percent_stones', 25, 20);
            $table->decimal('total_stableaggregates', 25, 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('analysis_agg', function (Blueprint $table) {
            $table->dropColumn('twomm_aggreg_pct_result');
            $table->dropColumn('twofiftymicron_aggreg_pct_result');
            $table->dropColumn('percent_stones');
            $table->dropColumn('total_stableaggregates');
        });
    }
}
