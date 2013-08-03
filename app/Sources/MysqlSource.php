<?php
App::uses('SourceInterface','Sources');
class MysqlSource implements SourceInterface {

    private $mysql;
    private $name = 'MySQL';

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param array $properties
     */
    public function __construct(array $properties){
        $properties['unix_socket'] = '/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock';
        $this->mysql = new Mysql($properties);
    }

    public function query($query) {
        return $this->mysql->query($query);
    }
}