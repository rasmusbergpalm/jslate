<?php
class DashboardsController extends AppController {

	var $name = 'Dashboards';


	function index() {
            $db = $this->Dashboard->find('first', array(
                'conditions' => array(
                    'user_id' => $this->Auth->user('id')
                )
            ));
            if(empty($db)){
                $this->request->data['Dashboard']['name'] = 'New Dashboard';
                $this->add();
            }else{
                $this->redirect(array('action' => 'view', $db['Dashboard']['id']));
            }
	}

	function view($id = null) {
		if (!$id) {
                    $this->Session->setFlash(__('Invalid dashboard'));
                    $this->redirect(array('action' => 'index'));
		}
                $dashboard = $this->Dashboard->read(null, $id);
                if(!empty($dashboard) && $dashboard['Dashboard']['user_id'] === $this->Auth->user('id')){
                    $this->set('dashboard_id', $id);
                    $this->set('dashboard', $dashboard);
                }else{
                    $this->Session->setFlash('Invalid dashboard');
                    $this->redirect(array('action' => 'index'));
                }
	}

	function add() {
            if(!empty($this->request->data)){
                $this->request->data['Dashboard']['user_id'] = $this->Auth->user('id');
                $this->Dashboard->create();
                if ($this->Dashboard->save($this->request->data)) {
                    $this->Session->setFlash(__('The dashboard has been saved'));
                    $this->redirect(array('action' => 'view', $this->Dashboard->getLastInsertId()));
                } else {
                    $this->Session->setFlash(__('The dashboard could not be saved. Please, try again.'));
                }
            }
		
	}

        function edit($id = null) {
                if($id && $this->Dashboard->belongsToUser($id, $this->Auth->user('id'))){
                    if (!empty($this->request->data)) {
                        if ($this->Dashboard->save($this->request->data)) {
                            $this->Session->setFlash(__('The dashboard has been saved'));
                            $this->redirect($this->referer());
                        } else {
                                $this->Session->setFlash(__('The dashboard could not be saved. Please, try again.'));
                        }
                    }
                    if (empty($this->request->data)) {
                        $this->request->data = $this->Dashboard->read(null, $id);
                    }
                }else{
                    $this->Session->setFlash(__('Invalid dashboard'));
                    $this->redirect(array('action' => 'index'));
                }
	}


	function delete($id = null) {
		if($id && $this->Dashboard->belongsToUser($id, $this->Auth->user('id'))){
                    if ($this->Dashboard->delete($id)) {
                            $this->Session->setFlash(__('Dashboard deleted'));
                            $this->redirect(array('action'=>'index'));
                    }
                    $this->Session->setFlash(__('Dashboard was not deleted'));
                    $this->redirect(array('action' => 'index'));
                }else{
                    $this->Session->setFlash(__('Invalid dashboard'));
                    $this->redirect(array('action' => 'index'));
                }
	}
}
