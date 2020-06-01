<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProcessingToProjectXlsformTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_xlsform', function (Blueprint $table) {
            $table->boolean('processing')->default(0)->comment('If true, this entire entry should not be editable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_xlsform', function (Blueprint $table) {
            $table->dropColumn('processing');
        });
    }
}
