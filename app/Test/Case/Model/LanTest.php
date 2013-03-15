<?php
App::uses('Lan', 'Model');

/**
 * Lan Test Case
 *
 */
class LanTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.lan',
		'app.tournament'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Lan = ClassRegistry::init('Lan');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Lan);

		parent::tearDown();
	}

}
