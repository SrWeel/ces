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
<button type="button" class="mb-sm btn btn-info" onclick="ver_formularioenpantalla('aplicativos/documental/opciones/panel/agendar_terapiaseguros.php','Perfil','divBody_ext','1','130',0,0,0,0,0)" style="cursor:pointer"> AGENDAMIENTO MEDICOMPANIES </button>
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
			//llega de otra tabla
			 $objformulario->sendvar["lab_idexternox"]=@$id_llega;
			 $objformulario->sendvar["lab_tablaexternox"]=@$tabla_llega;
			 
			
			
			$objformulario->bloqueo_valor=$bloque_registro;		
			$objformulario->imprpt=$bloque_registro;
			
			$datos_centrodata="select * from dns_centrosalud where centro_id='".$_SESSION['ces1313777_centro_id']."'";			
            $rs_centrodata = $DB_gogess->executec($datos_centrodata,array());			
			$objformulario->sendvar["prob_codigox"]=$rs_centrodata->fields["prob_codigo"];
			$objformulario->sendvar["cant_codigox"]=$rs_centrodata->fields["cant_codigo"];
			$objformulario->sendvar["lab_parroquiax"]=$rs_centrodata->fields["centro_parroquia"];
			
			
			
			

            $objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			//asigna medico
            
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			
			$objformulario->sendvar["lab_horax"]="00:00";
			
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

			$datos_atencion="select * from dns_atencion where atenc_id=".$atenc_id;
            $rs_atencion = $DB_gogess->executec($datos_atencion,array());
			$objformulario->sendvar["atenc_enlacex"]=$rs_atencion->fields["atenc_enlace"]; 
			 
			$objformulario->sendvar["anamn_entrevistaclinicax"]=utf8_encode($rs_atencion->fields["atenc_observacion"]);
			 
			$valoralet=mt_rand(1,500);
			$aletorioid=$clie_id.'01'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["lab_enlacex"]=$aletorioid;
			
			$objformulario->sendvar["codex"]=$aletorioid;
			
			$objformulario->sendvar["prio_idx"]=2;
			
			if($id_llega>0)
			{
            $objformulario->subtabla=$id_llega;
			}
			//obtiene datos del representante
			
			
			$datos_representante="select * from dns_representante where clie_enlace='".$rs_dcliente->fields["clie_enlace"]."' order by repres_id asc limit 1";
            $rs_representante = $DB_gogess->executec($datos_representante,array());
			
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

<?php
$bandera_cie=0;
if($objformulario->contenid["lab_enlace"])
{
     $busca_diag="select count(*) as total from dns_diagnosticolaboratorio where lab_enlace='".$objformulario->contenid["lab_enlace"]."'";
     $rs_diag = $DB_gogess->executec($busca_diag,array());
     
	 $bandera_cie=$rs_diag->fields["total"];
}
else
{
     $busca_diag="select count(*) as total from dns_diagnosticolaboratorio where lab_enlace='".$objformulario->sendvar["lab_enlacex"]."'";
     $rs_diag = $DB_gogess->executec($busca_diag,array());
	 
	 $bandera_cie=$rs_diag->fields["total"];

}
?>

<p>&nbsp;</p>

<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess); 
?>
<input type="button" name="btn_hematologa_id" id="btn_hematologa_id" value="HEMATOLOGIA"  onclick="ocultar_mostrarlab('hematologa_id')" />
<input type="button" name="btn_quimicasanguinea_id" id="btn_quimicasanguinea_id" value="QUIMICA SANGUINEA"  onclick="ocultar_mostrarlab('quimicasanguinea_id')" />
<input type="button" name="btn_coprologico_id" id="btn_coprologico_id" value="COPROLOGICO"  onclick="ocultar_mostrarlab('coprologico_id')" />
<input type="button" name="btn_uroanalisis_id" id="btn_uroanalisis_id" value="UROANALISIS"  onclick="ocultar_mostrarlab('uroanalisis_id')" />
<input type="button" name="btn_bactereologia_id" id="btn_bactereologia_id" value="BACTEREOLOGIA"  onclick="ocultar_mostrarlab('bactereologia_id')" />
<input type="button" name="btn_serologia_id" id="btn_serologia_id" value="SEROLOGIA"  onclick="ocultar_mostrarlab('serologia_id')" />
<input type="button" name="btn_otroslab_id" id="btn_otroslab_id" value="OTROS"  onclick="ocultar_mostrarlab('otroslab_id')" />


