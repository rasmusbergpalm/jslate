<?php
App::uses('Datasource', 'Model');

/**
 * Datasource Test Case
 *
 */
class DatasourceTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Datasource = ClassRegistry::init('Datasource');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Datasource);

		parent::tearDown();
	}

/**
 * testListSources method
 *
 * @return void
 */
	public function testListSources() {
	}

/**
 * testDescribe method
 *
 * @return void
 */
	public function testDescribe() {
	}

/**
 * testBegin method
 *
 * @return void
 */
	public function testBegin() {
	}

/**
 * testCommit method
 *
 * @return void
 */
	public function testCommit() {
	}

/**
 * testRollback method
 *
 * @return void
 */
	public function testRollback() {
	}

/**
 * testColumn method
 *
 * @return void
 */
	public function testColumn() {
	}

/**
 * testCreate method
 *
 * @return void
 */
	public function testCreate() {
	}

/**
 * testRead method
 *
 * @return void
 */
	public function testRead() {
	}

/**
 * testUpdate method
 *
 * @return void
 */
	public function testUpdate() {
	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
	}

/**
 * testLastInsertId method
 *
 * @return void
 */
	public function testLastInsertId() {
	}

/**
 * testLastNumRows method
 *
 * @return void
 */
	public function testLastNumRows() {
	}

/**
 * testLastAffected method
 *
 * @return void
 */
	public function testLastAffected() {
	}

/**
 * testEnabled method
 *
 * @return void
 */
	public function testEnabled() {
	}

/**
 * testSetConfig method
 *
 * @return void
 */
	public function testSetConfig() {
	}

/**
 * testInsertQueryData method
 *
 * @return void
 */
	public function testInsertQueryData() {
	}

/**
 * testResolveKey method
 *
 * @return void
 */
	public function testResolveKey() {
	}

/**
 * testGetSchemaName method
 *
 * @return void
 */
	public function testGetSchemaName() {
	}

/**
 * testClose method
 *
 * @return void
 */
	public function testClose() {
	}

}
