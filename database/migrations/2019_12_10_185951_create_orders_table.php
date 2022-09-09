<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('special_order')->nullable();
			$table->integer('amount')->default(1);
			$table->integer('resturant_id')->unsigned();
			$table->enum('payment_method', array('cash', 'online'));
			$table->enum('state', array('pending', 'accepted', 'rejected', 'delivered', 'declined'))->default(pending);
			$table->double('total')->default(0);
			$table->double('commission')->default(0);
			$table->double('cost')->default(0);
            $table->double('net')->default(0);
			$table->integer('client_id')->unsigned();
			$table->string('notes');
            $table->string('address');
            $table->double('delivery_cost')->default(0);



        });
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
