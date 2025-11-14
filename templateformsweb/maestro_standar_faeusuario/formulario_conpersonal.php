<?php

	  

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";

		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	

		    $objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	

            $objformulario->sendvar["horax"]=date("H:i:s");

			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];

			$objformulario->sendvar["usr_tpingx"]=0;
            $objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

			

			 

$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 

if($csearch)
{    
  $fecha_calculada=array();
  $fechafin=date("Y-m-d");
  $fecha_calculada=$objvarios->calcular_edad($objformulario->contenid["usua_fechaingrero"],$fechafin);
  
 // print_r($fecha_calculada);
  $busca_politica="select * from faesa_politicasasistencia where centro_id=1 order by polasis_id desc limit 1";
  $rs_politica = $DB_gogess->executec($busca_politica,array());
  
  $anios_paravaca=$rs_politica->fields["polasis_tiempominimovaca"];
  
  
  ?>
  <p>&nbsp;</p>
  <table width="400" border="0" align="center" cellpadding="0" cellspacing="1">
  <tr>
    <td bgcolor="#BFDCE3"><strong>Fecha de Ingreso </strong></td>
    <td bgcolor="#BFDCE3"><strong>A&ntilde;os </strong></td>
    <td bgcolor="#BFDCE3"><strong>Dias Vacaciones </strong></td>
  </tr>
  <tr>
    <td bgcolor="#E8F2F7"><?php echo $objformulario->contenid["usua_fechaingrero"]; ?></td>
    <td bgcolor="#E8F2F7"><?php  echo $fecha_calculada["anio"]." a&ntilde;os ".$fecha_calculada["mes"]." meses"; ?></td>
    <td bgcolor="#E8F2F7"><?php
	$dias_vacaciones=0;
	if($fecha_calculada["anio"]>=$anios_paravaca)
	{
	   $dias_vacaciones=$rs_politica->fields["polasis_alcumplirelanio"];
	}
	$numero_aumenta=0;	
	if($fecha_calculada["anio"]>=$rs_politica->fields["polasis_anioaumentauno"])
	{
	    $numero_aumenta=$fecha_calculada["anio"]-$rs_politica->fields["polasis_anioaumentauno"];
		
	
	}
	
	echo $dias_vacaciones+$numero_aumenta;
	?></td>
  </tr>
</table>


<p>&nbsp;</p>


  <center>
  <input type="button" name="Submit" value="Reset Clave" onclick="resetclv()" />
  <div id="clv_panel" ></div>
  </center>
  
  <p>&nbsp;</p>
  <?php
  
}
?>



<?php
if($csearch)

{

 $valoropcion='actualizar';

}

else

{

 $valoropcion='guardar';

}



echo "<input name='csearch' type='hidden' value=''>

<input name='idab' type='hidden' value=''>

<input name='opcion_".$table."' type='hidden' value='".$valoropcion."' id='opcion_".$table."' >

<input name='table' type='hidden' value='".$table."'>";



?>


<div id=div_<?php echo $table ?> > </div>


<script type="text/javascript">
<!--
$( "#usua_fechaingrero" ).datepicker({dateFormat: 'yy-mm-dd'});

//  End -->
</script>

<script type="text/javascript">

function resetclv()
{

   $("#clv_panel").load("templateformsweb/maestro_standar_faeusuario/clvreset.php",{
    idv:$('#usua_id').val()


  },function(result){  



  });  

  $("#clv_panel").html("Espere un momento...");  

}

</script>