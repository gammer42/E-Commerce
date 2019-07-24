<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransactionCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_parent_categories', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->boolean('type');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('trans_child_categories', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('categories');
            $table->timestamps();

            $table->foreign('categories')->references('id')->on('trans_parent_categories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parent_categories');
        Schema::dropIfExists('child_categories');
    }
}
