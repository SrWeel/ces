<script language="javascript">
<!--

function grid_extras_<?php echo $this->fie_id;  ?>(enlacep,id_grid,opcionp)
{


if(opcionp==1)
{

  if($('#antep_informacionx').val()=='')
  {

  alert("Seleccionar opcion...");

  return false;

  }


  if($('#antep_descripcionx').val()=='')
  {

   alert("Ingrese descripcion...");

   return false;

  }

}



if(opcionp==2)
{



	if (!(confirm('Desea borrar este registro?'))) { 

	  return false;
	}


}



$("#lista_detalles_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/grid_detalleantecedentes.php",{

enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
antep_informacionx:$('#antep_informacionx').val(),
antep_descripcionx:$('#antep_descripcionx').val(),
fie_id:'<?php echo $this->fie_id;  ?>'

 },function(result){       

	$('#antep_informacionx').val("");	
	$('#antep_descripcionx').val("");	 

  });  


$("#lista_detalles_<?php echo $this->fie_id;  ?>").html("Espere un momento...");

}
//-->
</script>

<div class="panel panel-default" >
<div class="panel-body">

<div class="form-group">
<div class="col-md-6">
	 <select class="form-control" name="dantep_informacionx" id="antep_informacionx"  >

                <option value="" >--Seleccion Tipo--</option>

<?php
$this->fill_cmb('dns_opcionantecedentes','opcioante_nombre,opcioante_nombre','',' order by opcioante_nombre asc',$DB_gogess);
?>
            </select>
	
</div>
<div class="col-md-6">

	<textarea placeholder="Descripci&oacute;n" name="antep_descripcionx" id="antep_descripcionx"  class="form-control"  ></textarea>
	
</div>
</div>


<div class="form-group">	
<div class="col-md-12">

<button type="button" class="mb-sm btn btn-primary"  onClick="grid_extras_<?php echo $this->fie_id;  ?>('<?php 

if($this->contenid["anam_enlace"])

{

echo $this->contenid["anam_enlace"];

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
 //$("#sign_fechax").datepicker({dateFormat: 'yy-mm-dd'});
// $("#hora_valx").wickedpicker({twentyFour: true});
 grid_extras_<?php echo $this->fie_id;  ?>('<?php echo @$this->contenid["anam_enlace"]; ?>',0,0);
 //  End -->
</script>