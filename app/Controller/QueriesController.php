<?php
App::uses('AppController', 'Controller');
/**
 * Queries Controller
 *
 * @property Query $Query
 */
class QueriesController extends AppController {
    /**
     * add method
     *
     *
     * @throws MethodNotAllowedException
     * @throws ForbiddenException
     * @return void
     */
    public function add() {
        if (!($this->request->is('post') || $this->request->is('PUT'))) throw new MethodNotAllowedException('Must use PUT or POST');
        $widget = $this->Query->Widget->find('first', array(
            'id' => $this->data['Query']['widget_id'],
            'user_id' => $this->Auth->user('id')
        ));
        if(empty($widget)) throw new ForbiddenException();

        $this->Query->deleteAll(array('widget_id' => $this->request->data['Query']['widget_id']), true);

        $this->Query->create();
        if (!$this->Query->save($this->request->data))
            $this->Session->setFlash(__('The query could not be saved. Please, try again.'), 'error');

        $this->redirect($this->referer());
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $query = $this->Query->findById($id);
        if (empty($query)) throw new NotFoundException(__('Invalid query'));
        if ($this->request->is('post') || $this->request->is('put')) {
            if (!$this->Query->saveQuery($this->request->data)) {
                $this->Session->setFlash(__('The query could not be saved.'), 'error');
            }
        } else {
            $this->request->data = $query;
        }
        $this->request->data['Queryproperty'] = $this->Query->Queryproperty->find('list', array('query_id' => $id, 'fields'=>array('key','value')));
        $this->render(strtolower($query['Source']['type']), 'ajax');
    }

    public function query($query_id) {
        //if (!($this->request->is('post') || $this->request->is('put'))) throw new MethodNotAllowedException('You must use POST or PUT');
        $query = $this->Query->findById($query_id);
        if (empty($query)) throw new NotFoundException(__('Query not found'));
        if(!$this->Query->belongsToUser($query['Query'], $this->Auth->user('id'))) throw new ForbiddenException();
        $source = $this->Query->Source->getSource($query['Source']['id']);
        if (empty($source)) throw new InternalErrorException(__('Could not create data source'));
        $properties = $this->Query->Queryproperty->find('list', array('query_id' => $query_id, 'fields'=>array('key','value')));
        $result = $source->query($properties);
        $this->set(compact('result'));
        $this->set('_serialize', array('result'));
    }

}
