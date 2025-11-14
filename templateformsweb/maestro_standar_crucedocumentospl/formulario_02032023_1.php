<?php  

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d");	
		    $objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];			
			$objformulario->sendvar["usr_tpingx"]=0;
			$objformulario->sendvar["tipocmp_codigox"]='01';
			$objformulario->sendvar["estaf_idx"]='1';
			$objformulario->sendvar["origenx"]='MANUAL';
			$objformulario->sendvar["tippo_idx"]=3;
			
            
			$valoralet=mt_rand(1,500);
			$nunico=strtoupper(uniqid());
			$aletorioid='01'.$nunico.$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["doccab_idx"]=$aletorioid;
			
            $busca_emp="select * from app_empresa where emp_id='".$_SESSION['ces1313777_sessid_emp_id']."'";
            $rs_femp = $DB_gogess->executec($busca_emp,array());
            $rucempresa=$rs_femp->fields["emp_ruc"];
			$objformulario->sendvar["doccab_rucempresax"]=$rucempresa;
			$objformulario->sendvar["ambi_valorx"]=$objimpuestos->ambi_valor;
			$objformulario->sendvar["emis_valorx"]=$objimpuestos->tipoemi_codigo;
			$objformulario->sendvar["tipase_idx"]=10;
			$objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			
			$objformulario->sendvar["facturaxnum"] ="-factura-";
		    //$generafactura= 
?>			
<?php
            $objformulario->generar_formulario(@$submit,$table,81,$DB_gogess);

$busca_xmlexistentex="select doccab_estadosri from beko_documentocabecera where doccab_id='".$objformulario->contenid["doccab_id"]."'";
$rs_xmlexternox = $DB_gogess->executec($busca_xmlexistentex,array());
$xml_sri=$rs_xmlexternox->fields["doccab_estadosri"];

if($xml_sri=='AUTORIZADO' or $xml_sri=='RECIBIDA')
{
?>
 <fieldset disabled>
<?php
}
			
			$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess);
			$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
			$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess);
			$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess);
			$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess);
			$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess);
			//$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess);
			//$objformulario->generar_formulario_bootstrap(@$submit,$table,8,$DB_gogess); 
			//$objformulario->generar_formulario_bootstrap(@$submit,$table,9,$DB_gogess);	
if($xml_sri=='AUTORIZADO' or $xml_sri=='RECIBIDA')
{					
?>
 </fieldset>
<?php
}

 $tab_id_valor=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_id","where tab_name like",$table,$DB_gogess);
 $lista_detalle="select * from gogess_subgrid where tab_id=".$tab_id_valor; 
 $rs_detalle = $DB_gogess->executec($lista_detalle,array());
?>

<div class="row">
  <div id="div_pdf" class="col-sm-1">
	<div onClick="ver_pdf($('#doccab_id').val(),'01')" style="cursor:pointer" ><img src="images/pdf.png" width="60px" ></div>
  </div>  

  <div id="div_xml" class="col-sm-1">
	<div onClick="ver_xml($('#doccab_id').val(),'01')" style="cursor:pointer" ><img src="images/xml.png" width="60px" ></div>
  </div>

  <div id="div_panelsri" class="col-sm-1">
	<div id="sripanel_btn" ><div onClick="verpanel_sri()" style="cursor:pointer" ><img src="images/sri_panel.png" width="60px" ></div></div>
  </div>  
  
   <div id="div_panelprecuenta" class="col-sm-1">
	<div id="precuentapanel_btn" ><div onClick="verpanel_precuenta()" style="cursor:pointer" ><img src="images/listafactura.png" width="60px" ></div></div>	
  </div> 
  
  <div id="div_panelprecuenta" class="col-sm-1">
	<div id="precuentapanel_btn" ><div onClick="crear_dataformcobropago($('#doccab_id').val(),'1')" style="cursor:pointer" ><img src="images/cobropago.png" width="60px" ></div></div>	
  </div> 

</div>  
<br /><br /><br />

