<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;
require_once(APP_PATH.'public/inc/facebook.php' ); //include fb sdk

class ProfileController extends BaseController{
	public function initialize(){
		parent::initialize();
		$this->view->setLayout('mainLayout');
		$allfeedslists = $this->getfeeddata(0, 4, $this->city, 'all', '', '', 'Content', '', 'feed', 0, 4);
		$this->view->allfeedslists = $allfeedslists;
		//echo "<pre>"; print_r($allfeedslists); echo "</pre>"; exit;
    }

    public function indexAction(){
    	$Wishlist = new \WH\Model\Wishlist();
        $Wishlist->setUserId($this->logged_user->sso_id);
        $Wishlist->setVersion($this->config->application->version);
		$Wishlist->setPackage($this->config->application->package);
		$Wishlist->setEnv($this->config->application->environment);
        $allwishlistlist = $Wishlist->getAll();

        // $total_count = 0;
        // foreach ($allwishlistlist as $key => $counts) {
        // 	$total_count += $counts['total_count'];
        // }
 		//echo "<pre>"; print_r($allwishlistlist); echo "</pre>"; exit;
        $this->view->setVars(
			array(
				'allwishlistlist' => $allwishlistlist,
				'total_count' => $total_count,
				'start'=>11,
				'limit'=>10
				)
			);

    }

    public function facebookloginAction(){
    	$access_token = $this->request->getPost('access_token');
    	$hometown = $this->request->getPost('hometown');
    	$location = $this->request->getPost('location');

    	$return_url = $this->baseUrl.'/facebook/';
		$facebook = new Facebook(array(
			'appId' => $this->config->facebook->appId,
			'secret' => $this->config->facebook->appSecret,
		));
		
		$fbuser = $facebook->getUser();
		
		if ($fbuser) {
			try {
				$facebook_response = $facebook->api('/me');
				$uid = $facebook->getUser();
			}catch (FacebookApiException $e) 
			{
				$fbuser = null;
			}
		}
		
		// redirect user to facebook login page if empty data or fresh login requires
		if (!$fbuser){
			$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$return_url, false));
			header('Location: '.$loginUrl);
		}

		//echo "<pre>"; print_r($facebook_response); echo "</pre>"; 

		$Login = new \WH\Model\User();
		$Login->setParam('oauthid', $facebook_response['id']);
		$Login->setParam('oauthsiteid', 'facebook'); //facebook or googleplus
		$Login->setParam('securitykey', $access_token);
		$Login->setParam('email', $facebook_response['email']);
		$Login->setParam('firstname', $facebook_response['first_name']);
		$Login->setParam('lastname', $facebook_response['last_name']);
		$Login->setParam('gender', $facebook_response['gender']);
		$Login->setParam('hometown', $hometown);
		$Login->setParam('location', $location);
		$Login->setParam('imagepath', '//graph.facebook.com/'.$facebook_response['id'].'/picture?type=large');
		$Login->setVersion($this->config->application->version);
		$Login->setPackage($this->config->application->package);
		$Login->setEnv($this->config->application->environment);
		$Login->setSSOParams();
		$ssoresponse = $Login->loginSocialUser();
		$ssoresponse['user']['facebook_user_id'] = $facebook_response['id'];

		//echo "<pre>"; print_r($ssoresponse); echo "</pre>"; 

		if(isset($ssoresponse['user']['sso_id'])){
			$rediskey = "WH_user_".$ssoresponse['user']['sso_id'];
			$this->redis->write(session_id(), json_encode($ssoresponse['user']));
			echo json_encode(array('userkey'=>$rediskey, 'ssoid'=>$ssoresponse['user']['sso_id'], 'status'=>'sucess'));
		}else{
			echo json_encode(array('status'=>'error'));
		}
		exit;
    }

    public function addwishlistAction(){
    	$this->view->setLayout('ajaxLayout');
    	$userid = $this->request->getPost('userid');
    	$entityid = $this->request->getPost('entityid');
    	$city = $this->request->getPost('city');
    	$entitytype = $this->request->getPost('entitytype');
    	$tip = $this->request->getPost('tip');

    	$Wishlist = new \WH\Model\Wishlist();
        $Wishlist->setUserId($userid);
        $Wishlist->setEntityId($entityid);
        $Wishlist->setCityId($city);
        $Wishlist->setEntityTypeID($entitytype);
        $Wishlist->setTip($tip);
        $Wishlist->setVersion($this->config->application->version);
		$Wishlist->setPackage($this->config->application->package);
		$Wishlist->setEnv($this->config->application->environment);

		try{
			$result = $Wishlist->add();	
		}catch(Exception $e){
			$result = array('status'=>0, 'message'=>'Already added in wishlist.');
		}
        echo json_encode($result);
    }

    public function logoutAction(){
    	$this->redis->destroy(session_id());
    	return $this->response->redirect($this->baseUrl);
    }

    public function wishlistbycityAction(){
    	$this->view->setLayout('ajaxLayout');
    	$userid = $this->request->getPost('bydate');
    	$city = $this->request->getPost('city');
    	$limit = $this->request->getPost('limit');
    	$start = $this->request->getPost('start');
    	$mainurl = $this->request->getPost('mainurl');
    	$parentid = $this->request->getPost('parentid');

    	$Wishlist = new \WH\Model\Wishlist();
        $Wishlist->setUserId($userid);
        $Wishlist->setCityId($city);
        $Wishlist->setStart($start);
        $Wishlist->setLimit($limit);
        $Wishlist->setVersion($this->config->application->version);
		$Wishlist->setPackage($this->config->application->package);
		$Wishlist->setEnv($this->config->application->environment);
		$wishlistbycity = $Wishlist->getAllByCity();

        $this->view->setVars(
			array(
				'wishlistbycity' => $wishlistbycity,
				'userid' => $userid,
				'start'=>$start+$limit,
				'limit'=>$limit,
				'city'=>$city,
				'mainurl'=>$mainurl,
				'parentid'=>$parentid
				)
			);
    }

    public function removewishlistAction(){
    	$this->view->setLayout('ajaxLayout');
    	$id = $this->request->getPost('id');
    	$Wishlist = new \WH\Model\Wishlist();
        $Wishlist->setId($id);
        $Wishlist->setVersion($this->config->application->version);
		$Wishlist->setPackage($this->config->application->package);
		$Wishlist->setEnv($this->config->application->environment);
        $remove = $Wishlist->remove();
        echo json_encode($remove);
        exit;
    }
}