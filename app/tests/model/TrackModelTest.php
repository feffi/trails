<?php
use Illuminate\Foundation\Testing\TestCase;
use Trails\Models\Track;
use Trails\Models\Slot;

class TrackModelTest extends TestCase {

	/**
	 * Define seeder dependencies for tests.
	 */
	private $seedDependency = array (
		'testInheritance' => array (),
		'testProperty' => array (),
		'testGetAll' => array (
			'TracksTableSeeder'
		),
		'testFind' => array (
			'TracksTableSeeder'
		),
		'testSave' => array (
			'TracksTableSeeder'
		),
		'testUpdate' => array (
			'TracksTableSeeder'
		),
		'testDelete' => array (
			'TracksTableSeeder'
		),
		'testUsers' => array (
			'TracksTableSeeder',
			'UsersTableSeeder',
			'BookingsTableSeeder'
		),
		'testSessions' => array (
			'TracksTableSeeder',
			'SlotsTableSeeder',
			'SessionsTableSeeder'
		),
		'testSlots' => array (
			'TracksTableSeeder',
			'SlotsTableSeeder'
		),
		'testBookings' => array (
			'TracksTableSeeder',
			'UsersTableSeeder',
			'BookingsTableSeeder'
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
		$assert = new Track ();
		$this->assertInstanceOf ('Trails\Models\Track', $assert);
		$this->assertInstanceOf ('Eloquent', $assert);
	}

	/**
	 * @test
	 * @large
	 */
	public function testProperty() {
		$assert = new Track ();
		$this->assertClassHasAttribute ('table', 'Trails\Models\Track');
		$this->assertAttributeEquals ('tracks', 'table', $assert);
	}

	/**
	 * @test
	 * @large
	 */
	public function testGetAll() {
		$assert = Track::all ();
		$this->assertInstanceOf ('Illuminate\Database\Eloquent\Collection', $assert);
		$this->assertEquals (3, $assert->count ());
	}

	/**
	 * @test
	 * @large
	 */
	public function testFind() {
		$assert = Track::find (1);
		$this->assertEquals (1, $assert->id);
		$this->assertEquals ('git at it\'s best', $assert->name);
		$this->assertEquals (TrackStatus::PENDING, $assert->status);
		$this->assertEquals ('A little course for all n3wbs on how to use git.', $assert->description);
	}

	/**
	 * @test
	 * @large
	 */
	public function testSave() {
		$this->assertEquals (3, Track::count ());
		$track = new Track ();
		$track->name = 'new name';
		$track->status = TrackStatus::HELD;
		$track->description = 'a very new description';
		$track->save ();
		$this->assertEquals (4, Track::count ());
		$assert = Track::find (4);
		$this->assertEquals (4, $assert->id);
		$this->assertEquals ('new name', $assert->name);
		$this->assertEquals (TrackStatus::HELD, $assert->status);
		$this->assertEquals ('a very new description', $assert->description);
	}

	/**
	 * @test
	 * @large
	 */
	public function testUpdate() {
		$this->assertEquals (3, Track::count ());
		$assert = Track::find (1);
		$this->assertEquals (1, $assert->id);
		$this->assertEquals ('git at it\'s best', $assert->name);
		$this->assertEquals (TrackStatus::PENDING, $assert->status);
		$this->assertEquals ('A little course for all n3wbs on how to use git.', $assert->description);

		$assert->name = 'new name';
		$assert->status = TrackStatus::HELD;
		$assert->description = 'a very new description';
		$assert->save ();
		unset ($assert);

		$this->assertEquals (3, Track::count ());
		$assert = Track::find (1);
		$this->assertEquals (1, $assert->id);
		$this->assertEquals ('new name', $assert->name);
		$this->assertEquals (TrackStatus::HELD, $assert->status);
		$this->assertEquals ('a very new description', $assert->description);
	}

	/**
	 * @test
	 * @large
	 */
	public function testDelete() {
		$this->assertEquals (3, Track::count ());
		$assert = Track::find (1);
		$assert->delete ();
		$this->assertEquals (2, Track::count ());
		unset ($assert);
		$assert = Track::find (1);
		$this->assertNull ($assert);
	}

	/**
	 * @test
	 * @large
	 */
	public function testUsers() {
		$track = Track::find (1);
		$users = $track->users;
		$this->assertInstanceOf ('Illuminate\Database\Eloquent\Collection', $users);
		$this->assertEquals (2, $users->count ());

		$assert = $users [0];
		$this->assertInstanceOf ('Trails\Models\User', $assert);
		$this->assertEquals (1, $assert->id);
		$this->assertEquals ('Kevin', $assert->firstname);
		$this->assertEquals ('Wennemuth', $assert->lastname);
		$this->assertEquals ('feffi', $assert->username);
		$this->assertEquals ('feffi@feffi.org', $assert->email);
		$this->assertTrue (Hash::check ('test', $assert->password));
		unset ($assert);

		$assert = $users [1];
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
	public function testSessions() {
		$track = Track::find (1);
		$sessions = $track->sessions;
		$this->assertInstanceOf ('Illuminate\Database\Eloquent\Collection', $sessions);
		$this->assertEquals (2, $sessions->count ());

		$assert = $sessions [0];
		$this->assertInstanceOf ('Trails\Models\Session', $assert);
		$this->assertEquals (1, $assert->id);
		$this->assertEquals ('2014-01-01', $assert->from);
		$this->assertEquals ('2014-01-01', $assert->to);
		$this->assertEquals (SessionStatus::PENDING, $assert->status);
		$this->assertEquals ('A day to dwell.', $assert->description);
		unset ($assert);

		$assert = $sessions [1];
		$this->assertInstanceOf ('Trails\Models\Session', $assert);
		$this->assertEquals (2, $assert->id);
		$this->assertEquals ('2014-01-02', $assert->from);
		$this->assertEquals ('2014-01-02', $assert->to);
		$this->assertEquals (SessionStatus::PLANNED, $assert->status);
		$this->assertEquals ('A day to remember.', $assert->description);
	}

	/**
	 * @test
	 * @large
	 */
	public function testSlots() {
		$track = Track::find (1);
		$slots = $track->slots;
		$this->assertInstanceOf ('Illuminate\Database\Eloquent\Collection', $slots);
		$this->assertEquals (2, $slots->count ());

		$assert = $slots [0];
		$this->assertInstanceOf ('Trails\Models\Slot', $assert);
		$this->assertEquals (1, $assert->id);
		$this->assertEquals (1, $assert->session_id);
		$this->assertEquals (1, $assert->track_id);
		$this->assertEquals ('2014-01-01 00:00:00', $assert->from);
		$this->assertEquals ('2014-01-01 01:00:00', $assert->to);
		unset ($assert);

		$assert = $slots [1];
		$this->assertInstanceOf ('Trails\Models\Slot', $assert);
		$this->assertEquals (4, $assert->id);
		$this->assertEquals (2, $assert->session_id);
		$this->assertEquals (1, $assert->track_id);
		$this->assertEquals ('2014-01-01 02:00:00', $assert->from);
		$this->assertEquals ('2014-01-01 03:00:00', $assert->to);
	}

	/**
	 * @test
	 * @large
	 */
	public function testBookings() {
		$track = Track::find (1);
		$bookings = $track->bookings;
		$this->assertInstanceOf ('Illuminate\Database\Eloquent\Collection', $bookings);
		$this->assertEquals (2, $bookings->count ());

		$assert = $bookings [0];
		$this->assertEquals (3, $assert->id);
		$this->assertEquals (1, $assert->user_id);
		$this->assertEquals (1, $assert->track_id);

		$assert = $bookings [1];
		$this->assertEquals (4, $assert->id);
		$this->assertEquals (2, $assert->user_id);
		$this->assertEquals (1, $assert->track_id);
	}
}