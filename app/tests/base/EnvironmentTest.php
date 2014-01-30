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
		$this->assertTrue(true);
	}

	/**
	 * @test
	 */
	public function testPhpModules() {
		$this->assertTrue(true);
	}

	/**
	 * @test
	 */
	public function testEnvironmentVariables() {
		$this->assertTrue(true);
	}
}