<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {

            $table->increments('id');
            $table->longText('blog_content');
            $table->string('blog_status',20)->default('draft');
            $table->string('blog_type',20);
            $table->integer('blog_like_count')->unsigned()->default(0);
            $table->integer('blog_comment_count')->unsigned()->default(0);
            $table->tinyInteger('blog_has_article')->unsigned()->default(0);
            $table->string('article_title');
            $table->longText('article_content');
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
        Schema::dropIfExists('blogs');
    }
}
