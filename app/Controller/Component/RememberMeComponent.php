<?php
App::uses('Component', 'Controller');


class RememberMeComponent extends Component {
    var $components = array('Cookie', 'Auth');

    var $period = '+1 year';
    var $cookieName = 'jSlateUser';

    function remember($id, $email, $password, $encryptionKey) {
        $cookie = array(
            'id' => $id,
            'email' => $email,
            'password' => Security::hash($password),
            'encryptionKey' => $encryptionKey
        );

        $this->Cookie->write($this->cookieName, $cookie, true, $this->period);
    }

    function check() {
        $cookie = $this->Cookie->read($this->cookieName);

        if (!is_array($cookie) || $this->Auth->user()) return;

        $user = array(
            'id' => $cookie['id'],
            'email' => $cookie['email']
        );
        if ($this->Auth->login($user)) {
            $this->Cookie->write($this->cookieName, $cookie, true, $this->period);
        } else {
            $this->delete();
        }
    }

    function delete() {
        $this->Cookie->delete($this->cookieName);
    }
}