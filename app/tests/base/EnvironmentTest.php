<?php

use Illuminate\Foundation\Testing\TestCase;

class EnvironmentTest extends TestCase {
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

	/**
	 * @test
	 */
	public function testPhpVersion() {
		$version = phpversion();
		$assert = version_compare($version, '5.5.0', '>=');
		$this->assertTrue($assert);
	}

	/**
	 * @test
	 */
	public function testPhpModules() {
		$this->assertEquals(MCRYPT_DECRYPT, intval(1));
		$this->assertEquals(MCRYPT_ENCRYPT, intval(0));
	}
}