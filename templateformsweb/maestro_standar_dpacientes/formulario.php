<?php	  

$enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
$objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
$objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
$objformulario->sendvar["horax"]=date("H:i:s");
$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
$objformulario->sendvar["usr_tpingx"]=0;
$objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
$objformulario->sendvar["tipoci_idx"]=1;


$valoralet=mt_rand(1,50000);
$aletorioid='01'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
$objformulario->sendvar["clie_enlacex"]=$aletorioid;

$objformulario->sendvar["prob_codigox"]='17';
$objformulario->sendvar["cant_codigox"]='1701';
$objformulario->sendvar["idgen_idx"]=4;
$objformulario->sendvar["orien_idx"]=4;
$objformulario->sendvar["nact_idx"]=56;
$objformulario->sendvar["nac_idx"]=56;		

			 
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><?php  
	$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 
	?></td>
    <td valign="top">
	<?php  
	$objformulario->generar_formulario(@$submit,$table,2,$DB_gogess); 
	?>	</td>
  </tr>
</table>
<div id="oculta_data">
<?php $objformulario->generar_formulario(@$submit,$table,3,$DB_gogess);  ?>
<?php $objformulario->generar_formulario(@$submit,$table,4,$DB_gogess);  ?>
</div>
<?php //$objformulario->generar_formulario(@$submit,$table,50,$DB_gogess);  ?>
<?php

echo $botonenvio;

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
<div id="g_atencion"></div>
<script type="text/javascript">
<!--
//$( "#usua_fechaingrero" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_desde" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_hasta" ).datepicker({dateFormat: 'yy-mm-dd'});

<?php
if(!($csearch))
{
?>
showUser_combog('cant_codigo',$('#prob_codigo').val(),'divcant_codigo','prob_codigo','app_cliente','',0,0,0,0,0);
//$('#cant_codigo').val('1701');
<?php
}
?>

fecha_bloqueasignaedad('dia_clie_fechanacimiento','mes_clie_fechanacimiento','anio_clie_fechanacimiento','clie_fechanacimiento');

$('#oculta_data').hide();




function guardar_atencion()
{

$("#g_atencion").load("templateformsweb/maestro_standar_dpacientes/craer_atencion.php",{  

clie_id:$('#clie_id').val(),
emp_id:$('#emp_id').val(),
centro_id:$('#centro_id').val(),
tiposerv_id:'2',
clie_rucci:$('#clie_rucci').val()

 },function(result){       

 

  });  

$("#g_atencion").html("Espere un momento...");

   

}

function generar_edad(fechallega)
{


  $("#edadclie_fechanacimiento").load("templateformsweb/maestro_standar_pacientes/edad.php",{

    clie_fechanacimiento:fechallega



  },function(result){  


  });  



  $("#edadclie_fechanacimiento").html("Espere un momento...");  


}

//  End -->
</script>

<?php
echo $objformulario->generar_formulario_cfechas($table,$DB_gogess);
?>
