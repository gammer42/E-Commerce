<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('payments', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->string('type');
        //     $table->string('bank_name');
        //     $table->boolean('payment_method')->nullable();
        //     $table->string('reff_transaction_no')->nullable();
        //     $table->string('customer_account_no')->nullable();
        //     $table->string('customer_card_no')->nullable();
        //     $table->unsignedBigInteger('card_id')->nullable();
        //     $table->unsignedBigInteger('bank_id')->nullable();
        //     $table->unsignedBigInteger('account_id');
        //     $table->timestamps();

        //     $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade')->onUpdate('cascade');
        //     $table->foreign('card_id')->references('id')->on('cards')->onDelete('cascade')->onUpdate('cascade');
        //     $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
        // });

        // Schema::create('order_payment', function (Blueprint $table){
        //     $table->unsignedBigInteger('payment_id');
        //     $table->unsignedBigInteger('order_id');
        //     $table->timestamps();

        //     $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
        //     $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade')->onUpdate('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
