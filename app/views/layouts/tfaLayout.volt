{{ partial('partials/head')}}
{{ partial('partials/header')}}

<div class="container-fluid">
	<div class="row tfa">
		<?php
			echo $this->getContent();
		?>
	</div>
</div>

{{ partial('partials/footer')}}
{{ partial('partials/bottom')}}