<script language="javascript">
<!--

function ver_reporte(atenc_id) {
 myWindow2=window.open('reportes/reporte_evaluacion.php?atenc_id='+atenc_id,'ventana_evaluacion','width=750,height=500,scrollbars=YES');
 myWindow2.focus();

}

function ver_informe(seccion,id)
{

myWindow2=window.open('reportes/reportes_data.php?seccion='+seccion+'&idsec='+id,'ventana_evaluacion','width=950,height=600,scrollbars=YES');
myWindow2.focus();

}

function ver_informealta(seccion,id)
{

myWindow2=window.open('reportes/reportes_alta.php?seccion='+seccion+'&idsec='+id,'ventana_evaluacion','width=950,height=600,scrollbars=YES');
myWindow2.focus();

}

function ver_informedeser(seccion,id)
{

myWindow2=window.open('reportes/reportes_deser.php?seccion='+seccion+'&idsec='+id,'ventana_evaluacion','width=950,height=600,scrollbars=YES');
myWindow2.focus();

}

//-->
</script>
<?php
	  
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
			$objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			
			$objformulario->sendvar["hcx"]=$rs_dcliente->fields["clie_rucci"];
			 
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
			
			$valoralet=mt_rand(1,500);
			$aletorioid='01'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			
			$objformulario->sendvar["atenc_enlacex"]=$aletorioid;
			
			
			
		//echo getcwd();	 
?>
<div class="form-group">	
<div class="col-md-12">
<?php
$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 
?>
</div>
</div>

<table width="300" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="142" onclick="abrir_standar('templateformsweb/maestro_standar_atencion/informe_alta.php','INFORME_ALTA','divBody_informes','divDialog_informes',800,600,$('#clie_id').val(),$('#atenc_id').val(),'','','','','');" style="cursor:pointer"><div align="center"><img src="images/informes_alta.png" width="120" height="131" /></div></td>
    <td width="21">&nbsp;</td>
    <td width="137" onclick="abrir_standar('templateformsweb/maestro_standar_atencion/informe_desercion.php','INFORME_DESERCION','divBody_informes','divDialog_informes',800,600,$('#clie_id').val(),$('#atenc_id').val(),'','','','','');" style="cursor:pointer" ><div align="center"><img src="images/informes_desercion.png" width="120" height="131" /></div></td>
  </tr>
</table>

<div class="form-group">
<div class="col-md-12">
<?php
if($csearch)
{
$objformulario->generar_formulario(@$submit,$table,2,$DB_gogess); 
}
?>
</div>
</div>



<div class="form-group">
<div class="col-md-12">
<?php
if($csearch)
{
$objformulario->generar_formulario(@$submit,$table,3,$DB_gogess); 
}
?>
</div>
</div>

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
</script>

