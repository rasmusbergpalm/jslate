<?php
App::uses('AppModel', 'Model');
/**
 * Sourceproperty Model
 *
 * @property Source $Source
 */
class Sourceproperty extends AppModel {

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
		'Source' => array(
			'className' => 'Source',
			'foreignKey' => 'source_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
