<?php

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

?>
<script type="text/javascript">
<!--

$('#moviin_total').val('<?php echo $moviin_total; ?>');
$('#despliegue_moviin_total').html('<?php echo $moviin_total; ?>');
$('#moviin_totalenunidadconsumo').val('<?php echo $cantidad_uso; ?>');
$('#moviin_preciocompra').val('<?php echo $precio_prorreateado; ?>');


//  End -->
</script>
