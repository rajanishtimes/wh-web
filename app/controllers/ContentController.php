<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class ContentController extends BaseController{
	public $contenttitle = '';
	public function initialize(){
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
		preg_match('/\bc-[0-9]{1,}\b/i', $this->contenttitle, $match);
		$id = str_replace('-', '_', $match[0]);
		
		$Solr = new \WH\Model\Solr();
		$Solr->setParam('ids',$id);
		$Solr->setParam('fl','detail');
		$Solr->setSolrType('detail');
        $Solr->setEntityDetails();
        $contentdetail = $Solr->getDetailResults();
		
		/* ======= Seo Update ============= */
		if($contentdetail['page_title'])
			$this->tag->setTitle($contentdetail['page_title']);
		$this->view->meta_description = $contentdetail['meta_description'];
		$this->view->meta_keywords = $contentdetail['meta_keywords'];
		$this->view->og_title = $contentdetail['og_title'];
		$this->view->og_type = 'Content';
		$this->view->og_description = $contentdetail['og_description'];
		$this->view->og_image = $contentdetail['og_image'];
		$this->view->og_url = $this->baseUrl.$this->city.$contentdetail['url'];
		/* ======= Seo Update ============= */
		
		foreach($contentdetail['images'] as $key=>$images){
			if($images['uri']){
				if(substr($images['uri'], 0, 4) != 'http'){
					$contentdetail['images'][$key]['uri'] = $this->config->application->imgbaseUri.$images['uri'];
				}
			}
		}
		$contentdetail['author']['slug'] = $this->create_slug($contentdetail['author']['name']).'-'.$contentdetail['author']['id'];
		$breadcrumbs = $this->breadcrumbs(array(ucwords(strtolower(trim($contentdetail['title']))) =>''));
		
		$this->view->setVars(array(
			'contentdetail' => $contentdetail,
			'breadcrumbs' => $breadcrumbs
		));
    }
}
