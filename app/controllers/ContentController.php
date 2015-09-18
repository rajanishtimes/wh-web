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
		$allfeedslists = $this->getfeeddata(0, 4, $this->city, 'all', '', '', 'Content', '', 'feed', 0, 4);
		$this->view->allfeedslists = $allfeedslists;
    }

    public function indexAction(){
		//$this->response->setHeader('Cache-Control', 'private, max-age=0, must-revalidate');
		$this->response->setHeader('Cache-Control', 'max-age=86400');
		preg_match('/\bc-[0-9]{1,}\b/i', $this->contenttitle, $match);
		$id = 0;
		if(isset($match[0])){
			$id = str_replace('-', '_', $match[0]);
		}else{
			$this->forwardtoerrorpage(404);	
		}

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
			//$this->view->meta_description = $contentdetail['meta_description'];
			
			if(strlen($contentdetail['summary']) > 158){
				if (preg_match('/^.{1,155}\b/s', $contentdetail['summary'], $match)){
					$summary=$match[0];
				}
			}else{
				$summary_len = 155-strlen($contentdetail['summary']);
				if (preg_match('/^.{1,'.$summary_len.'}\b/s', strip_tags($contentdetail['description']), $match)){
					$summary= $contentdetail['summary'] .' '. $match[0];
				}
				
			}
			$this->view->meta_description = $summary;
			$this->view->meta_keywords = $contentdetail['meta_keywords'];
			$this->view->og_title = $contentdetail['og_title'];
			$this->view->og_type = 'website';
			$this->view->og_description = $summary; //$contentdetail['og_description'];
			
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
			$contentdetail['description'] = $this->htmlwishlistwidget($contentdetail['description'], $contentdetail['title']);

			$this->view->setVars(array(
				'contentdetail' => $contentdetail,
				'breadcrumbs' => $breadcrumbs,
				'author'	=> $author,
				'cityshown' => $cityshown
			));
			$this->setlogsarray('content_end');
			$this->getlogs('content', $this->baseUrl.$contentdetail['url']);
		}else{
			$this->forwardtoerrorpage(404);
		}
		
    }

    public function getwishlistwidgetAction(){
    	$title = $this->request->getPost('title');
		$cityid = $this->request->getPost('cityid');
		$entitytitle = $this->request->getPost('entitytitle');
		$entityid = $this->request->getPost('entityid');
		$entitytype = $this->request->getPost('entitytype');
		$ctitle = $this->request->getPost('ctitle');
		$html = '';

		if(!isset($entitytitle) && empty($entitytitle)){
			$entitytitle = trim($ctitle);
		}
		if(!isset($entitytitle) && empty($entitytitle)){
			$entitytitle = 'Want to add '.trim($ctitle).' to your '.$this->config->application->wishlistname.'?';
		}

		$class = 'add-wishlist';
		$class2 = '';
		$class3 = 'dnone';
		if(isset($this->logged_user->sso_id) && !empty($this->logged_user->sso_id)){
			$onclick = "showishlist('".$this->logged_user->sso_id."', '".$entityid."', '".$cityid."', '".$entitytype."', '".addslashes($title)."', '".addslashes($entitytitle)."')";
			$Wishlist = new \WH\Model\Wishlist();
			$Wishlist->setUserId($this->logged_user->sso_id);
			$Wishlist->setEntityId($entityid);
			$Wishlist->setEntityTypeID($entitytype);
			$Wishlist->setVersion($this->config->application->version);
			$Wishlist->setPackage($this->config->application->package);
			$Wishlist->setEnv($this->config->application->environment);
			$wishliststatus = $Wishlist->status();	
			if($wishliststatus['status'] != 1){
				$class = 'add-wishlist';
			}else{
				$class = 'added-wishlist';
				$class2 = 'dnone';
				$class3 = '';
			}
		}else{
			$onclick = "addtowishlistwithlogin('".$entityid."', '".$cityid."', '".$entitytype."', '".addslashes($title)."', '".addslashes($entitytitle)."')";
		}

		$html = '<div id="wishlist'.$entityid.'" class="wishlist-container">
					<div class="wishlist-wrapper '.$class.'">
						<div class="wishlist-text float-left">'.$title.'</div>
						<div class="resetdimenstion dnone"><img src="'.$this->baseUrl.'/img/ajax-loader.gif"></div>
						<div id="wishlist_add_btn" class="float-right '.$class2.'" onclick="'.$onclick.'" data-ga-cat = "WishList" data-ga-action="Add Button Widget" data-ga-label="'.$entitytype.' - '.addslashes($title).'"><div class="btn btn-primary wishlist_add_btn">+</div></div>
						<div id="wishlist_added_btn" class="float-right '.$class3.'"><div class="btn btn-primary wishlist_added_btn"><img src="'.$this->baseUrl.'/img/tick.png"></div></div>
						<div class="clearfix"></div>
					</div>
				</div>';
		echo $html;
		exit;
    }

    public function loadsimilarcontentAction(){
		$this->view->setLayout('ajaxLayout');
		$id = $this->request->getPost('entityid');
		$city = $this->request->getPost('city');
		$start = 0;
		$limit = 4;
		$content = new \WH\Model\Content();
        $content->setID($id);
        $content->setCity($city);
        $content->setStart($start);
        $content->setLimit($limit);
        $similarcontent = $content->getSimilar();
        //echo "<pre>"; print_r($similarcontent); echo "</pre>"; exit;
		$this->view->similarcontent = $similarcontent;
    }
}
