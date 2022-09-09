<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('full_name');
			$table->string('email');
			$table->string('phone');
			$table->string('message');
			$table->enum('type', array('complaint', 'suggestion', 'inquiry'));
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}