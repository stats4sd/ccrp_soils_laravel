<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmerFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_submission_id');
            $table->string('uuid'); // _uuid
            $table->string('country_id'); // community_id
            $table->string('village_community'); //village_community
            $table->string('farmer_name'); // farmer_name
            $table->decimal('size', 8, 2); // field_size_final3
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
        Schema::dropIfExists('farmer_fields');
    }
}
