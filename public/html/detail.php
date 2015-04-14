<?php $baseurl = ((empty($_SERVER['REQUEST_SCHEME'])) ? 'http' : $_SERVER['REQUEST_SCHEME']).'://'.$_SERVER['SERVER_NAME'].'/phalcon/html/';?>
<!DOCTYPE html>
<html lang="en" data-ng-app="app">
<head>
		<base href="<?php echo $baseurl; ?>index.php" />
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">
		<title>WhatsHot: Homepage</title>

		<!-- BOOTSTRAP CSS (REQUIRED ALL PAGE)-->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		
		<!-- MAIN CSS (REQUIRED ALL PAGE)-->
		<link href="<?php echo $baseurl; ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="<?php echo $baseurl; ?>assets/css/style.css" rel="stylesheet">
		<link href="<?php echo $baseurl; ?>assets/css/style-responsive.css" rel="stylesheet">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<script type="text/javascript">
			var baseurl = '<?php echo $baseurl; ?>';
		</script>
	</head>
 
	<body class="tooltips no-padding">
		<!--
		===========================================================
		BEGIN PAGE
		===========================================================
		-->
		<div class="wrapper">	
			<!-- BEGIN TOP NAVBAR -->
			<div class="container">
				<div class="row">
					<div class="top-navbar">
					<!-- Begin logo -->
					<div class="logo">
						<a href="index.html"><img src="assets/img/logo.jpg" alt="Logo"></a>
					</div><!-- /.logo -->
					<!-- End logo -->
					
					<!-- Begin search nav -->
					<div class="nav-right-info">
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
								<span>Delhi NCR</span>&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-down"></i>
							  </a>
							  <ul class="dropdown-menu square primary margin-list-rounded with-triangle">
								<li><a href="#fakelink">Delhi</a></li>
								<li><a href="#fakelink">Delhi</a></li>
								<li><a href="#fakelink">Delhi</a></li>
								<li><a href="#fakelink">Delhi</a></li>
							  </ul>
							</li>
						</ul>
					<!-- End City Nav -->
					
				</div><!-- /.top-navbar -->
				</div>
			</div><!-- /.container -->
			<!-- END TOP NAVBAR -->
			
			<hr>
			<div class="section">
				<div class="container">
					<div class="row">
						<h1>Hey! Top Things to do today</h1>
						<div class="work-content">
							<div class="col-sm-6 col-md-4 col-xs-6">
								<div class="work-item">
									<div class="the-box full no-border transparent no-margin make-up">
										<p class="feed-name">6 Alternative Things to Do In Pune This Weekend</p>
									</div>
									<img src="assets/img/thumb1.jpg" alt="Img work">
								</div>
							</div>
							<div class="col-sm-6 col-md-4 col-xs-6">
								<div class="work-item">
									<div class="the-box full no-border transparent no-margin make-up">
										<p class="feed-name">5 Television Shows To Watch This Summer</p>
									</div>
									<img src="assets/img/thumb1.jpg" alt="Img work">
								</div>
							</div>
							<div class="col-sm-6 col-md-4 col-xs-6">
								<div class="work-item">
									<div class="the-box full no-border transparent no-margin make-up">
										<p class="feed-name">Highway Dhabas Around Delhi NCR</p>
									</div>
									<img src="assets/img/thumb1.jpg" alt="Img work">
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<hr>
						<div class="work-content">						
							<h2 class="heading">Popular Tips</h2>
							<ul class="work-category-wrap">
								<li class="filter" >Bourbon</li>
								<li class="filter" >Seafood</li>
								<li class="filter" >Soul live in GIP</li>
							</ul><div class="clearfix"></div>
						</div><div class="clearfix"></div><hr>
						
						<div class="col-sm-6 col-md-6 col-xs-12 no-padding">
							<h2>Your Feeds</h2>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-12">
							<ul class="filter_type text-right">
								<li><a href="#">TODAY</a></li>
								<li><a href="#">TOMMORROW</a></li>
								<li><a href="#">THIS WEEKEND</a></li>
								<li><a href="#">ALL</a></li>
							</ul>
						</div><div class="clearfix"></div>
						
						
						<div class="work-content allfeeds">
							<div class="col-sm-4 col-md-3 col-xs-6">
								<div class="work-item">
									
									<img src="assets/img/thumb1.jpg" alt="Img work">
									<div class="the-box no-margin">
										<div class="feed-title"><a href="">Toque Talk: Brent Owens</a></div>
										<p class="feed-short-desc">Masterchef Australia has become a phenonmenon in india. In fact,...</p>
									</div>
								</div>
							</div>
							<div class="col-sm-4 col-md-3 col-xs-6">
								<div class="work-item">
									
									<img src="assets/img/thumb1.jpg" alt="Img work">
									<div class="the-box no-margin">
										<div class="feed-title"><a href="">Toque Talk: Brent Owens</a></div>
										<p class="feed-short-desc">Masterchef Australia has become a phenonmenon in india. In fact,...</p>
									</div>
								</div>
							</div>
							<div class="col-sm-4 col-md-3 col-xs-6">
								<div class="work-item">
									
									<img src="assets/img/thumb1.jpg" alt="Img work">
									<div class="the-box no-margin">
										<div class="feed-title"><a href="">Toque Talk: Brent Owens</a></div>
										<p class="feed-short-desc">Masterchef Australia has become a phenonmenon in india. In fact,...</p>
									</div>
								</div>
							</div>
							<div class="col-sm-4 col-md-3 col-xs-6">
								<div class="work-item">
									
									<img src="assets/img/thumb1.jpg" alt="Img work">
									<div class="the-box no-margin">
										<div class="feed-title"><a href="">Toque Talk: Brent Owens</a></div>
										<p class="feed-short-desc">Masterchef Australia has become a phenonmenon in india. In fact,...</p>
									</div>
								</div>
							</div>
							
							
							
							<div class="col-sm-4 col-md-3 col-xs-6">
								<div class="work-item">
									
									<img src="assets/img/thumb1.jpg" alt="Img work">
									<div class="the-box no-margin">
										<div class="feed-title"><a href="">Toque Talk: Brent Owens</a></div>
										<p class="feed-short-desc">Masterchef Australia has become a phenonmenon in india. In fact,...</p>
									</div>
								</div>
							</div>
							<div class="col-sm-4 col-md-3 col-xs-6">
								<div class="work-item">
									
									<img src="assets/img/thumb1.jpg" alt="Img work">
									<div class="the-box no-margin">
										<div class="feed-title"><a href="">Toque Talk: Brent Owens</a></div>
										<p class="feed-short-desc">Masterchef Australia has become a phenonmenon in india. In fact,...</p>
									</div>
								</div>
							</div>
							<div class="col-sm-4 col-md-3 col-xs-6">
								<div class="work-item">
									
									<img src="assets/img/thumb1.jpg" alt="Img work">
									<div class="the-box no-margin">
										<div class="feed-title"><a href="">Toque Talk: Brent Owens</a></div>
										<p class="feed-short-desc">Masterchef Australia has become a phenonmenon in india. In fact,...</p>
									</div>
								</div>
							</div>
							<div class="col-sm-4 col-md-3 col-xs-6">
								<div class="work-item">
									
									<img src="assets/img/thumb1.jpg" alt="Img work">
									<div class="the-box no-margin">
										<div class="feed-title"><a href="">Toque Talk: Brent Owens</a></div>
										<p class="feed-short-desc">Masterchef Australia has become a phenonmenon in india. In fact,...</p>
									</div>
								</div>
							</div>
							
							
							
							<div class="col-sm-4 col-md-3 col-xs-6">
								<div class="work-item">
									
									<img src="assets/img/thumb1.jpg" alt="Img work">
									<div class="the-box no-margin">
										<div class="feed-title"><a href="">Toque Talk: Brent Owens</a></div>
										<p class="feed-short-desc">Masterchef Australia has become a phenonmenon in india. In fact,...</p>
									</div>
								</div>
							</div>
							<div class="col-sm-4 col-md-3 col-xs-6">
								<div class="work-item">
									<img src="assets/img/thumb1.jpg" alt="Img work">
									<div class="the-box no-margin">
										<div class="feed-title"><a href="">Toque Talk: Brent Owens</a></div>
										<p class="feed-short-desc">Masterchef Australia has become a phenonmenon in india. In fact,...</p>
									</div>
								</div>
							</div>
							<div class="col-sm-4 col-md-3 col-xs-6">
								<div class="work-item">
									<img src="assets/img/thumb1.jpg" alt="Img work">
									<div class="the-box no-margin">
										<div class="feed-title"><a href="">Toque Talk: Brent Owens</a></div>
										<p class="feed-short-desc">Masterchef Australia has become a phenonmenon in india. In fact,...</p>
									</div>
								</div>
							</div>
							<div class="col-sm-4 col-md-3 col-xs-6">
								<div class="work-item">
									<img src="assets/img/thumb1.jpg" alt="Img work">
									<div class="the-box no-margin">
										<div class="feed-title"><a href="">Toque Talk: Brent Owens</a></div>
										<p class="feed-short-desc">Masterchef Australia has become a phenonmenon in india. In fact,...</p>
									</div>
								</div>
							</div>
							
							
							
							<div class="col-sm-4 col-md-3 col-xs-6">
								<div class="work-item">
									<img src="assets/img/thumb1.jpg" alt="Img work">
									<div class="the-box no-margin">
										<div class="feed-title"><a href="">Toque Talk: Brent Owens</a></div>
										<p class="feed-short-desc">Masterchef Australia has become a phenonmenon in india. In fact,...</p>
									</div>
								</div>
							</div>
							<div class="col-sm-4 col-md-3 col-xs-6">
								<div class="work-item">
									<img src="assets/img/thumb1.jpg" alt="Img work">
									<div class="the-box no-margin">
										<div class="feed-title"><a href="">Toque Talk: Brent Owens</a></div>
										<p class="feed-short-desc">Masterchef Australia has become a phenonmenon in india. In fact,...</p>
									</div>
								</div>
							</div>
							<div class="col-sm-4 col-md-3 col-xs-6">
								<div class="work-item">
									<img src="assets/img/thumb1.jpg" alt="Img work">
									<div class="the-box no-margin">
										<div class="feed-title"><a href="">Toque Talk: Brent Owens</a></div>
										<p class="feed-short-desc">Masterchef Australia has become a phenonmenon in india. In fact,...</p>
									</div>
								</div>
							</div>
							<div class="col-sm-4 col-md-3 col-xs-6">
								<div class="work-item">
									<img src="assets/img/thumb1.jpg" alt="Img work">
									<div class="the-box no-margin">
										<div class="feed-title"><a href="">Toque Talk: Brent Owens</a></div>
										<p class="feed-short-desc">Masterchef Australia has become a phenonmenon in india. In fact,...</p>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>

		
		<!-- BEGIN FOOTER -->
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-md-4 extrapaddright">
						<p>We deliver. Get the best of What's HOT Today in your inbox.</p>
						<form role="form">
							<div class="input-group subscribe">
							  <input type="text" class="form-control" placeholder="Your email address">
							  <span class="input-group-btn">
								<button class="btn btn-primary" type="button">SIGN UP</button>
							  </span>
							</div>
						</form>
						<p><small>You can opt-out at any time. Please refer to our privacy policy for contact information.</small></p>
						<hr style="border-color: #ccc;">
						<div class="social-icon">
							<div class="shareon float-left">
								Share on:
							</div>
							<div class="social_icon facebook float-left"><i class="fa fa-facebook"></i></div>
							<div class="social_icon twitter float-left"><i class="fa fa-twitter"></i></div>
							<div class="social_icon google-plus float-left"><i class="fa fa-google-plus"></i></div>
						</div>
					</div>
					
					<div class="col-sm-6 col-md-2">
						<h4>Our Story</h4>
						<ul class="list">
							<li><a href="index.html">Site Map</a></li>
							<li><a href="index.html">Help</a></li>
							<li><a href="index.html">Carrers</a></li>
							<li><a href="index.html">User Agreement</a></li>
							<li><a href="index.html">Policy</a></li>
							<li><a href="index.html">Patent Info</a></li>
						</ul>
					</div><!-- /.col-sm-4 -->
					<div class="col-sm-6 col-md-2">
						<ul class="list">
							<li><a href="index.html">Delhi</a></li>
							<li><a href="index.html">Mumbai</a></li>
							<li><a href="index.html">Kolkata</a></li>
							<li><a href="index.html">Portfolio</a></li>
							<li><a href="index.html">Pricing</a></li>
							<li><a href="index.html">Blog</a></li>
							<li><a href="index.html">Kolkata</a></li>
							<li><a href="index.html">Portfolio</a></li>
							<li><a href="index.html">Pricing</a></li>
							<li><a href="index.html">Blog</a></li>
						</ul>
					</div><!-- /.col-sm-3 -->
					<div class="clearfix visible-sm"></div>
					<div class="col-sm-6 col-md-4 text-right">
						<div class="setbottom">
							<div class="app_option">
								<a href=""><div class="iphone_app float-right"></div></a>&nbsp;&nbsp;
								<a href=""><div class="android_app float-right"></div></a>
							</div>
							<img src="assets/img/mobiles.png">
						</div>
					</div><!-- /.col-sm-2 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</footer><!-- /.section -->
		
		<div class="footer">
			<div class="container">
				<div class="row">
					<div class="col-sm-5">
						&copy; 2015 <a href="#fakelink">WhatsHot.com</a> &ndash; all rights reserved.
					</div><!-- /.col-sm-5 -->
					<div class="col-sm-7 text-right">
						<ul class="list-inline">
						  <li><a href="#fakelink">Privacy policy</a></li>
						  <li><a href="#fakelink">Terms and condition</a></li>
						</ul>
					</div><!-- /.col-sm-7 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</div><!-- /.footer -->
		<!-- END FOOTER -->
		
		
		<!-- BEGIN BACK TO TOP BUTTON -->
		<div id="back-top">
			<i class="fa fa-chevron-up"></i>
		</div>
		<!-- END BACK TO TOP -->


		<!--
		===========================================================
		Placed at the end of the document so the pages load faster
		===========================================================
		-->
		<!-- jQuery -->
		<script src="<?php echo $baseurl; ?>assets/js/jquery.js"></script>
		<script src="<?php echo $baseurl; ?>assets/js/bootstrap.min.js"></script>
		<script src="<?php echo $baseurl; ?>assets/js/apps.js"></script>
	</body>
</html>