<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('permission_role', function (Blueprint $table) {
        //     $table->unsignedInteger('role_id');
        //     $table->unsignedInteger('permission_id');
        //     //FOREIGN KEY CONSTRAINTS
        //     $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade');
        //     $table->foreign('permission_id')->references('id')->on('permissions')->onUpdate('cascade');

        //     //SETTING THE PRIMARY KEYS

        //     $table->primary(['role_id', 'permission_id']);
        // });

        // Schema::create('role_user', function (Blueprint $table) {
        //     $table->unsignedBigInteger('user_id');
        //     $table->unsignedInteger('role_id');

        //     //FOREIGN KEY CONSTRAINTS
        //     $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
        //     $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade');

        //     //SETTING THE PRIMARY KEYS
        //     $table->primary(['user_id', 'role_id']);
        // });

        // Schema::create('customer_address', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->integer('address_type');
        //     $table->string('street');
        //     $table->string('phone')->nullable();
        //     $table->unsignedBigInteger('customer_id');
        //     $table->unsignedInteger('district_id');
        //     $table->timestamps();

        //     $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade');
        //     $table->foreign('district_id')->references('id')->on('districts')->onUpdate('cascade');
        // });

        // Schema::create('phones', function (Blueprint $table){
        //     $table->bigIncrements('id');
        //     $table->string('phone');
        //     $table->string('des')->nullable();
        //     $table->timestamps();
        // });

        // Schema::create('customer_phone', function (Blueprint $table){
        //     $table->unsignedBigInteger('customer_id');
        //     $table->unsignedBigInteger('phone_id');

        //     $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade');
        //     $table->foreign('phone_id')->references('id')->on('phones')->onUpdate('cascade');
        // });

        // Schema::create('promotion_store', function (Blueprint $table){
        //     $table->unsignedBigInteger('promotion_id');
        //     $table->unsignedBigInteger('store_id');
        //     $table->primary(['promotion_id', 'store_id']);
        //     $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('cascade')->onUpdate('cascade');
        //     $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade')->onUpdate('cascade');
        // });
        // Schema::create('supplier_transaction', function (Blueprint $table){
        //     $table->bigIncrements('id');
        //     $table->string('type')->nullable();
        //     $table->unsignedBigInteger('transaction_id');
        //     $table->unsignedBigInteger('supplier_id');
        //     $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade')->onUpdate('cascade');
        //     $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
        // });
        // Schema::create('employee_transaction', function (Blueprint $table){
        //     $table->bigIncrements('id');
        //     $table->string('type')->nullable();
        //     $table->unsignedBigInteger('employee_id');
        //     $table->unsignedBigInteger('transaction_id');
        //     $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        //     $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade')->onUpdate('cascade');
        // });
        // Schema::create('customer_transaction', function (Blueprint $table){
        //     $table->bigIncrements('id');
        //     $table->unsignedBigInteger('customer_id');
        //     $table->unsignedBigInteger('transaction_id');
        //     $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
        //     $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade')->onUpdate('cascade');
        // });

        // Schema::create('brand_promotion', function (Blueprint $table){
        //     $table->bigIncrements('id');
        //     $table->unsignedBigInteger('brand_id');
        //     $table->unsignedBigInteger('promotion_id');
        //     $table->timestamps();
        //     $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');
        //     $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('cascade')->onUpdate('cascade');
        // });
        // Schema::create('category_promotion', function (Blueprint $table){
        //     $table->bigIncrements('id');
        //     $table->unsignedBigInteger('category_id');
        //     $table->unsignedBigInteger('promotion_id');
        //     $table->timestamps();
        //     $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
        //     $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('cascade')->onUpdate('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
