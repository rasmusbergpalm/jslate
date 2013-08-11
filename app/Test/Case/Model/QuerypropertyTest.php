<?php
App::uses('Queryproperty', 'Model');

/**
 * Queryproperty Test Case
 *
 */
class QuerypropertyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.queryproperty',
		'app.query',
		'app.source',
		'app.sourceproperty',
		'app.widget',
		'app.dashboard'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Queryproperty = ClassRegistry::init('Queryproperty');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Queryproperty);

		parent::tearDown();
	}

}
