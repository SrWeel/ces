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
			$tipofor_id=0;
	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
			$objformulario->sendvar["clie_idx"]=$clie_id;		
			$objformulario->sendvar["hcx"]=$rs_atencion->fields["atenc_hc"];
			$objformulario->sendvar["centro_idx"]=$centro_id;
			$objformulario->sendvar["estaatenc_idx"]=4;
			@$objformulario->sendvar["tipofor_idx"]=$tipofor_id;			
			$objformulario->bloqueo_valor=$bloque_registro;		
			$objformulario->imprpt=$bloque_registro;
			
			
			
			@$objformulario->sendvar["protoop_tblprincipalx"]=$protoop_tblprincipal;
			@$objformulario->sendvar["protoop_idenlacex"]=$protoop_idenlace;
			

			//--------------------------------------------------
			//busca signos vitales			
			$objformulario->sendvar["atenc_enlacex"]=$rs_atencion->fields["atenc_enlace"];	
            $objformulario->sendvar["conext_etiquetasignosvx"]=$enlace_atencion;			
			//--------------------------------------------------
			
			$objformulario->sendvar["atenc_idx"]=$atenc_id;

			//asigna medico
           
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];			 
			$valoralet=mt_rand(1,500);
			$aletorioid=$clie_id.'01'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["protoop_enlacex"]=$aletorioid;
			
			$objformulario->sendvar["codex"]=$aletorioid;
		
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


<p>&nbsp;</p>


<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess); 
?>

<br />
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
?>
<div id="mujer_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess); 
?>
</div>
<div id="antecedentesp_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess);
?>
</div>
<div id="antecedentesf_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess);
?>
</div>
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess);
?>
<div id="revicionorgf_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess);
?>
</div>
<div id="signos_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,8,$DB_gogess);
?>
</div>
<div id="examenfisico_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,9,$DB_gogess); 
?>
</div>

<div id="tarifario_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,10,$DB_gogess);
?>
</div>
<div id="diagnostico_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,11,$DB_gogess);
?>
</div>
<div id="recetapres_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,13,$DB_gogess);
?>
</div>
<div id="dispositivos_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,14,$DB_gogess);
?>
</div>
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,12,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,15,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,16,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,17,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,18,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,19,$DB_gogess);
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

<?php
$bandera_cie=0;
if($objformulario->contenid["protoop_enlace"])
{
     $busca_diag="select count(*) as total from cesdb_arextension.dns_protocolodiagnosticospre where protoop_enlace='".$objformulario->contenid["protoop_enlace"]."'";
     $rs_diag = $DB_gogess->executec($busca_diag,array());
     
	 $bandera_cie=$rs_diag->fields["total"];
}
else
{
     $busca_diag="select count(*) as total from cesdb_arextension.dns_protocolodiagnosticospre where protoop_enlace='".$objformulario->sendvar["protoop_enlacex"]."'";
     $rs_diag = $DB_gogess->executec($busca_diag,array());
	 
	 $bandera_cie=$rs_diag->fields["total"];

}
//echo $bandera_cie;

$bandera_cie2=0;
if($objformulario->contenid["protoop_enlace"])
{
     $busca_diagx="select count(*) as total from cesdb_arextension.dns_protocolodiagnosticospost where protoop_enlace='".$objformulario->contenid["protoop_enlace"]."'";
     $rs_diagx = $DB_gogess->executec($busca_diagx,array());
     
	 $bandera_cie2=$rs_diagx->fields["total"];
}
else
{
     $busca_diagx="select count(*) as total from cesdb_arextension.dns_protocolodiagnosticospost where protoop_enlace='".$objformulario->sendvar["protoop_enlacex"]."'";
     $rs_diagx = $DB_gogess->executec($busca_diagx,array());
	 
	 $bandera_cie2=$rs_diagx->fields["total"];

}

//echo $bandera_cie2;
?>


<div id=div_<?php echo $table ?> > </div>

<script>
        
		 $(function() {
            $( "#diagnpre_ciex" ).autocomplete({
               source: "templateformsweb/maestro_standar_protocolooperatorio/searchcie.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#diagnpre_descripcionx').val(ui.item.descripcion);
					
			   }
            });
         });
		 
		 $(function() {
            $( "#diagnpre_descripcionx" ).autocomplete({
               source: "templateformsweb/maestro_standar_protocolooperatorio/searchcietexto.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#diagnpre_ciex').val(ui.item.codigo);
					
			   }
            });
         });
		 
		 //hilll	 
		 
		 $(function() {
            $( "#gridhill_codigox" ).autocomplete({
               source: "templateformsweb/maestro_standar_protocolooperatorio/searchhill.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#gridhill_descripcionx').val(ui.item.descripcion);
					
			   }
            });
         });
		 
		 $(function() {
            $( "#gridhill_descripcionx" ).autocomplete({
               source: "templateformsweb/maestro_standar_protocolooperatorio/searchhilltexto.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#gridhill_codigox').val(ui.item.codigo);
					
			   }
            });
         });

       //hilll

      
	   $(function() {
            $( "#diagnpost_ciex" ).autocomplete({
               source: "templateformsweb/maestro_standar_protocolooperatorio/searchcie.php",
               minLength: 2,
			   select: function( event, ui ) {
				  $('#diagnpost_descripcionx').val(ui.item.descripcion);
					
			   }
            });
         });
		 
		 $(function() {
            $( "#diagnpost_descripcionx" ).autocomplete({
               source: "templateformsweb/maestro_standar_protocolooperatorio/searchcietexto.php",
               minLength: 3,
			   select: function( event, ui ) {
				  $('#diagnpost_ciex').val(ui.item.codigo);
					
			   }
            });
         });
	
	
