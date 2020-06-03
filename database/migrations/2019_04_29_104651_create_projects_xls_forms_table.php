<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsXlsFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_xlsform', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('project_id');
            $table->foreignId('xlsform_id');
            $table->string('kobo_id', 255)->nullable()->comment('If null; form is not on Kobo');
            $table->string('kobo_version_id')->nullable()->comment('If null; form has never been deployed/active on Kobo');
            $table->string('enketo_url')->nullable()->comment('If null; form is not currently deployed/active on Kobo');
            $table->boolean('processing')->default(0)->comment('If true, this entire entry should not be editable');
            $table->boolean('is_active')->default(0)->comment('If true, this project-form is deployed and active on Kobo');
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
        Schema::dropIfExists('projects_xls_forms');
    }
}
