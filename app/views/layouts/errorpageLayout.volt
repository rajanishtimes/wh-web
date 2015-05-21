{{ partial('partials/head')}}
<div class="container-fluid">
	<div class="row">
		<?php
			echo $this->getContent();
		?>
	</div>
</div>
{{ partial('partials/bottom')}}