<input type="button" name="btn_crudet_id" id="btn_crudet_id" value="DOCUMENTOS" onclick="ocultar_mostrar3('crudet_id')" />
<input type="button" name="btn_cruant_id" id="btn_cruant_id" value="ANTICIPOS" onclick="ocultar_mostrar3('cruant_id')" />
<input type="button" name="btn_cruant_id" id="btn_cruant_id" value="CUENTAS CONTABLES"  onclick="ocultar_mostrar3('cruant_id')" />
<input type="button" name="btn_frmpven_idpl" id="btn_frmpven_idpl" value="FORMA DE PAGO"  onclick="ocultar_mostrar3('frmpven_idpl')" />

<div id="crudet_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess); 
?>
</div>
<div id="cruant_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,8,$DB_gogess); 
?>
</div>

<div id="frmpven_idpl">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,9,$DB_gogess); 
?>
</div>

<div id="cruant_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,10,$DB_gogess); 
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
			$objformulario->generar_formulario_bootstrap(@$submit,$table,14,$DB_gogess);

if($xml_sri=='AUTORIZADO' or $xml_sri=='RECIBIDA')
{
?>
</fieldset>
<?php
}
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


<script type="text/javascript">
<!--
//$( "#usua_fechaingrero" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_desde" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_hasta" ).datepicker({dateFormat: 'yy-mm-dd'});

<?php
echo $rs_tabla->fields["tab_codigo"];
?>


function verpanel_sri()
{

abrir_standar("templateformsweb/maestro_standar_crucedocumentospl/sri.php","SRI","divBody_insumo","divDialog_insumo",450,280,0,0,0,0,0,0,0);


}

function buscar_dataform(id)
{

abrir_standar('templateformsweb/maestro_standar_crucedocumentospl/buscadorform/busca_data.php','Buscador','divBody_buscadorgeneral','divDialog_buscadorgeneral',550,500,id,0,0,0,0,0,0);

}

function crear_dataform(id,valor)
{

abrir_standar('templateformsweb/maestro_standar_crucedocumentospl/crearform/formulario.php','New','divBody_buscadorgeneral','divDialog_buscadorgeneral',550,500,id,valor,0,0,0,0,0);

}

function llena_cliente()
{
   $("#llena_cliente").load("templateformsweb/maestro_standar_crucedocumentospl/ver_cliente.php",{
    client_id:$('#client_id').val()
  },function(result){  
      
  });  
  $("#llena_cliente").html("Espere un momento...");  

}


$( "#client_id" ).change(function() {
 
 //llena_cliente();
 
});


function ocultar_mostrar3(muestra)
  {
  
    $('#crudet_id').hide();
	cambio_inactivo('crudet_id',0);
    $('#cruant_id').hide();
	cambio_inactivo('cruant_id',0);
	$('#frmpven_idpl').hide();
	cambio_inactivo('frmpven_idpl',0);	
	$('#cruant_id').hide();
	cambio_inactivo('cruant_id',0);
	
	
	$('#'+muestra).show();
	cambio_inactivo(muestra,1);
  
  }	

  ocultar_mostrar3('crudet_id');

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
  


function calculo_vuelto()
		{
		  var doccab_pagacon;
		  var doccab_cambio;
		  var doccab_total;
		  var calculo_vuelto;

		  doccab_pagacon=$('#doccab_pagacon').val();
		  //doccab_cambio=$('#doccab_cambio').val();
		  doccab_total=$('#doccab_total').val();	
		  if(doccab_pagacon>0)
		  {	  
		  calculo_vuelto=parseFloat(doccab_pagacon)-parseFloat(doccab_total);		
		  $('#doccab_cambio').val(calculo_vuelto.toFixed(2));
		  }  
		  else
		  {
		    $('#doccab_cambio').val(0);
		  
		  }
		  		  		  
		  
		
		}



		
function cacula_variosv()
{

var total;
var precio;
var cantidad;
var descuento;

if($('#mhdetfac_descuentox').val()=='')
{
  descuento=parseFloat('0');
}
else
{
  descuento=parseFloat($('#mhdetfac_descuentox').val());
}

precio=parseFloat($('#mhdetfac_precioux').val());
cantidad=parseFloat($('#mhdetfac_cantidadx').val());


total=(precio*cantidad)-descuento;
$('#mhdetfac_totalx').val(total.toFixed(2));

}		



$( "#mhdetfac_precioux" ).change(function() {
		  cacula_variosv();
});
		
