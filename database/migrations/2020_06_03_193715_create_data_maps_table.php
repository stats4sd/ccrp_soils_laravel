<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_maps', function (Blueprint $table) {
            $table->string('id');
            $table->string('title');
            $table->timestamps();
        });

        Schema::table('xlsforms', function (Blueprint $table) {
            $table->string('data_map_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_maps');
        Schema::table('xlsforms', function(Blueprint $table) {
            $table->dropColumn('data_map_id');
        });
    }
}
