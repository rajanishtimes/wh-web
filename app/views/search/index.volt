<?php if(!empty($allfeedslist['results'])){ ?>
	<?php //echo "<pre>"; print_r($allfeedslist);?>
	{{feeds.getfeeds(baseUrl, allfeedslist, start+spstart, cityshown, fromtype)}}
<-!-###@###->

<?php

if($spstart > $start){
	$check = $spstart;
}else{
	$check = $start;
}

if($limit < 1){
	$relval = 0;
}else{
	$relval = $start/$limit;
}

if($allfeedslist['meta']['match_count'] > $check){ ?>
	<div class="btn btn-primary" onclick="view_feed_with_ajax('{{city}}','{{mainurl}}', '{{start}}', '{{limit}}', '{{parentid}}', '{{elements.create_slug(searchkeyword)}}', '{{tags | trim}}', '{{bydate}}', '{{fromtype}}', '{{spstart}}', '{{splimit}}')" rel="{{relval}}">Load More</div>
<?php }?>
<?php }else{ ?>
	{% if(start < 1) %}
		<div class="container"><div class="alert alert-info in">No Result(s) Found</div></div>
	{% endif %}
	<-!-###@###->
	<div class=""></div>
<?php }?>