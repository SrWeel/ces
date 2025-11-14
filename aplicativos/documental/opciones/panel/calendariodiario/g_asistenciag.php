<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();



$asigm_id=$_POST["asigm_id"];
$clie_id=$_POST["clie_id"];
$centro_id=$_POST["centro_id"];
$usua_id=$_POST["usua_id"];
$asig_fecha=$_POST["asig_fecha"];
$obs_asistencia=$_POST["obs_asistencia"];

$asig_fecharegisto=date("Y-m-d H:i:s");
$usua_id=$_SESSION['ces1313777_sessid_inicio'];



$busca_asistencia="select * from cereni_asistenciagrupo where asigm_id='".$asigm_id."' and clie_id='".$clie_id."' and centro_id='".$centro_id."' and asig_fecha='".$asig_fecha."'";
$rs_bcasietg = $DB_gogess->executec($busca_asistencia,array());

if($rs_bcasietg->fields["asig_id"])
{

$actualiza_valor="update cereni_asistenciagrupo set cereni_asistenciagrupo='".$obs_asistencia."' where asig_id='".$rs_bcasietg->fields["asig_id"]."'";
$rs_acvalor = $DB_gogess->executec($actualiza_valor,array());

}
else
{


$inserta_data="insert into cereni_asistenciagrupo (asigm_id,clie_id,centro_id,asig_fecha,asig_obsnoasiste,asig_fecharegisto,usua_id) values ('".$asigm_id."','".$clie_id."','".$centro_id."','".$asig_fecha."','".$obs_asistencia."','".$asig_fecharegisto."','".$usua_id."')";
$rs_acvalor = $DB_gogess->executec($inserta_data,array());
  
  

}





}

?>	  