<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnProductIdToTableGodownUnits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('godown_units', function (Blueprint $table) {
            $table->bigInteger('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('godown_units', function (Blueprint $table) {
            $table->dropColumn('product_id');
        });
    }
}
