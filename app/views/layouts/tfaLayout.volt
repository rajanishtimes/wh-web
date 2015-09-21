{{ partial('partials/head')}}
{{ partial('partials/header')}}

<div class="container-fluid">
	<div class="row">
		<?php
			echo $this->getContent();
		?>
	</div>
</div>

{{ partial('partials/footer')}}
{{ partial('partials/bottom')}}