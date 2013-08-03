<?php
App::uses('Sourceproperty', 'Model');

/**
 * Sourceproperty Test Case
 *
 */
class SourcepropertyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sourceproperty',
		'app.source'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Sourceproperty = ClassRegistry::init('Sourceproperty');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Sourceproperty);

		parent::tearDown();
	}

}
