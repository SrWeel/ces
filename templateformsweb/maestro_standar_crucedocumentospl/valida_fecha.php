<?php
$crudoc_fechaemision=$_POST["crudoc_fechaemision"];
$fecha_factura=$_POST["fecha_factura"];

if($crudoc_fechaemision<$fecha_factura)
{
?>
<script type="text/javascript">
<!-- 

alert("La fecha no puede ser menor a la fecha de la factura...");

$('#crudet_id').hide();
$('#cruant_id').hide();
$('#frmpven_idpl').hide();
$('#crucue_id').hide();

//-->
</script>
<?php
}
else
{

?>
<script type="text/javascript">
<!-- 

$('#crudet_id').show();


//-->
</script>
<?php

}
?>