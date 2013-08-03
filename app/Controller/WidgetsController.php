<?php
App::uses('AppController', 'Controller');

class WidgetsController extends AppController {

    var $name = 'Widgets';
    var $uses = array('Widget', 'Source');

    function add($source_id, $template = null) {
        if (!empty($template) && !empty($source_id)) {
            $this->Widget->create();
            $this->request->data['Widget']['name'] = $template;
            $this->request->data['Widget']['code'] = file_get_contents(APP . 'templates' . DS . $template);
            $this->request->data['Widget']['dashboard_id'] = $this->Session->read('dashboard_id');
            $this->request->data['Widget']['source_id'] = $source_id;
            $this->request->data['Widget']['left'] = 12;
            $this->request->data['Widget']['top'] = 52;
            $this->request->data['Widget']['width'] = 300;
            $this->request->data['Widget']['height'] = 300;

            if ($this->Widget->save($this->request->data)) {
                return $this->redirect(array('controller' => 'widgets', 'action' => 'edit', $this->Widget->getInsertID()));
            } else {
                $this->Session->setFlash(__('The widget could not be saved. Please, try again.', true));
            }
        }
        $files = glob(APP . 'templates' . DS . '*.html');
        foreach ($files as $f) {
            $templates[basename($f)] = file_get_contents($f);
        }

        $this->set(compact('templates', 'source_id'));
    }

    function edit($id = null) {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid widget', true));
            return $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Widget->save($this->request->data)) {
                return $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('The widget could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Widget->read(null, $id);
        }
        $dashboard_id = $this->request->data['Widget']['dashboard_id'];
        $dashboards = $this->Widget->Dashboard->find('list');
        $this->set(compact('dashboards', 'dashboard_id'));
    }

    function update($id = null) {
        $this->autoRender = false;

        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid widget', true));
            return $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            $widget = $this->Widget->read(null, $id);

            foreach ($this->request->data as $k => $v) {
                $widget['Widget'][$k] = $v;
            }

            if ($this->Widget->save($widget)) {
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
        if ($this->Widget->delete($id)) {
            return $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Widget was not deleted', true));
        return $this->redirect($this->referer());
    }
}
