<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXlsFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xlsforms', function (Blueprint $table) {
            $table->id('id');
            $table->string('title')->nullable();
            $table->string('xlsfile')->nullable();
            $table->string('kobo_id')->nullable();
            $table->string('kobo_version_id')->nullable();
            $table->boolean('is_active')->default(0)->comment('If true, form is active and deployed on Kobotools');
            $table->string('enketo_url')->nullable();
            $table->string('link_page')->nullable();
            $table->text('description')->nullable();
            $table->text('media')->nullable();
            $table->json('content')->nullable();
            $table->boolean('live')->default(0)->comment('If true, this form is available to projects to use');
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
        Schema::dropIfExists('xls_forms');
    }
}
