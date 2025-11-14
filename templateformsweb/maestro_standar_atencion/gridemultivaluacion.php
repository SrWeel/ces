<?php
    $lista_espe=array();
	$idv=0;
	$lista_especial="select * from dns_especialidad where especi_activo=1";
	$rs_lespe = $DB_gogess->executec($lista_especial,array());
    if($rs_lespe)
    {
	  while (!$rs_lespe->EOF) {	
	     
	    $lista_espe[$idv]["id"]=$rs_lespe->fields["especi_id"];
		$lista_espe[$idv]["nombre"]=$rs_lespe->fields["especi_nombre"];
		$lista_espe[$idv]["codigo"]=$rs_lespe->fields["especi_codigo"];
		$idv++;
		
	  $rs_lespe->MoveNext();	
	  }
	}  
?>
<script language="javascript">
<!--

function editar_extras_<?php echo $this->fie_id;  ?>(enlacep,id_grid,opcionp)
{

  $("#editar_detalles_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/editar.php",{


enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
eteneva_idx:id_grid,
centro_id:'<?php echo $_SESSION['ces1313777_centro_id']; ?>',
sess_id:'<?php echo $_SESSION['ces1313777_sessid_inicio']; ?>'



 },function(result){       


	$('#eteneva_idx').val($('#eteneva_idxval').val());
	$('#eteneva_observacionx').val($('#eteneva_observacionxval').val());

	<?php
	for($i=0;$i<count($lista_espe);$i++)
	{
	   ?>
			if($('#<?php echo $lista_espe[$i]["codigo"]; ?>xval').val()=='true')
			{
			$("#<?php echo $lista_espe[$i]["codigo"]; ?>x").prop( "checked", true );
			}
			else
			{
			$("#<?php echo $lista_espe[$i]["codigo"]; ?>x").prop( "checked", false );
			}
	  <?php
	  
	}
	
	?>

	$("#eteneva_fechaentregax").val($('#eteneva_fechaentregaxval').val());

  });  



$("#editar_detalles_<?php echo $this->fie_id;  ?>").html("Espere un momento...");

}



function grid_extras_<?php echo $this->fie_id;  ?>(enlacep,id_grid,opcionp)
{


if(opcionp==1)
{


	var opcion_seleccion;

	opcion_seleccion=0;

    <?php
	for($i=0;$i<count($lista_espe);$i++)
	{
	   $concatena_camp.=" $('#".$lista_espe[$i]["codigo"]."x').prop('checked')==true || ";
	}
	
	$concatena_camp=substr($concatena_camp,0,-3);
	?>

	if(<?php echo $concatena_camp; ?>)
	 {
		opcion_seleccion=1;
	 }

	if(opcion_seleccion==0)
	{

	   alert("Favor Ingresar al menos una especialidad");

	  return false;

	}

   
     
	 if($('#eteneva_fechaentregax').val()=='')
	 {
	    alert("Favor Ingresar la fecha de entrega");
	    return false;

	 }
   



}


if(opcionp==2)
{
	if (!(confirm('Desea borrar este registro?'))) { 
	  return false;
	}

}



if(!$('#eteneva_fechaentregax').val())

{

	var eteneva_fechaentregaxx ='0000-00-00 00:00:00';

	}

else

{

var eteneva_fechaentregaxx =$('#eteneva_fechaentregax').val();



}	



$("#lista_detalles_<?php echo $this->fie_id;  ?>").load("<?php echo $this->formulario_path; ?>/grid_multievaluacion.php",{


enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
eteneva_idx:$('#eteneva_idx').val(),
eteneva_observacionx:$('#eteneva_observacionx').val(),
<?php
	for($i=0;$i<count($lista_espe);$i++)
	{
	   $concatena_camp2.=" ".$lista_espe[$i]["codigo"]."x:$('#".$lista_espe[$i]["codigo"]."x').prop('checked'),";
	}
	//$concatena_camp2=substr($concatena_camp2,0,-1);
	echo $concatena_camp2;
?>
eteneva_fechaentregax:eteneva_fechaentregaxx,
fie_id:'<?php echo $this->fie_id;  ?>',
clie_id:'<?php echo $this->contenid["clie_id"];  ?>',
centro_id:'<?php echo $_SESSION['ces1313777_centro_id']; ?>',
sess_id:'<?php echo $_SESSION['ces1313777_sessid_inicio']; ?>'

 },function(result){       

	$('#eteneva_idx').val(0);
    $('#eteneva_observacionx').val("");
<?php
	for($i=0;$i<count($lista_espe);$i++)
	{
	   $concatena_camp3.=" $('#".$lista_espe[$i]["codigo"]."x').prop( 'checked', false ); ";  
	}
	//$concatena_camp2=substr($concatena_camp2,0,-1);
	echo $concatena_camp3;
?>	
	$('#eteneva_fechaentregax').val("");

  });  


$("#lista_detalles_<?php echo $this->fie_id;  ?>").html("Espere un momento...");



}



