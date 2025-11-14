<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
include("lib.php");

$objformulario= new  ValidacionesFormulario();

if(@$_SESSION['ces1313777_sessid_inicio'])
{
//echo getcwd();

$path_valor="../../archivoinv/".$_POST["compra_xml"];
$xml_valor='';
$xml_valor=leer_contenido_completo($path_valor);

$arreglo_data=array();

$buscasies_enveloped=0;
$resultado_emb = strpos($xml_valor, 'soap:Envelope');
if($resultado_emb !== FALSE){
		 $buscasies_enveloped=1;
}

 if($buscasies_enveloped)
		  {
		    
			$xml_valor=str_replace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body><ns2:autorizacionComprobanteResponse xmlns:ns2="http://ec.gob.sri.ws.autorizacion">',"",$xml_valor);
			
			$xml_valor=str_replace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <ns2:autorizacionComprobanteResponse xmlns:ns2="http://ec.gob.sri.ws.autorizacion">',"",$xml_valor);
			
		    $xml_valor=str_replace('</ns2:autorizacionComprobanteResponse></soap:Body></soap:Envelope>',"",$xml_valor);
			
		    $xml_valor=str_replace('</ns2:autorizacionComprobanteResponse>
  </soap:Body>
</soap:Envelope>',"",$xml_valor);

//echo xml_valor;

			 $arreglo_data=leer_xmlpj_v2_emv($xml_valor);  
		  
		  }
		  else
		  {
		     $arreglo_data=leer_xml_env($xml_valor);
		  
		  }
		  		 
		 

//print_r($arreglo_data);

$fecha_n='';
$fecha_n=formato_fecha($arreglo_data["fechaemision"]);
//$estructura = new SimpleXMLElement(utf8_encode($xml_valor));
//$comprobante_xml=$estructura->comprobante;

//$estructura2 = new SimpleXMLElement(utf8_encode($comprobante_xml));

//$codDoc=$estructura2->infoTributaria->codDoc;
//echo $tipodocumento=$codDoc;
//print_r($arreglo_data);

$buscacomprafact="select * from dns_compras inner join app_proveedor on dns_compras.proveevar_id=app_proveedor.provee_id where compra_nfactura='".$arreglo_data["numDocModificado"]."' and (provee_ruc='".$arreglo_data["ruc"]."' or provee_cedula='".$arreglo_data["ruc"]."')";

$rs_buscfact = $DB_gogess->executec($buscacomprafact,array());


$provee_id=0;
//busca _proveedor
if($arreglo_data["ruc"])
{
$listap="select * from app_proveedor where 	provee_ruc='".$arreglo_data["ruc"]."'";
$rs_listap = $DB_gogess->executec($listap,array());
$provee_id=$rs_listap->fields["provee_id"];


}



$asigna_proveedor=0;




}
?>
<script type="text/javascript">
<!--

$('#compra_codmodif').val('<?php echo $arreglo_data["codDocModificado"]; ?>');
$('#compra_nummodif').val('<?php echo $arreglo_data["numDocModificado"]; ?>');
$('#compra_autmodi').val('<?php echo $rs_buscfact->fields["compra_autorizacion"]; ?>');



//  End -->
</script>