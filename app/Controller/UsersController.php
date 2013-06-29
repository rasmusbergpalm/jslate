<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

    var $name = 'Users';

    function  beforeFilter() {
        $this->Auth->allow('add');
        parent::beforeFilter();

    }

    function logout() {
        return $this->redirect($this->Auth->logout());
    }

    function index() {
        return $this->redirect(array('action' => 'view'));
    }

    function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash(__('Invalid username or password, try again'));
            }
        }
    }

    function view() {
        $id = $this->Auth->user('id');
        if (!$id) {
            $this->Session->setFlash(__('Invalid user'));
            return $this->redirect(array('action' => 'login'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    function add() {
        //TODO Look for the user to see if they already exist
        if (!empty($this->request->data)) {
            if ($this->request->data['User']['password'] == $this->request->data['User']['password2']) {
                $this->User->create();

                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('The user has been saved'));
                    $this->Auth->login($this->request->data);
                    return $this->redirect(array('action' => 'login'));
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
            return $this->redirect(array('action' => 'index'));
        }
        if ($this->User->delete($id)) {
            $this->Session->setFlash(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }
}
