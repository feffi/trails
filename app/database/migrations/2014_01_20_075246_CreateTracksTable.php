<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTracksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ('tracks', function (Blueprint $table) {
			$table->bigIncrements ('id');
			$table->string ('name', 64);
			$table->enum ('status', array (
				'PENDING',
				'PLANNED',
				'HELD'
			))->default ('PENDING');
			$table->bigInteger ('id_conference'); // Foreign key to a conference day(s)
			$table->string ('description', 5000);
			$table->timestamps ();
			$table->index('name');
			$table->index('status');
			$table->index('id_conference');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop ('tracks');
	}
}