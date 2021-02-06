<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddProjectIdToProjectSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_submissions', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id');
        });

        DB::update('update project_submissions set project_id = (select coalesce(project_xlsform.project_id, 0) from project_xlsform where project_xlsform.id = project_submissions.project_xlsform_id limit 1);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_submissions', function (Blueprint $table) {
            $table->dropColumn('project_id');
        });
    }
}
