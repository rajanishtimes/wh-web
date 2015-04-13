<?php

namespace WH\Core;
use Phalcon\Mvc\Controller;

class BaseController extends Controller{
	public $api_end_point;
	public $meta_description = '';
	public $meta_keywords = '';
	public $meta_author = '';
	public $city = 'delhi';
	public $cityId = 0;
	public $request;
	public $baseUrl;
	
    protected function initialize()
    {
		$this->request = new \Phalcon\Http\Request();
		$this->tag->prependTitle('WhatsHot | ');
		$this->view->meta_description = $this->meta_description;
		$this->view->meta_keywords = $this->meta_keywords;
		$this->view->meta_author = $this->meta_author;
		
		$this->baseUrl = ((empty($_SERVER['REQUEST_SCHEME'])) ? 'http' : $_SERVER['REQUEST_SCHEME']).'://'.$_SERVER['SERVER_NAME'].$this->config->application->baseUri;
		$this->view->baseUrl = $this->baseUrl;
		
		//echo $this->dispatcher->getControllerName();exit;
		//echo $this->dispatcher->getActionName();exit;
		
		if ($this->session->has("cities") && empty($this->dispatcher->getParam('city'))) {
			$this->city = $this->session->get("cities");
			$this->view->city = $this->city;
        }else{
			if(!empty($this->dispatcher->getParam('city'))){
				$this->city = $this->dispatcher->getParam('city');
				$this->session->set("cities", $this->city);
				$this->view->city = $this->city;
			}else{
				$this->session->set("cities", 'delhi');
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
			$this->cityId = $getallcities['cities'][0]['id'];
			$this->city = $getallcities['cities'][0]['name'];
			$this->session->set("cities", $this->city);
			$this->view->city = $this->city;
		}
		
    }

    protected function forward($uri){
        $uriParts = explode('/', $uri);
        $params = array_slice($uriParts, 2);
		print_r($uriParts);
    	return $this->dispatcher->forward(
    		array(
    			'controller' => $uriParts[0],
    			'action' => $uriParts[1],
                'params' => $params
    		)
    	);
    }
	
	public function sendCurl($url, $params = array()){
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
	
	public function create_slug($string){
		$slug=preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($string));
		return $slug;
	}

	public function create_title($string){
		$slug = str_replace('-', ' ', strtolower($string));
		return $slug;
	}
	
	public function getfeeddata($start, $limit, $city, $bydays, $filter_type='', $keyword=''){
		$Search = new \WH\Model\Solr();
		$Search->setParam('bycity',$city);
		$Search->setParam('start',$start);
		$Search->setParam('limit',$limit);
		
		if(strtolower($bydays)!='all')
		$Search->setParam('byDays',$bydays);
		
		if($filter_type=='tags')
			$Search->setParam('byTags',$keyword);
		else
			$Search->setParam('searchname',$keyword);
		
		if($keyword==''){
			$Search->setParam('sponsored','true');
			$Search->setParam('spstart',$start);
			$Search->setParam('splimit',$limit);
		}
		
		$Search->setSearchEntity();
		$entityresult = $Search->getSearchResults();
		foreach($entityresult['results'] as $key=>$entity){
			if(!empty($entity['image']['uri'])){
				if(substr($entity['image']['uri'], 0, 4) != 'http'){
					$entityresult['results'][$key]['image']['uri'] = $this->config->application->imgbaseUri.$entity['image']['uri'];
				}
			}
			$entityresult['results'][$key]['slug'] = $this->create_slug($entity['title']).'-'.str_replace('_', '-', strtolower($entity['id']));
		}
		return $entityresult;
	}
	
	public function breadcrumbs($arr){
		$bdc = array('Home'=>$this->baseUrl);
		$breadcrumbs = array_merge($bdc, $arr);
		return $breadcrumbs;
	}
}
