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
    <td>Cod. Sustento</td>
    <td>Cod. Asiento</td>
    <td>Centro de Costo</td>
    <td>12%</td>
    <td>0%</td>
    <td>No objeto</td>
    <td>Subtotal</td>
    <td>IVA</td>
    <td>IVA Gasto</td>
    <td>ICE</td>
    <td>Total</td>
    <td>10%</td>
    <td>20%</td>
    <td>30%</td>
    <td>50%</td>
    <td>70%</td>
    <td>100%</td>
    <td>Subtotal</td>
    <td nowrap="nowrap">Fecha Retenci&oacute;n</td>
    <td nowrap="nowrap">No. Retenci&oacute;n</td>
    <td nowrap="nowrap">No. Autorizaci&oacute;n</td>
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

$lista_doc="SELECT compra_id,compra_fecha,provee_ruc,provee_cedula,provee_nombre,compra_descripcion,compra_nfactura,compra_autorizacion,tipdoc_codigo,'' as asiento,compra_subtotaliva,compra_subtotalceroiva,0 as noobjeto,(compra_subtotaliva+compra_subtotalceroiva) as subtotal,compra_iva,0 as ivagasto,0 as ice,compra_total FROM dns_compras inner join app_proveedor on proveevar_id=provee_id inner join dns_tipodocumentogeneral on dns_compras.tipdoc_id=dns_tipodocumentogeneral.tipdoc_id where compra_fecha>='2023-01-01' and compra_fecha<='2023-01-31' and compra_anulado=0 ";
$rs_data = $DB_gogess->executec($lista_doc,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	 
	 $array_iva=array();
	 $ivarete=0;
	 $nretencion='';
	 $busca_retencion="select * from comprobante_retencion_cab inner join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id where compretcab_anulado=0 and compretcab_nfactura='".str_replace("-","",$rs_data->fields["compra_nfactura"])."' and impur_id=2 and compra_id='".$rs_data->fields["compra_id"]."'";
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
			  
			  $rs_listaretencion->MoveNext();	
			  }
	   }
	//print_r($array_iva);   
