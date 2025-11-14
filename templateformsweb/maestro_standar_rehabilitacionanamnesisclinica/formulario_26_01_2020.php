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
			$objformulario->sendvar["centro_idx"]=$centro_id;
			
			$objformulario->bloqueo_valor=$bloque_registro;		
			$objformulario->imprpt=$bloque_registro;
					


			//--------------------------------------------------
			//busca signos vitales
			//$busca_sigv="select * from dns_atencion where atenc_id=".$atenc_id;
			//$rs_sigv = $DB_gogess->executec($busca_sigv,array());
			//$objformulario->sendvar["atenc_enlacex"]=$rs_sigv->fields["atenc_enlace"];
			
			$objformulario->sendvar["atenc_enlacex"]=$rs_atencion->fields["atenc_enlace"];	
            $objformulario->sendvar["conext_etiquetasignosvx"]=$enlace_atencion;			
			//--------------------------------------------------
			
			$objformulario->sendvar["atenc_idx"]=$atenc_id;

			//asigna medico
            //if(@$rs_buscadatos_fecha->fields["usua_id"])
			//{
			//$objformulario->sendvar["usua_idx"]=@$rs_buscadatos_fecha->fields["usua_id"];
			//}
			//else
			//{
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			
			//}
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

			//0$datos_atencion="select * from dns_atencion where atenc_id=".$atenc_id;
            //$rs_atencion = $DB_gogess->executec($datos_atencion,array());
			 
			$objformulario->sendvar["anamn_entrevistaclinicax"]=utf8_encode($rs_atencion->fields["atenc_observacion"]);
			 
			$valoralet=mt_rand(1,500);
			$aletorioid=$clie_id.'01'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["anam_enlacex"]=$aletorioid;
			
			$objformulario->sendvar["codex"]=$aletorioid;
			//obtiene datos del representante
	//busca alergia medica
$alergia_medica='';
$busca_alerg="select anam_txtalergias from dns_anamesisexamenfisico where clie_id='".$objformulario->sendvar["clie_idx"]."' and tipoaler_id=1";
$rs_balerg = $DB_gogess->executec($busca_alerg,array());
 if($rs_balerg)
 {
	  while (!$rs_balerg->EOF) {
	     if($rs_balerg->fields["anam_txtalergias"])
		 {
	     $alergia_medica.=$rs_balerg->fields["anam_txtalergias"].' ';
		 }
		 else
		 {
		 $alergia_medica.=' No Detalla ';
		 }
	  
	    $rs_balerg->MoveNext();	
	  }
}	
if($alergia_medica)
{


echo '<div class="alert alert-danger" role="alert"><b>Alerta!!!</b> Alergia a Medicamentos: '.$alergia_medica.'</div>';

}

//busca alergia medica		
			
			$datos_representante="select * from dns_representante where clie_enlace='".$rs_dcliente->fields["clie_enlace"]."' order by repres_id asc limit 1";
            $rs_representante = $DB_gogess->executec($datos_representante,array());
			
			//obtiene datos del representante
			
		
?>

<table width="800" border="1" align="center" cellpadding="0" cellspacing="2">

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_paciente">HISTORIA CLINICA:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php  $objformulario->generar_formulario(@$submit,$table,44,$DB_gogess); ?></td>

    <td bgcolor="#F1F7F8"><span class="css_paciente">DIRECCI&Oacute;N:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php echo utf8_encode($rs_dcliente->fields["clie_direccion"]);  ?></td>
  </tr>

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_paciente">PACIENTE:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,55,$DB_gogess); ?>
	   <?php echo utf8_encode($rs_dcliente->fields["clie_nombre"]." ".$rs_dcliente->fields["clie_apellido"]); ?>

    </span></td>

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
</table>


<p>&nbsp;</p>

<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess); 

$estadoval1='';
$estadoval2='';
$estadoval3='';
$estadoval4='';

