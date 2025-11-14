<?php 

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");
		    $objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
            $objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			$objformulario->sendvar["emp_idx"]=$_SESSION['ces1313777_sessid_emp_id'];
			
			$objformulario->sendvar["solofechax"]=date("Y-m-d");
			
			$objformulario->sendvar["tipom_idx"]=1;
			$objformulario->sendvar["tipomov_idx"]=17;
			
			$codig_unicovalor='';
			$unico_number='';
			$unico_number=strtoupper(uniqid());			
			$codig_unicovalor=date("Y-m-d").$_SESSION['ces1313777_sessid_inicio'].$unico_number;
					
			$objformulario->sendvar["compra_numeroprocesox"]=$codig_unicovalor;					
			$objformulario->sendvar["compra_enlacex"]=$codig_unicovalor;
			
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

?>
<?php
$compra_procesado=0;
if($csearch)
{
  $busca_ccerradap="select * from dns_compras where compra_id='".$csearch."'";
  $rs_ccerrado = $DB_gogess->executec($busca_ccerradap,array());
  
  $compra_procesado=$rs_ccerrado->fields["compra_procesado"];
}
//echo $compra_procesado;
if($compra_procesado==1)
{
  echo "COMPRA YA PROCESADA EN BODEGA NO PUEDE SER MODFICADO";
  
  $objformulario->bloqueo_valor=1;
}

$busca_xmlexistentex="select compretcab_estadosri from comprobante_retencion_cab where compretcab_anulado!='1' and compra_id='".$objformulario->contenid["compra_id"]."'";
$rs_xmlexternox = $DB_gogess->executec($busca_xmlexistentex,array());
$xml_sri=$rs_xmlexternox->fields["compretcab_estadosri"];

if($xml_sri=='AUTORIZADO' or $xml_sri=='RECIBIDA')
{
?>	
 <fieldset disabled>
<?php
}
?>
<hr />
<?php		 
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
?>
<center>
<input type="button" name="Submit" value="CARGAR XML" onclick="leer_xml()" class="btn btn-default" >&nbsp;&nbsp;&nbsp;<input type="button" name="Submit" value="VER DETALLES XML" onclick="verdetalles_xml()" class="btn btn-default" ></center>
<div id="procesa_xml"></div>

<hr />
<?php
$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 
?>
<hr />
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess); 
?>
<hr />
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess); 
?>
<?php
if($xml_sri=='AUTORIZADO' or $xml_sri=='RECIBIDA')
{					
?>
 </fieldset>
<?php
}
?>

<div class="row">  

  <div id="div_panelprecuenta" class="col-sm-1">
	<div id="precuentapanel_btn" ><div onClick="crear_dataformcobropagoc($('#compra_id').val(),'2')" style="cursor:pointer" ><img src="images/cobropago.png" width="60px" ></div></div>	
  </div> 
  
   <div id="div_panelcruze" class="col-sm-1">
	<div id="crucepanel_btn" ><div onClick="crear_dataformcruce($('#compra_id').val(),'2')" style="cursor:pointer" ><img src="images/cruce.png" width="60px" ></div></div>	
  </div> 

</div>

<br /><br /><br />

<input type="button" name="btn_productos_id" id="btn_productos_id" value="PRODUCTOS" onclick="ocultar_mostrar3('productos_id')" />
<input type="button" name="btn_cuentas_id" id="btn_cuentas_id" value="CUENTAS"  onclick="ocultar_mostrar3('cuentas_id')" />
<input type="button" name="btn_fpago_id" id="btn_fpago_id" value="FORMA DE PAGO"  onclick="ocultar_mostrar3('fpago_id')" />
<input type="button" name="btn_afijo_id" id="btn_afijo_id" value="ACTIVOS FIJOS"  onclick="ocultar_mostrar3('afijo_id')" />
<input type="button" name="btn_retenciones_id" id="btn_retenciones_id" value="RETENCIONES"  onclick="ocultar_mostrar3('retenciones_id')" />

<div id="productos_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess); 
?>
</div>
<div id="cuentas_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,8,$DB_gogess); 
?>
</div>

<div id="fpago_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,9,$DB_gogess); 
?>
</div>

<div id="afijo_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,10,$DB_gogess); 
?>
</div>

<div id="retenciones_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,14,$DB_gogess); 
?>

</div>


<?php
if($xml_sri=='AUTORIZADO' or $xml_sri=='RECIBIDA')
{
?>	
 <fieldset disabled>
<?php
}

$objformulario->generar_formulario_bootstrap(@$submit,$table,11,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,12,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,13,$DB_gogess); 

if($xml_sri=='AUTORIZADO' or $xml_sri=='RECIBIDA')
{					
?>
 </fieldset>
<?php
}
?>


<?php       
$objformulario->generar_formulario_bootstrap(@$submit,$table,15,$DB_gogess); 
?>
<center>
<input type="button" name="Submit2" value="GUARDAR DESCRIPCION" onclick="guardardesc_xml()" />
<div id="procesa_gu"></div>
</center>
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

<div id="divBody_proveedor"></div>

<div id="divBody_listadetalles"></div>

<script type="text/javascript">
<!--
//$( "#usua_fechaingrero" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_desde" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_hasta" ).datepicker({dateFormat: 'yy-mm-dd'});

<?php
echo $rs_tabla->fields["tab_codigo"];
?>


