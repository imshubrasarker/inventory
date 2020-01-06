<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->date('manual_date')->nullable();
            $table->text('notebar')->nullable();
            $table->string('grand_total_price')->nullable();
            $table->string('advanced')->nullable();
            $table->text('due_amount')->nullable();
            $table->double('discount')->nullable();
            $table->double('transport')->nullable();
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
        Schema::drop('invoices');
    }
}
