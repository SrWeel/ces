<?php  
$doccab_idventa='';

if($tipo==1)
{
$busca_dattos="select * from beko_documentocabecera where doccab_id='".$doccab_id."'";
$rs_dattos = $DB_gogess->executec($busca_dattos,array());
$proveecru_id=$rs_dattos->fields["proveeve_id"];
$doccab_idventa=$rs_dattos->fields["doccab_id"];
$doccab_fechaemision_cliente=$rs_dattos->fields["doccab_fechaemision_cliente"];

///facturas de venta saca el saldo
$doccabcp_idx=$doccab_id;

$lista_valor=array();

$lista_detalles="select * from beko_documentocabecera where doccab_id='".$doccabcp_idx."'";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	    
		$total_nc=0;
	    $busca_nc="select sum(nc.doccab_total) AS total from beko_documentocabecera nc where nc.tipocmp_codigo = '04' and nc.doccab_anulado = 0 and nc.doccab_ndocuafecta='".$rs_data->fields["doccab_ndocumento"]."'";
	    
		$rs_bnc = $DB_gogess->executec($busca_nc,array());
		 
		if($rs_bnc->fields["total"])
		{
		 $total_nc=$rs_bnc->fields["total"];	
		} 
	  
	    $tipocmp_codigo=$rs_data->fields["tipocmp_codigo"];
		
		$busca_id="select * from dns_tipodocumentogeneral where tipdoc_codigo='".$tipocmp_codigo."'";
		$rs_bid = $DB_gogess->executec($busca_id,array());
		
		$tipdoc_id=$rs_bid->fields["tipdoc_id"];
		
		$doccab_total=$rs_data->fields["doccab_total"]-$total_nc;
		$doccab_ndocumento=str_replace("-","",$rs_data->fields["doccab_ndocumento"]);
		$doccab_fechaemision_cliente=$rs_data->fields["doccab_fechaemision_cliente"];
	     
	    $rs_data->MoveNext();
	  }
  }	  

$busca_cobro="select sum(crpadet_valorapagar) as stotal from lpin_cobropago inner join lpin_cobropagodetalle on lpin_cobropago.crb_enlace=lpin_cobropagodetalle.crb_enlace where doccab_id='".$doccabcp_idx."'";
$rs_bcobro = $DB_gogess->executec($busca_cobro,array());

$cobrado=0;
$cobrado=$rs_bcobro->fields["stotal"];

$valor_retenido=0;

//busca retencion a la venta
$lista_rentaventa="select sum(compretdet_valorretenido) as retenido from ventas_retencion_detalle  where compra_enlace='".$doccabcp_idx."'";
$rs_listadataventa = $DB_gogess->executec($lista_rentaventa,array());
$valor_retenido=$rs_listadataventa->fields["retenido"];
//busca retencion a la venta

$valor_sinretencion=$doccab_total-$valor_retenido-$cobrado;
$doccab_total=$valor_sinretencion;

///facturas de venta saca el saldo


}

if($tipo==2)
{
$busca_dattos="select * from dns_compras where 	compra_id='".$doccab_id."'";
$rs_dattos = $DB_gogess->executec($busca_dattos,array());
$proveecru_id=$rs_dattos->fields["proveevar_id"];
$doccab_id=$rs_dattos->fields["compra_id"];
$doccab_fechaemision_cliente=$rs_dattos->fields["compra_fecha"];

$compracp_idx=$doccab_id;
$lista_valor=array();
$num_facturabnc='';

$lista_detalles="select * from dns_compras where compra_id='".$compracp_idx."'";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	    $tipdoc_id=$rs_data->fields["tipdoc_id"];
		$compra_total=$rs_data->fields["compra_total"];
		$compra_nfactura=str_replace("-","",$rs_data->fields["compra_nfactura"]);
		$compra_fecha=$rs_data->fields["compra_fecha"];
		
		$num_facturabnc=$rs_data->fields["compra_nfactura"];
	     
	    $rs_data->MoveNext();
	  }
  }	  
 
//nota de credito  
$compra_total_nc=0;
$lista_detallesxx="select * from dns_compras where tipdoc_id=9 and  compra_nummodif='".$num_facturabnc."'";
$rs_dataxx = $DB_gogess->executec($lista_detallesxx,array());
$compra_total_nc=$rs_dataxx->fields["compra_total"];
//nota de credito  

//busca si mando al gatos

$busca_gasto="select compretdet_gasto from comprobante_retencion_cab inner join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id where compretcab_nfactura='".$compra_nfactura."' and compra_id='".$compracp_idx."' and compretcab_anulado=0";

$rs_bgasto = $DB_gogess->executec($busca_gasto,array());

$gasto_valor=0;
$gasto_valor=$rs_bgasto->fields["compretdet_gasto"];

