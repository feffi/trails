<?php

use Illuminate\Foundation\Testing\TestCase;
use Trails\Models\Slot;
use Trails\Models\Session;
use Trails\Models\Track;

class SlotModelTest extends TestCase {

	/**
	 * Define seeder dependencies for tests.
	 */
	private $seedDependency = array (
		'testInheritance' => array (),
		'testProperty' => array (),
		'testGetAll' => array (
			'SlotsTableSeeder'
		),
		'testFind' => array (
			'SlotsTableSeeder'
		),
		'testSave' => array (
			'SlotsTableSeeder'
		),
		'testUpdate' => array (
			'SlotsTableSeeder'
		),
		'testDelete' => array (
			'SlotsTableSeeder'
		),
		'testSession' => array (
			'SlotsTableSeeder',
			'SessionsTableSeeder'
		),
		'testTrack' => array (
			'SlotsTableSeeder',
			'TracksTableSeeder'
		),
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
		$assert = new Slot ();
		$this->assertInstanceOf ('Trails\Models\Slot', $assert);
		$this->assertInstanceOf ('Eloquent', $assert);
	}

	/**
	 * @test
	 * @large
	 */
	public function testProperty() {
		$assert = new Slot ();
		$this->assertClassHasAttribute ('table', 'Trails\Models\Slot');
		$this->assertAttributeEquals ('slots', 'table', $assert);
	}

	/**
	 * @test
	 * @large
	 */
	public function testGetAll() {
		$assert = Slot::all ();
		$this->assertInstanceOf ('Illuminate\Database\Eloquent\Collection', $assert);
		$this->assertEquals (6, $assert->count ());
	}

	/**
	 * @test
	 * @large
	 */
	public function testFind() {
		$assert = Slot::find (1);
		$this->assertEquals (1, $assert->id);
		$this->assertEquals (1, $assert->session_id);
		$this->assertEquals (1, $assert->track_id);
		$this->assertEquals ('2014-01-01 00:00:00', $assert->from);
		$this->assertEquals ('2014-01-01 01:00:00', $assert->to);
	}

	/**
	 * @test
	 * @large
	 */
	public function testSave() {
		$this->assertEquals (6, Slot::count ());
		$booking = new Slot ();
		$booking->session_id = 2;
		$booking->track_id = 3;
		$booking->from = '2014-01-05 00:00:00';
		$booking->to = '2014-01-06 00:00:00';
		$booking->save ();

		$this->assertEquals (7, Slot::count ());
		$assert = Slot::find (7);
		$this->assertEquals (7, $assert->id);
		$this->assertEquals (2, $assert->session_id);
		$this->assertEquals (3, $assert->track_id);
		$this->assertEquals ('2014-01-05 00:00:00', $assert->from);
		$this->assertEquals ('2014-01-06 00:00:00', $assert->to);
	}

	/**
	 * @test
	 * @large
	 */
	public function testUpdate() {
		$this->assertEquals (6, Slot::count ());
		$assert = Slot::find (1);
		$this->assertEquals (1, $assert->id);
		$this->assertEquals (1, $assert->session_id);
		$this->assertEquals (1, $assert->track_id);
		$this->assertEquals ('2014-01-01 00:00:00', $assert->from);
		$this->assertEquals ('2014-01-01 01:00:00', $assert->to);

		$assert->session_id = 2;
		$assert->track_id = 2;
		$assert->from = '2014-01-05 00:00:00';
		$assert->to = '2014-01-06 00:00:00';
		$assert->save ();
		unset ($assert);

		$this->assertEquals (6, Slot::count ());
		$assert = Slot::find (1);
		$this->assertEquals (1, $assert->id);
		$this->assertEquals (2, $assert->session_id);
		$this->assertEquals (2, $assert->track_id);
		$this->assertEquals ('2014-01-05 00:00:00', $assert->from);
		$this->assertEquals ('2014-01-06 00:00:00', $assert->to);
	}

	/**
	 * @test
	 * @large
	 */
	public function testDelete() {
		$this->assertEquals (6, Slot::count ());
		$assert = Slot::find (1);
		$assert->delete ();
		$this->assertEquals (5, Slot::count ());
		unset ($assert);
		$assert = Slot::find (1);
		$this->assertNull ($assert);
	}

	/**
	 * @test
	 * @large
	 */
	public function testSession() {
		$slot = Slot::find (1);
		$assert = $slot->session;
		$this->assertInstanceOf ('Trails\Models\Session', $assert);
		$this->assertEquals (1, $assert->id);
		$this->assertEquals ('2014-01-01', $assert->from);
		$this->assertEquals ('2014-01-01', $assert->to);
		$this->assertEquals (SessionStatus::PENDING, $assert->status);
		$this->assertEquals ('A day to dwell.', $assert->description);
	}

	/**
	 * @test
	 * @large
	 */
	public function testTrack() {
		$slot = Slot::find (1);
		$assert = $slot->track;
		$this->assertInstanceOf ('Trails\Models\Track', $assert);
		$this->assertEquals (1, $assert->id);
		$this->assertEquals ('git at it\'s best', $assert->name);
		$this->assertEquals (TrackStatus::PENDING, $assert->status);
		$this->assertEquals ('A little course for all n3wbs on how to use git.', $assert->description);
	}
}