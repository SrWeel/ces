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

$compra_enlace=$_POST["compra_enlace"];

$lista_valor=array();

$lista_detalles="select sum(prcomp_subtotal) as total,prcomp_taricodigo  from lpin_productocompra where compra_enlace='".$compra_enlace."' group by prcomp_taricodigo";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	     $lista_valor[$rs_data->fields["prcomp_taricodigo"]]=$lista_valor[$rs_data->fields["prcomp_taricodigo"]]+$rs_data->fields["total"];
	  
	    $rs_data->MoveNext();
	  }
  }	  


 $lista_detalles="select sum(cuecomp_subtotal) as total,taric_id  from lpin_cuentacompra where compra_enlace='".$compra_enlace."' group by taric_id";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	     $sacatari="select * from beko_tarifa where tari_id='".$rs_data->fields["taric_id"]."'";
		 $rs_sacatar = $DB_gogess->executec($sacatari,array());		 
		 $tari_codigo=$rs_sacatar->fields["tari_codigo"];	  
		 
	     $lista_valor[$tari_codigo]=$lista_valor[$tari_codigo]+$rs_data->fields["total"];
	  
	    $rs_data->MoveNext();
	  }
  }	
 
//print_r($lista_valor);
 
//saca descuentos
$array_descuentos=array();
$lista_detalles="select sum(prcomp_descuentodolar) as descuento  from lpin_productocompra where compra_enlace='".$compra_enlace."'";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	    $array_descuentos["descuento"]=$array_descuentos["descuento"]+$rs_data->fields["descuento"];
	  
	   $rs_data->MoveNext();
	  }
 }	  
 

$lista_detalles="select sum(cuecomp_descuentodolar) as descuento  from lpin_cuentacompra where compra_enlace='".$compra_enlace."'";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	     $array_descuentos["descuento"]=$array_descuentos["descuento"]+$rs_data->fields["descuento"];
	  
	    $rs_data->MoveNext();
	  }
  }	
  

//saca descuentos  

//saca iva
$valor_iva=array();
$totales_iva=0;
$gran_total=0;


$sacatari="select * from beko_tarifa";
$rs_sacatar = $DB_gogess->executec($sacatari,array());	
 if($rs_sacatar)
 {
	  while (!$rs_sacatar->EOF) {	  
	  
	  $valor_iva[$rs_sacatar->fields["tari_codigo"]]=($lista_valor[$rs_sacatar->fields["tari_codigo"]]*$rs_sacatar->fields["tari_valor"])/100;
	  
	  $gran_total=$gran_total+$lista_valor[$rs_sacatar->fields["tari_codigo"]];
	  $totales_iva=$totales_iva+$valor_iva[$rs_sacatar->fields["tari_codigo"]];
	  
	  $rs_sacatar->MoveNext();
	  }
 }	  

//saca iva
  
//saca totales

$ttotal=$gran_total+$totales_iva;

//saca totales
//print_r($lista_valor);

?>

<script language="javascript">
<!--

<?php
if(!(@$lista_valor[2]))
{
 $lista_valor[2]=0;
} 

if(!(@$lista_valor[0]))
{
 $lista_valor[0]=0;
} 
?>

$('#compra_subtotaliva').val('<?php echo $lista_valor[2]; ?>');
$('#compra_subtotalceroiva').val('<?php echo $lista_valor[0]; ?>');
$('#compra_descuento').val('<?php echo $array_descuentos["descuento"]; ?>');
$('#compra_iva').val('<?php echo $totales_iva; ?>');
$('#compra_total').val('<?php echo $ttotal; ?>');

//-->
</script>

<?php

}

?>