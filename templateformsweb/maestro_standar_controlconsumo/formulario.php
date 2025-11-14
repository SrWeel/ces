<style type="text/css">
<!--
.error
{
    font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color:#FF0000;
}
-->
</style>
<?php
$enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
$objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
$objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
$objformulario->sendvar["horax"]=date("H:i:s");
$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
$objformulario->sendvar["usr_tpingx"]=0;
$objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];		
$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess);
?>
<div id="div_medicamento">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
?>
</div>
<div id="div_dispositivo">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess); 
?>
</div>
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,8,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,9,$DB_gogess);    

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
//$( "#usua_fechaingrero" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_desde" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_hasta" ).datepicker({dateFormat: 'yy-mm-dd'});

<?php
echo $rs_tabla->fields["tab_codigo"];
?>

function movimiento_inv()
{
	  if($('#cuadrobm_id').val()>0)
      {
         abrir_standar('aplicativos/documental/opciones/panel/panel_standarmovimiento.php','Perfil','divBody_ext','divDialog_ext',990,600,'<?php echo @$_SESSION['ces1313777_sessid_inicio']; ?>','76',0,0,0,67,$('#cuadrobm_id').val())

		 
      }
      else
      {
          alert("Guarde el registro para ingresar a movimientos");

       }

}

//  End -->
</script>