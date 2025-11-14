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
<div id="alerta_medicamento"></div>
<center><input type="button" name="Button" value="Calcular Valor Planilla" /></center>
</div>


<div id="div_dispositivo">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess); 
?>
<center><input type="button" name="Button" value="Calcular Valor Planilla" /></center>
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
//saca datos para planillar
$busca_datostarifario="select * from app_empresa where emp_id=1";
$rs_dttarifario = $DB_gogess->executec($busca_datostarifario,array());
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

 $( "#cuadrobm_preciotecho" ).change(function() {
                   var preciocompra=parseFloat($('#cuadrobm_preciomedicamento').val());
				   var preciotecho=parseFloat($('#cuadrobm_preciotecho').val());
				   var preciotechosin6=0;
				   var preciotechoreal=0;
				   var preciodecimales=0;
				   
				   preciotechosin6=(preciotecho * <?php echo $rs_dttarifario->fields["emp_restaporcentaje"]; ?>)/100;
				   preciotechoreal=preciotecho-preciotechosin6;
				   preciodecimales=preciotechoreal.toFixed(6);
				   
				   $('#cuadrobm_preciotechomenosporcentaje').val(preciodecimales);
				   
				   $('#despliegue_cuadrobm_preciotechomenosporcentaje').html(preciodecimales);

					
				});
				
	$( "#cuadrobm_preciomedicamento" ).change(function() {
                   var preciocompra=parseFloat($('#cuadrobm_preciomedicamento').val());
				   var preciotecho=parseFloat($('#cuadrobm_preciotecho').val());
				   var preciotechoadm=0;
				   var precioventa=0;
				   var preciodecimales=0;
				   
				   preciotechoadm=(preciocompra * <?php echo $rs_dttarifario->fields["emp_valorgastosadm"]; ?>)/100;
				  // preciotechoiva=(preciocompra * <?php echo $rs_dttarifario->fields["emp_valoriva"]; ?>)/100;
				   
				   precioventa=preciotechoadm+preciocompra;
				   preciodecimales=precioventa.toFixed(6);
				   if(preciodecimales!='NaN')
					 {  
				   $('#cuadrobm_valorplanilla').val(preciodecimales);
				   } 
				   $('#despliegue_cuadrobm_valorplanilla').html(preciodecimales);

			       if( preciodecimales > $('#cuadrobm_preciotechomenosporcentaje').val()	)  
					   {
						$('#alerta_medicamento').html(' <span style="color:#FF0000"><b>Alerta!!! El precio sobrepasa el precio techo</b></span>');  
						}  
					
				});
							
    function ejecuta_calculomedicamentos()
	{
	     var preciocompra=parseFloat($('#cuadrobm_preciomedicamento').val());
				   var preciotecho=parseFloat($('#cuadrobm_preciotecho').val());
				   var preciotechoadm=0;
				   var precioventa=0;
				   var preciodecimales=0;
				   
				   preciotechoadm=(preciocompra * <?php echo $rs_dttarifario->fields["emp_valorgastosadm"]; ?>)/100;
				  // preciotechoiva=(preciocompra * <?php echo $rs_dttarifario->fields["emp_valoriva"]; ?>)/100;
				   
				   precioventa=preciotechoadm+preciocompra;
				   preciodecimales=precioventa.toFixed(6);
				   
				   $('#cuadrobm_valorplanilla').val(preciodecimales);
				   
				   $('#despliegue_cuadrobm_valorplanilla').html(preciodecimales);
				   
				   if( preciodecimales > $('#cuadrobm_preciotechomenosporcentaje').val()	)  
					   {
						$('#alerta_medicamento').html('<span style="color:#FF0000"><b>Alerta!!! El precio sobrepasa el precio techo</b></span>');  
						} 

	
	}
	
	
	
	$( "#cuadrobm_preciodispositivo" ).change(function() {
                   var preciocompra=parseFloat($('#cuadrobm_preciodispositivo').val());
				  
				   var precioadm=0;
				   var precioiva=0;
				   var precioventa=0;
				   var preciodecimales=0;
				   
				   precioadm=(preciocompra * <?php echo $rs_dttarifario->fields["emp_valorgastosadm"]; ?>)/100;
				   precioiva=(preciocompra * <?php echo $rs_dttarifario->fields["emp_valoriva"]; ?>)/100;
				   
				   precioventa=precioiva+precioadm+preciocompra;
				   preciodecimales=precioventa.toFixed(6);
				   
				   $('#cuadrobm_valorplanilladispositivos').val(preciodecimales);
				   
				   $('#despliegue_cuadrobm_valorplanilladispositivos').html(preciodecimales);

					
				});
	
    function ejecuta_calculodispositivos()
	{
                   var preciocompra=parseFloat($('#cuadrobm_preciodispositivo').val());
				  
				   var precioadm=0;
				   var precioiva=0;
				   var precioventa=0;
				   var preciodecimales=0;
				   
				   precioadm=(preciocompra * <?php echo $rs_dttarifario->fields["emp_valorgastosadm"]; ?>)/100;
				   precioiva=(preciocompra * <?php echo $rs_dttarifario->fields["emp_valoriva"]; ?>)/100;
				   
				   precioventa=precioiva+precioadm+preciocompra;
				   preciodecimales=precioventa.toFixed(6);
				   
				   $('#cuadrobm_valorplanilladispositivos').val(preciodecimales);
				   
				   $('#despliegue_cuadrobm_valorplanilladispositivos').html(preciodecimales);

					
	}
	ejecuta_calculodispositivos();
	ejecuta_calculomedicamentos();
//  End -->
</script>