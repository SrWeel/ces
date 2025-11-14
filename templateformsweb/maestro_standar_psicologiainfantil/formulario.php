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
			
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

			//0$datos_atencion="select * from dns_atencion where atenc_id=".$atenc_id;
            //$rs_atencion = $DB_gogess->executec($datos_atencion,array());
			 
			//$objformulario->sendvar["anamn_entrevistaclinicax"]=utf8_encode($rs_atencion->fields["atenc_observacion"]);
			 
			$valoralet=mt_rand(1,500);
			$aletorioid=$clie_id.'01'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["psicoinfa_enlacex"]=$aletorioid;
			
			$objformulario->sendvar["codex"]=$aletorioid;
			//obtiene datos del representante
			
			
			$datos_representante="select * from dns_representante where clie_enlace='".$rs_dcliente->fields["clie_enlace"]."' order by repres_id asc limit 1";
            $rs_representante = $DB_gogess->executec($datos_representante,array());
			
			//obtiene datos del representante
?>

<table width="900" border="1" align="center" cellpadding="0" cellspacing="2">

  <tr>
    <td colspan="8" bgcolor="#F1F7F8"><span class="css_paciente">HISTORIA CLINICA:<span class="css_texto">
      <?php  $objformulario->generar_formulario(@$submit,$table,44,$DB_gogess); ?>
    </span></span></td>
  </tr>
  <tr>
    <td colspan="8" bgcolor="#F1F7F8"><strong>I. DATOS DEL USUARIO/USUARIA </strong></td>
  </tr>
  <tr>
    <td bgcolor="#F1F7F8"><strong>Apellidos </strong></td>
    <td bgcolor="#F1F7F8"><strong>Nombres</strong></td>
    <td bgcolor="#F1F7F8"><strong>Fecha de nacimiento </strong></td>
    <td bgcolor="#F1F7F8" class="css_texto"><strong>Sexo</strong></td>
    <td bgcolor="#F1F7F8" class="css_texto"><strong>Estado Civil </strong></td>
    <td bgcolor="#F1F7F8" class="css_texto"><strong>Instrucci&oacute;n</strong></td>
    <td bgcolor="#F1F7F8" class="css_texto"><strong>Seguro</strong></td>
    <td bgcolor="#F1F7F8" class="css_texto"><strong>Empresa donde trabaja </strong></td>
  </tr>
  <tr>
    <td bgcolor="#F1F7F8"><span class="css_texto"><span class="texto_caja"><?php echo utf8_encode($rs_dcliente->fields["clie_apellido"]); ?>
      <?php  $objformulario->generar_formulario(@$submit,$table,55,$DB_gogess); ?>
    </span></span></td>
    <td bgcolor="#F1F7F8"><span class="texto_caja"><?php echo utf8_encode($rs_dcliente->fields["clie_nombre"]); ?></span></td>
    <td bgcolor="#F1F7F8"><span class="css_texto"><?php echo $rs_dcliente->fields["clie_fechanacimiento"];  ?></span></td>
    <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_genero"];  ?></td>
    <td bgcolor="#F1F7F8" class="css_texto"><?php  
	$civil_estado=$objformulario->replace_cmb("app_estadocivil","civil_id,civil_nombre","where civil_id=",$rs_dcliente->fields["civil_id"],$DB_gogess);
	echo $civil_estado;
	 ?></td>
    <td bgcolor="#F1F7F8" class="css_texto"><?php
	
	$instru_estado=$objformulario->replace_cmb("dns_instruccion","instruccion_id,instruccion_nombre","where instruccion_id=",$rs_dcliente->fields["clie_instruccion"],$DB_gogess);
	echo $instru_estado;
	
	?></td>
    <td bgcolor="#F1F7F8" class="css_texto"><?php
	
	$nseguro=$objformulario->replace_cmb("faesa_tipopaciente","tipopac_id,tipopac_nombre","where tipopac_id=",$rs_dcliente->fields["tipopac_id"],$DB_gogess);
	echo $nseguro;
	
	?></td>
    <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_dondetrabaja"];  ?></td>
  </tr>
  <tr>
    <td colspan="8" bgcolor="#F1F7F8"><span class="css_paciente"><strong>EDAD (A la fecha de atenci&oacute;n):</strong></span>      <?php
	$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_atencion->fields["atenc_fechaingreso"]);
	echo $num_mes["anio"]." a&ntildeos y ".$num_mes["mes"]." meses";
	
	?></td>
  </tr>
</table>
<br>

