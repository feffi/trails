<?php
use Illuminate\Foundation\Testing\TestCase;
use Trails\Models\Slot;
use Trails\Models\Session;
use Trails\Models\Track;

class SlotModelTest extends TestCase {

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
		$assert = new Slot ();
		$this->assertInstanceOf ('Trails\Models\Slot', $assert);
		$this->assertInstanceOf ('Eloquent', $assert);
	}

	/**
	 * @test
	 * @small
	 */
	public function testProperty() {
		$assert = new Slot ();
		$this->assertClassHasAttribute ('table', 'Trails\Models\Slot');
		$this->assertAttributeEquals ('slots', 'table', $assert);
	}

	/**
	 * @test
	 * @small
	 */
	public function testGetAll() {
		$assert = Slot::all ();
		$this->assertInstanceOf ('Illuminate\Database\Eloquent\Collection', $assert);
		$this->assertEquals (6, $assert->count ());
	}

	/**
	 * @test
	 * @small
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
	 * @small
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
	 * @small
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
	 * @small
	 */
	public function testDelete() {
		$this->fail ('TODO');
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