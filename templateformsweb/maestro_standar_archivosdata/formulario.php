<?php

$objformulario->react_id=$react_id;
            $objformulario->em_pathaexcel='excel/';
	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
		    $objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("h:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
			$objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];			
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
            $valoralet=mt_rand(1,50000);
			$aletorioid='02'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["genr_enlacex"]=$aletorioid;
			$objformulario->sendvar["archdt_aniox"]=date("Y");
			$objformulario->sendvar["archdt_mesx"]=date("m");
			
            

$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess); 

?>
<center>

<div id="btn_botonx">
<input id="btn_botonx" type="button" name="Button" value="Ejecuta Carga"  onclick="ejecuta_pr()" /> 
</div>

<div id="ejecuta_proceso" style="height:30px" ></div>

</center>

<div id="despl_fila" align="center" style="height:30px"></div>

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

function ejecuta_pr()
{
	
	$('#btn_botonx').html("");
	
	if($('#archdt_archivo').val()=='')
	{
		alert("Suba el archivo...");
		return false;
		
	}
	
	if($('#archdt_id').val()=='')
	{
		alert("Guarde el registro para poder cargar el archivo...");
		return false;
	}
	
var linkurl;
var tipoarch;
tipoarch=$('#tiparch_id').val();

//alert(tipoarch);

switch (tipoarch) {
  case '10':
    linkurl='templateformsweb/maestro_standar_archivosdata/procesar_csv.php';
    break;
  case '12':
    linkurl='templateformsweb/maestro_standar_archivosdata/lektor.php';
    break;
  case '13':
    linkurl='templateformsweb/maestro_standar_archivosdata/procesar_dataproductos.php';
    break;
  case '14':
    linkurl='templateformsweb/maestro_standar_archivosdata/procesar_datainicialbp.php';
    break;	
  case '16':
    linkurl='templateformsweb/maestro_standar_archivosdata/procesar_datainicialhospital.php';
    break;
  case '17':
    linkurl='templateformsweb/maestro_standar_archivosdata/procesar_datapagos.php';
    break;		
  case '18':
    linkurl='templateformsweb/maestro_standar_archivosdata/procesar_datahextras.php';
    break;			
  default:
    linkurl='templateformsweb/maestro_standar_archivosdata/procesar_data.php';
    break;
}
	
	
$("#ejecuta_proceso").load(linkurl,{
	
    archdt_id:$('#archdt_id').val()

},function(result){  
    
  });  

$("#ejecuta_proceso").html("Espere un momento...");
	
	
}

function obtiene_fila()
{
   $("#despl_fila").load("templateformsweb/maestro_standar_archivosdata/generar_fila.php",{
   tiparch_id:$('#tiparch_id').val()

  //filtro_val:$('#filtro_val').val()
  },function(result){  

  }); 
  $("#despl_fila").html("Espere un momento"); 
}

$( "#tiparch_id" ).change(function() {
   obtiene_fila();
});

//$( "#genr_fechacierre" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_desde" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_hasta" ).datepicker({dateFormat: 'yy-mm-dd'});
//  End -->
</script>