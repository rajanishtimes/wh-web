<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class CriticController extends BaseController{
	public $critic = '';
	public function initialize(){
        $this->setlogsarray('critic_start');
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
		$this->response->setHeader('Cache-Control', 'max-age=86400');
		preg_match('/\br-[0-9]{1,}\b/i', $this->critic, $match);
		$id = str_replace('-', '_', $match[0]);
		
		$Solr = new \WH\Model\Solr();
		$Solr->setParam('ids',$id);
		$Solr->setParam('fl','detail');
		$Solr->setSolrType('detail');
        $Solr->setEntityDetails();
		
		$this->view->entityid = $id;
		$this->view->entitytype = 'critic';
		
		try{
			$criticdetail = $Solr->getDetailResults();
			$this->setlogsarray('critic_get_detail');
		}catch(Exception $e){
			$criticdetail = array();
		}
        

		if($criticdetail){
			//echo "<pre>"; print_r($criticdetail);
			$this->validateRequest($criticdetail['url']);
			$Author = new \WH\Model\Solr();
			$Author->setParam('ids','a_'.$criticdetail['author_id']);
			$Author->setParam('fl','detail');
			$Author->setSolrType('detail');
			$Author->setEntityDetails();
			try{
				$author = $Author->getDetailResults();
				$this->setlogsarray('author_get_detail');
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
			$this->view->og_type = 'website';
			$this->view->og_description = $criticdetail['og_description'];
			
			if($criticdetail['og_image'] == '/img/wh_default.png'){
				$this->view->og_image = $this->makeurl($this->baseUrl, $author['images'][0]['uri']).'?w=500';
			}else{
				$this->view->og_image = $this->makeurl($this->baseUrl, $criticdetail['og_image']).'?w=500';
			}
			
			$this->view->og_url = $this->baseUrl.$criticdetail['url'];
			$this->view->canonical_url = $this->baseUrl.$criticdetail['url'];
			$this->view->deep_link = $criticdetail['deep_link'];
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

			$cityshown = $this->cityshown($this->currentCity);
			$breadcrumbs = $this->breadcrumbs(array(
				$cityshown => $this->baseUrl.'/'.$this->currentCity,
				ucwords(strtolower(trim($criticdetail['title']))) =>''
			));
			
			$this->view->setVars(array(
				'author'	=> $author,
				'criticdetail' => $criticdetail,
				'breadcrumbs' => $breadcrumbs,
				'reviewwidth' => $reviewwidth,
				'rwidth' => $rwidth,
				'cityshown' => $cityshown
			));
		}else{
			$this->forwardtoerrorpage(404);
		}
		$this->setlogsarray('critic_end');
		$this->getlogs('critic', $this->baseUrl.$criticdetail['url']);
    }
}
