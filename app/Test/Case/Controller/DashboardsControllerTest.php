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
                'user_id' => 2,
                'public_id' => Security::hash(uniqid())
            )
        ));
        $this->controller->Dashboard->save(array(
            'Dashboard' => array(
                'id' => 2,
                'name' => 'bar',
                'user_id' => 1,
                'public_id' => Security::hash(uniqid())
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
                'user_id' => 1,
                'public_id' => Security::hash(uniqid())
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
                'user_id' => 2,
                'public_id' => Security::hash(uniqid())
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

    public function testGetEditReturnsDashboardForEditingAndPublicId() {
        $name = uniqid();
        $publicId = Security::hash('foo');
        $this->controller->Dashboard->save(array(
            'Dashboard' => array(
                'id' => 1,
                'name' => $name,
                'user_id' => 1,
                'public_id' => $publicId
            )
        ));
        $this->login(array('id'=>1, 'email'=>'foo'));
        $view = $this->testAction('/dashboards/edit/1', array('return'=>'view'));
        $this->assertTextContains($name, $view);
        $this->assertTextContains('/dashboards/readonly/'.$publicId, $view);
    }

    public function testGetEditNotYourOwnRedirectsToIndex() {
        $name = uniqid();
        $this->controller->Dashboard->save(array(
            'Dashboard' => array(
                'id' => 1,
                'name' => $name,
                'user_id' => 2,
                'public_id' => Security::hash(uniqid())
            )
        ));
        $this->login(array('id'=>1, 'email'=>'foo'));
        $this->testAction('/dashboards/edit/1');
        $this->assertTextEndsWith('/', $this->headers['Location']);
    }

    public function testPostEditSavesChanges() {
        $name = uniqid();
        $this->controller->Dashboard->save(array(
            'Dashboard' => array(
                'id' => 2,
                'name' => $name,
                'user_id' => 1,
                'public_id' => Security::hash(uniqid())
            )
        ));
        $this->login(array('id'=>1, 'email'=>'foo'));
        $newName = 'new name';
        $this->testAction('/dashboards/edit/2', array('data' => array(
            'Dashboard' => array(
                'name' => $newName
            )
        ), 'method' => 'post'));
        $dashboard = $this->controller->Dashboard->findById(2);
        $this->assertEqual($newName, $dashboard['Dashboard']['name']);
    }

    public function testPostEditOthersDashboardFails() {
        $name = uniqid();
        $this->controller->Dashboard->save(array(
            'Dashboard' => array(
                'id' => 1,
                'name' => $name,
                'user_id' => 2,
                'public_id' => Security::hash(uniqid())
            )
        ));
        $this->login(array('id'=>1, 'email'=>'foo'));
        $newName = 'new name';
        $this->testAction('/dashboards/edit/1', array('data' => array(
            'Dashboard' => array(
                'id' => 1,
                'name' => $newName
            )
        ), 'method' => 'post'));
        $dashboard = $this->controller->Dashboard->find('first');
        $this->assertEqual($name, $dashboard['Dashboard']['name']);
    }

    public function testDeleteDeletes() {
        $this->controller->Dashboard->save(array(
            'Dashboard' => array(
                'id' => 1,
                'name' => 'name',
                'user_id' => 1,
                'public_id' => Security::hash(uniqid())
            )
        ));
        $this->login(array('id'=>1, 'email'=>'foo'));
        $this->testAction('/dashboards/delete/1');
        $dashboard = $this->controller->Dashboard->find('first');
        $this->assertEqual($dashboard, array());
    }

    public function testDeleteNotYourOwnRedirectsToIndex() {
        $name = uniqid();
        $dashboard = array('id' => 1, 'name' => $name, 'user_id' => 2, 'public_id' => Security::hash(uniqid()));
        $this->controller->Dashboard->save(array(
            'Dashboard' => $dashboard
        ));
        $this->login(array('id'=>1, 'email'=>'foo'));
        $this->testAction('/dashboards/delete/1');
        $result = $this->controller->Dashboard->find('first');
        $this->assertEqual($result['Dashboard']['name'], $name);
        $this->assertTextEndsWith('/', $this->headers['Location']);
    }

    public function testReadOnlyCanViewDashboardWithoutBeingLoggedIn() {
        $name = uniqid();
        $publicId = Security::hash('foo');
        $this->controller->Dashboard->save(array(
            'Dashboard' => array(
                'id' => 1,
                'name' => $name,
                'user_id' => 1,
                'public_id' => $publicId
            )
        ));
        $vars = $this->testAction("/dashboards/readonly/$publicId", array('return'=>'vars'));
        $this->assertEqual(array(), $this->headers);
        $this->assertEqual($name, $vars['dashboard']['Dashboard']['name']);
    }

    /**
     * @expectedException NotFoundException
     */
    public function testReadOnlyThrows404IfPublicIdNotFound() {
        $name = uniqid();
        $publicId = Security::hash('foo');
        $this->controller->Dashboard->save(array(
            'Dashboard' => array(
                'id' => 1,
                'name' => $name,
                'user_id' => 1,
                'public_id' => $publicId
            )
        ));
        $this->testAction("/dashboards/readonly/foobar");
    }

}
