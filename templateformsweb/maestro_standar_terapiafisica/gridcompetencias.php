<script language="javascript">
<!--

function grid_extras_<?php echo $this->fie_id;  ?>(enlacep,id_grid,opcionp)
{


if(opcionp==1)
{

  if($('#tipcompe_idx').val()=='')
  {

  alert("Ingrese Tipo...");

  return false;

  }


  if($('#pedcompete_dificultadesx').val()=='')
  {

   alert("Ingrese las dificultades especificas...");

   return false;

  }

  if($('#pedcompete_observacionesx').val()=='')
  {

   alert("Ingrese la observaciones...");

   return false;

  }

}



if(opcionp==2)
{



	if (!(confirm('Desea borrar este registro?'))) { 

	  return false;
	}


}



$("#lista_detalles_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/grid_competencias.php",{

enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
tipcompe_idx:$('#tipcompe_idx').val(),
pedcompete_dificultadesx:$('#pedcompete_dificultadesx').val(),
pedcompete_observacionesx:$('#pedcompete_observacionesx').val(),
fie_id:'<?php echo $this->fie_id;  ?>'

 },function(result){       

	$('#tipcompe_idx').val("");	
	$('#pedcompete_dificultadesx').val("");	 
	$('#pedcompete_observacionesx').val("");	

  });  


$("#lista_detalles_<?php echo $this->fie_id;  ?>").html("Espere un momento...");

}
//-->
</script>

<div class="panel panel-default" >
<div class="panel-body">

<div class="form-group">
     <div class="col-md-4">
      <select class="form-control" name="tipcompe_idx" id="tipcompe_idx"  >
         <option value="" >--Seleccion Tipo--</option>
			<?php
			$this->fill_cmb('faesa_tipocompetencia','tipcompe_id,tipcompe_nombre','',' order by tipcompe_id asc',$DB_gogess);
			?>
        </select>
     </div>    
	 <div class="col-md-4">
     <input placeholder="Observaci&oacute;n" name="pedcompete_observacionesx" id="pedcompete_observacionesx" class="form-control" value=""  type="text"  >
     </div>
	 <div class="col-md-4">
     <input placeholder="Dificultades Espec&iacute;ficas" name="pedcompete_dificultadesx" id="pedcompete_dificultadesx" class="form-control" value=""  type="text"  >
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