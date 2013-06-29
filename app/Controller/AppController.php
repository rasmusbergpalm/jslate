<?php
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $layout = 'clean';
    public $components = array(
        'Session',
        'Security',
        'RequestHandler',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'email')
                )
            )
        ));
    public $helpers = array('Form', 'Html', 'Time', 'Session');

    function beforeFilter(){
        $this->loadModel('Dashboard');
        $this->Security->validatePost = false;
        $this->Security->csrfCheck = false;

        if($this->Auth->user('id') !== null){
            $this->set('dblist', $this->Dashboard->find('list', array(
                'conditions' => array(
                    'user_id' => $this->Auth->user('id')
                )
            )));
        }
    }
}
