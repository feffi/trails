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
			$table->engine = 'InnoDB';
			$table->bigIncrements ('id');
			$table->string ('name', 128);
			$table->enum ('status', array (
				'PENDING',
				'PLANNED',
				'HELD'
			))->default ('PENDING');
			$table->string ('description', 5000);
			$table->timestamps ();
			$table->index('name');
			$table->index('status');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists ('tracks');
	}
}