<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

    var $name = 'Users';

    function  beforeFilter() {
        $this->Auth->allow('login','add','demo');
        parent::beforeFilter();

    }

    function logout() {
        $this->RememberMe->delete();
        return $this->redirect($this->Auth->logout());
    }

    function demo(){
        $this->request->data['User']['email'] = 'jSlateDemoUser'.uniqid().'@mailinator.com';
        $password = uniqid();
        $this->request->data['User']['password'] = $password;
        $this->request->data['User']['password2'] = $password;
        return $this->add();
    }

    function login() {
        if (!empty($this->request->data)) {
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

    function edit() {
        $id = $this->Auth->user('id');
        if(empty($id)) throw new NotFoundException();

        if (!empty($this->request->data)) {
            if ($this->request->data['User']['password'] != $this->request->data['User']['password2']) {
                $this->Session->setFlash('The provided passwords did not match. Please try again.','error');
            } else {
                $this->request->data['User']['id'] = $id;
                if (!$this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('You user could not be updated.'), 'error');
                } else {
                    $this->request->data['User']['remember_me'] = true;
                    return $this->login();
                }
            }
        }

        @$this->request->data['User']['password'] = '';
        @$this->request->data['User']['password2'] = '';
    }

    function add() {
        if (!empty($this->request->data)) {
            if ($this->request->data['User']['password'] != $this->request->data['User']['password2']) {
                $this->Session->setFlash('The provided passwords did not match. Please try again.','error');
            } else{
                $this->User->create();
                if ($this->User->save($this->request->data)) {
                    unset($this->request->data['User']['password2']);
                    $this->request->data['User']['remember_me'] = true;
                    return $this->login();
                } else {
                    $this->Session->setFlash(__('The user could not be saved. Please, try again.'),'error');
                }
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
