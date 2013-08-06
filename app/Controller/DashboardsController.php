<?php
App::uses('AppController', 'Controller');

class DashboardsController extends AppController {

    var $name = 'Dashboards';

    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('readonly');
    }

    function index() {
        $db = $this->Dashboard->find('first', array('conditions' => array('user_id' => $this->Auth->user('id'))));
        if (empty($db)) {
            $this->request->data['Dashboard']['name'] = 'My Dashboard';
            $this->add();
        } else {
            return $this->redirect(array('action' => 'view', $db['Dashboard']['id']));
        }
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid dashboard.'), 'error');
            return $this->redirect('/');
        }
        $dashboard = $this->Dashboard->read(null, $id);
        if (!empty($dashboard) && $dashboard['Dashboard']['user_id'] == $this->Auth->user('id')) {
            $this->set('dashboard_id', $id);
            $this->set('dashboard', $dashboard);
            $this->set('javascript', $dashboard['Dashboard']['javascript']);
            $this->set('css', $dashboard['Dashboard']['css']);
        } else {
            $this->Session->setFlash('Invalid dashboard.', 'error');
            return $this->redirect('/');
        }
    }

    function readonly($public_id){
        $dashboard = $this->Dashboard->findByPublicId($public_id);
        if(empty($dashboard))
            throw new NotFoundException();

        $this->set('dashboard', $dashboard);
        $this->render('view');
    }

    function add() {
        if (!empty($this->request->data)) {
            $this->request->data['Dashboard']['user_id'] = $this->Auth->user('id');
            $this->request->data['Dashboard']['public_id'] = Security::hash(openssl_random_pseudo_bytes(40));
            $this->Dashboard->create();
            if ($this->Dashboard->save($this->request->data)) {
                return $this->redirect(array('action' => 'view', $this->Dashboard->getLastInsertId()));
            } else {
                $this->Session->setFlash(__('The dashboard could not be saved.'), 'error');
            }
        }
    }

    function edit($id = null) {
        if ($id && $this->Dashboard->belongsToUser($id, $this->Auth->user('id'))) {
            if (!empty($this->request->data)) {
                $this->request->data['Dashboard']['id'] = $id;
                if (!$this->Dashboard->save($this->request->data)) {
                    $this->Session->setFlash(__('The dashboard could not be saved.'), 'error');
                }
                return $this->redirect($this->referer());
            }
            else {
                $this->set('dashboard_id', $id);
                $this->request->data = $this->Dashboard->read(null, $id);
            }
        } else {
            $this->Session->setFlash(__('Invalid dashboard.'), 'error');
            return $this->redirect('/');
        }
    }


    function delete($id = null) {
        if ($id && $this->Dashboard->belongsToUser($id, $this->Auth->user('id'))) {
            if ($this->Dashboard->delete($id)) {
                return $this->redirect('/');
            }
            $this->Session->setFlash(__('Dashboard could not be deleted.'), 'error');
            return $this->redirect('/');
        } else {
            $this->Session->setFlash(__('Invalid dashboard.'), 'error');
            return $this->redirect('/');
        }
    }
}
