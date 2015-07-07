<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once __DIR__.'/Dimension.php';
include_once __DIR__.'/Connection.php';
include_once __DIR__.'/Time.php';

class Process {
    
    
    public static function processClick($mongoId){
        $mongoData = self::getDataFromMongo($mongoId);
        if(!empty($mongoData)){
            $processedRecord = self::processData($mongoData);
            self::saveActivityLog($processedRecord);
        }
    }
    
    private static function getDataFromMongo($mongoId){ 
        $mongo = Connection::setMongoCollection('web_clicks');
        return $mongo->findOne(array('_id'=>new MongoId($mongoId)));
    }
    
    private static function processData($data){
        
        $returnData = array();
        
        if(isset($data['d']) && $data['d']!=''){
            $returnData['domain_id'] = $domainID = self::processDomain($data['d']);
            $returnData['url_id'] = self::processURL($domainID, $data['d']); 
        }
        
        if(isset($data['session_id']) && $data['session_id']!=''){
            $returnData['session_id'] = $data['session_id'];
            $returnData['dim_session_id'] = self::processSession($data['session_id']); 
        }

        if(isset($data['r']) && $data['r']!=''){
            $returnData['channel_id'] = $channelID = self::processChannel($data['r']);
            $returnData['referer_id'] = self::processURL($channelID, $data['r']); 
        }
        
        if(isset($data['src']) && $data['src']!=''){
            $returnData['dim_src_id'] = self::processSrc($data['src']); 
        }
        
        if(isset($data['user_agent']) && $data['user_agent']!=''){
            $userAgent = self::processUserAgent($data['user_agent']);
            if(isset($userAgent['platform']) && $userAgent['platform']!=''){
                $returnData['platform_id'] = self::processPlatform($userAgent['platform']);
                $returnData['os_id'] = self::processOS($userAgent['platform']);
            }

            if(isset($userAgent['name']) && $userAgent['name']!=''){
                $returnData['browser_id'] = self::processBrowser($userAgent['name']);
            }
            
            if(isset($userAgent['version']) && $userAgent['version']!=''){
                $returnData['browser_version'] = self::processBrowserVersion($userAgent['version']);
            }
        }
        if(isset($data['t']) && $data['t']!=''){
            $returnData['time'] = date('Y-m-d H:i:s',$data['t']->sec);
            
            $returnData['time_id'] = Time::processTime($data['t']->sec);
        }
        
        if(isset($data['p']) && $data['p']!=''){
            $returnData['xpath_id'] = self::processXPath($data['p']); 
        }
        
        if(isset($data['text']) && $data['text']!=''){
            $returnData['xpath_text_id'] = self::processXPathText($data['text']); 
        }
        
        if(isset($data['city']) && $data['city']!=''){
            $returnData['city_id'] = self::processCity($data['city']); 
        }
        
        if(isset($data['_id']) && $data['_id']!=''){
            $returnData['activity_id'] = (string)$data['_id']; 
        }
         
        if(isset($data['d']) && $data['d']!=''){
            $returnData['data'] = $data['d']; 
        } 
        
        if(isset($data['lag']) && $data['lag']!=''){
            $returnData['time_elapsed_since_page_load'] = $data['lag']; 
        }
        
        if(isset($data['x']) && $data['x']!=''){
            $returnData['x'] = $data['x']; 
        }
        
        if(isset($data['y']) && $data['y']!=''){
            $returnData['y'] = $data['y']; 
        }
        
        if(isset($data['w']) && $data['w']!=''){
            $returnData['width'] = $data['w']; 
        }
        
        if(isset($data['l']) && $data['l']!=''){
            $returnData['length'] = $data['l']; 
        }
        
        if(isset($data['h']) && $data['h']!=''){
            $returnData['height'] = $data['h']; 
        }
        
        if(isset($data['ip']) && $data['ip']!=''){
            $returnData['ipAddress'] = $data['ip']; 
        }

        if(isset($data['browser_id']) && $data['browser_id']!=''){
            $returnData['user_uid'] = $data['browser_id']; 
        }
        
        return $returnData;
    }
    
