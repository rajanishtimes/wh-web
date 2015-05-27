<?php //$this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?><br><br>
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
			
				<div class="searchbox">
					<form id="searchForm" method="POST" action="{{baseUrl}}/{{currentCity}}/search/search" onsubmit="return searchValid();">
							<div class="textinput float-left"><input id="searchtextinput" type="text" autofocus="autofocus" class="form-control" placeholder="Search..." name="search" value="{% if(searchkeyword is defined) %}{{searchkeyword}}{% endif %}"></div>
							<div class="searchinout float-right"><button class="input-group-addon">
							<img src="{{baseUrl}}/img/search.png">
							</button></div>
					</form><div class="clearfix"></div>
				</div>
								
				<div class="clearfix"></div>
				
				<div class="work-content allfeeds">
					{% if(allfeedslist | length > 0) %}
						<ul id="getallfeedssearch" class="media-list feed-list">
							{% if(searchkeyword is empty) %}
							{% else %}
							
								{% if(allfeedslist['meta']['searched_for'] != allfeedslist['meta']['results_for']) %}
								<h1 class="searchheading">Did you Mean <strong>{{allfeedslist['meta']['results_for']}}</strong>? Found no result for <strong>{{allfeedslist['meta']['search_for']}}</strong></h1>
								{% else %}
								<h1 class="searchheading">{{allfeedslist['meta']['match_count']}} results found for &#8220;<strong>{{searchkeyword | trim}}</strong>&#8221;</h1>
								{% endif %}
							{% endif %}
							
							{{feeds.getfeedslist(baseUrl, allfeedslist, cityshown)}}
						</ul><div class="clearfix"></div>
						<div class="loadmore">
							<?php if($allfeedslist['meta']['match_count'] > ($limit)){ ?>
								<div class="btn btn-primary" onclick="view_feed_with_ajax('{{currentCity}}', '{{baseUrl}}/search/searchlist', '{{start}}', '{{limit}}', 'getallfeedssearch', '{{searchkeyword}}', '', 'all')">Load More</div>
							<?php }?>
						</div>
					{% else %}
						<ul id="getallfeedssearch" class="media-list feed-list">
							{% if(searchkeyword is empty) %}
							{% else %}
								<h1>No result(s) found for &#8220;{{searchkeyword | trim}}&#8221;</h1><div style="height:200px"></div>
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