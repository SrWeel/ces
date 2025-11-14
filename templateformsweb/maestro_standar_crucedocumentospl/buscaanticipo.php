<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=44400000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

if($_SESSION['ces1313777_sessid_inicio'])
{

$doccabcp_idx=$_POST["cruant_anticipox"];

$lista_valor=array();
$anti_fechaemision='';

$lista_detalles="select * from app_anticipos_vista where anti_id='".$doccabcp_idx."'";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	    	
		$anti_fechaemision=$rs_data->fields["anti_fechaemision"];
		
		//saca valor del anticipo		
		//$lista_pago="select sum(movanti_monto) as anticipototal from lpin_movanticipos where anti_enlace='".$rs_data->fields["anti_enlace"]."'";	
		//rs_pagol = $DB_gogess->executec($lista_pago,array());
			
		//saca valor del anticpo		
		$anticipototal=$rs_data->fields["saldo"];
		
	     
	    $rs_data->MoveNext();
	  }
  }	  



?>

<script language="javascript">
<!--


$('#cruant_fechaemisionx').val('<?php echo $anti_fechaemision; ?>');
$('#cruant_valorx').val('<?php echo $anticipototal; ?>');
$('#cruant_valorpagox').val('<?php echo $anticipototal; ?>');

//-->
</script>

<?php

}

?>