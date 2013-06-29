<?php
/**
 * DashboardFixture
 *
 */
class DashboardFixture extends CakeTestFixture {
    public $import = array('table' => 'dashboards');

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'user_id' => 1
		),
	);

}
