<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class SpecialpageController extends BaseController{
	public $specialpagetitle = '';
	public function initialize(){
        $this->view->setLayout('mainLayout');
		$this->view->searchform = new SearchForm;
		$this->view->newsletterform = new NewsletterForm;
		
		if($this->dispatcher->getParam('city'))
			$this->city = $this->dispatcher->getParam('city');
		
		if($this->dispatcher->getParam('specialpagetitle'))
			$this->specialpagetitle = $this->dispatcher->getParam('specialpagetitle');
			
		$this->view->setVars(array(
			'city' => $this->city,
			'specialpagetitle' => $this->specialpagetitle
		));
		
		parent::initialize();
    }

    public function indexAction(){
		preg_match('/\bs-[a-zA-Z0-9\- ]+/i', $this->specialpagetitle, $match);
		$id = str_replace('-', '_', $match[0]);
		
		$Solr = new \WH\Model\Solr();
		$Solr->setParam('ids',$id);
		$Solr->setParam('fl','detail');
		$Solr->setSolrType('detail');
        $Solr->setEntityDetails();
        try{
			$specialpagedetail = $Solr->getDetailResults();
		}catch(Exception $e){
			$specialpagedetail = array();
		}
		
		
		if($specialpagedetail){
			/* ======= Seo Update ============= */
			if($specialpagedetail['page_title'])
				$this->tag->setTitle($specialpagedetail['page_title']);
			$this->view->meta_description = $specialpagedetail['meta_description'];
			$this->view->meta_keywords = $specialpagedetail['meta_keywords'];
			$this->view->og_title = $specialpagedetail['og_title'];
			$this->view->og_type = 'Content';
			$this->view->og_description = $specialpagedetail['og_description'];
			$this->view->og_image = $this->baseUrl.$specialpagedetail['og_image'];
			$this->view->og_url = $this->baseUrl.$specialpagedetail['url'];
			/* ======= Seo Update ============= */
			
			foreach($specialpagedetail['images'] as $key=>$images){
				if($images['uri']){
					if(substr($images['uri'], 0, 4) != 'http'){
						$specialpagedetail['images'][$key]['uri'] = $this->config->application->imgbaseUri.$images['uri'];
					}
				}
			}
			$specialpagedetail['author']['slug'] = $this->create_slug($specialpagedetail['author']['name']).'-'.$specialpagedetail['author']['id'];
			$breadcrumbs = $this->breadcrumbs(array(
				ucwords($this->city) => $this->baseUrl.$this->city,
				ucwords(strtolower(trim($specialpagedetail['title']))) =>''
			));
			
			$this->view->setVars(array(
				'specialpagedetail' => $specialpagedetail,
				'breadcrumbs' => $breadcrumbs
			));
		}else{
			$this->forwardtoerrorpage(404);
		}
    }
}
