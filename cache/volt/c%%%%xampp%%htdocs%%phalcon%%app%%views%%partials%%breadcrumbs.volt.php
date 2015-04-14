<!-- BEGIN BERADCRUMB AND PAGE TITLE -->
<div class="page-title-wrap">
	<div class="container no-padding">
		<ol class="breadcrumb">
			<?php foreach($breadcrumbs as $key=>$breadcrumb){
				if(!empty($breadcrumb)){
			?>
				<li><a href="<?php echo $breadcrumb; ?>"><?php echo $key; ?></a></li>
			<?php }else{ ?>
				<li class="active"><?php echo $key; ?></li>
			<?php }} ?>
		</ol>
	</div><!-- /.container -->
</div><!-- /.page-title-wrap -->
