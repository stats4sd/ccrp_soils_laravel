<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateXlsformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('xlsforms', function(Blueprint $table) {
            $table->renameColumn('path_file', 'file');
            $table->renameColumn('form_title', 'title');
            $table->renameColumn('version_id','kobo_version_id');

            $table->boolean('live')->default(0)->comment('If true, this form is available to projects to use');
            $table->dropColumn('default_language');
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
            $table->renameColumn('file', 'path_file');
            $table->renameColumn('title', 'title');
            $table->renameColumn('kobo_version_id', 'version_id');

            $table->dropColumn('live');
            $table->string('default_language')->nullable();
        });
    }
}
