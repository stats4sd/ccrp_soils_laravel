<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProjectXlsformTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_xlsform', function(Blueprint $table) {
            $table->dropColumn('deployed');
            $table->string('kobo_version_id')->nullable()->comment('If null; form is not deployed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_xlsform', function(Blueprint $table) {
            $table->boolean('deployed')->default(0);
            $table->dropColumn('kobo_version_id');
        });
    }
}
