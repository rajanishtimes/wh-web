<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class ContentController extends BaseController{
	public $contenttitle = '';
	public function initialize(){
		$this->setlogsarray('content_start');
        $this->view->setLayout('mainLayout');
		$this->view->searchform = new SearchForm;
		$this->view->newsletterform = new NewsletterForm;
		
		if($this->dispatcher->getParam('city'))
			$this->city = $this->dispatcher->getParam('city');
		
		if($this->dispatcher->getParam('contenttitle'))
			$this->contenttitle = $this->dispatcher->getParam('contenttitle');
			
		$this->view->setVars(array(
			'city' => $this->city,
			'contenttitle' => $this->contenttitle
		));
		
		parent::initialize();
    }

    public function indexAction(){
		$this->response->setHeader('Cache-Control', 'private, max-age=0, must-revalidate');
		//$this->response->setHeader('Cache-Control', 'max-age=86400');
		preg_match('/\bc-[0-9]{1,}\b/i', $this->contenttitle, $match);
		$id = str_replace('-', '_', $match[0]);
		$Solr = new \WH\Model\Solr();
		$Solr->setParam('ids',$id);
		$Solr->setParam('fl','detail');
		$Solr->setSolrType('detail');
        $Solr->setEntityDetails();
		try{
			$contentdetail = $Solr->getDetailResults();
			$this->view->entityid = $id;
			$this->view->entitytype = 'content';
			$this->setlogsarray('content_get_detail');
		}catch(Exception $e){
			$contentdetail = array();
		}
		
		if($contentdetail){
			if($this->dispatcher->getParam('city') == 'cities'){
				$this->setreferrelcities($contentdetail['cities']);
			}
			//echo "<pre>"; print_r($contentdetail); exit;
			$this->validateRequest($contentdetail['url']);
			$Author = new \WH\Model\Solr();
			$Author->setParam('ids','a_'.$contentdetail['author']['id']);
			$Author->setParam('fl','detail');
			$Author->setSolrType('detail');
			$Author->setEntityDetails();
			
			try{
				$author = $Author->getDetailResults();
				$this->setlogsarray('author_get_detail');
			}catch(Exception $e){
				$author = array();
			}
			
			
			/* ======= Seo Update ============= */
			if($contentdetail['page_title'])
				$this->tag->setTitle($contentdetail['page_title']);
			$this->view->meta_description = $contentdetail['meta_description'];
			$this->view->meta_keywords = $contentdetail['meta_keywords'];
			$this->view->og_title = $contentdetail['og_title'];
			$this->view->og_type = 'website';
			$this->view->og_description = $contentdetail['og_description'];
			
			if($contentdetail['og_image'] == '/img/wh_default.png'){
				$this->view->og_image = $this->makeurl($this->baseUrl, $contentdetail['images'][0]['uri']).'?w=500';
			}else{
				$this->view->og_image = $this->makeurl($this->baseUrl, $contentdetail['og_image']).'?w=500';
			}
			
			$this->view->og_url = $this->baseUrl.$contentdetail['url'];
			$this->view->canonical_url = $this->baseUrl.$contentdetail['url'];
			$this->view->deep_link = $contentdetail['deep_link'];
			/* ======= Seo Update ============= */
			
			/* foreach($contentdetail['images'] as $key=>$images){
				if($images['uri']){
					if(substr($images['uri'], 0, 4) != 'http'){
						$contentdetail['images'][$key]['uri'] = $this->config->application->imgbaseUri0.$images['uri'];
					}
				}
			} */
			
			$cityshown = $this->cityshown($this->currentCity);
			$breadcrumbs = $this->breadcrumbs(array(
				$cityshown => $this->baseUrl.'/'.$this->currentCity,
				ucwords(strtolower(trim($contentdetail['title']))) =>''
			));
			
			$this->view->setVars(array(
				'contentdetail' => $contentdetail,
				'breadcrumbs' => $breadcrumbs,
				'author'	=> $author,
				'cityshown' => $cityshown
			));
			
		}else{
			$this->forwardtoerrorpage(404);
		}
		$this->setlogsarray('content_end');
		$this->getlogs('content', $this->baseUrl.$contentdetail['url']);
    }
}
