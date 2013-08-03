<?php
App::uses('MysqlSource', 'Sources');
App::uses('AppController', 'Controller');
/**
 * Sources Controller
 *
 * @property Source $Source
 */
class SourcesController extends AppController {

    private $types = array(
        'Mysql'
    );

    public function query($id) {
        $source = $this->Source->find('first', array(
            'id' => $id,
            'user_id' => $this->Auth->user('id')
        ));
        if (empty($source)) throw new NotFoundException(__('Data source not found'));
        if (!$this->request->is('post')) throw new MethodNotAllowedException('You must use POST');
        if (!isset($this->request->data['query'])) throw new InvalidArgumentException('You must pass a "query" parameter');
        $query = $this->request->data['query'];

        $properties = $this->Source->Sourceproperty->find('list', array('conditions' => array('source_id' => $id), 'fields' => array('key', 'value')));
        $encryptionKey = $this->Cookie->read('encryptionKey');
        foreach($properties as &$property){
            $property = Security::rijndael($property, $encryptionKey, 'decrypt');
        }
        $class = $source['Source']['type'] . 'Source';
        $sourceInstance = new $class($properties);

        $result = $sourceInstance->query($query);
        $this->set(compact('result'));
        $this->set('_serialize', array('result'));
    }

    public function select(){
        $sources = $this->Source->find('list', array(
            'conditions' => array(
                'user_id' => $this->Auth->user('id')
            )
        ));
        $this->set('sources', $sources);
        $this->set('types', $this->types);
    }

    public function add($type = null) {
        if (!in_array($type, $this->types)) throw new NotFoundException('Data source type not found');
        if ($this->request->is('post')) {
            $this->request->data['Source']['type'] = $type;
            $this->request->data['Source']['user_id'] = $this->Auth->user('id');
            $this->Source->create();
            $this->Source->saveSource($this->request->data, $this->Cookie->read('encryptionKey'));
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
