{{ partial('partials/head')}}
{{ partial('partials/header')}}

<div class="container-fluid">
	<div class="row tfa">
		<section class="hp tfa">
			<div class="mainback">
				<div class="bordered">
					<div class="desc">
						<!--<div class="contestlogo"><img src="{{baseUrl}}/img/tfa/groupp.png"></div>-->

						<div class="row">
							<ul class="list logos padding0">
								<li><img src="{{baseUrl}}/img/tfa/tfalogo.png"></li>
								<li><img src="{{baseUrl}}/img/tfa/times_nightlife_awards.png"></li>
							</ul>
						</div>

						<div class="presents">Powered by</div>
						<div class="wh_logo"><img src="{{baseUrl}}/img/wh-logo-revert.png"></div>
						<div class="coming_text">COMING SOON</div>
						<!--<a href="#" class="scroll-down img-circle addscroll"><i class="fa fa-angle-down"></i></a>-->
					</div>
				</div>
			</div>
		</section><div class="clearfix"></div>

		<?php
			echo $this->getContent();
		?>
	</div>
</div>

{{ partial('partials/footer')}}
{{ partial('partials/bottom')}}