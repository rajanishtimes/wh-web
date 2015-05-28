<?php

namespace WH\Core;
use Phalcon\Mvc\Controller;
use WH\Api\Params;
use WH\Model\Util\WhMongo;
use WH\Model\Core\Constants as C;

class BaseController extends Controller{
	public $api_end_point;
	public $meta_description = '';
	public $meta_keywords = '';
	public $meta_author = '';
	public $og_title = '';
	public $og_type = '';
	public $og_description = '';
	public $og_image = '';
	public $og_url = '';
	public $canonical_url = '';
	public $deep_link = '';
	public $city = 'delhi-ncr';
    public $currentCity = 'delhi-ncr';
    public $defaultCity = 'delhi-ncr';
    public $cityId = 0;
	public $request;
	public $baseUrl;
	public $entityid = 0;
	public $entitytype = '';
	
    protected function initialize()
    {
		$GLOBALS["time_end"] = microtime(true);
		$GLOBALS["logs"]['base_initialize'] = $GLOBALS["time_end"] - $GLOBALS["time_start"];
		$GLOBALS["time_start"] = microtime(true);
		$this->request = new \Phalcon\Http\Request();
		$this->tag->prependTitle($this->config->application->SiteName.' | ');
		$this->view->meta_description = $this->meta_description;
		$this->view->meta_keywords = $this->meta_keywords;
		$this->view->meta_author = $this->meta_author;
		
		$this->view->og_title = $this->og_title;
		$this->view->og_type = $this->og_type;
		$this->view->og_description = $this->og_description;
		$this->view->og_image = $this->og_image;
		$this->view->og_url = $this->og_url;
		$this->view->canonical_url = $this->canonical_url;
		$this->view->deep_link = $this->deep_link;
		$this->view->og_site_name = $this->config->application->SiteName;
		$this->view->constants=$this->getConstants();
		
		$this->view->host = $this->config->application->baseUri;
		$this->baseUrl = 'http://'.$this->config->application->baseUri;
		$this->view->baseUrl = $this->baseUrl;

		$this->view->isdebug = $this->config->application->mode;
		$this->view->isdeep_link = $this->config->application->deeplink_autoredirect;
	
		//$this->setcookie();
		$this->view->controllername = $this->dispatcher->getControllerName();
		$this->view->actionname = $this->dispatcher->getActionName();
		$this->view->request_uri = $this->baseUrl.'/'.trim($_SERVER['REQUEST_URI'], '/');
		$this->view->entityid = $this->entityid;
		$this->view->entitytype = $this->entitytype;
		
		//echo $this->dispatcher->getControllerName();exit;
		//echo $this->dispatcher->getActionName();exit;
		
		
		/* ============= Set cookie for city =============== */
		if($this->dispatcher->getParam('city') == 'delhi'){
			$request_uri = trim($_SERVER['REQUEST_URI'], '/');
			$url = str_replace("delhi","delhi-ncr",$request_uri);
			
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".$this->baseUrl.'/'.$url);
            exit;
        }
		
		$this->view->defaultCity = $this->defaultCity;
		$this->setcities();
		$this->setcityid();

		if($this->cityId == 0){
			$this->forwardtoerrorpage(404);
		}
		/* ============= Set cookie for city =============== */
		
		$isappclose = 0;
		if ($this->cookies->has("isappclose")){
			$isappclose = (int)$this->cookies->get("isappclose");
		}
		$this->view->isappclose = $isappclose;
		
		//
		//echo $this->cityId; exit;
		//if($this->cityId == 0){
			//$this->cookies->set("city", 'delhi', time() + 15 * 86400, '/', false, $this->config->application->baseUri);
		//	$this->city = 'delhi';
		//	$this->view->city = 'delhi';
		//	$this->setcityid();
			//$this->cookies->get("city")->delete();
			//$this->forwardtoerrorpage(404);
		//}
		
    }

    /* protected function forward($uri){
        $uriParts = explode('/', $uri);
        $params = array_slice($uriParts, 2);
    	return $this->dispatcher->forward(
    		array(
    			'controller' => $uriParts[0],
    			'action' => $uriParts[1],
                'params' => $params
    		)
    	);
    } */
	
	protected function forwardtoerrorpage($errorcode){
        if($errorcode == 404){
			$Logger = new \WH\Model\Logger();
            $Logger->setCode('404');
            $Logger->setMessage('Page not found');
            $Logger->setOrigin('web');
            $Logger->setParamsValue($_SERVER['REQUEST_URI']);
            $Logger->allLogs();
			$this->tag->setTitle('Page Not Found | '.$this->config->application->SiteName);
			$this->response->setStatusCode(404, 'Not Found');
			$this->view->pick('errors/show404');
			$this->view->setLayout('errorpageLayout');
			
		}
		
		if($errorcode == 401){
			$Logger = new \WH\Model\Logger();
            $Logger->setCode('401');
            $Logger->setMessage('Unauthorized Access');
            $Logger->setOrigin('web');
            $Logger->setParamsValue($_SERVER['REQUEST_URI']);
            $Logger->allLogs();
			$this->response->setStatusCode(401, 'Unauthorized Access');
			$this->view->pick('errors/show401');
		}
		
		if($errorcode == 500){
			$Logger = new \WH\Model\Logger();
            $Logger->setCode('500');
            $Logger->setMessage('Internal Server Error');
            $Logger->setOrigin('web');
            $Logger->setParamsValue($_SERVER['REQUEST_URI']);
            $Logger->allLogs();
			$this->response->setStatusCode(500, 'Internal Server Error');
			$this->view->pick('errors/show500');
		}
		
    }
	
