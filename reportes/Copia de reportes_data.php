<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{

$valor_busca=$_GET["idsec"];

$cuadro_valor=array();
$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");

for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
$objformulario= new  ValidacionesFormulario();
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;

$busca_informe="select * from faesa_reporte where faereport_seccion='".$_GET["seccion"]."'";
$rs_binforme = $DB_gogess->executec($busca_informe,array());


$busca_dtabla="select * from gogess_sistable where tab_name='".$rs_binforme->fields["faereport_tabla"]."'";
$rs_dtabla = $DB_gogess->executec($busca_dtabla,array());

$table=$rs_dtabla->fields["tab_name"];  
$campo_primariodata=$rs_dtabla->fields["tab_campoprimario"];  

$busca_sihaydata="select * from ".$table." where ".$rs_binforme->fields["faereport_campoenlace"]."='".$valor_busca."'";
$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array());


$psic_id_valor=0;
$psic_id_valor=@$rs_sihaydata->fields[$campo_primariodata];

include(@$director."libreria/estructura/aqualis_master.php");
for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {

  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");

 } 

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

 if ($table)
  {

  $objtableform->select_templateform(@$table,$DB_gogess);	

  }

$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
$comillasimple="'";
  

	$em_id_val=0;	
	$csearch=0;	
	$variableb=0;
			if($psic_id_valor==0)
				  {

					 $variableb=0;

				  }
				  else
				  {
					 $variableb=$psic_id_valor;
					 $_REQUEST["opcion_".$table]="buscar";
			         $csearch=$psic_id_valor;				 
				  }

		//echo $csearch; 

		 $comillasimple="'";
	
		//$template_reemplazo='templateformsweb_print/maestro_standar_print/';
		
	
  		$template_reemplazo='templateformsweb_print/maestro_standar_informeprint/';
		

?>	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Reporte</title>

<link type="text/css" href="../templates/page/css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet" />	
<script src="../templates/page/menu/js/1.11.2.jquery.min.js"></script>
<script type="text/javascript" src="../templates/page/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="../templates/page/js/jquery.validate.js"></script>
<script type="text/javascript" src="../templates/page/js/jquery.form.js"></script>
<style type="text/css">
<!--

.titulo_suscripcion {font-size: 13px; font-family: Arial, Verdana; font-weight: bold; }
.css_titulo{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
}
.css_texto{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;

}
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}

-->

</style>



</head>



<body>
<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">

  <div align="center"><img src="../images/informe_logo.jpg" width="161" height="70" />
  </div>
  <div align="right" >
  <?php
  $nciudad='';
  $nciudad=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id =",$_SESSION['ces1313777_centro_id'],$DB_gogess);
  echo $nciudad.", ";
  echo $objvarios->fechaCastellano(date("Y-m-d"));
   ?>
  </div>
  <br />
  <center> 
  <B> <?php echo utf8_encode($rs_dtabla->fields["tab_title"]); ?> </B> </center><br /><br />
  
  
<div class="css_titulo" >I. DATOS PERSONALES </div>

<?php		
		include("tablas_print.php");
?>	
</div>
</body>
</html>

<?php

}
else
{
 echo '<div style="font-family:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000">Sesi&oacute;n de usuario ha terminado porfavor de clic en F5 para continuar...</div>';
 
 ?>
<script type="text/javascript">
<!--
    location.href = "../index.php";
 //  End -->
</script>
 <?php
}	

?>