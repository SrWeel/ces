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

$path_valor="../../archivoinv/".$_POST["doccab_archivoxmlret"];
$xml_valor='';
$xml_valor=leer_contenido_completo($path_valor);

$arreglo_data=array();
$arreglo_data=leer_xml_env($xml_valor);

$fecha_n='';
$fecha_n=formato_fecha($arreglo_data["fechaemision"]);

$doccab_id=$_POST["doccab_id"];


$busca_comprax="select * from beko_documentocabecera where doccab_id='".$_POST["doccab_id"]."'";
$rs_cmpx = $DB_gogess->executec($busca_comprax,array());

$nfactura1='';
$nfactura1=str_replace("-","",$rs_cmpx->fields["doccab_ndocumento"]);

//print_r($arreglo_data);
//$estructura = new SimpleXMLElement(utf8_encode($xml_valor));
//$comprobante_xml=$estructura->comprobante;

//$estructura2 = new SimpleXMLElement(utf8_encode($comprobante_xml));

//$codDoc=$estructura2->infoTributaria->codDoc;
//echo $tipodocumento=$codDoc;
//print_r($arreglo_data);


for($ip=0;$ip<count($arreglo_data["detalles"]);$ip++)
{

$numDocSustento=$arreglo_data["detalles"][$ip]["numDocSustento"];

if($nfactura1!=$numDocSustento)
{
echo "<div style='color:#FF0000' >Documento incorrecto:".$numDocSustento."</div>";
}


$codigoRetencion=$arreglo_data["detalles"][$ip]["codigoRetencion"];
echo "C&oacute;digo retenci&oacute;n: ".$codigoRetencion.": Valor retenido:".$arreglo_data["detalles"][$ip]["valorRetenido"]." <br>";
$busca_sivalorbien="select * from ventas_retencion_detalle where doccab_id='".$doccab_id."' and porcentaje_id='".$codigoRetencion."'";
$rs_coparax = $DB_gogess->executec($busca_sivalorbien,array());

if($rs_coparax->fields["compretdet_id"]>0)
{

if($rs_coparax->fields["compretdet_valorretenido"]==$arreglo_data["detalles"][$ip]["valorRetenido"])
{


}
else
{
 echo "<div style='color:#FF0000' >Error: no coicide el valor: en el c&oacute;digo:".$codigoRetencion."</div>";
}

}
else
{

 echo "<div style='color:#FF0000' >Error: no existe el c&oacute;digo:".$codigoRetencion."</div>";
}



//

}



//busca proveedor

}
?>

<script type="text/javascript">
<!--




$('#doccab_retnumdoc').val('<?php echo $arreglo_data["estab"]."-".$arreglo_data["ptoEmi"]."-".$arreglo_data["secuencial"]; ?>');
$('#doccab_retfechaemision').val('<?php echo $fecha_n; ?>');
$('#doccab_retautorizacion').val('<?php echo $arreglo_data["claveAcceso"]; ?>');





//  End -->
</script>

<?php

$doccab_retfechaemision=$fecha_n;
$doccab_retnumdoc=$arreglo_data["estab"]."-".$arreglo_data["ptoEmi"]."-".$arreglo_data["secuencial"];
$doccab_retautorizacion=$arreglo_data["claveAcceso"];
$doccab_archivoxmlret=$_POST["doccab_archivoxmlret"];

$Aactualiz_d="update  beko_documentocabecera set doccab_retfechaemision='".$doccab_retfechaemision."',doccab_retnumdoc='".$doccab_retnumdoc."',doccab_retautorizacion='".$doccab_retautorizacion."',doccab_archivoxmlret='".$doccab_archivoxmlret."' where doccab_id='".$doccab_id."'";

$rs_cmpxactu = $DB_gogess->executec($Aactualiz_d,array());

?>
