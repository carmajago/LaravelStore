<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('value')->unsigned();
            $table->bigInteger('provider_id')->unsigned();
            $table->foreign('provider_id')->references('id')->on('providers');
 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provider_payments');
    }
}
