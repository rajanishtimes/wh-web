<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;
require_once(APP_PATH.'public/inc/facebook.php' ); //include fb sdk

class ProfileController extends BaseController{
	public function initialize(){
		parent::initialize();
		$this->view->setLayout('mainLayout');
    }

    public function indexAction(){
    	
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

		$Login = new \WH\Model\User();
		$Login->setParam('oauthid', $this->config->facebook->appId);
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

		$rediskey = 'WH_user_'.$ssoresponse['user']['sso_id'];
		$this->redis->set($rediskey, json_encode($ssoresponse['user']));
		echo $rediskey;
		exit;
    }

    public function facebooklogoutAction(){
    	$whatshotuserkey = $this->request->getPost('whatshotuserkey');
    	$rediskey = 'WH_user_'.$whatshotuserkey;
    	$this->redis->delete($rediskey, '');
    	exit;
    }
}