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
<?php

$_SESSION = array();
session_unset();
session_destroy();
?>
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
						<img src="<?php echo $objtemplatep->path_template ?>static/banner/1.jpg" alt="Slider Image" data-parallax="image">
						<div class="overlay"></div>
						<div class="slider-caption-one">
							<h2 data-animate="bounceInDown">DOMOHS</h2>
							<h3 data-animate="fadeInUp" data-delay="0.5s" data-duration="0.5">Iniciar a la red de servicios</h3>
							
							
							<?php
							$linksvar="";
							$linksvarencri="";
							$linksvar="apl=17&secc=7&tipo=1";	
					        $linksvarencri=$objmenuweb->variables_segura($linksvar);
					        
							?>
							
							<a href="index.php?snp=<?php echo $linksvarencri; ?>" class="gp-bn-btn" data-animate="fadeInUp" data-delay="0.8s" data-duration="0.5">Ingresar como Cliente</a>
							
							<?php
							$linksvar="";
							$linksvarencri="";
							$linksvar="apl=17&secc=7&tipo=2";	
					        $linksvarencri=$objmenuweb->variables_segura($linksvar);
					        
							?>
							
							<a href="index.php?snp=<?php echo $linksvarencri; ?>" class="gp-bn-btn" data-animate="fadeInUp" data-delay="0.8s" data-duration="0.5">Ingresar como Experto</a>
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
				<h2 class="section-title wow zoomIn">DOMOHS</h2>
				<p class="caption wow fadeInUp" data-wow-delay="0.1s">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro cumque consequuntur sunt. Minus <br> tempore iusto, eum esse fugiat sint, aliquam ut dicta iste debitis
				</p>

				<div class="about-content">
					<div class="row">
					
						<div class="col-md-6 col-sm-6">
							<img src="images/servicios_home.png">
							<!-- /.about-box -->
						</div>
						<!-- /.col-md-4 col-sm-4 -->

						
						<!-- /.col-md-4 col-sm-4 -->

						<div class="col-md-6 col-sm-6">
							<div class="about-box wow fadeInUp" data-wow-delay="0.4s">
								<div class="icon-box">
									<i class="icon dti-check"></i>
								</div>
								<h3 class="about-title">Que es DOMOHS?</h3>
								<p>
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo, perferendis, soluta! Quae iurecum ab sit rerum praesentium
								</p>
								<h3 class="about-title">Expertos</h3>
								<p>
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo, perferendis, soluta! Quae iurecum ab sit rerum praesentium
								</p>
								<h3 class="about-title">Servicios</h3>
								<p>
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo, perferendis, soluta! Quae iurecum ab sit rerum praesentium
								</p>
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

		

		<!--==========================-->
		<!--=        Service         =-->
		<!--==========================-->

		<section id="service">
			<div class="container">
				<div class="service_content">
					<h2 class="section-title wow zoomIn">Our Service</h2>
					<p class="caption wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro cumque consequuntur sunt. Minus <br> tempore iusto, eum esse fugiat sint, aliquam ut dicta iste debitis
					</p>
				</div>
				<!-- /.service_content -->

				<div class="row">
					<div class="service-item">
						<div class="col-md-4 col-xs-6 full-width">
							<div class="row">
								<div class="service wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.4s">
									<div class="icon-box">
										<div class="icon-overlay"></div>
										<i class="icon dti-lightbulb"></i>
									</div>
									<div class="service_content">
										<h3 class="title">Creative Design</h3>
										<p>
											Contrary to popular belief, Lorem Ipsum is not<br> simply random text. It has roots in a piece of<br> classical Latin literature
										</p>
									</div>
								</div>
							</div>
							<!-- /.row -->
						</div>
						<!-- /.col-md-4 -->

						<div class="col-md-4 col-xs-6 full-width">
							<div class="row">
								<div class="service wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.4s">
									<div class="icon-box">
										<div class="icon-overlay"></div>
										<i class="icon dti-todo-text-pencil"></i>
									</div>
									<div class="service_content">
										<h3 class="title">Professional Code</h3>
										<p>
											Contrary to popular belief, Lorem Ipsum is not<br> simply random text. It has roots in a piece of<br> classical Latin literature
										</p>
									</div>
								</div>
							</div>
							<!-- /.row -->
						</div>
						<!-- /.col-md-4 -->

						<div class="col-md-4 col-xs-6 full-width">
							<div class="row">
								<div class="service wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.4s">
									<div class="icon-box">
										<div class="icon-overlay"></div>
										<i class="icon dti-mixer-square"></i>
									</div>
									<div class="service_content">
										<h3 class="title">Easy Customiza</h3>
										<p>
											Contrary to popular belief, Lorem Ipsum is not<br> simply random text. It has roots in a piece of<br> classical Latin literature
										</p>
									</div>
								</div>
							</div>
							<!-- /.row -->
						</div>
						<!-- /.col-md-4 -->

						<div class="col-md-4 col-xs-6 full-width">
							<div class="row">
								<div class="service wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
									<div class="icon-box">
										<div class="icon-overlay"></div>
										<i class="icon dti-pencil-ruler-pen"></i>
									</div>
									<div class="service_content">
										<h3 class="title">Perfect Pixel</h3>
										<p>
											Contrary to popular belief, Lorem Ipsum is not<br> simply random text. It has roots in a piece of<br> classical Latin literature
										</p>
									</div>
								</div>
							</div>
							<!-- /.row -->
						</div>
						<!-- /.col-md-4 -->

						<div class="col-md-4 col-xs-6 full-width">
							<div class="row">
								<div class="service wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
									<div class="icon-box">
										<div class="icon-overlay"></div>
										<i class="icon dti-webpage-image-text"></i>
									</div>
									<div class="service_content">
										<h3 class="title">100% Responsive</h3>
										<p>
											Contrary to popular belief, Lorem Ipsum is not<br> simply random text. It has roots in a piece of<br> classical Latin literature
										</p>
									</div>
								</div>
							</div>
							<!-- /.row -->
						</div>
						<!-- /.col-md-4 -->

						<div class="col-md-4 col-xs-6 full-width">
							<div class="row">
								<div class="service wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
									<div class="icon-box">
										<div class="icon-overlay"></div>
										<i class="icon dti-life-buoy"></i>
									</div>
									<div class="service_content">
										<h3 class="title">24/7 Support</h3>
										<p>
											Contrary to popular belief, Lorem Ipsum is not<br> simply random text. It has roots in a piece of<br> classical Latin literature
										</p>
									</div>
								</div>
							</div>
							<!-- /.col-md-4 -->
						</div>
						<!-- /.row -->
					</div>
					<!-- /.row -->
				</div>
				<!-- /.service-item -->
			</div>
			<!-- /.container -->
		</section>
		<!-- /#service -->

		


		

		

		<?php include($objtemplatep->path_template."pie.php"); ?>




	</div>
	<!-- /#site -->

	<?php include($objtemplatep->path_template."piejs_home.php"); ?>


</body>

</html>