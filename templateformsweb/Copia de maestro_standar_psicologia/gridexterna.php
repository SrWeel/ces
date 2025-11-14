<script language="javascript">
<!--

function grid_extras_<?php echo $this->fie_id;  ?>(enlacep,id_grid,opcionp)
{


if(opcionp==1)
{

  if($('#fecha_valx').val()=='')
  {

  alert("Ingrese la fecha...");

  return false;

  }


  if($('#hora_valx').val()=='')
  {

   alert("Ingrese la hora...");

   return false;

  }

  if($('#evol_valx').val()=='')
  {

   alert("Ingrese la evoluci\u00f3n...");

   return false;

  }


  if($('#inven_descripcionx').val()=='')
  {

   alert("Ingrese la perscripci\u00f3n...");

   return false;

  }
  
  
  if($('#inven_cantidadx').val()=='')
  {
    alert("Ingrese la cantidad...");

   return false;
  
  }
  
  
    


}



if(opcionp==2)
{



	if (!(confirm('Desea borrar este registro?'))) { 

	  return false;
	}


}



$("#lista_detalles_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/grid_detalle.php",{

enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
fecha_valx:$('#fecha_valx').val(),
hora_valx:$('#hora_valx').val(),
evol_valx:$('#evol_valx').val(),
inven_descripcionx:$('#inven_descripcionx').val(),
inven_cantidadx:$('#inven_cantidadx').val(),
inven_valorunitx:$('#inven_valorunitx').val(),
inven_codigox:$('#inven_codigox').val(),
fie_id:'<?php echo $this->fie_id;  ?>'

 },function(result){       


    $('#fecha_valx').val("");
	$('#hora_valx').val("");	
	$('#evol_valx').val("");	
	$('#inven_descripcionx').val("");
	$('#inven_cantidadx').val("");
	$('#inven_valorunitx').val("");
	$('#inven_codigox').val("");
	//$('#prod_descripcionx').val("");				 

  });  


$("#lista_detalles_<?php echo $this->fie_id;  ?>").html("Espere un momento...");

}
//-->
</script>

<div class="panel panel-default" >
<div class="panel-body">
  <div class="form-group">
      <div class="col-md-12">
          <input placeholder="Fecha" name="fecha_valx" id="fecha_valx" class="form-control" value=""  type="text"  >
       </div>
   </div>

<div class="form-group">
<div class="col-md-12">
	<input placeholder="Hora" name="hora_valx" id="hora_valx" class="form-control timepicker" value=""  type="text"   >
	
</div>
</div>

<div class="form-group">
<div class="col-md-12">
	<input placeholder="Evolucion" name="evol_valx" id="evol_valx" class="form-control" value=""  type="text"  >
</div>
</div>

<div class="form-group">
<div class="col-md-12">
   <input placeholder="Prescripciones" name="inven_descripcionx" id="inven_descripcionx" class="form-control" value="" type="text"  >
   
   <input name="inven_codigox" id="inven_codigox" class="form-control" value=""  type="hidden"  >
   <input name="inven_valorunitx" id="inven_valorunitx" class="form-control" value=""  type="hidden"  >
   
</div>
</div>

<div class="form-group">
<div class="col-md-12">
	<input placeholder="Cantidad" name="inven_cantidadx" id="inven_cantidadx" class="form-control" value=""  type="text"  >
</div>
</div>
		

<div class="form-group">	

<div class="col-md-12">



<button type="button" class="mb-sm btn btn-primary"  onClick="grid_extras_<?php echo $this->fie_id;  ?>('<?php 

if($this->contenid["atenc_id"])

{

echo $this->contenid["atenc_id"];

}

else

{

echo $this->sendvar[$this->fie_sendvar]; 

}

?>',0,1)"  style="background-color:#000066" >AGREGAR</button>



</div>

</div>		

  

  <div id="lista_detalles_<?php echo $this->fie_id;  ?>">
  
  
  </div>

  

  </div>

  

  </div>

<script type="text/javascript">
<!--
 $("#fecha_valx").datepicker({dateFormat: 'yy-mm-dd'});
 $("#hora_valx").wickedpicker({twentyFour: true});
 grid_extras_<?php echo $this->fie_id;  ?>('<?php echo @$this->contenid["atenc_id"]; ?>',0,0);
 //  End -->
</script>