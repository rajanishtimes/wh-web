<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;
use \WH\Model\Util\Sendpal;

class IndexController extends BaseController{
	
	public function initialize(){
        $this->view->setLayout('mainLayout');
		$this->view->searchform = new SearchForm;
		$this->view->newsletterform = new NewsletterForm;
		parent::initialize();
    }

	public function indexAction(){
		if(!empty($this->profileid)){
			$this->profilepage();
		}else{
			$this->homepage();
		}
    }

    protected function profilepage(){
    	$allfeedslists = $this->getfeeddata(0, 4, $this->city, 'all', '', '', 'Content', '', 'feed', 0, 4);
		$this->view->allfeedslists = $allfeedslists;

		$addprofile = new \WH\Model\UserProfile();
		$addprofile->setUsername($this->profileid);
		$profiledata = $addprofile->getProfile();
		$profiledata['imagepath'] = "https://graph.facebook.com/".$profiledata['facebook_id']."/picture?width=150&height=150";

		$Wishlist = new \WH\Model\Wishlist();
        $Wishlist->setUserId($profiledata['sso_id']);
        $Wishlist->setVersion($this->config->application->version);
		$Wishlist->setPackage($this->config->application->package);
		$Wishlist->setEnv($this->config->application->environment);
        $allwishlistlist = $Wishlist->getAll();

        $title = 'Go-do List Events and Places by '.$profiledata['firstname'].' '.$profiledata['lastname'].' | '.$this->config->application->SiteName;
        $this->tag->setTitle($title);
		$this->view->meta_description = 'Check out the Go-do List events and places that were submitted by '.$profiledata['firstname'].' '.$profiledata['lastname'].' on '.$this->config->application->SiteName;
		
 
		
		$this->view->setVars(
			array(
				'allwishlistlist' => $allwishlistlist,
				'total_count' => $total_count,
				'profiledata' => $profiledata,
				'start'=>10,
				'limit'=>10
				)
			);

    	$this->view->pick(["index/profile"]);
    }
	
	protected function homepage(){
		/* $this->setcities();
		$this->setcityid();*/
		$this->setlogsarray('homepage_start');
		$this->view->entitytype = 'homepage';
		$city = $this->currentCity;
		$cityshown = $this->cityshown($city);
		$this->view->cityshown = $cityshown;
		$this->response->setHeader('Cache-Control', 'max-age=900');
		//$this->response->setHeader('Cache-Control', 'private, max-age=0, must-revalidate');
		
		
		/* ======= Seo Update ============= */
		
		if($cityshown == 'Delhi NCR'){
			$title = 'Things to do in Delhi NCR, Gurgaon, Noida, Faridabad & Ghaziabad Today | '.$this->config->application->SiteName;
			$this->view->meta_description = 'Events in NCR - Delhi, Gurgaon, Noida, Faridabad, Ghaziabad & Greater Noida: Check out the list of things to do in Delhi NCR today and have unlimited fun.';
			$this->view->meta_keywords = 'things to do in Delhi NCR, what to do in Delhi NCR, Delhi NCR events';
		}else{
			$title = $cityshown.' Events: Things to do in '.$cityshown.' Today | '.$this->config->application->SiteName;
			$this->view->meta_description = 'Events in '.$cityshown.': Getting bored? Wondering what to do in '.$cityshown.' today? Check out the list of things to do in '.ucwords($city).' today and have unlimited fun. ';
			$this->view->meta_keywords = 'things to do in '.$cityshown.', what to do in '.$cityshown.', '.$cityshown.' events';
		}
		$this->tag->setTitle($title);

		if($_SERVER['REQUEST_URI'] == '/'){
			$this->view->canonical_url = $this->baseUrl;	
		}else{
			$this->view->canonical_url = $this->baseUrl.'/'.$city;
		}
		
		$this->view->deep_link = 'timescity://';
		/* ======= Seo Update ============= */
		$top3event = new \WH\Model\Event();
		$top3event->setCityID($this->cityId);
		$top3event->setParam('byType', 'Event,Content,Review');

		try{
			$topfeeds = $top3event->webTop3List();
		}catch(Exception $e){
			$topfeeds = array();
		}
		$this->setlogsarray('top_feeds');
		
		$core = new \WH\Model\Core();
		$core->setCity($this->cityId);
		try{
			$populartags = $core->getResults();
		}catch(Exception $e){
			$populartags = array();
		}
		
		$this->setlogsarray('popular_tags');
		
		$start = 0;
		$limit = 11;

		if($this->config->adtech->enableadtech == 1){
			$llimit = $limit-1;
		}else{
			$llimit = $limit;
		}
		
		try{
			$allfeedslist = $this->getfeeddata($start, $llimit, $city, 'all', '', '', 'Event,Content', '', 'feed', $start, $llimit);
			$sponsors_count = count($allfeedslist['results']) - $llimit;
		}catch(Exception $e){
			$allfeedslist = array();
		}
				
		$this->view->setVars(
			array(
				'allfeedslist' => $allfeedslist,
				'start'=> $llimit - $sponsors_count,
				'limit'=>$limit,
				'populartags'=>$populartags,
				'topfeeds'=>$topfeeds,
				'spstart' => $llimit,
				'splimit' => $limit
				)
			);
		
		$this->setlogsarray('all_feeds');
		$this->getlogs('homepage', $this->baseUrl.'/homepage');
	}