$( "#mhdetfac_cantidadx" ).change(function() {
		  cacula_variosv();
});	

$( "#mhdetfac_descuentox" ).change(function() {
          $('#mhdetfac_porcentajex').val('');
		  cacula_variosv();
});	

	

//porcentaje descuento
$( "#mhdetfac_porcentajex" ).change(function() {
   calcula_valordescvarios();
});


function calcula_valordescvarios()
{

  var porcentaje;
  var valorcalculado;
  var preciounitario;
  var cantidad;
  
  preciounitario=parseFloat($('#mhdetfac_precioux').val());
  cantidad=parseFloat($('#mhdetfac_cantidadx').val());
  porcentaje=parseFloat($('#mhdetfac_porcentajex').val());  
  
  if(porcentaje>0)
  {
  valorcalculado=(preciounitario*porcentaje/100)*cantidad;
  
  $('#mhdetfac_descuentox').val(valorcalculado.toFixed(2));
  
  cacula_variosv();
  }
  else
  {
    $('#mhdetfac_descuentox').val('');
	cacula_variosv();
  }
}
//porcentaje descuento

		
		
$( "#doccab_total" ).change(function() {
		  calculo_vuelto();
		});
		
		$( "#doccab_pagacon" ).change(function() {
		  calculo_vuelto();
		
		});
		
		
		$("#doccab_cambio").prop('readonly', true);
		
		

$( "#proveeve_id" ).change(function() {
		  obtiene_cliente();
});
		

function obtiene_cliente()
{
   $("#obtiene_cliente").load("templateformsweb/maestro_standar_crucedocumentospl/obtiene_cliente.php",{
    proveeve_id:$('#proveeve_id').val()
  },function(result){  
      
  });  
  $("#obtiene_cliente").html("Espere un momento...");  

}


function obtiene_clientedos(proveeve_id)
{
   $("#obtiene_cliente").load("templateformsweb/maestro_standar_crucedocumentospl/obtiene_cliente.php",{
    proveeve_id:proveeve_id
  },function(result){  
      
  });  
  $("#obtiene_cliente").html("Espere un momento...");  

}	


function activa_boton()
{

  $("#div_imprimirtiket").html('<a target="_blank" class="btnPrint_imp" href="impresion/imprimir.php?imp=<?php echo $rs_cfgimp->fields["imp_id"]; ?>&pa='+$("#doccab_id").val()+'"  ><img src="images/btn_imp.png" border=0 /></a>');
  $(".btnPrint_imp").printPage();	
  
  $('#div_pdf').show();
  $('#div_xml').show();  
  $('#div_panelsri').show();
  //$('#div_firma').show();
  //$('#div_srienviar').show();
  //$('#div_sriobtener').show();
}



function oculta_boton()
{
  $("#div_imprimirtiket").html('');  
  $('#div_pdf').hide();
  $('#div_xml').hide();
  $('#div_panelsri').hide();
  //$('#div_firma').hide();
  //$('#div_srienviar').hide();
  //$('#div_sriobtener').hide();
}


function activa_desactiva()
{

	if($('#doccab_ndocumento').val()=='-documento-')
	{
	oculta_boton();
	}
	else
	{
	activa_boton();
	}

}




function generar_clave_acceso()
{

 $("#g_claveacceso").load("templateformsweb/maestro_standar_crucedocumentospl/gclavedeacceso.php",{  

      doccab_id:$('#doccab_id').val()

 },function(result){  			

			$('#doccab_clavedeaccesos').val($('#gclaveacceso').val());
			$('#doccab_nautorizacion').val($('#gclaveacceso').val());
			$('#despliegue_doccab_nautorizacion').html($('#gclaveacceso').val());		

			genera_xml();			

  });  
  $("#g_claveacceso").html("Espere un momento...");
}	


function genera_xml()
{


$("#genera_xml").load("templateformsweb/maestro_standar_crucedocumentospl/generar_xml.php",{

   enlace:$('#<?php echo $rs_detalle->fields["subgri_campoenlace"]; ?>').val()  

 },function(result){       

		activa_desactiva();
		$('#genera_xmlfirmado').html("");
		$('#guarda_firma').html("");
		activa_proceso();
			
  });  



$("#genera_xml").html("Espere un momento...");



}

