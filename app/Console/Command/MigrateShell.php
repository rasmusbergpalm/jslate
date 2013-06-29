<?php

App::uses('Shell', 'Console');
App::uses('ConnectionManager', 'Model');

class MigrateShell extends Shell {

    private $migrationsTableSql = "CREATE TABLE IF NOT EXISTS `__migrations` (
                                      `migrations` varchar(255) UNIQUE NOT NULL
                                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

    public function main(){
        $db = ConnectionManager::getDataSource('default');
        $db->query($this->migrationsTableSql);

        $results = $db->query("select migrations from __migrations");
        $applied = array();
        foreach($results as $result){
            $applied[] = $result['__migrations']['migrations'];
        }

        $migrations = glob(APP . 'Config' . DS . 'Schema' . DS . 'migrations' . DS . '*.sql');
        natsort($migrations);

        $db->begin();
        try{
            foreach ($migrations as $filename) {
                list($migration, $ignore) = explode('.', basename($filename));
                if(in_array($migration, $applied)) continue;

                $this->out("Migrating to $migration.");
                $db->query(file_get_contents($filename));
                $db->query("INSERT INTO `__migrations` VALUES ('$migration')");
            }
            $db->commit();
            $this->out('Done.');
        }catch (Exception $e){
            $this->out("<error>Migration failed. Rolling back.</error>");
            $db->rollback();
            throw $e;
        }
    }
}
