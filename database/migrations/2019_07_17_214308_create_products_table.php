<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('name');
            $table->integer('price');
            $table->integer('iva');
            $table->integer('quantity_available');
            $table->integer('minimum_quantity');
            $table->integer('maximum_quantity');

            $table->bigInteger('product_presentation_id')->unsigned();
            $table->foreign('product_presentation_id')->references('id')->on('product_presentations');

            $table->bigInteger('product_category_id')->unsigned();
            $table->foreign('product_category_id')->references('id')->on('product_categories');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
