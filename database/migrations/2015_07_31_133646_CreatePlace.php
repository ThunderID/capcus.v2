<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlace extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('destination_id')->unsigned();
            $table->string('name');
            $table->string('long_name');
            $table->string('slug');
            $table->text('summary');
            $table->text('description');
            $table->double('longitude');
            $table->double('latitude');
            $table->datetime('published_at');

            $table->timestamps();

            $table->index('destination_id');
            $table->index(['longitude', 'latitude']);
            $table->index('long_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('places');
    }
}
