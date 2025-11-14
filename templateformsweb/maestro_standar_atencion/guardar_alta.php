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

$atenc_id=$_POST["atenc_id"];
$clie_id=$_POST["clie_id"];
$infoalta_avance=$_POST["val_avances"];
$infoalta_concluciones=$_POST["val_concluciones"];
$infoalta_recomendaciones=$_POST["val_recomendaciones"];
$infoalta_diagnostico=$_POST["val_diagnostico"];

$infoalta_rterapeuticas=$_POST["infoalta_rterapeuticas"];
$infoalta_rfamiliares=$_POST["infoalta_rfamiliares"];
$infoalta_rescolares=$_POST["infoalta_rescolares"];
$infoalta_rmultidiciplinarias=$_POST["infoalta_rmultidiciplinarias"];
$infoalta_fechaalta=$_POST["infoalta_fechaalta"];
$infoalta_fechaevaluacioninicial=$_POST["infoalta_fechaevaluacioninicial"];
$infoalta_fechainiciopt=$_POST["infoalta_fechainiciopt"];

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


$busca_datos="select * from faesa_informealta where atenc_id=".$_POST["atenc_id"]."  and clie_id=".$_POST["clie_id"]." and usua_id=".$usua_id;
$rs_bdatos = $DB_gogess->executec($busca_datos,array());
$actualiza_data='';

if($rs_bdatos->fields["infoalta_id"])
{

   $actualiza_data="update faesa_informealta set infoalta_fechainiciopt='".$infoalta_fechainiciopt."',infoalta_fechaevaluacioninicial='".$infoalta_fechaevaluacioninicial."',infoalta_rterapeuticas='".$infoalta_rterapeuticas."',infoalta_rfamiliares='".$infoalta_rfamiliares."',infoalta_rescolares='".$infoalta_rescolares."',infoalta_rmultidiciplinarias='".$infoalta_rmultidiciplinarias."',infoalta_diagnostico='".$infoalta_diagnostico."',infoalta_avance='".$infoalta_avance."',infoalta_concluciones='".$infoalta_concluciones."',infoalta_recomendaciones='".$infoalta_recomendaciones."' where infoalta_id=".$rs_bdatos->fields["infoalta_id"];
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


  $actualiza_data="insert into faesa_informealta (atenc_id,clie_id,infoalta_avance,infoalta_concluciones,infoalta_recomendaciones,infoalta_fecharegistro,usua_id,infoalta_diagnostico,infoalta_rterapeuticas,infoalta_rfamiliares,infoalta_rescolares,infoalta_rmultidiciplinarias,infoalta_fechaalta,infoalta_fechaevaluacioninicial,infoalta_fechainiciopt) values ('".$atenc_id."','".$clie_id."','".$infoalta_avance."','".$infoalta_concluciones."','".$infoalta_recomendaciones."','".date("Y-m-d")."','".$usua_id."','".$infoalta_diagnostico."','".$infoalta_rterapeuticas."','".$infoalta_rfamiliares."','".$infoalta_rescolares."','".$infoalta_rmultidiciplinarias."','".$infoalta_fechaalta."','".$infoalta_fechaevaluacioninicial."','".$infoalta_fechainiciopt."')";
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


$actualiza_alta="update faesa_informealta set infoalta_fechaalta='".$infoalta_fechaalta."' where atenc_id=".$_POST["atenc_id"]."  and clie_id=".$_POST["clie_id"];
$rs_actfecha = $DB_gogess->executec($actualiza_alta,array());


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
 