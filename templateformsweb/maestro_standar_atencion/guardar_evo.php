<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=44550000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$eteneva_id=$_POST["eteneva_id"];

$lista_atencioneval="select * from dns_atencionevaluacion where eteneva_id=?";
$rs_atencioneval = $DB_gogess->executec($lista_atencioneval,array($_POST["eteneva_id"]));
$clie_id=$rs_atencioneval->fields["clie_id"];

$infevolucion_situacionactual=$_POST["infevolucion_situacionactual"];
$infevolucion_rterapeuticas=$_POST["infevolucion_rterapeuticas"];
$infevolucion_rfamiliares=$_POST["infevolucion_rfamiliares"];
$infevolucion_rescolares=$_POST["infevolucion_rescolares"];
$infevolucion_rmultidiciplinarias=$_POST["infevolucion_rmultidiciplinarias"];

$infevolucion_diagnostico=$_POST["infevolucion_diagnostico"];

$infevolucion_fechaingreso=$_POST["infevolucion_fechaingreso"];
$usua_id=$_POST["usua_id"];


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


$busca_datos="select * from faesa_informeevolucionsemestral where eteneva_id=".$_POST["eteneva_id"]."  and clie_id=".$clie_id." and usua_id=".$_POST["usua_id"];
$rs_bdatos = $DB_gogess->executec($busca_datos,array());
$actualiza_data='';

if($rs_bdatos->fields["infevolucion_id"])
{

   $actualiza_data="update faesa_informeevolucionsemestral set infevolucion_fechaingreso='".$infevolucion_fechaingreso."', infevolucion_diagnostico='".$infevolucion_diagnostico."',infevolucion_situacionactual='".$infevolucion_situacionactual."',infevolucion_rterapeuticas='".$infevolucion_rterapeuticas."',infevolucion_rfamiliares='".$infevolucion_rfamiliares."',infevolucion_rescolares='".$infevolucion_rescolares."',infevolucion_rmultidiciplinarias='".$infevolucion_rmultidiciplinarias."' where infevolucion_id=".$rs_bdatos->fields["infevolucion_id"];
   
  $rs_actdata = $DB_gogess->executec($actualiza_data,array());
   if($rs_actdata)
   {
   echo '<div style="color:#009900;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" id="msg" class="errors">Guardado con exito...</div>';
   }
   else
   {

   echo '<div style="color:#FF0000;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" id="msg" class="errors">No se puede guardar...</div>';
   }
}
else
{
 $actualiza_data="insert into faesa_informeevolucionsemestral (eteneva_id,clie_id,infevolucion_situacionactual,infevolucion_fecharegistro,usua_id,infevolucion_diagnostico,infevolucion_fechaingreso,infevolucion_rterapeuticas,infevolucion_rfamiliares,infevolucion_rescolares,infevolucion_rmultidiciplinarias) values ('".$eteneva_id."','".$clie_id."','".$infevolucion_situacionactual."','".date("Y-m-d")."','".$usua_id."','".$infevolucion_diagnostico."','".$infevolucion_fechaingreso."','".$infevolucion_rterapeuticas."','".$infevolucion_rfamiliares."','".$infevolucion_rescolares."','".$infevolucion_rmultidiciplinarias."')";
  $rs_actdata = $DB_gogess->executec($actualiza_data,array());
  if($rs_actdata)
  {
  echo '<div style="color:#009900;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" id="msg" class="errors">Guardado con exito...</div>';
   }
   else
   {

   echo '<div style="color:#FF0000;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" id="msg" class="errors">No se puede guardar...</div>';
   }
}
?>
 