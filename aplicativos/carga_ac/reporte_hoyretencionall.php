<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
ini_set("session.gc_maxlifetime","1440000");
session_start();


header('Content-type: application/vnd.ms-excel; charset=UTF-8;');
$fechahoy=date("Y-m-d");
header("Content-Disposition: attachment; filename="."RETENCIONES_".$fechahoy.".xls");


$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();


?><style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>
<table border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>F. Emisi&oacute;n</td>
    <td>RUC</td>
    <td>CEDULA</td>	
    <td>Raz&oacute;n Social</td>
    <td>Detalle</td>
    <td>No. Comprobante</td>
    <td>No. Autorizaci&oacute;n</td>
	<td>Estado</td>
    <td>Tipo</td>
    <td>12%</td>
    <td>0%</td>
    <td>No objeto</td>
    <td>Subtotal</td>
    <td>IVA</td>
    <td>IVA Gasto</td>
    <td>ICE</td>
    <td>Total</td>
	<td nowrap="nowrap">Fecha Retenci&oacute;n</td>
    <td nowrap="nowrap">No. Retenci&oacute;n</td>
    <td nowrap="nowrap">No. Autorizaci&oacute;n</td>
	<td nowrap="nowrap">Estado SRI</td>
	<td nowrap="nowrap">Estado</td>
    <td>10%</td>
    <td>20%</td>
    <td>30%</td>
    <td>50%</td>
    <td>70%</td>
    <td>100%</td>
    <td>Subtotal</td>
   
    <td>1%</td>
    <td>Cod.</td>
    <td>1.75%</td>
    <td>Cod.</td>
    <td>2%</td>
    <td>Cod.</td>
    <td>2.75%</td>
    <td>Cod.</td>
    <td>8%</td>
    <td>Cod.</td>
    <td>10%</td>
    <td>Cod.</td>
    <td>0%</td>
    <td>Cod.</td>
    <td>Otros %</td>
    <td>Cod.</td>
    <td>Subtotal</td>
    <td>Total Retenciones</td>
  </tr>


<?php

