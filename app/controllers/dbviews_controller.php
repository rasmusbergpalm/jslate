<?php
class DbviewsController extends AppController {

	var $name = 'Dbviews';

	function add($dashboard_id, $template = null) {
		if (!empty($template) && !empty($dashboard_id)) 
		{
			$this->Dbview->create();
			$this->data['Dbview']['name'] = $template;
			$this->data['Dbview']['dashboard_id'] = $dashboard_id;
			$this->data['Dbview']['left'] = 100;
			$this->data['Dbview']['top'] = 100;
			$this->data['Dbview']['width'] = 400;
			$this->data['Dbview']['height'] = 300;
			
			if ($this->Dbview->save($this->data)) 
			{
				$widget_id = $this->Dbview->getLastInsertID() . '_' . $dashboard_id;
				$this->data['Dbview']['code'] = str_replace('${widget_id}', $widget_id, file_get_contents(APP.'templates'.DS.$template));
				if ($this->Dbview->save($this->data))
					$this->redirect(array('controller' => 'dbviews','action' => 'edit', $this->Dbview->getLastInsertId()));
				else
					$this->Session->setFlash(__('The widget could not be saved. Please, try again.', true));
			} 
			else 
			{
				$this->Session->setFlash(__('The widget could not be saved. Please, try again.', true));
			}
		}
        $files = glob(APP.'templates'.DS.'*.html');
        foreach($files as $f){
            $templates[basename($f)] =  file_get_contents($f);
        }
        $this->set(compact('templates','dashboard_id'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid widget', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Dbview->save($this->data)) {
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The widget could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Dbview->read(null, $id);
		}
                $dashboard_id = $this->data['Dbview']['dashboard_id'];
		$dashboards = $this->Dbview->Dashboard->find('list');
		$this->set(compact('dashboards','dashboard_id'));
	}

        function update($id = null) {
            $this->autoRender = false;

                if (!$id && empty($this->data)) {
                        $this->Session->setFlash(__('Invalid widget', true));
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
			$this->Session->setFlash(__('Invalid id for widget', true));
			$this->redirect($this->referer());
		}
		if ($this->Dbview->delete($id)) {
                        $this->Session->setFlash(__('Widget was deleted', true));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('Widget was not deleted', true));
		$this->redirect($this->referer());
	}
}
