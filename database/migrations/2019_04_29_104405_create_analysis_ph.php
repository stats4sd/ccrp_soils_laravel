<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalysisPh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analysis_ph', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sample_id', 100);
            $table->date('analysis_date')->nullable();
            $table->decimal('weight_soil', 6,3)->nullable();
            $table->decimal('vol_water', 6,3)->nullable();
            $table->decimal('reading_ph', 5,3)->nullable();
            $table->string('stability', 100)->nullable();
            $table->string('start', 100)->nullable();
            $table->string('end', 100)->nullable();

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
        Schema::dropIfExists('analysis_ph');
    }
}
