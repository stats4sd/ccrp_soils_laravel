<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubmissionIdToDataTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('analysis_agg', function (Blueprint $table) {
            $table->foreignId('project_submission_id')->constrained();
        });

        Schema::table('analysis_p', function (Blueprint $table) {
            $table->foreignId('project_submission_id')->constrained();
        });

        Schema::table('analysis_ph', function (Blueprint $table) {
            $table->foreignId('project_submission_id')->constrained();
        });

        Schema::table('analysis_pom', function (Blueprint $table) {
            $table->foreignId('project_submission_id')->constrained();
        });

        Schema::table('analysis_poxc', function (Blueprint $table) {
            $table->foreignId('project_submission_id')->constrained();
        });

        Schema::table('samples', function (Blueprint $table) {
            $table->foreignId('project_submission_id')->constrained();
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
            $table->dropColumn('project_submission_id');
        });

        Schema::table('analysis_p', function (Blueprint $table) {
            $table->dropColumn('project_submission_id');
        });

        Schema::table('analysis_ph', function (Blueprint $table) {
            $table->dropColumn('project_submission_id');
        });

        Schema::table('analysis_pom', function (Blueprint $table) {
            $table->dropColumn('project_submission_id');
        });

        Schema::table('analysis_poxc', function (Blueprint $table) {
            $table->dropColumn('project_submission_id');
        });

        Schema::table('samples', function (Blueprint $table) {
            $table->dropColumn('project_submission_id');
        });
    }
}
