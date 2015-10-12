<section class="hp tfa">
	<div class="mainback">
		<div class="bordered">
			<div class="desc">
				<!--<div class="contestlogo"><img src="{{baseUrl}}/img/tfa/groupp.png"></div>-->

				<div class="row">
					<ul class="list logos padding0">
						<li><img src="{{baseUrl}}/img/tfa/tfalogo.png"></li>
						<li><img src="{{baseUrl}}/img/tfa/and.png"></li>
						<li><img src="{{baseUrl}}/img/tfa/times_nightlife_awards.png"></li>
					</ul>
				</div>

				<div class="presents">Powered by</div>
				<div class="wh_logo"><img src="{{baseUrl}}/img/wh-logo-revert.png"></div>
				<div class="coming_text">
					<div class="voting-start">Scroll Down and Vote</div>
				</div>

				<!--<a href="#" class="scroll-down img-circle addscroll"><i class="fa fa-angle-down"></i></a>-->
			</div>
		</div>
	</div>
</section><div class="clearfix"></div>

<section class="share_data">
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 sponsor">
					<img src="{{baseUrl}}/img/tfa/sponsor.png">
				</div>
			</div>
		</div>
	</div>
</section>

<div class="clearfix"></div>
<section class="category-data">
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="category-block">
					<div class="category-head">
						SELECT YOUR CATEGORY AND VOTE
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="clearfix"></div>
<section class="category-list-data">
	<div class="section">
		<div class="container">
			<div class="row">
				<?php if(count($tfacategorys['location']) > 1){ ?>
					<div class="col-sm-12 col-md-12 col-xs-12">
						<div class="category-list">
							<ul class="list-inline text-center">
								{% for key, tfacategory in tfacategorys['location'] %}
									<li data-for="{{key}}" {% if(tfacategory['name'] | lower == tfacity) %}class="active"{% endif %}><a href="{{baseUrl}}/{{tfacity}}/times-food-and-nightlife-awards-2016">{{tfacategory['name']}}</a></li>
								{% endfor %}
							</ul>
						</div>
					</div>
				<?php } ?>

				<div class="col-sm-12 col-md-12 col-xs-12">
					<div class="category-list">
						<?php $i = 1; ?>
						{% for key, tfacategory in tfacategorys['location'] %}
							{% if(tfacategory['name'] | lower == tfacity) %}
								<ul class="list-inline list-{{key}}">
									{% for key1, event in tfacategory['events'][0]['categories'] %}
										{% for key2, category in event['child_category'] %}
											<?php $title = $this->elements->toslug($category['name']); ?>
											<li class="{{key2}} {% if(tfasubcat == '' and i == 1) %}active{% elseif(title == tfasubcat) %}active{% endif %}"><a href="{{baseUrl}}/{{tfacity}}/times-food-and-nightlife-awards-2016/{{title}}">{{category['name']}}</a></li>
											<?php $i++; ?>
										{% endfor %}
									{% endfor %}
								</ul>
							{% endif %}
						{% endfor %}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<input type='hidden' value="{{iscontestrunning}}" id="iscontestruning">

