<?php
App::uses('MysqlSource', 'Sources');
App::uses('AppModel', 'Model');
/**
 * Source Model
 *
 * @property Sourceproperty $Sourceproperty
 */
class Source extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Sourceproperty' => array(
            'className' => 'Sourceproperty',
            'foreignKey' => 'source_id',
            'dependent' => false
        ),
        'Query' => array(
            'className' => 'Query',
            'foreignKey' => 'source_id',
            'dependent' => false
        )
    );

    public $types = array(
        'Mysql'
    );

    /**
     * @param array $source
     * @return int|bool
     */
    public function saveSource(array $source) {
        $encryptionKey = Configure::read('encryptionKey');
        if(!$this->save($source)) return false;
        if (!empty($source['Sourceproperty'])) {
            $properties = $source['Sourceproperty'];
            $data = array();
            foreach ($properties as $key => $value) {
                $data[] = array('source_id' => $this->id, 'key' => $key, 'value' => Security::rijndael($value, $encryptionKey, 'encrypt'));
            }
            if(!$this->Sourceproperty->saveAll($data)) return false;
        }
        return $this->id;
    }

    /**
     * @param $id
     * @return SourceInterface
     */
    public function getSource($id){
        $source = $this->findById($id);

        $encryptionKey = Configure::read('encryptionKey');
        $properties = array();
        foreach($source['Sourceproperty'] as $property){
            $properties[$property['key']] = Security::rijndael($property['value'], $encryptionKey, 'decrypt');
        }
        $class = $source['Source']['type'] . 'Source';
        $sourceInstance = new $class($properties);

        return $sourceInstance;
    }


}
