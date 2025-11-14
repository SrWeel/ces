<?php
$tiempossss=14000;
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
$lista_hijos="select distinct tipopac_id,clie_nombre,clie_apellido from app_cliente inner join dns_representante on app_cliente.clie_enlace=dns_representante.clie_enlace where repres_ci='".trim($_POST["ci_paga"])."'";
$rs_datahijos = $DB_gogess->executec($lista_hijos,array());
if($rs_datahijos)
 {
	  while (!$rs_datahijos->EOF) {	
        
		$tipopac_id=$rs_datahijos->fields["tipopac_id"];

        $rs_datahijos->MoveNext();	   
	  }
  }


	$valor_precio='prod_precio';
	switch ($tipopac_id) {
    case 1:
        $valor_precio="prod_precioisfa";
        break;
    case 2:
        $valor_precio="prod_precio";
        break;
    case 3:
        $valor_precio="prod_precioconvenio";
        break;
	case 4:
        $valor_precio="prod_precioconveniohermano";
        break;	
	case 5:
        $valor_precio="prod_preciopolicia";
        break;
	case 6:
        $valor_precio="prod_preciomilitar";
        break;				
    }



$cantidad_nueva=0;
$cantidad_actual=0;

//busca serial
$busca_serial="select usua_id,prod_codigo from efacsistema_producto where prod_id=".$_POST["prod_id"];
$rs_serial = $DB_gogess->executec($busca_serial,array());
//

//obtine codigo doc
$codigo_enc='';
if(@$rs_serial->fields["usua_id"])
{
$codigo_encargado="select usua_codigoiniciales from app_usuario where usua_id=".$rs_serial->fields["usua_id"];
$rs_codigoencr = $DB_gogess->executec($codigo_encargado,array());
$codigo_enc=$rs_codigoencr->fields["usua_codigoiniciales"];
}
//obtiene codigo doc

$busca_agregado="select * from beko_recibodetalle where docdet_codprincipal='".$rs_serial->fields["prod_codigo"]."' and doccab_id='".$_POST["enlace"]."'";
$rs_agregado = $DB_gogess->executec($busca_agregado,array());

$cantidad_actual=$rs_agregado->fields["docdet_cantidad"];

if($cantidad_actual>=1)
{

$borra_data="delete from beko_recibodetalle where docdet_codprincipal='".$rs_serial->fields["prod_codigo"]."' and  doccab_id='".$_POST["enlace"]."'";
$rs_okb = $DB_gogess->executec($borra_data,array());

$cantidad_nueva=$cantidad_actual+$_POST["cant_val"];
}
else
{
$cantidad_nueva=$_POST["cant_val"];

}


$busca_dataproducto="select '".$_POST["enlace"]."' as doccab_id,prod_codigo,prod_nombre,'".$cantidad_nueva."' as docdet_cantidad,(".$valor_precio.") as ".$valor_precio.",efacsistema_producto.impu_codigo,efacsistema_producto.tari_codigo,tari_valor,(((".$cantidad_nueva."*(".$valor_precio."))*tari_valor)/100) as docdet_valorimpuesto,(".$cantidad_nueva."*(".$valor_precio.")) as docdet_total,".$_SESSION['ces1313777_sessid_inicio']." as usua_id from efacsistema_producto inner join beko_tarifa on efacsistema_producto.tari_codigo=beko_tarifa.tari_codigo where  prod_id=".$_POST["prod_id"];
$rs_dataproducto = $DB_gogess->executec($busca_dataproducto,array());


if($codigo_enc)
{

$inserta_producto="insert into beko_recibodetalle (doccab_id,docdet_codprincipal,docdet_descripcion,docdet_cantidad,docdet_preciou,impu_codigo,tari_codigo,docdet_porcentaje,docdet_valorimpuesto,docdet_total,usua_id) values ('".$rs_dataproducto->fields["doccab_id"]."','".$rs_dataproducto->fields["prod_codigo"]."','".$rs_dataproducto->fields["prod_nombre"]." - ".$codigo_enc.""."','".$rs_dataproducto->fields["docdet_cantidad"]."','".$rs_dataproducto->fields[$valor_precio]."','".$rs_dataproducto->fields["impu_codigo"]."','".$rs_dataproducto->fields["tari_codigo"]."','".$rs_dataproducto->fields["tari_valor"]."','".$rs_dataproducto->fields["docdet_valorimpuesto"]."','".$rs_dataproducto->fields["docdet_total"]."','".$rs_dataproducto->fields["usua_id"]."')";
$rs_insdetalle = $DB_gogess->executec($inserta_producto,array());

}
else
{

$inserta_producto="insert into beko_recibodetalle (doccab_id,docdet_codprincipal,docdet_descripcion,docdet_cantidad,docdet_preciou,impu_codigo,tari_codigo,docdet_porcentaje,docdet_valorimpuesto,docdet_total,usua_id) values ('".$rs_dataproducto->fields["doccab_id"]."','".$rs_dataproducto->fields["prod_codigo"]."','".$rs_dataproducto->fields["prod_nombre"]."','".$rs_dataproducto->fields["docdet_cantidad"]."','".$rs_dataproducto->fields[$valor_precio]."','".$rs_dataproducto->fields["impu_codigo"]."','".$rs_dataproducto->fields["tari_codigo"]."','".$rs_dataproducto->fields["tari_valor"]."','".$rs_dataproducto->fields["docdet_valorimpuesto"]."','".$rs_dataproducto->fields["docdet_total"]."','".$rs_dataproducto->fields["usua_id"]."')";
$rs_insdetalle = $DB_gogess->executec($inserta_producto,array());

}

}
else
{
echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF ">La sesi&oacute;n a caducado de clic en F5 para continuar...</div>';

}
?>