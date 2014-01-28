<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateSessionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ('sessions', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->bigIncrements ('id');
			$table->date ('from');
			$table->date ('to');
			$table->enum ('status', array (
				'PENDING',
				'PLANNED',
				'HELD'
			))->default ('PENDING');
			$table->string ('description', 5000);
			$table->timestamps ();
			$table->index ('from');
			$table->index ('to');
			$table->index ('status');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists ('sessions');
	}
}