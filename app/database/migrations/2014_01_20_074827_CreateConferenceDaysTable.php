<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConferenceDaysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ('conferenceDays', function (Blueprint $table) {
			$table->bigIncrements ('id');
			$table->dateTime ('from');
			$table->dateTime ('to');
			$table->enum ('status', array (
				'PENDING',
				'PLANNED',
				'HELD'
			))->default ('PENDING');
			$table->string ('description', 5000);
			$table->timestamps ();
			$table->index('from');
			$table->index('to');
			$table->index('status');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop ('conferenceDays');
	}
	}