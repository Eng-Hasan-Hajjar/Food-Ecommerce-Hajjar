<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('about_app');
			$table->double('commission');
			$table->string('tex_up');
			$table->string('text_down');
			$table->string('acc1');
			$table->string('acc2');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
