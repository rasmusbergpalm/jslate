<?php
App::uses('AppModel', 'Model');
/**
 * Queryproperty Model
 *
 * @property Query $Query
 */
class Queryproperty extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'key';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Query' => array(
			'className' => 'Query',
			'foreignKey' => 'query_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