    private static function saveActivityLog($data) {
        $param_string = '';
        $param_array = array();
        $quesMrks = array();
        $keys = array();
        if(!empty($data)){
            foreach ($data as $key => $value) {
                if(is_int($key)){
                    $param_string .= 'i';
                }
                else{
                    $param_string .= 's';
                }
                $param_array[] = $value;
                $quesMrks[] = '?';
                $keys[] = $key;
            }
            $query = 'insert into activity_log_line_items ('.implode(', ',$keys).') values ('.implode(', ',$quesMrks).')';
            
            SQL::queryInsert($query, $param_string, $param_array);
            
        }
    }

    private static function processURL($domainID, $url){
        $url = urldecode($url);
        $urlID = Dimension::saveNGetURLID($domainID, $url);
        return $urlID;
    }
    
    private static function processSession($domain) {
        
        $domainID = Dimension::saveNGetID('domains',$domain);
        return $domainID;
        
    }
    
    private static function processDomain($url) {
        
        $domainID = 0;
        $url = urldecode($url);
        $splitURL = parse_url($url);
        
        if(isset($splitURL['host'])){
            $domain = $splitURL['host'];
            $domainID = Dimension::saveNGetID('domains',$domain);
        }
        return $domainID;
    }
    
    private static function processChannel($url) {
        
        $channelID = 0;
        $url = urldecode($url);
        $splitURL = parse_url($url);
        
        if(isset($splitURL['host'])){
            $channel = $splitURL['host'];
            $channelID = Dimension::saveNGetID('dim_channels',$channel);
        }
        return $channelID;
        
    }
     
    private static function processSrc($session) {
        
        $src_id = Dimension::saveNGetID('dim_src',$session);
        return $src_id;
        
    }
    private static function processPlatform($platform) {
        
        $platform_id = Dimension::saveNGetID('dim_platforms',$platform);
        return $platform_id;
        
    }
    
    private static function processOS($os) {
        
        $os_id = Dimension::saveNGetID('dim_os',$os);
        return $os_id;
        
    }
    
    private static function processBrowser($browser) {
        
        $browser_id = Dimension::saveNGetID('dim_browsers',$browser);
        return $browser_id;
        
    }
    
    private static function processBrowserVersion($version) {
        
        $browser_version_id = Dimension::saveNGetID('dim_browser_versions',$version);
        return $browser_version_id;
        
    }
    
    private static function processXPath($xpath) {
        
        $xpath_id = Dimension::saveNGetID('dim_xpath',$xpath);
        return $xpath_id;
        
    }
     
    private static function processXPathText($xpathtext) {
        
        $xpathtext_id = Dimension::saveNGetID('dim_xpath_text',$xpathtext);
        return $xpathtext_id;
        
    }

    private static function processCity($city) {
        
        $city_id = Dimension::saveNGetID('dim_city',$city);
        return $city_id;
        
    }
    
    
    private static function processUserAgent($useragent) {
         
        $u_agent = $useragent; 
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
        { 
            $bname = 'Internet Explorer'; 
            $ub = "MSIE"; 
        } 
        elseif(preg_match('/Firefox/i',$u_agent)) 
        { 
            $bname = 'Mozilla Firefox'; 
            $ub = "Firefox"; 
        } 
        elseif(preg_match('/Chrome/i',$u_agent)) 
        { 
            $bname = 'Google Chrome'; 
            $ub = "Chrome"; 
        } 
        elseif(preg_match('/Safari/i',$u_agent)) 
        { 
            $bname = 'Apple Safari'; 
            $ub = "Safari"; 
        } 
        elseif(preg_match('/Opera/i',$u_agent)) 
        { 
            $bname = 'Opera'; 
            $ub = "Opera"; 
        } 
        elseif(preg_match('/Netscape/i',$u_agent)) 
        { 
            $bname = 'Netscape'; 
            $ub = "Netscape"; 
        } 

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }
            else {
                $version= $matches['version'][1];
            }
        }
        else {
            $version= $matches['version'][0];
        }

        // check if we have a number
        if ($version==null || $version=="") {$version="?";}

        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
    }
}
