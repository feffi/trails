<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Eloquent::unguard ();

		$this->command->info ('Seeding entities...');
		$this->call ('ConferenceDaysTableSeeder');
		$this->call ('TracksTableSeeder');
// 		$this->call ('UserTableSeeder');

// 		$this->command->info ('Seeding connections...');
// 		$this->call ('BookingsTableSeeder');
	}
}