	public function newsletterAction(){
		$ermessage = array();
		$form = new NewsletterForm();
		if ($form->isValid($this->request->getPost())) {
			// Test only
			
			$this->session->set("email", $this->request->getPost('email'));
			return $this->forward('index/index');
		} else {
			//print_r($form);
			//print_r($form->getMessages());
			foreach ($form->getMessages() as $message) {
				$ermessage[] = $message;
			}
			exit;
		}
	}
	
	public function homepageAction(){
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: ".$this->baseUrl);
		exit;
		//$this->view->setLayout('homepageLayout');
    }
	
	public function policyAction(){
        $this->tag->setTitle('Privacy Policy');
		$this->view->entitytype = 'policy';
		$this->view->meta_description = '';
		$this->view->meta_keywords = '';
		$this->view->og_title = 'Privacy Policy';
		$this->view->og_description = '';
		$this->view->og_url = $this->baseUrl.'/'.'policy';
		$this->view->canonical_url = $this->baseUrl.'/'.'policy';
    }
    public function termsAction(){
        $this->tag->setTitle('Terms & Conditions');
		$this->view->entitytype = 'terms';
		$this->view->meta_description = '';
		$this->view->meta_keywords = '';
		$this->view->og_title = 'Terms & Conditions';
		$this->view->og_description = '';
		$this->view->og_url = $this->baseUrl.'/'.'terms';
		$this->view->canonical_url = $this->baseUrl.'/'.'terms';
    }
	
	public function whytimescityAction(){
        $this->tag->setTitle('What is What&apos; Hot?');
		$this->view->entitytype = 'story';
		$this->view->meta_description = '';
		$this->view->meta_keywords = '';
		$this->view->og_title = 'What is What&apos; Hot?';
		$this->view->og_description = '';
		$this->view->og_url = $this->baseUrl.'/'.'story';
		$this->view->canonical_url = $this->baseUrl.'/'.'about-us';
    }

    public function whytimescityrawAction(){
        $this->view->setLayout('rawLayout');
    }

    public function aboutusAction(){
        $this->tag->setTitle('About Us');
		$this->view->entitytype = 'about us';
		$this->view->meta_description = '';
		$this->view->meta_keywords = '';
		$this->view->og_title = 'About Us';
		$this->view->og_description = '';
		$this->view->og_url = $this->baseUrl.'/'.'about-us';
		$this->view->canonical_url = $this->baseUrl.'/'.'about-us';
    }

	
	public function unsubscribeAction(){
		$email = base64_decode($this->dispatcher->getParam('email'));
		$Newsletter = new \WH\Model\User();
		$Newsletter->setNewsletter();
        $Newsletter->setEmail($email);
		$Newsletter->getUnsubNewsletterResults();
	}

