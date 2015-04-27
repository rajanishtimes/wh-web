<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class CriticController extends BaseController{
	public $critic = '';
	public function initialize(){
        $this->tag->setTitle('Critic');
        $this->view->setLayout('mainLayout');
		$this->view->searchform = new SearchForm;
		$this->view->newsletterform = new NewsletterForm;
		
		if($this->dispatcher->getParam('critic'))
			$this->critic = $this->dispatcher->getParam('critic');
			$this->view->critic = $this->critic;
		
		parent::initialize();
    }

    public function indexAction(){
		preg_match('/\br-[0-9]{1,}\b/i', $this->critic, $match);
		$id = str_replace('-', '_', $match[0]);
		
		$Solr = new \WH\Model\Solr();
		$Solr->setParam('ids',$id);
		$Solr->setParam('fl','detail');
		$Solr->setSolrType('detail');
        $Solr->setEntityDetails();
		try{
			$criticdetail = $Solr->getDetailResults();
		}catch(Exception $e){
			$criticdetail = array();
		}
        

		if($criticdetail){
			//echo "<pre>"; print_r($criticdetail);
			$Author = new \WH\Model\Solr();
			$Author->setParam('ids','a_'.$criticdetail['author_id']);
			$Author->setParam('fl','detail');
			$Author->setSolrType('detail');
			$Author->setEntityDetails();
			try{
				$author = $Author->getDetailResults();
			}catch(Exception $e){
				$author = array();
			}
			//print_r($author); exit;
			/* ======= Seo Update ============= */
			if($criticdetail['page_title'])
				$this->tag->setTitle($criticdetail['page_title']);
			$this->view->meta_description = $criticdetail['meta_description'];
			$this->view->meta_keywords = $criticdetail['meta_keywords'];
			$this->view->og_title = $criticdetail['og_title'];
			$this->view->og_type = 'Content';
			$this->view->og_description = $criticdetail['og_description'];
			$this->view->og_image = $this->baseUrl.'/'.$criticdetail['og_image'];
			$this->view->og_url = $this->baseUrl.'/'.$criticdetail['url'];
			/* ======= Seo Update ============= */
			
			foreach($criticdetail['images'] as $key=>$images){
				if($images['uri']){
					if(substr($images['uri'], 0, 4) != 'http'){
						$criticdetail['images'][$key]['uri'] = $this->config->application->imgbaseUri.$images['uri'];
					}
				}
			}
			
			$rwidth = round((($criticdetail['food_rate'] + $criticdetail['service_rate'] + $criticdetail['decor_rate'])/3), 1);
			$reviewwidth = $rwidth*33;
			
			$breadcrumbs = $this->breadcrumbs(array(
				ucwords($this->city) => $this->baseUrl.'/'.$this->city,
				ucwords(strtolower(trim($criticdetail['title']))) =>''
			));
			
			$this->view->setVars(array(
				'author'	=> $author,
				'criticdetail' => $criticdetail,
				'breadcrumbs' => $breadcrumbs,
				'reviewwidth' => $reviewwidth,
				'rwidth' => $rwidth
			));
		}else{
			$this->forwardtoerrorpage(404);
		}
    }
}
