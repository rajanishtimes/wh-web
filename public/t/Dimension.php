<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once __DIR__.'/SQL.php';

class Dimension {
    
    public function saveNGetID($table, $value) {
        $query = 'select id from '.$table.' where value = ?';
        $param_string = 's';
        $param_array = array();
        $param_array[] = $value;
        
        /*Checking if duplicate url exist in database and returns its ID*/
        $checkInDb = SQL::queryGet($query, $param_string, $param_array, 'row');
        if(isset($checkInDb['id']) && $checkInDb['id']!='')
            return $checkInDb['id'];
        
        /*Saving domain in table and returning its ID*/
        
        $insertQuery = 'insert into '.$table.' (value) values (?)';
        $insertID = SQL::queryInsert($insertQuery, $param_string, $param_array);
        return $insertID;
    }
    
     public function saveNGetURLID($domainID, $url) {
        $query = 'select url_id from urls where url = ? and domain_id = ?';
        $param_string = 'ss';
        $param_array = array();
        $param_array[] = $url;
        $param_array[] = $domainID;
        
        /*Checking if duplicate url exist in database and returns its ID*/
        $checkInDb = SQL::queryGet($query, $param_string, $param_array, 'row');
        if(isset($checkInDb['url_id']) && $checkInDb['url_id']!='')
            return $checkInDb['url_id'];
        
        /*Saving domain in table and returning its ID*/
        
        $insertQuery = 'insert into urls (url, domain_id) values (?, ?)';
        $insertID = SQL::queryInsert($insertQuery, $param_string, $param_array);
        return $insertID;
    }
}
