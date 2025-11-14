<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=44400000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
if(@$_SESSION['ces1313777_sessid_inicio'])
{


$clie_id=$_POST["clie_id"];
$emp_id=$_POST["emp_id"];
$centro_id=$_POST["centro_id"];
$tiposerv_id='2';
$clie_rucci=$_POST["clie_rucci"];

$busca_atencion="select * from dns_atencion where clie_id='".$clie_id."'";
$rs_atencion = $DB_gogess->executec($busca_atencion,array());

if($rs_atencion->fields["atenc_id"]>0)
{
 echo "...";
}
else
{

$valoralet=mt_rand(1,500);
$aletorioid='01'.$clie_id.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;

$fecha_hoy=date("Y-m-d H:i:s");

$atenc_hc=$clie_rucci."-1";
$tiposerv_id=2;
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$atenc_fecharegistro=$fecha_hoy;
$esept_id=0;
$atenc_condiciondeingreso='';
$atenc_fechaingreso=$fecha_hoy;
$atenc_fechasalida=$fecha_hoy;
$atenc_condiciondeegreso='VIVO';
$atenc_observacion='';

$clie_ci=$clie_rucci;
$atenc_referencia='';
$atenc_archivo='';
$atenc_enlace=$aletorioid;


$insert_atencion="insert into dns_atencion (centro_id,clie_id,atenc_hc,tiposerv_id,usua_id,atenc_fecharegistro,esept_id,atenc_condiciondeingreso,atenc_fechaingreso,atenc_fechasalida,atenc_condiciondeegreso,atenc_observacion,emp_id,clie_ci,atenc_referencia,atenc_archivo,atenc_enlace) values ('".$centro_id."','".$clie_id."','".$atenc_hc."','".$tiposerv_id."','".$usua_id."','".$atenc_fecharegistro."','".$esept_id."','".$atenc_condiciondeingreso."','".$atenc_fechaingreso."','".$atenc_fechasalida."','".$atenc_condiciondeegreso."','".$atenc_observacion."','".$emp_id."','".$clie_ci."','".$atenc_referencia."','".$atenc_archivo."','".$atenc_enlace."')";

$rs_iatencion = $DB_gogess->executec($insert_atencion,array());


}



}
?>