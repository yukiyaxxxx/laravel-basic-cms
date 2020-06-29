<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_articles', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('category_id')->nullable()->comment('カテゴリID');
            $table->text('title')->nullable()->comment('タイトル');
            $table->longText('body')->nullable()->comment('本文');
            $table->dateTime('date')->nullable()->comment('記事日時');
            $table->boolean('is_publish')->nullable()->default(0)->comment('公開か');

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
        Schema::dropIfExists('article_articles');
    }
}
