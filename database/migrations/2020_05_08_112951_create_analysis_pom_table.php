<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalysisPomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analysis_pom', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sample_id');
            $table->decimal('weight_soil', 6, 3)->nullable();
            $table->decimal('diameter_circ_pom', 6, 3)->nullable();
            $table->boolean('weigh_pom_yn')->nullable();
            $table->decimal('weight_cloth', 6, 3)->nullable();
            $table->decimal('weight_pom', 6, 3)->nullable();
            $table->decimal('percent_pom', 6, 3)->nullable();
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
        Schema::dropIfExists('analysis_pom');
    }
}
