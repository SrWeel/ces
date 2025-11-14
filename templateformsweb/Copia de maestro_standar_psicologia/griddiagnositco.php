<script language="javascript">
<!--

function grid_extras_<?php echo $this->fie_id;  ?>(enlacep,id_grid,opcionp)
{


if(opcionp==1)
{

  if($('#diagn_ciex').val()=='')
  {

  alert("Ingrese la fecha...");

  return false;

  }


  if($('#diagn_descripcionx').val()=='')
  {

   alert("Ingrese la presion arterial...");

   return false;

  }

  if($('#diagn_tipox').val()=='')
  {

   alert("Ingrese el pulso x minuto...");

   return false;

  }



}



if(opcionp==2)
{



	if (!(confirm('Desea borrar este registro?'))) { 

	  return false;
	}


}



$("#lista_detalles_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/grid_detallediagnostico.php",{

enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
diagn_ciex:$('#diagn_ciex').val(),
diagn_descripcionx:$('#diagn_descripcionx').val(),
diagn_tipox:$('#diagn_tipox').val(),
fie_id:'<?php echo $this->fie_id;  ?>'

 },function(result){       

	$('#diagn_ciex').val("");	
	$('#diagn_descripcionx').val("");	
	$('#diagn_tipox').val("");	 

  });  


$("#lista_detalles_<?php echo $this->fie_id;  ?>").html("Espere un momento...");

}
//-->
</script>

<div class="panel panel-default" >
<div class="panel-body">
  <div class="form-group">
      <div class="col-md-12">
          <input placeholder="CIE" name="diagn_ciex" id="diagn_ciex" class="form-control" value=""  type="text"  >
       </div>
   </div>

<div class="form-group">
<div class="col-md-12">

	<textarea placeholder="Diagnostico" name="diagn_descripcionx" id="diagn_descripcionx"  class="form-control" readonly ></textarea>
	
</div>
</div>

<div class="form-group">
<div class="col-md-12">
	 <select class="form-control" name="diagn_tipox" id="diagn_tipox"  >

                <option value="" >--Seleccion Producto--</option>

<?php
$this->fill_cmb('dns_tipodiagnostico','tipdiag_nombre,tipdiag_nombre','',' order by tipdiag_nombre asc',$DB_gogess);
?>
            </select>
	
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
 //$("#sign_fechax").datepicker({dateFormat: 'yy-mm-dd'});
// $("#hora_valx").wickedpicker({twentyFour: true});
 grid_extras_<?php echo $this->fie_id;  ?>('<?php echo @$this->contenid["conext_enlace"]; ?>',0,0);
 //  End -->
</script>