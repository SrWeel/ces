<script language="javascript">
<!--

function grid_extras_<?php echo $this->fie_id;  ?>(enlacep,id_grid,opcionp)
{


if(opcionp==1)
{



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
horat_procesox:$('#horat_procesox').val(),
fie_id:'<?php echo $this->fie_id;  ?>'

 },function(result){       


    $('#horat_fechax').val("");
	$('#horat_horaix').val("");	
	$('#horat_horafx').val("");	
	$('#horat_areax').val("");
	$('#horat_procesox').val("");
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
	<!-- <input placeholder="Area" name="horat_areax" id="horat_areax" class="form-control" value=""  type="text"  > -->
	 <select class="form-control" name="horat_areax" id="horat_areax"  >
         <option value="" >--Seleccion Tipo--</option>
			<?php
			$this->fill_cmb('efacsistema_producto','prod_nombre,prod_nombre','',' order by prod_nombre asc',$DB_gogess);
			?>
     </select>
	
</div>
</div>

<div class="form-group">
<div class="col-md-12">
    <textarea placeholder="Observaci&oacute;n" name="horat_procesox" id="horat_procesox" class="form-control" ></textarea>
	<input placeholder="Fecha" name="horat_fechax" id="horat_fechax" class="form-control" value=""  type="text"  >
    <input placeholder="Hora inicio" name="horat_horaix" id="horat_horaix" class="form-control timepicker" value=""  type="text"   >
	<input placeholder="Hora fin" name="horat_horafx" id="horat_horafx" class="form-control timepicker" value=""  type="text"   >
</div>
<div class="col-md-12">
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td onclick="abrir_standar('templateformsweb/maestro_standar_atencion/calendario.php','CALENDARIO','divBody_calendario','divDialog_calendario',800,700,$('#clie_id').val(),0,0,0,0,0,0)" style="cursor:pointer"><img src="images/calendario-actividades.png" /></td>
    </tr>
  </table>
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
 //$("#horat_fechax").datepicker({dateFormat: 'yy-mm-dd'});
// $("#horat_horaix").wickedpicker({twentyFour: true});
// $("#horat_horafx").wickedpicker({twentyFour: true});
 grid_extras_<?php echo $this->fie_id;  ?>('<?php echo @$this->contenid["atenc_enlace"]; ?>',0,0);
 //  End -->
</script>