<?php
/* Dashboards Test cases generated on: 2011-08-18 17:38:12 : 1313681892*/
App::import('Controller', 'Dashboards');

class TestDashboardsController extends DashboardsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DashboardsControllerTest extends CakeTestCase {
	var $fixtures = array('app.dashboard', 'app.item', 'app.dashboards_item');

	function startTest() {
		$this->Dashboards =& new TestDashboardsController();
		$this->Dashboards->constructClasses();
	}

	function endTest() {
		unset($this->Dashboards);
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
