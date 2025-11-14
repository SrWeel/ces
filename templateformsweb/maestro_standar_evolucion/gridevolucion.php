<script language="javascript">
<!--

function grid_editar_<?php echo $this->fie_id;  ?>(enlacep,id_grid,opcionp)
{

$("#editar_detalles_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/editar.php",{
enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
evoludet_idx:id_grid

 },function(result){       

	$('#evoludet_idx').val($('#evoludet_idxval').val());
	$('#evoludet_fechax').val($('#evoludet_fechaxval').val());
	$('#evoludet_horax').val($('#evoludet_horaxval').val());
	$('#evoludet_notasx').val($('#evoludet_notasxval').val());
	$('#evoludet_farmaindicax').val($('#evoludet_farmaindicaxval').val());
    $('#evoludet_farmaotrosx').val($('#evoludet_farmaotrosxval').val());

  });  

$("#editar_detalles_<?php echo $this->fie_id;  ?>").html("Espere un momento...");

}



function grid_extras_<?php echo $this->fie_id;  ?>(enlacep,id_grid,opcionp)
{


if(opcionp==1)
{

  if($('#evoludet_fechax').val()=='')

  {



  alert("Ingrese la fecha...");

  return false;



  }





  if($('#evoludet_horax').val()=='')

  {



   alert("Ingrese la hora...");

   return false;



  }



  if($('#evoludet_notasx').val()=='')

  {



   alert("Ingrese nota...");



   return false;



  }



  if($('#evoludet_farmaindicax').val()=='')

  {



   alert("Ingrese farmaco e indicaciones(Enfermeria)...");



   return false;



  }



  if($('#evoludet_farmaotrosx').val()=='')

  {



   alert("Ingrese farmaco e indicaciones(Farmacos)...");



   return false;



  }





}


if(opcionp==2)
{


	if (!(confirm('Desea borrar este registro?'))) { 



	  return false;

	}





}







$("#lista_detalles_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/grid_detalleevolucion.php",{


enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
evoludet_idx:$('#evoludet_idx').val(),
evoludet_fechax:$('#evoludet_fechax').val(),
evoludet_horax:$('#evoludet_horax').val(),
evoludet_notasx:$('#evoludet_notasx').val(),
evoludet_farmaindicax:$('#evoludet_farmaindicax').val(),
evoludet_farmaotrosx:$('#evoludet_farmaotrosx').val(),
fechai:$('#fechai').val(),
fechaf:$('#fechaf').val(),
fie_id:'<?php echo $this->fie_id;  ?>',
sess_id:'<?php echo $_SESSION['ces1313777_sessid_inicio']; ?>'


 },function(result){       


    $('#evoludet_idx').val("");
	$('#evoludet_fechax').val("");	
	$('#evoludet_horax').val("");	
	$('#evoludet_notasx').val("");	 
	$('#evoludet_farmaindicax').val("");	
	$('#evoludet_farmaotrosx').val("");
    $("#form_faesa_evolucion" ).submit();


  });  

$("#lista_detalles_<?php echo $this->fie_id;  ?>").html("Espere un momento...");

}
//-->
</script>

<div class="panel panel-default" >
<div class="panel-body">
<div class="form-group">

     <div class="col-md-4">
     <input name="evoludet_idx" type="hidden" id="evoludet_idx" value="0" />
	 <label>Fecha</label>
     <input placeholder="Fecha" name="evoludet_fechax" id="evoludet_fechax" class="form-control" value=""  type="text"  >

     </div>

     <div class="col-md-4">
	 <label>Hora</label>
	 <select class="form-control" name="evoludet_horax" id="evoludet_horax"  >
         <option value="" >--Seleccion Hora--</option>
			<?php
			$this->fill_cmb('app_horas','hora_tiempo,hora_nombre','',' order by hora_orden asc',$DB_gogess);
			?>
        </select>

     </div>

	 <div class="col-md-4">
     <label>Nota de evoluci&oacute;n</label>
	 <textarea placeholder="Nota" name="evoludet_notasx" id="evoludet_notasx"  class="form-control" ></textarea>

	 </div>

</div>



<div class="form-group">
<div class="col-md-6">
<label>Farmacoterapia e Indicaciones</label>
    <textarea placeholder="Farmacos e indicaciones" name="evoludet_farmaindicax" id="evoludet_farmaindicax"  class="form-control" ></textarea>
</div>

<div class="col-md-6">
<label>Aministr. Farmacos y Otros</label>
     <textarea placeholder="Farmacos y otros" name="evoludet_farmaotrosx" id="evoludet_farmaotrosx"  class="form-control" ></textarea>
</div>
</div>


<div class="form-group">	
<div class="col-md-12">


<button type="button" class="mb-sm btn btn-primary"  onClick="grid_extras_<?php echo $this->fie_id;  ?>('<?php 
if($this->contenid["evolu_enlace"])
{

echo $this->contenid["evolu_enlace"];

}
else
{
echo $this->sendvar[$this->fie_sendvar]; 
}
?>',0,1)"  style="background-color:#000066" >AGREGAR / ACTUALIZAR</button>
</div>
</div>		
<div id="lista_detalles_<?php echo $this->fie_id;  ?>">
</div>

  </div>

  </div>

<div id="editar_detalles_<?php echo $this->fie_id;  ?>"></div>

<script type="text/javascript">

<!--

 $("#evoludet_fechax").datepicker({dateFormat: 'yy-mm-dd'});

// $("#hora_valx").wickedpicker({twentyFour: true});

 grid_extras_<?php echo $this->fie_id;  ?>('<?php echo @$this->contenid["evolu_enlace"]; ?>',0,0);
 
 function actualiza_form()
 {
 
    grid_extras_<?php echo $this->fie_id;  ?>('<?php echo @$this->contenid["evolu_enlace"]; ?>',0,0);
 
 }

 //  End -->

</script>