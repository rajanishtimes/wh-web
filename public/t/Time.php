<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once __DIR__.'/SQL.php';

class Time {
    
    public function processTime($value) {
        
        $timestamp = $value;
        $time_year = date('Y',$value);
        $time_month = date('m',$value);
        $time_day = date('d',$value);
        $time_hour = date('H',$value);
        $time_minute = date('m',$value);
        $time_sec = date('s',$value);
        $week = date('W',$value);
        $weekday = date('w',$value);
        $time_month_name = date('M',$value);
        $time_day_text = date('l',$value);

        $insertQuery = 'insert into dim_time (timestamp, time_year, time_month, time_day, time_hour, time_minute, time_sec, week, weekday, time_month_name, time_day_text) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        
        $param_string = 'iiiiiiiiiss';
        $param_array = array();
        $param_array[] = $timestamp;
        $param_array[] = $time_year;
        $param_array[] = $time_month;
        $param_array[] = $time_day;
        $param_array[] = $time_hour;
        $param_array[] = $time_minute;
        $param_array[] = $time_sec;
        $param_array[] = $week;
        $param_array[] = $weekday;
        $param_array[] = $time_month_name;
        $param_array[] = $time_day_text;
        
        $insertID = SQL::queryInsert($insertQuery, $param_string, $param_array);
        return $insertID;
    }
    
}
