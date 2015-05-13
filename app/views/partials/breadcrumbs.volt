<!-- BEGIN BERADCRUMB AND PAGE TITLE -->
<div class="page-title-wrap">
	<div class="container no-padding">
		<ol class="breadcrumb">
			<?php $i =0; foreach($breadcrumbs as $key=>$breadcrumb){
				
				$i++;
				if(!empty($breadcrumb)){
			?>
				<li id="{{i}}" itemscope itemtype="http://data-vocabulary.org/Breadcrumb" itemref="{{i+1}}" <?php if($i > 1){ ?> itemprop="child" <?php } ?> >
					<a href="{{breadcrumb}}" itemprop="url">
						<span itemprop="title">
							<?php if(strtolower($key)=='delhi' || strtolower($key)=='delhincr' || strtolower($key)=='delhi-ncr'){ ?>
								Delhi NCR
							<?php }else{ ?>
								{{key}}
							<?php } ?>
						</span>
					</a>
				</li>
			<?php }else{ ?>
				<li id="{{i}}" itemscope itemtype="http://data-vocabulary.org/Breadcrumb" itemprop="child" class="active">
					{{key}}
				</li>
			<?php }} ?>
		</ol>
	</div><!-- /.container -->
</div><!-- /.page-title-wrap -->