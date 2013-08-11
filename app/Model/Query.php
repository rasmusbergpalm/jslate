<?php
App::uses('AppModel', 'Model');
/**
 * Query Model
 *
 * @property Source $Source
 * @property Widget $Widget
 * @property Queryproperty $Queryproperty
 */
class Query extends AppModel {


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Source' => array(
            'className' => 'Source',
            'foreignKey' => 'source_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Widget' => array(
            'className' => 'Widget',
            'foreignKey' => 'widget_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Queryproperty' => array(
            'className' => 'Queryproperty',
            'foreignKey' => 'query_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );


    public function belongsToUser($query, $user_id) {
        $source = $this->Source->find('first', array(
            'id' => @$query['source_id'],
            'user_id' => $user_id
        ));
        $widget = $this->Widget->find('first', array(
            'id' => @$query['widget_id'],
            'user_id' => $user_id
        ));

        return !empty($source) && !empty($widget);
    }

    public function saveQuery(array $query) {
        if(!$this->save($query)) return false;
        if (!empty($query['Queryproperty'])) {
            $this->Queryproperty->deleteAll(array(
                'query_id' => $this->id
            ));
            $data = array();
            foreach ($query['Queryproperty'] as $key => $value) {
                $data[] = array('query_id' => $this->id, 'key' => $key, 'value' => $value);
            }
            if(!$this->Queryproperty->saveAll($data)) return false;
        }
        return $this->id;
    }


}
