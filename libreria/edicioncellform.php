<?php
$separa_data=explode(",",$objtableform->tab_campoprimario);
for ($i_campo=0;$i_campo<count($separa_data);$i_campo++)
{
	@$concatecacampoprymary=$concatecacampoprymary."p".$separa_data[$i_campo].":"."$('#".$separa_data[$i_campo]."').val()".",";
}
$concatecacampoprymary=substr($concatecacampoprymary,0,-1);

?>
<?php
  $objformulario->campoorden=@$campoorden;
  $objformulario->forden=@$forden;
  $objformulario->id_inicio=@$id_inicio;
    
  $comillasimple="'";
  $funciones_cuandoguarda='
	 $("#div_'.$table.'").html("<span style='.$comillasimple.'font-size:11px; color:green;'.$comillasimple.'>Guardado con exito...</span>");  
	 '.@$funcionextrag; 
  
?>
<SCRIPT LANGUAGE=javascript>
<!--

function ejecutar_formulario_<?php echo $table; ?>(){
    var options = {
        target: '#div_<?php echo $table ?>',
        type: 'post',
        url:'libreria/ejecuta/procesar.php',
        data: {opcion:$('#opcion_<?php echo $table ?>').val(),tabla:'<?php echo $table ?>',<?php echo $concatecacampoprymary ?>},
        success: function(result) {		
		eval(result);
            if(result_global=="1") 
			{
			   
			   
		   
		   <?php 
		   if($objtableform->tab_sri==1)
		   {
		   ?>
			  if($('#opcion_<?php echo $table ?>').val()!='actualizar')
			   {			   
			      $('#opcion_<?php echo $table ?>').val('actualizar');			   
			      $('#<?php echo $objtableform->tab_campoprimario ?>').val(result_insertado);
				  $('#despliegue_<?php echo $objtableform->tab_campoprimario ?>').html(result_insertado);
				  
				  $('#<?php echo $objtableform->tab_camposecsri ?>').val(result_lote);
				  $('#despliegue_<?php echo $objtableform->tab_camposecsri ?>').html(result_lote);
				  
			   }
			<?php
			}
			else
			{
			?>
			if($('#opcion_<?php echo $table ?>').val()!='actualizar')
			   {			   
			      $('#opcion_<?php echo $table ?>').val('actualizar');					  
			      $('#<?php echo $objtableform->tab_campoprimario ?>').val(result_insertado);
				  $('#despliegue_<?php echo $objtableform->tab_campoprimario ?>').html(result_insertado);
			   }
			
			<?php
			}
			?>   
			
			<?php
			   echo $funciones_cuandoguarda;
			   ?>
			  
			}
			else
			{
				  if(result_lote=="1")
				  {
					$("#div_<?php echo $table ?>").html("<span style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000;' >Alerta!! Asignar nuevo lote el actual se ha terminado...</span>");
				  }
				  if(result_lote=="2")
				  {
					 $("#div_<?php echo $table ?>").html("<span style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000;' >Alerta Lote no asignado al sistema...</span>");
				  } 
				   if(result_lote=="0")
				  {
				 $("#div_<?php echo $table ?>").html("<span style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000;' >Error al realizar el proceso, por favor intente mas tarde...</span>");
				   }
				   
				   if(result_global=="0") 
			        {
					   $("#div_<?php echo $table ?>").html("<span style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000;' >Registro ya existe...</span>");
					}
				  
				   <?php
			   echo @$funciones_cuandofalla;
			   ?> 
			   
			}
		
		}
    };

   $("#div_<?php echo $table ?>").html("<table border=0><tr><td><img src='images/progress/progress_2.gif'></td><td><span style='font-size:11px; color:green;'>Ejecutando...</span></td></tr></table>");
   $("#form_<?php echo $table; ?>").ajaxSubmit(options);	
   
}




function desaparecer_mensaje()
{
    
	//setTimeout(function () { $('#div_<?php echo $table ?>').fadeOut(); }, 2000);
  
}

function aparecer_mensaje()
{
    
	//setTimeout(function () { $('#div_<?php echo $table ?>').fadeIn(); },1);
  
}



//$(document).ready(function() {

<?php 
//GENERA FORMATOS
 $objformulario->generar_script_formatos($table,1,$DB_gogess);
 echo "\n\n";
?>

 $("#form_<?php echo $table; ?>").validate({ 
<?php
//GENERA VALIDACIONES
 $objformulario->generar_script($table,2,$DB_gogess);
//GENERA FORMATOS
?>
  });	

//});	
//-->
</script>

<SCRIPT LANGUAGE=javascript>
<!--
<?php
  
 $objformulario->generar_script($table,3,$DB_gogess);
echo "\n\n";
 $objformulario->generar_script($table,4,$DB_gogess);
echo "\n\n";
 $objformulario->generar_script($table,5,$DB_gogess);
 
?>
//-->
</SCRIPT>
