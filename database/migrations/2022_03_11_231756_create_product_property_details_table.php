<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPropertyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_property_details', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('product_id')->nullable();
            $table->integer('product_property_type_id')->nullable();

            $table->string('name')->nullable();
            $table->string('value')->nullable();
            $table->string('slug')->nullable();

            $table->boolean('active')->nullable();
            $table->integer('sort');
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
        Schema::dropIfExists('product_property_details');
    }
}
