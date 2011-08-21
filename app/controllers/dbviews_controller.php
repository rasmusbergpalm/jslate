<?php
class DbviewsController extends AppController {

	var $name = 'Dbviews';

	function index() {
		$this->Dbview->recursive = 0;
		$this->set('dbviews', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid dbview', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('dbview', $this->Dbview->read(null, $id));
	}

	function add($dashboard_id, $template = null) {
		if (!empty($template) && !empty($dashboard_id)) {
			$this->Dbview->create();

                        $this->data['Dbview']['name'] = $template;
                        $this->data['Dbview']['code'] = file_get_contents(APP.'templates'.DS.'views'.DS.$template.DS.$template.'.js');
                        $this->data['Dbview']['dashboard_id'] = $dashboard_id;
                        $this->data['Dbview']['left'] = 100;
                        $this->data['Dbview']['top'] = 100;
                        $this->data['Dbview']['width'] = 300;
                        $this->data['Dbview']['height'] = 300;
			if ($this->Dbview->save($this->data)) {
				$this->Session->setFlash(__('The dbview has been saved', true));
				$this->redirect(array('controller' => 'dashboards','action' => 'view', $dashboard_id));
			} else {
				$this->Session->setFlash(__('The dbview could not be saved. Please, try again.', true));
			}
		}
                $files = scandir(APP.'templates'.DS.'views');
                App::import('Xml');
                foreach($files as $f){
                    if($f == '.' || $f == '..' || $f == '.svn') continue;
                    $templates[] =  Set::reverse(new Xml(APP.'templates'.DS.'views'.DS.$f.DS.$f.'.xml'));
                    $templates[count($templates)-1]['Template']['code'] = file_get_contents(APP.'templates'.DS.'views'.DS.$f.DS.$f.'.js');
                }
		$this->set(compact('templates','dashboard_id'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid dbview', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Dbview->save($this->data)) {
				$this->Session->setFlash(__('The dbview has been saved', true));
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The dbview could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Dbview->read(null, $id);
		}
		$dashboards = $this->Dbview->Dashboard->find('list');
		$this->set(compact('dashboards'));
	}

        function update($id = null) {
            $this->autoRender = false;

                if (!$id && empty($this->data)) {
                        $this->Session->setFlash(__('Invalid dashboards item', true));
                        $this->redirect(array('action' => 'index'));
                }
                if (!empty($this->data)) {
                        debug($this->data);
                        $dbview = $this->Dbview->read(null, $id);

                        foreach($this->data as $k => $v){
                            $dbview['Dbview'][$k] = $v;
                        }

                        if ($this->Dbview->save($dbview)) {
                                echo "OK";
                        } else {
                                echo "ERROR";
                        }
                }
        }

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for dbview', true));
			$this->redirect($this->referer());
		}
		if ($this->Dbview->delete($id)) {
                        $this->Session->setFlash(__('Dbview was deleted', true));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('Dbview was not deleted', true));
		$this->redirect($this->referer());
	}
}