//busca si mando al gasto  

$busca_retencion="select sum(compretdet_valorretenido) as retenido from comprobante_retencion_cab inner join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id where compretcab_nfactura='".$compra_nfactura."' and compra_id='".$compracp_idx."' and compretcab_anulado=0";

$rs_bretenc = $DB_gogess->executec($busca_retencion,array());

$valor_retenido=$rs_bretenc->fields["retenido"];

if($gasto_valor==1)
{
  $valor_retenido=0;
}

//busca pago
$cobrado=0;
if($compracp_idx>0)
{
$busca_cobro="select sum(crpadet_valorapagar) as stotal from lpin_cobropago inner join lpin_cobropagodetalle on lpin_cobropago.crb_enlace=lpin_cobropagodetalle.crb_enlace where compra_id='".$compracp_idx."'";
$rs_bcobro = $DB_gogess->executec($busca_cobro,array());
$cobrado=$rs_bcobro->fields["stotal"];
}
//busca pago

$valor_sinretencion=$compra_total-$valor_retenido-$cobrado-$compra_total_nc;

$doccab_total=$valor_sinretencion;


}

$objformulario->formulario_path='../../../templateformsweb/maestro_standar_crucedocumentospl/';

            $objformulario->bloqueo_valor=0; 
		    $objformulario->sendvar["fechax"]=date("Y-m-d");	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];			
			$objformulario->sendvar["usr_tpingx"]=0;
			$objformulario->sendvar["tipocmp_codigox"]='01';
			$objformulario->sendvar["estaf_idx"]='1';
			$objformulario->sendvar["origenx"]='MANUAL';
			$objformulario->sendvar["tippo_idx"]=3;
			
			@$objformulario->sendvar["doccabcr_idx"]='';
			@$objformulario->sendvar["compracr_idx"]='';
			
			@$objformulario->sendvar["proveecru_idx"]=$proveecru_id;			
			@$objformulario->sendvar["crudoc_fechaemisionx"]=$doccab_fechaemision_cliente;
						
			
			
		   if($tipo==1)
           {
		      @$objformulario->sendvar["crudoc_ndocumentox"]='';				
			  @$objformulario->sendvar["crudoc_ndocumentoventax"]=$doccab_idventa;	
		   
		   }
		   
		   if($tipo==2)
           {
		      
			  @$objformulario->sendvar["crudoc_ndocumentox"]=$doccab_id;				
			  @$objformulario->sendvar["crudoc_ndocumentoventax"]='';	
		   
		   }
			
				
						
		   if($tipo==1)
           {
		    @$objformulario->sendvar["doccabcr_idx"]=$doccab_id;
			@$objformulario->sendvar["crudoc_saldox"]=$doccab_total;
			}
			if($tipo==2)
           {
			@$objformulario->sendvar["compracr_idx"]=$compra_id;
			@$objformulario->sendvar["crudoc_saldox"]=$doccab_total;
		   }
		   
		   
		   
		   if($tipo==1)
			{
			$objformulario->sendvar["crudoc_tipotransaccionx"]=$tipo;
			$objformulario->fipocobropago=$tipo;			
			$array_data=explode(" ",$doccab_fechaemision_cliente);			
			$objformulario->fechaemision_cliente=$array_data[0];			
			$objformulario->tipdocdet_idxvalor=1;			
			$objformulario->doccab_totalvalor=$doccab_total;		
			}			
			
			if($tipo==2)
			{
			$objformulario->sendvar["crudoc_tipotransaccionx"]=$tipo;
			$objformulario->fipocobropago=$tipo;			
			$array_data=explode(" ",$doccab_fechaemision_cliente);			
			$objformulario->fechaemision_cliente=$array_data[0];			
			$objformulario->tipdocdet_idxvalor=1;			
			$objformulario->doccab_totalvalor=$doccab_total;
		
			}	
			
            
			$valoralet=mt_rand(1,500);
			$nunico=strtoupper(uniqid());
			$aletorioid='01'.$nunico.$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["crudoc_enlacex"]=$aletorioid;
			
            $busca_emp="select * from app_empresa where emp_id='".$_SESSION['ces1313777_sessid_emp_id']."'";
            $rs_femp = $DB_gogess->executec($busca_emp,array());
            $rucempresa=$rs_femp->fields["emp_ruc"];
			$objformulario->sendvar["doccab_rucempresax"]=$rucempresa;
			$objformulario->sendvar["tipase_idx"]=10;

			$objformulario->sendvar["proveepcru_idx"]=$proveecru_id;
			
		    //$generafactura= 
