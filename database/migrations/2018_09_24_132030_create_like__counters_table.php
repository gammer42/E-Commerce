<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikeCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like__counters', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('like_type')->nullable(false);
            $table->bigInteger('like_content_id')->nullable(true);
            $table->bigInteger('like_comment_id')->nullable(true);
            $table->string('like_ip',100)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('like__counters');
    }
}
