<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();

$cuadrobm_codigoatc='';
$cuadrobm_nombredispositivo='';
$cuadrobm_preciodispositivo='';
$plantra_valorplanillax=0;
$calcula_por=0;
$calcula_iva=0;

$busca_existe="delete from beko_mhdetallefactura where mhdetfac_id in (".$_POST["grupo"]."0) and  doccab_id='".$_POST["doccab_id"]."'";	  
	  //echo $busca_existe."<br>";
	  $rs_bexiste = $DB_gogess->executec($busca_existe,array());


//echo  $_POST["odonto_enlace"];

}
?>