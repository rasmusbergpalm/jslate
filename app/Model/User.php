<?php
class User extends AppModel {
	var $name = 'User';
	var $displayField = 'email';

	var $validate = array(
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'required' => true,
                'message' => 'The email address must be a valid email address'
			),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'The email address is already in use'
            ),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'required' => true,
                'message' => 'The password cannot be empty'
			),
		),
	);

	var $hasMany = array(
		'Dashboard' => array(
			'className' => 'Dashboard',
			'foreignKey' => 'user_id'
		)
	);
    
    public function beforeSave($options = array()){
        if (isset($this->data['User']['password'])) {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        }
        return true;
    }

}
