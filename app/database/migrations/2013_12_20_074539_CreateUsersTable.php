<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ('users', function (Blueprint $table) {
			$table->bigIncrements ('id');
			$table->timestamps ();
			$table->string ('firstname', 64);
			$table->string ('lastname', 64);
			$table->string ('username', 64);
			$table->string ('email', 320);
			$table->string ('password', 250);
			$table->index('username');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop ('users');
	}
}