//  End -->
</script>
<?php
echo $objformulario->generar_formulario_nfechas($table,$DB_gogess);
?>

<div id="obtiene_cliente"></div>
<div id="divBody_buscadorgeneral"></div>
<div id="llena_cliente"></div>

<div id="divBody_fpago" ></div>
<div id="g_claveacceso"> <input name="gclaveacceso" type="hidden" id="gclaveacceso" value=""> </div>
<div id="divBody_insumo" ></div>
<div id="grid_borraitemv" ></div>

<div id="lista_data_xml">

<div id="genera_xml" >
<?php
$xml_pafirmar='';
if($objformulario->contenid["doccab_id"])
{
$busca_xmlexistente="select doccab_xml from beko_documentocabecera where doccab_id=".$objformulario->contenid["doccab_id"];
$rs_xmlexterno = $DB_gogess->executec($busca_xmlexistente,array());
$xml_pafirmar=$rs_xmlexterno->fields["doccab_xml"];
}
?>
<textarea name="firm_xmldata" id="firm_xmldata"><?php echo $xml_pafirmar; ?></textarea>

</div>

<div id="genera_xmlfirmado" >
<?php
$xml_pafirmarx='';
if($objformulario->contenid["doccab_id"])
{
$busca_xmlexistentex="select doccab_xmlfirmado from beko_documentocabecera where doccab_id=".$objformulario->contenid["doccab_id"];
$rs_xmlexternox = $DB_gogess->executec($busca_xmlexistentex,array());
$xml_pafirmarx=$rs_xmlexternox->fields["doccab_xmlfirmado"];
}
?>
<textarea name="firm_xmldatafirmado" id="firm_xmldatafirmado"><?php echo $xml_pafirmarx; ?></textarea>
</div>

</div>

<div id="sri_panel"></div>

<div id="guarda_firma"></div>

<div id="divBody_pacientedata"></div>

<?php
//echo "sssssssssss".$objformulario->contenid["doccab_estadosri"];
$envio_valorvert=0;
if($objformulario->contenid["doccab_id"])
{
	$busca_estado_sri="select doccab_estadosri from beko_recibocabecera where doccab_id='".$objformulario->contenid["doccab_id"]."'";
	$rs_bsri = $DB_gogess->executec($busca_estado_sri,array());
	if($rs_bsri->fields["doccab_estadosri"]=='AUTORIZADO')
	{
	  $envio_valorvert=1;
	  echo "<B>DOCUMENTO FUE AUTORIZADO EN EL SRI</B>";
	  ?>
<script language="javascript">
<!--
	  $("#doccab_rucci_cliente").attr('disabled','disabled');	  
	  $("#tipoident_codigo").attr('disabled','disabled');
	  $("#doccab_nombrerazon_cliente").attr('disabled','disabled');
	  $("#doccab_direccion_cliente").attr('disabled','disabled');
	  $("#doccab_telefono_cliente").attr('disabled','disabled');
	  $("#doccab_email_cliente").attr('disabled','disabled');
	  $("#doccab_ndet").attr('disabled','disabled');
	 
	  
	   
	    $("#fpago_btn").hide();
	    $("#insumo_btn").hide();
		//$("#terapia_btn").hide();
		$("#libre_btn").hide();
		$("#firma_btn").hide();
		
		$("#sri_btn").hide();
		$("#guardab_btn").hide();
		
	  
//-->
</script>  
	
	  <?php
	}

}
?>

<script type="text/javascript">
<!--

function hill_ver()
{
abrir_standar("templateformsweb/maestro_standar_crucedocumentospl/mghill.php","TARIFARIO","divBody_insumo","divDialog_insumo",900,600,$('#doccab_id').val(),0,$('#doccab_id').val(),0,$('#conve_id').val(),$('#doccab_autorizacion').val(),'<?php echo $envio_valorvert; ?>');
}

function activa_proceso()
{
   if($('#queejecuta').val()==1)
   {   
      ver_pdf($('#doccab_id').val(),'01');
   }
   
   if($('#queejecuta').val()==2)
   {   
      ver_xml($('#doccab_id').val(),'01')
   }
   
   $('#queejecuta').val(0);

}

