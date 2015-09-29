<?php

namespace WH\Core;
use Phalcon\Mvc\Controller;
use Phalcon\Filter;
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
	public $meta_og_author = '';
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
	public $iswebview = false;
	public $logged_user = array();
	public $profileid = '';
	
    protected function initialize()
    {
		$GLOBALS["time_end"] = microtime(true);
		$GLOBALS["logs"]['base_initialize'] = $GLOBALS["time_end"] - $GLOBALS["time_start"];
		$GLOBALS["time_start"] = microtime(true);
		$this->request = new \Phalcon\Http\Request();
		$userInfo = $this->session->get('userInfo');

		if ((strpos($this->request->getServer('HTTP_USER_AGENT'), 'Mobile/') !== false) && (strpos($this->request->getServer('HTTP_USER_AGENT'), 'Safari/') == false)) {
			$this->iswebview = true;
		}		
		if($this->request->getServer('HTTP_X_REQUESTED_WITH') !== null) {
			if($this->request->getServer('HTTP_X_REQUESTED_WITH') == "com.phdmobi.timescity") {
				$this->iswebview = true;
			}
		}
		$this->view->iswebview = $this->iswebview;
		

		$this->tag->prependTitle($this->config->application->SiteName.' | ');
		$this->view->meta_description = $this->meta_description;
		$this->view->meta_keywords = $this->meta_keywords;
		$this->view->meta_author = $this->meta_author;
		
		$this->view->og_title = $this->og_title;
		$this->view->og_type = $this->og_type;
		$this->view->og_description = $this->og_description;
		$this->view->og_image = $this->og_image;
		$this->view->meta_og_author = $this->meta_og_author;
		$this->view->og_url = $this->og_url;
		$this->view->canonical_url = $this->canonical_url;
		$this->view->deep_link = $this->deep_link;
		$this->view->og_site_name = $this->config->application->SiteName;
		$this->view->constants=$this->getConstants();
		
		$this->view->host = $this->config->application->baseUri;

		if ($this->request->getServer('HTTPS') !== null && ($this->request->getServer('HTTPS') == 'on' || $this->request->getServer('HTTPS') == 1) || $this->request->getServer('HTTP_X_FORWARDED_PROTO') !== null && $this->request->getServer('HTTP_X_FORWARDED_PROTO') == 'https') {
			$protocol = 'https://';
		}	else {
			$protocol = 'http://';
		}

		$this->baseUrl = $protocol.$this->config->application->baseUri;
		$this->view->baseUrl = $this->baseUrl;

		$this->view->isdebug = $this->config->application->mode;
		$this->view->isdeep_link = $this->config->application->deeplink_autoredirect;
	
		//$this->setcookie();
		$this->view->controllername = $this->dispatcher->getControllerName();
		$this->view->actionname = $this->dispatcher->getActionName();
		$this->view->request_uri = $this->baseUrl.'/'.trim($this->request->getServer('REQUEST_URI'), '/');
		$this->view->entityid = $this->entityid;
		$this->view->entitytype = $this->entitytype;
		
		//echo $this->dispatcher->getControllerName();exit;
		//echo $this->dispatcher->getActionName();exit;
		
		if ((strpos($this->request->getServer('HTTP_USER_AGENT'), 'Mobile/') !== false) && (strpos($this->request->getServer('HTTP_USER_AGENT'), 'Safari/') == false)) {
			$this->iswebview = true;
		}
		
		if($this->request->getServer('HTTP_X_REQUESTED_WITH') !== null){
			if($this->request->getServer('HTTP_X_REQUESTED_WITH') == "com.phdmobi.timescity") {
				$this->iswebview = true;
			}	
		}
		$this->view->iswebview = $this->iswebview;

		
		/* ============= Set cookie for city =============== */
		if($this->dispatcher->getParam('city') == 'delhi'){
			$request_uri = trim($this->request->getServer('REQUEST_URI'), '/');
			$url = str_replace("delhi","delhi-ncr",$request_uri);
			$urls = explode('?', $url);
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".$this->baseUrl.'/'.urldecode($urls[0]));
			exit;
        }
		
		$this->profileid = $this->getprofileid($this->dispatcher->getParam('city'));
		$this->view->profileid = $this->profileid;

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
		$this->compressfiles();
		$this->logged_user = $this->setlogin();
		$this->view->logged_user = $this->logged_user;	

		/* ============= Set data for footer =============== */
		if ($this->request->isAjax() == false) {
			$this->setdataforfooter();
		}
		/* ============= Set data for footer =============== */

    }

    protected function getprofileid($username){
    	if(!empty($username)){
    		$reserved = explode(',', $this->config->application->reservedkeyword);
	    	if(in_array($username, $reserved)){
	    		return '';
	    	}else{
	    		$addprofile = new \WH\Model\UserProfile();
				$addprofile->setUsername($username);
				$profiledata = $addprofile->getProfile();
				if(isSet($profiledata['username']) && !empty($profiledata['username'])){
					return $profiledata['username'];
				}else{
					return '';
				}
	    	}	
    	}else{
    		return '';
    	}
    	
    	//return 'cxah7jfirziyen1bbxume2eus';
    	//return '8sugn4aimbo8ifbndbuxolzhl';
    }


    protected function compressfiles(){
    	if($this->config->application->environment == 'local'){
			$this->assets
				->collection('header')
				->setPrefix($this->baseUrl)
				->setLocal(false)
				->setTargetPath(APP_PATH.'public/css/header.css')
				->setTargetUri('/css/header.css')
	            ->addCss($this->baseUrl.'/css/bootstrap.min.css', false)
	            ->addCss($this->baseUrl.'/plugins/owl-carousel/owl.carousel.css', false)
	            ->addCss($this->baseUrl.'/plugins/owl-carousel/owl.theme.css', false)
	            ->addCss($this->baseUrl.'/plugins/swipebox/src/css/swipebox.css', false)
	            ->addCss($this->baseUrl.'/css/jquery.smartbanner.css', false)
	            ->join(true)
	            ->addFilter(new \Phalcon\Assets\Filters\Cssmin());

	        $this->assets
				->collection('main')
				->setPrefix($this->baseUrl)
				->setLocal(false)
				->setTargetPath(APP_PATH.'public/css/main.css')
				->setTargetUri('/css/main.css')
	            ->addCss($this->baseUrl.'/css/style.css', false)
	            ->addCss($this->baseUrl.'/css/style-responsive.css', false)
	            ->join(true)
	            ->addFilter(new \Phalcon\Assets\Filters\Cssmin());

	        $this->assets
				->collection('js')
				->setPrefix($this->baseUrl)
				->setLocal(false)
				->setTargetPath(APP_PATH.'public/js/main.js')
				->setTargetUri('/js/main.js')
	            ->addJs($this->baseUrl.'/js/bootstrap.min.js', false)
	            ->addJs($this->baseUrl.'/js/typeahead.min.js', false)
	            ->addJs($this->baseUrl.'/plugins/owl-carousel/owl.carousel.min.js', false)
	            ->addJs($this->baseUrl.'/plugins/swipebox/src/js/jquery.swipebox.min.js', false)
	            ->addJs($this->baseUrl.'/js/jquery.unveil.js', false)
	            ->addJs($this->baseUrl.'/js/cookies.js', false)
	            ->addJs($this->baseUrl.'/js/jquery.smartbanner.js', false)
	            ->join(true)
	            ->addFilter(new \Phalcon\Assets\Filters\Jsmin());

	        $this->assets
				->collection('appsjs')
				->setPrefix($this->baseUrl)
				->setLocal(false)
				->setTargetPath(APP_PATH.'public/js/app.js')
				->setTargetUri('/js/app.js')
	            ->addJs($this->baseUrl.'/js/apps.js', false)
	            ->join(true)
	            ->addFilter(new \Phalcon\Assets\Filters\Jsmin());
        }
    }

    protected function setlogin(){

    	$loggeduser = array();
    	$userloggedin =  array();

    	//$this->redis->write('testing', 'asdfsdf');
    	//echo "done"; exit;

    	// Read operation.


    	//$this->redis->write('foo', 'bar');
    	//$this->write_key_to_server('foo', 'bar2');
    	//$redis_result = array();
    	//$redis_result = $this->read_key_from_server('foodf');
    	//echo "<pre>"; print_r($redis_result); echo "</pre>";


		//$this->redis2->write('foo', 'bar');
    	//exit;

    	//$_SESSION['users'] = 'asdf'; exit;	
    	//echo session_id();
    	//$_SESSION[session_id()] = 'asdf'; exit;
		//$this->redis->write(session_id(), 'asdfsdf'); exit;
    	//echo session_id();
    	//echo $this->redis->read(session_id()); exit;
    	//echo $_SESSION[session_id()]; exit;
    	//echo "<pre>"; print_r($this->redis->read(session_id())); echo "</pre>"; exit;
    	//echo "<pre>"; print_r(); echo "</pre>";
		//echo session_id();exit;
    	//$userloggedin = $this->redis->read(session_id());
    	$userloggedin = $this->read_key_from_server(session_id());
    	//echo "<pre>"; print_r($userloggedin); echo "</pre>"; exit;

    	if(!empty($userloggedin)){
			$userarray = json_decode($userloggedin);
    		if(!empty($userarray)){
    			$userarray->image = "https://graph.facebook.com/".$userarray->facebook_user_id."/picture?width=150&height=150";
    			//$userarray->image = '//graph.facebook.com/'.$userarray->facebook_user_id.'/picture?type=large';
    			$loggeduser = $userarray;
    		}
    	}
    	return $loggeduser;
    }

    public function write_key_to_server($key, $value){
    	if(isset($this->redis->responsecode) && $this->redis->responsecode==61){

    	}else{
    		$this->redis->write($key, $value);
    	}

    	// if(isset($this->redis2->responsecode) && $this->redis2->responsecode==61){

    	// }else{
    	// 	$this->redis2->write($key, $value);
    	// }
	}
	
	public function read_key_from_server($key){
		if(isset($this->redis2->responsecode) && $this->redis2->responsecode==61){
			if(isset($this->redis->responsecode) && $this->redis->responsecode==61){
	    	}else{
	    		$key_result = $this->redis->read($key);
	    	}
    	}else{
    		if($this->redis2->read($key) == null){
    			if(isset($this->redis->responsecode) && $this->redis->responsecode==61){
		    	}else{
		    		$key_result = $this->redis->read($key);
		    	}
    		}else{
    			$key_result = $this->redis2->read($key);	
    		}
    	}
    	return $key_result;
	}

	protected function forwardtoerrorpage($errorcode){
        if($errorcode == 404){
			$Logger = new \WH\Model\Logger();
            $Logger->setCode('404');
            $Logger->setMessage('Page not found');
            $Logger->setOrigin('web');
            $Logger->setParamsValue($this->request->getServer('REQUEST_URI'));
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
            $Logger->setParamsValue($this->request->getServer('REQUEST_URI'));
            $Logger->allLogs();
			$this->response->setStatusCode(401, 'Unauthorized Access');
			$this->view->pick('errors/show401');
		}
		
		if($errorcode == 500){
			$Logger = new \WH\Model\Logger();
            $Logger->setCode('500');
            $Logger->setMessage('Internal Server Error');
            $Logger->setOrigin('web');
            $Logger->setParamsValue($this->request->getServer('REQUEST_URI'));
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
		$string = preg_replace('/\s+/', ' ',$string);
		$slug2=urlencode(trim($string));
		return $slug2;
	}

	protected function create_title($string){
		$slug2 = urldecode(trim($string));
		//$slug2 = str_replace('-', ' ', $slug);
		return $slug2;
	}
	
	protected function getfeeddata($start, $limit, $city, $bydays, $filter_type='', $keyword='', $bytype='', $location='', $type='', $spstart='', $splimit=''){

		$entityresult = $this->getallfeedsarray($start, $limit, $city, $bydays, $filter_type, $keyword, $bytype, $location, $type, $spstart, $splimit);
		
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
	

	protected function getallfeedsarray($start, $limit, $city, $bydays, $filter_type='', $keyword='', $bytype='', $location='', $type='', $spstart='', $splimit=''){
		$Searches = new \WH\Model\Solr();
		$Searches->setParam('bycity',$this->cityshown($city));
		$Searches->setParam('start',$start);
		$Searches->setParam('limit',$limit);
		$Searches->setParam('byType',$bytype);
		$Searches->setParam('byLocation',$location);
		$Searches->setParam('mm',3);
		$Searches->setSolrType('search');
		if(strtolower($bydays)!='all')
			$Searches->setParam('byDays',ucwords(strtolower($bydays)));
		if($filter_type=='tags')
			$Searches->setParam('byTags',strtolower($keyword));
		else{
			$Searches->setParam('searchname',$keyword);
			if($this->config->spellcheck->istrue == 1){
				$Searches->setParam('spellcheck','true');
			}
		}
		if($keyword==''){
			if($spstart == ''){
				$spstart = $start;
			}
			if($splimit == ''){
				$splimit = $limit;
			}

			if($type == 'feed'){
				$Searches->setParam('sponsored','true');
				$Searches->setParam('spstart',$spstart);
				$Searches->setParam('splimit',$splimit);	
			}else{
				$Searches->setParam('sponsored','false');
			}
		}
		if(isSet($keyword) && $keyword!='')
			$sort_by=1;
		else{
			if(isSet($bydays) && strtolower($bydays) != 'all' )
				$sort_by=4;
			else
				$sort_by=2;
		}

		if($type == 'footer'){
			$sort_by=10;
		}

		if($filter_type=='tags')
			$sort_by=2;
		$Searches->setParam('bysort',$sort_by);

		//echo "<pre>"; print_r($Searches); exit;
		$Searches->setSearchEntity();
		$entityresult = $Searches->getSearchResults();
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
			$uniquekey = $this->sanitizedata($this->cookies->get('uniquekey'));
        }else{
			$uniquekey = md5(microtime().$this->request->getServer('REMOTE_ADDR'));
			$this->cookies->set("uniquekey", $uniquekey, time() + 15 * 86400, '/', false, $this->config->application->baseUri);
		}
	}
	
	protected function setHomeCity(){
		//echo __FUNCTION__ . '<br/>';
		if ($this->cookies->has("city")){
			if( strlen($this->sanitizedata($this->cookies->get("city"))) > 15 ){
				$this->city = strtolower('delhi-ncr');
			}else if( $this->sanitizedata($this->cookies->get("city")) == 'delhi' ){
				$this->city = strtolower('delhi-ncr');
			}else{
				$cities = new \WH\Model\Cities();
				$getallcities = $cities->getResults();
				$getcitiesarray = array();
				foreach ($getallcities['cities'] as $key => $value) {
					if($value['name'] == 'Delhi NCR'){
						$getcitiesarray[$key] = 'delhi-ncr';	
					}else{
						$getcitiesarray[$key] = strtolower($value['name']);
					}
				}
				$sanitize_city = strtolower($this->sanitizedata($this->cookies->get("city")));
				if(in_array($sanitize_city, $getcitiesarray)){
					$this->city = strtolower($this->sanitizedata($this->cookies->get("city")));	
				}else{
					$this->city = $this->defaultCity;
				}
			}
		}else if($this->dispatcher->getParam('city')){
			if(trim($this->dispatcher->getParam('city')) == 'cities'){
				$ccityformulti = $this->defaultCity;
			}else if(!empty($this->profileid)){
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
				$cityformulti = strtolower($this->sanitizedata($this->cookies->get("currentCity")));
			}else{
				if(!empty($cityname)){
					$cityformulti = $cityname;
				}else{
					$cityformulti = $this->defaultCity;
				}
			}
			$this->currentCity = $cityformulti;
		}else if(!empty($this->profileid)){
			if($this->cookies->has("currentCity")){
				$this->currentCity = strtolower($this->sanitizedata($this->cookies->get("currentCity")));	
			}else{
				$this->currentCity = $this->defaultCity;
			}
		}else if($this->dispatcher->getParam('city')){
			$this->currentCity = strtolower($this->dispatcher->getParam('city'));
		}else if ($this->cookies->has("currentCity")){
			if( $this->sanitizedata($this->cookies->get("city")) == 'delhi-ncr' ){
				$this->currentCity = strtolower($this->defaultCity);
			}else{
				$cities = new \WH\Model\Cities();
				$getallcities = $cities->getResults();
				$getcitiesarray = array();
				foreach ($getallcities['cities'] as $key => $value) {
					if($value['name'] == 'Delhi NCR'){
						$getcitiesarray[$key] = 'delhi-ncr';	
					}else{
						$getcitiesarray[$key] = strtolower($value['name']);
					}
				}
				$sanitize_city = strtolower($this->sanitizedata($this->cookies->get("city")));
				if(in_array($sanitize_city, $getcitiesarray)){
					$this->currentCity = strtolower($this->sanitizedata($this->cookies->get("city")));	
				}else{
					$this->currentCity = $this->defaultCity;
				}
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
		$request_uri = trim($this->request->getServer('REQUEST_URI'), '/');
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
		if($city == 'delhi-ncr')
			$cityshown = 'Delhi NCR';
		else
			$cityshown = ucwords($city);
		
		return $cityshown;
	}

	public function sanitizedata($data){
		$filter = new Filter();
		$filter->add('md5', function($value) {
			return preg_replace("/[^0-9a-zA-Z_~\-!@#\$%\^&*\(\) ]/", "", $value);
		});
		$filtered = $filter->sanitize($data, "md5");
		return $filtered;
	}

	public function htmlwishlistwidget($description, $ctitle){
		$result = '';
		$pattern = '/(\<!--\<wishlistwidget(.*?)\>\<\/wishlistwidget\>--\>)/i';
		preg_match_all($pattern,$description,$matches);
		$replace_array = array();

		if(!empty($matches[0])){
			$i = 0;
			foreach($matches[0] as $key=>$match){
				$replace_array[$i]['widget'] = $matches[0][$key];
				$attribute = $this->parse_attrib($matches[2][$key]);

				$html = '<div id="wishlist'.$attribute['entity_id'].'" class="wishlist-container" data-entitytype="'.$attribute['entity_type'].'" data-entityid="'.$attribute['entity_id'].'" data-entitytitle="'.$attribute['entity_title'].'"  data-cityid="'.$attribute['city_id'].'" data-title="'.$attribute['title'].'" data-ctitle="'.$ctitle.'">
							<img src="'.$baseUrl.'/img/ajax-loader.gif">
						</div>';

				$replace_array[$i]['html'] = $html;
				$i++;
			}
		}
		
		if(!empty($replace_array)){
			foreach($replace_array as $replace){
				$description = str_replace($replace['widget'], $replace['html'], $description);
			}
		}

		return $description;
	}

	protected function parse_attrib($text) {
        $atts = array();
        $pattern = '/(\w+)\s*=\s*"([^"]*)"(?:\s|$)|(\w+)\s*=\s*\'([^\']*)\'(?:\s|$)|(\w+)\s*=\s*([^\s\'"]+)(?:\s|$)|"([^"]*)"(?:\s|$)|(\S+)(?:\s|$)/';
        $text = preg_replace("/[\x{00a0}\x{200b}]+/u", " ", $text);
        if ( preg_match_all($pattern, $text, $match, PREG_SET_ORDER) ) {
                foreach ($match as $m) {                    
                        if (!empty($m[1]))
                                $atts[strtolower($m[1])] = trim(stripcslashes($m[2]),'\"');
                        elseif (!empty($m[3]))
                                $atts[strtolower($m[3])] = trim(stripcslashes($m[4]),'\"');
                        elseif (!empty($m[5]))
                                $atts[strtolower($m[5])] = trim(stripcslashes($m[6]),'\"');
                        elseif (isset($m[7]) && strlen($m[7]))
                                $atts[] = trim(stripcslashes($m[7]),'\"');
                        elseif (isset($m[8]))
                                $atts[] = trim(stripcslashes($m[8]),'\"');
                }
        } else {
                $atts = ltrim($text);
        }
        return $atts;
    }

    protected function setdataforfooter(){
    	$getdataforfooter = array();
		
		$getdataforfooter['lateststoriesfeeds'] = $this->getfeeddata(0, 11, $this->currentCity, 'all', '', '', 'Content', '', 'footer', 0, 0);
		
		$getdataforfooter['todaysfeeds'] = $this->getfeeddata(0, 11, $this->currentCity, 'Today', '', '', 'Event', '', 'footer', 0, 11);
		

		$todaysfeeds = array();
		foreach ($getdataforfooter['todaysfeeds']['results'] as $key => $todaysfeed) {
			$todaysfeeds[] = $todaysfeed['id'];
		}
		$upcomingfeeds = $this->getfeeddata(0, 22, $this->currentCity, 'Month', '', '', 'Event', '', 'footer', 0, 22);
		foreach ($upcomingfeeds['results'] as $key => $upcomingfeed) {
			if(in_array($upcomingfeed['id'], $todaysfeeds)){
	    		unset($upcomingfeeds['results'][$key]);
	    	}
		}
		$upcomingfeeds['results'] = array_values($upcomingfeeds['results']);
		$getdataforfooter['upcomingfeeds'] = $upcomingfeeds;
    	
    	$this->view->dataforfooter = $getdataforfooter;
    	//echo "<pre>"; print_r($getdataforfooter); echo "</pre>"; exit;
    }


    /*protected function setdataforfooter(){
    	$dataforfooter = array();
    	if($this->currentCity == 'delhi-ncr'){
			$datafromcity = $this->storageslave->get('_delhincr');
		}else{
			$datafromcity = $this->storageslave->get('_'.$this->currentCity);
		}
    	if(empty($datafromcity)){
    		$getdataforfooter = array();
			$cities = new \WH\Model\Cities();
			$getallcities = $cities->getResults();
			foreach ($getallcities['cities'] as $key => $value) {
				if($value['name'] == 'Delhi NCR'){
					$cityfor = 'delhincr';
					$cityforset = 'delhi-ncr';
				}else{
					$cityfor = strtolower($value['name']);
					$cityforset = strtolower($value['name']);
				}

				$getdataforfooter['lateststoriesfeeds'] = $this->getfeeddata(0, 11, $cityforset, 'all', '', '', 'Content', '', 'footer', 0, 11);
				
				$getdataforfooter['todaysfeeds'] = $this->getfeeddata(0, 11, $cityforset, 'Today', '', '', 'Event', '', 'footer', 0, 11);
				

				$todaysfeeds = array();
				foreach ($getdataforfooter['todaysfeeds']['results'] as $key => $todaysfeed) {
					$todaysfeeds[] = $todaysfeed['id'];
				}
				$upcomingfeeds = $this->getfeeddata(0, 22, $cityforset, 'Month', '', '', 'Event', '', 'footer', 0, 22);
				foreach ($upcomingfeeds['results'] as $key => $upcomingfeed) {
					if(in_array($upcomingfeed['id'], $todaysfeeds)){
			    		unset($upcomingfeeds['results'][$key]);
			    	}
				}
				$upcomingfeeds['results'] = array_values($upcomingfeeds['results']);
				$getdataforfooter['upcomingfeeds'] = $upcomingfeeds;
				 
				//$this->storagemaster->set($cityfor, json_encode($getdataforfooter));
				//$this->storagemaster->expire('_'.$cityfor, 86400);

				array_walk_recursive($getdataforfooter, function(&$value, $key) {
				    if (is_string($value)) {
				        $value = iconv('windows-1252', 'utf-8', $value);
				    }
				});
				$this->storagemaster->set('_'.$cityfor, json_encode($getdataforfooter));
				$this->storagemaster->expire('_'.$cityfor, 86400);
			}
    	}

		if($this->currentCity == 'delhi-ncr'){
			$dataforfooter = $this->storageslave->get('_delhincr');
		}else{
			$dataforfooter = $this->storageslave->get('_'.$this->currentCity);
		}
    	$this->view->dataforfooter = json_decode($dataforfooter);
    	//echo "<pre>"; print_r(json_decode($dataforfooter)); echo "</pre>"; exit;
    }*/

}
