<?php

namespace WH\Core;
use Phalcon\Mvc\Controller;
use WH\Api\Params;

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
	public $city = 'delhi';
	public $cityId = 0;
	public $request;
	public $baseUrl;
	
    protected function initialize()
    {
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
		$this->view->og_site_name = $this->config->application->SiteName;
		$this->view->constants=$this->getConstants();
		
		
		$this->baseUrl = 'http://'.$_SERVER['HTTP_HOST'].$this->config->application->baseUri;
		$this->view->baseUrl = $this->baseUrl;
		
		//$this->setcookie();
		
		//echo $this->dispatcher->getControllerName();exit;
		//echo $this->dispatcher->getActionName();exit;
		
		
		/* ============= Set cookie for city =============== */
		
		$this->setcities();
		
		/* ============= Set cookie for city =============== */
		
		$this->setcityid();
		//echo $this->cityId; exit;
		if($this->cityId == 0){
			$this->cookies->set("city", 'delhi', time() + 15 * 86400);
			$this->city = 'delhi';
			$this->view->city = 'delhi';
			$this->setcityid();
			//$this->cookies->get("city")->delete();
			//$this->forwardtoerrorpage(404);
		}
		
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
			$this->response->setStatusCode(404, 'Not Found');
			$this->view->pick('errors/show404');
			$this->view->setLayout('errorpageLayout');
			$this->tag->setTitle('Page Not Found');
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
		$slug=preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($string));
		return $slug;
	}

	protected function create_title($string){
		$slug = str_replace('-', ' ', strtolower($string));
		return $slug;
	}
	
	protected function getfeeddata($start, $limit, $city, $bydays, $filter_type='', $keyword='', $bytype='', $location='', $sort_by=2){
		
		$Search = new \WH\Model\Solr();
		$Search->setParam('bycity',$city);
		$Search->setParam('start',$start);
		$Search->setParam('limit',$limit);
		$Search->setParam('byType',$bytype);
		$Search->setParam('bysort',Params::getSort(2));
		$Search->setParam('byLocation',$location);
		
		$Search->setParam('mm',3);
		if(strtolower($bydays)!='all')
			$Search->setParam('byDays',ucwords(strtolower($bydays)));
		
		if($filter_type=='tags')
			$Search->setParam('byTags',$keyword);
		else
			$Search->setParam('searchname',$keyword);
		
		if($keyword==''){
			$Search->setParam('sponsored','true');
			$Search->setParam('spstart',$start);
			$Search->setParam('splimit',$limit);
		}
		
		
		if($sort_by!=2){
			if(isSet($keyword) && $keyword!='')
				$sort_by=1;
			else{
				if(isSet($bydays) && strtolower($bydays) != 'all' )
					$sort_by=4;
				else
					$sort_by=2;
			}
		}
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
		
		return $entityresult;
	}
	
	protected function breadcrumbs($arr){
		$bdc = array('What&apos;s Hot'=>$this->baseUrl.'/'.$this->city);
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
			$this->cookies->set('uniquekey', $uniquekey, time() + 365 * 86400);
		}
	}
	
	protected function setcities(){
		if($this->dispatcher->getParam('city')){
			$this->city = $this->dispatcher->getParam('city');
			$this->cookies->set("city", $this->city, time() + 15 * 86400);
			$this->view->city = strtolower($this->city);
		}else{
			if ($this->cookies->has("city")){
				$this->city = strtolower($this->cookies->get("city"));
				$this->view->city = strtolower($this->city);
			}else{
				$this->cookies->set("city", 'delhi', time() + 15 * 86400);
				$this->city = 'delhi';
				$this->view->city = 'delhi';
			}
		}
	}
	
	protected function setcityid(){
		$cities = new \WH\Model\Cities();
		$getallcities = $cities->getResults();
		$this->view->allcities = $getallcities;
		foreach($getallcities['cities'] as $getallcity){
			if(strtolower($getallcity['name']) == $this->city){
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
}
