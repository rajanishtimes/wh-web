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

48762
    public function nominationAction(){
    	$connection = mysql_connect('192.169.34.185', 'fireBird', 'FHW%aw1') or die('Could not connect to server.');
		mysql_select_db('whweb', $connection) or die('Could not select database.');

		mysql_query("delete from bnh_nominations");

    	$haleem = array(19300, 30026, 139121, 50139, 48828, 48762, 42112, 47856, 38909, 36813, 30154, 45224, 50926, 44694, 46527, 33138, 43159, 27295, 7150, 42359);
		$biryani = array(19300, 50926, 48828, 33487, 42112, 50139, 38909, 36813, 41605, 139120, 50970, 46968, 46527, 44694, 32052, 43159, 5778, 6121, 22636, 34289);

		foreach($haleem as $haleemdata){
			$Solr = new \WH\Model\Solr();
			$Solr->setParam('ids','v_'.$haleemdata);
			$Solr->setParam('fl','detail');
			$Solr->setSolrType('detail');
			$Solr->setEntityDetails();
			$venuedetail = $Solr->getDetailResults();

			$data = array();
			$data['img'] = $venuedetail['images'][0]['uri'];
			$data['description'] = $venuedetail['formatted_address'];

			echo $query = "INSERT INTO bnh_nominations
						SET contest_name = 'biryani and haleem',
						contest = 'haleem',
						title = '".stripcslashes($venuedetail['title'])."',
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
		}

		foreach($biryani as $biryanidata){
			$Solr = new \WH\Model\Solr();
			$Solr->setParam('ids','v_'.$biryanidata);
			$Solr->setParam('fl','detail');
			$Solr->setSolrType('detail');
			$Solr->setEntityDetails();
			$venuedetail = $Solr->getDetailResults();

			$data = array();
			$data['img'] = $venuedetail['images'][0]['uri'];
			$data['description'] = $venuedetail['formatted_address'];

			echo $query = "INSERT INTO bnh_nominations
						SET contest_name = 'biryani and haleem',
						contest = 'biryani',
						title = '".stripcslashes($venuedetail['title'])."',
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
		}

		mysql_close($connection);
    }
}