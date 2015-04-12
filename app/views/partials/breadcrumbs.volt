<!-- BEGIN BERADCRUMB AND PAGE TITLE -->
<div class="page-title-wrap">
	<div class="container no-padding">
		<ol class="breadcrumb">
			<?php foreach($breadcrumbs as $key=>$breadcrumb){
				if(!empty($breadcrumb)){
			?>
				<li><a href="{{breadcrumb}}">{{key}}</a></li>
			<?php }else{ ?>
				<li class="active">{{key}}</li>
			<?php }} ?>
		</ol>
	</div><!-- /.container -->
</div><!-- /.page-title-wrap -->
