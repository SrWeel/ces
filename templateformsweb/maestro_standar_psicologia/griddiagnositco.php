<?php
//--------------------------------------------------
$campos_dataedit=array();
$campos_dataedit=explode(",",$this->fie_tablasubgridcampos);
$campo_id=$this->fie_tablasubcampoid;

$fie_tblcombogrid=$this->fie_tblcombogrid;
$fie_campoidcombogrid=$this->fie_campoidcombogrid;

$campos_validaciongrid=array();
$campos_validaciongrid=explode(",",$this->fie_camposobligatoriosgrid);

$fie_tituloscamposgrid=array();
$fie_tituloscamposgrid=explode(",",$this->fie_tituloscamposgrid);


?>
<script language="javascript">
<!--

function grid_editar_<?php echo $this->fie_id;  ?>(enlacep,id_grid,opcionp)
{

$("#editar_detalles_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/editar_standar.php",{
enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
fie_id:'<?php echo $this->fie_id;  ?>',
<?php echo $campo_id; ?>x:id_grid

 },function(result){       
	$('#<?php echo $campo_id; ?>x').val($('#<?php echo $campo_id; ?>xval').val());
	<?php
	for($i=0;$i<count($campos_dataedit);$i++)
	 {
		 echo "$('#".$campos_dataedit[$i]."x').val($('#".$campos_dataedit[$i]."xval').val());";
	 }
	?>

  });  

$("#editar_detalles_<?php echo $this->fie_id;  ?>").html("Espere un momento...");

}





function grid_extras_<?php echo $this->fie_id;  ?>(enlacep,id_grid,opcionp)
{

if(opcionp==1)
{
//validaciones
   <?php
	for($i=0;$i<count($campos_validaciongrid);$i++)
	 {
		 echo "		 
		  if($('#".$campos_validaciongrid[$i]."x').val()=='')
		  {
		   var titulo_data='".utf8_encode($fie_tituloscamposgrid[$i])."';
		   alert('Campo Obligarorio ('+titulo_data+'))...');
		   return false;
		  }
		 ";
		 
	 }
	?>
  
}


if(opcionp==2)
{

	if (!(confirm('Desea borrar este registro?'))) { 
	  return false;
	}

}


$("#lista_detalles_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/grid_interrelaciones.php",{

enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
<?php echo $campo_id; ?>x:$('#<?php echo $campo_id; ?>x').val(),
<?php
for($i=0;$i<count($campos_dataedit);$i++)
	 {
	    echo $campos_dataedit[$i]."x:$('#".$campos_dataedit[$i]."x').val(),
		";
	 }
?>
fie_id:'<?php echo $this->fie_id;  ?>',
sess_id:'<?php echo $_SESSION['ces1313777_sessid_inicio']; ?>'

 },function(result){       
	<?php
	echo " $('#".$campo_id."x').val(''); 
	";
    for($i=0;$i<count($campos_dataedit);$i++)
	 {
		echo " $('#".$campos_dataedit[$i]."x').val(''); 
		";
	 }
     ?>	

  });  

$("#lista_detalles_<?php echo $this->fie_id;  ?>").html("Espere un momento...");

}
//-->
</script>

<div class="panel panel-default" >
<div class="panel-body">
<div class="form-group">



     <div class="col-md-4">

	 <textarea placeholder="Diagnostico" name="diagn_criteriodiagnosticox" id="diagn_criteriodiagnosticox"  class="form-control"  ></textarea>

     </div>

	 <div class="col-md-4">

	  <select class="form-control" name="marcps_idx" id="marcps_idx"  >

       <option value="" >--Seleccion Marcador--</option>



		<?php

		$this->fill_cmb('faesa_marcadorps','marcps_id,marcps_nombre','',' order by marcps_id asc',$DB_gogess);

		?>

       </select>

	 

      </div>

	  <div class="col-md-4">

     <input placeholder="Observaci&oacute;n" name="diagn_observacionx" id="diagn_observacionx" class="form-control" value=""  type="text"  >

      <input name="<?php echo $campo_id; ?>x" type="hidden" id="<?php echo $campo_id; ?>x" value="0" />
      </div>

</div>


<div class="form-group">	
<div class="col-md-12">


<button type="button" class="mb-sm btn btn-primary"  onClick="grid_extras_<?php echo $this->fie_id;  ?>('<?php 
if($this->contenid["psic_enlace"])
{

echo $this->contenid["psic_enlace"];

}
else
{

echo $this->sendvar[$this->fie_sendvar]; 

}

?>',0,1)"  style="background-color:#000066" >AGREGAR / GUARDAR</button>

</div>

</div>		

  <div id="lista_detalles_<?php echo $this->fie_id;  ?>">

  </div>

  </div>

  </div>
<div id="editar_detalles_<?php echo $this->fie_id;  ?>"></div>   
<script type="text/javascript">
<!--
//$("#sign_fechax").datepicker({dateFormat: 'yy-mm-dd'});
// $("#hora_valx").wickedpicker({twentyFour: true});
// grid_extras_<?php echo $this->fie_id;  ?>('<?php echo @$this->contenid["psic_enlace"]; ?>',0,0);
<?php
if(@$this->contenid["psic_enlace"])
{
?>
 grid_extras_<?php echo $this->fie_id;  ?>('<?php echo @$this->contenid["psic_enlace"]; ?>',0,0);
<?php
}
else
{
?>
 grid_extras_<?php echo $this->fie_id;  ?>('<?php echo @$this->sendvar["psic_enlacex"]; ?>',0,0);
<?php
}
?>
 //  End -->
</script>