<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$despachar_data="update ".$_POST["tabla"]." set plantra_despachado='' where plantra_id='".$_POST["plantra_id"]."';";
$rs_ddata= $DB_gogess->executec($despachar_data,array());

if($rs_ddata)
{
  $quitar_stock="delete from dns_stockactual where stock_tabla='".$_POST["tabla"]."' and stock_idtbla='".$_POST["plantra_id"]."'";
  $rs_qst= $DB_gogess->executec($quitar_stock,array());

}

?>