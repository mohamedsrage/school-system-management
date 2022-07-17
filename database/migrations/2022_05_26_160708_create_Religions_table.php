<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReligionsTable extends Migration {

	public function up()
	{
		Schema::create('Religions', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('Name');
		});
	}

	public function down()
	{
		Schema::drop('Religions');
	}
}