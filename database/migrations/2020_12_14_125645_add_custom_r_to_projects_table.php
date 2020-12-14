<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomRToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->boolean('highR')->default(0)->comment('does this project want split LR and HR results for the Olsen P analysis?');
            $table->boolean('customR')->default(0)->comment('does this project want extra output columns for Custom R resutls for the Olsen P analysis?');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('highR');
            $table->dropColumn('customR');
        });
    }
}
