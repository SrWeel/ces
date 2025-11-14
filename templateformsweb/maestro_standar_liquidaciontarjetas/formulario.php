<?php
  

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");
			$objformulario->sendvar["solofechax"]=date("Y-m-d");
		    $objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
            $objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			$objformulario->sendvar["emp_idx"]=$_SESSION['ces1313777_sessid_emp_id'];		
			
			$objformulario->sendvar["ttra_idx"]=1;
			
			
			$objformulario->sendvar["tipom_idx"]=1;
			$objformulario->sendvar["tipomov_idx"]=17;
			$objformulario->sendvar["estcompt_idx"]=1;
			
			
			$codig_unicovalor='';
			$unico_number='';
			$unico_number=strtoupper(uniqid());			
			$codig_unicovalor=date("Y-m-d").$_SESSION['ces1313777_sessid_inicio'].$unico_number;
					
			$objformulario->sendvar["compra_numeroprocesox"]=$codig_unicovalor;					
			$objformulario->sendvar["tpliq_enlacex"]=$codig_unicovalor;
			
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
	 
$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess);

?>
<br /><br />

<div class="row">
  
   <div id="div_panelascontable" class="col-sm-1">
	<div id="ascontable_btn" >
	   <div onClick="ver_asientoliquidtarje($('#ldtc_id').val())" style="cursor:pointer" ><img src="images/ascontable.png" width="60px" >
	   </div>
	 </div>	
  </div> 

</div> 
<br />
<input type="button" name="btn_transaccion_id" id="btn_transaccion_id" value="TRANSACCIONES" onclick="ocultar_mostrar3('transaccion_id')" />
<input type="button" name="btn_retencioncl_id" id="btn_retencioncl_id" value="RETENCIONES"  onclick="ocultar_mostrar3('retencioncl_id')" />
<div id="transaccion_id" >
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
?>
</div>
<div id="retencioncl_id" >
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
  
    $('#transaccion_id').hide();
	cambio_inactivo('transaccion_id',0);
    $('#retencioncl_id').hide();
	cambio_inactivo('retencioncl_id',0);
	
	
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
  
  
<?php
if(!($csearch))
{
?> 
  showUser_combog('frocob_id',$('#ttra_id').val(),'divfrocob_id','ttra_id','lpin_cobropago','',0,0,0,0,0);   
  
<?php
}
?>

function cambia_transaccion()
{

   if($('#ttra_id').val()=='1')
   {   
      $('#bloque_subfp_id').hide();   
   }
   
    if($('#ttra_id').val()=='2')
   {   
      $('#bloque_subfp_id').show();   
   }
   
}

