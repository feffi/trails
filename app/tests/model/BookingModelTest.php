<?php
use Illuminate\Foundation\Testing\TestCase;
use Trails\Models\Booking;
use Trails\Models\User;

class BookingModelTest extends TestCase {

	/**
	 * Define seeder dependencies for tests.
	 */
	private $seedDependency = array (
		'testInheritance' => array (),
		'testProperty' => array (),
		'testGetAll' => array (
			'BookingsTableSeeder'
		),
		'testFind' => array (
			'BookingsTableSeeder'
		),
		'testSave' => array (
			'BookingsTableSeeder'
		),
		'testUpdate' => array (
			'BookingsTableSeeder'
		),
		'testDelete' => array (
			'BookingsTableSeeder'
		),
		'testUser' => array (
			'BookingsTableSeeder',
			'UsersTableSeeder'
		),
		'testTrack' => array (
			'BookingsTableSeeder',
			'TracksTableSeeder'
		)
	);

	/**
	 * Creates the application environment.
	 *
	 * @return Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication() {
		$unitTesting = true;
		$testEnvironment = 'testing';
		return require __DIR__ . '/../../../bootstrap/start.php';
	}

	/**
	 * Prepare test environment.
	 *
	 * @see \Illuminate\Foundation\Testing\TestCase::setUp()
	 */
	public function setUp() {
		parent::setUp ();
		foreach ($this->seedDependency [$this->getName ()] as $seeder) {
			$this->seed ($seeder);
		}
	}

	/**
	 * @test
	 * @large
	 */
	public function testInheritance() {
		$assert = new Booking ();
		$this->assertInstanceOf ('Trails\Models\Booking', $assert);
		$this->assertInstanceOf ('Eloquent', $assert);
	}

	/**
	 * @test
	 * @large
	 */
	public function testProperty() {
		$assert = new Booking ();
		$this->assertClassHasAttribute ('table', 'Trails\Models\Booking');
		$this->assertAttributeEquals ('bookings', 'table', $assert);
	}

	/**
	 * @test
	 * @large
	 */
	public function testGetAll() {
		$assert = Booking::all ();
		$this->assertInstanceOf ('Illuminate\Database\Eloquent\Collection', $assert);
		$this->assertEquals (5, $assert->count ());
	}

	/**
	 * @test
	 * @large
	 */
	public function testFind() {
		$assert = Booking::find (1);
		$this->assertEquals (1, $assert->id);
		$this->assertEquals (1, $assert->user_id);
		$this->assertEquals (3, $assert->track_id);
	}

	/**
	 * @test
	 * @large
	 */
	public function testSave() {
		$this->assertEquals (5, Booking::count ());
		$booking = new Booking ();
		$booking->user_id = 2;
		$booking->track_id = 3;
		$booking->save ();
		$this->assertEquals (6, Booking::count ());
		$assert = Booking::find (6);
		$this->assertEquals (6, $assert->id);
		$this->assertEquals (2, $assert->user_id);
		$this->assertEquals (3, $assert->track_id);
	}

	/**
	 * @test
	 * @large
	 */
	public function testUpdate() {
		$this->assertEquals (5, Booking::count ());
		$assert = Booking::find (1);
		$this->assertEquals (1, $assert->id);
		$this->assertEquals (1, $assert->user_id);
		$this->assertEquals (3, $assert->track_id);

		$assert->user_id = 2;
		$assert->track_id = 2;
		$assert->save ();
		unset ($assert);

		$this->assertEquals (5, Booking::count ());
		$assert = Booking::find (1);
		$this->assertEquals (1, $assert->id);
		$this->assertEquals (2, $assert->user_id);
		$this->assertEquals (2, $assert->track_id);
	}

	/**
	 * @test
	 * @large
	 */
	public function testDelete() {
		$this->assertEquals (5, Booking::count ());
		$assert = Booking::find (1);
		$assert->delete ();
		$this->assertEquals (4, Booking::count ());
		unset ($assert);
		$assert = Booking::find (1);
		$this->assertNull ($assert);
	}

	/**
	 * @test
	 * @large
	 */
	public function testUser() {
		$booking = Booking::find (1);
		$assert = $booking->user;
		$this->assertInstanceOf ('Trails\Models\User', $assert);
		$this->assertEquals (1, $assert->id);
		$this->assertEquals ('Kevin', $assert->firstname);
		$this->assertEquals ('Wennemuth', $assert->lastname);
		$this->assertEquals ('feffi', $assert->username);
		$this->assertEquals ('feffi@feffi.org', $assert->email);
		$this->assertTrue (Hash::check ('test', $assert->password));

		$booking = Booking::find (4);
		$assert = $booking->user;
		$this->assertInstanceOf ('Trails\Models\User', $assert);
		$this->assertEquals (2, $assert->id);
		$this->assertEquals ('John', $assert->firstname);
		$this->assertEquals ('Tester', $assert->lastname);
		$this->assertEquals ('john', $assert->username);
		$this->assertEquals ('john@feffi.org', $assert->email);
		$this->assertTrue (Hash::check ('john', $assert->password));
	}

	/**
	 * @test
	 * @large
	 */
	public function testTrack() {
		$booking = Booking::find (1);
		$assert = $booking->track;
		$this->assertInstanceOf ('Trails\Models\Track', $assert);
		$this->assertEquals (3, $assert->id);
		$this->assertEquals ('A planned session', $assert->name);
		$this->assertEquals (TrackStatus::PLANNED, $assert->status);
		$this->assertEquals ('Very very planned!', $assert->description);
	}
}