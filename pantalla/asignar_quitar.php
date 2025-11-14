<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");

for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
$objformulario= new  ValidacionesFormulario();
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;

if($_POST["tipop"]==1)
{
$fecha_hoy=date("Y-m-d");
$inserta_data="insert into  app_detalletemporal (facttmp_codetemp,produ_id,dettem_fecha) values ('".$_POST["facttmp_codetempp"]."','".$_POST["produ_idp"]."','".$fecha_hoy."')";
$rs_ok = $DB_gogess->executec($inserta_data,array());
}

if($_POST["tipop"]==2)
{
$fecha_hoy=date("Y-m-d");
$eliminar_data="delete from  app_detalletemporal where  facttmp_codetemp='".$_POST["facttmp_codetempp"]."' and dettem_id='".$_POST["produ_idp"]."'";
$rs_ok = $DB_gogess->executec($eliminar_data,array());
}


?>