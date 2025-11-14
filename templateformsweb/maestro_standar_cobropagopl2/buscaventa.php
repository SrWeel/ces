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

$lista_detalles="select * from beko_documentocabecera_vista where doccab_id='".$doccabcp_idx."'";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	    
	
	  
	    $tipocmp_codigo=$rs_data->fields["tipocmp_codigo"];
		
		$busca_id="select * from dns_tipodocumentogeneral where tipdoc_codigo='".$tipocmp_codigo."'";
		$rs_bid = $DB_gogess->executec($busca_id,array());
		
		$tipdoc_id=$rs_bid->fields["tipdoc_id"];
		
		$doccab_total=$rs_data->fields["doccab_total"];
		$doccab_ndocumento=str_replace("-","",$rs_data->fields["doccab_ndocumento"]);
		$doccab_fechaemision_cliente=$rs_data->fields["doccab_fechaemision_cliente"];
		
		$saldo=$rs_data->fields["saldo"];
	     
	    $rs_data->MoveNext();
	  }
  }	  


$valor_sinretencion=round(abs($saldo),2);


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