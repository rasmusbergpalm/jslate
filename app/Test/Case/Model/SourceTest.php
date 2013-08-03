<?php
App::uses('Source', 'Model');

/**
 * Source Test Case
 *
 */
class SourceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.source',
		'app.sourceproperty'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Source = ClassRegistry::init('Source');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Source);

		parent::tearDown();
	}

}
