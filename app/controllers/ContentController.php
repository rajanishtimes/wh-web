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
		try{
			$contentdetail = $Solr->getDetailResults();
		}catch(Exception $e){
			$contentdetail = array();
		}
		if($contentdetail){
			$Author = new \WH\Model\Solr();
			$Author->setParam('ids','a_'.$contentdetail['author']['id']);
			$Author->setParam('fl','detail');
			$Author->setSolrType('detail');
			$Author->setEntityDetails();
			try{
				$author = $Author->getDetailResults();
			}catch(Exception $e){
				$author = array();
			}
			
			/* ======= Seo Update ============= */
			if($contentdetail['page_title'])
				$this->tag->setTitle($contentdetail['page_title']);
			$this->view->meta_description = $contentdetail['meta_description'];
			$this->view->meta_keywords = $contentdetail['meta_keywords'];
			$this->view->og_title = $contentdetail['og_title'];
			$this->view->og_type = 'Content';
			$this->view->og_description = $contentdetail['og_description'];
			$this->view->og_image = $this->baseUrl.'/'.$contentdetail['og_image'];
			$this->view->og_url = $this->baseUrl.'/'.$contentdetail['url'];
			/* ======= Seo Update ============= */
			
			foreach($contentdetail['images'] as $key=>$images){
				if($images['uri']){
					if(substr($images['uri'], 0, 4) != 'http'){
						$contentdetail['images'][$key]['uri'] = $this->config->application->imgbaseUri.$images['uri'];
					}
				}
			}
			$breadcrumbs = $this->breadcrumbs(array(
				ucwords($this->city) => $this->baseUrl.'/'.$this->city,
				ucwords(strtolower(trim($contentdetail['title']))) =>''
			));
			
			$this->view->setVars(array(
				'contentdetail' => $contentdetail,
				'breadcrumbs' => $breadcrumbs,
				'author'	=> $author
			));
		}else{
			$this->forwardtoerrorpage(404);
		}
    }
}
