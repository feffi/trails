<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlotsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ('slots', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->bigIncrements ('id');
 			$table->bigInteger ('session_id')->unsigned();
 			$table->bigInteger ('tracks_id')->unsigned();
			$table->dateTime ('from');
			$table->dateTime ('to');
 			$table->foreign('session_id')->references('id')->on('sessions');
 			$table->foreign('tracks_id')->references('id')->on('tracks');
			$table->index ('from');
			$table->index ('to');
			$table->index ('session_id');
			$table->index ('tracks_id');
			$table->timestamps ();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists ('slots');
	}
}