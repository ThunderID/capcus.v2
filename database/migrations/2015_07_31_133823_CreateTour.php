<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTour extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('travel_agency_id')->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->text('ittinary');
            $table->text('description');
            $table->integer('duration_day');
            $table->integer('duration_night');
            $table->datetime('published_at');
            $table->timestamps();

            $table->index('travel_agency_id');
            $table->index(['published_at', 'travel_agency_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tours');
    }
}
