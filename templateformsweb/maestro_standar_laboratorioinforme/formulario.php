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
            $objformulario->sendvar["labinfor_horax"]=date("H:i:s");
			$objformulario->sendvar["labinfor_cuentax"]=$cuenta_info;
			
			
						
			$objformulario->bloqueo_valor=$bloque_registro;		
			$objformulario->imprpt=$bloque_registro;
			
			$datos_centrodata="select * from dns_centrosalud where centro_id='".$_SESSION['ces1313777_centro_id']."'";			
            $rs_centrodata = $DB_gogess->executec($datos_centrodata,array());			
			$objformulario->sendvar["prob_codigox"]=trim($rs_centrodata->fields["prob_codigo"]);
			$objformulario->sendvar["cant_codigox"]=trim($rs_centrodata->fields["cant_codigo"]);
			$objformulario->sendvar["labinfor_parroquiax"]=trim($rs_centrodata->fields["centro_parroquia"]);
			
			
			//
			if(@$id_llega>0)
			{
			   $objformulario->subtabla=$id_llega;
			    
			}

            $objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			//asigna medico
            if(@$rs_buscadatos_fecha->fields["usua_id"])
			{
			$objformulario->sendvar["usua_idx"]=@$rs_buscadatos_fecha->fields["usua_id"];
			}
			else
			{
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			
			}
			
			
			
			$objformulario->sendvar["lab_idx"]=$_POST["pVar7"];
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

			$datos_atencion="select * from dns_atencion where atenc_id=".$atenc_id;
            $rs_atencion = $DB_gogess->executec($datos_atencion,array());
			$objformulario->sendvar["atenc_enlacex"]=$rs_atencion->fields["atenc_enlace"]; 
			 
			$objformulario->sendvar["anamn_entrevistaclinicax"]=$rs_atencion->fields["atenc_observacion"];
			 
			$valoralet=mt_rand(1,500);
			$aletorioid=$clie_id.'01'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["labinfor_enlacex"]=$aletorioid;
			
			$objformulario->sendvar["codex"]=$aletorioid;
			//obtiene datos del representante
			
			
			$datos_representante="select * from dns_representante where clie_enlace='".$rs_dcliente->fields["clie_enlace"]."' order by repres_id asc limit 1";
            $rs_representante = $DB_gogess->executec($datos_representante,array());
			
			//obtiene datos del representante
?>

<table width="90%" border="1" align="center" cellpadding="0" cellspacing="2">

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_paciente">HISTORIA CLINICA:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php  $objformulario->generar_formulario(@$submit,$table,44,$DB_gogess); ?></td>

    <td bgcolor="#F1F7F8"><span class="css_paciente">DIRECCI&Oacute;N:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><?php echo $rs_dcliente->fields["clie_direccion"];  ?></td>
  </tr>

  <tr>

    <td bgcolor="#F1F7F8"><span class="css_paciente">PACIENTE:</span></td>

    <td bgcolor="#F1F7F8" class="css_texto"><span class="texto_caja">

      <?php  $objformulario->generar_formulario(@$submit,$table,55,$DB_gogess); ?>
	   <?php echo $rs_dcliente->fields["clie_nombre"]." ".$rs_dcliente->fields["clie_apellido"]; ?>

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

<p>&nbsp;</p>

<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
?>
<input type="button" name="btn_hematologicoinf_id" id="btn_hematologicoinf_id" value="HEMATOLOGICO"  onclick="ocultar_mostrarlabinfo('hematologicoinf_id')" />
<input type="button" name="btn_coprologicoinf_id" id="btn_coprologicoinf_id" value="COPROLOGICO"  onclick="ocultar_mostrarlabinfo('coprologicoinf_id')" />
<input type="button" name="btn_quimicainf_id" id="btn_quimicainf_id" value="QUIMICA"  onclick="ocultar_mostrarlabinfo('quimicainf_id')" />
<input type="button" name="btn_uroanalisisinf_id" id="btn_uroanalisisinf_id" value="UROANALISIS"  onclick="ocultar_mostrarlabinfo('uroanalisisinf_id')" />
<input type="button" name="btn_serologia_id" id="btn_serologia_id" value="SEROLOGIA"  onclick="ocultar_mostrarlabinfo('serologia_id')" />
<input type="button" name="btn_bacte_id" id="btn_bacte_id" value="BACTEOROLOGIA"  onclick="ocultar_mostrarlabinfo('bacte_id')" />
<input type="button" name="btn_otros_id" id="btn_otros_id" value="OTROS"  onclick="ocultar_mostrarlabinfo('otros_id')" />


