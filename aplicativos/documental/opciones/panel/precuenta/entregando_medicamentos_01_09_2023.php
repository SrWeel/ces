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

$fecha_desc=$_POST["fecha_desc"];


$busca_pedido="select * from ".$_POST["tabla"]." where precu_id='".$_POST["precu_id"]."'";
$rs_bupedido= $DB_gogess->executec($busca_pedido,array());

$especipr_id=0;
$especipr_id=$rs_bupedido->fields["especipr_id"];

$array_data=array();
$array_data=explode(",",$datos_data);

for($i=0;$i<=count($array_data);$i++)
{

if($array_data[$i])
{

$obtiene_arr=array();
$obtiene_arr=explode("|",$array_data[$i]);

$moviin_id=$obtiene_arr[0];
$cantidad_valor=$obtiene_arr[1];

//echo $moviin_id."<br>";
echo $cantidad_valor."<br>";



$busca_movimientodata="select * from dns_movimientoinventario where moviin_id='".$moviin_id."'";
$rs_movidata= $DB_gogess->executec($busca_movimientodata,array());

$cuadrobm_id=$rs_movidata->fields["cuadrobm_id"];
$centro_id=$centro_id;
$tipom_id=2;
$tipomov_id=18;
$moviin_nlote=$rs_movidata->fields["moviin_nlote"];
$moviin_fechadecaducidad=$rs_movidata->fields["moviin_fechadecaducidad"];
$moviin_comprobantedeingreso='0';
$moviin_fechaingreso='';
$centroenvia_id='0';
$centrorecibe_id='0';
$centrorecibe_observacion='';
$centrorecibe_cantidad=0;
$centrorecibe_documento='';
$centrorecibe_bodegamatriz=1;
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$moviin_fechaenvio='';
$moviin_nombrerecibe='';
$moviin_cedularecibe='';
$moviin_gradorecibe='';

if($fecha_desc)
{
$moviin_fecharegistro=$fecha_desc." ".date("H:i:s");
}
else
{
$moviin_fecharegistro=date("Y-m-d H:i:s");
}

$unid_id=$rs_movidata->fields["unid_id"];
$uniddesg_id=$rs_movidata->fields["uniddesg_id"];
$moviin_cantidadunidadconsumo=1;
$moviin_totalenunidadconsumo=$cantidad_valor;
$moviin_fechadeelaboracion=$rs_movidata->fields["moviin_fechadeelaboracion"];
$moviin_nombreproveedor=$rs_movidata->fields["moviin_nombreproveedor"];
$moviin_nombrefabricante=$rs_movidata->fields["moviin_nombrefabricante"];
$moviin_preciocompra=$rs_movidata->fields["moviin_preciocompra"];
$moviin_total=$rs_movidata->fields["moviin_preciocompra"]*$cantidad_valor;
$moviin_rsanitario=$rs_movidata->fields["moviin_rsanitario"];
$compra_id=$rs_movidata->fields["compra_id"];
$moviin_autorizado='';
$moviin_fechaautorizado='';
$moviin_aprobo='0';
$tempdsp_id='0';
$egrec_id='0';
$entregamoviin_id=$moviin_id;
$entregaclie_id=$clie_id;

if($fecha_desc)
{
$entrega_fecha=$fecha_desc." ".date("H:i:s");
}
else
{
$entrega_fecha=date("Y-m-d H:i:s");
}

$per_activo=0;
$per_activo=$objformulario->replace_cmb("dns_periodobodega","perio_activo,perio_anio"," where perio_activo=",1,$DB_gogess);

///ingresa primero precuenta
$stockactual="select sum(stock_cantidad*stock_signo) as stactual from dns_stockactual where centro_id=".$centro_id." and cuadrobm_id='".$cuadrobm_id."'";
$rs_stactua = $DB_gogess->executec($stockactual);
$maximo_permitido=$rs_stactua->fields["stactual"];

if($cantidad_valor<=$maximo_permitido)
{


$inserta_movimiento="INSERT INTO dns_movimientoinventario ( cuadrobm_id, centro_id, tipom_id, tipomov_id, moviin_nlote, moviin_fechadecaducidad, moviin_comprobantedeingreso, moviin_fechaingreso, centroenvia_id, centrorecibe_id, centrorecibe_observacion, centrorecibe_cantidad, centrorecibe_documento, centrorecibe_bodegamatriz, usua_id, moviin_fechaenvio, moviin_nombrerecibe, moviin_cedularecibe, moviin_gradorecibe, moviin_fecharegistro, unid_id, uniddesg_id, moviin_cantidadunidadconsumo, moviin_totalenunidadconsumo, moviin_fechadeelaboracion, moviin_nombreproveedor, moviin_nombrefabricante, moviin_preciocompra, moviin_total, moviin_rsanitario, compra_id, moviin_autorizado, moviin_fechaautorizado, moviin_aprobo, tempdsp_id, egrec_id, entregamoviin_id, entregaclie_id, entrega_fecha, precu_id,perioac_id,moviin_tblreceta) VALUES
('".$cuadrobm_id."','".$centro_id."','".$tipom_id."','".$tipomov_id."','".$moviin_nlote."','".$moviin_fechadecaducidad."','".$moviin_comprobantedeingreso."','".$moviin_fechaingreso."','".$centroenvia_id."','".$centrorecibe_id."','".$centrorecibe_observacion."','".$centrorecibe_cantidad."','".$centrorecibe_documento."','".$centrorecibe_bodegamatriz."','".$usua_id."','".$moviin_fechaenvio."','".$moviin_nombrerecibe."','".$moviin_cedularecibe."','".$moviin_gradorecibe."','".$moviin_fecharegistro."','".$unid_id."','".$uniddesg_id."','".$moviin_cantidadunidadconsumo."','".$moviin_totalenunidadconsumo."','".$moviin_fechadeelaboracion."','".$moviin_nombreproveedor."','".$moviin_nombrefabricante."','".$moviin_preciocompra."','".$moviin_total."','".$moviin_rsanitario."','".$compra_id."','".$moviin_autorizado."','".$moviin_fechaautorizado."','".$moviin_aprobo."','".$tempdsp_id."','".$egrec_id."','".$entregamoviin_id."','".$entregaclie_id."','".$entrega_fecha."','".$precu_id."','".$per_activo."','".$tabla."');";

$rs_entrega= $DB_gogess->executec($inserta_movimiento,array());

$moviin_iddes=$DB_gogess->funciones_nuevoID(0);


$busca_medi="select * from dns_cuadrobasicomedicamentos where cuadrobm_id='".$cuadrobm_id."'";
$rs_medi = $DB_gogess->executec($busca_medi,array());
$categ_id=$rs_medi->fields["categ_id"];

$detapre_tipo=$categ_id;
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


$inserta_datadis="INSERT INTO dns_detalleprecuenta (precu_id, clie_id, mnupan_id, detapre_tipo, detapre_codigop, detapre_detalle, detapre_cantidad, detapre_precio, detapre_fecharegistro, usua_id, centro_id, atenc_id, detapre_codigoform,detapre_idgrid,detapre_table,centrob_id,detapre_origen,moviin_id,cuadrobm_id,conve_id,detapre_precioventa,perioc_id) VALUES ('".$precu_id."','".$clie_id."','".$mnupan_id."','".$detapre_tipo."','".$detapre_codigop."','".$detapre_detalle."','".$detapre_cantidad."','".$detapre_precio."','".$detapre_fecharegistro."','".$usua_id."','".$centro_id."','".$atenc_id."','".$detapre_codigoform."','".$detapre_idgrid."','".$table."','".$centrob_id."','".$detapre_origen."','".$moviin_iddes."','".$cuadrobm_id."','".$conve_id."','".$detapre_precioventa."','".$perioc_id."');";

$rs_detapre= $DB_gogess->executec($inserta_datadis,array());

$id_gen_detapre_id=$DB_gogess->funciones_nuevoID(0);


//genera asiento

genera_asientodescargo($precu_id,$id_gen_detapre_id,$DB_gogess);

//genera asiento



}






}


}

//$despachar_data="update ".$_POST["tabla"]." set usuad_id='".$_POST["usua_id"]."',centrod_id='".$_POST["centro_id"]."',plantra_despachado='SI',plantra_fechadespacho='".date("Y-m-d H:i:s")."' where precu_id='".$_POST["precu_id"]."';";
//$rs_data= $DB_gogess->executec($despachar_data,array());




}

?>