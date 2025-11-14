<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();


$busca_listatx="SELECT * FROM lpin_cobropago inner join beko_documentocabecera on lpin_cobropago.doccab_id=beko_documentocabecera.doccab_id where ttra_id=1";
$rs_listatx = $DB_gogess->executec($busca_listatx);
if($rs_listatx)
	{
	   while (!$rs_listatx->EOF) 
			{
			
			   $doccab_fechaemision_cliente=$rs_listatx->fields["doccab_fechaemision_cliente"];
			   
			  
			   
			   echo "<br><br>CODIGO: ".$rs_listatx->fields["crb_id"]."<br>";
			   echo "FECHA: ".$rs_listatx->fields["crb_fecha"]."<br>";
			   echo "DESCRIPCION: ".$rs_listatx->fields["crb_descripcion"]."<br>";
			   echo "========================================================<br>";
			   
			   $saca_detalle1="select * from lpin_cobropagodetalle where crb_enlace='".$rs_listatx->fields["crb_enlace"]."'";
			   $rs_sdetalle1 = $DB_gogess->executec($saca_detalle1);
				if($rs_sdetalle1)
					{
					   while (!$rs_sdetalle1->EOF) 
							{
							    
								if($rs_sdetalle1->fields["doccabcp_id"])
								{
								 $busca_cab="select * from beko_documentocabecera where doccab_id='".$rs_sdetalle1->fields["doccabcp_id"]."'";
								 $rs_cab1 = $DB_gogess->executec($busca_cab); 
								 $doccab_ndocumento=$rs_cab1->fields["doccab_ndocumento"];
								 
							     echo "Factura Venta: ".$doccab_ndocumento." Fecha: ".$rs_sdetalle1->fields["crpadet_fechaemision"]." -> ".$rs_sdetalle1->fields["crpadet_valorapagar"]." -> ".$rs_sdetalle1->fields["crpadet_valor"]."<br>";
								}
								
								if($rs_sdetalle1->fields["compracp_id"])
								{
								 $busca_cab="select * from dns_compras where compra_id='".$rs_sdetalle1->fields["compracp_id"]."'";
								 $rs_cab1 = $DB_gogess->executec($busca_cab); 
								 $compra_nfactura=$rs_cab1->fields["compra_nfactura"];
								 
							     echo "Compra: ".$compra_nfactura." Fecha: ".$rs_sdetalle1->fields["crpadet_fechaemision"]." -> ".$rs_sdetalle1->fields["crpadet_valorapagar"]." -> ".$rs_sdetalle1->fields["crpadet_valor"]."<br>";
								}
								 
							
							     $rs_sdetalle1->MoveNext();	
							}
					 }		
			   
			   if($doccab_fechaemision_cliente!=$rs_listatx->fields["crb_fecha"])
			   {
			     $actualiza_fecha="update lpin_cobropago set crb_fecha='".$doccab_fechaemision_cliente."' where 	crb_id='".$rs_listatx->fields["crb_id"]."'";
				 //echo $actualiza_fecha."<br>";
				 $rs_fecha = $DB_gogess->executec($actualiza_fecha);
			   }
			   
			
			  $rs_listatx->MoveNext();			
			}
	}		
			


}
?>