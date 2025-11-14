<script language="javascript">
<!--

function grid_extras_<?php echo $this->fie_id;  ?>(enlacep,id_grid,opcionp)
{


if(opcionp==1)
{

  if($('#prod_codigox').val()=='')
  {

  alert("Ingrese codigo...");

  return false;

  }


}



if(opcionp==2)
{



	if (!(confirm('Desea borrar este registro?'))) { 

	  return false;
	}


}



$("#lista_detalles_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/grid_gridcuadrobasico.php",{

enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
prod_codigox:$('#prod_codigox').val(),
prod_descripcionx:$('#prod_descripcionx').val(),
prod_preciox:$('#prod_preciox').val(),
fie_id:'<?php echo $this->fie_id;  ?>'

 },function(result){       


    $('#prod_codigox').val("");
	$('#prod_descripcionx').val("");	
	$('#prod_preciox').val("");	
	//$('#prod_codigox').val("");
	//$('#prod_descripcionx').val("");				 

  });  


$("#lista_detalles_<?php echo $this->fie_id;  ?>").html("Espere un momento...");

}
//-->
</script>

<div class="panel panel-default" >
<div class="panel-body">
  <div class="form-group">
      <div class="col-md-4">
          <input placeholder="C&oacute;digo" name="prod_codigox" id="prod_codigox" class="form-control" value=""  type="text"  >
      </div>
	  <div class="col-md-4">
		<textarea placeholder="Descripci&oacute;n" name="prod_descripcionx" id="prod_descripcionx"  class="form-control" readonly ></textarea>
      </div>
	  <div class="col-md-4">
	    <input placeholder="Precio" name="prod_preciox" id="prod_preciox" class="form-control" value=""  type="text"  readonly >
      </div>
   </div>

<div class="form-group">	
<div class="col-md-12">

<button type="button" class="mb-sm btn btn-primary"  onClick="grid_extras_<?php echo $this->fie_id;  ?>('<?php 

if($this->contenid["atenc_enlace"])

{

echo $this->contenid["atenc_enlace"];

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
 grid_extras_<?php echo $this->fie_id;  ?>('<?php echo @$this->contenid["atenc_enlace"]; ?>',0,0);
 //  End -->
</script>