<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();


$lista_turnos="select gridtur_id from cesdb_arextension.dns_gridturnos where especi_id=".$_POST["especi_id"]." and gridtur_fecha='".date("Y-m-d")."' and centro_id=".$_POST["centro_id"]." and gridtur_estado='' limit 1";

$rs_turnos = $DB_gogess->executec($lista_turnos,array());
if(@$rs_turnos->fields["gridtur_id"]>0)
{
echo '<div align="right" onclick="ver_turnos()" style="cursor:pointer" ><span style="color:#FF0000; font-size:12px; font-weight:bold"><img src="images/notificacionicon.png" />Alerta!!! Tiene turnos para hoy</span></div>';
	
}




}
?>
