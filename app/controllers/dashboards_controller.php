<?php
class DashboardsController extends AppController {

	var $name = 'Dashboards';

	function index() {
		$this->Dashboard->recursive = 0;
		$this->set('dashboards', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid dashboard', true));
			$this->redirect(array('action' => 'index'));
		}
                $this->set('dashboard_id', $id);
		$this->set('dashboard', $this->Dashboard->read(null, $id));
	}

	function add() {
            $this->data['Dashboard']['name'] = 'New Dashboard';

            $this->Dashboard->create();
            if ($this->Dashboard->save($this->data)) {
                    $this->Session->setFlash(__('The dashboard has been saved', true));
                    $this->redirect(array('action' => 'view', $this->Dashboard->getLastInsertId()));
            } else {
                    $this->Session->setFlash(__('The dashboard could not be saved. Please, try again.', true));
            }
		
	}


	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for dashboard', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Dashboard->delete($id)) {
			$this->Session->setFlash(__('Dashboard deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Dashboard was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
