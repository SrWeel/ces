<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();


$centrorecibe_cantidad=$_POST["centrorecibe_cantidad"];
$moviin_preciocontable=$_POST["moviin_preciocontable"];
$precio_prorreateado=0;

if($centrorecibe_cantidad=='')
{
$centrorecibe_cantidad=0;
}

if($moviin_preciocontable=='')
{
$moviin_preciocontable=0;
}

$moviin_total=$centrorecibe_cantidad*$moviin_preciocontable;
$moviin_total=number_format($moviin_total, 2, '.', '');

$moviin_cantidadunidadconsumo=$_POST["moviin_cantidadunidadconsumo"];

if($moviin_cantidadunidadconsumo=='')
{
$moviin_cantidadunidadconsumo=0;
}

$cantidad_uso=$centrorecibe_cantidad*$moviin_cantidadunidadconsumo;

if($moviin_cantidadunidadconsumo>0)
{
$precio_prorreateado=$moviin_preciocontable/$moviin_cantidadunidadconsumo;
$precio_prorreateado=number_format($precio_prorreateado, 2, '.', '');

}

$cuadrobm_id=$_POST["cuadrobm_id"];
$busca_precio="select * from dns_preciostiempo where cuadrobm_id='".$cuadrobm_id."'";
$rs_buprecio= $DB_gogess->executec($busca_precio,array());

$precio_ref=$rs_buprecio->fields["precio_compra"];
$alerta_msg='';
$alerta_msgjs='';
if($precio_ref>0)
{   
   if($precio_ref!=$precio_prorreateado)
   {
   
   $alerta_msg="<span style='color:#990000' >ALERTA Precio diferente verificar si esta bien el rango de diferencia, caso contraro verificar unidades de almacenamiento y consumo...si es normal continuar con el proceso</span>";
   $alerta_msgjs="ALERTA Precio diferente verificar si esta bien el rango de diferencia, caso contraro verificar unidades de almacenamiento y consumo...si es normal continuar con el proceso";
   
   
   }
}

$datos_pr="<br>Precio Referencial:".$precio_ref."<br>";
$datos_pr.="Precio Generado:".$precio_prorreateado."<br>";
?>
<script type="text/javascript">
<!--

$('#moviin_total').val('<?php echo $moviin_total; ?>');
$('#despliegue_moviin_total').html('<?php echo $moviin_total; ?>');
$('#moviin_totalenunidadconsumo').val('<?php echo $cantidad_uso; ?>');
$('#moviin_preciocompra').val('<?php echo $precio_prorreateado; ?>');


$('#r_calculo_alerta').html("<center><?php echo $alerta_msg.$datos_pr; ?><br></center>");

<?php

if($alerta_msg)
{
?>

alert("<?php echo $alerta_msgjs; ?>");

<?php
}

?>


//  End -->
</script>
