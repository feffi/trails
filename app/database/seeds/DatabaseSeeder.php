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
		$this->call ('SessionTableSeeder');
		$this->call ('TracksTableSeeder');
		$this->call ('SlotsTableSeeder');
		$this->call ('UserTableSeeder');
		$this->call ('BookingsTableSeeder');
	}
}