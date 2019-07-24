<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_alerts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('amount')->unsigned();
            $table->date('notification_date');
            $table->date('payment_date');
            $table->unsignedBigInteger('supplier_id');
            $table->boolean('status')->default(false);
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier_alerts');
    }
}
