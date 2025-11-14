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

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$precu_id=$_POST["precu_id"];
$clie_id=$_POST["clie_id"];
$atenc_id=$_POST["atenc_id"];
$prod_id=$_POST["prod_id"];
$cantidad=$_POST["cantidad"];

$busca_medi="select * from efacsistema_producto where prod_id='".$prod_id."'";
$rs_medi = $DB_gogess->executec($busca_medi,array());


//1= MEDICAMENTOS

//2= INSUMOS

$detapre_tipo=3;
$mnupan_id=0;
$detapre_codigop=$rs_medi->fields["prod_codigo"];
$detapre_detalle=$rs_medi->fields["prod_nombre"];
$detapre_cantidad=$cantidad;
$detapre_precio=$rs_medi->fields["prod_precio"];
$detapre_fecharegistro=date("Y-m-d H:i:s");
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$centro_id=$_SESSION['ces1313777_centro_id'];
$detapre_codigoform=0;
$detapre_idgrid=0;
$table='';
$bode_id=$_POST["bode_id"];
$detapre_origen='DESCARGO APP';

$inserta_datadis="INSERT INTO dns_detalleprecuenta (precu_id, clie_id, mnupan_id, detapre_tipo, detapre_codigop, detapre_detalle, detapre_cantidad, detapre_precio, detapre_fecharegistro, usua_id, centro_id, atenc_id, detapre_codigoform,detapre_idgrid,detapre_table,bodega_id,detapre_origen) VALUES ('".$precu_id."','".$clie_id."','".$mnupan_id."','".$detapre_tipo."','".$detapre_codigop."','".$detapre_detalle."','".$detapre_cantidad."','".$detapre_precio."','".$detapre_fecharegistro."','".$usua_id."','".$centro_id."','".$atenc_id."','".$detapre_codigoform."','".$detapre_idgrid."','".$table."','".$bode_id."','".$detapre_origen."');";
$rs_insdatadis = $DB_gogess->executec($inserta_datadis,array());

?>

