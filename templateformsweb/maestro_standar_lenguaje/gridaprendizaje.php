<script language="javascript">
<!--

function grid_extras_<?php echo $this->fie_id;  ?>(enlacep,id_grid,opcionp)
{


if(opcionp==1)
{

  if($('#tipoa_idx').val()=='')
  {

  alert("Ingrese Tipo...");

  return false;

  }


  if($('#pedaprendiz_porcentajex').val()=='')
  {

   alert("Ingrese porcentaje...");

   return false;

  }

  if($('#pedaprendiz_apreciacionx').val()=='')
  {

   alert("Ingrese apreciacion...");

   return false;

  }

}



if(opcionp==2)
{



	if (!(confirm('Desea borrar este registro?'))) { 

	  return false;
	}


}



$("#lista_detalles_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/grid_aprendizaje.php",{

enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
tipoa_idx:$('#tipoa_idx').val(),
pedaprendiz_porcentajex:$('#pedaprendiz_porcentajex').val(),
pedaprendiz_apreciacionx:$('#pedaprendiz_apreciacionx').val(),
fie_id:'<?php echo $this->fie_id;  ?>'

 },function(result){       

	$('#tipoa_idx').val("");	
	$('#pedaprendiz_porcentajex').val("");	 
	$('#pedaprendiz_apreciacionx').val("");	

  });  


$("#lista_detalles_<?php echo $this->fie_id;  ?>").html("Espere un momento...");

}
//-->
</script>

<div class="panel panel-default" >
<div class="panel-body">

<div class="form-group">
     <div class="col-md-4">
      <select class="form-control" name="tipoa_idx" id="tipoa_idx"  >
         <option value="" >--Seleccion Tipo--</option>
			<?php
			$this->fill_cmb('faesa_tipoarea2','tipoa_id,tipoa_nombre','',' order by tipoa_id asc',$DB_gogess);
			?>
        </select>
     </div>    
	 <div class="col-md-4">
   <input placeholder="Porcentaje" name="pedaprendiz_porcentajex" id="pedaprendiz_porcentajex" class="form-control" value=""  type="text"  >
     </div>
	 <div class="col-md-4">
     <input placeholder="Apreciaci&oacute;n" name="pedaprendiz_apreciacionx" id="pedaprendiz_apreciacionx" class="form-control" value=""  type="text"  >
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