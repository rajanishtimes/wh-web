{{ partial('partials/head')}}
{{ partial('partials/header')}}
<div class="container-fluid">
	<div class="row">
		<?php
			echo $this->getContent();
		?>
	</div>
</div>

<!-- BEGIN BACK TO TOP BUTTON -->
<div id="back-top">
	<i class="fa fa-chevron-up"></i>
</div>
<!-- END BACK TO TOP -->
{{ partial('partials/globalsearch')}}
{{ partial('partials/footer')}}
{{ partial('partials/bottom')}}