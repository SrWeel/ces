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

if($_SESSION['sessidadm1777_pichincha'])
{
$director="../../";
include ("../../cfgclases/clases.php");
$actualiza_data="update ".$_POST["tabla"]." set ".$_POST["campo"]."='".$_POST["valor"]."' where fie_id='".$_POST["id"]."'";
$okvalor=$DB_gogess->Execute($actualiza_data); 

$file = fopen("../../director_sinc/archivo_sinc".date("Y-m-d").".txt", "a");
fwrite($file, $actualiza_data.";". PHP_EOL);
fclose($file);

}
?>