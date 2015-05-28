<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class TagController extends BaseController{
	public $tags = '';
	public function initialize(){
		$this->setlogsarray('tag_start');
        $this->tag->setTitle('Tag');
        $this->view->setLayout('mainLayout');
		$this->view->searchform = new SearchForm;
		$this->view->newsletterform = new NewsletterForm;
		
		if($this->dispatcher->getParam('tags'))
			$this->tags = $this->dispatcher->getParam('tags');
			
		$this->view->setVars(array('tags' => $this->tags));
		parent::initialize();
    }

    public function indexAction(){
		$this->response->setHeader('Cache-Control', 'max-age=900');
		$start = 0;
		$limit = 11;
		$this->tags = $this->create_title($this->tags);
                $tags = $this->tags;
		$this->view->entitytype = 'tag';
		try{
			$tagsfeeds = $this->getfeeddata($start, $limit, $this->currentCity, 'all', 'tags', strtolower($this->tags), 'Event,Content', '', 'tag');
			$this->setlogsarray('tag_get_records');
		}catch(Exception $e){
			$tagsfeeds = array();
		}
		
		
		//$current_encoding = mb_detect_encoding($this->tags, 'auto');
		//$ttgs = iconv($current_encoding, 'UTF-8', $this->tags);
		$cityshown = $this->cityshown($this->currentCity);
		$breadcrumbs = $this->breadcrumbs(array(
			$cityshown => $this->baseUrl.'/'.$this->currentCity,
			ucwords(strtolower(trim($tags))) =>''
		));
		
		$this->view->setVars(
			array(
				'tagsfeeds' => $tagsfeeds,
				'tagsfeedscount' => count($tagsfeeds),
				'tags'=>$tags,
				'start'=>$limit,
				'limit'=>$limit,
				'breadcrumbs'=>$breadcrumbs,
				'cityshown' =>$cityshown
				)
			);
			
		/* ======= Seo Update ============= */
		$this->tag->setTitle($this->tags.' | '.$cityshown.' | '.$this->config->application->SiteName);
		$this->view->meta_description = $this->tags.' in '.$cityshown.': Find all the information related to '.$this->tags.' in '.$cityshown.' at '.$this->config->application->SiteName;
		$this->view->meta_keywords = $this->tags;
		/* ======= Seo Update ============= */
		$this->setlogsarray('tag_end');
		$this->getlogs('tag', $this->baseUrl.'/tag/'.$this->tags);
    }
	
	public function forwardtagAction(){
		$url = $this->baseUrl.'/'.'#finished';
		return $this->response->redirect($url);     
	}
	
	public function apptestingAction(){
		$url = 'timescity://ty=s&qu=WhatsHot App';
		return $this->response->redirect($url);     
	}
}
