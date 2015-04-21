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
		
		if($_SERVER['REQUEST_SCHEME']){
			$this->baseUrl = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$this->config->application->baseUri;
		}else{
			$this->baseUrl = 'http://'.$_SERVER['SERVER_NAME'].$this->config->application->baseUri;
		}
		$this->view->baseUrl = $this->baseUrl;
		
		$this->setcookie();
		
		//echo $this->dispatcher->getControllerName();exit;
		//echo $this->dispatcher->getActionName();exit;
		
		if ($this->session->has("cities") && $this->dispatcher->getParam('city')=='' && $this->session->get("cities")) {			
			$this->city = strtolower($this->session->get("cities"));
			$this->view->city = strtolower($this->city);
        }else{
			if($this->dispatcher->getParam('city')){
				$this->city = $this->dispatcher->getParam('city');
				$this->session->set("cities", $this->city);
				$this->view->city = strtolower($this->city);
			}else{
				$this->session->set("cities", 'delhi');
				$this->city = 'delhi';
				$this->view->city = 'delhi';
			}
		}
		
		$cities = new \WH\Model\Cities();
		$getallcities = $cities->getResults();
		$this->view->allcities = $getallcities;
		foreach($getallcities['cities'] as $getallcity){
			if(strtolower($getallcity['name']) == $this->city){
				$this->cityId = $getallcity['id'];
				break;
			}
		}
		if($this->cityId == 0){
			$this->session->remove("cities");
			$this->forwardtoerrorpage(404);
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
			$this->response->setStatusCode(404, 'Not Found');
			$this->view->pick('errors/show404');
			$this->view->setLayout('errorpageLayout');
			$this->tag->setTitle('Page Not Found');
		}
		
		if($errorcode == 401){
			$this->response->setStatusCode(401, 'Unauthorized Access');
			$this->view->pick('errors/show401');
		}
		
		if($errorcode == 500){
			$this->response->setStatusCode(401, 'Internal Server Error');
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
	
	protected function getfeeddata($start, $limit, $city, $bydays, $filter_type='', $keyword='', $bytype=''){
		$Search = new \WH\Model\Solr();
		$Search->setParam('bycity',$city);
		$Search->setParam('start',$start);
		$Search->setParam('limit',$limit);
		$Search->setParam('byType',$bytype);
		
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
		$Search->setParam('bysort',Params::getSort(2));
		
		$Search->setSearchEntity();
		$entityresult = $Search->getSearchResults();
		foreach($entityresult['results'] as $key=>$entity){
			if(!empty($entity['image']['uri'])){
				if(substr($entity['image']['uri'], 0, 4) != 'http'){
					$entityresult['results'][$key]['image']['uri'] = $this->config->application->imgbaseUri.$entity['image']['uri'];
				}
			}
			//$entityresult['results'][$key]['slug'] = $this->create_slug($entity['title']).'-'.str_replace('_', '-', strtolower($entity['id']));
		}
		
		return $entityresult;
	}
	
	protected function breadcrumbs($arr){
		$bdc = array('Whatshot'=>$this->baseUrl);
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
}
