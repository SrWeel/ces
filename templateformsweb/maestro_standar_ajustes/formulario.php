<?php

	  

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";

		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	

		    $objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	

            $objformulario->sendvar["horax"]=date("H:i:s");

			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];

			$objformulario->sendvar["usr_tpingx"]=0;
            $objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			
			$codig_unicovalor='';
			$unico_number='';
			$unico_number=strtoupper(uniqid());			
			$codig_unicovalor=date("Y-m-d").$_SESSION['ces1313777_sessid_inicio'].$unico_number;			
			$objformulario->sendvar["tomfis_enlacex"]=$codig_unicovalor;
			
			
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

			

			 

$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess);
?>
<button type="button" class="mb-sm btn btn-primary" onclick="procesar_excel()"> PROCESAR EXCEL</button><br /><br />

<button type="button" class="mb-sm btn btn-primary" onclick="procesar_asiento()"> PROCESAR AJUSTE </button>

<div id="div_ajuste"></div>

<?php 
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,8,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,9,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,10,$DB_gogess); 

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



<br /><br />




<div id=div_<?php echo $table ?> > </div>
<div id="divBody_buscadorgeneral"></div>

<script type="text/javascript">
<!--


function buscar_dataform(id)
{

abrir_standar('templateformsweb/maestro_standar_ajustes/buscadorform/busca_data.php','Buscador','divBody_buscadorgeneral','divDialog_buscadorgeneral',550,500,id,0,0,0,0,0,0);

}

function crear_dataform(id,valor)
{

abrir_standar('templateformsweb/maestro_standar_ajustes/crearform/formulario.php','New','divBody_buscadorgeneral','divDialog_buscadorgeneral',550,500,id,valor,0,0,0,0,0);

}


function procesar_asiento()
{

   $("#div_ajuste").load("templateformsweb/maestro_standar_ajustes/procesar.php",{
    tomfis_id:$('#tomfis_id').val()
  },function(result){  
      
  });  
  $("#div_ajuste").html("Espere un momento..."); 
}

function procesar_excel()
{

 $("#div_ajuste").load("templateformsweb/maestro_standar_ajustes/lerer_archi.php",{
    tomfis_id:$('#tomfis_id').val()
  },function(result){  
      
	  grid_extras_10465($('#tomfis_enlace').val(),0,0);
	  
  });  
  $("#div_ajuste").html("Espere un momento..."); 

}


//$( "#usua_fechaingrero" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_desde" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_hasta" ).datepicker({dateFormat: 'yy-mm-dd'});

<?php
echo $rs_tabla->fields["tab_codigo"];
?>

//  End -->
</script>
<?php
echo $objformulario->generar_formulario_cfechas($table,$DB_gogess);
?>
