<?php
App::uses('DashboardsController', 'Controller');

/**
 * DashboardsController Test Case
 *
 */
class DashboardsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.dashboard',
		'app.dbview',
        'app.user'
	);

    public $user;

    public function user(){
        $args = func_get_args();
        if($args[0] == null){
            return $this->user;
        }else{
            return $this->user[$args[0]];
        }
    }

    public function setUp(){
        parent::setUp();
        $this->user = array(
            'id' => 1,
            'email' => 'test@test.com'
        );
        $this->controller = $this->generate('Dashboards', array('components' => array('Auth' => array('user'))));
        $this->controller->Auth->staticExpects($this->any())->method('user')->will($this->returnCallback(array($this, 'user')));
    }


/**
 * testIndex method
 *
 * @return void
 */
	public function testIndexRedirectsToFirstDashboard() {
        $this->testAction('/dashboards/index');
        $this->assertContains('dashboards/view/1', $this->headers['Location']);
	}

    public function testIfUserHasNoDashboardsIndexCreatesFirstDashboardAndRedirectsToView(){
        $this->user = array('id'=>2, 'email'=>'test2@test.com');
        $this->testAction('/dashboards/index');
        $this->assertContains('dashboards/view/3', $this->headers['Location']);
    }

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
	}

}
