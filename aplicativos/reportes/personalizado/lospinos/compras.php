<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
ini_set("session.gc_maxlifetime","1440000");
session_start();


header('Content-type: application/vnd.ms-excel; charset=UTF-8;');
$fechahoy=date("Y-m-d");
header("Content-Disposition: attachment; filename="."RETENCIONES_".$fechahoy.".xls");

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();


$fecha_i=@$_GET["fecha_inicio"];
$fecha_f=@$_GET["fecha_fin"];

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
    <td>TIPO</td>
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
    <td>15%</td>
	<td>5%</td>
    <td>IVA diferenciado</td>
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

$lista_doc="SELECT dns_compras.tipdoc_id,compra_id,compra_fecha,provee_ruc,provee_cedula,provee_nombre,compra_descripcion,compra_nfactura,compra_autorizacion,tipdoc_codigo,'' as asiento,compra_subtotaliva,compra_subtotalceroiva,0 as noobjeto,(compra_subtotaliva+compra_subtotalceroiva) as subtotal,compra_iva,0 as ivagasto,0 as ice,compra_total,compra_enlace FROM dns_compras inner join app_proveedor on proveevar_id=provee_id inner join dns_tipodocumentogeneral on dns_compras.tipdoc_id=dns_tipodocumentogeneral.tipdoc_id where compra_fecha>='".$fecha_i."' and compra_fecha<='".$fecha_f."' and compra_anulado=0 ";
$rs_data = $DB_gogess->executec($lista_doc,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  

//=======================================================================================
	  
$compra_enlace=$rs_data->fields["compra_enlace"];

$lista_valorxy=array();

$lista_detallesxy="select sum(prcomp_subtotal) as total,prcomp_taricodigo  from lpin_productocompra where compra_enlace='".$compra_enlace."' group by prcomp_taricodigo";
$rs_dataxy = $DB_gogess->executec($lista_detallesxy,array());
 if($rs_dataxy)
 {
	  while (!$rs_dataxy->EOF) {	
	  
	     @$lista_valorxy[$rs_dataxy->fields["prcomp_taricodigo"]]=$lista_valorxy[$rs_dataxy->fields["prcomp_taricodigo"]]+$rs_dataxy->fields["total"];
	  
	    $rs_dataxy->MoveNext();
	  }
  }	  


 $lista_detallesxy="select sum(cuecomp_subtotal) as total,taric_id  from lpin_cuentacompra where compra_enlace='".$compra_enlace."' group by taric_id";
$rs_dataxy = $DB_gogess->executec($lista_detallesxy,array());
 if($rs_dataxy)
 {
	  while (!$rs_dataxy->EOF) {	
	  
	     $sacatari="select * from beko_tarifa where tari_id='".$rs_dataxy->fields["taric_id"]."'";
		 $rs_sacatar = $DB_gogess->executec($sacatari,array());		 
		 $tari_codigo=$rs_sacatar->fields["tari_codigo"];	  
		 
	     @$lista_valorxy[$tari_codigo]=$lista_valorxy[$tari_codigo]+$rs_dataxy->fields["total"];
	  
	    $rs_dataxy->MoveNext();
	  }
  }	
 
 
$lista_detallesxy="select sum(acfi_subtotal) as total,tarif_id  from dns_activosfijos where compra_enlace='".$compra_enlace."' group by tarif_id";
$rs_dataxy = $DB_gogess->executec($lista_detallesxy,array());
 if($rs_dataxy)
 {
	  while (!$rs_dataxy->EOF) {	
	  
	     $sacatari="select * from beko_tarifa where tari_id='".$rs_dataxy->fields["tarif_id"]."'";
		 $rs_sacatar = $DB_gogess->executec($sacatari,array());		 
		 $tari_codigo=$rs_sacatar->fields["tari_codigo"];	  
		 
	     @$lista_valorxy[$tari_codigo]=$lista_valorxy[$tari_codigo]+$rs_dataxy->fields["total"];
	  
	    $rs_dataxy->MoveNext();
	  }
  }	
	  
	  
//=======================================================================================


	  
	  $nretencion='';
			  $fechanretencion='';
			  $compretcab_clavedeaccesos='';
	 
	 $array_iva=array();
	 $ivarete=0;
	 $nretencion='';
	 $busca_retencion="select * from comprobante_retencion_cab inner join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id where compretcab_anulado=0 and compretcab_nfactura='".str_replace("-","",$rs_data->fields["compra_nfactura"])."' and impur_id=2 and compra_id='".$rs_data->fields["compra_id"]."'  and  (compretcab_fechaemision_cliente>='".$fecha_i."' and compretcab_fechaemision_cliente<='".$fecha_f."') ";
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
 $busca_retencion1="select * from comprobante_retencion_cab inner join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id where compretcab_anulado=0 and compretcab_nfactura='".str_replace("-","",$rs_data->fields["compra_nfactura"])."' and impur_id=1 and compra_id='".$rs_data->fields["compra_id"]."' and  (compretcab_fechaemision_cliente>='".$fecha_i."' and compretcab_fechaemision_cliente<='".$fecha_f."') ";
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
			  
			  $rs_listaretencion1->MoveNext();	
			  }
	   }
	
	if(count($array_renta)>0)
	{	
	  
	  //print_r(@$array_renta);
	 }
	
	$signo=1;

