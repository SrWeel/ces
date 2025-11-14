<script language="javascript">
<!--

function grid_extras(enlacep,id_grid,opcionp)
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

   alert("Ingrese la evolucion...");

   return false;

  }


  if($('#perscripcion_valx').val()=='')
  {

   alert("Ingrese la perscripcion...");

   return false;

  }
  
    if($('#prod_idX').val()=='')
  {

   alert("Ingrese la medicina...");

   return false;

  }


}



if(opcionp==2)
{



	if (!(confirm('Desea borrar este registro?'))) { 

	  return false;
	}


}



$("#lista_detalles").load("templateformsweb/maestro_standar_substandar/grid_detalle.php",{

enlace:enlacep,


idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
fecha_valx:$('#fecha_valx').val(),
hora_valx:$('#hora_valx').val(),
evol_valx:$('#evol_valx').val(),
perscripcion_valx:$('#perscripcion_valx').val(),
prod_idx:$('#prod_idx').val()

 },function(result){       


    $('#fecha_valx').val("");
	$('#hora_valx').val("");	
	$('#evol_valx').val("");	
	$('#perscripcion_valx').val("");	 

  });  


$("#lista_detalles").html("Espere un momento...");

}
//-->
</script>

<div class="panel panel-default" >
  <div class="panel-heading">
    <h3 class="panel-title" style="color:#000033">Detalles extras</h3>
  </div>

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
   <input placeholder="Prescripciones" name="perscripcion_valx" id="perscripcion_valx" class="form-control" value="" maxlength="250" type="text"  >
</div>
</div>

<div class="form-group">
<div class="col-md-12">
 <select class="form-control" name="prod_idx" id="prod_idx"  >

                <option value="" >--Seleccion Producto--</option>

<?php
$this->fill_cmb('efacsistema_producto','prod_id,prod_nombre','',' order by prod_nombre asc',$DB_gogess);
?>
            </select>
</div>
</div>			



<div class="form-group">	

<div class="col-md-12">



<button type="button" class="mb-sm btn btn-primary"  onClick="grid_extras('<?php 

if($this->contenid["conext_enlace"])

{

echo $this->contenid["conext_enlace"];

}

else

{

echo $this->sendvar[$this->fie_sendvar]; 

}

?>',0,1)"  style="background-color:#000066" >AGREGAR</button>



</div>

</div>		

  

  <div id="lista_detalles">
  
  
  </div>

  

  </div>

  

  </div>

<script type="text/javascript">
<!--
 $("#fecha_valx").datepicker({dateFormat: 'yy-mm-dd'});
 $("#hora_valx").wickedpicker({twentyFour: true});
 grid_extras('<?php echo @$this->contenid["conext_enlace"]; ?>',0,0);
 //  End -->
</script>