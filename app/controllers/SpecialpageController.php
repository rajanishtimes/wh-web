<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class SpecialpageController extends BaseController{
	public $specialpagetitle = '';
	public function initialize(){
		$this->setlogsarray('specialpage_start');
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
		$this->response->setHeader('Cache-Control', 'max-age=86400');
		preg_match('/\bs-[a-zA-Z0-9\- ]+/i', $this->specialpagetitle, $match);
		$id = str_replace('-', '_', $match[0]);
		
		$this->view->entityid = $id;
		$this->view->entitytype = 'special page';
		
		$Solr = new \WH\Model\Solr();
		$Solr->setParam('ids',$id);
		$Solr->setParam('fl','detail');
		$Solr->setSolrType('detail');
        $Solr->setEntityDetails();
        try{
			$specialpagedetail = $Solr->getDetailResults();
			$this->setlogsarray('speacialpage_get_records');
		}catch(Exception $e){
			$specialpagedetail = array();
		}
		
		
		if($specialpagedetail){
			$this->validateRequest($specialpagedetail['url']);
			/* ======= Seo Update ============= */
			if($specialpagedetail['page_title'])
				$this->tag->setTitle($specialpagedetail['page_title']);
			$this->view->meta_description = $specialpagedetail['meta_description'];
			$this->view->meta_keywords = $specialpagedetail['meta_keywords'];
			$this->view->og_title = $specialpagedetail['og_title'];
			$this->view->og_type = 'website';
			$this->view->og_description = $specialpagedetail['og_description'];
			$this->view->og_image = $this->baseUrl.$specialpagedetail['og_image'];
			$this->view->og_url = $this->baseUrl.$specialpagedetail['url'];
			$this->view->canonical_url = $this->baseUrl.$specialpagedetail['url'];
			$this->view->deep_link = $specialpagedetail['deep_link'];
			/* ======= Seo Update ============= */
			
			foreach($specialpagedetail['images'] as $key=>$images){
				if($images['uri']){
					if(substr($images['uri'], 0, 4) != 'http'){
						$specialpagedetail['images'][$key]['uri'] = $this->config->application->imgbaseUri.$images['uri'];
					}
				}
			}
			$specialpagedetail['author']['slug'] = $this->create_slug($specialpagedetail['author']['name']).'-'.$specialpagedetail['author']['id'];
			$cityshown = $this->cityshown($this->currentCity);
			$breadcrumbs = $this->breadcrumbs(array(
				$cityshown => $this->baseUrl.'/'.$this->currentCity,
				ucwords(strtolower(trim($specialpagedetail['title']))) =>''
			));
			
			$this->view->setVars(array(
				'specialpagedetail' => $specialpagedetail,
				'breadcrumbs' => $breadcrumbs,
				'cityshown' => $cityshown
			));
		}else{
			$this->forwardtoerrorpage(404);
		}
		$this->setlogsarray('speacialpage_end');
		$this->getlogs('specialpage', $this->baseUrl.$specialpagedetail['url']);
    }
}
