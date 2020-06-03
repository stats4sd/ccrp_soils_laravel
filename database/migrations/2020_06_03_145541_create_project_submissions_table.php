<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_submissions', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('uuid');
            $table->timestamp('submitted_at');
            $table->foreignId('project_xlsform_id');
            $table->json('content');
            $table->timestamps();

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_submissions');
    }
}