$lista_doc="SELECT * FROM dns_compras_vista inner join app_proveedor on proveevar_id=provee_id left join comprobante_retencion_cab on dns_compras_vista.compra_id=comprobante_retencion_cab.compra_id  where compra_fecha>='2023-04-01' and compra_fecha<='2023-04-30'  ORDER by compra_nfactura";
$rs_data = $DB_gogess->executec($lista_doc,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	 
	 $array_iva=array();
	 $ivarete=0;
	 $nretencion='';
	 
	 $array_renta=array();
     $ivaretett=0;
	 
	$nretencion='';
	$fechanretencion='';
	$compretcab_clavedeaccesos='';
	$compretcab_anulado='';
	$ret_anulado='';
	 
	$busca_retenciondata="select * from comprobante_retencion_cab left join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id where  comprobante_retencion_cab.compretcab_id='".$rs_data->fields["compretcab_id"]."'";
	$rs_listaretini = $DB_gogess->executec($busca_retenciondata,array());
	
	$nretencion=$rs_listaretini->fields["compretcab_nretencion"];
	$fechanretencion=$rs_listaretini->fields["compretcab_fechaemision_cliente"];
	$compretcab_clavedeaccesos=$rs_listaretini->fields["compretcab_clavedeaccesos"];
	$compretcab_anulado=trim($rs_listaretini->fields["compretcab_anulado"]);
	$compretcab_estadosri=trim($rs_listaretini->fields["compretcab_estadosri"]);
	$compretcab_xmlfirmado=base64_decode(trim($rs_listaretini->fields["compretcab_xmlfirmado"]));
	
	if($compretcab_anulado=='1')
			  {
			     $ret_anulado='ANULADO';
				 //lee xml
				 
				 $struct_detail = new SimpleXMLElement($compretcab_xmlfirmado); 
				 
				// print_r($struct_detail);
				
				 
				 $numimpuesto=count($struct_detail->docsSustento->docSustento->retenciones->retencion);	
				 
				 $ix=1;		
					for($id=0;$id<$numimpuesto;$id++)					   
					   {
					     
						  $codigo=$struct_detail->docsSustento->docSustento->retenciones->retencion[$id]->codigo->__toString();
						  if($codigo=='2')
						  {
						  $porcentaje_id=$struct_detail->docsSustento->docSustento->retenciones->retencion[$id]->codigoRetencion->__toString();
						  $valorRetenido=$struct_detail->docsSustento->docSustento->retenciones->retencion[$id]->valorRetenido->__toString();
						  
					      @$array_iva[$porcentaje_id]=$array_iva[$porcentaje_id]+$valorRetenido;
			              $ivarete=$ivarete+$valorRetenido;
					      }
						  
						  if($codigo=='1')
						  {
						  
						  $porcentaje_id=$struct_detail->docsSustento->docSustento->retenciones->retencion[$id]->codigoRetencion->__toString();
						  $valorRetenido=$struct_detail->docsSustento->docSustento->retenciones->retencion[$id]->valorRetenido->__toString();
			              $porcentajeRetener=$struct_detail->docsSustento->docSustento->retenciones->retencion[$id]->porcentajeRetener->__toString();
						  
						  
						  @$array_renta[$porcentajeRetener]["valor"]=$array_renta[$porcentajeRetener]["valor"]+$valorRetenido;
			              @$array_renta[$porcentajeRetener]["codigo"]=$porcentaje_id;		
			              $ivaretett=$ivaretett+$valorRetenido;
			   
			   
					      }
						  
					   
					   }
				 
				 //lee xml
				 
			  }
		
			  
			  
	
	
	$busca_retencion="select * from comprobante_retencion_cab left join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id where  impur_id=2 and comprobante_retencion_cab.compretcab_id='".$rs_data->fields["compretcab_id"]."'";
	//echo $busca_retencion."<br>";
	 $rs_listaretencion = $DB_gogess->executec($busca_retencion,array());
	  if($rs_listaretencion)
      {
			  while (!$rs_listaretencion->EOF) {
			  
			  @$array_iva[$rs_listaretencion->fields["porcentaje_id"]]=$array_iva[$rs_listaretencion->fields["porcentaje_id"]]+$rs_listaretencion->fields["compretdet_valorretenido"];
			  $ivarete=$ivarete+$rs_listaretencion->fields["compretdet_valorretenido"];
			  
			  $nretencion=$rs_listaretencion->fields["compretcab_nretencion"];
			  $fechanretencion=$rs_listaretencion->fields["compretcab_fechaemision_cliente"];
			  $compretcab_clavedeaccesos=$rs_listaretencion->fields["compretcab_clavedeaccesos"];
			  $compretcab_anulado=trim($rs_listaretencion->fields["compretcab_anulado"]);
			  $compretcab_estadosri=trim($rs_listaretini->fields["compretcab_estadosri"]);
			  
			  if($compretcab_anulado=='1')
			  {
			     $ret_anulado='ANULADO';
			  }
			  
			  $rs_listaretencion->MoveNext();	
			  }
	   }
	//print_r($array_iva);   
//retencion 
 
 $busca_retencion1="select * from comprobante_retencion_cab left join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id where  impur_id=1 and comprobante_retencion_cab.compretcab_id='".$rs_data->fields["compretcab_id"]."'";
	 $rs_listaretencion1 = $DB_gogess->executec($busca_retencion1,array());
	  if($rs_listaretencion1)
      {
			  while (!$rs_listaretencion1->EOF) {
			  
			   @$array_renta[$rs_listaretencion1->fields["compretdet_porcentaje"]]["valor"]=$array_renta[$rs_listaretencion1->fields["compretdet_porcentaje"]]["valor"]+$rs_listaretencion1->fields["compretdet_valorretenido"];
			   @$array_renta[$rs_listaretencion1->fields["compretdet_porcentaje"]]["codigo"]=$rs_listaretencion1->fields["porcentaje_id"];		
			   $ivaretett=$ivaretett+$rs_listaretencion1->fields["compretdet_valorretenido"];
			   
			  $nretencion=$rs_listaretencion1->fields["compretcab_nretencion"];
			  $fechanretencion=$rs_listaretencion1->fields["compretcab_fechaemision_cliente"];
			  $compretcab_clavedeaccesos=$rs_listaretencion1->fields["compretcab_clavedeaccesos"];
			  $compretcab_anulado=trim($rs_listaretencion1->fields["compretcab_anulado"]);
			  $compretcab_estadosri=trim($rs_listaretini->fields["compretcab_estadosri"]);
			  if($compretcab_anulado=='1')
			  {
			     $ret_anulado='ANULADO';
			  }
			  
			  $rs_listaretencion1->MoveNext();	
			  }
	   }
	
	if(count($array_renta)>0)
	{	
	  
	  //print_r(@$array_renta);
	 }
	
$busca_masdata="SELECT compra_id,compra_fecha,provee_ruc,provee_cedula,provee_nombre,compra_descripcion,compra_nfactura,compra_autorizacion,tipdoc_codigo,'' as asiento,compra_subtotaliva,compra_subtotalceroiva,0 as noobjeto,(compra_subtotaliva+compra_subtotalceroiva) as subtotal,compra_iva,0 as ivagasto,0 as ice,compra_total FROM dns_compras inner join app_proveedor on proveevar_id=provee_id inner join dns_tipodocumentogeneral on dns_compras.tipdoc_id=dns_tipodocumentogeneral.tipdoc_id where compra_id='".$rs_data->fields["compra_id"]."'";

$rs_masdata = $DB_gogess->executec($busca_masdata,array());
	
$color='';	
if($ret_anulado=='ANULADO')
{
  $color=' bgcolor="#FFAAAA" ';
}
	
	  ?>
	  <tr <?php echo $color; ?> >
    <td  nowrap="nowrap"><?php echo $rs_data->fields["compra_fecha"]; ?></td>
    <td  style=mso-number-format:"@" ><?php echo $rs_data->fields["provee_ruc"]; ?></td>
    <td  style=mso-number-format:"@" ><?php echo $rs_data->fields["provee_cedula"]; ?></td>
	<td><?php echo $rs_data->fields["provee_nombre"]; ?></td>
    <td><?php echo $rs_data->fields["compra_descripcion"]; ?></td>
    <td nowrap="nowrap"  style=mso-number-format:"@" ><?php echo $rs_data->fields["compra_nfactura"]; ?></td>
    <td nowrap="nowrap"  style=mso-number-format:"@" ><?php echo $rs_data->fields["compra_autorizacion"]; ?></td>
	 <td nowrap="nowrap"  style=mso-number-format:"@" ><?php echo $rs_data->fields["compra_anulado"]; ?></td>
    <td  style=mso-number-format:"@" ><?php echo $rs_data->fields["tipdoc_nombre"]; ?></td>
    <td><?php echo $rs_masdata->fields["compra_subtotaliva"];
	@$total1=@$total1+ $rs_masdata->fields["compra_subtotaliva"];
	 ?></td>
    <td><?php echo $rs_masdata->fields["compra_subtotalceroiva"]; 
	
	@$total2=@$total2+ $rs_masdata->fields["compra_subtotalceroiva"];
	?></td>
    <td><?php echo @$rs_masdata->fields["noobjeto"]; 
	@$total3=@$total3+ $rs_masdata->fields["noobjeto"];
	
	?></td>
    <td><?php echo $rs_masdata->fields["subtotal"]; 
	@$total4=@$total4+ $rs_masdata->fields["subtotal"];
	?></td>
    <td><?php echo $rs_masdata->fields["compra_iva"]; 
	@$total5=@$total5+ $rs_masdata->fields["compra_iva"];
	?></td>
    <td><?php echo $rs_masdata->fields["ivagasto"]; 
	@$total6=@$total6+ $rs_masdata->fields["ivagasto"];
	
	?></td>
    <td><?php echo $rs_masdata->fields["ice"]; 
	@$total7=@$total7+ $rs_masdata->fields["ice"];
	
	?></td>
    <td><?php echo $rs_masdata->fields["compra_total"]; 
	@$total8=@$total8+ $rs_masdata->fields["compra_total"];
	
	?></td>
	
	<td nowrap="nowrap"><?php echo @$fechanretencion; ?></td>
    <td nowrap="nowrap"  style=mso-number-format:"@" ><?php echo @$nretencion; ?></td>
    <td nowrap="nowrap"  style=mso-number-format:"@" ><?php echo @$compretcab_clavedeaccesos; ?></td>
	<td nowrap="nowrap"  style=mso-number-format:"@" ><?php echo @$compretcab_estadosri; ?></td>
	<td nowrap="nowrap"  style=mso-number-format:"@" ><?php echo @$ret_anulado; ?></td>
	
    <td><?php echo @$array_iva[9]; 
	@$total9=@$total9+ @$array_iva[9];
	?></td>
    <td><?php echo @$array_iva[10]; 
	@$total10=@$total10+ @$array_iva[10];
	?></td>
    <td><?php echo @$array_iva[1]; 
	@$total11=@$total11+ @$array_iva[1];
	?></td>
    <td><?php echo @$array_iva[11]; 
	@$total12=@$total12+ @$array_iva[11];
	?></td>
    <td><?php echo @$array_iva[2]; 
	@$total13=@$total13+ @$array_iva[2];?></td>
    <td><?php echo @$array_iva[3]; 
	@$total14=@$total14+ @$array_iva[3];
	?></td>
    <td><?php echo @$ivarete; 
	@$total15=@$total15+ @$ivarete;
	?></td>
    <td><?php 
	echo @$array_renta["1"]["valor"];
	@$total16=@$total16+ @$array_renta["1"]["valor"];
	?></td>
    <td>
	<?php
	@$array_renta["1"]["codigo"];
	@$total17=@$total17+ @$array_renta["1"]["codigo"];
	?>
	</td>
    <td>
	<?php 
	echo @$array_renta["1.75"]["valor"];
	@$total18=@$total18+ @$array_renta["1.75"]["valor"];
	?>
	</td>
    <td><?php 
	echo @$array_renta["1.75"]["codigo"];
	@$total19=@$total19+ @$array_renta["1.75"]["codigo"];
	?></td>
    <td>
	<?php 
	echo @$array_renta["2"]["valor"];
	@$total20=@$total20+ @$array_renta["2"]["valor"];
	?></td>
    <td><?php 
	echo @$array_renta["2"]["codigo"];
	@$total21=@$total21+ @$array_renta["2"]["codigo"];
	?></td>
    <td><?php 
	echo @$array_renta["2.75"]["valor"];
	@$total22=@$total22+ @$array_renta["2.75"]["valor"];
	?></td>
    <td><?php 
	echo @$array_renta["2.75"]["codigo"];
	@$total23=@$total23+ @$array_renta["2.75"]["codigo"];
	?></td>
    <td><?php 
	echo @$array_renta["8"]["valor"];
	@$total24=@$total24 + @$array_renta["8"]["valor"];
	?></td>
    <td><?php 
	echo @$array_renta["8"]["codigo"];
	@$total25=@$total25 + @$array_renta["8"]["codigo"];
	?></td>
    <td>
	<?php 
	echo @$array_renta["10"]["valor"];
	@$total26=@$total26 + @$array_renta["10"]["valor"];
	?></td>
    <td>
	<?php 
	echo @$array_renta["10"]["codigo"];
	@$total27=@$total27 + @$array_renta["10"]["codigo"];
	?></td>
    <td>
	<?php 
	echo @$array_renta["0"]["valor"];
	@$total28=@$total28 + @$array_renta["0"]["valor"];
	?></td>
    <td><?php 
	echo @$array_renta["0"]["codigo"];
	@$total29=@$total29 + @$array_renta["0"]["codigo"];
	?></td>
    <td>0</td>
    <td></td>
    <td><?php echo $ivaretett; 
	@$ftotal=$ftotal+$ivaretett;
	?></td>
    <td><?php echo $ivaretett+@$ivarete;
	@$gtotlatotal=$gtotlatotal+($ivaretett+@$ivarete);
	 ?></td>
  </tr>
	<?php
	     $rs_data->MoveNext();	  
	  }
  }	  
?>


</table>