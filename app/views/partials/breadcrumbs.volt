<!-- BEGIN BERADCRUMB AND PAGE TITLE -->
<div class="page-title-wrap">
	<div class="container no-padding">
		<ol class="breadcrumb">
			<?php $i =0; foreach($breadcrumbs as $key=>$breadcrumb){
				$i++;
				if(!empty($breadcrumb)){
			?>
				<li id="{{i}}" itemscope itemtype="http://data-vocabulary.org/Breadcrumb" itemref="{{i+1}}">
					<a href="{{breadcrumb}}" itemprop="url">
						<span itemprop="{{key}}">{{key}}</span>
					</a>
				</li>
			<?php }else{ ?>
				<li class="active">{{key}}</li>
			<?php }} ?>
		</ol>
	</div><!-- /.container -->
</div><!-- /.page-title-wrap -->