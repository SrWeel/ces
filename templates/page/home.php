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
						if(@$_SESSION['ces1313777_sessid_inicio'])
                        {
						
						$objmenuweb->menu_extra='<li><div style="font-family:11px; color:#FFFFFF; font-weight:bold" >HOLA '.strtoupper($_SESSION['ces1313777_sessid_nombrecompleto']).' <a href="index.php?snp=WVhCc1BURTNKbk5sWTJNOU55WjBhWEJ2UFRFPQ==825"><img src="images/keyi.png"></a></div></li>';
		
						$objmenuweb->grupoactivo_menu='35,43';
						$objmenuweb->desplegar_menu('t',$DB_gogess);
						}
						else
						{
						$objmenuweb->grupoactivo_menu='35,32,33';
					     $objmenuweb->desplegar_menu('t',$DB_gogess);
						 }
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
			<a class="main-logo" href="index.php"><img src="<?php echo $objtemplatep->path_template ?>assets/img/logo.png" alt=""></a>
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
			<div class="swiper-banner" data-swiper="container" data-loop="true" data-autoplay="5000">
				<div class="swiper-wrapper">
				<?php
				$lista_banner="select * from app_banner where bann_activo=1 order by bann_orden asc";
				$rs_banner = $DB_gogess->executec($lista_banner,array());
				if($rs_banner)
				{
      				while (!$rs_banner->EOF) {
				?>
					<div class="swiper-slide">
						<img src="archivo/<?php echo $rs_banner->fields["bann_banner"]; ?>" alt="Slider Image" data-parallax="image">
						<div class="overlay"></div>
						<div class="slider-caption-one">
							<h2 data-animate="bounceInDown"><?php echo utf8_encode($rs_banner->fields["bann_titulo1"]); ?></h2>
							<h3 data-animate="fadeInUp" data-delay="0.5s" data-duration="0.5"><?php echo utf8_encode($rs_banner->fields["bann_titulo2"]); ?></h3>
							<a href="<?php echo $rs_banner->fields["bann_link"]; ?>"  data-animate="fadeInUp" data-delay="0.8s" data-duration="0.5"><img src="images/masinfo.png"></a>
							
						</div>
					</div>
				<?php
					$rs_banner->MoveNext();
					}
				}
				?>	
			
					
				</div>
				<!-- Add Pagination -->
				<div class="swiper-pagination" data-swiper="pagination"></div>
				<!-- Add Arrows -->
				<div class="banner-next" data-swiper="next">
					<div class="next-btn"><i class="icon dti-angle-right"></i></div>
				</div>
				<div class="banner-prev" data-swiper="prev">
					<div class="prev-btn"><i class="icon dti-angle-left"></i></div>
				</div>
				<a href="#service" class="switcher" data-type="section-switch"><i class="icon dti-angle-down-double"></i></a>
			</div>
		</section>
		<!-- /.banner -->
		

		<!--==========================-->
		<!--=        Service         =-->
		<!--==========================-->

		<section id="service">
			<div class="container">
				<div class="service_content">
					<h2 class="section-title wow zoomIn">SERVICIOS</h2>
					<p class="caption wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
						
					<?php  echo utf8_encode($objportal->sys_texto3); ?>
					</p>
				</div>
				<!-- /.service_content -->

				<div class="row">
					<div class="service-item">
						
						<?php
				$lista_servicio="select * from app_serviciosweb where servici_activo=1 order by servici_orden asc";
				$rs_servicio = $DB_gogess->executec($lista_servicio,array());
				if($rs_servicio)
				{
      				while (!$rs_servicio->EOF) {
				?>
						<div class="col-md-4 col-xs-6 full-width">
							<div class="row">
								<div class="service wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.4s">
									<div class="icon-box">
										<div class="icon-overlay"></div>
										<i class="<?php echo $rs_servicio->fields["servici_icono"]; ?>"></i>
									</div>
									<div class="service_content">
										<h3 class="title"><?php echo $rs_servicio->fields["servici_titulo"]; ?></h3>
										<p>
											<?php echo $rs_servicio->fields["servici_texto"]; ?>
										</p>
									</div>
								</div>
							</div>
							<!-- /.row -->
						</div>
						<!-- /.col-md-4 -->
                <?php
					$rs_servicio->MoveNext();
					}
				}
				?>	
						
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