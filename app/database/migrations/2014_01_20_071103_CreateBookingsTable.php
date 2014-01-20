<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ('bookings', function (Blueprint $table) {
			$table->bigIncrements ('id');
			$table->bigInteger ('user');
			$table->bigInteger ('track');
			$table->index('user');
			$table->index('track');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop ('bookings');
	}
}