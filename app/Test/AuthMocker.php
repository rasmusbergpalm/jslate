<?php

/**
 * AuthMocker
 *
 */
class AuthMocker extends ControllerTestCase {

    public function generate($name, $mocks = array()) {
        $authMock = array('components' => array('Auth' => array('user')));
        $mocks = array_merge_recursive($authMock, $mocks);
        $controller = parent::generate($name, $mocks);
        $controller->Auth->staticExpects($this->any())->method('user')->will($this->returnCallback(array($this, 'user')));
        return $controller;
    }

    public $user;

    public function tearDown(){
        parent::tearDown();
        $this->user = null;
    }

    public function setUp(){
        parent::setUp();
        $this->controller = $this->generate($this->name, $this->mocks);
    }

    public function login($user){
        $this->user = $user;
    }

    public function logout(){
        $this->user = array();
    }

    public function user(){
        $args = func_get_args();
        if($args[0] == null){
            return $this->user;
        }else{
            return $this->user[$args[0]];
        }
    }

}
