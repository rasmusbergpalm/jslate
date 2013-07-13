<?php
App::uses('Component', 'Controller');


class RememberMeComponent extends Component {
    var $components = array('Cookie', 'Auth');

    var $period = '+1 year';
    var $cookieName = 'jSlateUser';

    function remember($id, $email, $password) {
        $cookie = array(
            'id' => $id,
            'email' => $email,
            'password' => Security::hash($password)
        );

        $this->Cookie->write($this->cookieName, $cookie, true, $this->period);
    }

    function check() {
        $cookie = $this->Cookie->read($this->cookieName);

        if (!is_array($cookie) || $this->Auth->user()) return;

        if ($this->Auth->login($cookie)) {
            $this->Cookie->write($this->cookieName, $cookie, true, $this->period);
        } else {
            $this->delete();
        }
    }

    function delete() {
        $this->Cookie->delete($this->cookieName);
    }
}