function mensaje_no()
{
 alert("Registro no puede ser editado ya tiene factura asignada");
}



function mensaje_bo()
{
 alert("Registro no puede ser borrado ya tiene factura asignada");
}

//-->
</script>
<?php



   $busca_autorizacion="select * from faesa_nautorizaciones where clie_id=".$this->contenid["clie_id"]." and atenc_hc='".$this->contenid["atenc_hc"]."' and aut_usado=0";

$rs_autorizacion = $DB_gogess->executec($busca_autorizacion,array());

$codigo_aut='';

	if(@$rs_autorizacion->fields["aut_codigo"])

	{

	  $busca_uso="select eteneva_numautorizacion from dns_atencionevaluacion where eteneva_numautorizacion='".$rs_autorizacion->fields["aut_codigo"]."'";

	  $rs_uso = $DB_gogess->executec($busca_uso,array());

	  if(@$rs_uso->fields["eteneva_numautorizacion"])

	  {

	  $codigo_aut='';

	  }

	  else

	  {

	  $codigo_aut=@$rs_autorizacion->fields["aut_codigo"];

	  }

	}

	else

	{

	  $codigo_aut='';

	}

	

	

?>



<div class="panel panel-default" >

<div class="panel-body">





<div class="form-group">


<div class="col-md-3">
<input placeholder="Observaci&oacute;n" name="eteneva_observacionx" id="eteneva_observacionx" class="form-control" value=""  type="text"  >
</div>


<?php
	for($i=0;$i<count($lista_espe);$i++)
	{
	   $concatena_camp4.=" 
	    <div class='col-md-1'>
		<label>".$lista_espe[$i]["nombre"]."</label>
		<input name='".$lista_espe[$i]["codigo"]."x' class='form-control' type='checkbox' id='".$lista_espe[$i]["codigo"]."x' value='1' >
		</div>   
	   ";  
	}
	//$concatena_camp2=substr($concatena_camp2,0,-1);
	echo $concatena_camp4;
?>


<div class="col-md-2">
<input placeholder="Fecha entrega" name="eteneva_fechaentregax" id="eteneva_fechaentregax" class="form-control" value=""  type="text"  >
<input name='eteneva_idx' class='form-control' type='hidden' id='eteneva_idx' value='0' >
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


<div id="editar_detalles_<?php echo $this->fie_id;  ?>"></div>

<script type="text/javascript">
<!--

 $("#eteneva_fechaentregax").datepicker({dateFormat: 'yy-mm-dd'});

// $("#horaeva_horaix").wickedpicker({twentyFour: true});

// $("#horaeva_horafx").wickedpicker({twentyFour: true});

 grid_extras_<?php echo $this->fie_id;  ?>('<?php echo @$this->contenid["atenc_enlace"]; ?>',0,0);

 //  End -->

</script>