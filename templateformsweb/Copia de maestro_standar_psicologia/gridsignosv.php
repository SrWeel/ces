<script language="javascript">
<!--

function grid_extras_<?php echo $this->fie_id;  ?>(enlacep,id_grid,opcionp)
{


if(opcionp==1)
{

  if($('#sign_fechax').val()=='')
  {

  alert("Ingrese la fecha...");

  return false;

  }


  if($('#sign_presionarterialx').val()=='')
  {

   alert("Ingrese la presion arterial...");

   return false;

  }

  if($('#sign_pulsoxminutox').val()=='')
  {

   alert("Ingrese el pulso x minuto...");

   return false;

  }


  if($('#sign_temperaturax').val()=='')
  {

   alert("Ingrese la temperatura...");

   return false;

  }



}



if(opcionp==2)
{



	if (!(confirm('Desea borrar este registro?'))) { 

	  return false;
	}


}



$("#lista_detalles_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/grid_detallesignosv.php",{

enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
sign_fechax:$('#sign_fechax').val(),
sign_presionarterialx:$('#sign_presionarterialx').val(),
sign_pulsoxminutox:$('#sign_pulsoxminutox').val(),
sign_temperaturax:$('#sign_temperaturax').val(),
fie_id:'<?php echo $this->fie_id;  ?>'

 },function(result){       

	$('#sign_presionarterialx').val("");	
	$('#sign_pulsoxminutox').val("");	
	$('#sign_temperaturax').val("");	 

  });  


$("#lista_detalles_<?php echo $this->fie_id;  ?>").html("Espere un momento...");

}
//-->
</script>

<div class="panel panel-default" >
<div class="panel-body">
  <div class="form-group">
      <div class="col-md-12">
          <input placeholder="Fecha" name="sign_fechax" id="sign_fechax" class="form-control" value=""  type="text"  >
       </div>
   </div>

<div class="form-group">
<div class="col-md-12">
	<input placeholder="Presion arterial" name="sign_presionarterialx" id="sign_presionarterialx" class="form-control" value=""  type="text"   >
	
</div>
</div>

<div class="form-group">
<div class="col-md-12">
	<input placeholder="Pulsos por minuto" name="sign_pulsoxminutox" id="sign_pulsoxminutox" class="form-control" value=""  type="text"  >
</div>
</div>

<div class="form-group">
<div class="col-md-12">
   <input placeholder="Temperatura C" name="sign_temperaturax" id="sign_temperaturax" class="form-control" value="" maxlength="250" type="text"  >
</div>
</div>
		

<div class="form-group">	

<div class="col-md-12">



<button type="button" class="mb-sm btn btn-primary"  onClick="grid_extras_<?php echo $this->fie_id;  ?>('<?php 

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

  

  <div id="lista_detalles_<?php echo $this->fie_id;  ?>">
  
  
  </div>

  

  </div>

  

  </div>

<script type="text/javascript">
<!--
 $("#sign_fechax").datepicker({dateFormat: 'yy-mm-dd'});
// $("#hora_valx").wickedpicker({twentyFour: true});
 grid_extras_<?php echo $this->fie_id;  ?>('<?php echo @$this->contenid["conext_enlace"]; ?>',0,0);
 //  End -->
</script>