function cambio_fco()
{
   var jsLang = $("#frocob_id").val();
  // alert($('#ttra_id').val());
   
   if($('#ttra_id').val()=='1')
   {   
    //cobro
	switch (jsLang) 
	{ 
		case '1': 
			{
			   $('#bloque_proveep_id').show();
			   $('#bloque_crb_cuenta').show();
			   $('#bloque_crb_ncomprobante').show();
			   $('#bloque_crb_descripcion').show();
			   
			   $('#bloque_crb_ncheque').hide();
			   $('#bloque_crb_fechacheque').hide();
			   $('#bloque_cuentb_id').hide();
			   $('#bloque_crb_efectivo').show();
			   $('#bloque_lote_id').hide();
			}
			break;
		case '2': 
			{
			   $('#bloque_proveep_id').show();
			   $('#bloque_crb_cuenta').show();
			   $('#bloque_crb_ncomprobante').show();
			   $('#bloque_crb_descripcion').show();
			   
			   $('#bloque_crb_ncheque').show();
			   $('#bloque_crb_fechacheque').show();
			   
			   $('#bloque_cuentb_id').hide();
			   $('#bloque_crb_efectivo').hide();
			   $('#bloque_lote_id').hide();
			
			}
			break;
		case '3': 
			{
			  
			   $('#bloque_proveep_id').show();
			   $('#bloque_crb_cuenta').hide();
			   $('#bloque_crb_ncomprobante').show();
			   $('#bloque_crb_descripcion').show();
			   
			   $('#bloque_crb_ncheque').hide();
			   $('#bloque_crb_fechacheque').hide();
			   
			   $('#bloque_cuentb_id').show();
			   $('#bloque_crb_efectivo').hide();
			   $('#bloque_lote_id').hide();
			
			}
			break;		
		case '4': 
			{
			   $('#bloque_proveep_id').show();
			   $('#bloque_crb_cuenta').show();
			   $('#bloque_crb_ncomprobante').show();
			   $('#bloque_crb_descripcion').show();
			   
			   $('#bloque_crb_ncheque').hide();
			   $('#bloque_crb_fechacheque').hide();
			   
			   $('#bloque_cuentb_id').hide();
			   $('#bloque_crb_efectivo').hide();
			   $('#bloque_lote_id').show();
			
			}
			break;
			
		case '5': 
			{
			   $('#bloque_proveep_id').show();
			   $('#bloque_crb_cuenta').show();
			   $('#bloque_crb_ncomprobante').show();
			   $('#bloque_crb_descripcion').show();
			   
			   $('#bloque_crb_ncheque').hide();
			   $('#bloque_crb_fechacheque').hide();
			   
			   $('#bloque_cuentb_id').hide();
			   $('#bloque_crb_efectivo').hide();
			   $('#bloque_lote_id').hide();
			
			}
			break;
		default:
			{
			}
	}
   //cobro
   }
   
   if($('#ttra_id').val()=='2')
   {  
   //pago
  
   switch (jsLang) 
	{ 
		
		case '6': 
			{
			   $('#bloque_proveep_id').show();
			   $('#bloque_crb_cuenta').show();
			   $('#bloque_crb_ncomprobante').show();
			   $('#bloque_crb_descripcion').show();
			   $('#bloque_crb_paguesealaorden').show();
			   
			   $('#bloque_crb_ncheque').show();
			   $('#bloque_crb_fechacheque').show();
			   
			   $('#bloque_cuentb_id').hide();
			   $('#bloque_crb_efectivo').hide();
			   $('#bloque_lote_id').hide();
			   $('#bloque_subfp_id').show();  
			
			}
			break;
		case '7': 
			{
			  
			   $('#bloque_proveep_id').show();
			   $('#bloque_crb_cuenta').hide();
			   $('#bloque_crb_ncomprobante').show();
			   $('#bloque_crb_descripcion').show();
			   
			   $('#bloque_crb_ncheque').hide();
			   $('#bloque_crb_fechacheque').hide();
			   
			   $('#bloque_cuentb_id').show();
			   $('#bloque_crb_efectivo').hide();
			   $('#bloque_lote_id').hide();
			   $('#bloque_subfp_id').show();  
			   $('#bloque_crb_paguesealaorden').hide();
			
			}
			break;		
		case '8': 
			{
			   $('#bloque_proveep_id').show();
			   $('#bloque_crb_cuenta').show();
			   $('#bloque_crb_ncomprobante').show();
			   $('#bloque_crb_descripcion').show();
			   
			   $('#bloque_crb_ncheque').hide();
			   $('#bloque_crb_fechacheque').hide();
			   
			   $('#bloque_cuentb_id').hide();
			   $('#bloque_crb_efectivo').hide();
			   $('#bloque_lote_id').hide();
			   $('#bloque_subfp_id').hide();  
			   $('#bloque_crb_paguesealaorden').hide();
			
			}
			break;
			
		case '9': 
			{
			   $('#bloque_proveep_id').show();
			   $('#bloque_crb_cuenta').show();
			   $('#bloque_crb_ncomprobante').show();
			   $('#bloque_crb_descripcion').show();
			   
			   $('#bloque_crb_ncheque').hide();
			   $('#bloque_crb_fechacheque').hide();
			   
			   $('#bloque_cuentb_id').hide();
			   $('#bloque_crb_efectivo').hide();
			   $('#bloque_lote_id').hide();
			   $('#bloque_subfp_id').show(); 
			   $('#bloque_crb_paguesealaorden').hide();
			
			}
			break;
		case '10': 
			{
			   $('#bloque_proveep_id').show();
			   $('#bloque_crb_cuenta').show();
			   $('#bloque_crb_ncomprobante').show();
			   $('#bloque_crb_descripcion').show();
			   
			   $('#bloque_crb_ncheque').hide();
			   $('#bloque_crb_fechacheque').hide();
			   
			   $('#bloque_cuentb_id').hide();
			   $('#bloque_crb_efectivo').hide();
			   $('#bloque_lote_id').hide();
			   $('#bloque_subfp_id').hide();
			   $('#bloque_crb_paguesealaorden').hide();  
			
			}
			break;	
		default:
			{
			}
	}
   
   
   //pago
   }
   
   

 
}

$('#bloque_crb_ncheque').hide();
$('#bloque_crb_fechacheque').hide();
$('#bloque_cuentb_id').hide();
$('#bloque_lote_id').hide();
$('#bloque_crb_efectivo').hide();
$('#bloque_crb_paguesealaorden').hide();
$('#bloque_subfp_id').hide();



function buscar_dataform(id)
{

abrir_standar('templateformsweb/maestro_standar_conciliaciontarjetas/buscadorform/busca_data.php','Buscador','divBody_buscadorgeneral','divDialog_buscadorgeneral',550,500,id,$('#frocob_id').val(),0,0,0,0,0);

}

function crear_dataform(id,valor)
{

abrir_standar('templateformsweb/maestro_standar_conciliaciontarjetas/crearform/formulario.php','New','divBody_buscadorgeneral','divDialog_buscadorgeneral',550,500,id,valor,0,0,0,0,0);

}

