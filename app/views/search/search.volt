<?php //$this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?><br><br>
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
			
				<div class="searchbox">
					<form id="searchForm" method="POST" action="/search/search">
							<div class="textinput float-left"><input id="searchtextinput" type="text" class="form-control" placeholder="Search..." name="search"></div>
							<div class="searchinout float-right"><button class="input-group-addon"><i class="fa fa-search"></i></button></div>
					</form><div class="clearfix"></div>
				</div>
								
				<div class="clearfix"></div>
				
				<div class="work-content allfeeds">
					<ul id="getallfeedssearch" class="media-list feed-list">
						{% if(searchkeyword is defined) %}
							<h1>{{allfeedslist['meta']['match_count']}} result(s) found from &#8220;{{searchkeyword}}&#8221;</h1>
						{% endif %}
						
						{{feeds.getfeedslist(baseUrl, allfeedslist)}}
					</ul><div class="clearfix"></div>
					<div class="loadmore">
						<?php if($allfeedslist['meta']['match_count'] > ($limit)){ ?>
							<div class="btn btn-primary" onclick="view_feed_with_ajax('{{baseUrl}}search/searchlist', '{{start}}', '{{limit}}', 'getallfeedssearch', '', '', 'all')">Load More</div>
						<?php }?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	.container-fluid, .container-fluid .section {
		background: none repeat scroll 0 0 #f9f9f9;
	}
</style>