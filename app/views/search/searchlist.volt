<?php if(!empty($allfeedslist['results'])){ ?>
	<?php //echo "<pre>"; print_r($allfeedslist);?>
	{{feeds.getfeedslist(baseUrl, allfeedslist)}}
<-!-###@###->
<?php if($allfeedslist['meta']['match_count'] > ($start)){ ?>
	<div class="btn btn-primary" onclick="view_feed_with_ajax('{{cities}}','{{mainurl}}', '{{start}}', '{{limit}}', '{{parentid}}', '{{searchkeyword}}', '{{tags | trim}}', '{{bydate}}')">Load More</div>
<?php }?>
<?php }else{ ?>
	<div class="container"><div class="alert alert-info in">No Result(s) Found</div></div>
	<-!-###@###->
	<div class=""></div>
<?php }?>