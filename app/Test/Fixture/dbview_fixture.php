<?php
/* Dbview Fixture generated on: 2011-08-20 21:27:27 : 1313868447 */
class DbviewFixture extends CakeTestFixture {
	var $name = 'Dbview';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'dashboard_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'left' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'top' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'width' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'height' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'code' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'dashboard_id' => array('column' => 'dashboard_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'dashboard_id' => 1,
			'left' => 1,
			'top' => 1,
			'width' => 1,
			'height' => 1,
			'code' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);
}
