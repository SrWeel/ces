<?php

if($tipo==2)
{
$busca_dattos="select * from beko_documentocabecera where doccab_id='".$doccab_id."'";
$rs_dattos = $DB_gogess->executec($busca_dattos,array());
$proveeve_id=$rs_dattos->fields["proveeve_id"];
$doccab_id=$rs_dattos->fields["doccab_id"];
$doccab_fechaemision_cliente=$rs_dattos->fields["doccab_fechaemision_cliente"];
$doccab_total=$rs_dattos->fields["doccab_total"];
}

            
			if(@$rs_consi->fields["totalcon"]>0)
			{
			 $objformulario->bloqueo_valor=1; 
			}
			else
			{
		    $objformulario->bloqueo_valor=0; 
			}
			$objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");
			$objformulario->sendvar["solofechax"]=date("Y-m-d");
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
            $objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			$objformulario->sendvar["emp_idx"]=$_SESSION['ces1313777_sessid_emp_id'];		
		   
		    @$objformulario->sendvar["doccab_idx"]='';
			@$objformulario->sendvar["compra_idx"]='';
			
		   if($tipo==2)
           {
		    @$objformulario->sendvar["doccab_idx"]=$doccab_id;
			}
			
			
			if($tipo==2)
			{
			$objformulario->sendvar["ttra_idx"]=$tipo;
			$objformulario->fipocobropago=$tipo;
			$objformulario->vieneventa=1;
			
			$array_data=explode(" ",$doccab_fechaemision_cliente);			
			$objformulario->fechaemision_cliente=$array_data[0];			
			$objformulario->tipdocdet_idxvalor=1;			
			$objformulario->doccab_totalvalor=$doccab_total;		
		
			}	
			
			
			
			
					
			$objformulario->sendvar["proveep_idx"]=$proveeve_id;
			
			
			$objformulario->sendvar["tipom_idx"]=1;
			$objformulario->sendvar["tipomov_idx"]=17;
			
			$codig_unicovalor='';
			$unico_number='';
			$unico_number=strtoupper(uniqid());			
			$codig_unicovalor=date("Y-m-d").$_SESSION['ces1313777_sessid_inicio'].$unico_number;
					
			$objformulario->sendvar["compra_numeroprocesox"]=$codig_unicovalor;					
			$objformulario->sendvar["crb_enlacex"]=$codig_unicovalor;
			
			$objformulario->formulario_path='../../../templateformsweb/maestro_standar_cobropagopl2/';
			
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
	 
$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess); 
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

?>



<?php       

if(@$csearch)

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
//echo $rs_tabla->fields["tab_codigo"];
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

 function ocultar_mostrar3_pl(muestra)
  {
  
    $('#productos_id').hide();
	cambio_inactivo_pl('productos_id',0);
    $('#cuentas_id').hide();
	cambio_inactivo_pl('cuentas_id',0);
	$('#fpago_id').hide();
	cambio_inactivo_pl('fpago_id',0);
	
	
	$('#'+muestra).show();
	cambio_inactivo_pl(muestra,1);
  
  }	


  function cambio_inactivo_pl(divdata,opcion)
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
if(!(@$csearch))
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

abrir_standar('templateformsweb/maestro_standar_cobropagopl/buscadorform/busca_data.php','Buscador','divBody_buscadorgeneral','divDialog_buscadorgeneral',550,500,id,$('#frocob_id').val(),0,0,0,0,0);

}

function crear_dataform(id,valor)
{

abrir_standar('templateformsweb/maestro_standar_cobropagopl/crearform/formulario.php','New','divBody_buscadorgeneral','divDialog_buscadorgeneral',550,500,id,valor,0,0,0,0,0);

}

<?php
if(@$doccab_id)
{

echo "$('#doccabcp_idx').val('".$doccab_id."'); ";
//echo "$('#crpadet_fechaemisionx').val('".$doccab_fechaemision_cliente."'); ";

}

if(@$compra_id>0)
{

echo "$('#compracp_idx').val('".$compra_id."'); ";
//echo "$('#crpadet_fechaemisionx').val('".$doccab_fechaemision_cliente."'); ";


}
?>

$( '#crpadet_fechaemisionx' ).datepicker({dateFormat: 'yy-mm-dd'});


cambio_fco();

//  End -->
</script>
<?php
echo $objformulario->generar_formulario_nfechas($table,$DB_gogess);
?>