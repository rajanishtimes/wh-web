<?php

include_once __DIR__.'/Connection.php';

class SQL{
    
    public static $mysqli = array();
    public static $dbconfig = array();
    
    function __construct() {
        
    }
    
    public static function getCon($config='cheetah'){
        if( isset(self::$mysqli) && isset(self::$mysqli[$config])) return self::$mysqli[$config];
        $dbConfig=  Connection::getMySqlConfig();
        $con = self::getConnection($dbConfig);
        self::$mysqli[$config] = $con;
        return $con;
    }
    
    static function getConnection($config){
      $password = '';
        if (isset($config['host'])) {
            $server = $config['host'];
            if (isset($config['username']) && !empty($config['username'])) $username = $config['username'];
            if (isset($config['password']) && !empty($config['password'])) $password = $config['password'];
            if (isset($config['dbname']) && !empty($config['dbname'])) $database = $config['dbname'];
            $con = mysqli_connect($server, $username, $password, $database);
            return $con;
        } else {
            
            throw new Exception('Invalid config passed ' . __LINE__ . __FILE__ );
        }
        return false;
    }
    
    
    
    public static function bindResults($stmt)
    {
        $meta = $stmt->result_metadata();
        $result = array();
        while ($field = $meta->fetch_field())
        {
            $result[$field->name] = NULL;
            $params[] = &$result[$field->name];
        }
        call_user_func_array(array($stmt, 'bind_result'), $params);
        return $result;
    }
    
    public static function getValues($row){
        $ret_arr = array();
        foreach ($row as $key=>$val){
            $ret_arr[$key] = $val;
        }
        return $ret_arr;
    }
    
    public static function queryGet($query, $param_string, $param_array, $return_type = 'row' , $config = null){
      
        array_unshift($param_array, $param_string);
        
        $params = array();
        foreach($param_array as $key => $val){
            $params[$key] = &$param_array[$key];
        }
        
        if($config && is_string($config))
        {
            $con = self::getCon($config);
        }
        else
        {
            $con = self::getCon();
        }
        
        $stmt = $con->prepare($query);
        
        if ( false===$stmt ) {
             echo $con->error;exit;
        }
        call_user_func_array(array($stmt, "bind_param"), $params);
        $stmt->execute();
        
        $result = array();
        
    
        if($return_type == 'row'){            
            $result = self::bindResults($stmt);            
            if(!$stmt->error){
                $stmt->fetch();
            }else{
                $result = $stmt->error;                
            }            
        }else{            
            $row = self::bindResults($stmt);            
            if(!$stmt->error){
                while($stmt->fetch())
                    $result[] = self::getValues ($row);
            }else{
                $result = $stmt->error;
            }
        }
        $stmt->close();
        return $result;
    }
    
    public static function queryInsert($query, $param_string, $param_array, $config = null){
        
        array_unshift($param_array, $param_string);
        
        $params = array();
        foreach($param_array as $key => $val){
            $params[$key] = &$param_array[$key];
        }
        
        if($config && is_string($config))
        {
            $con = self::getCon($config);
        }
        else
        {
            $con = self::getCon();
        }
        
        $stmt = $con->prepare($query);
        if ( false===$stmt ) {

            ExceptionEmail::sendEmail(2, $con->error, 'SQL');
            return false;
        }
        call_user_func_array(array($stmt, 'bind_param'), $params);
        $stmt->execute();
        
        
        if($stmt->error){
            $result = $stmt->error;
        }
        else{
            if($stmt->insert_id)
                $result = $stmt->insert_id;
            else
                $result = $stmt->affected_rows;
        }
            
        $stmt->close();
        return $result;
    }
    
    public static function queryUpdate($query, $param_string, $param_array, $config = null){
        array_unshift($param_array, $param_string);
        
        $params = array();
        foreach($param_array as $key => $val){
            $params[$key] = &$param_array[$key];
        }
        
        if($config && is_string($config))
        {
            $con = self::getCon($config);
        }
        else
        {
            $con = self::getCon();
        }
        
        $stmt = $con->prepare($query);
        if ( false===$stmt ) {
            ExceptionEmail::sendEmail(2, $con->error, 'SQL');
        }
        call_user_func_array(array($stmt, "bind_param"), $params);
        $stmt->execute();
        
        if(!$stmt->error)
            $result = true;
        else
            $result = $stmt->error;
        
        $stmt->close();
        return $result;
    }
    
    public static function queryDelete($query, $param_string, $param_array, $config = null){
        array_unshift($param_array, $param_string);
        
        $params = array();
        foreach($param_array as $key => $val){
            $params[$key] = &$param_array[$key];
        }
        
        if($config && is_string($config))
        {
            $con = self::getCon($config);
        }
        else
        {
            $con = self::getCon();
        }
        
        $stmt = $con->prepare($query);
        call_user_func_array(array($stmt, "bind_param"), $params);
        $stmt->execute();
        
        if(!$stmt->error)
            $result = true;
        else
            $result = $stmt->error;
        
        $stmt->close();
        return $result;
    }
}