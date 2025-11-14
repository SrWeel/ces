<?php
$nombre_grid="grid_representantes.php";
$campo_idenlace="clie_enlace";
?>
<script language="javascript">
<!--


function grid_editar_<?php echo $this->fie_id;  ?>(enlacep,id_grid,opcionp)
{

  $("#editar_detalles_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/editar.php",{

enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
repres_idx:id_grid

 },function(result){       
    
	
	
	$('#repres_idx').val($('#repres_idxval').val());
	$('#tipoident_codigox').val($('#tipoident_codigoxval').val());
    $('#repres_cix').val($('#repres_cixval').val());
    $('#repres_nombrex').val($('#repres_nombrexval').val());
	$('#repres_telefonox').val($('#repres_telefonoxval').val());	
	$('#repres_parentescox').val($('#repres_parentescoxval').val());	
	$('#repres_observacionx').val($('#repres_observacionxval').val());	

				 

  });  


$("#editar_detalles_<?php echo $this->fie_id;  ?>").html("Espere un momento...");
  

}

function grid_extras_<?php echo $this->fie_id;  ?>(enlacep,id_grid,opcionp)
{


if(opcionp==1)
{



if($('#tipoident_codigox').val()=='')
  {
    alert("Tipo documento...");
    return false;
  
  }
 
  if($('#repres_cix').val()=='')
  {

  alert("Ingrese el CI...");

  return false;

  }

  if($('#repres_nombrex').val()=='')
  {

  alert("Ingrese el nombre...");

  return false;

  }
  
  if($('#repres_telefonox').val()=='')
  {

  alert("Ingrese el nombre...");

  return false;

  }

  if($('#repres_parentescox').val()=='')
  {

  alert("Ingrese el nombre...");

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
repres_idx:$('#repres_idx').val(),
tipoident_codigox:$('#tipoident_codigox').val(),
repres_cix:$('#repres_cix').val(),
repres_nombrex:$('#repres_nombrex').val(),
repres_telefonox:$('#repres_telefonox').val(),
repres_parentescox:$('#repres_parentescox').val(),
repres_observacionx:$('#repres_observacionx').val(),
fie_id:'<?php echo $this->fie_id;  ?>',
usua_idx:$('#usua_idrep').val()

 },function(result){       
    
	
	if($('#si_ci').val()==1)
	{
	
	$('#tipoident_codigox').val("");
    $('#repres_cix').val("");
    $('#repres_nombrex').val("");
	$('#repres_telefonox').val("");	
	$('#repres_parentescox').val("");	
	$('#repres_observacionx').val("");	
	
	}
				 

  });  


$("#lista_detalles_<?php echo $this->fie_id;  ?>").html("Espere un momento...");

}
//-->
</script>

<div class="panel panel-default" >
<div class="panel-body">
  <div class="form-group">
      <div class="col-md-4">
	      <select class="form-control" name="tipoident_codigox" id="tipoident_codigox"  >
           <option value="" >--Seleccion Producto--</option>
			<?php
			$this->fill_cmb('efacfactura_tipoidentificacion','tipoident_codigo,tipoident_nombre','',' order by tipoident_nombre asc',$DB_gogess);
			?>
          </select>
		</div>  
	  <div class="col-md-4">	
          <input placeholder="CI" name="repres_cix" id="repres_cix" class="form-control" value=""  type="text"  >
      </div>
      <div class="col-md-4">
          <input placeholder="Nombre" name="repres_nombrex" id="repres_nombrex" class="form-control" value=""  type="text"  >
      </div>
	  

  </div>	  
  <div class="form-group">	
      <div class="col-md-4">
          <input placeholder="Tel&eacute;fono" name="repres_telefonox" id="repres_telefonox" class="form-control" value=""  type="text"  >
      </div>
  	  <div class="col-md-4">
          <input placeholder="Parentesco" name="repres_parentescox" id="repres_parentescox" class="form-control" value=""  type="text"  >
      </div>  
	  <div class="col-md-4">
		<textarea placeholder="Observaci&oacute;n" name="repres_observacionx" id="repres_observacionx"  class="form-control"  ></textarea>
        <input name="usua_idrep" type="hidden" id="usua_idrep" value="<?php echo $_SESSION['ces1313777_sessid_inicio']; ?>" />
		<input name="repres_idx" type="hidden" id="repres_idx" value="0" />
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
  
<div id="editar_detalles_<?php echo $this->fie_id;  ?>"></div>

<script type="text/javascript">
<!--
// $("#fecha_valx").datepicker({dateFormat: 'yy-mm-dd'});
 //$("#hora_valx").wickedpicker({twentyFour: true});
 grid_extras_<?php echo $this->fie_id;  ?>('<?php echo @$this->contenid[$campo_idenlace]; ?>',0,0);
 //  End -->
</script>