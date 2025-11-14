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

if($_SESSION['ces1313777_sessid_inicio'])
{

$fie_id=$_POST["fie_id"];
$esca_campoafecta=$_POST["esca_campoafecta"];
$valor=$_POST["valor"];
$esca_campoenlace=$_POST["esca_campoenlace"];

$centro_id=$_SESSION['ces1313777_centro_id'];

$busca_listafiltro="select * from dns_categoriaespecialidad where categesp_id='".$valor."'";
$rs_lisfiltro = $DB_gogess->executec($busca_listafiltro);

$categesp_lista=$rs_lisfiltro->fields["categesp_lista"];

echo '<select class="form-control" name="'.$esca_campoafecta.'x" id="'.$esca_campoafecta.'x"  '.$rs_lcanp->fields["gridfield_extra"].' >';
echo '<option value="" >--Seleccionar--</option>';
echo $busca_profesional="select especi_id,especi_nombre from dns_especialidad where especi_id in (".$categesp_lista.") and 	especi_paraprecuenta=1";
$rs_espe = $DB_gogess->executec($busca_profesional);
if($rs_espe)
{
   while (!$rs_espe->EOF) {
   
   echo '<option value="'.$rs_espe->fields["especi_id"].'">'.$rs_espe->fields["especi_nombre"].'</option>';
   
    $rs_espe->MoveNext();
   }
}   
echo '</select>';


}
?>