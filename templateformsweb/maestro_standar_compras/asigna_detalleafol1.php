<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
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

$objformulario= new  ValidacionesFormulario();
$sqltotal="";

$cdxml_id=$_POST["cdxml_id"];
$compra_nfactura=$_POST["compra_nfactura"];
$compra_id=$_POST["compra_id"];


$busca_data="select * from dns_comprasdetallexml where cdxml_id='".$cdxml_id."'";
$rs_bdata = $DB_gogess->executec($busca_data,array());

$compra_numeroproceso=$_POST["compra_numeroproceso"];

$compra_enlace=$compra_numeroproceso;
$cuadrobm_id=0;
$acfi_valorcompra=$rs_bdata->fields["cdxml_preciounitario"];
$porcefr_id='';
$porcefi_id='';
$cuecomp_descuento='';
$cuecomp_descuentodolar=$rs_bdata->fields["cdxml_descuento"];
$acfi_subtotal=$rs_bdata->fields["cdxml_totalsinimpuestos"];
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$acfi_fecharegistro=date("Y-m-d H:i:s");
$prcomp_impucodigo='2';

if($rs_bdata->fields["cdxml_iva"]>0)
{
$tarif_id='1';
}
else
{
$tarif_id='2';
}
$acfi_codigo=$rs_bdata->fields["cdxml_codigo"];
$acfi_nombre=$rs_bdata->fields["cdxml_descripcion"];
$acfi_descripcion=$rs_bdata->fields["cdxml_descripcion"];

$acfi_enlace=$usua_id.strtoupper(uniqid()).date("YmdHis");

$inserta_data="INSERT INTO dns_activosfijos ( compra_enlace, acfi_valorcompra, porcefr_id, porcefi_id, acfi_subtotal, usua_id, acfi_fecharegistro, acfi_codigo, acfi_nombre, cdxml_id,tarif_id,acfi_enlace,acfi_descripcion) VALUES
('".$compra_enlace."','".$acfi_valorcompra."','".$porcefr_id."','".$porcefi_id."','".$acfi_subtotal."','".$usua_id."','".$acfi_fecharegistro."','".$acfi_codigo."','".$acfi_nombre."','".$cdxml_id."','".$tarif_id."','".$acfi_enlace."','".$acfi_descripcion."');";

$rs_bdata = $DB_gogess->executec($inserta_data,array());
echo $inserta_data;


$busca_ac="update dns_comprasdetallexml set cdxml_asignado=1 where cdxml_id='".$cdxml_id."'";
$rs_bac = $DB_gogess->executec($busca_ac,array());

//================================
//periodo activo no olvidar




}
?>