<?php
$nombre_grid="grid_gridanfamiliar.php";
$campo_idenlace="clie_enlace";
?>
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


$("#lista_detalles_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/<?php echo $nombre_grid; ?>",{

enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
anamf_nombrex:$('#anamf_nombrex').val(),
anamf_profesionx:$('#anamf_profesionx').val(),
anamf_parentescox:$('#anamf_parentescox').val(),
anamf_observacionx:$('#anamf_observacionx').val(),
anamf_edadx:$('#anamf_edadx').val(),
fie_id:'<?php echo $this->fie_id;  ?>'

 },function(result){       


    $('#anamf_nombrex').val("");
	$('#anamf_profesionx').val("");	
	$('#anamf_parentescox').val("");	
	$('#anamf_observacionx').val("");	
	$('#anamf_edadx').val("");
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
          <input placeholder="Nombre" name="anamf_nombrex" id="anamf_nombrex" class="form-control" value=""  type="text"  >
      </div>
	  <div class="col-md-4">
          <input placeholder="Profesi&oacute;n" name="anamf_profesionx" id="anamf_profesionx" class="form-control" value=""  type="text"  >
      </div>
	  <div class="col-md-4">
          <input placeholder="Parentesco" name="anamf_parentescox" id="anamf_parentescox" class="form-control" value=""  type="text"  >
      </div>
  </div>	  
  <div class="form-group">	  
	  <div class="col-md-4">
		<textarea placeholder="Observaci&oacute;n" name="anamf_observacionx" id="anamf_observacionx"  class="form-control"  ></textarea>
      </div>
	  <div class="col-md-4">
	    <input placeholder="Edad" name="anamf_edadx" id="anamf_edadx" class="form-control" value=""  type="text"  >
      </div>
   </div>

<div class="form-group">	
<div class="col-md-12">

<button type="button" class="mb-sm btn btn-primary"  onClick="grid_extras_<?php echo $this->fie_id;  ?>('<?php 

if($this->contenid[$campo_idenlace])

{

echo $this->contenid[$campo_idenlace];

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
// $("#fecha_valx").datepicker({dateFormat: 'yy-mm-dd'});
 //$("#hora_valx").wickedpicker({twentyFour: true});
 grid_extras_<?php echo $this->fie_id;  ?>('<?php echo @$this->contenid[$campo_idenlace]; ?>',0,0);
 //  End -->
</script>