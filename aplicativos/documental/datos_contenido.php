<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

include(@$director."libreria/estructura/aqualis_master.php");
for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
 if (@$table)
  {
  $objtableform->select_templateform(@$table,$DB_gogess);	
  }
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
$comillasimple="'";

//portal
$objcontenido_portal = new  contenidop();  
$ar=$_POST["pVar1"];
$objcontenido_portal->select_articulo($ar,$DB_gogess);


?>

<section id="about">
			<div class="container">
				<h2 class="section-title wow zoomIn"><?php echo $objcontenido_portal->titulo; ?></h2>
	
				<div class="about-content">
					<div class="row">
	
						<!-- /.col-md-4 col-sm-4 -->

						<div class="col-md-12 col-sm-12">
							<div class="about-box wow fadeInUp" data-wow-delay="0.4s">
								
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