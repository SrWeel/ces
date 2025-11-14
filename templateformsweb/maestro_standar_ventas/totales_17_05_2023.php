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

$doccab_id=$_POST["doccab_id"];


$lista_valor=array();

$lista_detalles="select sum(docdet_total) as total,tari_codigo  from beko_documentodetalle where doccab_id='".$doccab_id."' group by tari_codigo";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	     $lista_valor[$rs_data->fields["tari_codigo"]]=$lista_valor[$rs_data->fields["tari_codigo"]]+$rs_data->fields["total"];
	  
	    $rs_data->MoveNext();
	  }
  }	 
  

$lista_detalles="select sum(mhdetfac_total) as total,tarimh_codigo as tari_codigo  from beko_mhdetallefactura where doccab_id='".$doccab_id."' group by tarimh_codigo";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	     $lista_valor[$rs_data->fields["tari_codigo"]]=$lista_valor[$rs_data->fields["tari_codigo"]]+$rs_data->fields["total"];
	  
	    $rs_data->MoveNext();
	  }
  }	    


$lista_detalles="select sum(cueven_subtotal) as total,taric_idv  from lpin_cuentaventa where doccab_id='".$doccab_id."' group by taric_idv";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	     $sacatari="select * from beko_tarifa where tari_id='".$rs_data->fields["taric_idv"]."'";
		 $rs_sacatar = $DB_gogess->executec($sacatari,array());		 
		 $tari_codigo=$rs_sacatar->fields["tari_codigo"];	  
		 
	     $lista_valor[$tari_codigo]=$lista_valor[$tari_codigo]+$rs_data->fields["total"];
	  
	    $rs_data->MoveNext();
	  }
  }	
 
//print_r($lista_valor);
 
//saca descuentos
$array_descuentos=array();
$lista_detalles="select sum(docdet_descuento) as descuento  from beko_documentodetalle where doccab_id='".$doccab_id."'";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	    $array_descuentos["descuento"]=$array_descuentos["descuento"]+$rs_data->fields["descuento"];
	  
	   $rs_data->MoveNext();
	  }
 }	
 

//$array_descuentos=array();
$lista_detalles="select sum(mhdetfac_descuento) as descuento  from beko_mhdetallefactura where doccab_id='".$doccab_id."'";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	    $array_descuentos["descuento"]=$array_descuentos["descuento"]+$rs_data->fields["descuento"];
	  
	   $rs_data->MoveNext();
	  }
 }	   
 

$lista_detalles="select sum(cueven_descuentodolar) as descuento  from lpin_cuentaventa where doccab_id='".$doccab_id."'";
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




$busca_autorizado="select * from beko_documentocabecera where doccab_id='".$doccab_id."'";
$rs_aut = $DB_gogess->executec($busca_autorizado,array());	

$doccab_estadosri=$rs_aut->fields["doccab_estadosri"];

if($doccab_estadosri!='AUTORIZADO')
{
?>
$('#doccab_subtotaliva').val('<?php echo round($lista_valor[2], 2); ?>');
$('#doccab_subtotalsiniva').val('<?php echo round($lista_valor[0], 2); ?>');
$('#doccab_descuento').val('<?php echo round($array_descuentos["descuento"], 2); ?>');
$('#doccab_iva').val('<?php echo round($totales_iva, 2); ?>');
$('#doccab_total').val('<?php echo round($ttotal, 2); ?>');
<?php
}
?>

//-->
</script>

<?php

//busca formas de pago
if($doccab_estadosri!='AUTORIZADO')
{

$busca_fpago="select * from lpin_formapagoventa where doccab_id='".$doccab_id."'";
$rs_fpago = $DB_gogess->executec($busca_fpago,array());	

if($rs_fpago->fields["frmpven_id"]>0)
{

$actualiz_data="update lpin_formapagoventa set frmpven_valor='".round($ttotal, 2)."' where frmpven_id='".$rs_fpago->fields["frmpven_id"]."'";
$rs_acdata = $DB_gogess->executec($actualiz_data,array());	

}
else
{

$inserta_data="INSERT INTO lpin_formapagoventa ( doccab_id, frmc_codigo, frmpven_plazo, untiem_id, frmpven_valor, usua_id, frmpven_fecharegistro) VALUES ( '".$doccab_id."', 20, 0, 1,".round($ttotal, 2).",'".$_SESSION['ces1313777_sessid_inicio']."', '".date("Y-m-d H:i:s")."');";
$rs_indata = $DB_gogess->executec($inserta_data,array());

}

?>
<script language="javascript">
<!--
  grid_extras_9931('<?php echo $doccab_id; ?>',0,0);
//-->
</script>

<?php
}
//busca fromas de pago


}

?>