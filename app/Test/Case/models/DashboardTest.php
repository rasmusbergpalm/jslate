<?php
/* Dashboard Test cases generated on: 2011-08-18 17:38:10 : 1313681890*/
App::import('Model', 'Dashboard');

class DashboardTest extends CakeTestCase {
	var $fixtures = array('app.dashboard', 'app.item', 'app.dashboards_item');

	function startTest() {
		$this->Dashboard =& ClassRegistry::init('Dashboard');
	}

	function endTest() {
		unset($this->Dashboard);
		ClassRegistry::flush();
	}

}
