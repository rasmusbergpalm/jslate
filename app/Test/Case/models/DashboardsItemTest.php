<?php
/* DashboardsItem Test cases generated on: 2011-08-18 17:38:18 : 1313681898*/
App::import('Model', 'DashboardsItem');

class DashboardsItemTest extends CakeTestCase {
	var $fixtures = array('app.dashboards_item', 'app.dashboard', 'app.item');

	function startTest() {
		$this->DashboardsItem =& ClassRegistry::init('DashboardsItem');
	}

	function endTest() {
		unset($this->DashboardsItem);
		ClassRegistry::flush();
	}

}
