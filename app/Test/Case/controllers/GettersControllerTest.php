<?php
/* Getters Test cases generated on: 2011-07-23 13:20:24 : 1311420024*/
App::import('Controller', 'Getters');

class TestGettersController extends GettersController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class GettersControllerTest extends CakeTestCase {
	var $fixtures = array('app.getter');

	function startTest() {
		$this->Getters =& new TestGettersController();
		$this->Getters->constructClasses();
	}

	function endTest() {
		unset($this->Getters);
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
