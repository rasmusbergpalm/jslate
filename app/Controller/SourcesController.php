<?php
App::uses('AppController', 'Controller');
/**
 * Sources Controller
 *
 * @property Source $Source
 */
class SourcesController extends AppController {

    public function add($type = null) {
        if (!in_array($type, $this->types)) throw new NotFoundException('Data source type not found');
        if ($this->request->is('post')) {
            $this->request->data['Source']['type'] = $type;
            $this->request->data['Source']['user_id'] = $this->Auth->user('id');
            $this->Source->create();
            $this->Source->saveSource($this->request->data, Configure::read('encryptionKey'));
        }
        $this->render(strtolower($type));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Source->exists($id)) {
            throw new NotFoundException(__('Invalid source'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Source->save($this->request->data)) {
                $this->Session->setFlash(__('The source has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The source could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Source.' . $this->Source->primaryKey => $id));
            $this->request->data = $this->Source->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Source->id = $id;
        if (!$this->Source->exists()) {
            throw new NotFoundException(__('Invalid source'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Source->delete()) {
            $this->Session->setFlash(__('Source deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Source was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
