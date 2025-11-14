<?php
header('Content-Type: text/html; charset=UTF-8');
$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

/*echo $_POST["tabla"]."<br>";
echo $_POST["campo"]."<br>";
echo $_POST["id"]."<br>";
echo $_POST["valor"]."<br>";*/

if($_SESSION['ces1313777_sessid_inicio'])
{
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$sqltotal="";

$actualiza_data="update ".$_POST["tabla"]." set ".$_POST["campo"]."='".$_POST["valor"]."' where ".$_POST["campoidtabla"]."='".$_POST["id"]."'";
$okvalor=$DB_gogess->executec($actualiza_data); 
}
?>