{{ partial('partials/head')}}

<?php if($iswebview == true && $controllername =='index' && $actionname =='whytimescity' ){ ?>
	<style>
		.container-fluid{margin:0;}
	</style>
<?php }else{ ?>
	{{ partial('partials/header')}}
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
<?php if($iswebview == true && $controllername =='index' && $actionname =='whytimescity' ){ ?>
	
<?php }else{?>
	{{ partial('partials/footer')}}
<?php } ?>
{{ partial('partials/bottom')}}