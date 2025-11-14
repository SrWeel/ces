<?php
$tiempossss=444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
?>
<script language="javascript">
<!--
function buscar_tarifa()
{

$("#list_tarifa").load("templateformsweb/maestro_standar_lq/lista_tarifa.php",{
impu_codigo_val:$('#impu_codigo_val').val()
 },function(result){       
			 
  });  
  $("#list_tarifa").html("Espere un momento...");

}


function agregar_insumo()
{
	if($('#cant_val').val()<=0)
		{
			
			alert("Por favor para cantidad el valor debe ser minimo 1");
			return false;
		}
		
	if($('#descripcion_val').val()=='')
		{
			
			alert("Por favor ingrese la descripci\u00f3n");
			return false;
		}
	
	if($('#valor_val').val()<=0)
		{
			
			alert("Por favor el valor debe ser mayor a 0");
			return false;
		}	
		
	
	if($('#impu_codigo_val').val()=='')
		{
			
			alert("Por favor seleccione el impuesto");
			return false;
		}	
		
	if($('#tari_codigo_val').val()=='')
		{
			
			alert("Por favor seleccione la tarifa");
			return false;
		}	
		
				
	
$("#agregar_insumo").load("templateformsweb/maestro_standar_lq/agregar_insumonuevo.php",{
cantidad_val:$('#cantidad_val').val(),
descripcion_val:$('#descripcion_val').val(),
precio_val:$('#precio_val').val(),
impu_codigo_val:$('#impu_codigo_val').val(),
tari_codigo_val:$('#tari_codigo_val').val(),
produ_id:$('#codigo_val').val(),
enlace:'<?php echo $_POST["pVar1"]; ?>'
 },function(result){       
			
			grid_factura(0);
			 
  });  
  $("#agregar_insumo").html("Espere un momento...");


}

//-->
</script>
<?php

$codigo_aleat='';
$valoralet=mt_rand(1,500);
$codigo_aleat=@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("hi").$valoralet;

?>
<center>
<p>&nbsp;</p>
<div class="row">
  <div class="col-sm-4">
     C&oacute;digo:
  </div>
  <div class="col-sm-6">
    <input name="codigo_val" type="text" id="codigo_val" value="<?php echo $codigo_aleat; ?>" size="7" class="form-control" > 
  </div>
</div>  
<div class="row">
  <div class="col-sm-4">
     Descripci&oacute;n:
  </div>
  <div class="col-sm-6">
	<textarea name="descripcion_val" id="descripcion_val" rows="5"  class="form-control" ></textarea>
  </div>
</div> 

<div class="row">
  <div class="col-sm-4">
     Valor:
  </div>
  <div class="col-sm-6">
	 <input name="precio_val" type="text" id="precio_val" value="0" size="7"  class="form-control" > 
  </div>
</div> 

<div class="row">
  <div class="col-sm-4">
     Cantidad:
  </div>
  <div class="col-sm-6">
    <input name="cantidad_val" type="text" id="cantidad_val" value="1" size="7"  class="form-control" > 
  </div>
</div> 

<div class="row">
  <div class="col-sm-4">
     Impuesto:
  </div>
  <div class="col-sm-6">
    <select name="impu_codigo_val" id="impu_codigo_val" onChange="buscar_tarifa()"  class="form-control" >
	<option value="">-- Impuesto --</option>
	<?php
	$objformulario->fill_cmb("beko_impuesto","impu_codigo,impu_nombre",$impu_codigo_val," order by impu_nombre desc",$DB_gogess);
	?>

    </select>
  </div>
</div> 

<div class="row">
  <div class="col-sm-4">
     Tarifa:
  </div>
  <div class="col-sm-6">
   <div id="list_tarifa" >
    <select name="tari_codigo_val" id="tari_codigo_val"  class="form-control" >
    </select>
   </div>	
  </div>
</div> 
<p>&nbsp;</p>
<div class="row">
  <div class="col-sm-12">
<center><button type="button" class="mb-sm btn btn-primary" onClick="agregar_insumo()"  style="background-color:#000066;cursor:pointer"  >AGREGAR</button></center>
  </div>
</div>

</center>

<div id="agregar_insumo"> </div>
