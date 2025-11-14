<script language="javascript">
<!--

function grid_extras_<?php echo $this->fie_id;  ?>(enlacep,id_grid,opcionp)
{


if(opcionp==1)
{

  if($('#gorgano_opcionx').val()=='')
  {

  alert("Seleccionar opcion...");

  return false;

  }


  if($('#gorgano_tipox').val()=='')
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



$("#lista_detalles_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/grid_detalleorgano.php",{

enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
gorgano_opcionx:$('#gorgano_opcionx').val(),
gorgano_tipox:$('#gorgano_tipox').val(),
gorgano_observacionx:$('#gorgano_observacionx').val(),
fie_id:'<?php echo $this->fie_id;  ?>'

 },function(result){       

	$('#gorgano_opcionx').val("");	
	$('#gorgano_tipox').val("");
	$('#gorgano_observacionx').val("");	 

  });  


$("#lista_detalles_<?php echo $this->fie_id;  ?>").html("Espere un momento...");

}
//-->
</script>

<div class="panel panel-default" >
<div class="panel-body">

<div class="form-group">
<div class="col-md-4">
	 <select class="form-control" name="gorgano_opcionx" id="gorgano_opcionx"  >

                <option value="" >--Seleccion Opcion--</option>

<?php
$this->fill_cmb('dns_opcionorgano','opcorg_nombre,opcorg_nombre','',' order by opcorg_nombre asc',$DB_gogess);
?>
            </select>
	
</div>
<div class="col-md-4">
	 <select class="form-control" name="gorgano_tipox" id="gorgano_tipox"  >
                <option value="" >--Seleccion Tipo--</option>

<?php
$this->fill_cmb('dns_tipoorgano','tiporg_nombre,tiporg_nombre','',' order by tiporg_nombre asc',$DB_gogess);
?>
            </select>
	
</div>
<div class="col-md-4">

	<textarea placeholder="Descripci&oacute;n" name="gorgano_observacionx" id="gorgano_observacionx"  class="form-control"  ></textarea>
	
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