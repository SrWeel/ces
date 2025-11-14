<?php
$tiempossss=540014000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//echo $_POST["cant_val"]."<br>";
//echo $_POST["prod_id"]."<br>";
//echo $_POST["enlace"]."<br>";
/*cant_val:$('#cant_val').val(),
prod_id:idinsumo,
enlace:'<?php echo $_POST["pVar1"]; ?>',
usua_idfacval:ci,
tippo_id:'<?php echo $_POST["pVar5"]; ?>',
conve_id:'<?php echo $_POST["pVar6"]; ?>',
doccab_autorizacion:'<?php echo $_POST["pVar7"]; ?>'*/


if($_SESSION['ces1313777_sessid_inicio'])
{

//busca medico atiende


if(@$_POST["usua_idfacval"])
{
$codigo_encargado="select usua_nombre,usua_apellido from app_usuario where usua_id=".$_POST["usua_idfacval"];
$rs_codigoencr = $DB_gogess->executec($codigo_encargado,array());
$codigo_enc=$rs_codigoencr->fields["usua_apellido"]." ".$rs_codigoencr->fields["usua_nombre"];
}

//bsca medico atiende


$valor_precio='prod_precio';

//llega tipo y convenio
$conve_descuento=0;
if($_POST["conve_id"]>0)
{
$busca_convenio="select * from cesdb_arextension.dns_convenios where conve_id='".$_POST["conve_id"]."'";
$rs_convenio = $DB_gogess->executec($busca_convenio,array());
$conve_descuento=$rs_convenio->fields["conve_descuento"];
}

//llega tipo y convenio



$cantidad_nueva=0;
$cantidad_actual=0;

//busca serial
$busca_serial="select usua_id,prod_codigo from efacsistema_producto where prod_id=".$_POST["prod_id"];
$rs_serial = $DB_gogess->executec($busca_serial,array());
//


$busca_agregado="select * from beko_documentodetalle where docdet_codprincipal='".$rs_serial->fields["prod_codigo"]."' and doccab_id='".$_POST["enlace"]."'";
$rs_agregado = $DB_gogess->executec($busca_agregado,array());

$cantidad_actual=$rs_agregado->fields["docdet_cantidad"];

if($cantidad_actual>=1)
{

$borra_data="delete from beko_documentodetalle where docdet_codprincipal='".$rs_serial->fields["prod_codigo"]."' and  doccab_id='".$_POST["enlace"]."'";
$rs_okb = $DB_gogess->executec($borra_data,array());

$file = fopen("logdata/detalleinsert".date("Y-m-d")."_".@$_SESSION['datafrank1109_centro_id'].".txt", "a+");
fwrite($file, $_SESSION['datafrank1109_sessid_inicio']."-->".$borra_data."-->".date("Y-m-d H:i:s"). PHP_EOL);
fclose($file);	

$cantidad_nueva=$cantidad_actual+$_POST["cant_val"];
}
else
{
$cantidad_nueva=$_POST["cant_val"];

}


$busca_dataproducto="select '".$_POST["enlace"]."' as doccab_id,prod_codigo,prod_nombre,'".$cantidad_nueva."' as docdet_cantidad,(".$valor_precio.") as ".$valor_precio.",efacsistema_producto.impu_codigo,efacsistema_producto.tari_codigo,tari_valor,(((".$cantidad_nueva."*(".$valor_precio."))*tari_valor)/100) as docdet_valorimpuesto,(".$cantidad_nueva."*(".$valor_precio.")) as docdet_total,".$_SESSION['ces1313777_sessid_inicio']." as usua_id,prod_enlace from efacsistema_producto inner join beko_tarifa on efacsistema_producto.tari_codigo=beko_tarifa.tari_codigo where  prod_id=".$_POST["prod_id"];
$rs_dataproducto = $DB_gogess->executec($busca_dataproducto,array());

$valor_precio_isnerta=$rs_dataproducto->fields[$valor_precio];
$docdet_valorimpuesto=$rs_dataproducto->fields["docdet_valorimpuesto"];
$docdet_total=$rs_dataproducto->fields["docdet_total"];


//ver precio convenio
$gconve_precio=0; 
if($_POST["conve_id"]>0)
{
	$busca_valorconvenio="select * from cesdb_arextension.dns_gridconvenios where prod_enlace='".$rs_dataproducto->fields["prod_enlace"]."' and gconve_convenio='".$_POST["conve_id"]."'";
	$rs_valorconvenio = $DB_gogess->executec($busca_valorconvenio,array());
	$gconve_precio=$rs_valorconvenio->fields["gconve_precio"];
}
  
//ver precio convenio

if($gconve_precio>0)
	{
	    //$saca_descuentovalor=($conve_descuento*$rs_dataproducto->fields[$valor_precio])/100;
	    //$valor_precio_isnerta=$rs_dataproducto->fields[$valor_precio]-$saca_descuentovalor;
		
		$valor_precio_isnerta=$gconve_precio;		
		$docdet_valorimpuesto=((($cantidad_nueva *($valor_precio_isnerta))*$rs_dataproducto->fields["tari_valor"])/100);
		$docdet_total=($cantidad_nueva*($valor_precio_isnerta));
	}

$inserta_producto="insert into beko_documentodetalle (doccab_id,docdet_codprincipal,docdet_descripcion,docdet_cantidad,docdet_preciou,impu_codigo,tari_codigo,docdet_porcentaje,docdet_valorimpuesto,docdet_total,usua_id,usuaat_id,docdet_detallea,prof_id) values ('".$rs_dataproducto->fields["doccab_id"]."','".$rs_dataproducto->fields["prod_codigo"]."','".$rs_dataproducto->fields["prod_nombre"]."','".$rs_dataproducto->fields["docdet_cantidad"]."','".$valor_precio_isnerta."','".$rs_dataproducto->fields["impu_codigo"]."','".$rs_dataproducto->fields["tari_codigo"]."','".$rs_dataproducto->fields["tari_valor"]."','".$docdet_valorimpuesto."','".$docdet_total."','".$rs_dataproducto->fields["usua_id"]."','".$_POST["usua_idfacval"]."','".$codigo_enc."','".$_POST["prof_idval"]."')";
$rs_insdetalle = $DB_gogess->executec($inserta_producto,array());

$file = fopen("logdata/detalleinsert".date("Y-m-d")."_".@$_SESSION['datafrank1109_centro_id'].".txt", "a+");
fwrite($file, $_SESSION['datafrank1109_sessid_inicio']."-->".$inserta_producto."-->".date("Y-m-d H:i:s"). PHP_EOL);
fclose($file);

}
else
{
echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF ">La sesi&oacute;n a caducado de clic en F5 para continuar...</div>';

}
?>