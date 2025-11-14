<?php
$tiempossss=541400000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//echo $_POST["cant_val"]."<br>";
//echo $_POST["prod_id"]."<br>";
//echo $_POST["enlace"]."<br>";
if($_SESSION['ces1313777_sessid_inicio'])
{

$prof_id=$_POST["prof_id"];

$busca_espcialida="select * from cesdb_arextension.dns_profesion where prof_id='".$prof_id."'";
$rs_dataespcialidad = $DB_gogess->executec($busca_espcialida,array());

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

$busca_pr="select * from efacsistema_producto where prod_id='".$_POST["prod_id"]."'";
$rs_pr= $DB_gogess->executec($busca_pr,array());
$tipo_prductoval=$rs_pr->fields["tipp_id"];


//busca_precio
$busca_precio="select * from app_usuario where usua_id='".$_POST["usua_id"]."'";
$rs_precio= $DB_gogess->executec($busca_precio,array());
$codigo_enc=$rs_precio->fields["usua_apellido"]." ".$rs_precio->fields["usua_nombre"];

$nombre_espe='';
$nombre_espe=$rs_dataespcialidad->fields["prof_nombre"]." ";

if($tipo_prductoval==2)
{
//
    
	
	$nombre_espe=$rs_dataespcialidad->fields["prof_nombre"]." ";
	//if($rs_pr->fields["prod_nombre"]==$rs_precio->fields["usua_formaciondelprofesional"])
	//{
	 // $nombre_espe='';	
	//}
	
	$cadena_de_texto = trim($rs_pr->fields["prod_nombre"]);
    $cadena_buscada   = trim($rs_dataespcialidad->fields["prof_nombre"]);
    $posicion_coincidencia = strrpos($cadena_de_texto, $cadena_buscada);
	if (!($posicion_coincidencia === false)) {
         $nombre_espe='';
    } 
	

}

//echo $rs_precio->fields["usua_formaciondelprofesional"];



$busca_serial="select usua_id,prod_codigo from efacsistema_producto where prod_id='".$rs_pr->fields["prod_id"]."'";
$rs_serial = $DB_gogess->executec($busca_serial,array());
//busca precio


$busca_agregado="select * from beko_multipledocumentodetalle where docdet_codprincipal='".$rs_serial->fields["prod_codigo"]."' and doccab_id='".$_POST["enlace"]."'";
$rs_agregado = $DB_gogess->executec($busca_agregado,array());
$cantidad_actual=$rs_agregado->fields["docdet_cantidad"];

if($cantidad_actual>=1)
{
$borra_data="delete from beko_multipledocumentodetalle where docdet_codprincipal='".$rs_serial->fields["prod_codigo"]."' and  doccab_id='".$_POST["enlace"]."'";
$rs_okb = $DB_gogess->executec($borra_data,array());
$cantidad_nueva=$cantidad_actual+1;
}
else
{
$cantidad_nueva=1;
}


$busca_dataproducto="select '".$_POST["enlace"]."' as doccab_id,prod_codigo,prod_nombre,'".$cantidad_nueva."' as docdet_cantidad,(".$valor_precio.") as ".$valor_precio.",efacsistema_producto.impu_codigo,efacsistema_producto.tari_codigo,tari_valor,(((".$cantidad_nueva."*(".$valor_precio."))*tari_valor)/100) as docdet_valorimpuesto,(".$cantidad_nueva."*(".$valor_precio.")) as docdet_total,".$_SESSION['ces1313777_sessid_inicio']." as usua_id from efacsistema_producto inner join beko_tarifa on efacsistema_producto.tari_codigo=beko_tarifa.tari_codigo where  prod_id=".$rs_pr->fields["prod_id"];
$rs_dataproducto = $DB_gogess->executec($busca_dataproducto,array());


$valor_precio_isnerta=$rs_dataproducto->fields[$valor_precio];
$docdet_valorimpuesto=$rs_dataproducto->fields["docdet_valorimpuesto"];
$docdet_total=$rs_dataproducto->fields["docdet_total"];


//ver precio convenio
$gconve_precio=0; 
if($_POST["conve_id"]>0)
{
	$busca_valorconvenio="select * from cesdb_arextension.dns_gridconvenios conve inner join efacsistema_producto on conve.prod_enlace=efacsistema_producto.prod_enlace where prod_id='".$rs_pr->fields["prod_id"]."' and gconve_convenio='".$_POST["conve_id"]."'";
	$rs_valorconvenio = $DB_gogess->executec($busca_valorconvenio,array());
	$gconve_precio=$rs_valorconvenio->fields["gconve_precio"];
}
  
//ver precio convenio

if($gconve_precio>0)
	{
	    //$saca_descuentovalor=($conve_descuento*$rs_dataproducto->fields[$valor_precio])/100;
	    $valor_precio_isnerta=$gconve_precio;
		
		$docdet_valorimpuesto=((($cantidad_nueva *($valor_precio_isnerta))*$rs_dataproducto->fields["tari_valor"])/100);
		$docdet_total=($cantidad_nueva*($valor_precio_isnerta));
	}


//==================================
    $cadena_de_texto = trim($rs_dataproducto->fields["prod_nombre"]);
    $cadena_buscada   = trim($nombre_espe);
	
    $posicion_coincidencia = strrpos($cadena_de_texto,$cadena_buscada);
	if (!($posicion_coincidencia === false)) {
         $nombre_espe='';
    } 
	

//==================================


$inserta_producto="insert into beko_multipledocumentodetalle (doccab_id,docdet_codprincipal,docdet_descripcion,docdet_cantidad,docdet_preciou,impu_codigo,tari_codigo,docdet_porcentaje,docdet_valorimpuesto,docdet_total,usua_id,usuaat_id,docdet_detallea,prof_id) values ('".$rs_dataproducto->fields["doccab_id"]."','".$rs_dataproducto->fields["prod_codigo"]."','".$nombre_espe.$rs_dataproducto->fields["prod_nombre"]."','".$rs_dataproducto->fields["docdet_cantidad"]."','".$valor_precio_isnerta."','".$rs_dataproducto->fields["impu_codigo"]."','".$rs_dataproducto->fields["tari_codigo"]."','".$rs_dataproducto->fields["tari_valor"]."','".$docdet_valorimpuesto."','".$docdet_total."','".$rs_dataproducto->fields["usua_id"]."','".$_POST["usua_id"]."','".$codigo_enc."','".$prof_id."')";
$rs_insdetalle = $DB_gogess->executec($inserta_producto,array());




}
else
{
echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF ">La sesi&oacute;n a caducado de clic en F5 para continuar...</div>';

}
?>