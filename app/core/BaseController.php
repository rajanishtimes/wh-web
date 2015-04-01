<?php
namespace WH\Core;

use Phalcon\Mvc\Controller;

class BaseController extends Controller{
	public $api_end_point;
	public $meta_description = '';
	public $meta_keywords = '';
	public $meta_author = '';
	
    protected function initialize()
    {
		$this->view->meta_description = $this->meta_description;
		$this->view->meta_keywords = $this->meta_keywords;
		$this->view->meta_author = $this->meta_author;
		
		//echo "asdf<pre>"; print_r($this->session); exit;
		$baseurl = ((empty($_SERVER['REQUEST_SCHEME'])) ? 'http' : $_SERVER['REQUEST_SCHEME']).'://'.$_SERVER['SERVER_NAME'].$this->config->application->baseUri;
        $this->tag->prependTitle('WhatsHot | ');
		$this->view->baseUrl = $baseurl;
		$this->api_end_point = $this->config->application->api_end_point;
		$getcitiesUrl = $this->api_end_point.'core/getCities';
        $getallcities = $this->sendCurl($getcitiesUrl);
		$this->view->allcities = $getallcities->response;
    }

    protected function forward($uri)
    {
        $uriParts = explode('/', $uri);
        $params = array_slice($uriParts, 2);
    	return $this->dispatcher->forward(
    		array(
    			'controller' => $uriParts[0],
    			'action' => $uriParts[1],
                'params' => $params
    		)
    	);
    }
	
	public function sendCurl($url, $params = array()){
		print_r($params);
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
}
