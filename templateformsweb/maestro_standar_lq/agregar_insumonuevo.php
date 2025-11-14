<?php
$tiempossss=4444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//echo $_POST["cantidad_val"]."<br>";
//echo $_POST["produ_id"]."<br>";
//echo $_POST["enlace"]."<br>";

/*cant_val
descripcion_val
precio_val
impu_codigo_val
tari_codigo_val
produ_id
enlace*/


if($_SESSION['ces1313777_sessid_inicio'])
{
$cantidad_nueva=0;
$cantidad_actual=0;

//busca serial

$busca_agregado="select * from beko_lqdetalle where docdet_codprincipal='".$_POST["produ_id"]."' and doccab_id='".$_POST["enlace"]."'";
$rs_agregado = $DB_gogess->executec($busca_agregado,array());
$cantidad_actual=$rs_agregado->fields["docdet_cantidad"];

if($cantidad_actual>=1)
{

$borra_data="delete from beko_lqdetalle where docdet_codprincipal='".$_POST["produ_id"]."' and  doccab_id='".$_POST["enlace"]."'";
$rs_okb = $DB_gogess->executec($borra_data,array());

$cantidad_nueva=$cantidad_actual+$_POST["cantidad_val"];
}
else
{
$cantidad_nueva=$_POST["cantidad_val"];

}


$doccab_id=$_POST["enlace"];
$produ_codigoserial=$_POST["produ_id"];
$produ_nombre=$_POST["descripcion_val"];
$docdet_cantidad=$_POST["cantidad_val"];
$produ_preciogen=$_POST["precio_val"];
$impu_codigo=$_POST["impu_codigo_val"];
$tari_codigo=$_POST["tari_codigo_val"];

$busca_t="select * from beko_tarifa where tari_codigo='".$tari_codigo."'";
$rs_busca_t = $DB_gogess->executec($busca_t,array());
$tari_valor=0;
$tari_valor=$rs_busca_t->fields["tari_valor"];

$docdet_valorimpuesto=(($cantidad_nueva*$produ_preciogen)*$tari_valor)/100;
$docdet_total=$cantidad_nueva*$produ_preciogen;



 $inserta_producto="insert into beko_lqdetalle (doccab_id,docdet_codprincipal,docdet_descripcion,docdet_cantidad,docdet_preciou,impu_codigo,tari_codigo,docdet_porcentaje,docdet_valorimpuesto,docdet_total,usua_id,docdet_codaux) values ('".$doccab_id."','".$produ_codigoserial."','".$produ_nombre."','".$docdet_cantidad."','".$produ_preciogen."','".$impu_codigo."','".$tari_codigo."','".$tari_valor."','".$docdet_valorimpuesto."','".$docdet_total."','".$_SESSION['ces1313777_sessid_inicio']."','".$produ_codigoserial."')";
$rs_insdetalle = $DB_gogess->executec($inserta_producto,array());

}
else
{

echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF ">La sesi&oacute;n a caducado de clic en F5 para continuar...</div>';

}
?>