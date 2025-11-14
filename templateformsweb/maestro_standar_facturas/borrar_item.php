<?php
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


 $borradato="delete from beko_documentodetalle where docdet_id=".$_POST["idenlace"];
 $okborrado=$DB_gogess->executec($borradato,array());
 
$file = fopen("logdata/borrado".date("Y-m-d")."_".@$_SESSION['datafrank1109_centro_id'].".txt", "a+");
fwrite($file, $_SESSION['datafrank1109_sessid_inicio']."-->".$borradato."-->".date("Y-m-d H:i:s"). PHP_EOL);
fclose($file);


?>