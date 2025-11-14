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

//busca horario

$ndia=0;
$ndia=date('N', strtotime($fecha_inicioval));

//echo $ndia;

$bandera_dia='0';
$bandera_hora='0';
$busca_h="select * from clinica_horarios where usua_id='".$usua_idvalx."' and dia_id='".$ndia."'";
$rs_databh = $DB_gogess->executec($busca_h,array());
 if($rs_databh)
 {
	  while (!$rs_databh->EOF) {
	  
	   $dia_id=$rs_databh->fields["dia_id"];
	   
	   if($dia_id==$ndia)
	   {
	     $bandera_dia=1;
		 
		 //busca si esta dentro de la hora
		 
		 if($hora>=$rs_databh->fields["horario_hora"] and $hora<=$rs_databh->fields["horario_horafin"])
		 {
		   $bandera_hora=1;
		 }
		 
		 //busca si esta dentro de la hora
		 
	   }
	   
	  
	  
	    $rs_databh->MoveNext();
	  }
 }	  

//echo $bandera_dia;
//echo $bandera_hora;

$totalizz=$bandera_dia*$bandera_hora;
$mensajedf='';

if($totalizz==0)
{
    $resultado_bu=0;
	$mensajedf='Horario no Permitido';
}
//busca horario

if($resultado_bu==0)
{
 echo '<table border="0" cellpadding="0" cellspacing="0"><tr><td onclick="ver_detallesrestriccion('.$ord.')" style="cursor:pointer" ><img src="alertaterapia.png" width="30" height="30" />'.$mensajedf.'</td></tr></table>';
 echo '<input name="valida_terapia'.$ord.'" type="hidden" id="valida_terapia'.$ord.'" value="1" />';
}
else
{
 echo '';
 echo '<input name="valida_terapia'.$ord.'" type="hidden" id="valida_terapia'.$ord.'" value="0" />';
}

}
?>
