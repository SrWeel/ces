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
    <td height="19" width="91">F. Emisi&oacute;n</td>
    <td width="106">RUC</td>
    <td width="106">CEDULA</td>	
    <td width="350">Raz&oacute;n Social</td>
    <td width="1387">Detalle</td>
    <td width="161">No. Comprobante</td>
    <td width="368">No. Autorizaci&oacute;n</td>
    <td width="98">Cod. Sustento</td>
    <td width="136">Cod. Asiento</td>
    <td width="114">Centro de Costo</td>
    <td width="71">12%</td>
    <td width="71">0%</td>
    <td width="72">No objeto</td>
    <td width="71">Subtotal</td>
    <td width="63">IVA</td>
    <td width="74">IVA Gasto</td>
    <td width="47">ICE</td>
    <td width="79">Total</td>
    <td width="35">10%</td>
    <td width="35">20%</td>
    <td width="63">30%</td>
    <td width="35">50%</td>
    <td width="55">70%</td>
    <td width="55">100%</td>
    <td width="63">Subtotal</td>
    <td width="118">Fecha Retenci&oacute;n</td>
    <td width="126">No. Retenci&oacute;n</td>
    <td width="368">No. Autorizaci&oacute;n</td>
    <td width="27">1%</td>
    <td width="39">Cod.</td>
    <td width="55">1.75%</td>
    <td width="39">Cod.</td>
    <td width="27">2%</td>
    <td width="39">Cod.</td>
    <td width="55">2.75%</td>
    <td width="39">Cod.</td>
    <td width="47">8%</td>
    <td width="39">Cod.</td>
    <td width="63">10%</td>
    <td width="39">Cod.</td>
    <td width="27">0%</td>
    <td width="39">Cod.</td>
    <td width="57">Otros %</td>
    <td width="39">Cod.</td>
    <td width="63">Subtotal</td>
    <td width="122">Total Retenciones</td>
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
    <td width="91" height="19" nowrap="nowrap"><?php echo $rs_data->fields["compra_fecha"]; ?></td>
    <td width="106">'<?php echo $rs_data->fields["provee_ruc"]; ?></td>
    <td width="350">'<?php echo $rs_data->fields["provee_cedula"]; ?></td>
	<td width="350"><?php echo $rs_data->fields["provee_nombre"]; ?></td>
    <td width="1387"><?php echo $rs_data->fields["compra_descripcion"]; ?></td>
    <td width="161" nowrap="nowrap">'<?php echo $rs_data->fields["compra_nfactura"]; ?></td>
    <td width="368" nowrap="nowrap">'<?php echo $rs_data->fields["compra_autorizacion"]; ?></td>
    <td width="98"><?php echo $rs_data->fields["tipdoc_codigo"]; ?></td>
    <td width="136"><?php echo $rs_data->fields["asiento"]; ?></td>
    <td width="114"><?php  ?></td>
    <td width="71"><?php echo $rs_data->fields["compra_subtotaliva"];
	@$total1=@$total1+ $rs_data->fields["compra_subtotaliva"];
	 ?></td>
    <td width="71"><?php echo $rs_data->fields["compra_subtotalceroiva"]; 
	
	@$total2=@$total2+ $rs_data->fields["compra_subtotalceroiva"];
	?></td>
    <td width="72"><?php echo $rs_data->fields["noobjeto"]; 
	@$total3=@$total3+ $rs_data->fields["noobjeto"];
	
	?></td>
    <td width="71"><?php echo $rs_data->fields["subtotal"]; 
	@$total4=@$total4+ $rs_data->fields["subtotal"];
	?></td>
    <td width="63"><?php echo $rs_data->fields["compra_iva"]; 
	@$total5=@$total5+ $rs_data->fields["compra_iva"];
	?></td>
    <td width="74"><?php echo $rs_data->fields["ivagasto"]; 
	@$total6=@$total6+ $rs_data->fields["ivagasto"];
	
	?></td>
    <td width="47"><?php echo $rs_data->fields["ice"]; 
	@$total7=@$total7+ $rs_data->fields["ice"];
	
	?></td>
    <td width="79"><?php echo $rs_data->fields["compra_total"]; 
	@$total8=@$total8+ $rs_data->fields["compra_total"];
	
	?></td>
    <td width="35"><?php echo @$array_iva[9]; 
	@$total9=@$total9+ @$array_iva[9];
	?></td>
    <td width="35"><?php echo @$array_iva[10]; 
	@$total10=@$total10+ @$array_iva[10];
	?></td>
    <td width="63"><?php echo @$array_iva[1]; 
	@$total11=@$total11+ @$array_iva[1];
	?></td>
    <td width="35"><?php echo @$array_iva[11]; 
	@$total12=@$total12+ @$array_iva[11];
	?></td>
    <td width="55"><?php echo @$array_iva[2]; 
	@$total13=@$total13+ @$array_iva[2];?></td>
    <td width="55"><?php echo @$array_iva[3]; 
	@$total14=@$total14+ @$array_iva[3];
	?></td>
    <td width="63"><?php echo @$ivarete; ?></td>
    <td width="118" nowrap="nowrap"><?php echo @$fechanretencion; ?></td>
    <td width="126" nowrap="nowrap"><?php echo @$nretencion; ?></td>
    <td width="368">'<?php echo @$compretcab_clavedeaccesos; ?></td>
    <td width="27"><?php 
	echo @$array_renta["1"]["valor"];
	?></td>
    <td width="39">
	<?php
	@$array_renta["1"]["codigo"]
	?>
	</td>
    <td width="55">
	<?php 
	echo @$array_renta["1.75"]["valor"];
	?>
	</td>
    <td width="39"><?php 
	echo @$array_renta["1.75"]["codigo"];
	?></td>
    <td width="27">
	<?php 
	echo @$array_renta["2"]["valor"];
	?></td>
    <td width="39"><?php 
	echo @$array_renta["2"]["codigo"];
	?></td>
    <td width="55"><?php 
	echo @$array_renta["2.75"]["valor"];
	?></td>
    <td width="39"><?php 
	echo @$array_renta["2.75"]["codigo"];
	?></td>
    <td width="47"><?php 
	echo @$array_renta["8"]["valor"];
	?></td>
    <td width="39"><?php 
	echo @$array_renta["8"]["codigo"];
	?></td>
    <td width="63">
	<?php 
	echo @$array_renta["10"]["valor"];
	?></td>
    <td width="39">
	<?php 
	echo @$array_renta["10"]["codigo"];
	?></td>
    <td width="27">
	<?php 
	echo @$array_renta["0"]["valor"];
	?></td>
    <td width="39"><?php 
	echo @$array_renta["0"]["codigo"];
	?></td>
    <td width="57">0</td>
    <td width="39"></td>
    <td width="63"><?php echo $ivaretett; ?></td>
    <td width="122"><?php echo $ivaretett+@$ivarete ?></td>
  </tr>
	<?php
	     $rs_data->MoveNext();	  
	  }
  }	  
?>


</table>