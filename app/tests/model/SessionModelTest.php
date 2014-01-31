<?php
use Illuminate\Foundation\Testing\TestCase;
use Trails\Models\Track;
use Trails\Models\Slot;
use Trails\Models\Session;

class SessionModelTest extends TestCase {

	/**
	 * Creates the application.
	 *
	 * @return Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication() {
		$unitTesting = true;
		$testEnvironment = 'testing';
		return require __DIR__ . '/../../../bootstrap/start.php';
	}

	public function setUp() {
		$app = $this->createApplication ();
		$app->make ('artisan')->call ('migrate:reset', array (
			'--quiet' => true
		));
		$app->make ('artisan')->call ('migrate', array (
			'--seed' => true,
			'--quiet' => true
		));
		parent::setUp ();
	}

	/**
	 * @test
	 * @small
	 */
	public function testInheritance() {
		$assert = new Session ();
		$this->assertInstanceOf ('Trails\Models\Session', $assert);
		$this->assertInstanceOf ('Eloquent', $assert);
	}

	/**
	 * @test
	 * @small
	 */
	public function testProperty() {
		$assert = new Session ();
		$this->assertClassHasAttribute ('table', 'Trails\Models\Session');
		$this->assertAttributeEquals ('sessions', 'table', $assert);
	}

	/**
	 * @test
	 * @small
	 */
	public function testGetAll() {
		$assert = Session::all ();
		$this->assertInstanceOf ('Illuminate\Database\Eloquent\Collection', $assert);
		$this->assertEquals (2, $assert->count ());
	}

	/**
	 * @test
	 * @small
	 */
	public function testFind() {
		$assert = Session::find (1);
		$this->assertEquals (1, $assert->id);
		$this->assertEquals ('2014-01-01', $assert->from);
		$this->assertEquals ('2014-01-01', $assert->to);
		$this->assertEquals (SessionStatus::PENDING, $assert->status);
		$this->assertEquals ('A day to dwell.', $assert->description);
	}

	/**
	 * @test
	 * @small
	 */
	public function testSave() {
		$this->assertEquals (2, Session::count ());
		$session = new Session ();
		$session->from = '2014-01-05';
		$session->to = '2014-01-06';
		$session->status = SessionStatus::HELD;
		$session->description = 'a very new description';
		$session->save ();
		$this->assertEquals (3, Session::count ());
		$assert = Session::find (3);
		$this->assertEquals (3, $assert->id);
		$this->assertEquals ('2014-01-05', $assert->from);
		$this->assertEquals ('2014-01-06', $assert->to);
		$this->assertEquals (SessionStatus::HELD, $assert->status);
		$this->assertEquals ('a very new description', $assert->description);
	}

	/**
	 * @test
	 * @small
	 */
	public function testUpdate() {
		$this->assertEquals (2, Session::count ());
		$assert = Session::find (1);
		$this->assertEquals (1, $assert->id);
		$this->assertEquals ('2014-01-01', $assert->from);
		$this->assertEquals ('2014-01-01', $assert->to);
		$this->assertEquals (SessionStatus::PENDING, $assert->status);
		$this->assertEquals ('A day to dwell.', $assert->description);

		$assert->from = '2014-01-05';
		$assert->to = '2014-01-06';
		$assert->status = SessionStatus::HELD;
		$assert->description = 'A day to dwell more.';
		$assert->save ();
		unset ($assert);

		$this->assertEquals (2, Session::count ());
		$assert = Session::find (1);
		$this->assertEquals (1, $assert->id);
		$this->assertEquals ('2014-01-05', $assert->from);
		$this->assertEquals ('2014-01-06', $assert->to);
		$this->assertEquals (SessionStatus::HELD, $assert->status);
		$this->assertEquals ('A day to dwell more.', $assert->description);
	}

	/**
	 * @test
	 * @small
	 */
	public function testDelete() {
		$this->fail ('TODO');
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
		$session = Session::find (1);
		$users = $session->users;
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
	public function testTracks() {
		$session = Session::find (1);
		$tracks = $session->tracks;
		$this->assertInstanceOf ('Illuminate\Database\Eloquent\Collection', $tracks);
		$this->assertEquals (3, $tracks->count ());

		$assert = $tracks [0];
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

		$assert = $tracks [2];
		$this->assertInstanceOf ('Trails\Models\Track', $assert);
		$this->assertEquals (2, $assert->id);
		$this->assertEquals ('Another very important session', $assert->name);
		$this->assertEquals (TrackStatus::PLANNED, $assert->status);
		$this->assertEquals ('Very very important!', $assert->description);
		unset ($assert);
	}

	/**
	 * @test
	 * @large
	 */
	public function testSlots() {
		$session = Session::find (1);
		$slots = $session->slots;
		$this->assertInstanceOf ('Illuminate\Database\Eloquent\Collection', $slots);
		$this->assertEquals (3, $slots->count ());

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
		$this->assertEquals (5, $assert->id);
		$this->assertEquals (1, $assert->session_id);
		$this->assertEquals (2, $assert->track_id);
		$this->assertEquals ('2014-01-01 00:00:00', $assert->from);
		$this->assertEquals ('2014-01-01 01:00:00', $assert->to);
		unset ($assert);

		$assert = $slots [2];
		$this->assertInstanceOf ('Trails\Models\Slot', $assert);
		$this->assertEquals (6, $assert->id);
		$this->assertEquals (1, $assert->session_id);
		$this->assertEquals (2, $assert->track_id);
		$this->assertEquals ('2014-01-01 01:00:00', $assert->from);
		$this->assertEquals ('2014-01-01 02:00:00', $assert->to);
	}
}