<?php
$tiempossss=14000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//echo $_POST["cant_val"]."<br>";
//echo $_POST["cuadrobm_id"]."<br>";
//echo $_POST["enlace"]."<br>";
if($_SESSION['ces1313777_sessid_inicio'])
{
   
    
$valor_precio='cuadrobm_pvp';

$cantidad_nueva=0;
$cantidad_actual=0;

//busca serial
 $busca_serial="select usua_id,cuadrobm_codigoatc from dns_cuadrobasicomedicamentos where cuadrobm_id='".$_POST["cuadrobm_id"]."'";
$rs_serial = $DB_gogess->executec($busca_serial,array());
//

$busca_agregado="select * from beko_mhdetallefactura where mhdetfac_codprincipal='".$rs_serial->fields["cuadrobm_codigoatc"]."' and doccab_id='".$_POST["enlace"]."'";
$rs_agregado = $DB_gogess->executec($busca_agregado,array());

$cantidad_actual=$rs_agregado->fields["mhdetfac_cantidad"];

if($cantidad_actual>=1)
{

$borra_data="delete from beko_mhdetallefactura where mhdetfac_codprincipal='".$rs_serial->fields["cuadrobm_codigoatc"]."' and  doccab_id='".$_POST["enlace"]."'";
$rs_okb = $DB_gogess->executec($borra_data,array());

$cantidad_nueva=$cantidad_actual+$_POST["cant_val"];
}
else
{
$cantidad_nueva=$_POST["cant_val"];

}


$busca_dataproducto="select '".$_POST["enlace"]."' as doccab_id,cuadrobm_codigoatc,cuadrobm_nombrecomercial,'".$cantidad_nueva."' as mhdetfac_cantidad,round((".$valor_precio."),2) as ".$valor_precio.",dns_cuadrobasicomedicamentos.impu_codigo,dns_cuadrobasicomedicamentos.tari_codigo,tari_valor,round((((".$cantidad_nueva."*(".$valor_precio."))*tari_valor)/100),2) as mhdetfac_valorimpuesto,(".$cantidad_nueva."*round((".$valor_precio."),2)) as mhdetfac_total,".$_SESSION['ces1313777_sessid_inicio']." as usua_id,moviin_id from dns_cuadrobasicomedicamentos inner join beko_tarifa on dns_cuadrobasicomedicamentos.tari_codigo=beko_tarifa.tari_codigo where  cuadrobm_id=".$_POST["cuadrobm_id"];
$rs_dataproducto = $DB_gogess->executec($busca_dataproducto,array());


$inserta_producto="insert into beko_mhdetallefactura (doccab_id,mhdetfac_codprincipal,mhdetfac_descripcion,mhdetfac_cantidad,mhdetfac_preciou,impumh_codigo,tarimh_codigo,mhdetfac_porcentaje,mhdetfac_valorimpuesto,mhdetfac_total,usua_id,mhdetfac_fecharegistro) values ('".$rs_dataproducto->fields["doccab_id"]."','".$rs_dataproducto->fields["cuadrobm_codigoatc"]."','".$rs_dataproducto->fields["cuadrobm_nombrecomercial"]."','".$rs_dataproducto->fields["mhdetfac_cantidad"]."','".$rs_dataproducto->fields[$valor_precio]."','".$rs_dataproducto->fields["impu_codigo"]."','".$rs_dataproducto->fields["tari_codigo"]."','".$rs_dataproducto->fields["tari_valor"]."','".$rs_dataproducto->fields["mhdetfac_valorimpuesto"]."','".$rs_dataproducto->fields["mhdetfac_total"]."','".$rs_dataproducto->fields["usua_id"]."','".date("Y-m-d H:i:s")."')";
$rs_insdetalle = $DB_gogess->executec($inserta_producto,array());



}
else
{
echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF ">La sesi&oacute;n a caducado de clic en F5 para continuar...</div>';

}
?>