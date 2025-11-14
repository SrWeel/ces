<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=44400000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

if($_SESSION['ces1313777_sessid_inicio'])
{

$doccabcp_idx=$_POST["doccabcp_idx"];

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

//$busca_retencion="select sum(compretdet_valorretenido) as retenido from comprobante_retencion_cab inner join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id where compretcab_nfactura='".$doccab_ndocumento."' and compretcab_anulado=0";
//$rs_bretenc = $DB_gogess->executec($busca_retencion,array());

//$valor_retenido=$rs_bretenc->fields["retenido"];
$valor_retenido=0;
$valor_sinretencion=$doccab_total-$valor_retenido;

//saca totales
//print_r($lista_valor);

?>

<script language="javascript">
<!--


$('#crpadet_fechaemisionx').val('<?php echo $doccab_fechaemision_cliente; ?>');
$('#tipdocdet_idx').val('<?php echo $tipdoc_id; ?>');
$('#crpadet_valorx').val('<?php echo $valor_sinretencion; ?>');
$('#crpadet_valorapagar').val('');

//-->
</script>

<?php

}

?>