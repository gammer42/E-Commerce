<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->charset = 'utf8';

            $table->increments('id');
            $table->bigInteger('comment_blog_id')->unsigned()->nullable(false);
            $table->bigInteger('comment_count')->unsigned()->nullable(false);
            $table->string('comment_author')->nullable(false);
            $table->string('comment_author_ip',50)->nullable(false);
            $table->text('comment_content')->nullable(false);
            $table->tinyInteger('comment_approved')->nullable(false)->default(0);
            $table->integer('comment_like_count')->nullable(false);
            $table->string('comment_author_email',190)->nullable(false);
            $table->timestamps();
        });
//
//        Schema::create('comment_count', function(Blueprint $table){
//
//            $table->engine = 'InnoDB';
//
//            $table->bigInteger('comment_id')->unsigned();
//            $table->bigInteger('comment_blog_id')->unsigned();
//            $table->bigInteger('comment_count')->unsigned();
//
//            $table->foreign('comment_id')->references('id')->on('comments')
//                ->onUpdate('cascade')->onDelete('cascade');
//
//            $table->foreign('comment_blog_id')->references('comment_blog_id')
//                ->on('comments')->onUpdate('cascade')->onDelete('cascade');
//
//            $table->foreign('comment_count')->references('comment_count')
//                ->on('comments')->onUpdate('cascade')->onDelete('cascade');
//
//        });


    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
        Schema::dropIfExists('comment_count');
    }
}
