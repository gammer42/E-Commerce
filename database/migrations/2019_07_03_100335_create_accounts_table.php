<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->tinyInteger('uses')->default(3);
            $table->string('name')->nullable();
            $table->string('number')->nullable();
            $table->string('branch')->nullable();
            $table->string('address')->nullable();
            $table->tinyInteger('type_of_account')->nullable();
            $table->integer('transaction_cost')->nullable();
            $table->text('description')->nullable();
            $table->integer('initial_bal')->default(0);
            $table->integer('current_bal')->default(0);
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->timestamps();

            $table->foreign('bank_id')->references('id')->on('banks')->onUpdate('cascade');
        });

        // Schema::create('account_store', function (Blueprint $table){
        //     $table->bigIncrements('id');
        //     $table->unsignedBigInteger('account_id');
        //     $table->unsignedBigInteger('store_id');
        //     $table->timestamps();

        //     $table->foreign('account_id')->references('id')->on('accounts')->onUpdate('cascade');
        //     $table->foreign('store_id')->references('id')->on('stores')->onUpdate('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
