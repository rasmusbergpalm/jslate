<?php
/**
 * UserFixture
 *
 */
class UserFixture extends CakeTestFixture {
    public $import = array('table' => 'users');

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'email' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet'
		),
	);

}
