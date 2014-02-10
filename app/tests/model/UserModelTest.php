<?php
use Illuminate\Foundation\Testing\TestCase;
use Trails\Models\User;
use Illuminate\Support\Facades\DB;

class UserModelTest extends TestCase {

	/**
	 * Define seeder dependencies for tests.
	 */
	private $seedDependency = array (
		'testInheritance' => array (),
		'testProperty' => array (),
		'testGetAll' => array (
			'UsersTableSeeder'
		),
		'testFind' => array (
			'UsersTableSeeder'
		),
		'testSave' => array (
			'UsersTableSeeder'
		),
		'testUpdate' => array (
			'UsersTableSeeder'
		),
		'testDelete' => array (
			'UsersTableSeeder'
		),
		'testTracks' => array (
			'UsersTableSeeder',
			'TracksTableSeeder',
			'SlotsTableSeeder'
		),
		'testSlots' => array (
			'UsersTableSeeder',
			'SlotsTableSeeder'
		),
		'testSessions' => array (
			'UsersTableSeeder',
			'TracksTableSeeder',
			'SlotsTableSeeder',
			'SessionsTableSeeder'
		),
		'testBookings' => array (
			'TracksTableSeeder',
			'UsersTableSeeder',
			'BookingsTableSeeder'
		),
		'testHasTracks' => array (
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
		$assert = new User ();
		$this->assertInstanceOf ('Trails\Models\User', $assert);
		$this->assertInstanceOf ('Eloquent', $assert);
	}

	/**
	 * @test
	 * @large
	 */
	public function testProperty() {
		$assert = new User ();
		$this->assertClassHasAttribute ('table', 'Trails\Models\User');
		$this->assertAttributeEquals ('users', 'table', $assert);
	}

	/**
	 * @test
	 * @large
	 */
	public function testGetAll() {
		$users = User::all ();
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
	public function testFind() {
		$assert = User::find (1);
		$this->assertEquals (1, $assert->id);
		$this->assertEquals ('Kevin', $assert->firstname);
		$this->assertEquals ('Wennemuth', $assert->lastname);
		$this->assertEquals ('feffi', $assert->username);
		$this->assertEquals ('feffi@feffi.org', $assert->email);
		$this->assertTrue (Hash::check ('test', $assert->password));
	}

	/**
	 * @test
	 * @large
	 */
	public function testSave() {
		$this->assertEquals (2, User::count ());
		$user = new User ();
		$user->firstname = 'Jane';
		$user->lastname = 'Do';
		$user->username = 'JaneDo';
		$user->email = 'JaneDo@feffi.org';
		$user->password = Hash::make ('JD1337');
		$user->save ();
		$this->assertEquals (3, User::count ());
		$assert = User::find (3);
		$this->assertEquals (3, $assert->id);
		$this->assertEquals ('Jane', $assert->firstname);
		$this->assertEquals ('Do', $assert->lastname);
		$this->assertEquals ('JaneDo', $assert->username);
		$this->assertEquals ('JaneDo@feffi.org', $assert->email);
		$this->assertTrue (Hash::check ('JD1337', $assert->password));
	}

	/**
	 * @test
	 * @large
	 */
	public function testUpdate() {
		$this->assertEquals (2, User::count ());
		$assert = User::find (1);
		$this->assertEquals (1, $assert->id);
		$this->assertEquals ('Kevin', $assert->firstname);
		$this->assertEquals ('Wennemuth', $assert->lastname);
		$this->assertEquals ('feffi', $assert->username);
		$this->assertEquals ('feffi@feffi.org', $assert->email);
		$this->assertTrue (Hash::check ('test', $assert->password));

		$assert->firstname = 'Bob';
		$assert->lastname = 'Do';
		$assert->username = 'BobDo';
		$assert->email = 'BobDo@feffi.org';
		$assert->password = Hash::make ('JD1338');
		$assert->save ();
		unset ($assert);

		$this->assertEquals (2, User::count ());
		$assert = User::find (1);
		$this->assertEquals (1, $assert->id);
		$this->assertEquals ('Bob', $assert->firstname);
		$this->assertEquals ('Do', $assert->lastname);
		$this->assertEquals ('BobDo', $assert->username);
		$this->assertEquals ('BobDo@feffi.org', $assert->email);
		$this->assertTrue (Hash::check ('JD1338', $assert->password));
	}

	/**
	 * @test
	 * @large
	 */
	public function testDelete() {
		$this->assertEquals (2, User::count ());
		$assert = User::find (1);
		$assert->delete ();
		$this->assertEquals (1, User::count ());
		unset ($assert);
		$assert = User::find (1);
		$this->assertNull ($assert);
	}

	/**
	 * @test
	 * @large
	 */
	public function testTracks() {
		$user = User::find (1);
		$tracks = $user->tracks;
		$this->assertInstanceOf ('Illuminate\Database\Eloquent\Collection', $tracks);
		$this->assertEquals (3, $tracks->count ());

		$assert = $tracks [2];
		$this->assertInstanceOf ('Trails\Models\Track', $assert);
		$this->assertEquals (1, $assert->id);
		$this->assertEquals ('git at it\'s best', $assert->name);
		$this->assertEquals (TrackStatus::PENDING, $assert->status);
		$this->assertEquals ('A little course for all n3wbs on how to use git.', $assert->description);
		unset ($assert);

		$assert = $tracks [1];
		$this->assertInstanceOf ('Trails\Models\Track', $assert);
		$this->assertEquals (2, $assert->id);
		$this->assertEquals ('Another very important session', $assert->name);
		$this->assertEquals (TrackStatus::PLANNED, $assert->status);
		$this->assertEquals ('Very very important!', $assert->description);
		unset ($assert);

		$assert = $tracks [0];
		$this->assertInstanceOf ('Trails\Models\Track', $assert);
		$this->assertEquals (3, $assert->id);
		$this->assertEquals ('A planned session', $assert->name);
		$this->assertEquals (TrackStatus::PLANNED, $assert->status);
		$this->assertEquals ('Very very planned!', $assert->description);
		unset ($assert);
	}

	/**
	 * @test
	 * @large
	 */
	public function testSlots() {
		$user = User::find (2);
		$slots = $user->getSlots ();

		$this->assertInstanceOf ('Illuminate\Database\Eloquent\Collection', $slots);
		$this->assertEquals (4, $slots->count ());

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

		$assert = $slots [2];
		$this->assertInstanceOf ('Trails\Models\Slot', $assert);
		$this->assertEquals (5, $assert->id);
		$this->assertEquals (1, $assert->session_id);
		$this->assertEquals (2, $assert->track_id);
		$this->assertEquals ('2014-01-01 00:00:00', $assert->from);
		$this->assertEquals ('2014-01-01 01:00:00', $assert->to);

		$assert = $slots [3];
		$this->assertInstanceOf ('Trails\Models\Slot', $assert);
		$this->assertEquals (6, $assert->id);
		$this->assertEquals (1, $assert->session_id);
		$this->assertEquals (2, $assert->track_id);
		$this->assertEquals ('2014-01-01 01:00:00', $assert->from);
		$this->assertEquals ('2014-01-01 02:00:00', $assert->to);
	}

	/**
	 * @test
	 * @large
	 */
	public function testSessions() {
		$user = User::find (2);
		$sessions = $user->getSessions ();
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
	public function testBookings() {
		$user = User::find (1);
		$bookings = $user->bookings;
		$this->assertInstanceOf ('Illuminate\Database\Eloquent\Collection', $bookings);
		$this->assertEquals (3, $bookings->count ());

		$assert = $bookings [0];
		$this->assertEquals (1, $assert->id);
		$this->assertEquals (1, $assert->user_id);
		$this->assertEquals (3, $assert->track_id);

		$assert = $bookings [1];
		$this->assertEquals (2, $assert->id);
		$this->assertEquals (1, $assert->user_id);
		$this->assertEquals (2, $assert->track_id);

		$assert = $bookings [2];
		$this->assertEquals (3, $assert->id);
		$this->assertEquals (1, $assert->user_id);
		$this->assertEquals (1, $assert->track_id);
	}

	/**
	 * @test
	 * @large
	 */
	public function testHasTracks() {
		$user = User::find (2);
		$this->assertTrue ($user->hasTracks (array (
			1,
			2
		)));
		$this->assertFalse ($user->hasTracks (array (
			3
		)));
		$this->assertFalse ($user->hasTracks (array (
			1,
			3
		)));
		$this->assertFalse ($user->hasTracks (array (
			2,
			3
		)));
		$this->assertFalse ($user->hasTracks (array (
			1,
			2,
			3
		)));
		$this->assertFalse ($user->hasTracks (array ()));
	}
}