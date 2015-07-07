<?php

class Connection {
    
    static $mysql_cons = array();
    static $mongo_cons = array();
    
    static function getMySqlConfig() {
        return array('host' => 'localhost', 'dbname' => 'cheetah', 'username' => 'root', 'password' => '');
    }

    static function setMongoCollection($collection) {
        
        if (isSet(self::$mongo_cons[$collection])) {
            return self::$mongo_cons[$collection];
        }
        
        $mongo = array('mongo_server' => '192.169.29.102:27017', 'mongo_db' => 'wh_main', 'mongo_collection' => 'web_clicks');
        
        $m = new Mongo($mongo['mongo_server']);
        $db = $m->selectDB($mongo['mongo_db']);
        $coll = new MongoCollection($db, $mongo['mongo_collection']);
        
        self::$mongo_cons[$collection] = $coll;
        return $coll;
    }
    
}
