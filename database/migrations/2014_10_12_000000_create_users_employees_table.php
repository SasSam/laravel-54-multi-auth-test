<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersEmployeesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users_employees', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password');
			$table->tinyInteger('avail')->default(1);
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('users_employees');
	}
}
