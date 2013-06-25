<?php
class UsersController extends AppController {

    var $name = 'Users';

    function  beforeFilter() {
        $this->Auth->allow('add');
        parent::beforeFilter();

    }

    function logout() {
        $this->redirect($this->Auth->logout());
    }

    function index() {
        $this->redirect(array('action' => 'view'));
    }

    function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid username or password, try again'));
            }
        }
    }

    function view() {
        $id = $this->Auth->user('id');
        if (!$id) {
            $this->Session->setFlash(__('Invalid user'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    function add() {
        if (!empty($this->request->data)) {
            if ($this->request->data['User']['password'] == $this->Auth->password($this->request->data['User']['password2'])) {
                $this->User->create();

                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('The user has been saved'));
                    $this->Auth->login($this->request->data);
                    $this->redirect(array('controller' => 'dashboards', 'action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash('The provided passwords did not match. Please try again');

            }
        }
        @$this->request->data['User']['password'] = '';
        @$this->request->data['User']['password2'] = '';

    }

    function delete() {
        $id = $this->Auth->user('id');
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for user'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->User->delete($id)) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
