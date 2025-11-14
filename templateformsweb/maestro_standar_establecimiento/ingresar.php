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

include(@$director."libreria/estructura/aqualis_master.php");
for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
 if (@$table)
  {
  $objtableform->select_templateform(@$table,$DB_gogess);	
  }
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;

 $lista_detalle="select * from app_facturatemporal where facttmp_estado=0 and clie_id=".$_POST["clie_id"]; 
 $rs_detalle = $DB_gogess->executec($lista_detalle,array());
 
 if($rs_detalle->fields["facttmp_id"])
 {
  
  echo "Cliente esta siendo atendido...";
 
 }
 else
 {
 
 $creando_ingreso="";
 
 
 }

?>