<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhone extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('phones', function (Blueprint $table) {
			$table->increments('id');
			$table->string('phone');
			$table->integer('phoneable_id')->unsigned();
			$table->string('phoneable_type');
			$table->timestamps();

			$table->index(['phoneable_type', 'phoneable_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('phones');
	}
}
