<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('status')->nullable();
            $table->decimal('total_price', 15, 2)->nullable();
            $table->integer('payment_method')->nullable();
            $table->integer('shipping_method')->nullable();
            $table->integer('shipping_price')->nullable();
            $table->text('note')->nullable();

            $table->boolean('active')->nullable();

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
        Schema::dropIfExists('bills');
    }
}
