<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_product_details', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('bill_product_id')->nullable();
            $table->integer('product_property_detail_id')->nullable();
            $table->integer('product_property_type_id')->nullable();

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
        Schema::dropIfExists('bill_product_details');
    }
}
