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

//fie_id
//radio_sel
//echo $_POST["id_listavalor"]."<BR>";
//echo $_POST["enlace"]."<BR>";
//echo $_POST["valor"]."<BR>";


$objformulario= new  ValidacionesFormulario();
$datos_fields="select * from gogess_sisfield where fie_id=".$_POST["fie_id"];
$rs_fields = $DB_gogess->executec($datos_fields,array());

$sub_tabla=$rs_fields->fields["fie_tablasubgrid"];

if($sub_tabla=='cesdb_arextension.dns_epicrisisgridorgano')
{


if($_POST["valor"]=='CP')
{
$actualiza="update ".$sub_tabla." set opcorg_activo=1,tiporg_nombre='CP' where opcorg_id='".$_POST["id_listavalor"]."' and anam_enlace='".$_POST["enlace"]."'";
$rs_ac = $DB_gogess->executec($actualiza,array());
}

if($_POST["valor"]=='SP')
{
$actualiza="update ".$sub_tabla." set opcorg_activo=1,tiporg_nombre='SP',gorgano_observacion='SIN EVIDENCIA DE PATOLOGIA' where opcorg_id='".$_POST["id_listavalor"]."' and anam_enlace='".$_POST["enlace"]."'";
$rs_ac = $DB_gogess->executec($actualiza,array());
}

}
else
{


if($_POST["valor"]=='CP')
{
$actualiza="update ".$sub_tabla." set gexamfis_activo=1,tiporg_nombre='CP' where opcexa_id='".$_POST["id_listavalor"]."' and anam_enlace='".$_POST["enlace"]."'";
$rs_ac = $DB_gogess->executec($actualiza,array());
}

if($_POST["valor"]=='SP')
{
$actualiza="update ".$sub_tabla." set gexamfis_activo=1,tiporg_nombre='SP',gexamfis_observacion='SIN EVIDENCIA DE PATOLOGIA' where opcexa_id='".$_POST["id_listavalor"]."' and anam_enlace='".$_POST["enlace"]."'";
$rs_ac = $DB_gogess->executec($actualiza,array());
}


}


//echo $actualiza;
?>