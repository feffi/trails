<?php
use Illuminate\Foundation\Testing\TestCase;

class BaseRouteTest extends TestCase {

	/**
	 * Creates the application.
	 *
	 * @return Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication() {
		$unitTesting = true;
		$testEnvironment = 'testing';
		return require __DIR__ . '/../../bootstrap/start.php';
	}

	/**
	 * @test
	 */
	public function testBaseRoute() {
		$crawler = $this->client->request ( 'GET', '/' );
		$this->assertTrue ( $this->client->getResponse ()->isOk () );
	}
}