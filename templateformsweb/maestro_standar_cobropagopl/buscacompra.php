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

$compracp_idx=$_POST["compracp_idx"];

$lista_valor=array();
$num_facturabnc='';

$lista_detalles="select * from dns_compras_vista where compra_id='".$compracp_idx."'";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	    $tipdoc_id=$rs_data->fields["tipdoc_id"];
		$compra_total=$rs_data->fields["compra_total"];
		$compra_nfactura=str_replace("-","",$rs_data->fields["compra_nfactura"]);
		$compra_fecha=$rs_data->fields["compra_fecha"];
		
		$num_facturabnc=$rs_data->fields["compra_nfactura"];
		$saldo=$rs_data->fields["saldo"];
	     
	    $rs_data->MoveNext();
	  }
  }	  
 


$valor_sinretencion=round($saldo,2);

//saca totales
//print_r($lista_valor);

?>

<script language="javascript">
<!--


$('#crpadet_fechaemisionx').val('<?php echo $compra_fecha; ?>');
$('#tipdocdet_idx').val('<?php echo $tipdoc_id; ?>');
$('#crpadet_valorx').val('<?php echo $valor_sinretencion; ?>');
$('#crpadet_valorapagar').val('');

//-->
</script>

<?php

}

?>