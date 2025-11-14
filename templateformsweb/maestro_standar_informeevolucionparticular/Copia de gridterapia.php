<script language="javascript">
<!--

function grid_extras_<?php echo $this->fie_id;  ?>(enlacep,id_grid,opcionp)
{


if(opcionp==1)
{

  if($('#horat_fechax').val()=='')
  {

  alert("Ingrese la fecha...");

  return false;

  }


  if($('#horat_horaix').val()=='')
  {

   alert("Ingrese la hora inicio...");

   return false;

  }
  
   if($('#horat_horafx').val()=='')
  {

   alert("Ingrese la hora fin...");

   return false;

  }

  if($('#horat_diax').val()=='')
  {

   alert("Ingrese la dia...");

   return false;

  }


  if($('#horat_areax').val()=='')
  {

   alert("Ingrese Area...");

   return false;

  }
  
  
  if($('#horat_procesox').val()=='')
  {
    alert("Ingrese proceso...");

   return false;
  
  }
  
  
    


}



if(opcionp==2)
{



	if (!(confirm('Desea borrar este registro?'))) { 

	  return false;
	}


}



$("#lista_detalles_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/grid_terapia.php",{

enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
horat_fechax:$('#horat_fechax').val(),
horat_horaix:$('#horat_horaix').val(),
horat_horafx:$('#horat_horafx').val(),
horat_areax:$('#horat_areax').val(),
horat_diax:$('#horat_diax').val(),
horat_procesox:$('#horat_procesox').val(),
fie_id:'<?php echo $this->fie_id;  ?>'

 },function(result){       


    $('#horat_fechax').val("");
	$('#horat_horaix').val("");	
	$('#horat_horafx').val("");	
	$('#horat_areax').val("");
	$('#horat_procesox').val("");
	$('#horat_diax').val("");
	//$('#prod_descripcionx').val("");				 

  });  


$("#lista_detalles_<?php echo $this->fie_id;  ?>").html("Espere un momento...");

}
//-->
</script>

<div class="panel panel-default" >
<div class="panel-body">
  <div class="form-group">
      <div class="col-md-3">
       <input placeholder="Fecha" name="horat_fechax" id="horat_fechax" class="form-control" value=""  type="text"  >
       </div>
	   <div class="col-md-3">
	   <input placeholder="Hora inicio" name="horat_horaix" id="horat_horaix" class="form-control timepicker" value=""  type="text"   >
	
       </div>
	   <div class="col-md-3">
	   <input placeholder="Hora fin" name="horat_horafx" id="horat_horafx" class="form-control timepicker" value=""  type="text"   >
	
       </div>
	   <div class="col-md-3">
	   <select class="form-control" name="horat_diax" id="horat_diax"  >
                <option value="" >--Seleccion D&iacute;a--</option>

<?php
$this->fill_cmb('dns_listadia','dia_id,dia_nombre','',' order by dia_id asc',$DB_gogess);
?>
            </select>
	
       </div>
  </div>


<div class="form-group">
<div class="col-md-12">
	<input placeholder="Area" name="horat_areax" id="horat_areax" class="form-control" value=""  type="text"  >
</div>
</div>

<div class="form-group">
<div class="col-md-12">
   <input placeholder="Proceso" name="horat_procesox" id="horat_procesox" class="form-control" value="" type="text"  >   
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
 $("#horat_fechax").datepicker({dateFormat: 'yy-mm-dd'});
 $("#horat_horaix").wickedpicker({twentyFour: true});
 $("#horat_horafx").wickedpicker({twentyFour: true});
 grid_extras_<?php echo $this->fie_id;  ?>('<?php echo @$this->contenid["atenc_enlace"]; ?>',0,0);
 //  End -->
</script>