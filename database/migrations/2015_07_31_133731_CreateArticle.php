<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('writer_id')->unsigned();
            $table->string('title');
            $table->string('slug');
            $table->text('summary');
            $table->text('content');
            $table->datetime('published_at')->nullable();
            $table->timestamps();

            $table->index('published_at');
            $table->index('writer_id');
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
