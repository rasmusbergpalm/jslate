<?php
App::uses('AppController', 'Controller');

class DbviewsController extends AppController {

    var $name = 'Dbviews';

    function add($dashboard_id, $template = null) {
        if (!empty($template) && !empty($dashboard_id)) {
            $this->Dbview->create();
            $this->request->data['Dbview']['name'] = $template;
            $this->request->data['Dbview']['code'] = file_get_contents(APP . 'templates' . DS . $template);
            $this->request->data['Dbview']['dashboard_id'] = $dashboard_id;
            $this->request->data['Dbview']['left'] = 100;
            $this->request->data['Dbview']['top'] = 100;
            $this->request->data['Dbview']['width'] = 400;
            $this->request->data['Dbview']['height'] = 300;

            if ($this->Dbview->save($this->request->data)) {
                return $this->redirect(array('controller' => 'dbviews', 'action' => 'edit', $this->Dbview->getLastInsertId()));
            } else {
                $this->Session->setFlash(__('The widget could not be saved. Please, try again.', true));
            }
        }
        $files = glob(APP . 'templates' . DS . '*.html');
        foreach ($files as $f) {
            $templates[basename($f)] = file_get_contents($f);
        }
        $this->set(compact('templates', 'dashboard_id'));
    }

    function edit($id = null) {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid widget', true));
            return $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Dbview->save($this->request->data)) {
                return $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('The widget could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Dbview->read(null, $id);
        }
        $dashboard_id = $this->request->data['Dbview']['dashboard_id'];
        $dashboards = $this->Dbview->Dashboard->find('list');
        $this->set(compact('dashboards', 'dashboard_id'));
    }

    function update($id = null) {
        $this->autoRender = false;

        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid widget', true));
            return $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            $dbview = $this->Dbview->read(null, $id);

            foreach ($this->request->data as $k => $v) {
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
            return $this->redirect($this->referer());
        }
        if ($this->Dbview->delete($id)) {
            $this->Session->setFlash(__('Widget was deleted', true));
            return $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Widget was not deleted', true));
        return $this->redirect($this->referer());
    }
}
