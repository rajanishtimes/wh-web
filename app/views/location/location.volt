<?php //$this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?><br><br>
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
			
				<div class="searchbox">
					<form id="searchForm" method="POST" action="{{baseUrl}}/{{currentCity}}/location/location" onsubmit="return searchValid();">
							<div class="textinput float-left"><input id="searchtextinput" type="text" autofocus class="form-control" placeholder="Search..." name="location" value="{% if(searchkeyword is defined) %}{{searchkeyword}}{% endif %}"></div>
							<div class="searchinout float-right"><button class="input-group-addon">
							<img src="{{baseUrl}}/img/search.png">
							</button></div>
					</form><div class="clearfix"></div>
				</div>
								
				<div class="clearfix"></div>
				
				<div class="work-content allfeeds">
					{% if(allfeedslist | length > 0) %}
						<ul id="getallfeedssearch" class="media-list feed-list">
							{% if(searchkeyword is defined) %}
								<h1>{{allfeedslist['meta']['match_count']}} result(s) found from &#8220;{{searchkeyword}}&#8221;</h1>
							{% endif %}
							
							{{feeds.getfeedslist(baseUrl, allfeedslist)}}
						</ul><div class="clearfix"></div>
						<div class="loadmore">
							<?php if($allfeedslist['meta']['match_count'] > ($limit)){ ?>
								<div class="btn btn-primary" onclick="view_feed_with_ajax('{{city}}','{{baseUrl}}/search/searchlist', '{{start}}', '{{limit}}', 'getallfeedssearch', '', '', 'all')">Load More</div>
							<?php }?>
						</div>
					{% else %}
						<ul id="getallfeedssearch" class="media-list feed-list">
							{% if(searchkeyword is empty) %}
							{% else %}
								<h1>No result(s) found for &#8220;{{searchkeyword}}&#8221;</h1><div style="height:200px"></div>
							{% endif %}
							<div style="height:200px"></div>
						</ul><div class="clearfix"></div>
					{% endif %}
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