	protected function sendCurl($url, $params = array()){
		$query = http_build_query($params);
		if(!empty($query)){
			$url = $url.'?'.$query;
		}
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);
		curl_close($ch);
		return json_decode($data);
	}
	
	protected function create_slug($string){
		//$slug=str_replace(' ', '-', trim($string));
		$slug2=urlencode(trim($string));
		return $slug2;
	}

	protected function create_title($string){
		$slug2 = urldecode(trim($string));
		//$slug2 = str_replace('-', ' ', $slug);
		return $slug2;
	}
	
	protected function getfeeddata($start, $limit, $city, $bydays, $filter_type='', $keyword='', $bytype='', $location='', $type=''){
		
		$Search = new \WH\Model\Solr();
		$Search->setParam('bycity',$this->cityshown($city));
		$Search->setParam('start',$start);
		$Search->setParam('limit',$limit);
		$Search->setParam('byType',$bytype);
		$Search->setParam('byLocation',$location);

		/*if($keyword == ''){
			$Search->setRealTime(C::getWHConfig('realtime'));
			
		}*/
		
		
		$Search->setParam('mm',3);
		$Search->setSolrType('search');
		
		if(strtolower($bydays)!='all')
			$Search->setParam('byDays',ucwords(strtolower($bydays)));
		
		if($filter_type=='tags')
			$Search->setParam('byTags',strtolower($keyword));
		else
			$Search->setParam('searchname',$keyword);
		
		if($keyword==''){
			$Search->setParam('sponsored','true');
			$Search->setParam('spstart',$start);
			$Search->setParam('splimit',$limit);
		}
		
		
		if(isSet($keyword) && $keyword!='')
			$sort_by=1;
		else{
			if(isSet($bydays) && strtolower($bydays) != 'all' )
				$sort_by=4;
			else
				$sort_by=2;
		}

		if($filter_type=='tags')
			$sort_by=2;

		
		$Search->setParam('bysort',$sort_by);
		$Search->setSearchEntity();
		$entityresult = $Search->getSearchResults();
			
		if($entityresult){
			foreach($entityresult['results'] as $key=>$entity){
				if(!empty($entity['image']['uri'])){
					if(substr($entity['image']['uri'], 0, 4) != 'http'){
						$entityresult['results'][$key]['image']['uri'] = $this->getimageendpoint().$entityresult['results'][$key]['image']['uri'];
					}
				}
				//$entityresult['results'][$key]['slug'] = $this->create_slug($entity['title']).'-'.str_replace('_', '-', strtolower($entity['id']));
			}
		}

		if($filter_type=='tags'){
			foreach($entityresult['results'] as $key=>$entity){
				$entityresult['results'][$key]['filter_type'] ='tags';
			}	
		}

		//echo "<pre>"; print_r($entityresult); exit;
		return $entityresult;
	}
	
	protected function breadcrumbs($arr){
		$bdc = array('What&apos;s Hot'=>$this->baseUrl);
		$breadcrumbs = array_merge($bdc, $arr);
		return $breadcrumbs;
	}
	
	protected function getConstants(){
        $constants=new \WH\Model\Constants();
        $constants->setSource('web');
        $allConstants=$constants->getResults();
        return $allConstants;
    }
	
	private function setcookie(){
		if ($this->cookies->has('uniquekey')) {
			$uniquekey = $this->cookies->get('uniquekey');
        }else{
			$uniquekey = md5(microtime().$_SERVER['REMOTE_ADDR']);
			$this->cookies->set("uniquekey", $uniquekey, time() + 15 * 86400, '/', false, $this->config->application->baseUri);
		}
	}
	
	protected function setHomeCity(){
		//echo __FUNCTION__ . '<br/>';
		if ($this->cookies->has("city")){
			if( strlen($this->cookies->get("city")) > 15 ){
				$this->city = strtolower('delhi-ncr');
			}else if( $this->cookies->get("city") == 'delhi' ){
				$this->city = strtolower('delhi-ncr');
			}else{
				$this->city = strtolower($this->cookies->get("city"));
			}
		}else if($this->dispatcher->getParam('city')){
			if(trim($this->dispatcher->getParam('city')) == 'cities'){
				$ccityformulti = $this->defaultCity;
			}else{
				$ccityformulti = strtolower($this->dispatcher->getParam('city'));
			}
			$this->city = $ccityformulti;
		}

		$this->view->city = $this->city;
	}

	protected function setcities($cityname = ''){
		//echo __FUNCTION__ . '<br/>';
		$this->setHomeCity();
		if(trim($this->dispatcher->getParam('city')) == 'cities'){			
			if ($this->cookies->has("currentCity") && empty($cityname)){
				$cityformulti = strtolower($this->cookies->get("currentCity"));
			}else{
				if(!empty($cityname)){
					$cityformulti = $cityname;
				}else{
					$cityformulti = $this->defaultCity;
				}
			}
			$this->currentCity = $cityformulti;
		}else if($this->dispatcher->getParam('city')){
			$this->currentCity = strtolower($this->dispatcher->getParam('city'));
		}else if ($this->cookies->has("city")){
			if( $this->cookies->get("city") == 'delhi-ncr' ){
				$this->currentCity = strtolower($this->defaultCity);
			}else{
				$this->currentCity = strtolower($this->cookies->get("city"));
			}
		}
		$this->view->currentCity = $this->currentCity;
		
		/* if($this->dispatcher->getParam('city')){
                    $this->city = $this->dispatcher->getParam('city');
                    //$this->cookies->set("city", $this->city, time() + 15 * 86400, '/', false, $this->config->application->baseUri);
                    $this->view->city = strtolower($this->city);
            }else{
                    if ($this->cookies->has("city")){
                            $this->city = strtolower($this->cookies->get("city"));
                            $this->view->city = strtolower($this->city);
                    }else{
                            //$this->cookies->set("city", 'delhi', time() + 15 * 86400, '/', false, $this->config->application->baseUri);
                            $this->city = 'delhi';
                           $this->view->city = 'delhi';
                    }
            } */
	}

	public function setreferrelcities($cities){
		//echo __FUNCTION__ . '<br/>';
		foreach($cities as $key=>$city){
			if($cities[$key] == 'Delhi NCR' || $cities[$key] == 'Delhi-NCR'){
				$cities[$key] = 'delhi-ncr';
			}else{
				$cities[$key] = strtolower($city);
			}
		}
		
		if(in_array($this->currentCity, $cities)){
			
		}else{
			$this->currentCity = $cities[0];
		}
		$this->setcities($this->currentCity);
		//exit();
	}
	
	protected function setcityid(){		
		$cities = new \WH\Model\Cities();
		$getallcities = $cities->getResults();
		usort($getallcities['cities'], function($a, $b){ return strcmp($a["name"], $b["name"]); });
		$this->view->allcities = $getallcities;
		foreach($getallcities['cities'] as $getallcity){
			if(strtolower($getallcity['name']) == 'delhi ncr'){
				$drawdity = 'delhi-ncr';
			}else{
				$drawdity = strtolower($getallcity['name']);
			}
			
			if($drawdity == $this->currentCity){
				$this->cityId = $getallcity['id'];
				break;
			}
		}
	}
	
	

	public function getimageendpoint(){
		$i = rand(0,5);
		$img_url='imgbaseUri'.$i;
		$url = $this->config->application->$img_url;
		return $url;
	}
	
	public function validateRequest($url){
		$request_uri = trim($_SERVER['REQUEST_URI'], '/');
		$arr = explode('?', $request_uri);
		$request_uri = urldecode($arr[0]);
		$uri = urldecode(trim($url, '/'));
		if($uri != $request_uri){
			$this->response->redirect($this->baseUrl.$url, true, 301);
		}
	}
	
	public function getlogs($type, $uri){
		$Mongo = new WhMongo();
		$Mongo->setCollection('api_web_logs');
		$overall = 0;
		foreach($GLOBALS["logs"]['timings'] as $key=>$timing){
			$overall = $overall + $timing;
			$GLOBALS["logs"]['timings'][$key] = $timing * 1000;
		}
		$GLOBALS["logs"]['overall'] = $overall * 1000;
		$GLOBALS["logs"]['uri'] = $uri;
		$GLOBALS["logs"]['type'] = $type;
		//echo "<pre>"; print_r($GLOBALS["logs"]); exit;
		$saveData=$Mongo->save($GLOBALS["logs"]);
	}
	public function setlogsarray($key){
		$GLOBALS["time_end"] = microtime(true);
		$GLOBALS["logs"]['timings'][$key] = $GLOBALS["time_end"] - $GLOBALS["time_start"];
		$GLOBALS["time_start"] = microtime(true);
	}
	
	public function makeurl($url, $image_url){
		if($image_url == ''){
			$imgurl = $url.'/img/img_feed_default.png';
		}else{
			$pos = strpos($image_url, 'http');
			if($pos !== false){
				$imgurl = $image_url;
			}else{
				$imgurl = $this->getimageendpoint().$image_url;
			}
		}		
		return $imgurl;
	}
	
	public function cityshown($city){
		if($this->currentCity == 'delhi-ncr')
			$cityshown = 'Delhi NCR';
		else
			$cityshown = ucwords($city);
		
		return $cityshown;
	}
}
