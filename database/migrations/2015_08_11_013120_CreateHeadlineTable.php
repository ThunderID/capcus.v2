<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeadlineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('headlines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id')->unsigned();
            $table->datetime('active_since');
            $table->datetime('active_until');
            $table->string('title');
            $table->string('link_to');
            $table->string('priority');

            $table->timestamps();

            $table->index(['active_since', 'active_until']);
            $table->index(['vendor_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('headlines');
    }
}
