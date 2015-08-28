<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageTravelAgent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_travel_agent', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('travel_agent_id');
            $table->integer('package_id');
            $table->date('active_since');
            $table->date('active_until');
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
        Schema::drop('package_travel_agent');
    }
}
