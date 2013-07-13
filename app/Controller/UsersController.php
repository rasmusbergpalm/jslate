<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

    var $name = 'Users';

    function  beforeFilter() {
        $this->Auth->allow('add','demo');
        parent::beforeFilter();

    }

    function logout() {
        $this->RememberMe->delete();
        return $this->redirect($this->Auth->logout());
    }

    function demo(){
        $this->request->data['User']['email'] = uniqid().'@mailinator.com';
        $password = uniqid();
        $this->request->data['User']['password'] = $password;
        $this->request->data['User']['password2'] = $password;
        $this->add();
    }

    function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if (empty($this->data['User']['remember_me'])) {
                    $this->RememberMe->delete();
                } else {
                    $this->RememberMe->remember($this->Auth->user('id'), $this->data['User']['email'], $this->data['User']['password']);
                }
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash(__('Invalid username or password, try again.'),'error');
            }
        }
    }

    function add() {
        if (!empty($this->request->data)) {
            if ($this->request->data['User']['password'] == $this->request->data['User']['password2']) {
                $this->User->create();

                if ($this->User->save($this->request->data)) {
                    $id = $this->User->id;
                    unset($this->request->data['User']['password2']);
                    $this->request->data['User'] = array_merge($this->request->data['User'], array('id' => $id));
                    $this->Auth->login($this->request->data['User']);
                    return $this->redirect(array('controller'=>'dashboards','action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The user could not be saved. Please, try again.'),'error');
                }
            } else {
                $this->Session->setFlash('The provided passwords did not match. Please try again.','error');

            }
        }
        @$this->request->data['User']['password'] = '';
        @$this->request->data['User']['password2'] = '';

    }

    function delete() {
        $id = $this->Auth->user('id');
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for user.'), 'error');
            return $this->redirect('/');
        }
        if ($this->User->delete($id)) {
            return $this->redirect(array('action' => 'logout'));
        }
        $this->Session->setFlash(__('User was not deleted.'), 'error');
        return $this->redirect('/');
    }
}
