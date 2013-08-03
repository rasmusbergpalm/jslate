<?php
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
    public $hasMany = array('Sourceproperty' => array(
        'className' => 'Sourceproperty',
        'foreignKey' => 'source_id',
        'dependent' => false
    ));

    /**
     * @param array $source
     * @return int|bool
     */
    public function saveSource(array $source, $encryptionKey) {
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
}