//retencion 
 $array_renta=array();
 $ivaretett=0;
 $busca_retencion1="select * from comprobante_retencion_cab inner join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id where compretcab_anulado=0 and compretcab_nfactura='".str_replace("-","",$rs_data->fields["compra_nfactura"])."' and impur_id=1 and compra_id='".$rs_data->fields["compra_id"]."'";
	 $rs_listaretencion1 = $DB_gogess->executec($busca_retencion1,array());
	  if($rs_listaretencion1)
      {
			  while (!$rs_listaretencion1->EOF) {
			  
			   @$array_renta[$rs_listaretencion1->fields["compretdet_porcentaje"]]["valor"]=$array_renta[$rs_listaretencion1->fields["compretdet_porcentaje"]]["valor"]+$rs_listaretencion1->fields["compretdet_valorretenido"];
			   @$array_renta[$rs_listaretencion1->fields["compretdet_porcentaje"]]["codigo"]=$rs_listaretencion1->fields["porcentaje_id"];		
			   $ivaretett=$ivaretett+$rs_listaretencion1->fields["compretdet_valorretenido"];
			  
			  $rs_listaretencion1->MoveNext();	
			  }
	   }
	
	if(count($array_renta)>0)
	{	
	  
	  //print_r(@$array_renta);
	 }
	
	  ?>
	  <tr>
    <td  nowrap="nowrap"><?php echo $rs_data->fields["compra_fecha"]; ?></td>
    <td  style=mso-number-format:"@" ><?php echo $rs_data->fields["provee_ruc"]; ?></td>
    <td  style=mso-number-format:"@" ><?php echo $rs_data->fields["provee_cedula"]; ?></td>
	<td><?php echo $rs_data->fields["provee_nombre"]; ?></td>
    <td><?php echo $rs_data->fields["compra_descripcion"]; ?></td>
    <td nowrap="nowrap"  style=mso-number-format:"@" ><?php echo $rs_data->fields["compra_nfactura"]; ?></td>
    <td nowrap="nowrap"  style=mso-number-format:"@" ><?php echo $rs_data->fields["compra_autorizacion"]; ?></td>
    <td  style=mso-number-format:"@" ><?php echo $rs_data->fields["tipdoc_codigo"]; ?></td>
    <td><?php echo $rs_data->fields["asiento"]; ?></td>
    <td><?php  ?></td>
    <td><?php echo $rs_data->fields["compra_subtotaliva"];
	@$total1=@$total1+ $rs_data->fields["compra_subtotaliva"];
	 ?></td>
    <td><?php echo $rs_data->fields["compra_subtotalceroiva"]; 
	
	@$total2=@$total2+ $rs_data->fields["compra_subtotalceroiva"];
	?></td>
    <td><?php echo $rs_data->fields["noobjeto"]; 
	@$total3=@$total3+ $rs_data->fields["noobjeto"];
	
	?></td>
    <td><?php echo $rs_data->fields["subtotal"]; 
	@$total4=@$total4+ $rs_data->fields["subtotal"];
	?></td>
    <td><?php echo $rs_data->fields["compra_iva"]; 
	@$total5=@$total5+ $rs_data->fields["compra_iva"];
	?></td>
    <td><?php echo $rs_data->fields["ivagasto"]; 
	@$total6=@$total6+ $rs_data->fields["ivagasto"];
	
	?></td>
    <td><?php echo $rs_data->fields["ice"]; 
	@$total7=@$total7+ $rs_data->fields["ice"];
	
	?></td>
    <td><?php echo $rs_data->fields["compra_total"]; 
	@$total8=@$total8+ $rs_data->fields["compra_total"];
	
	?></td>
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
    <td nowrap="nowrap"><?php echo @$fechanretencion; ?></td>
    <td nowrap="nowrap"  style=mso-number-format:"@" ><?php echo @$nretencion; ?></td>
    <td nowrap="nowrap"  style=mso-number-format:"@" ><?php echo @$compretcab_clavedeaccesos; ?></td>
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

 <tr>
    <td  nowrap="nowrap"><?php  ?></td>
    <td><?php  ?></td>
    <td ><?php  ?></td>
	<td><?php  ?></td>
    <td><?php  ?></td>
    <td nowrap="nowrap"><?php ?></td>
    <td nowrap="nowrap"><?php  ?></td>
    <td><?php  ?></td>
    <td><?php  ?></td>
    <td><?php  ?></td>
    <td><?php echo @$total1; ?></td>
    <td><?php echo @$total2; ?></td>
    <td><?php echo @$total3; ?></td>
    <td><?php echo @$total4; ?></td>
    <td><?php echo @$total5; ?></td>
    <td><?php echo @$total6; ?></td>
    <td><?php echo @$total7; ?></td>
    <td><?php echo @$total8; ?></td>
    <td><?php echo @$total9; ?></td>
    <td><?php echo @$total10; ?></td>
    <td><?php echo @$total11; ?></td>
    <td><?php echo @$total12; ?></td>
    <td><?php echo @$total13; ?></td>
    <td><?php echo @$total14; ?></td>
    <td><?php echo @$total15; ?></td>
    <td nowrap="nowrap"></td>
    <td nowrap="nowrap"></td>
    <td nowrap="nowrap"></td>
    <td><?php 
	echo @$total16;
	?></td>
    <td>
	<?php
	
	?>
	</td>
    <td>
	<?php 
	echo @$total18;
	?>
	</td>
    <td><?php 

	?></td>
    <td>
	<?php 
	echo @$total20;
	?></td>
    <td><?php 
	
	?></td>
    <td><?php 
	echo @$total22;
	?></td>
    <td><?php 
	
	?></td>
    <td><?php 
	echo @$total24;
	?></td>
    <td><?php 
	
	?></td>
    <td>
	<?php 
	echo @$total26;
	?></td>
    <td>
	<?php 
	
	?></td>
    <td>
	<?php 
	echo @$total28;
	?></td>
    <td><?php 
	
	?></td>
    <td>0</td>
    <td></td>
    <td><?php echo $ftotal; ?></td>
    <td><?php echo @$gtotlatotal; ?></td>
  </tr>
</table>