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

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

include("lib_asiento.php");

$objformulario= new  ValidacionesFormulario();

$datos_data=$_POST["datos_data"];
$precu_id=$_POST["precu_id"];
$tabla=$_POST["tabla"];
$centro_id=$_POST["centro_id"];
$centrob_id=$_POST["centro_id"];
$usua_id=$_POST["usua_id"];
$clie_id=$_POST["clie_id"];
$cuadrobm_id=$_POST["cuadrobm_id"];
$cantidad_valor=$_POST["cantidad_valor"];


$fecha_desc=$_POST["fecha_desc"];


$busca_pedido="select * from ".$_POST["tabla"]." where precu_id='".$precu_id."'";
$rs_bupedido= $DB_gogess->executec($busca_pedido,array());

$especipr_id=0;
$especipr_id=$rs_bupedido->fields["especipr_id"];

$array_data=array();
$array_data=explode(",",$datos_data);



$busca_medi="select * from dns_cuadrobasicomedicamentos where cuadrobm_id='".$cuadrobm_id."'";
$rs_medi = $DB_gogess->executec($busca_medi,array());
$categ_id=$rs_medi->fields["categ_id"];

if($categ_id==1 or $categ_id==2)
{
$detapre_tipo=$categ_id;
$detapre_tipofarmacia=$categ_id;
}
else
{
$detapre_tipo=2;
$detapre_tipofarmacia=$categ_id;
}

$mnupan_id=0;
$detapre_codigop=$rs_medi->fields["cuadrobm_codigoatc"];
$detapre_detalle=$rs_medi->fields["cuadrobm_nombrecomercial"];
$detapre_cantidad=$cantidad_valor;
$detapre_precio=$moviin_preciocompra;
if($fecha_desc)
{
$detapre_fecharegistro=$fecha_desc." ".date("H:i:s");
}
else
{
$detapre_fecharegistro=date("Y-m-d H:i:s");
}

$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$centro_id=$_SESSION['ces1313777_centro_id'];

if($centro_id==1)
{
  $centro_id=55;
}

$detapre_codigoform=0;
$detapre_idgrid=0;
$table='';
$detapre_origen='DESCARGO APP';

$busca_cliente="select * from app_cliente where clie_id='".$clie_id."'";
$rs_bcliente = $DB_gogess->executec($busca_cliente,array());	  
$conve_id=$rs_bcliente->fields["conve_id"];

$pvp_enformula=0;
//$pvp_enformula=$objFormulascontable->formulas_pvp($conve_id,$detapre_precio,$DB_gogess);

$perioc_id=0;
$busca_formulax1="select * from lpin_periodocontable where perioc_activo=1";
$rs_formulax1 = $DB_gogess->executec($busca_formulax1);  
$perioc_id=$rs_formulax1->fields["perioc_id"];

$precios_valores=array();
$precios_valores=$objBodega->busca_precioproducto($cuadrobm_id,$DB_gogess);



if($conve_id==7)
{
  $detapre_precio=$precios_valores["pcosto"];
  $detapre_precioventa=$precios_valores["pisspol"];
}
else
{
  if($especipr_id=='27')
  {
    $detapre_precio=$precios_valores["pcosto"];
    $detapre_precioventa=$precios_valores["plasticos"];
  }
  else
  {
    $detapre_precio=$precios_valores["pcosto"];
    $detapre_precioventa=$precios_valores["pvp"];
  }
}


$inserta_datadis="INSERT INTO dns_preddetalleprecuenta (precu_id, clie_id, mnupan_id, detapre_tipo, detapre_codigop, detapre_detalle, detapre_cantidad, detapre_precio, detapre_fecharegistro, usua_id, centro_id, atenc_id, detapre_codigoform,detapre_idgrid,detapre_table,centrob_id,detapre_origen,moviin_id,cuadrobm_id,conve_id,detapre_precioventa,perioc_id,detapre_tipofarmacia) VALUES ('".$precu_id."','".$clie_id."','".$mnupan_id."','".$detapre_tipo."','".$detapre_codigop."','".$detapre_detalle."','".$detapre_cantidad."','".$detapre_precio."','".$detapre_fecharegistro."','".$usua_id."','".$centro_id."','".$atenc_id."','".$detapre_codigoform."','".$detapre_idgrid."','".$table."','".$centrob_id."','".$detapre_origen."','".$moviin_iddes."','".$cuadrobm_id."','".$conve_id."','".$detapre_precioventa."','".$perioc_id."','".$detapre_tipofarmacia."');";

$rs_detapre= $DB_gogess->executec($inserta_datadis,array());



}

?>