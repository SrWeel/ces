<script language="javascript">
<!--

function grid_extras_<?php echo $this->fie_id;  ?>(enlacep,id_grid,opcionp)
{


if(opcionp==1)
{

  if($('#gexamfis_opcionx').val()=='')
  {

  alert("Seleccionar opcion...");

  return false;

  }


  if($('#gexamfis_tipox').val()=='')
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



$("#lista_detalles_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/grid_detalleexamenfisico.php",{

enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
gexamfis_opcionx:$('#gexamfis_opcionx').val(),
gexamfis_tipox:$('#gexamfis_tipox').val(),
gexamfis_observacionx:$('#gexamfis_observacionx').val(),
fie_id:'<?php echo $this->fie_id;  ?>'

 },function(result){       

	$('#gexamfis_opcionx').val("");	
	$('#gexamfis_tipox').val("");
	$('#gexamfis_observacionx').val("");	 

  });  


$("#lista_detalles_<?php echo $this->fie_id;  ?>").html("Espere un momento...");

}
//-->
</script>

<div class="panel panel-default" >
<div class="panel-body">

<div class="form-group">
<div class="col-md-4">
	 <select class="form-control" name="gexamfis_opcionx" id="gexamfis_opcionx"  >

                <option value="" >--Seleccion Opcion--</option>

<?php
$this->fill_cmb('dns_opcionexamenfisico','opcexa_nombre,opcexa_nombre','',' order by opcexa_nombre asc',$DB_gogess);
?>
            </select>
	
</div>
<div class="col-md-4">
	 <select class="form-control" name="gexamfis_tipox" id="gexamfis_tipox"  >
                <option value="" >--Seleccion Tipo--</option>

<?php
$this->fill_cmb('dns_tipoorgano','tiporg_nombre,tiporg_nombre','',' order by tiporg_nombre asc',$DB_gogess);
?>
            </select>
	
</div>
<div class="col-md-4">

	<textarea placeholder="Descripci&oacute;n" name="gexamfis_observacionx" id="gexamfis_observacionx"  class="form-control"  ></textarea>
	
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