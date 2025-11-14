<?php
$tipo='';
$tipo=$_POST["pVar1"];
$id_valor='';
$id_valor=$_POST["pVar2"];

$inactivo=0;

if($inactivo==0)
{
  echo '<span style="font-size:10px"><center><B>OPCION NO SE ENCUENTRA ACTIVA AL MOMENTO</B><hr></center></span>';

}
else
{

if($id_valor>0)
{
?>
<span style="font-size:10px"><center><B>ALERTA!! POR FAVOR ANTES DE CAMBIAR LA FECHA VERIFICAR LOS DATOS INGRESADOS EN EL FORMULARIO, YA QUE DESPUES EL FORMULARIO SE BLOQUERA AUTOMATICAMENTE</B><hr></center></span>
<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center"><strong>FECHA CAMBIO </strong></div></td>
  </tr>
  <tr>
    <td><div align="center"><strong>Nueva Fecha:</strong>
        <input name="fecha_cambio" type="text" id="fecha_cambio" value="" class="form-control"  autocomplete="off" >
    </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center"><strong>Motivo: 
      </strong>      
          <input name="ttext_motivo" type="text" id="ttext_motivo" value="" size="60" class="form-control">
    </div></td>
  </tr>
</table>

<div align="center">
  <input name="btn_cambior" type="button" id="btn_cambior" value="Cambiar" onClick="ejecutar_cambio()">
</div>

<div id="cmb_registro"></div>




<script type="text/javascript">
<!--
function ejecutar_cambio()
{
  if($('#fecha_cambio').val()=='')
  {
      alert("Por favor ingrese la nueva fecha...");
	  return false;
  
  }
  
  if($('#ttext_motivo').val()=='')
  {
      alert("Por favor ingrese el motivo...");
	  return false;
  
  }
  
    var r = confirm("Alerta!!! se modificara la fecha de registro desea continuar....");
	if (r == true) {
	  
	   $("#cmb_registro").load("aplicativos/documental/cambior/<?php echo $tipo; ?>.php",{
	
	  fecha_cambio:$('#fecha_cambio').val(),
	  ttext_motivo:$('#ttext_motivo').val(),
	  id_valor:'<?php echo $id_valor; ?>'
	  //filtro_val:$('#filtro_val').val()
	
	  },function(result){  
	
	  });  
	
	  $("#cmb_registro").html("<img src='images/progress/progress_2.gif'>");  
  
  
  }

}

//  End -->
</script>


<script type="text/javascript">
<!--
$( "#fecha_cambio" ).datepicker({dateFormat: 'yy-mm-dd'});

//  End -->
</script>
<?php


  
}
else
{
   echo "<center>Alerta!! Si es un nuevo registro, primero guardelo para poder cambiar la fecha de registro...</center>";
}
}
?>

