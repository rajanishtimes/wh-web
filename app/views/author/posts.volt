<?php if(!empty($allfeedslist['results'])){ ?>
<div class="row work-content allfeeds">
	{{feeds.getfeedsforcoverimg(baseUrl, allfeedslist, start)}}
</div>
<-!-###@###->
<?php
if($limit < 1){
	$relval = 0;
}else{
	$relval = $start/$limit;
}
if($allfeedslist['meta']['match_count'] > $start){ ?>
	<div class="btn btn-primary" onclick="view_feed_with_ajax('{{city}}','{{mainurl}}', '{{start}}', '{{limit}}', '{{parentid}}', '{{authorid}}', '', '{{iscritic}}', 'author')" rel="{{relval}}">Load More</div>
<?php }?>

<?php } ?>