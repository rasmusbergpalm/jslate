<?php
/* DashboardsItems Test cases generated on: 2011-08-18 17:38:18 : 1313681898*/
App::import('Controller', 'DashboardsItems');

class TestDashboardsItemsController extends DashboardsItemsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DashboardsItemsControllerTest extends CakeTestCase {
	var $fixtures = array('app.dashboards_item', 'app.dashboard', 'app.item');

	function startTest() {
		$this->DashboardsItems =& new TestDashboardsItemsController();
		$this->DashboardsItems->constructClasses();
	}

	function endTest() {
		unset($this->DashboardsItems);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
