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
$less_id=$_POST["less_id"];



echo $borra_lesiones="delete from dns_registrolesioneshospi where less_id='".$less_id."' and anam_enlace='".$anam_enlace."'"; 
$rs_bl = $DB_gogess->executec($borra_lesiones);


}
?>