<div id="hematologa_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
?>
</div>
<div id="quimicasanguinea_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess);
?>
</div>
<div id="coprologico_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess);
?>
</div>
<div id="uroanalisis_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess);
?>
</div>
<div id="bactereologia_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess);
?>
</div>
<div id="serologia_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess);
?>
</div>
<div id="otroslab_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,8,$DB_gogess); 
?>
</div>
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,9,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,10,$DB_gogess);

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
            $( "#diagn_descripcionx<?php echo $objformulario->subtabla; ?>" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchcietexto.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#diagn_ciex<?php echo $objformulario->subtabla; ?>').val(ui.item.codigo);
					
			   }
            });
         });
		 
		 $(function() {
            $( "#diagn_ciex<?php echo $objformulario->subtabla; ?>" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchcie.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#diagn_descripcionx<?php echo $objformulario->subtabla; ?>').val(ui.item.descripcion);
					
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
		 
 
 function ocultar_mostrarlab(muestra)
  {
  
    $('#hematologa_id').hide();
	cambio_inactivo('hematologa_id',0);
	
    $('#quimicasanguinea_id').hide();
	cambio_inactivo('quimicasanguinea_id',0);
	
    $('#coprologico_id').hide();
	cambio_inactivo('coprologico_id',0);
	
	$('#uroanalisis_id').hide();
	cambio_inactivo('uroanalisis_id',0);
	
	$('#bactereologia_id').hide();
	cambio_inactivo('bactereologia_id',0);
	
	$('#serologia_id').hide();
	cambio_inactivo('serologia_id',0);
	
	$('#otroslab_id').hide();
	cambio_inactivo('otroslab_id',0);
	
	$('#'+muestra).show();
	cambio_inactivo(muestra,1);
  
  }	
		 
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
  
  ocultar_mostrarlab('hematologa_id');	
  
  
  
function genera_cieexterno(codigo,diagn_tipox,idext)
{

$.ajax({
    // la URL para la petición
    url : 'templateformsweb/maestro_standar_laboratorio/searchcie.php',
    // la información a enviar
    // (también es posible utilizar una cadena de datos)
    data : { term : codigo },
    // especifica si será una petición POST o GET
    type : 'GET',
    // el tipo de información que se espera de respuesta
    dataType : 'json',
    // código a ejecutar si la petición es satisfactoria;
    // la respuesta es pasada como argumento a la función
    success : function(json) {
        //console.log(json[0]);	
		$('#diagn_ciex'+idext).val(json[0].codigo);
		$('#diagn_descripcionx'+idext).val(json[0].descripcion);
		$('#diagn_tipox'+idext).val(diagn_tipox);
		
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
		grid_extras_6133($('#lab_enlace').val(),0,1);
    }
});


}

<?php
if($bandera_cie==0)
{

//busca diagnosticos

//lab_tablaexterno
//lab_idexterno
$campo_idext='';

//$objformulario->sendvar["lab_idexternox"]=@$id_llega;
//$objformulario->sendvar["lab_tablaexternox"]=@$tabla_llega;
			 
if($objformulario->sendvar["lab_idexternox"]>0)
{
    
	$campo_idext=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_campoprimario"," where tab_name like ",$objformulario->sendvar["lab_tablaexternox"],$DB_gogess);
	
	$busca_diag="select * from ".$objformulario->sendvar["lab_tablaexternox"]." where ".$campo_idext."='".$objformulario->sendvar["lab_idexternox"]."'";
	$rs_budiag = $DB_gogess->executec($busca_diag,array());
	
	
	//busca datos del diagnostico
	$busca_campodiag="select * from gogess_sisfield where tab_name='".trim($objformulario->sendvar["lab_tablaexternox"])."' and ttbl_id=1 and fie_tablasubgrid!=''";
	$rs_campodiag = $DB_gogess->executec($busca_campodiag,array());
	
	$busca_listadiag="select * from ".$rs_campodiag->fields["fie_tablasubgrid"]." where ".$rs_campodiag->fields["fie_campoenlacesub"]."='".$rs_budiag->fields[$rs_campodiag->fields["fie_campoenlacesub"]]."' order by 1 asc";
	 $rs_listd = $DB_gogess->executec($busca_listadiag,array());
	 if($rs_listd)
     {
	   while (!$rs_listd->EOF) {	
	   
	       echo " genera_cieexterno('".$rs_listd->fields["diagn_cie"]."','".$rs_listd->fields["diagn_tipo"]."','".$objformulario->sendvar["lab_idexternox"]."'); ";
	  
	    $rs_listd->MoveNext();	
	   }	 
	 } 
	
	//busca datos del diagnostico
	
	

}			 

//busca dianosticos

}
?>
</script>
<?php
echo $objformulario->generar_formulario_nfechas($table,$DB_gogess);
?>
<button type="button" class="mb-sm btn btn-info" onclick="ver_formularioenpantalla('aplicativos/documental/opciones/panel/agendar_terapiaseguros.php','Perfil','divBody_ext','1','130',0,0,0,0,0)" style="cursor:pointer"> AGENDAMIENTO MEDICOMPANIES </button>