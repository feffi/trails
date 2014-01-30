<?php
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Foundation\Testing\TestCase;
use Trails\Models\Booking;

class BookingRouteTest extends TestCase {

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
		Artisan::call ('migrate:reset', array (), new ConsoleOutput ());
		Artisan::call ('migrate', array (
			'--seed' => 'true'
		), new ConsoleOutput ());
		parent::setUp ();
	}

	/**
	 * @test
	 */
	public function testBookingRouteIndex() {
		$crawler = $this->client->request ('GET', '/booking');
		$this->assertTrue ($this->client->getResponse ()->isOk ());
	}

	/**
	 * @test
	 */
	public function testBookingRouteCreate() {
		$crawler = $this->client->request ('GET', '/booking/create');
		$this->assertTrue ($this->client->getResponse ()->isOk ());
	}

	/**
	 * @test
	 */
	public function testBookingRouteStore() {
		$booking = Booking::all ();
		$this->assertEquals (3, $booking->count ());
		$crawler = $this->client->request ('POST', '/booking', array (
			'user_id' => '2',
			'track_id' => '2'
		));
		$booking = Booking::find (4);
		$this->assertEquals (2, $booking->user_id);
		$this->assertEquals (2, $booking->track_id);
		$this->assertRedirectedTo ('booking');
	}

	/**
	 * @test
	 */
	public function testBookingRouteShow() {
		$crawler = $this->client->request ('GET', '/booking/1');
		$this->assertTrue ($this->client->getResponse ()->isOk ());
	}

	/**
	 * @test
	 */
	public function testBookingRouteEdit() {
		$crawler = $this->client->request ('GET', '/booking/1/edit');
		$this->assertTrue ($this->client->getResponse ()->isOk ());
	}

	/**
	 * @test
	 */
	public function testBookingRouteUpdate() {
		$booking = Booking::find (1);
		$this->assertEquals (1, $booking->user_id);
		$this->assertEquals (3, $booking->track_id);
		$crawler = $this->client->request ('PUT', '/booking/1', array (
			'user_id' => '2',
			'track_id' => '1'
		));
		$booking = Booking::find (1);
		$this->assertEquals ('2', $booking->user_id);
		$this->assertEquals ('1', $booking->track_id);
		$this->assertRedirectedTo ('booking');
	}

	/**
	 * @test
	 */
	public function testBookingRouteDestroy() {
		$booking = Booking::all ();
		$this->assertEquals (3, $booking->count ());
		$crawler = $this->client->request ('DELETE', '/booking/1');
		$booking = Booking::find (1);
		$this->assertNull($booking);
		$booking = Booking::all ();
		$this->assertEquals (2, $booking->count ());
		$this->assertRedirectedTo ('booking');
	}
}