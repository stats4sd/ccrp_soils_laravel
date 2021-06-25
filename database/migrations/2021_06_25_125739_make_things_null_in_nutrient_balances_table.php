<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeThingsNullInNutrientBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nutrient_balances', function (Blueprint $table) {
            $table->decimal('tot_org_Ninput')->nullable()->change(); //tot_org_Ninput_an4 , _an3, _an2, _an1
            $table->decimal('tot_org_Pinput')->nullable()->change(); //tot_org_Pinput_an4 , etc
            $table->decimal('tot_org_Kinput')->nullable()->change();
            $table->decimal('tot_inorg_Ninput')->nullable()->change();
            $table->decimal('tot_inorg_Pinput')->nullable()->change();
            $table->decimal('tot_inorg_Kinput')->nullable()->change();
            $table->decimal('Total_cropNexport')->nullable()->change();
            $table->decimal('Total_cropPexport')->nullable()->change();
            $table->decimal('Total_cropKexport')->nullable()->change();
            $table->decimal('balance_N')->nullable()->change();
            $table->decimal('balance_P')->nullable()->change();
            $table->decimal('balance_K')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nutrient_balances', function (Blueprint $table) {
            $table->decimal('tot_org_Ninput')->change();
            $table->decimal('tot_org_Pinput')->change();
            $table->decimal('tot_org_Kinput')->change();
            $table->decimal('tot_inorg_Ninput')->change();
            $table->decimal('tot_inorg_Pinput')->change();
            $table->decimal('tot_inorg_Kinput')->change();
            $table->decimal('Total_cropNexport')->change();
            $table->decimal('Total_cropPexport')->change();
            $table->decimal('Total_cropKexport')->change();
            $table->decimal('balance_N')->change();
            $table->decimal('balance_P')->change();
            $table->decimal('balance_K')->change();
        });
    }
}