{% for key, nomination in nominations %}
<section class="nomination_data">
	<div class="section">
		<div class="container">
			<div id="{{nomination['nominationcatid']}}" class="row">
				<div class="col-sm-12 col-md-12 col-xs-12">
					<div class="main-block">
						<div class="accordian-block">
							<div class="nomination-count float-left">
								{{nomination['nominationcatid']}}
							</div>
							<div class="category-name-block float-left">
								<div class="category-name">
									{{nomination['subcategory_name']}}
								</div>
								<div class="event-name">
									{{nomination['category_name']}}
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>			
			</div><div class="clearfix"></div>
			<div class="row work-content allfeeds">	
				<div class="tfafeeds {{nomination['id']}}">
					<!-- Nomination blocks design -->
					{% for key2, venues in nominations[key]['venue'] %}
						<?php $id = explode('_', $venues['id']); $vid = $id[1]; ?>
						<div id="{{venues['id']}}" class="col-sm-4 col-md-3 col-xs-6">
							<div class="work-item feeds-data">
								<div class="tfavotedhover {% if(venues['isvoted'] == 0) %}dnone{% endif %}" {% if(venues['isvoted'] == 1) %}style="opacity:1"{% endif %}>
									<div class="tickimg">
										Your Vote has been counted.
									</div>
									<hr>
									<div class="promote">
										Promote your favourite restaurant
										<div class="stro">The Kitchen for {{nominations[key]['subcategory_name']}}</div>
										<a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent('{{baseUrl}}{{venues['url']}}'),'facebook-share-dialog','width=626,height=436');return false;"><div class="social-icon float-left"><i class="fa fa-facebook"></i></div></a>
										<a href="#" onclick="window.open('http://twitter.com/share?url={{baseUrl}}{{venues['url']}}','facebook-share-dialog','width=626,height=436');return false;"><div class="social-icon float-left"><i class="fa fa-twitter"></i></div></a>
										<a href="#" onclick="window.open('https://plus.google.com/share?url={{baseUrl}}{{venues['url']}}','facebook-share-dialog','width=626,height=436');return false;"><div class="social-icon float-left"><i class="fa fa-google-plus"></i></div></a>
										<div class="clearfix"></div>
									</div>
									<div class="clearfix"></div>
									<div class="share-vote">
										Share this direct vote link
										<div class="clearfix"></div><div class="sharebtn" onclick="copyToClipboard('{{baseUrl}}{{venues['url']}}')">COPY LINK <i class="fa fa-link"></i></div>
									</div>
									<div class="clearfix"></div>
									<hr>
									{% if(iscontestrunning == 1) %}
										<div class="cvote cancelvote" data-for="tfa" data-entityid="{{vid}}"  data-city="{{currentCity}}" data-categoryid="{{nominations[key]['id']}}" data-eventid="{{nominations[key]['event_id']}}">CANCEL VOTE</div>
									{% else %}
										<div class="cvote">CANCEL VOTE</div>
									{% endif %}
								</div>

								<a href="{{baseUrl}}{{venues['url']}}">
									<div class="hover-container">
										<div class="hover-wrap">
											<i class="glyphicon glyphicon-plus bino"></i>
										</div>
										<?php if(!empty($venues['img_url'])){ ?>
											{{feeds.getimage(baseUrl, venues['img_url'], 479, 320, venues['title'], venues['img_url'], '', '', key+1)}}
										<?php }else{ ?>
											{{feeds.getimage(baseUrl, venues['image']['uri'], 479, 320, venues['title'], venues['image'], '', '', key+1)}}
										<?php } ?>
									</div>
								</a>

								<div class="the-box no-margin no-border">
									<div class="boundarea">
										<div title="{{venues['title']}}" class="feed-title">{{venues['name']}}</div>
										<?php
											$addresses = array();
											$addresses[] =  $venues['landmark'];
											$addresses[] =  $venues['locality'];
											$addresses[] =  $venues['zonename'];
											$addresses[] =  $venues['cities'];
											$address = implode(', ', $addresses)
										?>
										<div class="feed-short-desc">{{address}}</div>
									</div>
								</div>
								<div class="ratings">
									<div class="float-left">
										FOOD <strong>{{venues['rating'][0]['rating']}}</strong>
									</div>
									<div class="float-left">
										SERVICE <strong>{{venues['rating'][1]['rating']}}</strong>
									</div>
									<div class="float-left">
										DECOR <strong>{{venues['rating'][2]['rating']}}</strong>
									</div>
									<div class="popup float-left">
										<a href="{{baseUrl}}{{venues['url']}}"><img src="{{baseUrl}}/img/popup.png"></a>
									</div>
								</div>

								<div class="clearfix"></div>
								<div class="calls text-center">VOTE OR MISS CALL - {{venues['zip_dial']}}</div>

								{% if(iscontestrunning == 1) %}
									<div class="votebtn cvoted" data-for="tfa" data-entityid="{{vid}}"  data-city="{{currentCity}}" data-categoryid="{{nominations[key]['id']}}" data-eventid="{{nominations[key]['event_id']}}">VOTE</div>	
								{% else %}
									<div class="votebtn cvoteddone">VOTING CLOSED</div>
								{% endif %}
							</div>
						</div>
					{% endfor %}
					<!-- Nomination blocks design end -->
				</div>
			</div>
		</div>
	</div>
</section>
{% endfor %}


