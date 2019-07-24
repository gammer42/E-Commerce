<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('supplier_code')->nullable()->unique();
            $table->string('supplier_name');
            $table->string('contact_person');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('store_name')->nullable();
            $table->string('vat_reg_num')->unique();
            $table->string('img')->nullable();
            $table->string('address');
            $table->unsignedInteger('upazila_id');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('upazila_id')->references('id')->on('upazilas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
