<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourSchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_schedule', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tour_id')->unsigned();
            $table->date('departure');
            $table->date('arrival');
            $table->string('currency');
            $table->double('original_price');
            $table->double('discounted_price');
            $table->timestamps();

            $table->index(['tour_id', 'departure', 'discounted_price', 'original_price'], 'tour_sched');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tour_schedule');
    }
}