function despliega_camposdata()
{

  //alert($('#tpliq_id').val());
   // 1 LIQUIDACION POR FACTURA 
  if($('#tpliq_id').val()=='1')
  {
    //bloque_proveelq_id
	$('#bloque_tpliq_cuentabanco').show();
	$('#bloque_tpliq_ndocumento').show();
	$('#bloque_tpliq_nautorizacion').show();
	$('#bloque_tpliq_cuentacomision').show();
	$('#bloque_centcostlq_id').show();
	$('#bloque_tpliq_valornodeducible').show();	
	//=======================================
	$('#bloque_tpliq_comisionxliquidar').hide();
	$('#bloque_tpliq_ivaporcentaje').hide();
	$('#bloque_tpliq_ceroiva').hide();
	$('#bloque_tpliq_noobjeto').hide();
	$('#bloque_tpliq_iva').hide();
  
  }
  
  // 2 LIQUIDACION POR NOTA DE REDITO 
  
  if($('#tpliq_id').val()=='2')
  {
    //bloque_proveelq_id
	$('#bloque_tpliq_cuentabanco').show();
	$('#bloque_tpliq_ndocumento').show();	
	$('#bloque_centcostlq_id').show();	
	$('#bloque_tpliq_comisionxliquidar').show();
	//=======================================
	$('#bloque_tpliq_valornodeducible').hide();	
	$('#bloque_tpliq_nautorizacion').hide();
	$('#bloque_tpliq_cuentacomision').hide();	
	$('#bloque_tpliq_ivaporcentaje').hide();
	$('#bloque_tpliq_ceroiva').hide();
	$('#bloque_tpliq_noobjeto').hide();
	$('#bloque_tpliq_iva').hide();
  
  }
  
  
  // 3 FACTURA DE COMISION
  
  
   if($('#tpliq_id').val()=='3')
  {
    //bloque_proveelq_id
	$('#bloque_tpliq_cuentabanco').hide();
	$('#bloque_tpliq_ndocumento').show();	
	$('#bloque_centcostlq_id').show();	
	$('#bloque_tpliq_comisionxliquidar').show();
	//=======================================
	$('#bloque_tpliq_valornodeducible').hide();	
	$('#bloque_tpliq_nautorizacion').show();
	$('#bloque_tpliq_cuentacomision').show();	
	$('#bloque_tpliq_ivaporcentaje').show();
	$('#bloque_tpliq_ceroiva').show();
	$('#bloque_tpliq_noobjeto').show();
	$('#bloque_tpliq_iva').show();
  
  }
  
  // 4 DOCUMENTO EMITIDO POR INSTITUCION FINANCIERA   
  
     if($('#tpliq_id').val()=='4')
  {
    //bloque_proveelq_id
	$('#bloque_tpliq_cuentabanco').show();
	$('#bloque_tpliq_ndocumento').show();	
	$('#bloque_centcostlq_id').show();	
	$('#bloque_tpliq_comisionxliquidar').hide();
	//=======================================
	$('#bloque_tpliq_valornodeducible').show();	
	$('#bloque_tpliq_nautorizacion').show();
	$('#bloque_tpliq_cuentacomision').show();	
	$('#bloque_tpliq_ivaporcentaje').hide();
	$('#bloque_tpliq_ceroiva').hide();
	$('#bloque_tpliq_noobjeto').hide();
	$('#bloque_tpliq_iva').hide();
  
  }
  

}

despliega_camposdata();

$( "#tpliq_id" ).on( "change", function() {
 
 despliega_camposdata();
 
} );

ocultar_mostrar3('transaccion_id');


function ver_asientoliquidtarje()
{
   if($('#ldtc_id').val()!='')
	 {
      myWindow3=window.open('pdfasientos/pdfasientotarjeliqu.php?xml=' + $('#ldtc_id').val(),'ventana_asientocontablex','width=850,height=700,scrollbars=YES');
      myWindow3.focus();
     }
   else
   {
   alert("Por favor guarde el resgistro para ver el asiento contable");     
   }
}



function guardar_camposgridpx(tabla,campo,id,valor,campoidtabla)
{

$("#campog_valorprocesoxx").load("templateformsweb/maestro_standar_liquidaciontarjetas/guarda_camposgrid.php",{

tabla:tabla,
campo:campo,
id:id,
valor:valor,
campoidtabla:campoidtabla

 },function(result){ 

        
  });  

$("#campog_valorprocesoxx").html("Espere un momento...");

}



//  End -->
</script>
<?php
echo $objformulario->generar_formulario_nfechas($table,$DB_gogess);
?>
<div id="divBody_buscadorgeneral"></div>

<div id="campog_valorprocesoxx"></div>

