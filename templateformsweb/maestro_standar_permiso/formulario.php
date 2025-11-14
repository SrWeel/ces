<?php
	  

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
		    $objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("h:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
            $objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];			 

$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 
?>
<div id="vacaciones_id"></div>
<div id="antiguedad_id"></div>
<?php
$objformulario->generar_formulario(@$submit,$table,2,$DB_gogess); 
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

<script>
function calcula_vacaciones()
{
   
   if($('#clie_id').val())
   {
   
	   $("#vacaciones_id").load("templateformsweb/maestro_standar_pacientes/vacaciones.php",{
		  clie_id:$('#clie_id').val()
	
	  },function(result){  
	
	  }); 
	
		$("#vacaciones_id").html("Espere un momento"); 
  
  }

}


function calcula_antiguedad()
{
   
   if($('#clie_id').val())
   {
   
	   $("#antiguedad_id").load("templateformsweb/maestro_standar_pacientes/antiguedad.php",{
		  clie_id:$('#clie_id').val()
	
	  },function(result){  
	
	  }); 
	
		$("#antiguedad_id").html("Espere un momento"); 
  
  }

}



$( "#clie_id" ).change(function() {
    calcula_antiguedad();
	calcula_vacaciones();
});

if($('#clie_id').val())
   {
     calcula_antiguedad();
	 calcula_vacaciones();
   }
  
  $("#permi_fechamemo").datepicker({dateFormat: 'yy-mm-dd'});
  $("#permi_periodoi").datepicker({dateFormat: 'yy-mm-dd'});
  $("#permi_periodof").datepicker({dateFormat: 'yy-mm-dd'});
  $("#permi_fechaintegra").datepicker({dateFormat: 'yy-mm-dd'});
</script>