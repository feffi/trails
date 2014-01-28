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
			$table->engine = 'InnoDB';
			$table->bigIncrements ('id');
			$table->bigInteger ('user_id')->unsigned();
			$table->bigInteger ('track_id')->unsigned();
			$table->timestamps ();
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('track_id')->references('id')->on('tracks');
			$table->index('user_id');
			$table->index('track_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists ('bookings');
	}
}