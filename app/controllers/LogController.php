<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class LogController extends BaseController{
	public function initialize(){
		parent::initialize();
    }

    public function indexAction(){
		if ($this->request->isAjax() == true) {
			$entitytype = $this->request->get("entitytype");
			$entityid = $this->request->get("entityid");
			$request_uri = $this->request->get("request_uri");
			$logger = new \WH\Model\Logger();
			$logger->setEntityId($entityid);
			$logger->setRequestUri($request_uri);
			$logger->setSource('web');
			$logger->setEntityType($entitytype);
			$logger->saveViewLogs();
		}
		exit;
    }


    public function nominationAction(){
    	$connection = mysql_connect('192.169.31.167', 'whFire', 'Times@123') or die('Could not connect to server.');
		mysql_select_db('whweb', $connection) or die('Could not select database.');

		mysql_query("delete from bnh_nominations where contest_name='pavbhaji'");

    	//$haleem = array(19300, 30026, 139121, 50139, 48828, 48762, 42112, 47856, 38909, 36813, 30154, 45224, 50926, 44694, 46527, 33138, 43159, 27295, 7150, 42359);
		//$biryani = array(19300, 50926, 48828, 33487, 42112, 50139, 38909, 36813, 41605, 139120, 50970, 46968, 46527, 44694, 32052, 43159, 5778, 6121, 22636, 34289);
		//$vadapav = array('140655','140107','140068','19412','139853','50904','44752','133876','51491','19444','46916','139385','139384','139381', '139362', '139346', '139226', '137570', '138506', '138505');
		//$vadapav = array('38643','41518','46391','44395','47775','40318','11900','11805','35548','11806','14892','143893');
		$pavbhaji = array('38643','41518','46391','44395','47775','40318','11900','11805','35548','11806','14892','143893');

		/*foreach($haleem as $haleemdata){
			$Solr = new \WH\Model\Solr();
			$Solr->setParam('ids','v_'.$haleemdata);
			$Solr->setParam('fl','detail');
			$Solr->setSolrType('detail');
			$Solr->setEntityDetails();
			$venuedetail = $Solr->getDetailResults();

			$data = array();
			$data['img'] = $venuedetail['images'][0]['uri'];
			$data['description'] = str_replace('\'s', '', $venuedetail['formatted_address']);

			echo $query = "INSERT INTO bnh_nominations
						SET contest_name = 'biryani and haleem',
						contest = 'haleem',
						title = '".addslashes($venuedetail['title'])."',
						entity_id = ".$haleemdata.",
						entity_type_id = 200,
						url = '".$venuedetail['url']."',
						data = '".json_encode($data)."',
						year = '2015',
						city = 'Hyderabad',
						city_id  = 12,
						time_added = '".date('Y-m-d h:i:s', time())."',
						last_modified = '".date('Y-m-d h:i:s', time())."',
						status = 1";
					echo "<br>";
			mysql_query($query); 
		}*/

		foreach($pavbhaji as $biryanidata){
			$Solr = new \WH\Model\Solr();
			$Solr->setParam('ids','v_'.$biryanidata);
			$Solr->setParam('fl','detail');
			$Solr->setSolrType('detail');
			$Solr->setEntityDetails();
			$venuedetail = $Solr->getDetailResults();

			$data = array();
			$data['img'] = $venuedetail['images'][0]['uri'];
			$data['description'] = str_replace('\'s', '', $venuedetail['formatted_address']);

			echo $query = "INSERT INTO bnh_nominations
						SET contest_name = 'pavbhaji',
						contest = 'pavbhaji',
						title = '".addslashes($venuedetail['title'])."',
						entity_id = ".$biryanidata.",
						entity_type_id = 200,
						url = '".$venuedetail['url']."',
						data = '".json_encode($data)."',
						year = '2015',
						city = 'Mumbai',
						city_id  = 2,
						time_added = '".date('Y-m-d h:i:s', time())."',
						last_modified = '".date('Y-m-d h:i:s', time())."',
						status = 1";
			echo "<br>";
			mysql_query($query); 
		}

		mysql_close($connection);
		exit;
    }
}