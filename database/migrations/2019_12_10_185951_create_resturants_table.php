<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResturantsTable extends Migration {

	public function up()
	{
		Schema::create('resturants', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name')->unique();
			$table->string('email')->unique();
			$table->string('phone');
			$table->integer('district_id')->unsigned();
			$table->string('password');
			$table->double('delivery_charge');
			$table->double('minimum_order');
			$table->string('contact_phone');
			$table->string('whats')->nullable();
			$table->string('image')->nullable();
			$table->boolean('state')->default(1);
			$table->string('api_token')->nullable();
            $table->string('pin_code')->nullable();
            $table->boolean('active')->default(1);


        });
	}

	public function down()
	{
		Schema::drop('resturants');
	}
}
