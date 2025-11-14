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
<?php include($objtemplatep->path_template."/cssjs_reg.php"); ?>

</head>

<body id="home-version-1" class="home-version-1" data-style="default" data-spy="scroll" data-target="#active-menu">


	<div id="site">

		<!--========================-->
		<!--=        About         =-->
		<!--========================-->

		<section id="about">
			<div class="container">
				<a href="index.php"><img src="images/logo_resgistro.png" border="0"></a>
				<hr size="1">
				
<div class="about-content">
					<div class="row">
					
						<div class="col-md-12 col-sm-12">
							<?php
					
						$variables_ext["idactv"]=@$idactv;
		                $variables_ext["cj"]=@$cj;
						$variables_ext["tiporeg"]=@$tipo;
						
		                $objcontenido_sistema->despliega_contenido(@$idmen,@$seccapl,@$apl,$objtemplatep->path_template,@$secc,$variables_ext,$DB_gogess);
						

?>
							<!-- /.about-box -->
						</div>
						<!-- /.col-md-4 col-sm-4 -->

						
						<!-- /.col-md-4 col-sm-4 -->

						
						<!-- /.col-md-4 col-sm-4 -->
					</div>
					<!-- /.row -->
			  </div>
				<!-- /.about-content -->
			</div>
			<!-- /.container -->
		</section>
		<!-- /#about -->

		

		<?php //include($objtemplatep->path_template."pie.php"); ?>

		




	</div>
	<!-- /#site -->

	<?php include($objtemplatep->path_template."piejs_reg.php"); ?>


</body>

</html>