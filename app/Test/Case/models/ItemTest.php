<?php
/* Item Test cases generated on: 2011-08-18 17:38:22 : 1313681902*/
App::import('Model', 'Item');

class ItemTest extends CakeTestCase {
	var $fixtures = array('app.item', 'app.dashboard', 'app.dashboards_item');

	function startTest() {
		$this->Item =& ClassRegistry::init('Item');
	}

	function endTest() {
		unset($this->Item);
		ClassRegistry::flush();
	}

}
