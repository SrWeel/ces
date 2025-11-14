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

$compra_enlace=$_POST["compra_enlace"];

if($compra_enlace!='')
{
//===========================================

$lista_detalles="select planc_codigoc,porcecr_id,porceci_id  from lpin_cuentacompra where compra_enlace='".$compra_enlace."' order by cuecomp_id desc limit 1";
$rs_data = $DB_gogess->executec($lista_detalles,array());

$planc_codigoc=$rs_data->fields["planc_codigoc"];
$porcecr_id=$rs_data->fields["porcecr_id"];
$porceci_id=$rs_data->fields["porceci_id"];

$lista_detalles="select *  from lpin_cuentacompra where compra_enlace='".$compra_enlace."' order by taric_id desc";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	     $sacatari="update lpin_cuentacompra set planc_codigoc='".$planc_codigoc."',porcecr_id='".$porcecr_id."',porceci_id='".$porceci_id."' where cuecomp_id='".$rs_data->fields["cuecomp_id"]."' and compra_enlace='".$compra_enlace."'";
		// echo $sacatari."<br>";
		 $rs_d13 = $DB_gogess->executec($sacatari,array());
		
	  
	    $rs_data->MoveNext();
	  }
  }	
 
 //===========================================
}

//saca totales
//print_r($lista_valor);



}

?>