<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();

$prcomp_id=$_POST["prcomp_id"];
$unid_id=$_POST["unid_id"];
$cuadrobm_id=$_POST["cuadrobm_id"];

$centrorecibe_cantidad=$_POST["centrorecibe_cantidad"];
$moviin_preciocontable=$_POST["moviin_preciocontable"];
$moviin_total=$_POST["moviin_total"];
$centrorecibe_observacion=$_POST["centrorecibe_observacion"];

$ac_data="update lpin_productocompra set prcomp_observacion='".$centrorecibe_observacion."',unid_id='".$unid_id."',cuadrobm_id='".$cuadrobm_id."' where prcomp_id='".$prcomp_id."'";
$rs_data = $DB_gogess->executec($ac_data,array());



?>