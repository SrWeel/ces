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

$compra_id=$_POST["compra_id"];
$compra_descripcion=$_POST["compra_descripcion"];
$compra_parainv=$_POST["compra_parainv"];

$sqltotal="";

if($compra_id>0)
{
$actualiza_data="update dns_compras set compra_parainv='".$compra_parainv."',compra_descripcion='".$compra_descripcion."' where compra_id='".$compra_id."'";
$okvalor=$DB_gogess->executec($actualiza_data); 
}


}
?>