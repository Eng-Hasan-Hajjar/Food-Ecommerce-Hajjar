<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration {

	public function up()
	{
		Schema::create('offers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('description');
			$table->date('from');
			$table->date('to');
			$table->string('image');
			$table->integer('resturant_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('offers');
	}
}