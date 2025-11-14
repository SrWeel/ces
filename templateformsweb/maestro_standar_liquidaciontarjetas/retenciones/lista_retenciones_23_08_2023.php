<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");

$compra_enlace=$_POST["campo_enlace"];

$bloque_registro=0;
$busca_comprax="select * from beko_documentocabecera where doccab_id='".$_POST["campo_enlace"]."'";
$rs_cmpx = $DB_gogess->executec($busca_comprax,array());


//IVA
$lista_valor=array();
$lista_valorrenta=array();


$lista_detalles="select sum(docdet_total) as total,porcevi_id  from beko_documentodetalle where doccab_id='".$compra_enlace."' and porcevi_id>0 and tari_codigo=2 group by tari_codigo";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	     $valor_iva=0;
		 $valor_iva=($rs_data->fields["total"]*12)/100;
	  
	     $lista_valor[$rs_data->fields["porcevi_id"]]["valor"]=$lista_valor[$rs_data->fields["porcevi_id"]]["valor"]+$valor_iva;		 
		 $lista_valor[$rs_data->fields["porcevi_id"]]["codigo"]=$rs_data->fields["porcevi_id"];
	  
	    $rs_data->MoveNext();
	  }
  }	  


$lista_detalles="select sum(cueven_subtotal) as total,porceci_id  from lpin_cuentaventa where doccab_id='".$compra_enlace."' and porceci_id>0 and taric_idv=1 group by porceci_id";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
		 $valor_iva=0;
		 $valor_iva=($rs_data->fields["total"]*12)/100;
		 
	     $lista_valor[$rs_data->fields["porceci_id"]]["valor"]=$lista_valor[$rs_data->fields["porceci_id"]]["valor"]+$valor_iva;
		 $lista_valor[$rs_data->fields["porceci_id"]]["codigo"]=$rs_data->fields["porceci_id"];
	  
	    $rs_data->MoveNext();
	  }
  }	
 
 
$lista_detalles="select sum(acfi_subtotal) as total,porcevhi_id  from beko_mhdetallefactura where doccab_id='".$compra_enlace."' and porcevhi_id>0 and tarimh_codigo=2 group by porcevhi_id";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	  
		 
		 $valor_iva=0;
		 $valor_iva=($rs_data->fields["total"]*12)/100;
		 
	     $lista_valor[$rs_data->fields["porcevhi_id"]]["valor"]=$lista_valor[$rs_data->fields["porcevhi_id"]]["valor"]+$valor_iva;
		 $lista_valor[$rs_data->fields["porcevhi_id"]]["codigo"]=$rs_data->fields["porcevhi_id"];
	  
	    $rs_data->MoveNext();
	  }
  }	
 


//IVA


//RENTA
$lista_valorrenta=array();

$lista_detalles="select sum(docdet_total) as total,porcevr_id  from beko_documentodetalle where compra_enlace='".$compra_enlace."' and porcevr_id>0 group by porcevr_id";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	     $lista_valorrenta[$rs_data->fields["porcevr_id"]]["valor"]=$lista_valorrenta[$rs_data->fields["porcevr_id"]]["valor"]+$rs_data->fields["total"];
		 $lista_valorrenta[$rs_data->fields["porcevr_id"]]["codigo"]=$rs_data->fields["porcevr_id"];
	  
	    $rs_data->MoveNext();
	  }
  }	  


 $lista_detalles="select sum(cueven_subtotal) as total,porcecr_id  from lpin_cuentaventa where compra_enlace='".$compra_enlace."' and porcecr_id>0 group by porcecr_id";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
		 
	     $lista_valorrenta[$rs_data->fields["porcecr_id"]]["valor"]=$lista_valorrenta[$rs_data->fields["porcecr_id"]]["valor"]+$rs_data->fields["total"];
		 $lista_valorrenta[$rs_data->fields["porcecr_id"]]["codigo"]=$rs_data->fields["porcecr_id"];
	  
	    $rs_data->MoveNext();
	  }
  }	
 
 
$lista_detalles="select sum(acfi_subtotal) as total,porcevhr_id  from beko_mhdetallefactura where compra_enlace='".$compra_enlace."' and porcevhr_id>0 group by porcevhr_id";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	    
	     $lista_valorrenta[$rs_data->fields["porcevhr_id"]]["valor"]=$lista_valorrenta[$rs_data->fields["porcevhr_id"]]["valor"]+$rs_data->fields["total"];
		 $lista_valorrenta[$rs_data->fields["porcevhr_id"]]["codigo"]=$rs_data->fields["porcevhr_id"];
	  
	    $rs_data->MoveNext();
	  }
  }	
 
 
//print_r($lista_valorrenta);

//RENTA

?>


<table class="table table-bordered" style="width:100%">
  <tbody><tr>
   <td bgcolor="#DFE9EE">Retenci&oacute;n</td>
   <td bgcolor="#DFE9EE">Tipo</td>
   <td bgcolor="#DFE9EE">Cod.SRI</td>
   <td bgcolor="#DFE9EE">Base</td>
   <td bgcolor="#DFE9EE">%</td>
   <td bgcolor="#DFE9EE">Valor</td>
   </tr>
   
<?php
$lista_renta="select * from ventas_retencion_detalle  where compra_enlace='".$compra_enlace."'";
$rs_listadata = $DB_gogess->executec($lista_renta,array());
if($rs_listadata)
 {
	  while (!$rs_listadata->EOF) {	
	  
	  $ntipo='';
	  if($rs_listadata->fields["impur_id"]==1)
	  {
	    $ntipo='Imp. a la Renta';
	  }
	  
	  if($rs_listadata->fields["impur_id"]==2)
	  {
	    $ntipo='IVA';
	  }
	  

  ?> 
  <tr>
	<td><?php echo $rs_listadata->fields["compretdet_nombreret"]; ?></td>
	<td><?php echo $ntipo; ?></td>
	<td><?php echo $rs_listadata->fields["porcentaje_id"]; ?></td>
	<td><?php echo $rs_listadata->fields["compretdet_baseimponible"]; ?></td>
	<td><?php echo $rs_listadata->fields["compretdet_porcentaje"]; ?></td>
	<td><?php echo $rs_listadata->fields["compretdet_valorretenido"]; ?></td>
  </tr>
<?php
         $rs_listadata->MoveNext();
	  }
  }	

?>  
  </tbody>
 </table>
