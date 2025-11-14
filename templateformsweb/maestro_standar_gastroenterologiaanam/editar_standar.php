<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4440000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$datos_fields="select * from gogess_sisfield where fie_id=".$_POST["fie_id"];
$rs_fields = $DB_gogess->executec($datos_fields,array());

$tabla_gridvalor=$rs_fields->fields["fie_tablasubgrid"];;
$campo_id=$rs_fields->fields["fie_tablasubcampoid"];
$campos_dataedit=explode(",",$rs_fields->fields["fie_tablasubgridcampos"]);

$busca_lista="select * from ".$tabla_gridvalor." where ".$campo_id."=".$_POST[$campo_id."x"];
$rs_obtiene = $DB_gogess->executec($busca_lista,array());

echo '<input name="'.$campo_id.'xval" type="hidden" id="'.$campo_id.'xval" value="'.$rs_obtiene->fields[$campo_id].'" />';

for($i=0;$i<count($campos_dataedit);$i++)
	 {
		 echo '<input name="'.$campos_dataedit[$i].'xval" type="hidden" id="'.$campos_dataedit[$i].'xval" value="'.$rs_obtiene->fields[$campos_dataedit[$i]].'" />';
	 }

?>