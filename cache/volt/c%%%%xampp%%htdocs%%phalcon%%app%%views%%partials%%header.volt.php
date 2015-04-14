<!-- BEGIN TOP NAVBAR -->
<div class="container">
	<div class="row">
		<div class="top-navbar">
		<!-- Begin logo -->
		<div class="logo">
			<a href="<?php echo $baseUrl; ?><?php echo $city; ?>"><img src="<?php echo $baseUrl; ?>img/logo.png" alt="WhatsHot"></a>
		</div><!-- /.logo -->
		<!-- End logo -->
		
		<!-- Begin search nav -->
		<div id="searchbox" class="nav-right-info">
			<form role="form">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search...">
					<span class="input-group-addon"><i class="fa fa-search"></i></span>
				</div>
			</form>
		</div>
		<!-- End search nav -->
		
		<!-- Begin City Nav -->
			<ul class="nav-search navbar-right">
				<li class="dropdown">
				  <a href="#fakelink" class="dropdown-toggle" data-toggle="dropdown">
					<span><?php echo ucwords($city); ?></span>&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-down"></i>
				  </a>
				  <ul class="dropdown-menu square primary margin-list-rounded with-triangle">
					<?php foreach ($allcities['cities'] as $cities) { ?>
						<li><a href="<?php echo $baseUrl; ?><?php echo Phalcon\Text::lower(trim($cities['name'])); ?>"><?php echo $cities['name']; ?></a></li>
					<?php } ?>
				  </ul>
				</li>
			</ul>
		<!-- End City Nav -->
		
	</div><!-- /.top-navbar -->
	</div>
</div><!-- /.container -->
<!-- END TOP NAVBAR -->
<hr>