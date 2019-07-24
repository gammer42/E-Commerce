<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StockRequisitions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Schema::create('product_store', function (Blueprint $table){
        //     $table->bigIncrements('id');
        //     $table->unsignedBigInteger('store_id');
        //     $table->unsignedBigInteger('product_id');
        //     $table->timestamps();

        //     $table->foreign('store_id')->references('id')->on('stores')->onUpdate('cascade');
        //     $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade');

        // });

        // Schema::create('stock_requisitions', function (Blueprint $table){
        //     $table->bigIncrements('id');
        //     $table->integer('quantity');
        //     $table->boolean('status')->default(false);
        //     $table->date('date')->nullable();
        //     $table->unsignedBigInteger('product_store_id');
        //     $table->timestamps();

        //     $table->foreign('product_store_id')->references('id')->on('product_store')->onUpdate('cascade');
        // });

        Schema::create('current_stocks', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('quantity');
            $table->string('buy_price');
            $table->string('sell_price');
            $table->unsignedBigInteger('product_store_id');
            $table->timestamps();

            $table->foreign('product_store_id')->references('id')->on('product_store')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_store');
        Schema::dropIfExists('stock_requisitions');
        Schema::dropIfExists('current_stocks');
    }
}
