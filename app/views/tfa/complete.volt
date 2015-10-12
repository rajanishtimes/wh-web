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
								FOUND-{{nomination['count_venue']}}
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
				<div class="tfafeeds">
					<!-- Nomination blocks design -->
					{% for key2, venues in nominations[key]['venue'] %}
						<?php
							//echo "<pre>"; print_r($venues); echo "</pre>"; exit;
							$classes = "complete";
							$imgclass = "grayscale";
							if($venues['is_winner'] == 1){
								$classes = "winner";
								$imgclass = '';
							}
						?>
						<div id="{{venues['id']}}" class="col-sm-4 col-md-3 col-xs-6">
							<div class="work-item feeds-data {{classes}}">
								<a href="{{baseUrl}}{{venues['url']}}">
									<div class="hover-container">
										<?php if(!empty($venues['img_url'])){ ?>
											{{feeds.getimage(baseUrl, venues['img_url'], 479, 320, venues['title'], venues['img_url'], '', imgclass, key+1)}}
										<?php }else{ ?>
											{{feeds.getimage(baseUrl, venues['image']['uri'], 479, 320, venues['title'], venues['image'], '', imgclass, key+1)}}
										<?php } ?>
									</div>
								</a>

								<div class="the-box no-margin no-border">
									<div class="boundarea">
										<div title="{{venues['title']}}" class="feed-title">{{venues['title']}}</div>
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
										FOOD <strong>3.5</strong>
									</div>
									<div class="float-left">
										SERVICE <strong>3.5</strong>
									</div>
									<div class="float-left">
										DECOR <strong>3.5</strong>
									</div>
									<div class="popup float-left">
										<a href="{{baseUrl}}{{venues['url']}}"><img src="{{baseUrl}}/img/popup.png"></a>
									</div>
									<div class="clearfix" style="border: medium none; padding: 0px;"></div>
								</div>
								{% if(venues['is_winner'] == 1) %}
									<div class="clearfix"></div>
									<div class="winnerl"><img src="{{baseUrl}}/img/tfa/winnerlogo.png"></div>
								{% else %}
									<div class="clearfix"></div>
									<a href="{{baseUrl}}{{venues['url']}}"><div class="votebtn cvoteddone">READ CRITIC REVIEW</div></a>
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

