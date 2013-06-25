<?php
/* DashboardsItem Fixture generated on: 2011-08-18 17:38:18 : 1313681898 */
class DashboardsItemFixture extends CakeTestFixture {
	var $name = 'DashboardsItem';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'dashboard_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'item_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'dashboard_id' => array('column' => array('dashboard_id', 'item_id'), 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'dashboard_id' => 1,
			'item_id' => 1
		),
	);
}
