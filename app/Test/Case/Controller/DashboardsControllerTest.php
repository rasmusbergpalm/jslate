<?php
App::uses('DashboardsController', 'Controller');

/**
 * DashboardsController Test Case
 *
 */
require_once TESTS . 'AuthMocker.php';

class DashboardsControllerTest extends AuthMocker {
    public $fixtures = array('app.dashboard', 'app.dbview', 'app.user');

    var $name = 'Dashboards';
    var $mocks = array();

    public function testIndexRedirectsToFirstDashboardUserOwns() {
        $this->controller->Dashboard->save(array(
            'Dashboard' => array(
                'id' => 1,
                'name' => 'foo',
                'user_id' => 2
            )
        ));
        $this->controller->Dashboard->save(array(
            'Dashboard' => array(
                'id' => 2,
                'name' => 'bar',
                'user_id' => 1
            )
        ));
        $this->login(array('id' => 1, 'email' => 'foo'));
        $this->testAction('/dashboards/index');
        $this->assertContains('dashboards/view/2', $this->headers['Location']);
    }

    public function testIfUserHasNoDashboardsIndexCreatesDashboardAndRedirectsToView() {
        $this->login(array('id' => 1, 'email' => 'foo'));
        $this->testAction('/dashboards/index');
        $dashboard = $this->controller->Dashboard->find('first');
        $this->assertEqual('1', $dashboard['Dashboard']['id']);
        $this->assertEqual('1', $dashboard['Dashboard']['user_id']);
        $this->assertContains('dashboards/view/1', $this->headers['Location']);
    }

    public function testViewShowsDashboard() {
        $name = uniqid();
        $this->controller->Dashboard->save(array(
            'Dashboard' => array(
                'id' => 1,
                'name' => $name,
                'user_id' => 1
            )
        ));
        $this->login(array('id' => 1, 'email' => 'foo'));
        $vars = $this->testAction('/dashboards/view/1', array('return'=>'vars'));
        $this->assertEqual($name, $vars['dashboard']['Dashboard']['name']);
    }

    public function testViewRedirectToIndexIfUserAttemptsToSeeDashboardNotExistingOrNotHisOwn() {
        $this->controller->Dashboard->save(array(
            'Dashboard' => array(
                'id' => 1,
                'name' => uniqid(),
                'user_id' => 2
            )
        ));
        $this->login(array('id'=>1, 'email'=>'foo'));
        $this->testAction('/dashboards/view/2');
        $this->assertTextEndsWith('/', $this->headers['Location']);

        $this->testAction('/dashboards/view/1');
        $this->assertTextEndsWith('/', $this->headers['Location']);
    }

    public function testAddSavesAndRedirectsToView() {
        $this->login(array('id' => 1, 'email' => 'foo'));
        $name = uniqid();
        $this->testAction('/dashboards/add', array('data' => array(
            'Dashboard' => array(
                'name' => $name
            )
        ), 'method' => 'post'));
        $dashboard = $this->controller->Dashboard->find('first');
        $this->assertEqual($name, $dashboard['Dashboard']['name']);
        $this->assertContains('dashboards/view/1', $this->headers['Location']);
    }

    public function testEdit() {
    }

    public function testDelete() {
    }

}
