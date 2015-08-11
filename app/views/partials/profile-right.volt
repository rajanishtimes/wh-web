<div class="right-profile-section text-center">
	<div class="section sidebar">
		<div class="panel panel-no-border panel-sidebar text-left">
			<div class="panel-heading">
				<h3 class="panel-title">Article for you</h3>
			</div>
			<ul class="media-list">
				<?php $i = 0; ?>
				{% for key, list in allfeedslists['results'] %}
				{% if(i <= 4) %}
				<li class="media">
					<a href="{{baseUrl}}{{list['url']}}" title="{{list['title']}}"  class="pull-left">
						{{feeds.getimage(baseUrl, list['image']['uri'], 85, 85, list['title'], '', '', 'media-object img-post', key+1, '')}} 
					</a>
					<div class="media-body">
						<p><a href="{{baseUrl}}{{list['url']}}">{{list['title']}}</a></p>
						{% if(list['type'] == 'CONTENT' ) %}
							<?php $date_time = date('j M, Y' ,strtotime($list['published_time'])) ?>
							<p class="small text-info">{{date_time}}</p>
						{% else %}
							<p class="small text-info">{{list['time']}}</p>
						{% endif %}
					</div>
				</li>
				{% endif %}
				<?php $i++; ?>
				{% endfor %}
			</ul>
		</div>
	</div>
</div>