function guardardesc_xml()
{
      
	  $("#procesa_gu").load("templateformsweb/maestro_standar_compras/guarda_desc.php",{
        compra_id:$('#compra_id').val(),
		compra_descripcion:$('#compra_descripcion').val(),
		compra_parainv:$('#compra_parainv').val()
	  },function(result){  
	
	
	  });  
	
	  $("#procesa_gu").html("Espere un momento..."); 

}



function leer_xml()
{
	if($('#compra_xml').val()=='')
	{
	  alert("Subir xml al sistema para procesar");
	  return false;
	}

	  $("#procesa_xml").load("templateformsweb/maestro_standar_compras/procesa_xml.php",{
        compra_xml:$('#compra_xml').val()
	  },function(result){  
	
	
	  });  
	
	  $("#procesa_xml").html("Espere un momento..."); 

}



$('#proveevar_id_despliegue').html("<table cellspacing='2' border='0'><tbody><tr><td onclick='buscar_proveedor_actualizar()' style='cursor:pointer'><img src='images/moreedit.png' width='20' height='18'></td></tr> </tbody></table>");


function buscar_proveedor_actualizar()
{
   
abrir_standar("templateformsweb/maestro_standar_compras/proveedor_d/grid_nuevo_proveedor.php","Proveedor","divBody_proveedor","divDialog_proveedor",750,450,0,$('#proveevar_id').val(),0,0,0,0,0);
	 
}

function verdetalles_xml()
{

abrir_standar("templateformsweb/maestro_standar_compras/detallesxml/panel_lista.php","Proveedor","divBody_listadetalles","divDialog_listadetalles",850,450,0,$('#compra_claveacceso').val(),0,0,0,0,0);
	 
	 
}

function actualiza_despuesg()
{   
   actualiza_cmb1();
   //$('#proveevar_id').val($('#provee_id').val());
}


function actualiza_cmb1()
{
     
	 $("#cmb_proveevar_id").load("templateformsweb/maestro_standar_compras/proveedor_d/cmb_proveedor.php",{

	  },function(result){  
	  //alert($('#provee_id').val());
	     $('#proveevar_id').val($('#provee_id').val());
		    
	  });  
	
	  $("#cmb_proveevar_id").html("...");  

}

 function ocultar_mostrar3(muestra)
  {
  
    $('#productos_id').hide();
	cambio_inactivo('productos_id',0);
    $('#cuentas_id').hide();
	cambio_inactivo('cuentas_id',0);
	$('#fpago_id').hide();
	cambio_inactivo('fpago_id',0);	
	$('#afijo_id').hide();
	cambio_inactivo('afijo_id',0);
	$('#retenciones_id').hide();
	cambio_inactivo('retenciones_id',0);
	
	$('#'+muestra).show();
	cambio_inactivo(muestra,1);
  
  }	

  ocultar_mostrar3('productos_id');

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
  
  
function buscar_dataform(id)
{

abrir_standar('templateformsweb/maestro_standar_compras/buscadorform/busca_data.php','Buscador','divBody_buscadorgeneral','divDialog_buscadorgeneral',550,500,id,0,0,0,0,0,0);

}

function crear_dataform(id,valor)
{

abrir_standar('templateformsweb/maestro_standar_compras/crearform/formulario.php','New','divBody_buscadorgeneral','divDialog_buscadorgeneral',550,500,id,valor,0,0,0,0,0);

}




$( "#compra_anulado" ).click(function() {
   actualiza_anulado();
});

function actualiza_anulado()
{
    if($('#compra_id').val()=='')
	{
	  alert("Para anular una compra debe estar guardado el registro...");
	  $('#compra_anulado').prop('checked', false);
	  return false;
	}

	 $("#anula_data").load("templateformsweb/maestro_standar_compras/anula.php",{
         compra_id:$('#compra_id').val(),
	     anulado:$('input:checkbox[name=compra_anulado]:checked').val()
	  },function(result){  
	  //alert($('#provee_id').val());
	     
		    
	  });  
	
	  $("#anula_data").html("...");  

}



function verdetallesret_xml()
{

if($('#compra_id').val()=='')
{
  alert("Para generar la retencion el documento se debe guardar");
  return false;
}

abrir_standar("templateformsweb/maestro_standar_compras/detallesxml/panelret_lista.php","GENERAR_RETENCION","divBody_listadetalles","divDialog_listadetalles",850,450,0,$('#compra_id').val(),0,0,0,0,0);
	 
	 
}



function crear_dataformcruce(doccab_id,tipo)
{
//1 cobro
//2 pago
if($('#compra_id').val()=='')
{
 alert("Guarde el registro para registrar el pago");
 return false;
}

abrir_standar('templateformsweb/maestro_standar_compras/crearformcruce/formulario.php','New','divBody_cobropago','divDialog_cobropago',900,700,doccab_id,tipo,0,0,0,0,0);

}


function crear_dataformcobropagoc(doccab_id,tipo)
{
//1 cobro
//2 pago
if($('#compra_id').val()=='')
{
 alert("Guarde el registro para registrar el pago");
 return false;
}

abrir_standar('templateformsweb/maestro_standar_compras/crearformobropago/formulario.php','New','divBody_cobropago','divDialog_cobropago',900,700,doccab_id,tipo,0,0,0,0,0);

}

<?php
if($objformulario->bloqueo_valor==1 or $xml_sri=='AUTORIZADO' or $xml_sri=='RECIBIDA')
{
?>
$('#boton_guardarformdata2').hide();
<?php
}
?>
//  End -->
</script>

<div id="divBody_cobropago"></div>

<div id="anula_data"></div>
<?php
echo $objformulario->generar_formulario_nfechas($table,$DB_gogess);
?>
