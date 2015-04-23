<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class AuthorController extends BaseController{
	public $authorname = '';
	public function initialize(){
        $this->tag->setTitle('Author');
        $this->view->setLayout('mainLayout');
		$this->view->searchform = new SearchForm;
		$this->view->newsletterform = new NewsletterForm;
		
		if($this->dispatcher->getParam('authorname'))
			$this->authorname = $this->dispatcher->getParam('authorname');
		
		$this->view->setVars(array('city' => $this->city, 'authorname'=>$this->authorname));
		parent::initialize();
    }

    public function indexAction(){
		preg_match('/\ba-[0-9]{1,}\b/i', $this->authorname, $match);
		$id = str_replace('-', '_', $match[0]);
		$Author = new \WH\Model\Solr();
		$Author->setParam('ids',$id);
		$Author->setParam('fl','detail');
		$Author->setSolrType('detail');
		$Author->setEntityDetails();
		try{
			$author = $Author->getDetailResults();
		}catch(Exception $e){
			$author = array();
		}
		
		//echo "<pre>"; print_r($author); exit;
		if($author){
			$ids = explode('_', $id);
			$authorid = end($ids);
			$start = 0;
			$limit = 12;
			$profilepost = $this->getauthorpost($authorid, $start, $limit);
			$breadcrumbs = $this->breadcrumbs(array(ucwords(strtolower(trim($author['title']))) =>''));		
			$this->view->setVars(array(
				'authorid' => $authorid,
				'author' => $author,
				'start'	=> $start,
				'limit'	=> $limit,
				'profilepost'=>$profilepost,
				'breadcrumbs'=>$breadcrumbs
			));
		}else{
			$this->forwardtoerrorpage(404);
		}
    }
	
	
	public function postsAction(){
		$this->view->setLayout('ajaxLayout');
		$mainurl = $this->request->getPost('mainurl');
		$start = $this->request->getPost('start');
		$limit = $this->request->getPost('limit');
		$parentid = $this->request->getPost('parentid');
		$authorid = $this->request->getPost('searchkeyword');
		$profilepost = $this->getauthorpost($authorid, $start, $limit);
		
		$this->view->setVars(array(
			'allfeedslist' => $profilepost,
			'mainurl' => $mainurl,
			'authorid' => $authorid,
			'start'	=> $start+$limit,
			'limit'	=> $limit,
			'parentid'=>$parentid
		));
    }
	
	
	private function getauthorpost($authorid, $start, $limit){
		$Profile = new \WH\Model\User();
		$Profile->setId($authorid);
		$Profile->setStart($start);
		$Profile->setLimit($limit);
		$Profile->setPostParams();
		try{
			$profilepost = $Profile->getPostsResults();
			foreach($profilepost['results'] as $key=>$entity){
				if($entity['cover_image']){
					if(substr($entity['cover_image'], 0, 4) != 'http'){
							$profilepost['results'][$key]['cover_image'] = $this->config->application->imgbaseUri.$entity['cover_image'];
					}
				}
			}
		}catch(Exception $e){
			$profilepost = array();
		}
		
		//echo "<pre>"; print_r($profilepost); exit;
		return $profilepost;
	}
}