switch ($rs_atencion->fields["estaatenc_id"]) {
    case 1:
        $estadoval1='checked';
		$estadoval4='checked';
        break;
    case 2:
	   
        $estadoval2='checked';
        break;
    case 3:
        $estadoval3='checked';
        break;
	case 4:
        $estadoval4='checked';
        break;	
}
?>
<table width="700" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4" bgcolor="#DEEEF3"><strong>Seleccione el estado en el que se encuentra la atenci&oacute;n actualmente. </strong></td>
  </tr>
  <tr>
    <td><div align="center">PRIMERA VEZ </div></td>
    <td><div align="center">ALTA</div></td>
    <td><div align="center">DESERCION</div></td>
  </tr>
  <tr>
    <td><div align="center">
	<?php
	 if(!($objformulario->bloqueo_valor))
	 {
	 ?>
      <input name="estadomedi" type="radio" id="estadomedi1" value="4" onclick="click_radiob()" <?php echo $estadoval4; ?>  />
	 <?php
	 }
	 else
	 {
	    if($estadoval4)
		{
		   echo '<img src="images/check_on.png" width="12" height="12" />';
		}
		else
		{
		   echo '<img src="images/check_off.png" width="12" height="12" />';
		}
	 }
	 ?> 
    </div></td>
   
    <td><div align="center">
	<?php
	 if(!($objformulario->bloqueo_valor))
	 {
	 ?>
      <input name="estadomedi" type="radio" id="estadomedi3" value="2" onclick="click_radiob()" <?php echo $estadoval2; ?> />
	 <?php
	 }
	 else
	 {
	     if($estadoval2)
		{
		   echo '<img src="images/check_on.png" width="12" height="12" />';
		}
		else
		{
		   echo '<img src="images/check_off.png" width="12" height="12" />';
		}
	 
	 }
	 ?>  
    </div></td>
    <td><div align="center">
	<?php
	 if(!($objformulario->bloqueo_valor))
	 {
	 ?>
      <input name="estadomedi" type="radio" id="estadomedi4" value="3" onclick="click_radiob()" <?php echo $estadoval3; ?> />
	  <?php
	 }
	 else
	 {
	     if($estadoval3)
		{
		   echo '<img src="images/check_on.png" width="12" height="12" />';
		}
		else
		{
		   echo '<img src="images/check_off.png" width="12" height="12" />';
		}
	 
	 
	 }
	 ?> 
    </div></td>
  </tr>
  <tr>
    <td height="20" colspan="4"><div id="div_estadoatencion"></div></td>
  </tr>
</table>
<br />
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
?>
<div id="mujer_id">
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
$objformulario->generar_formulario_bootstrap(@$submit,$table,10,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,11,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,12,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,13,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,14,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,15,$DB_gogess);
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
		 
		$(function() {
            $( "#prod_codigox" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchpro.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#prod_descripcionx').val(ui.item.descripcion);
				  $('#prod_preciox').val(ui.item.precio);
					
			   }
            });
         });
		 
		 
		 $(function() {
            $( "#prod_descripcionx" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchprotexto.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#prod_codigox').val(ui.item.codigo);
				  $('#prod_preciox').val(ui.item.precio);
					
			   }
            });
         });
		 
		 function click_radiob()
		 {
		 	   
		   $("#div_estadoatencion").load("templateformsweb/maestro_standar_anamnesisclinica/estadog.php",{
			   atenc_id:$('#atenc_id').val(),
			   estaatenc_id:$('input:radio[name=estadomedi]:checked').val()
			
		
			  },function(result){  
			
			
			  });  
			
			  $("#div_estadoatencion").html("Espere un momento...");  
  
		 
		 }
		 
		 
		 
	
	<?php
	if($rs_dcliente->fields["clie_genero"]=='M')
	{
	?>	 
		 $('#mujer_id').hide();
	<?php
	}
	else
	{
	?>
	   $('#mujer_id').show();
	<?php
	}
	?>	 
		 
		 
</script>


<script>
function genera_codproducto()
{

$.ajax({
    // la URL para la petición
    url : 'templateformsweb/maestro_standar_anamnesisclinica/searchpro.php',
    // la información a enviar
    // (también es posible utilizar una cadena de datos)
    data : { term : '99203' },
    // especifica si será una petición POST o GET
    type : 'GET',
    // el tipo de información que se espera de respuesta
    dataType : 'json',
    // código a ejecutar si la petición es satisfactoria;
    // la respuesta es pasada como argumento a la función
    success : function(json) {
        //console.log(json[0].codigo);
		$('#prod_codigox').val(json[0].codigo);
		$('#prod_descripcionx').val(json[0].descripcion);
	    $('#prod_preciox').val(json[0].precio);
		
    },
    // código a ejecutar si la petición falla;
    // son pasados como argumentos a la función
    // el objeto de la petición en crudo y código de estatus de la petición
    error : function(xhr, status) {
        ///alert('Disculpe, existió un problema');
    },
    // código a ejecutar sin importar si la petición falló o no
    complete : function(xhr, status) {
        ///alert('Petición realizada');
		grid_extras_4824($('#anam_enlace').val(),0,1);
    }
});


}

<?php
if($bloque_registro==0)
{
?>
genera_codproducto();
<?php
}
?>
//grid_extras_4824($('#anam_enlace').val(),0,1);


  $(function() {
            $( "#plantra_codigox" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchmedicamento.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#plantra_medicamentox').val(ui.item.descripcion);
				  $('#plantra_concentracionx').val(ui.item.concentracion);
				  $('#plantra_presentacionx').val(ui.item.presentacion);
				  $('#plantra_viax').val(ui.item.via);
				  $('#plantra_preciotechox').val(ui.item.techo);
				  $('#plantra_preciotechosinporcentajex').val(ui.item.techosinpr);
				  $('#plantra_indicacionesx').val(ui.item.descripcion + ':');
					
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
				  $('#plantra_indicacionesx').val(ui.item.label + ':');
					
			   }
            });
         });	  
		 
		 	  
		

$(function() {
            $( "#plantrai_codigox" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchdispositivo.php",
               minLength: 2,
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