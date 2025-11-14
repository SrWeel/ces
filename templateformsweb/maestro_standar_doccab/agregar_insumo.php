<?php
$tiempossss=14000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//echo $_POST["cant_val"]."<br>";
//echo $_POST["produ_id"]."<br>";
//echo $_POST["enlace"]."<br>";
if($_SESSION['ces1313777_sessid_inicio'])
{
$cantidad_nueva=0;
$cantidad_actual=0;

//busca serial
$busca_serial="select produ_codigoserial from app_producto where produ_id=".$_POST["produ_id"];
$rs_serial = $DB_gogess->executec($busca_serial,array());
//

$busca_agregado="select * from app_documentodetalle where docdet_codprincipal='".$rs_serial->fields["produ_codigoserial"]."' and doccab_id='".$_POST["enlace"]."'";
$rs_agregado = $DB_gogess->executec($busca_agregado,array());

$cantidad_actual=$rs_agregado->fields["docdet_cantidad"];

if($cantidad_actual>=1)
{

$borra_data="delete from app_documentodetalle where docdet_codprincipal='".$rs_serial->fields["produ_codigoserial"]."' and  doccab_id='".$_POST["enlace"]."'";
$rs_okb = $DB_gogess->executec($borra_data,array());

$cantidad_nueva=$cantidad_actual+$_POST["cant_val"];
}
else
{
$cantidad_nueva=$_POST["cant_val"];

}


$busca_dataproducto="select '".$_POST["enlace"]."' as doccab_id,produ_codigoserial,produ_nombre,'".$cantidad_nueva."' as docdet_cantidad,produ_preciogen,app_producto.impu_codigo,app_producto.tari_codigo,tari_valor,(((".$cantidad_nueva."*produ_preciogen)*tari_valor)/100) as docdet_valorimpuesto,(".$cantidad_nueva."*produ_preciogen) as docdet_total,".$_SESSION['ces1313777_sessid_inicio']." as usua_id from app_producto inner join app_tarifa on app_producto.tari_codigo=app_tarifa.tari_codigo where  produ_id=".$_POST["produ_id"];
$rs_dataproducto = $DB_gogess->executec($busca_dataproducto,array());


$inserta_producto="insert into app_documentodetalle (doccab_id,docdet_codprincipal,docdet_descripcion,docdet_cantidad,docdet_preciou,impu_codigo,tari_codigo,docdet_porcentaje,docdet_valorimpuesto,docdet_total,usua_id) values ('".$rs_dataproducto->fields["doccab_id"]."','".$rs_dataproducto->fields["produ_codigoserial"]."','".$rs_dataproducto->fields["produ_nombre"]."','".$rs_dataproducto->fields["docdet_cantidad"]."','".$rs_dataproducto->fields["produ_preciogen"]."','".$rs_dataproducto->fields["impu_codigo"]."','".$rs_dataproducto->fields["tari_codigo"]."','".$rs_dataproducto->fields["tari_valor"]."','".$rs_dataproducto->fields["docdet_valorimpuesto"]."','".$rs_dataproducto->fields["docdet_total"]."','".$rs_dataproducto->fields["usua_id"]."')";
$rs_insdetalle = $DB_gogess->executec($inserta_producto,array());

}
?>