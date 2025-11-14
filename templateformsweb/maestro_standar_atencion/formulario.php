<script language="javascript">
<!--

function ver_reporte(atenc_id) {
 myWindow2=window.open('reportes/reporte_evaluacion.php?atenc_id='+atenc_id,'ventana_evaluacion','width=750,height=500,scrollbars=YES');
 myWindow2.focus();

}

function ver_informe(seccion,id)
{

var reponsables;
reponsables=1;
if (confirm("Desea que las firmas de responsables vaya en la misma hoja?")) {

    reponsables=0;
}


myWindow2=window.open('reportes/reportes_data.php?seccion='+seccion+'&idsec='+id+'&dhoja='+reponsables,'ventana_evaluacion','width=950,height=600,scrollbars=YES');
myWindow2.focus();

}


function ver_informepdf(seccion,id)
{

var reponsables;
reponsables=1;
if (confirm("Desea que las firmas de responsables vaya en la misma hoja?")) {

    reponsables=0;
}

myWindow2=window.open('reportes/reportes_datapdf.php?seccion='+seccion+'&idsec='+id+'&dhoja='+reponsables,'ventana_evaluacion','width=950,height=600,scrollbars=YES');
myWindow2.focus();

}



function ver_informealta(seccion,id)
{

var reponsables;
reponsables=1;
if (confirm("Desea que las firmas de responsables vaya en la misma hoja?")) {

    reponsables=0;
}


myWindow2=window.open('reportes/reportes_alta.php?seccion='+seccion+'&idsec='+id+'&dhoja='+reponsables,'ventana_evaluacion','width=950,height=600,scrollbars=YES');
myWindow2.focus();

}

function ver_informedeser(seccion,id)
{

var reponsables;
reponsables=1;
if (confirm("Desea que las firmas de responsables vaya en la misma hoja?")) {

    reponsables=0;
}


myWindow2=window.open('reportes/reportes_deser.php?seccion='+seccion+'&idsec='+id+'&dhoja='+reponsables,'ventana_evaluacion','width=950,height=600,scrollbars=YES');
myWindow2.focus();

}


function ver_informeevolucion(seccion,id)
{

var reponsables;
reponsables=1;
if (confirm("Desea que las firmas de responsables vaya en la misma hoja?")) {

    reponsables=0;
}

myWindow2=window.open('reportes/reportes_dataevolucion.php?seccion='+seccion+'&idsec='+id+'&dhoja='+reponsables,'ventana_evaluacion','width=950,height=600,scrollbars=YES');
myWindow2.focus();

}

//-->
</script>
<?php
	  
	        $ver_boton=1;
			//---ENLACE
			$valoralet=mt_rand(1,50000);
			$aletorioid=$_SESSION['ces1313777_sessid_cedula'].date("Ymdhis").$valoralet;
			//----
			
	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
			$objformulario->sendvar["clie_idx"]=$_POST["pVar2"];
			$objformulario->sendvar["codex"]=$aletorioid;
			$objformulario->sendvar["centro_idx"]='1';
			
			$objformulario->sendvar["hcx"]=$rs_dcliente->fields["clie_rucci"];
			$objformulario->sendvar["atenc_fechaingresox"]=date("Y-m-d H:i:s");
			$objformulario->sendvar["atenc_fechasalidax"]=date("Y-m-d H:i:s");
			$objformulario->sendvar["tiposerv_idx"]=2;
			$objformulario->sendvar["estaatenc_idx"]=0;
			
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
			
			$valoralet=mt_rand(1,500);
			$aletorioid='01'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			
			$objformulario->sendvar["atenc_enlacex"]=$aletorioid;
	
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
			
		//if($csearch)
        //{	
		//echo getcwd();	 
		$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess);
		?>
		<div id="alert_data1" align="center" style="color:#FF0000; font-size:12px; font-weight:bold">...</div>
		<div id="block_data1" >
		<?php
		$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess);
		$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess);
		?>
		</div>
		<?php
		
		$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess);
		$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess);
		$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess);
		$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess);
		//}
		
		
$datos_cle="select grp_id from app_cliente where clie_id='".$objformulario->contenid["clie_id"]."'";
$rs_cle = $DB_gogess->executec($datos_cle,array());
if($rs_cle->fields["grp_id"]==2)
	{
?>		
<a href="plan.pdf" target="_blank" ><b><img src="images/emb.jpg" width="40" height="73" />Plan Nacional de Reducci&oacute;n Acelerada de la Mortalidad Materna y Neonatal</b></a>
<?php
	}	

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
<div id="divBody_informes" ></div>

<script>
 	  $(function() {
            $( "#prod_codigox" ).autocomplete({
               source: "templateformsweb/maestro_standar_atencion/searchpro.php",
               minLength: 1,
			   select: function( event, ui ) {
				  $('#prod_descripcionx').val(ui.item.descripcion);
				  $('#prod_preciox').val(ui.item.precio);
					
			   }
            });
         });
		 
		  $(function() {
            $( "#inven_descripcionx" ).autocomplete({
               source: "templateformsweb/maestro_standar_atencion/searchmed.php",
               minLength: 1,
			   select: function( event, ui ) {
				  $('#inven_codigox').val(ui.item.codigo);
				  $('#inven_valorunitx').val(ui.item.valorunitario);
					
			   }
            });
         });
		 
		 
		 $(function() {
            $( "#diagn_ciex" ).autocomplete({
               source: "templateformsweb/maestro_standar_atencion/searchcie.php",
               minLength: 1,
			   select: function( event, ui ) {
				  $('#diagn_descripcionx').val(ui.item.descripcion);
					
			   }
            });
         });
		 
		 
		   $( "#esept_id" ).change(function() {
			   
                     if( $("#esept_id").val()==7 || $("#esept_id").val()==8 )
						{ 
					 $("#alert_data1").html("");
					$("#block_data1").show();
					 }
					 else
						{ 
					 $("#alert_data1").html("Alerta!! Excepci&oacute;n de Cobertura...");
					 $("#block_data1").hide();
					 } 
					 
				});


<?php
if($objformulario->contenid["atenc_hc"]=='')
{
  echo "guardar_unasolaves('form_dns_atencion')";
}


?>		
 
</script>
<div id="div_alerta"></div>
<?php
echo $objformulario->generar_formulario_cfechas($table,$DB_gogess);
?>
<a id="un-guardar"></a>