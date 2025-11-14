<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();

$cantidad=$_POST["cantidad"];
$doccab_id=$_POST["doccab_id"];
$proveeve_id=$_POST["proveeve_id"];
$cuadrobm_id=$_POST["cuadrobm_id"];

$valor_precio='cuadrobm_pvp';
$cantidad_nueva=$cantidad;
$moviin_iddes=0;

$busca_dataproducto="select '".$doccab_id."' as doccab_id,cuadrobm_codigoatc,cuadrobm_nombrecomercial,'".$cantidad_nueva."' as mhdetfac_cantidad,round((".$valor_precio."),2) as ".$valor_precio.",dns_cuadrobasicomedicamentos.impu_codigo,dns_cuadrobasicomedicamentos.tari_codigo,tari_valor,round((((".$cantidad_nueva."*(".$valor_precio."))*tari_valor)/100),2) as mhdetfac_valorimpuesto,(".$cantidad_nueva."*round((".$valor_precio."),2)) as mhdetfac_total,".$_SESSION['ces1313777_sessid_inicio']." as usua_id,'".$moviin_iddes."' as moviin_id from dns_cuadrobasicomedicamentos inner join beko_tarifa on dns_cuadrobasicomedicamentos.tari_codigo=beko_tarifa.tari_codigo where  cuadrobm_id='".$cuadrobm_id."'";
$rs_dataproducto = $DB_gogess->executec($busca_dataproducto,array());
		


$inserta_producto="insert into beko_proformamhdetallefactura (doccab_id,mhdetfac_codprincipal,mhdetfac_descripcion,mhdetfac_cantidad,mhdetfac_preciou,impumh_codigo,tarimh_codigo,mhdetfac_porcentaje,mhdetfac_valorimpuesto,mhdetfac_total,usua_id,mhdetfac_fecharegistro,moviin_id) values ('".$rs_dataproducto->fields["doccab_id"]."','".$rs_dataproducto->fields["cuadrobm_codigoatc"]."','".$rs_dataproducto->fields["cuadrobm_nombrecomercial"]."','".$rs_dataproducto->fields["mhdetfac_cantidad"]."','".$rs_dataproducto->fields[$valor_precio]."','".$rs_dataproducto->fields["impu_codigo"]."','".$rs_dataproducto->fields["tari_codigo"]."','".$rs_dataproducto->fields["tari_valor"]."','".$rs_dataproducto->fields["mhdetfac_valorimpuesto"]."','".$rs_dataproducto->fields["mhdetfac_total"]."','".$rs_dataproducto->fields["usua_id"]."','".date("Y-m-d H:i:s")."','".$rs_dataproducto->fields["moviin_id"]."')";
$rs_insdetalle = $DB_gogess->executec($inserta_producto,array());




}
?>