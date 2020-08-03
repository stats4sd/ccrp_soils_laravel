<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomProjectsToXlsformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('xlsforms', function (Blueprint $table) {
            $table->boolean('public')->default(1)->comment('If true, the form is automatically available to all projects');
            $table->unsignedBigInteger('project_id')->nullable()->comment('if form is private, which project is it linked to?');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('xlsforms', function (Blueprint $table) {
            $table->dropColumn('public');
            $table->dropColumn('project_id');
        });
    }
}
