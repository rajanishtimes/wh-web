{{ partial('partials/head')}}

<?php if($iswebview == false){ ?>
	{{ partial('partials/header')}}	
<?php }else{ ?>
	<style>
		.container-fluid{margin:0;}
	</style>
<?php }?>

<div class="container-fluid">
	<div class="row">
		<?php
			echo $this->getContent();
		?>
	</div>
</div>

<!-- END BACK TO TOP 
{{ partial('partials/globalsearch')}} -->
<?php if($iswebview == false){ ?>
	{{ partial('partials/footer')}}
<?php }?>
{{ partial('partials/bottom')}}