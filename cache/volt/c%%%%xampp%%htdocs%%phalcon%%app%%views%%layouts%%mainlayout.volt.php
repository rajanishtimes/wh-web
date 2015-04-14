<?php echo $this->partial('partials/head'); ?>
<?php echo $this->partial('partials/header'); ?>
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
<?php echo $this->partial('partials/globalsearch'); ?>
<?php echo $this->partial('partials/footer'); ?>
<?php echo $this->partial('partials/bottom'); ?>