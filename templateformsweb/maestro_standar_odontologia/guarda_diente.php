<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();


$clie_id=$_POST["clie_id"];
$campoodo_id=$_POST["campoodo_id"];
$odonto_enlace=$_POST["odonto_enlace"];
$odopie_id=$_POST["odopie_id"];
$odonto_valor=$_POST["odonto_valor"];

$busca_data="select * from dns_odontograma where clie_id='".$clie_id."' and campoodo_id='".$campoodo_id."' and odonto_enlace='".$odonto_enlace."' and odopie_id='".$odopie_id."' and odonto_posicion=''";
$rs_datad = $DB_gogess->executec($busca_data,array());

if($rs_datad->fields["odonto_id"]>0)
{
	$actualiza_campo="update dns_odontograma set odonto_valor='".$odonto_valor."' where odonto_id='".$rs_datad->fields["odonto_id"]."'";
	
	$rs_aci = $DB_gogess->executec($actualiza_campo,array());
}
else
{
	$inserta_campo="insert into dns_odontograma(clie_id,campoodo_id,odonto_enlace,odopie_id,odonto_valor,odonto_fecharegistro) values ('".$clie_id."','".$campoodo_id."','".$odonto_enlace."','".$odopie_id."','".$odonto_valor."','".date("Y-m-d")."')";
	
	$rs_aci = $DB_gogess->executec($inserta_campo,array());
}



?>