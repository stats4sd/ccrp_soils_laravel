<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutrientBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutrient_balances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('farmer_field_id');
            $table->year('year');
            $table->decimal('tot_org_Ninput'); //tot_org_Ninput_an4 , _an3, _an2, _an1
            $table->decimal('tot_org_Pinput'); //tot_org_Pinput_an4 , etc
            $table->decimal('tot_org_Kinput');
            $table->decimal('tot_inorg_Ninput');
            $table->decimal('tot_inorg_Pinput');
            $table->decimal('tot_inorg_Kinput');
            $table->decimal('Total_cropNexport');
            $table->decimal('Total_cropPexport');
            $table->decimal('Total_cropKexport');
            $table->decimal('balance_N');
            $table->decimal('balance_P');
            $table->decimal('balance_K');
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
        Schema::dropIfExists('nutrient_balances');
    }
}
