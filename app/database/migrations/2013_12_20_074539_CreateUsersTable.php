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
			$table->engine = 'InnoDB';
			$table->bigIncrements ('id');
			$table->string ('firstname', 128);
			$table->string ('lastname', 128);
			$table->string ('username', 128);
			$table->string ('email', 320);
			$table->string ('password', 250);
			$table->index('email');
			$table->index('username');
			$table->timestamps ();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists ('users');
	}
}
