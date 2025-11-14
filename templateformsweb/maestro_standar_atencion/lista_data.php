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

echo '<select class="form-control" name="'.$esca_campoafecta.'x" id="'.$esca_campoafecta.'x"  '.$rs_lcanp->fields["gridfield_extra"].' >';
echo '<option value="" >--Seleccionar--</option>';
$busca_profesional="select distinct app_usuario.usua_id,usua_nombre,usua_apellido from app_usuario inner join dns_gridfuncionprofesional on app_usuario.usua_enlace=dns_gridfuncionprofesional.usua_enlace inner join cesdb_arextension.dns_profesion on dns_gridfuncionprofesional.prof_id=cesdb_arextension.dns_profesion.prof_id where especienc_id='".$valor."' and app_usuario.centro_id='".$centro_id."'";
$rs_espe = $DB_gogess->executec($busca_profesional);
if($rs_espe)
{
   while (!$rs_espe->EOF) {
   
   echo '<option value="'.$rs_espe->fields["usua_id"].'">'.$rs_espe->fields["usua_nombre"].' '.$rs_espe->fields["usua_apellido"].'</option>';
   
    $rs_espe->MoveNext();
   }
}   
echo '</select>';


}
?>