function genera_cieexternopre(codigo,diagn_tipox,idext)
{

$.ajax({
    // la URL para la petición
    url : 'templateformsweb/maestro_standar_protocolooperatorio/searchcie.php',
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
		$('#diagnpre_ciex').val(json[0].codigo);
		$('#diagnpre_descripcionx').val(json[0].descripcion);
		$('#diagnpre_tipox').val(diagn_tipox);
		
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
		grid_extras_8328($('#protoop_enlace').val(),0,1);
    }
});


}	


function genera_cieexternopost(codigo,diagn_tipox,idext)
{

$.ajax({
    // la URL para la petición
    url : 'templateformsweb/maestro_standar_protocolooperatorio/searchcie.php',
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
		$('#diagnpost_ciex').val(json[0].codigo);
		$('#diagnpost_descripcionx').val(json[0].descripcion);
		$('#diagnpost_tipox').val(diagn_tipox);
		
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
		grid_extras_8331($('#protoop_enlace').val(),0,1);
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

//@$objformulario->sendvar["protoop_tblprincipalx"]=$protoop_tblprincipal;
//@$objformulario->sendvar["protoop_idenlacex"]=$protoop_idenlace;
	 
if($objformulario->sendvar["protoop_idenlacex"]>0)
{
    
	$campo_idext=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_campoprimario"," where tab_name like ",$objformulario->sendvar["protoop_tblprincipalx"],$DB_gogess);
	
	$busca_diag="select * from ".$objformulario->sendvar["protoop_tblprincipalx"]." where ".$campo_idext."='".$objformulario->sendvar["protoop_idenlacex"]."'";
	$rs_budiag = $DB_gogess->executec($busca_diag,array());	
	
	//busca datos del diagnostico
	$busca_campodiag="select * from gogess_sisfield where tab_name='".trim($objformulario->sendvar["protoop_tblprincipalx"])."' and ttbl_id=1 and fie_tablasubgrid!=''";
	$rs_campodiag = $DB_gogess->executec($busca_campodiag,array());
	
	 $busca_listadiag="select * from ".$rs_campodiag->fields["fie_tablasubgrid"]." where ".$rs_campodiag->fields["fie_campoenlacesub"]."='".$rs_budiag->fields[$rs_campodiag->fields["fie_campoenlacesub"]]."' order by 1 asc";
	 $rs_listd = $DB_gogess->executec($busca_listadiag,array());
	 if($rs_listd)
     {
	   while (!$rs_listd->EOF) {	
	   
	      echo " genera_cieexternopre('".$rs_listd->fields["diagn_cie"]."','".$rs_listd->fields["diagn_tipo"]."','".$objformulario->sendvar["protoop_idenlacex"]."'); ";
	  
	    $rs_listd->MoveNext();	
	   }	 
	 } 
	
	//busca datos del diagnostico
	
	

}			 

}
//busca dianosticos


if($bandera_cie2==0)
{

//busca diagnosticos
//lab_tablaexterno
//lab_idexterno
$campo_idext='';
//@$objformulario->sendvar["protoop_tblprincipalx"]=$protoop_tblprincipal;
//@$objformulario->sendvar["protoop_idenlacex"]=$protoop_idenlace;

if($objformulario->sendvar["protoop_idenlacex"]>0)
{
    
	$campo_idext=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_campoprimario"," where tab_name like ",$objformulario->sendvar["protoop_tblprincipalx"],$DB_gogess);
	
	$busca_diag="select * from ".$objformulario->sendvar["protoop_tblprincipalx"]." where ".$campo_idext."='".$objformulario->sendvar["protoop_idenlacex"]."'";
	$rs_budiag = $DB_gogess->executec($busca_diag,array());	
	
	//busca datos del diagnostico
	$busca_campodiag="select * from gogess_sisfield where tab_name='".trim($objformulario->sendvar["protoop_tblprincipalx"])."' and ttbl_id=1 and fie_tablasubgrid!=''";
	$rs_campodiag = $DB_gogess->executec($busca_campodiag,array());
	
	 $busca_listadiag="select * from ".$rs_campodiag->fields["fie_tablasubgrid"]." where ".$rs_campodiag->fields["fie_campoenlacesub"]."='".$rs_budiag->fields[$rs_campodiag->fields["fie_campoenlacesub"]]."' order by 1 asc";
	 $rs_listd = $DB_gogess->executec($busca_listadiag,array());
	 if($rs_listd)
     {
	   while (!$rs_listd->EOF) {	
	   
	      echo " genera_cieexternopost('".$rs_listd->fields["diagn_cie"]."','".$rs_listd->fields["diagn_tipo"]."','".$objformulario->sendvar["protoop_idenlacex"]."'); ";
	  
	    $rs_listd->MoveNext();	
	   }	 
	 } 
	
	//busca datos del diagnostico
	
	

}	

}
?>
 
 
</script>



<?php
echo $objformulario->generar_formulario_cfechas($table,$DB_gogess);
?>