function verpanel_precuenta()
{

abrir_standar("templateformsweb/maestro_standar_crucedocumentospl/precuenta.php","PRECUENTAS","divBody_insumo","divDialog_insumo",800,480,$('#doccab_identificacionpaciente').val(),$('#doccab_pgacont').val(),0,0,0,0,0);


}


$( "#doccab_identificacionpaciente" ).change(function() {
		obtiene_seguro(); 
});


function obtiene_seguro()
{
   $("#obtiene_seguro").load("templateformsweb/maestro_standar_crucedocumentospl/obtiene_seguro.php",{
    doccab_identificacionpaciente:$('#doccab_identificacionpaciente').val()
  },function(result){  
      
  });  
  $("#obtiene_seguro").html("Espere un momento...");  

}



function ver_xml(idfactura,opcion)
{

  if(opcion=='01')
	{
			 window.location.href='xmlfacturas/ver.php?xml=' + idfactura;
	}
			 
     if(opcion=='04')
	{
			 window.location.href='xmlfacturas/ver.php?xml=' + idfactura;
	}
	 if(opcion=='05')
	{
			 window.location.href='xmlfacturas/ver.php?xml=' + idfactura;
	}
	
	 if(opcion=='06')
	{
			 window.location.href='xmlfacturas/ver.php?xml=' + idfactura;
	}
	 if(opcion=='07')
	{
			 window.location.href='xmlfacturas/ver.php?xml=' + idfactura;
	}



}	



function ver_pdf(idfactura,opcion)
{

	if(opcion=='01')
	{
			 window.location.href='pdffacturas/pdf.php?xml=' + idfactura;
	}
			 
     if(opcion=='04')
	{
			 window.location.href='pdfcredito/pdf.php?xml=' + idfactura;
	}
	 if(opcion=='05')
	{
			 window.location.href='pdfdebito/pdf.php?xml=' + idfactura;
	}
	
	 if(opcion=='06')
	{
			 window.location.href='pdfguia/pdf.php?xml=' + idfactura;
	}
	 if(opcion=='07')
	{
			 window.location.href='pdfsretencion/pdf.php?xml=' + idfactura;
	}

}


$('#lista_data_xml').hide();

function crear_dataformcobropago(doccab_id,tipo)
{
//1 cobro
//2 pago
if($('#doccab_ndocumento').val()=='-documento-')
{
 alert("Guarde el registro para realizar el cobro");
 return false;
}

abrir_standar('templateformsweb/maestro_standar_crucedocumentospl/crearformobropago/formulario.php','New','divBody_cobropago','divDialog_cobropago',900,700,doccab_id,tipo,0,0,0,0,0);

}



function firma_directa(idfactura)
{

if($('#doccab_ndocumento').val()!='-documento-')
{ 
 
//=============================================
$("#area_sri").load("sdk/firma_directafac.php",{
   doccab_id:$('#doccab_id').val()
 },function(result){       	 

  });  
$("#area_sri").html("Espere un momento...");
//================================================

}
else
{
 alert('Porfavor guarde la factura para poder firmarla');
}

}


//=====================================

function enviar_sri(doccab_id)
{
  
  
$("#area_sri").load("sdk/envio_srifac.php",{
     doccab_id:doccab_id
 },function(result){
  });  

$("#area_sri").html("Espere un momento...");


}

//=====================================

function obtener_sri(doccab_id)
{

$("#area_sri").load("sdk/autoriza_srifac.php",{
     doccab_id:doccab_id
 },function(result){
  });  

$("#area_sri").html("Espere un momento...");

}


function enviar_correo()
{

$("#area_sri").load("correo/email_factura.php",{

     doccab_id:$('#doccab_id').val()

 },function(result){       


  });  

$("#area_sri").html("Espere un momento...");

}


<?php


if($xml_sri=='AUTORIZADO' or $xml_sri=='RECIBIDA')
{
?>
 $('#btn_grabardata').hide();
 $('#btn_grabardata2').hide();
 $('#precuentapanel_btn').hide();
<?php
}
else
{
?>
$('#btn_grabardata').show();
$('#btn_grabardata2').show();
$('#precuentapanel_btn').show();
<?php
}
?>

//-->
</script> 
<div id="divBody_cobropago"></div>
<div id="obtiene_seguro"></div>
<input name="queejecuta" type="hidden" id="queejecuta" value="0" />


