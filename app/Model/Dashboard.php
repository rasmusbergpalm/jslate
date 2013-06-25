<?php
class Dashboard extends AppModel {
        
	var $name = 'Dashboard';
	var $displayField = 'name';
	var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
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
            return !empty($dashboard) ? true : false;
        }

}