<table width="900" border="1" align="center" cellpadding="0" cellspacing="2">
  
  <tr>
    <td bgcolor="#F1F7F8"><strong>Nacionalidad</strong></td>
    <td bgcolor="#F1F7F8"><strong>Pa&iacute;s</strong></td>
    <td bgcolor="#F1F7F8"><strong>C&eacute;dula de Ciudadania o Pasaporte</strong></td>
    <td colspan="3" bgcolor="#F1F7F8"><strong>Lugar de recidencia actual </strong></td>
    <td bgcolor="#F1F7F8"><strong>Direcci&oacute;n Domiciliaria</strong></td>
    <td bgcolor="#F1F7F8"><strong>No Telef&oacute;nico </strong></td>
  </tr>
  <tr>
    <td bgcolor="#F1F7F8"><span class="css_texto"><span class="texto_caja"><?php 
	if($rs_dcliente->fields["nac_id"]==56)
	{
	
	  echo '1';
	}
	else
	{
	
	   echo '2';
	}

	 ?></span></span></td>
    <td bgcolor="#F1F7F8">
	<?php
	$nombrepais='';
	$nombrepais=$objformulario->replace_cmb("dns_nacionalidad","nac_id,nac_nombre","where nac_id=",$rs_dcliente->fields["nac_id"],$DB_gogess);
	echo $nombrepais;
	
	$provinciav=$objformulario->replace_cmb("app_provincia","prob_codigo,prob_nombre","where prob_codigo like ",$rs_dcliente->fields["prob_codigo"],$DB_gogess);
	$cantonv=$objformulario->replace_cmb("app_canton","cant_codigo,cant_nombre","where cant_codigo like ",$rs_dcliente->fields["cant_codigo"],$DB_gogess);
	?>	</td>
    <td bgcolor="#F1F7F8"><?php echo $rs_dcliente->fields["clie_rucci"]; ?></td>
    <td bgcolor="#F1F7F8"><?php echo $provinciav; ?></td>
    <td bgcolor="#F1F7F8"><?php echo $cantonv; ?></td>
    <td bgcolor="#F1F7F8"><?php echo utf8_encode($rs_dcliente->fields["clie_parroquia"]); ?></td>
    <td bgcolor="#F1F7F8"><span class="texto_caja"><span class="css_texto"><?php echo utf8_encode($rs_dcliente->fields["clie_direccion"]);  ?></span></span></td>
    <td bgcolor="#F1F7F8"><span class="css_texto"><?php echo $rs_dcliente->fields["clie_celular"];  ?></span></td>
  </tr>
  <tr>
    <td bgcolor="#F1F7F8"><span class="style1">1=Ecu/ 2=Ext </span></td>
    <td bgcolor="#F1F7F8">&nbsp;</td>
    <td bgcolor="#F1F7F8">&nbsp;</td>
    <td bgcolor="#F1F7F8"><span class="style1">Provincia</span></td>
    <td bgcolor="#F1F7F8"><span class="style1">Cant&oacute;n</span></td>
    <td bgcolor="#F1F7F8"><span class="style1">Parroquia</span></td>
    <td bgcolor="#F1F7F8"><span class="style1">Calle Principal y Secundaria </span></td>
    <td bgcolor="#F1F7F8"><span class="style1">Convencional/Celular</span></td>
  </tr>
</table>
<p>&nbsp;</p>

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
            $( "#greferencia_ciex" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchcie.php",
               minLength: 1,
			   select: function( event, ui ) {
				  $('#greferencia_diagnosticox').val(ui.item.descripcion);
					
			   }
            });
         });
		 
		 $(function() {
            $( "#greferencia_descripcionx" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchcietexto.php",
               minLength: 1,
			   select: function( event, ui ) {
				  $('#greferencia_ciex').val(ui.item.codigo);
					
			   }
            });
         });
		 
		 
		 	  $(function() {
            $( "#prod_codigox" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchpro.php",
               minLength: 1,
			   select: function( event, ui ) {
				  $('#prod_descripcionx').val(ui.item.descripcion);
				  $('#prod_preciox').val(ui.item.precio);
					
			   }
            });
         });
		 
		 
		  $(function() {
            $( "#prod_descripcionx" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchprotexto.php",
               minLength: 1,
			   select: function( event, ui ) {
				  $('#prod_codigox').val(ui.item.codigo);
				  $('#prod_preciox').val(ui.item.precio);
					
			   }
            });
         });
		 
		 
		  $(function() {
            $( "#plantrai_codigox" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchdispositivo.php",
               minLength: 1,
			   select: function( event, ui ) {
				  $('#plantrai_nombredispositivox').val(ui.item.descripcion);
				  $('#plantrai_preciox').val(ui.item.precio);
					
			   }
            });
         });	
		 
		 $(function() {
            $( "#plantrai_nombredispositivox" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchdispositivotxt.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#plantrai_codigox').val(ui.item.codigo);
				  $('#plantrai_preciox').val(ui.item.precio);
					
			   }
            });
         });
		 
		 
		 $(function() {
            $( "#plantra_codigox" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchmedicamento.php",
               minLength: 1,
			   select: function( event, ui ) {
				  $('#plantra_medicamentox').val(ui.item.descripcion);
				  $('#plantra_concentracionx').val(ui.item.concentracion);
				  $('#plantra_presentacionx').val(ui.item.presentacion);
				  $('#plantra_viax').val(ui.item.via);
				  $('#plantra_preciotechox').val(ui.item.techo);
				  $('#plantra_preciotechosinporcentajex').val(ui.item.techosinpr);
					
			   }
            });
         });	
		 
		 $(function() {
            $( "#plantra_medicamentox" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchmedicamentotxt.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#plantra_codigox').val(ui.item.codigo);
				  $('#plantra_concentracionx').val(ui.item.concentracion);
				  $('#plantra_presentacionx').val(ui.item.presentacion);
				  $('#plantra_viax').val(ui.item.via);
				  $('#plantra_preciotechox').val(ui.item.techo);
				  $('#plantra_preciotechosinporcentajex').val(ui.item.techosinpr);
					
			   }
            });
         });	  
		 
		 	
	
	 	//busca cantidad de productos

  $( "#plantra_cantidadx" ).change(function() {
                     busca_disponibles();
				});
	
  $( "#plantra_frecuenciax" ).change(function() {
                     busca_disponibles();
				});				
				
  $( "#plantra_diasx" ).change(function() {
                     busca_disponibles();
				});
  				
				
  function busca_disponibles()
  {
	  $("#div_disponibilidad").load("templateformsweb/maestro_standar_anamnesisclinica/busca_disponibles.php",{
	   plantra_codigox:$('#plantra_codigox').val()
	

	  },function(result){  
	
	
	  });  
	
	  $("#div_disponibilidad").html("Espere un momento...");  
  
  }	
	
		 
</script>

<?php
echo $objformulario->generar_formulario_cfechas($table,$DB_gogess);
?>