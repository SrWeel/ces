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
  
  .tableScroll_grids {
        z-index:99;
        height:190px;	
        overflow: auto;
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
			$objformulario->bloqueo_valor=$bloque_registro;			
			$objformulario->imprpt=$bloque_registro;			
			$objformulario->sendvar["centro_idx"]=$centro_id;
			$objformulario->sendvar["conext_etiquetasignosvx"]=$enlace_atencion;
			$objformulario->sendvar["atenc_enlacex"]=$enlace_atencion;
			$objformulario->sendvar["estaatenc_idx"]=1;
			
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

			//0$datos_atencion="select * from dns_atencion where atenc_id=".$atenc_id;
            //$rs_atencion = $DB_gogess->executec($datos_atencion,array());
			 
			$objformulario->sendvar["anamn_entrevistaclinicax"]=utf8_encode($rs_atencion->fields["atenc_observacion"]);
			 
			$valoralet=mt_rand(1,500);
			$aletorioid=$clie_id.'01'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["conext_enlacex"]=$aletorioid;
			
			//obtiene datos del representante
			$objformulario->sendvar["codex"]=$aletorioid;
			
			$objformulario->sendvar["conext_fecharx"]=date("Y-m-d");
			$objformulario->sendvar["conext_horarx"]=date("H:i");
			$objformulario->sendvar["anam_idx"]=$anam_id;
		
			//obtiene datos del representante
?>

<table width="90%" border="1" align="center" cellpadding="0" cellspacing="2">

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_paciente">HISTORIA CLINICA:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php  echo $rs_atencion->fields["atenc_hc"]; ?></td>

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
  <tr>
    <td bgcolor="#D3E0EB"><span class="css_paciente">ESTABLECIMIENTO:</span></td>
    <td bgcolor="#D3E0EB" class="css_texto"><?php $objformulario->generar_formulario(@$submit,$table,77,$DB_gogess); ?> </td>
    <td bgcolor="#D3E0EB"><span class="css_paciente">PROFESIONAL:</span></td>
    <td bgcolor="#D3E0EB" class="css_texto"><?php $objformulario->generar_formulario(@$submit,$table,88,$DB_gogess); ?></td>
  </tr>
</table>
<br />
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess); 
?>
<br />
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess);
?>
<input type="button" name="btn_diagnostico_id" id="btn_diagnostico_id" value="DIAGNOSTICO" onclick="ocultar_mostrar('diagnostico_id')" />
<input type="button" name="btn_signos_id" id="btn_signos_id" value="SIGNOS VITALES"  onclick="ocultar_mostrar('signos_id')" />
<input type="button" name="btn_antecedentesp_id" id="btn_antecedentesp_id" value="ANTECEDENTES PERSONALES" onclick="ocultar_mostrar('antecedentesp_id')"/>
<input type="button" name="btn_antecedentesf_id" id="btn_antecedentesf_id" value="ANTECEDENTES FAMILIARES" onclick="ocultar_mostrar('antecedentesf_id')" />
<input type="button" name="btn_revicionorgf_id" id="btn_revicionorgf_id" value="REVISION ACTUAL DE ORGANOS Y SISTEMAS" onclick="ocultar_mostrar('revicionorgf_id')" />
<input type="button" name="btn_examenfisico_id" id="btn_examenfisico_id" value="EXAMEN FÍSICO REGIONAL"  onclick="ocultar_mostrar('examenfisico_id')"  />
<div id="signos_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess);
?>
</div>
<div id="diagnostico_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess);
?>
</div>
<div id="antecedentesp_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess);
?>
</div>
<div id="antecedentesf_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess);
?>
</div>
<div id="revicionorgf_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,8,$DB_gogess);
?>
</div>
<div id="examenfisico_id">
<?php 
$objformulario->generar_formulario_bootstrap(@$submit,$table,9,$DB_gogess);
?>
</div>
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,10,$DB_gogess);
?>
<input type="button" name="btn_recetapres_id" id="btn_recetapres_id" value="RECETA / PRESCRIPCION" onclick="ocultar_mostrar2('recetapres_id')" />
<!-- <input type="button" name="btn_dispositivosm_id" id="btn_dispositivosm_id" value="DISPOSITIVOS MEDICOS" onclick="ocultar_mostrar2('dispositivosm_id')" /> -->
<!-- <input type="button" name="Button" value="TARIFARIO" onclick="ocultar_mostrar2('tarifario_id')" /> -->

