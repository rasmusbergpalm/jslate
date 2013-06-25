<?php
/* Dbviews Test cases generated on: 2011-08-20 21:28:58 : 1313868538*/
App::import('Controller', 'Dbviews');

class TestDbviewsController extends DbviewsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DbviewsControllerTest extends CakeTestCase {
	var $fixtures = array('app.dbview', 'app.dashboard');

	function startTest() {
		$this->Dbviews =& new TestDbviewsController();
		$this->Dbviews->constructClasses();
	}

	function endTest() {
		unset($this->Dbviews);
		ClassRegistry::flush();
	}

}
