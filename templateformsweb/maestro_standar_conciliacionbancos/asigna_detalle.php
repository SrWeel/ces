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
$prcomp_cantidad=$rs_bdata->fields["cdxml_cantidad"];
$unid_id='1';
$prcomp_preciounitario=$rs_bdata->fields["cdxml_preciounitario"];
$porcer_id='';
$porcei_id='';
$prcomp_descuento='';
$prcomp_descuentodolar=$rs_bdata->fields["cdxml_descuento"];
$prcomp_subtotal=$rs_bdata->fields["cdxml_totalsinimpuestos"];
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$prcomp_fecharegistro=date("Y-m-d H:i:s");
$prcomp_impucodigo='2';

if($rs_bdata->fields["cdxml_iva"]>0)
{
$prcomp_taricodigo='2';
}
else
{
$prcomp_taricodigo='0';
}
$prcomp_codigoext=$rs_bdata->fields["cdxml_codigo"];
$prcomp_descripext=$rs_bdata->fields["cdxml_descripcion"];


$inserta_data="INSERT INTO lpin_productocompra ( compra_enlace, cuadrobm_id, prcomp_cantidad, unid_id, prcomp_preciounitario, porcer_id, porcei_id, prcomp_descuento, prcomp_descuentodolar, prcomp_subtotal, usua_id, prcomp_fecharegistro, prcomp_impucodigo, prcomp_taricodigo, prcomp_codigoext, prcomp_descripext, cdxml_id) VALUES
('".$compra_enlace."','".$cuadrobm_id."','".$prcomp_cantidad."','".$unid_id."','".$prcomp_preciounitario."','".$porcer_id."','".$porcei_id."','".$prcomp_descuento."','".$prcomp_descuentodolar."','".$prcomp_subtotal."','".$usua_id."','".$prcomp_fecharegistro."','".$prcomp_impucodigo."','".$prcomp_taricodigo."','".$prcomp_codigoext."','".$prcomp_descripext."','".$cdxml_id."');";

$rs_bdata = $DB_gogess->executec($inserta_data,array());
//echo $inserta_data;


$busca_ac="update dns_comprasdetallexml set cdxml_asignado=1 where cdxml_id='".$cdxml_id."'";
$rs_bac = $DB_gogess->executec($busca_ac,array());

//================================
//periodo activo no olvidar

$per_activo=0;
$per_activo=$objformulario->replace_cmb("dns_periodobodega","perio_activo,perio_anio"," where perio_activo=",1,$DB_gogess);


$cuadrobm_id=0;
$centro_id=55;
$tipom_id=1;
$tipomov_id=17;
$moviin_cantidadcontable=$prcomp_cantidad;
$centrorecibe_documento=$compra_nfactura;
$centrorecibe_bodegamatriz=1;
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$moviin_fecharegistro=$prcomp_fecharegistro;
$unid_id='1';
$moviin_totalenunidadconsumo=$prcomp_cantidad;
$moviin_presentacioncomercial=$prcomp_descripext;
$moviin_preciocontable=$prcomp_preciounitario;
$moviin_total=$prcomp_subtotal;
$perioac_id=$per_activo;
$moviin_codigoproveedor='';
$moviin_codeext=$prcomp_codigoext;
$moviin_descext=$prcomp_descripext;

$inserta_tmpcompra="INSERT INTO dns_temporalovimientoinventario ( cuadrobm_id, centro_id, tipom_id, tipomov_id, moviin_cantidadcontable, centrorecibe_documento, centrorecibe_bodegamatriz, usua_id, moviin_fecharegistro, unid_id, moviin_totalenunidadconsumo, moviin_presentacioncomercial, moviin_preciocontable, moviin_total, compra_id, perioac_id, moviin_codigoproveedor,cdxml_id,moviin_codeext,moviin_descext) VALUES ('".$cuadrobm_id."','".$centro_id."','".$tipom_id."','".$tipomov_id."','".$moviin_cantidadcontable."','".$centrorecibe_documento."','".$centrorecibe_bodegamatriz."','".$usua_id."','".$moviin_fecharegistro."','".$unid_id."','".$moviin_totalenunidadconsumo."','".$moviin_presentacioncomercial."','".$moviin_preciocontable."','".$moviin_total."','".$compra_id."','".$perioac_id."','".$moviin_codigoproveedor."','".$cdxml_id."','".$moviin_codeext."','".$moviin_descext."');";

$rs_tmpcompra = $DB_gogess->executec($inserta_tmpcompra,array());


}
?>