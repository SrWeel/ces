<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{

$doccab_id=$_POST["valor_id"];

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();



$lista_renta="select * from lpin_comprobantecontable  where tipoa_id='5' and comcont_tabla='beko_documentocabecera' and comcont_idtabla!='' and comcont_concepto like 'RETENCION VENTA.%'";
$rs_listadata = $DB_gogess->executec($lista_renta,array());
if($rs_listadata)
 {
	  while (!$rs_listadata->EOF) {	
	
	     $busca_fecharet="select * from beko_documentocabecera where doccab_id='".$rs_listadata->fields["comcont_idtabla"]."'";
		 $rs_retenc = $DB_gogess->executec($busca_fecharet,array());
		 
		 $doccab_retfechaemision=$rs_retenc->fields["doccab_retfechaemision"];
		 
		 $sindt='';
		 
		 if($doccab_retfechaemision=='' || $doccab_retfechaemision=='0000-00-00')
		 {
		      $doccab_retfechaemision=$rs_retenc->fields["doccab_fechaemision_cliente"];
			  $sindt='*****';
			  
		 }
		 
		$doccab_ndocumento=$rs_retenc->fields["doccab_ndocumento"];
		$doccab_nombrerazon_cliente=$rs_retenc->fields["doccab_nombrerazon_cliente"];
		$doccab_apellidorazon_cliente=$rs_retenc->fields["doccab_apellidorazon_cliente"];
		$doccab_total=$rs_retenc->fields["doccab_total"];
		$doccab_fechaemision_cliente=$rs_retenc->fields["doccab_fechaemision_cliente"];		
		$doccab_retnumdoc=$rs_retenc->fields["doccab_retnumdoc"];
		//$doccab_retfechaemision=$rs_retenc->fields["doccab_retfechaemision"];
		
$concepto='';
$concepto='RETENCION VENTA. '.$doccab_retnumdoc.' FECHA:'.$doccab_retfechaemision.' FACTURA:'.$doccab_ndocumento.' '.$doccab_nombrerazon_cliente.' '.$doccab_apellidorazon_cliente;

		 
		 ///actualiza fecha
		 
		 $ac_data="update lpin_comprobantecontable set comcont_concepto='".$concepto."', comcont_fecha='".$doccab_retfechaemision."' where comcont_id='".$rs_listadata->fields["comcont_id"]."'";
		 $rs_acdata = $DB_gogess->executec($ac_data,array());
		 
		 echo $sindt.' '.$ac_data."<br>";
		 
		 ///actualiza fecha
	  
	  

         $rs_listadata->MoveNext();
	  }
  }	


//retencion en ventas



}

?>