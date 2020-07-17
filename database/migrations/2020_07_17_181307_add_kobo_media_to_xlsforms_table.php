<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKoboMediaToXlsformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('xlsforms', function (Blueprint $table) {
            $table->text('kobo_media')->nullable()->comment('array of media ids for any media attachments to this file on kobotoolbox. Required to allow easy deletion of files when new versions are uploaded');
        });

        Schema::table('project_xlsform', function (Blueprint $table) {
            $table->text('kobo_media')->nullable()->comment('array of media ids for any media attachments to this file on kobotoolbox. Required to allow easy deletion of files when new versions are uploaded');
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
            $table->dropColumn('kobo_media');
        });

        Schema::table('project_xlsform', function (Blueprint $table) {
            $table->dropColumn('kobo_media');
        });
    }
}
