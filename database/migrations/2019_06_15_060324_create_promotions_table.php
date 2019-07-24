<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->tinyInteger('type');
            $table->date('start_from');
            $table->date('end_to');
            $table->integer('minimum_buy')->nullable();
            $table->tinyInteger('discount_type');
            $table->integer('discount_amount');
            $table->boolean('status');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('product_promotion', function(Blueprint $table){
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('promotion_id');

            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade');
            $table->foreign('promotion_id')->references('id')->on('promotions')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