<div id="recetapres_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,11,$DB_gogess);
?>
</div>
<div id="dispositivosm_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,12,$DB_gogess);
?>
</div>
<div id="tarifario_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,13,$DB_gogess);
?>
</div>
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,14,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,15,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,16,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,17,$DB_gogess);

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
               source: "templateformsweb/maestro_standar_ginecoanamnesisclinica/searchcie.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#diagn_descripcionx').val(ui.item.descripcion);
					
			   }
            });
         });
		 
		 
		  $(function() {
            $( "#diagn_descripcionx" ).autocomplete({
               source: "templateformsweb/maestro_standar_ginecoanamnesisclinica/searchcietexto.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#diagn_ciex').val(ui.item.codigo);
					
			   }
            });
         });
		 
		 	  $(function() {
            $( "#prod_codigox" ).autocomplete({
               source: "templateformsweb/maestro_standar_ginecoanamnesisclinica/searchpro.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#prod_descripcionx').val(ui.item.descripcion);
				  $('#prod_preciox').val(ui.item.precio);
					
			   }
            });
         });
		 
		 
		 $(function() {
            $( "#prod_descripcionx" ).autocomplete({
               source: "templateformsweb/maestro_standar_ginecoanamnesisclinica/searchprotexto.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#prod_codigox').val(ui.item.codigo);
				  $('#prod_preciox').val(ui.item.precio);
					
			   }
            });
         });
		 
		 
		 
		 $(function() {
            $( "#inven_descripcionx" ).autocomplete({
               source: "templateformsweb/maestro_standar_ginecoconsultaexterna/searchmed.php",
               minLength: 1,
			   select: function( event, ui ) {
				  $('#inven_codigox').val(ui.item.codigo);
				  $('#inven_valorunitx').val(ui.item.valorunitario);
					
			   }
            });
         });
		 
		 
		 $(function() {
            $( "#plantra_codigox" ).autocomplete({
               source: "templateformsweb/maestro_standar_ginecoanamnesisclinica/searchmedicamento.php",
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
               source: "templateformsweb/maestro_standar_ginecoanamnesisclinica/searchmedicamentotxt.php",
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
               source: "templateformsweb/maestro_standar_ginecoanamnesisclinica/searchdispositivo.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#plantrai_nombredispositivox').val(ui.item.descripcion);
				  $('#plantrai_preciox').val(ui.item.precio);
					
			   }
            });
         });	
		 
		 $(function() {
            $( "#plantrai_nombredispositivox" ).autocomplete({
               source: "templateformsweb/maestro_standar_ginecoanamnesisclinica/searchdispositivotxt.php",
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
	  $("#div_disponibilidad").load("templateformsweb/maestro_standar_ginecoanamnesisclinica/busca_disponibles.php",{
	   plantra_codigox:$('#plantra_codigox').val()
	

	  },function(result){  
	
	
	  });  
	
	  $("#div_disponibilidad").html("Espere un momento...");  
  
  }	
  
  function ocultar_mostrar(muestra)
  {
  
    $('#signos_id').hide();
	cambio_inactivo('signos_id',0);
    $('#diagnostico_id').hide();
	cambio_inactivo('diagnostico_id',0);
    $('#antecedentesp_id').hide();
	cambio_inactivo('antecedentesp_id',0);
    $('#antecedentesf_id').hide();
	cambio_inactivo('antecedentesf_id',0);
    $('#revicionorgf_id').hide();
	cambio_inactivo('revicionorgf_id',0);
    $('#examenfisico_id').hide();
	cambio_inactivo('examenfisico_id',0);
	
	$('#'+muestra).show();
	cambio_inactivo(muestra,1);
  
  }
  
  
   function ocultar_mostrar2(muestra)
  {
  
    $('#recetapres_id').hide();
	cambio_inactivo('recetapres_id',0);
    $('#dispositivosm_id').hide();
	cambio_inactivo('dispositivosm_id',0);
    $('#tarifario_id').hide();
	cambio_inactivo('tarifario_id',0);
	
	$('#'+muestra).show();
	cambio_inactivo(muestra,1);
  
  }
    

 ocultar_mostrar('diagnostico_id');
 ocultar_mostrar2('recetapres_id');
 
   function cambio_inactivo(divdata,opcion)
  {  
    if(opcion==0)
	{
	$('#btn_'+divdata).css('background-color','#C5E0EB');
	$('#btn_'+divdata).css('color','#000000');
	$('#btn_'+divdata).css('border','#000000');
	$('#btn_'+divdata).css('border','solid');
	$('#btn_'+divdata).css('border-width','thin');   
	}
	else
	{
	$('#btn_'+divdata).css('background-color','#000033');
	$('#btn_'+divdata).css('color','#FFFFFF');
	$('#btn_'+divdata).css('border','#000000');
	$('#btn_'+divdata).css('border','solid');
	$('#btn_'+divdata).css('border-width','thin');	
	}
  }	
 
		 
</script>



<script>
function genera_codproducto()
{

$.ajax({
    // la URL para la petición
    url : 'templateformsweb/maestro_standar_ginecoconsultaexterna/searchpro.php',
    // la información a enviar
    // (también es posible utilizar una cadena de datos)
    data : { term : '99214' },
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
		grid_extras_4858($('#conext_enlace').val(),0,1);
    }
});


}

<?php
if($bloque_registro==0)
{
?>
//genera_codproducto();
<?php
}
?>
//grid_extras_4824($('#anam_enlace').val(),0,1);

//calculo receta
	
	function calcular_receta()
	{
	  var plantra_frecuenciax;
	  var plantra_diasx;
	  var plantra_cantidadx;
	  var total;
	  
	  
	  plantra_frecuenciax=parseFloat($('#plantra_frecuenciax').val());
	  plantra_diasx=parseFloat($('#plantra_diasx').val());
	  total=plantra_frecuenciax*plantra_diasx;	  
	  $('#plantra_cantidadx').val(total); 
	
	
	}
	
	$( "#plantra_frecuenciax" ).change(function() {
                    calcular_receta();
				});
				
	$( "#plantra_diasx" ).change(function() {
                     calcular_receta();
				});			

//calculo receta
</script>

<?php
echo $objformulario->generar_formulario_cfechas($table,$DB_gogess);
?>