	public function updatecityAction(){
		if(!empty($this->logged_user)){
			$city = $this->request->getPost('city');
			$addprofile = new \WH\Model\UserProfile();
			$addprofile->setSSOid($this->logged_user->sso_id);
			$addprofile->setCity($city);
			$getdata = $addprofile->updateProfile();
			echo json_encode($getdata);
		}else{
			echo "not logged in";
		}
		exit;
	}


	public function sendmailhtmlAction(){
		$html = '<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width" />

<title>Responsive Email Template</title>

<style type="text/css">
    a{text-decoration: none;}
  body   {width: 100%; background-color: #f0f0f0; margin:0; padding:0; -webkit-font-smoothing: antialiased;font-family: Georgia, Times, serif}
  table {border-collapse: collapse;}
  
  @media only screen and (max-width: 640px)  {

        body[yahoo] .deviceWidth {width:440px!important; padding:0 !important;}
        body[yahoo] .center {text-align: center!important;}
        body[yahoo] .border-bottom{border-bottom: 1px solid #ccc; margin-bottom: 20px;}
        body[yahoo] .left{padding-right: 0 !important;}
        body[yahoo] .paddingtop0{padding-top: 0 !important;}
        body[yahoo] *[class="share-responsive"]{display: block !important;}
        body[yahoo] *[class="share"]{display: none !important;}
      }

  @media only screen and (max-width: 479px) {
        body[yahoo] .deviceWidth {width:280px!important; padding:0 !important;}
        body[yahoo] .center {text-align: center!important;}
        body[yahoo] .border-bottom{border-bottom: 1px solid #ccc; margin-bottom: 20px;}
        body[yahoo] .left{padding-right: 0 !important;}
        body[yahoo] .paddingtop0{padding-top: 0 !important;}
        body[yahoo] *[class="share-responsive"]{display: block !important;}
        body[yahoo] *[class="share"]{display: none !important;}
      }

</style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: Georgia, Times, serif; width:100%; background:#f0f0f0;">

<!-- Wrapper -->
<table class="deviceWidth" width="580" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#ffffff" style="background:#ffffff">
  <tr>
    <td width="100%" valign="top" bgcolor="#f0f0f0" style="padding-top:36px; min-width:100%" class="paddingtop0">
        <table width="580" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" bgcolor="#ffffff">
            <tr>
                <td width="100%" valign="top" bgcolor="#ffffff" style="min-width:100%">
      <!-- Logo Header -->
        <table width="580" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" bgcolor="#ffffff">
                <tr>
                    <td style="padding:20px">
                        <table align="center" width="100%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth" style="text-align:center;">
                            <tr>
                                <td valign="middle" width="50%" align="right" style="border-right: 1px solid #ccc; padding: 5px 20px;">
                                    <a href="#"><img  class="deviceWidth" src="http://www.whatshot.in/imge/iimg/logo-email.png" alt="" border="0" style="display: block; width: 130px !important;" /></a>
                                </td>
                                <td valign="middle" width="50%" align="left" style="padding: 5px 10px;">
                                    <a href="#" style="text-decoration: none; color: #000; font-size: 16px; color: #000;font-family:Arial, sans-serif ">Delhi NCR</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table><!-- Logo Header End -->
            <div style="clear:both"></div>
            <div style="min-height:0px;height:0px;margin:0 auto;background:#fff">&nbsp;</div><!-- spacer -->

          <!-- User Detail -->
            <table width="580" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" bgcolor="#ffffff">
                <tr>
                    <td style="padding:20px">
                        <table align="left" width="100%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth" style="font-size: 21px;font-family: Raleway, sans-serif; line-height: 24px; ">
                            <tr>
                                <td valign="top" class="center" style="text-align:center;">
                                        Hi <strong>Rishabh T</strong>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" align="center" style="color:#717171">
                                    Top Activities this weekend
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" align="center">
                                    <div style="background: #000 none repeat scroll 0 0; min-height: 2px; margin: 16px 0px 0px; width: 38px;"></div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
          </table><!-- User Detail -->
          <div style="clear:both"></div>
            <div style="min-height:0px;height:0px;margin:0 auto;background:#fff">&nbsp;</div><!-- spacer -->
            <!-- 2 Column Images & Text Side by SIde -->
            <table width="580" border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth" bgcolor="#ffffff">
                <tr>
                    <td style="padding:20px">
                        <table align="left" width="41%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth border-bottom">
                            <tr>
                                <td valign="top" class="left" style="padding-right:20px; padding-bottom: 20px;">
                                    <div style="font-size: 14px; font-family: arial, Times, serif; margin-bottom: 8px;">8th Aug, 09:00pm - 01:00am</div>
                                    <div style="padding-bottom: 7px;"><a href="" style="color: #000;font-family: Times, serif;font-size: 26px;font-weight: 500;text-decoration: none;">Gig Alert: Ramiro Lopez + Kohra</a></div>
                                    <a href="#"><img width="267" src="http://www.whatshot.in/imge/img1.jpg" alt="" border="0" style="width: 100%; display: block;" class="deviceWidth" /></a>
                                    <div style="font-family: arial, Times, serif; font-size: 14px; line-height: 18px; padding-top: 10px;">Summer House Cafe, 1st Floor, DDA Shopping Complex, Aurobindo Market, Near Pyare Lal and Sons Jewellers, Hauz Khas, South, Delhi NCR</div>
                                </td>
                            </tr>
                        </table>
                        <table align="left" width="59%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth">
                            <tr>
                                <td valign="top" style="padding-right:0px;">
                                    <div style="font-size: 14px; font-family: arial, Times, serif; margin-bottom: 8px;">6th Aug, 08:00pm - 11:00pm</div>
                                    <div style="padding-bottom: 7px;"><a href="" style="color: #000;font-family: Times, serif;font-size: 26px;font-weight: 500;text-decoration: none;">Acappella Music With Vocal Rasta</a></div>
                                    <a href="#"><img width="267" src="http://www.whatshot.in/imge/img2.jpg" alt="" border="0" style="width: 100%; display: block;" class="deviceWidth" /></a>
                                    <div style="font-family: arial, Times, serif; font-size: 14px; line-height: 18px; padding-top: 10px;">Raasta, 30A, 1st Floor, Hauz Khas Village, Near Shri Hanuman  Mandir, Hauz Khas, South, Delhi NCR</div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding:0 20px;"><div style="background:#ccc; min-height:1px;max-height:1px;">&nbsp;</div></td>
                </tr>
            </table><!-- End 2 Column Images & Text Side by SIde -->
            <div style="height:15px;margin:0 auto;background:#fff">&nbsp;</div><!-- spacer -->

            <table width="580" border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth" bgcolor="#ffffff">
                <tr>
                    <td style="padding:20px">
                        <table align="left" width="59%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth border-bottom">
                            <tr>
                                <td valign="top" class="left" style="padding-right:20px; padding-bottom: 20px;">
                                    <div style="font-size: 14px; font-family: arial, Times, serif; margin-bottom: 8px;">By Pritisha Borthakur</div>
                                    <div style="padding-bottom: 7px;"><a href="" style="color: #000;font-family: Times, serif;font-size: 26px;font-weight: 500;text-decoration: none;">City Guide: Regional Flavours Of The West</a></div>
                                    <a href="#"><img width="267" src="http://www.whatshot.in/imge/img3.jpg" alt="" border="0" style="width: 100%; display: block;" class="deviceWidth" /></a>
                                    <div style="font-family: arial, Times, serif; font-size: 14px; line-height: 18px; padding-top: 10px;">Explore local regional fare with our new series covering restaurants, delivery outlets and stores across Delhi NCR.</div>
                                </td>
                            </tr>
                        </table>
                        <table align="left" width="41%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth">
                            <tr>
                                <td valign="top" style="padding-right:0px;">
                                    <div style="font-size: 14px; font-family: arial, Times, serif; margin-bottom: 8px;">6th Aug, 08:45pm - 12:00am</div>
                                    <div style="padding-bottom: 7px;"><a href="" style="color: #000;font-family: Times, serif;font-size: 26px;font-weight: 500;text-decoration: none;">Acoustic Music With Bhrigu Sahni</a></div>
                                    <a href="#"><img width="267" src="http://www.whatshot.in/imge/img4.jpg" alt="" border="0" style="width: 100%; display: block;" class="deviceWidth" /></a>
                                    <div style="font-family: arial, Times, serif; font-size: 14px; line-height: 18px; padding-top: 10px;">Depot 29, B-6/2, Level 2/3, Commercial Complex, Safdarjang Enclave, Opposite Deer Park, Safdarjang, South, Delhi NCR</div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top" align="center">
                        <div style="background: #000 none repeat scroll 0 0; min-height: 2px; margin: 16px 0; width: 38px;"></div>
                    </td>
                </tr>
            </table><!-- End 2 Column Images & Text Side by SIde -->
            <div style="min-height:15px;margin:0 auto;background:#fff;">&nbsp;</div><!-- spacer -->

            <!-- Checkout detail btn -->
            <table width="580" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" bgcolor="#ffffff">
                <tr>
                    <td style="padding:0 20px">
                        <table align="center" width="100%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth">
                            <tr>
                                <td valign="top" class="center" style="padding:10px 0; text-align:center">
                                    <span>Find Interesting? huh !</span>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" align="center" style="padding:10px 0 45px 0">
                                    <a href="#" style="text-decoration:none"><div style="background: #fc3768 none repeat scroll 0 0; color: #fff; font-size: 12px; padding: 15px 20px; text-decoration: none; width: 115px;">CHECK OUT MORE</div></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table><!-- Checkout detail btn -->
            </td></tr></table>
            <div style="clear:both"></div>
            <div style="min-height:0px;margin:0 auto;">&nbsp;</div><!-- spacer -->

            <!-- Footer -->
            <table width="580" class="deviceWidth" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#f0f0f0">
                <tr>
                    <td style="font-family: Raleway,sans-serif; color: rgb(173, 173, 173); padding:0 20px 20px" bgcolor="#f0f0f0">
                        <table align="center" width="100%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth">
                            <tr>
                                <td valign="top" align="center">
                                    <table align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td valign="top" align="right" width="33%">
                                                <a href="#"><img src="http://www.whatshot.in/imge/iimg/facebook-share.jpg"></a>
                                            </td>
                                            <td valign="top" align="center" width="33%">
                                                <a href="#"><img src="http://www.whatshot.in/imge/iimg/twitter-share.jpg"></a>
                                            </td>
                                            <td valign="top" align="left" width="33%">
                                                <a href="#"><img src="http://www.whatshot.in/imge/iimg/instagram-share.jpg"></a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" align="center" style="padding: 20px 0px 10px;">
                                    <img src="http://www.whatshot.in/imge/wh_grey.jpg">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" align="center" style="padding:5px 0">
                                    <span>Explore whats popular & new in your city.</span>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" align="center" style="padding:5px 0">
                                    <a href="http://www.whatshot.in" style="color:#fc3768"><span>www.whatshot.in</span></a>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" align="center" style="padding: 5px 0px; font-size: 12px;">
                                    <span>Unable to see this message? <a href="" style="color:#4e4e4e; text-decoration: underline;">View here</a></span>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" align="center" style="padding:5px 0; font-size: 11px;">
                                    <span>Not interested? <a href="" style="color:#4e4e4e; text-decoration: underline;">Unsubscribe</a></span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table><!-- Footer -->
            <div style="height:0px;margin:0 auto;">&nbsp;</div><!-- spacer -->

    </td>
  </tr>
</table> <!-- End Wrapper -->

</body>
</html>';
		
		if(!empty($this->request->getPost('email'))){
			$subject = 'Test e-mail newsletter';
			//$to = array('rishabh.trivedi08@gmail.com', 'rishabh.trivedi@timesinternet.in','sudhanshu@timescity.com','rishabh.trivedi@timesinternet.in');
			echo $html;
			$to = array($this->request->getPost('email'));
			if(Sendpal::sendEmail($html, $subject, $to)){
				echo "mail Sent";	
			}else{
				echo 'error';
			}
			exit;
		}
	}
}