?>			
<?php
            $objformulario->generar_formulario(@$submit,$table,81,$DB_gogess);
			
			$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess);
			$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
			$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess);
			$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess);
			$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess);
			$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess);
			//$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess);
			//$objformulario->generar_formulario_bootstrap(@$submit,$table,8,$DB_gogess); 
			//$objformulario->generar_formulario_bootstrap(@$submit,$table,9,$DB_gogess);	

 $tab_id_valor=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_id","where tab_name like",$table,$DB_gogess);
 $lista_detalle="select * from gogess_subgrid where tab_id=".$tab_id_valor; 
 $rs_detalle = $DB_gogess->executec($lista_detalle,array());
?>
<p style="color:#FFFFFF">LINIA SALTO</p>
<input type="button" name="btn_crudet_id" id="btn_crudet_id" value="DOCUMENTOS" onclick="ocultar_mostrar3_cruce('crudet_id')" />
<input type="button" name="btn_cruant_id" id="btn_cruant_id" value="ANTICIPOS" onclick="ocultar_mostrar3_cruce('cruant_id')" />
<input type="button" name="btn_crucue_id" id="btn_crucue_id" value="CUENTAS CONTABLES"  onclick="ocultar_mostrar3_cruce('crucue_id')" />
<!--<input type="button" name="btn_frmpven_idpl" id="btn_frmpven_idpl" value="FORMA DE PAGO"  onclick="ocultar_mostrar3_cruce('frmpven_idpl')" /> -->
<div id="crudet_id">
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess); 
?>
</div>
<div id="cruant_id">
<?php
$objformulario->formulario_path='../../../templateformsweb/maestro_standar_crucedocumentospl/';
$objformulario->generar_formulario_bootstrap(@$submit,$table,8,$DB_gogess); 
?>
</div>

<div id="frmpven_idpl"> 
<?php
$objformulario->formulario_path='../../../templateformsweb/maestro_standar_crucedocumentospl/';
$objformulario->generar_formulario_bootstrap(@$submit,$table,9,$DB_gogess); 
?>
</div>

<div id="crucue_id">
<?php
$objformulario->formulario_path='../../../templateformsweb/maestro_standar_crucedocumentospl/';
$objformulario->generar_formulario_bootstrap(@$submit,$table,10,$DB_gogess); 
?>
</div>
<?php

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


<script type="text/javascript">
<!--
//$( "#usua_fechaingrero" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_desde" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_hasta" ).datepicker({dateFormat: 'yy-mm-dd'});


function buscar_dataform(id)
{

abrir_standar('templateformsweb/maestro_standar_crucedocumentospl/buscadorform/busca_data.php','Buscador','divBody_buscadorgeneral','divDialog_buscadorgeneral',550,500,id,0,0,0,0,0,0);

}

function crear_dataform(id,valor)
{

abrir_standar('templateformsweb/maestro_standar_crucedocumentospl/crearform/formulario.php','New','divBody_buscadorgeneral','divDialog_buscadorgeneral',550,500,id,valor,0,0,0,0,0);

}



function ocultar_mostrar3_cruce(muestra)
  {
  
    $('#crudet_id').hide();
	cambio_inactivo('crudet_id',0);
    $('#cruant_id').hide();
	cambio_inactivo('cruant_id',0);
	$('#frmpven_idpl').hide();
	cambio_inactivo('frmpven_idpl',0);	
	$('#crucue_id').hide();
	cambio_inactivo('crucue_id',0);
	
	
	$('#'+muestra).show();
	cambio_inactivo(muestra,1);
  
  }	

  ocultar_mostrar3_cruce('crudet_id');

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


<div id="sri_panel"></div>

<div id="guarda_firma"></div>

<div id="divBody_pacientedata"></div>


<script type="text/javascript">
<!--

<?php
if($tipo==1)
{

echo "$('#crudet_documentox_vista').show(); ";
echo "$('#crudet_documentoventax_vista').hide(); ";

}

if($tipo==2)
{

echo "$('#crudet_documentox_vista').hide(); ";
echo "$('#crudet_documentoventax_vista').show(); ";

}
?>

//-->
</script> 
<div id="divBody_cobropago"></div>
<div id="obtiene_seguro"></div>
<input name="queejecuta" type="hidden" id="queejecuta" value="0" />

<input name="hayregistros" type="text" id="hayregistros" value="" />

<script type="text/javascript">
<!--

$( "#crudoc_fechaemision" ).on( "change", function() {
    fecha_menor();
} );

function fecha_menor()
{

//=================================================

  $("#verificafecha_div").load("templateformsweb/maestro_standar_crucedocumentospl/valida_fecha.php",{
        crudoc_fechaemision:$("#crudoc_fechaemision").val(),
		fecha_factura:'<?php echo $doccab_fechaemision_cliente; ?>'
	  },function(result){  
	
	
	  });  
	
 $("#verificafecha_div").html("Espere un momento..."); 
//================================================= 

}

//-->
</script>
<div id="verificafecha_div"></div>