$tipdoc_id=$rs_data->fields["tipdoc_id"];
if($tipdoc_id=='9')
{
 $signo=-1;
 }
	
	
	$TIPO_DOC=$objformulario->replace_cmb("dns_tipodocumentogeneral","tipdoc_id,tipdoc_nombre"," where tipdoc_id =",$rs_data->fields["tipdoc_id"],$DB_gogess);
	
	  ?>
	  <tr>
    <td  nowrap="nowrap"><?php echo $TIPO_DOC; ?></td>
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
     
	<td align="right"  ><?php echo str_replace(".",",",((round(($rs_data->fields["compra_subtotaliva"]-@$lista_valorxy[5]-@$lista_valorxy[8]),10)*$signo)));
	@$total1=@$total1+ (round(($rs_data->fields["compra_subtotaliva"]-@$lista_valorxy[5]-@$lista_valorxy[8]),10)*$signo);
	 ?></td>
	 
	<td><?php echo str_replace(".",",",(@$lista_valorxy[5]*$signo));
	@$total1cinco=@$total1cinco+ (@$lista_valorxy[5]*$signo);
	 ?></td>
	 
	   <td><?php echo str_replace(".",",",(@$lista_valorxy[8]*$signo));
	@$total1ocho=@$total1ocho+ (@$lista_valorxy[8]*$signo);
	 ?></td> 
	 
    <td align="right" ><?php echo str_replace(".",",",($rs_data->fields["compra_subtotalceroiva"]*$signo)); 
	
	@$total2=@$total2+ ($rs_data->fields["compra_subtotalceroiva"]*$signo);
	?></td>
    <td align="right" ><?php echo str_replace(".",",",($rs_data->fields["noobjeto"]*$signo)); 
	@$total3=@$total3+ ($rs_data->fields["noobjeto"]*$signo);
	
	?></td>
    <td align="right" ><?php echo str_replace(".",",",($rs_data->fields["subtotal"]*$signo)); 
	@$total4=@$total4+ ($rs_data->fields["subtotal"]*$signo);
	?></td>
    <td align="right" ><?php echo str_replace(".",",",($rs_data->fields["compra_iva"]*$signo)); 
	@$total5=@$total5+ ($rs_data->fields["compra_iva"]*$signo);
	?></td>
    <td align="right" ><?php echo str_replace(".",",",$rs_data->fields["ivagasto"]); 
	@$total6=@$total6+ $rs_data->fields["ivagasto"];
	
	?></td>
    <td align="right" ><?php echo str_replace(".",",",$rs_data->fields["ice"]); 
	@$total7=@$total7+ $rs_data->fields["ice"];
	
	?></td>
    <td align="right" ><?php echo str_replace(".",",",($rs_data->fields["compra_total"]*$signo)); 
	@$total8=@$total8+ ($rs_data->fields["compra_total"]*$signo);
	
	?></td>
    <td align="right" ><?php echo str_replace(".",",",@$array_iva[9]); 
	@$total9=@$total9+ @$array_iva[9];
	?></td>
    <td align="right" ><?php echo str_replace(".",",",@$array_iva[10]); 
	@$total10=@$total10+ @$array_iva[10];
	?></td>
    <td align="right" ><?php echo str_replace(".",",",@$array_iva[1]); 
	@$total11=@$total11+ @$array_iva[1];
	?></td>
    <td align="right" ><?php echo str_replace(".",",",@$array_iva[11]); 
	@$total12=@$total12+ @$array_iva[11];
	?></td>
    <td align="right" ><?php echo str_replace(".",",",@$array_iva[2]); 
	@$total13=@$total13+ @$array_iva[2];?></td>
    <td align="right" ><?php echo str_replace(".",",",@$array_iva[3]); 
	@$total14=@$total14+ @$array_iva[3];
	?></td>
    <td align="right" ><?php echo str_replace(".",",",@$ivarete); 
	@$total15=@$total15+ @$ivarete;
	?></td>
    <td nowrap="nowrap"><?php echo @$fechanretencion; ?></td>
    <td nowrap="nowrap"  style=mso-number-format:"@" ><?php echo @$nretencion; ?></td>
    <td nowrap="nowrap"  style=mso-number-format:"@" ><?php echo @$compretcab_clavedeaccesos; ?></td>
    <td align="right" ><?php 
	echo str_replace(".",",",@$array_renta["1"]["valor"]);
	@$total16=@$total16+ @$array_renta["1"]["valor"];
	?></td>
    <td align="right" >
	<?php
	echo str_replace(".",",",@$array_renta["1"]["codigo"]);
	@$total17=@$total17+ @$array_renta["1"]["codigo"];
	?>
	</td>
    <td align="right" >
	<?php 
	echo str_replace(".",",",@$array_renta["1.75"]["valor"]);
	@$total18=@$total18+ @$array_renta["1.75"]["valor"];
	?>
	</td>
    <td align="right" ><?php 
	echo str_replace(".",",",@$array_renta["1.75"]["codigo"]);
	@$total19=@$total19+ @$array_renta["1.75"]["codigo"];
	?></td>
    <td align="right" >
	<?php 
	echo str_replace(".",",",@$array_renta["2"]["valor"]);
	@$total20=@$total20+ @$array_renta["2"]["valor"];
	?></td>
    <td align="right" ><?php 
	echo str_replace(".",",",@$array_renta["2"]["codigo"]);
	@$total21=@$total21+ @$array_renta["2"]["codigo"];
	?></td>
    <td align="right" ><?php 
	echo str_replace(".",",",@$array_renta["2.75"]["valor"]);
	@$total22=@$total22+ @$array_renta["2.75"]["valor"];
	?></td>
    <td align="right" ><?php 
	echo str_replace(".",",",@$array_renta["2.75"]["codigo"]);
	@$total23=@$total23+ @$array_renta["2.75"]["codigo"];
	?></td>
    <td align="right" ><?php 
	echo str_replace(".",",",@$array_renta["8"]["valor"]);
	@$total24=@$total24 + @$array_renta["8"]["valor"];
	?></td>
    <td align="right" ><?php 
	echo str_replace(".",",",@$array_renta["8"]["codigo"]);
	@$total25=@$total25 + @$array_renta["8"]["codigo"];
	?></td>
    <td align="right" >
	<?php 
	echo str_replace(".",",",@$array_renta["10"]["valor"]);
	@$total26=@$total26 + @$array_renta["10"]["valor"];
	?></td>
    <td align="right" >
	<?php 
	echo str_replace(".",",",@$array_renta["10"]["codigo"]);
	@$total27=@$total27 + @$array_renta["10"]["codigo"];
	?></td>
    <td align="right" >
	<?php 
	echo str_replace(".",",",@$array_renta["0"]["valor"]);
	@$total28=@$total28 + @$array_renta["0"]["valor"];
	?></td>
    <td align="right" ><?php 
	echo str_replace(".",",",@$array_renta["0"]["codigo"]);
	@$total29=@$total29 + @$array_renta["0"]["codigo"];
	?></td>
    <td align="right" >0</td>
    <td align="right" ></td>
    <td align="right" ><?php echo str_replace(".",",",$ivaretett); 
	@$ftotal=$ftotal+$ivaretett;
	?></td>
    <td align="right" ><?php echo str_replace(".",",",($ivaretett+@$ivarete));
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
    <td align="right" ><?php  ?></td>
    <td align="right" ><?php  ?></td>
	<td ><?php  ?></td>
	<td align="right" ><?php  ?></td>
    <td align="right" ><?php  ?></td>
    <td nowrap="nowrap"><?php ?></td>
    <td nowrap="nowrap"><?php  ?></td>
    <td align="right" ><?php  ?></td>
    <td align="right" ><?php  ?></td>
    <td align="right" ><?php  ?></td>
    <td align="right" ><?php echo str_replace(".",",",@$total1); ?></td>
	<td align="right" ><?php echo str_replace(".",",",@$total1cinco); ?></td>
    <td align="right" ><?php echo str_replace(".",",",@$total1ocho); ?></td>
    <td align="right" ><?php echo str_replace(".",",",@$total2); ?></td>
    <td align="right" ><?php echo str_replace(".",",",@$total3); ?></td>
    <td align="right" ><?php echo str_replace(".",",",$total4); ?></td>
    <td align="right" ><?php echo str_replace(".",",",$total5); ?></td>
    <td align="right" ><?php echo str_replace(".",",",$total6); ?></td>
    <td align="right" ><?php echo str_replace(".",",",$total7); ?></td>
    <td align="right" ><?php echo str_replace(".",",",$total8); ?></td>
    <td align="right" ><?php echo str_replace(".",",",$total9); ?></td>
    <td align="right" ><?php echo str_replace(".",",",$total10); ?></td>
    <td align="right" ><?php echo str_replace(".",",",$total11); ?></td>
    <td align="right" ><?php echo str_replace(".",",",$total12); ?></td>
    <td align="right" ><?php echo str_replace(".",",",$total13); ?></td>
    <td align="right" ><?php echo str_replace(".",",",$total14); ?></td>
    <td align="right" ><?php echo str_replace(".",",",$total15); ?></td>
    <td nowrap="nowrap"></td>
    <td nowrap="nowrap"></td>
    <td nowrap="nowrap"></td>
    <td align="right" ><?php 
	echo str_replace(".",",",@$total16);
	?></td>
    <td align="right" >
	<?php
	
	?>
	</td>
    <td align="right" >
	<?php 
	echo str_replace(".",",",@$total18);
	?>
	</td>
    <td align="right" ><?php 

	?></td>
    <td align="right" >
	<?php 
	echo str_replace(".",",",@$total20);
	?></td>
    <td align="right" ><?php 
	
	?></td>
    <td align="right" ><?php 
	echo str_replace(".",",",@$total22);
	?></td>
    <td align="right" ><?php 
	
	?></td>
    <td align="right" ><?php 
	echo str_replace(".",",",@$total24);
	?></td>
    <td align="right" ><?php 
	
	?></td>
    <td align="right" >
	<?php 
	echo str_replace(".",",",@$total26);
	?></td>
    <td align="right" >
	<?php 
	
	?></td>
    <td align="right" >
	<?php 
	echo str_replace(".",",",@$total28);
	?></td>
    <td align="right" ><?php 
	
	?></td>
    <td align="right" >0</td>
    <td align="right" ></td>
    <td align="right" ><?php echo str_replace(".",",",@$ftotal); ?></td>
    <td align="right" ><?php echo str_replace(".",",",@$gtotlatotal); ?></td>
  </tr>
</table>