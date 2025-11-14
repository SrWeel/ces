<?php
$tiempossss=44600000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//echo $_POST["cant_val"]."<br>";
//echo $_POST["produ_id"]."<br>";
//echo $_POST["enlace"]."<br>";
if($_SESSION['ces1313777_sessid_inicio'])
{

//echo $_POST["pVar1"]."<br>";

$anam_enlace=$_POST["anam_enlace"];
$les_id=$_POST["les_id"];

$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$less_fecharegistro=date("Y-m-d H:i:s");

$less_x=320;

$busca_lesiones="insert into dns_registrolesiones (les_id,anam_enlace,usua_id,less_fecharegistro,less_x) values ('".$les_id."','".$anam_enlace."','".$usua_id."','".$less_fecharegistro."','".$less_x."')"; 
$rs_lesiones = $DB_gogess->executec($busca_lesiones);


}
?>