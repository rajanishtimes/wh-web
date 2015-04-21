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
		$author_split = explode('-', $this->authorname);
		$authorid = end($author_split);
		$start = 0;
		$limit = 12;
		$Profile = new \WH\Model\User();
		$Profile->setId($authorid);
		$Profile->setProfile();
        $author = $Profile->getProfileResults();
		$profilepost = $this->getauthorpost($authorid, $start, $limit);
		if($profilepost['meta']['match_count'] > 0){
			$breadcrumbs = $this->breadcrumbs(array(ucwords(strtolower(trim($author['profile']['full_name']))) =>''));		
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
		$profilepost = $Profile->getPostsResults();
		foreach($profilepost['results'] as $key=>$entity){
			if($entity['cover_image']){
				if(substr($entity['cover_image'], 0, 4) != 'http'){
						$profilepost['results'][$key]['cover_image'] = $this->config->application->imgbaseUri.$entity['cover_image'];
				}
			}
			//$profilepost['results'][$key]['slug'] = $this->create_slug($entity['title']).'-'.str_replace('_', '-', strtolower($entity['id']));
		}
		//echo "<pre>"; print_r($profilepost); exit;
		return $profilepost;
	}
}
