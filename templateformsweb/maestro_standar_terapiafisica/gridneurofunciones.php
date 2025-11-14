<script language="javascript">
<!--

function grid_extras_<?php echo $this->fie_id;  ?>(enlacep,id_grid,opcionp)
{


if(opcionp==1)
{

  if($('#areev_idx').val()=='')
  {

  alert("Ingrese Area...");

  return false;

  }


  if($('#pedneuro_marcadorx').val()=='')
  {

   alert("Ingrese el marcador...");

   return false;

  }

  if($('#pedneuro_observacionesx').val()=='')
  {

   alert("Ingrese la observacion...");

   return false;

  }

}



if(opcionp==2)
{



	if (!(confirm('Desea borrar este registro?'))) { 

	  return false;
	}


}



$("#lista_detalles_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/grid_neurofunciones.php",{

enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
areev_idx:$('#areev_idx').val(),
pedneuro_marcadorx:$('#pedneuro_marcadorx').val(),
pedneuro_observacionesx:$('#pedneuro_observacionesx').val(),
fie_id:'<?php echo $this->fie_id;  ?>'

 },function(result){       

	$('#areev_idx').val("");	
	$('#pedneuro_marcadorx').val("");	 
	$('#pedneuro_observacionesx').val("");	

  });  


$("#lista_detalles_<?php echo $this->fie_id;  ?>").html("Espere un momento...");

}
//-->
</script>

<div class="panel panel-default" >
<div class="panel-body">

<div class="form-group">
     <div class="col-md-4">
      <select class="form-control" name="areev_idx" id="areev_idx"  >
         <option value="" >--Seleccion Producto--</option>
			<?php
			$this->fill_cmb('faesa_areaev','areev_id,areev_nombre','',' order by areev_id asc',$DB_gogess);
			?>
        </select>
     </div>
     <div class="col-md-4">
     <input placeholder="Marcador" name="pedneuro_marcadorx" id="pedneuro_marcadorx" class="form-control" value=""  type="text"  >
     </div>
	 <div class="col-md-4">
     <input placeholder="Observaci&oacute;n" name="pedneuro_observacionesx" id="pedneuro_observacionesx" class="form-control" value=""  type="text"  >
     </div>
</div>

		

<div class="form-group">	

<div class="col-md-12">



<button type="button" class="mb-sm btn btn-primary"  onClick="grid_extras_<?php echo $this->fie_id;  ?>('<?php 

if($this->contenid["pedago_enlace"])

{

echo $this->contenid["pedago_enlace"];

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
 grid_extras_<?php echo $this->fie_id;  ?>('<?php echo @$this->contenid["pedago_enlace"]; ?>',0,0);
 //  End -->
</script>