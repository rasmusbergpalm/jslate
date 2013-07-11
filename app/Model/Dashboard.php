<?php
class Dashboard extends AppModel {
        
	var $name = 'Dashboard';
	var $displayField = 'name';
	var $validate = array(
		'name' => array(
            'rule' => array('notempty'),
            'required' => true
		),
        'user_id' => array(
            'rule' => array('numeric'),
            'required' => 'create'
        ),
        'public_id' => array(
            'alphanumeric' => array(
                'rule' => array('alphanumeric'),
                'required' => 'create'
            ),
            'between' => array(
                'rule' => array('between', 40, 40),
            )
        ),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Dbview' => array(
			'className' => 'Dbview',
			'foreignKey' => 'dashboard_id',
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

    function belongsToUser($dashboard_id, $user_id){
        $dashboard = $this->find('first',array(
            'conditions' => array(
                'id' => $dashboard_id,
                'user_id' => $user_id
            )
        ));
        return !empty($dashboard);
    }

}
