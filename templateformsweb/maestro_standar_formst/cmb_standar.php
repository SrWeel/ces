<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=14000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

if($_SESSION['ces1313777_sessid_emp_id'])
{

$objformulario= new  ValidacionesFormulario();

$fie_id=$_POST["fie_id"];
$obtine_data="select * from gogess_sisfield where fie_id='".$fie_id."'";
$rs_obtdata = $DB_gogess->executec($obtine_data,array());

$nombre_campo=$rs_obtdata->fields["fie_name"];
$fie_styleobj=$rs_obtdata->fields["fie_styleobj"];
$fie_attrib=$rs_obtdata->fields["fie_attrib"];

$fie_tabledb=$rs_obtdata->fields["fie_tabledb"];
$fie_datadb=$rs_obtdata->fields["fie_datadb"];
$fie_sqlorder=$rs_obtdata->fields["fie_sqlorder"];

echo '<select name="'.$nombre_campo.'" id="'.$nombre_campo.'" class="'.$fie_styleobj.'" '.$fie_attrib.'>';
echo '<option value="">---Seleccionar--</option>';
$objformulario->fill_cmb($fie_tabledb,$fie_datadb,'',$fie_sqlorder,$DB_gogess);	
echo '</select>';


}
?>