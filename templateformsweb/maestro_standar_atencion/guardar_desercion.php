<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=140000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$atenc_id=$_POST["atenc_id"];
$clie_id=$_POST["clie_id"];
$infodeser_situacionactual=$_POST["val_situacion"];
$infodeser_observaciones=$_POST["val_observaciones"];
$infodeser_diagnostico=$_POST["val_diagnostico"];
$infodeser_fechadesercion=$_POST["infodeser_fechadesercion"];

$infodeser_fechaevaluacioninicial=$_POST["infodeser_fechaevaluacioninicial"];
$infodeser_fechainiciopt=$_POST["infodeser_fechainiciopt"];
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


$busca_datos="select * from faesa_informedesercion where atenc_id=".$_POST["atenc_id"]."  and clie_id=".$_POST["clie_id"]." and usua_id=".$usua_id;
$rs_bdatos = $DB_gogess->executec($busca_datos,array());
$actualiza_data='';

if($rs_bdatos->fields["infodeser_id"])
{

   $actualiza_data="update faesa_informedesercion set infodeser_fechainiciopt='".$infodeser_fechainiciopt."',infodeser_fechaevaluacioninicial='".$infodeser_fechaevaluacioninicial."',infodeser_fechadesercion='".$infodeser_fechadesercion."',infodeser_diagnostico='".$infodeser_diagnostico."',infodeser_situacionactual='".$infodeser_situacionactual."',infodeser_observaciones='".$infodeser_observaciones."' where infodeser_id=".$rs_bdatos->fields["infodeser_id"];
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
   $actualiza_data="insert into faesa_informedesercion (atenc_id,clie_id,infodeser_situacionactual,infodeser_observaciones,infodeser_fecharegistro,usua_id,infodeser_diagnostico,infodeser_fechadesercion,infodeser_fechaevaluacioninicial,infodeser_fechainiciopt) values ('".$atenc_id."','".$clie_id."','".$infodeser_situacionactual."','".$infodeser_observaciones."','".date("Y-m-d")."','".$usua_id."','".$infodeser_diagnostico."','".$infodeser_fechadesercion."','".$infodeser_fechaevaluacioninicial."','".$infodeser_fechainiciopt."')";
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

//$actualiza_alta="update faesa_informedesercion set infodeser_fechadesercion='".$infodeser_fechadesercion."' where atenc_id=".$_POST["atenc_id"]."  and clie_id=".$_POST["clie_id"];
//$rs_actfecha = $DB_gogess->executec($actualiza_alta,array());
?>
 <?php

if(!(@$_SESSION['ces1313777_sessid_inicio']))
{
//$varable_enviafunc=base64_encode("desplegar_grid_atencion();");
$varable_enviafunc='';
//enviar
echo '
<script type="text/javascript">
<!--
abrir_standar("aplicativos/documental/activar_sesion.php","Activar_Sesi&oacute;n","divBody_acsession","divDialog_acsession",400,400,"'.$varable_enviafunc.'",0,0,0,0,0,0);
//  End -->
</script>

<div id="divBody_acsession"></div>
';
}

?>
 