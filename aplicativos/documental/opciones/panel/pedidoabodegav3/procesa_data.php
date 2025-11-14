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

$centrob_id=$_POST["centrob_id"];
$precu_id=$_POST["precu_id"];

echo $centrob_id."<br>";
echo $precu_id;


INSERT INTO `dns_egresocentros` (`egrec_id`, `egrec_ncomprobante`, `egrec_nmemo`, `emp_id`, `centro_id`, `centrod_id`, `egrec_representante`, `egrec_fecha`, `egrec_responsableentrega`, `egrec_grado`, `egrec_cedula`, `egrec_funcion`, `egrec_personalrecibe`, `egrec_nombrerecibe`, `egrec_cedularecibe`, `usua_id`, `egrec_fecharegistro`, `usuapr_id`, `egrec_procesado`, `egrec_fechaprocesa`, `egrec_anulado`, `egrec_fechaanulado`, `egrec_usanula`, `usuareci_id`, `egrec_recibido`, `egrec_fecharecibe`, `tipom_id`, `tipomov_id`, `destv_id`, `egrec_tipo`, `egrec_motivo`, `egrec_otrosdestino`,precuped_id) VALUES
(2454, '', 'INSUMOS/MEDICINA', 1, 55, 14, 'ERICK LIMONES', '2023-10-01', 'MALMEIDA', '', '1205564253', '', '', '', '', 284, '2023-10-01 14:34:43', 284, 1, '2023-10-01 14:36:53', 0, '0000-00-00 00:00:00', 0, 372, 1, '2023-10-01 14:38:15', 2, 5, 0, 0, '', '');


?>