<div id="hematologicoinf_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess);
?>
</div>
<div id="coprologicoinf_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess);
?>
</div>
<div id="quimicainf_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess);
?>
</div>
<div id="uroanalisisinf_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess);
?>
</div>

<div id="serologia_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess);
?>
</div>
<div id="bacte_id">

<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,8,$DB_gogess);
?>
</div>
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,9,$DB_gogess);
?>

<div id="otros_id">

<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,10,$DB_gogess);
?>
</div>
<?php
$bandera_cie=0;
if($objformulario->contenid["labinfor_enlace"])
{
     $busca_diag="select count(*) as total from cesdb_arextension.dns_diagnosticolaboratorioinforme where labinfor_enlace='".$objformulario->contenid["labinfor_enlace"]."'";
     $rs_diag = $DB_gogess->executec($busca_diag,array());
     
	 $bandera_cie=$rs_diag->fields["total"];
}
else
{
     $busca_diag="select count(*) as total from cesdb_arextension.dns_diagnosticolaboratorioinforme where labinfor_enlace='".$objformulario->sendvar["labinfor_enlacex"]."'";
     $rs_diag = $DB_gogess->executec($busca_diag,array());
	 
	 $bandera_cie=$rs_diag->fields["total"];

}
?>
<!--
<input type="button" name="btn_diagnosticoinf_id" id="btn_diagnosticoinf_id" value="DIAGNOSTICOS"  onclick="ocultar_mostrarlabinfo2('diagnosticoinf_id')" />

<input type="button" name="btn_dispositivosinf_id" id="btn_dispositivosinf_id" value="DISPOSITIVOS MEDICOS"  onclick="ocultar_mostrarlabinfo2('dispositivosinf_id')" />
<input type="button" name="btn_tarifarioinf_id" id="btn_tarifarioinf_id" value="TARIFARIO"  onclick="ocultar_mostrarlabinfo2('tarifarioinf_id')" /> -->
<div id="diagnosticoinf_id" >
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,11,$DB_gogess);
?>
</div>
<div id="tarifarioinf_id" >
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,12,$DB_gogess);
?>
</div>
<div id="dispositivosinf_id" >
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
            $( "#prod_codigox<?php echo $objformulario->subtabla; ?>" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchpro.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#prod_descripcionx<?php echo $objformulario->subtabla; ?>').val(ui.item.descripcion);
				  $('#prod_preciox<?php echo $objformulario->subtabla; ?>').val(ui.item.precio);
					
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
            $( "#prod_descripcionx<?php echo $objformulario->subtabla; ?>" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchprotexto.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#prod_codigox<?php echo $objformulario->subtabla; ?>').val(ui.item.codigo);
				  $('#prod_preciox<?php echo $objformulario->subtabla; ?>').val(ui.item.precio);
					
			   }
            });
         });
		 
	 $(function() {
            $( "#plantrai_codigox<?php echo $objformulario->subtabla; ?>" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchdispositivo.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#plantrai_nombredispositivox<?php echo $objformulario->subtabla; ?>').val(ui.item.descripcion);
				  $('#plantrai_preciox<?php echo $objformulario->subtabla; ?>').val(ui.item.precio);
					
			   }
            });
         });	
		 
		 $(function() {
            $( "#plantrai_nombredispositivox<?php echo $objformulario->subtabla; ?>" ).autocomplete({
               source: "templateformsweb/maestro_standar_anamnesisclinica/searchdispositivotxt.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#plantrai_codigox<?php echo $objformulario->subtabla; ?>').val(ui.item.codigo);
				  $('#plantrai_preciox<?php echo $objformulario->subtabla; ?>').val(ui.item.precio);
					
			   }
            });
         });	

 
	function ocultar_mostrarlabinfo(muestra)
  {
  
    $('#hematologicoinf_id').hide();
	cambio_inactivo('hematologicoinf_id',0);
	
    $('#coprologicoinf_id').hide();
	cambio_inactivo('coprologicoinf_id',0);
	
    $('#quimicainf_id').hide();
	cambio_inactivo('quimicainf_id',0);
	
	$('#uroanalisisinf_id').hide();
	cambio_inactivo('uroanalisisinf_id',0);
	
	$('#serologia_id').hide();
	cambio_inactivo('serologia_id',0);
	$('#bacte_id').hide();
	cambio_inactivo('serologia_id',0);
	$('#otros_id').hide();
	cambio_inactivo('serologia_id',0);

	
	
	$('#'+muestra).show();
	cambio_inactivo(muestra,1);
  
  }	
  
  //
  // function ocultar_mostrarlabinfo2(muestra)
  // {
  //
  //   $('#dispositivosinf_id').hide();
	// cambio_inactivo('dispositivosinf_id',0);
	//
  //   $('#tarifarioinf_id').hide();
	// cambio_inactivo('tarifarioinf_id',0);
	//
  //   $('#diagnosticoinf_id').hide();
	// cambio_inactivo('diagnosticoinf_id',0);
	//
	//
	// $('#'+muestra).show();
	// cambio_inactivo(muestra,1);
  //
  // }
		 
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
  
  ocultar_mostrarlabinfo('hematologicoinf_id');	
  ocultar_mostrarlabinfo2('diagnosticoinf_id');
  
  
   
