<?php
/* Getter Test cases generated on: 2011-07-23 13:20:12 : 1311420012*/
App::import('Model', 'Getter');

class GetterTest extends CakeTestCase {
	var $fixtures = array('app.getter');

	function startTest() {
		$this->Getter =& ClassRegistry::init('Getter');
	}

	function endTest() {
		unset($this->Getter);
		ClassRegistry::flush();
	}

}
