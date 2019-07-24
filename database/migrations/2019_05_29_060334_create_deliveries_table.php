<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('delivery_agents', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->string('name');
        //     $table->string('mobile')->unique();
        //     $table->string('address');
        //     $table->string('email')->unique();
        //     $table->string('contact_person_name');
        //     $table->string('contact_person_phone');
        //     $table->timestamps();
        // });

        // Schema::create('delivery_persons', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->string('type');
        //     $table->string('contact_p_name');
        //     $table->string('contact_p_phone');
        //     $table->unsignedBigInteger('added_by');
        //     $table->unsignedBigInteger('staff_id')->nullable();
        //     $table->unsignedBigInteger('agent_id')->nullable();
        //     $table->foreign('added_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        //     $table->foreign('staff_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        //     $table->foreign('agent_id')->references('id')->on('delivery_agents')->onUpdate('cascade')->onDelete('cascade');
        //     $table->timestamps();
        // });

        // Schema::create('delivery_costs', function (Blueprint $table){
        //     $table->bigIncrements('id');
        //     $table->string('cost_name')->nullable();
        //     $table->unsignedBigInteger('delivery_person');
        //     $table->timestamps();
        //     $table->foreign('delivery_person')->references('id')->on('delivery_persons')->onUpdate('cascade')->onDelete('cascade');
        // });

        Schema::create('delivery_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('memo_no')->nullable();
            $table->string('invoice')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->string('ref')->nullable();
            $table->integer('charge')->nullable();
            $table->integer('paid')->nullable();
            $table->integer('cod')->default(0);
            $table->unsignedBigInteger('range_id')->nullable();
            $table->unsignedBigInteger('person_id')->nullable();
            $table->unsignedBigInteger('account_id')->nullable();
            $table->unsignedBigInteger('customer_address_id')->nullable();
            $table->timestamps();

            $table->foreign('range_id')->references('id')->on('cost_configures')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('person_id')->references('id')->on('delivery_persons')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('customer_address_id')->references('id')->on('customer_address')->onUpdate('cascade')->onDelete('cascade');
        });

        // Schema::create('cost_configures', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->unsignedBigInteger('delivery_cost_id');
        //     $table->string('from');
        //     $table->string('to');
        //     $table->string('rate');
        //     $table->timestamps();

        //     $table->foreign('delivery_cost_id')->references('id')->on('delivery_costs')->onUpdate('cascade')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_agents');
        Schema::dropIfExists('delivery_persons');
        Schema::dropIfExists('delivery_orders');
        Schema::dropIfExists('cost_configures');
    }
}