function genera_cieexterno(codigo,diagn_tipox,idext)
{

$.ajax({
    // la URL para la petici�n
    url : 'templateformsweb/maestro_standar_laboratorio/searchcie.php',
    // la informaci�n a enviar
    // (tambi�n es posible utilizar una cadena de datos)
    data : { term : codigo },
    // especifica si ser� una petici�n POST o GET
    type : 'GET',
    // el tipo de informaci�n que se espera de respuesta
    dataType : 'json',
    // c�digo a ejecutar si la petici�n es satisfactoria;
    // la respuesta es pasada como argumento a la funci�n
    success : function(json) {
        //console.log(json[0]);	
		$('#diagn_ciex'+idext).val(json[0].codigo);
		$('#diagn_descripcionx'+idext).val(json[0].descripcion);
		$('#diagn_tipox'+idext).val(diagn_tipox);
		
    },
    // c�digo a ejecutar si la petici�n falla;
    // son pasados como argumentos a la funci�n
    // el objeto de la petici�n en crudo y c�digo de estatus de la petici�n
    error : function(xhr, status) {
        ///alert('Disculpe, existi� un problema');
    },
    // c�digo a ejecutar sin importar si la petici�n fall� o no
    complete : function(xhr, status) {
        ///alert('Petici�n realizada');
		grid_extras_6187($('#labinfor_enlace').val(),0,1);
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
			 
if($objformulario->sendvar["lab_idx"]>0)
{
    
	
	$busca_diag="select * from dns_laboratorio where lab_id='".$objformulario->sendvar["lab_idx"]."'";
	$rs_budiag = $DB_gogess->executec($busca_diag,array());
	
	//busca datos del diagnostico
	$busca_campodiag="select * from gogess_sisfield where tab_name='dns_laboratorio' and ttbl_id=1 and fie_tablasubgrid!=''";
	$rs_campodiag = $DB_gogess->executec($busca_campodiag,array());
	
	$busca_listadiag="select * from ".$rs_campodiag->fields["fie_tablasubgrid"]." where ".$rs_campodiag->fields["fie_campoenlacesub"]."='".$rs_budiag->fields[$rs_campodiag->fields["fie_campoenlacesub"]]."' order by 1 asc";
	 $rs_listd = $DB_gogess->executec($busca_listadiag,array());
	 if($rs_listd)
     {
	   while (!$rs_listd->EOF) {	
	   
	       echo " genera_cieexterno('".$rs_listd->fields["diagn_cie"]."','".$rs_listd->fields["diagn_tipo"]."','".$id_llega."'); ";
	  
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
echo $objformulario->generar_formulario_cfechas($table,$DB_gogess);
?>