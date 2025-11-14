<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4440000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

if($_SESSION['ces1313777_sessid_inicio'])
{

$doccab_pgacont=$_POST["doccab_pgacont"];
$conve_id=$_POST["conve_id"];
$precio='';
$impuesto='';
$tari_codigo='';
$prod_preciocosto='';

$datos_produ="select * from efacsistema_producto where prod_codigo='".$_POST["docdet_codprincipal"]."'";
$rs_produ = $DB_gogess->executec($datos_produ,array());
$precio=$rs_produ->fields["prod_precio"];
$impuesto=$rs_produ->fields["impu_codigo"];
$tari_codigo=$rs_produ->fields["tari_codigo"];
$prod_preciocosto=$rs_produ->fields["prod_preciocosto"];

$docdet_descripcionx=$rs_produ->fields["prod_nombre"];


if($conve_id=='' or $conve_id=='6')
{

$datos_produ="select * from efacsistema_producto where prod_codigo='".$_POST["docdet_codprincipal"]."'";
$rs_produ = $DB_gogess->executec($datos_produ,array());
$precio=$rs_produ->fields["prod_precio"];
$impuesto=$rs_produ->fields["impu_codigo"];
$tari_codigo=$rs_produ->fields["tari_codigo"];
$prod_preciocosto=$rs_produ->fields["prod_preciocosto"];
}
else
{

$datos_produ="select * from efacsistema_producto left join cesdb_arextension.dns_gridconvenios on efacsistema_producto.prod_enlace=cesdb_arextension.dns_gridconvenios.prod_enlace where prod_codigo='".$_POST["docdet_codprincipal"]."' and gconve_convenio='".$conve_id."'";
$rs_produ = $DB_gogess->executec($datos_produ,array());

$precio=$rs_produ->fields["gconve_precio"];
if($precio>0)
{
$impuesto=$rs_produ->fields["impu_codigo"];
$tari_codigo=$rs_produ->fields["tari_codigo"];
$prod_preciocosto=$rs_produ->fields["prod_preciocosto"];
}


}

//$file = fopen("producto".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
//fwrite($file, $_SESSION['ces1313777_sessid_inicio']."-->".$datos_produ."-->".date("Y-m-d H:i:s"). PHP_EOL);
//fclose($file);

$saca_tarifa="select * from beko_tarifa where tari_codigo='".$tari_codigo."'";
$rs_tari = $DB_gogess->executec($saca_tarifa,array());
?>

<script language="javascript">
<!--

<?php
if(!($rs_produ->fields["prod_nombre"]))
{
?>
alert("Verificar precio para el convenio seleccionado o el producto esta sin precio asignado");
<?php
}
?>

<?php
if($doccab_pgacont==1)
{
  $precio=round(($precio*1.1),2);
}
?>

$('#docdet_descripcionx').val('<?php echo $docdet_descripcionx;  ?>');
$('#docdet_precioux').val('<?php echo $precio;  ?>');
$('#impu_codigox').val('<?php echo $impuesto; ?>');
$('#tari_codigox').val('<?php echo $tari_codigo; ?>');
$('#docdet_peciocostox').val('<?php echo $prod_preciocosto; ?>');
$('#docdet_porcentajex').val('<?php echo $rs_tari->fields["tari_valor"]; ?>');
$('#docdet_descuentox').val('');
$('#docdet_cantidadx').val('');

//-->
</script>

<?php

}

?>