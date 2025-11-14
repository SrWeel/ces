<style>
  .ui-autocomplete {
    max-height: 400px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
  /* IE 6 doesn't support max-height
   * we use height instead, but this forces the menu to always be this tall
   */
  * html .ui-autocomplete {
    height: 400px;
  }
  </style>
<?php

	        
			//---ENLACE
			$enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
			$objformulario->sendvar["clie_idx"]=$clie_id;
			
			$objformulario->sendvar["hcx"]=$rs_atencion->fields["atenc_hc"];
			$objformulario->sendvar["atenc_idx"]=$atenc_id;
            $objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			//asigna medico
            
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
					
			
			//--------------------------------------------------
			//busca signos vitales
			
			$busca_sigv="select * from dns_atencion where atenc_id=".$atenc_id;
			$rs_sigv = $DB_gogess->executec($busca_sigv,array());
			$objformulario->sendvar["atenc_enlacex"]=$rs_sigv->fields["atenc_enlace"];
            			
			//--------------------------------------------------
			
			 
			$valoralet=mt_rand(1,500);
			$aletorioid=$clie_id.'01'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar[$obtiene_enlace."x"]=$aletorioid;
			
			$objformulario->sendvar["codex"]=$aletorioid;
			//obtiene datos del representante
			
			//obtiene datos del representante
?>

<table width="90%" border="1" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td bgcolor="#F1F7F8"><span class="css_paciente">HISTORIA CLINICA:</span></td>
    <td bgcolor="#F1F7F8" class="css_texto"><?php  $objformulario->generar_formulario(@$submit,$table,44,$DB_gogess); ?></td>
    <td bgcolor="#F1F7F8"><span class="css_paciente">DIRECCI&Oacute;N:</span></td>
    <td bgcolor="#F1F7F8" class="css_texto"><?php echo utf8_encode($rs_dcliente->fields["clie_direccion"]);  ?></td>
 </tr>
  <tr>
    <td bgcolor="#F1F7F8"><span class="css_paciente">PACIENTE:</span></td>
    <td bgcolor="#F1F7F8" class="css_texto">
      <?php  $objformulario->generar_formulario(@$submit,$table,55,$DB_gogess); ?>
	   <?php echo utf8_encode($rs_dcliente->fields["clie_nombre"]." ".$rs_dcliente->fields["clie_apellido"]); ?>
    </td>
    <td bgcolor="#F1F7F8"><span class="css_paciente">TEL&Eacute;FONO:</span></td>
    <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_celular"];  ?></td>
  </tr>
  <tr>
    <td bgcolor="#F1F7F8"><span class="css_paciente">FECHA DE NACIMIENTO:</span></td>
    <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_fechanacimiento"];  ?></td>
    <td bgcolor="#F1F7F8"><span class="css_paciente">EDAD (A la fecha de atenci&oacute;n):</span></td>
    <td bgcolor="#F1F7F8" class="css_texto"><?php
	$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_atencion->fields["atenc_fechaingreso"]);
	echo $num_mes["anio"]." a&ntildeos y ".$num_mes["mes"]." meses";	
	?></td>
  </tr>
   <tr>
    <td bgcolor="#D3E0EB"><span class="css_paciente">ESTABLECIMIENTO:</span></td>
    <td bgcolor="#D3E0EB" class="css_texto"><?php $objformulario->generar_formulario(@$submit,$table,77,$DB_gogess); ?> </td>
    <td bgcolor="#D3E0EB"><span class="css_paciente">PROFESIONAL:</span></td>
    <td bgcolor="#D3E0EB" class="css_texto"><?php $objformulario->generar_formulario(@$submit,$table,88,$DB_gogess); ?></td>
  </tr>
</table>

<p>&nbsp;</p>

<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,8,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,9,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,10,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,11,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,12,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,13,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,14,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,15,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,16,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,17,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,18,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,19,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,20,$DB_gogess);
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
        $(function() {
            $( "#diagn_ciex" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchcie.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#diagn_descripcionx').val(ui.item.descripcion);
					
			   }
            });
         });
		 
		 $(function() {
            $( "#diagn_descripcionx" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchcietexto.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#diagn_ciex').val(ui.item.codigo);
					
			   }
            });
         });
		 
		 
		//PROCEDIMIENTOS
		 
		  $(function() {
            $( "#proce_codigox" ).autocomplete({
               source: "templateformsweb/maestro_standar_iess/searchproce.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#proce_nombrex').val(ui.item.descripcion);
				  $('#proce_cantidadx').val(ui.item.cantidad);
				  $('#proce_preciox').val(ui.item.precio);				  
				  $('#proce_totalx').val(ui.item.precio * ui.item.cantidad);
				  
					
			   }
            });
         });
		 
		 $(function() {
            $( "#proce_nombrex" ).autocomplete({
               source: "templateformsweb/maestro_standar_iess/searchprocetexto.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#proce_codigox').val(ui.item.codigo);
				  $('#proce_cantidadx').val(ui.item.cantidad);
				  $('#proce_preciox').val(ui.item.precio);
				  $('#proce_totalx').val(ui.item.precio * ui.item.cantidad);
				  
			   }
            });
         });
		 
		 
		 $( "#proce_cantidadx" ).change(function() {
			  $('#proce_totalx').val($('#proce_preciox').val() * $('#proce_cantidadx').val());
			});
			
		 $( "#proce_preciox" ).change(function() {
			  $('#proce_totalx').val($('#proce_preciox').val() * $('#proce_cantidadx').val());
			});	
		 
</script>

<?php
echo $objformulario->generar_formulario_cfechas($table,$DB_gogess);
?>