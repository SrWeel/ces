<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Meta Data -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="app,software responsive site template" />
    <meta name="keywords" content="app,software,ipad,iphone,marketing,responsive,business,marketing,corporate"/>
    <meta name="author" content="Tansh" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php  echo $objportal->sys_titulo ?></title>
<?php include($objtemplatep->path_template."/cssjs_home.php"); ?>

</head>

<body id="home-version-1" class="home-version-1" data-style="default" data-spy="scroll" data-target="#active-menu">

	<!-- Start Loading page -->
	<div class="loading">
		<div class="loading-wrapper">
			<div class="rec r1"></div>
			<div class="rec r2"></div>
			<div class="rec r3"></div>
			<div class="rec r4"></div>
			<div class="rec r5"></div>
		</div>
	</div>

	

	<!-- End Loading page -->
	<div id="search_popup_wrapper" class="dialog dialog--close">
		<div class="dialog__overlay"></div>
		<div class="dialog__content">
			<div class="dialog-inner">
				<h2>Enter your keyword</h2>
				<form role="search" method="get" class="search-form" action="#">
					<input type="search" class="search-field" placeholder="Search �" value="" name="s" title="Search for:">
					<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
				</form>
				<div>
					<a class="action prevent-default" href="#"><i class="fa fa-close transition03"></i></a>
				</div>
			</div>
		</div>
	</div>

	<a href="#site" data-type="section-switch" class="return-to-top"><i class="fa fa-chevron-up"></i></a>

	<div id="site">

		<!--==========================-->
		<!--=        Header          =-->
		<!--==========================-->

		<header id="header" class="cd-auto-hide-header">
			<div class="header_wrapper">
				<nav class="navbar">
					<div class="navbar-header">
						<a class="navbar-brand main-logo" href="index.php"><img src="<?php echo $objtemplatep->path_template ?>assets/img/logo.png" alt=""></a>
						<a class="navbar-brand fixed-logo" href="index.php"><img src="<?php echo $objtemplatep->path_template ?>assets/img/logo_fixed.png" alt=""></a>
					</div>
					<div class="collapse navbar-collapse" id="active-menu">
						<?php
					     $objmenuweb->desplegar_menu('t',$DB_gogess);
					    ?>
					</div>
					<!-- /.navbar-collapse -->
				</nav>
			</div>
			<!-- /.header_wrapper -->
		</header>
		<!-- /#header -->

		<!--================================-->
		<!--=        Mobile Header         =-->
		<!--================================-->

		<div id="mobile-header">
			<a class="main-logo" href="index.html"><img src="<?php echo $objtemplatep->path_template ?>assets/img/logo.png" alt=""></a>
			<div class="menu-container">
				<div class="menu-toggle toggle-menu menu-right push-body">
					<div></div>
					<div></div>
					<div></div>
				</div>
				<!-- /.menu-toggle -->
			</div>
			<!-- /#menu-container -->
		</div>
		<!-- /#mobile-header -->

		<!--======================================-->
		<!--=        Mobile Menu Wrapper         =-->
		<!--======================================-->

		<div id="mobile-wrapper" class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right">
			<div class="mobile-menu-container">
				<?php
					     $objmenuweb->desplegar_menumovil('t',$DB_gogess);
				?>

				<div class="mobile_menu_search">
					<form method="get" action="#" id="search">
						<input type="text" name="s" placeholder="Search" class="search" value="">
						<button type="submit" id="searchsubmit" value=""><i class="fa fa-search"></i></button>
					</form>
				</div>
			</div>
			<!-- /.menu-container -->
		</div>
		<!-- /#mobile-wrapper -->

		<!--=========================-->
		<!--=        Banner         =-->
		<!--=========================-->

		<section class="banner" data-carousel="swiper">
			<!-- Swiper -->
			<div class="swiper-banner" data-swiper="container" data-loop="false" data-autoplay="5000">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<img src="<?php echo $objtemplatep->path_template ?>static/banner/5.jpg" alt="Slider Image" data-parallax="image">
						<div class="overlay"></div>
						<div class="slider-caption-one">
							<h2 data-animate="bounceInDown"><?php echo $objcontenido_portal->titulo; ?></h2>
						
						</div>
					</div>
					
					
					
				</div>
				<!-- Add Pagination -->
				<div class="swiper-pagination" data-swiper="pagination"></div>
				<!-- Add Arrows -->
				
				
				<a href="#about" class="switcher" data-type="section-switch"><i class="icon dti-angle-down-double"></i></a>
			</div>
		</section>
		<!-- /.banner -->

		<!--========================-->
		<!--=        About         =-->
		<!--========================-->

		<section id="about">
			<div class="container">
				<h2 class="section-title wow zoomIn"><?php echo $objcontenido_portal->titulo; ?></h2>
	
				<div class="about-content">
					<div class="row">
					
						

						
						<!-- /.col-md-4 col-sm-4 -->

						<div class="col-md-12 col-sm-12">
							<div class="about-box wow fadeInUp" data-wow-delay="0.4s">
								<div class="icon-box">
									<i class="icon dti-check"></i>
								</div>
								<?php echo $objcontenido_portal->con_contenido; ?>
							</div>
							<!-- /.about-box -->
						</div>
						<!-- /.col-md-4 col-sm-4 -->
					</div>
					<!-- /.row -->
				</div>
				<!-- /.about-content -->
			</div>
			<!-- /.container -->
		</section>
		<!-- /#about -->




		<?php include($objtemplatep->path_template."pie.php"); ?>




	</div>
	<!-- /#site -->

	<?php include($objtemplatep->path_template."piejs_home.php"); ?>


</body>

</html>