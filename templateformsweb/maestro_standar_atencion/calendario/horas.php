<?php
$fecha_seleccionada=$_POST["pVar1"];
?>
<p>&nbsp;</p>
<center>Fecha seleccionada: <br />
<b><?php echo $fecha_seleccionada; ?></b><p>
  <input name="fecha_seleccionada" type="hidden" id="fecha_seleccionada" value="<?php echo $fecha_seleccionada; ?>" />
</p>
<p>&nbsp;</p>
<div class="form-group">
<div class="col-md-6">
<label>Hora Inicio:</label>
<input  name="horat_horaix_val"  type="text" id="horat_horaix_val"  value="" size="7"  >
</div>
<div class="col-md-6">
<label>Hora Fin:</label>
<input  name="horat_horafx_val"  type="text" id="horat_horafx_val"  value="" size="7"  >
</div>
</div>
<p>&nbsp;</p>

<div class="form-group">
<div class="col-md-6">
  <input type="button" name="Submit" value="SELECCIONAR" onclick="seleccion_fechah()"  />
</div>
<div class="col-md-6">
 <input type="button" name="Submit" value="CANCELAR" onclick="cerrar_pant()" />
</div>
</div>

</center>

<script>
jQuery('#horat_horaix_val').datetimepicker({
  datepicker:false,
  format:'H:i'
});

jQuery('#horat_horafx_val').datetimepicker({
  datepicker:false,
  format:'H:i'
});

function cerrar_pant()
{
  $('#divDialog_horas').remove();

}

function seleccion_fechah()
{
    if($('#fecha_seleccionada').val()=='')
	{
	   alert('Fecha no seleccionada...');
	   return false;
	}
	
	if($('#horat_horaix_val').val()=='')
	{
	   alert('Hora inicial no seleccionada...');
	   return false;
	}
	
	if($('#horat_horafx_val').val()=='')
	{
	   alert('Hora final no seleccionada...');
	   return false;
	}
	
	$('#horat_fechax').val($('#fecha_seleccionada').val());
	$('#horat_horaix').val($('#horat_horaix_val').val());
	$('#horat_horafx').val($('#horat_horafx_val').val());
	
	
  
}
</script>