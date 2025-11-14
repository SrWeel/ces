<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

//echo $_POST["fecha_inicioval"];

//echo ;
$clie_id=$_POST["clie_id"];
$usua_idvalx=$_POST["usua_idvalx"];
$fecha_inicioval=$_POST["fecha_inicioval"];
$hora=$_POST["hora"];
$ord=$_POST["ord"];
$quiro_id=$_POST["quiro_id"];

//echo $clie_id."<br>";
//echo $usua_idvalx."<br>";
//echo $fecha_inicioval."<br>";
//echo $hora."<br>";

$restriccio1=1;
$restriccio2=1;

//verifica que el paciente no este en otracita a esa hora
$busca_existepaciente="select * from faesa_terapiasregistro where terap_cancelado=0 and clie_id='".$clie_id."' and terap_fecha='".$fecha_inicioval."' and terap_hora='".$hora."'";
$rs_okbuscapaciente = $DB_gogess->executec($busca_existepaciente,array());
if($rs_okbuscapaciente->fields["terap_id"]>0)
{
  $restriccio1=0;
}
//verifica que el paciente no este en otracita a esa hora

//busca si el doctor ya esta a esa hora en otra cita
$busca_existemedico="select * from faesa_terapiasregistro where terap_cancelado=0 and usua_id='".$usua_idvalx."' and terap_fecha='".$fecha_inicioval."' and terap_hora='".$hora."'";
$rs_okbuscamedico = $DB_gogess->executec($busca_existemedico,array());
if($rs_okbuscamedico->fields["terap_id"]>0)
{
  $restriccio2=0;
}
//busca si el doctor ya esta a esa hora en otra cita

$resultado_bu=0;
$resultado_bu=$restriccio1*$restriccio2;


if($quiro_id>0)
{

$restriccio3=1;
//busca quirofano ocupado 
$busca_existepaciente="select * from faesa_terapiasregistro where terap_cancelado=0 and quiro_id='".$quiro_id."' and terap_fecha='".$fecha_inicioval."' and terap_hora='".$hora."'";
$rs_okbuscapaciente = $DB_gogess->executec($busca_existepaciente,array());
if($rs_okbuscamedico->fields["terap_id"]>0)
{
  $restriccio3=0;
}
//busca quirofano ocupado
$resultado_bu=$restriccio3*$resultado_bu;

}



if($resultado_bu==0)
{
 echo '<table border="0" cellpadding="0" cellspacing="0"><tr><td onclick="ver_detallesrestriccion('.$ord.')" style="cursor:pointer" ><img src="alertaterapia.png" width="30" height="30" /></td></tr></table>';
 echo '<input name="valida_terapia'.$ord.'" type="hidden" id="valida_terapia'.$ord.'" value="1" />';
}
else
{
 echo '';
 echo '<input name="valida_terapia'.$ord.'" type="hidden" id="valida_terapia'.$ord.'" value="0" />';
}

}
?>
