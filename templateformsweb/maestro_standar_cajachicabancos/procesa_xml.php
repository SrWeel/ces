<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
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
$arreglo_data=leer_xml_env($xml_valor);

$fecha_n='';
$fecha_n=formato_fecha($arreglo_data["fechaemision"]);
//$estructura = new SimpleXMLElement(utf8_encode($xml_valor));
//$comprobante_xml=$estructura->comprobante;

//$estructura2 = new SimpleXMLElement(utf8_encode($comprobante_xml));

//$codDoc=$estructura2->infoTributaria->codDoc;
//echo $tipodocumento=$codDoc;
//print_r($arreglo_data);

$borra_cargal="delete from dns_comprasdetallexml where cdxml_claveacceso='".$arreglo_data["claveAcceso"]."' and cdxml_asignado=0";
$rs_caragal = $DB_gogess->executec($borra_cargal,array());

//print_r($arreglo_data["detalles"]);

for($ip=0;$ip<count($arreglo_data["detalles"]);$ip++)
{

$cdxml_claveacceso=$arreglo_data["claveAcceso"];
$cdxml_codigo=$arreglo_data["detalles"][$ip]["codigo"];
$cdxml_cantidad=$arreglo_data["detalles"][$ip]["cantidad"];
$cdxml_descripcion=$arreglo_data["detalles"][$ip]["descripcion"];
$cdxml_preciounitario=$arreglo_data["detalles"][$ip]["preciounitario"];
$cdxml_descuento=$arreglo_data["detalles"][$ip]["descuento"];
$cdxml_iva=$arreglo_data["detalles"][$ip]["iva"];
$cdxml_totalsinimpuestos=$arreglo_data["detalles"][$ip]["total"];
$cdxml_fecharegistro=date("Y-m-d H:i:s");
$lpti_id='0';
$cdxml_asignado='0';

$inserta_lista="INSERT INTO dns_comprasdetallexml ( cdxml_claveacceso, cdxml_codigo, cdxml_cantidad, cdxml_descripcion, cdxml_preciounitario, cdxml_descuento, cdxml_iva, cdxml_totalsinimpuestos, cdxml_fecharegistro, lpti_id, cdxml_asignado) VALUES ('".$cdxml_claveacceso."','".$cdxml_codigo."','".$cdxml_cantidad."','".$cdxml_descripcion."','".$cdxml_preciounitario."','".$cdxml_descuento."','".$cdxml_iva."','".$cdxml_totalsinimpuestos."','".$cdxml_fecharegistro."','".$lpti_id."','".$cdxml_asignado."');";

$rs_insertalista = $DB_gogess->executec($inserta_lista,array());


}


//busca _proveedor

$listap="select * from app_proveedor where 	provee_ruc='".$arreglo_data["ruc"]."'";
$rs_listap = $DB_gogess->executec($listap,array());

$provee_id=$rs_listap->fields["provee_id"];

$asigna_proveedor=0;


if($provee_id>0)
{
$asigna_proveedor=$provee_id;
}
else
{


$emp_id='1';
$provee_ruc=$arreglo_data["ruc"];
$provee_nombre=$arreglo_data["razonSocial"];
$provee_representante='';
$provee_nombrecomercial=$arreglo_data["nombreComercial"];
$provee_direccion=$arreglo_data["dirMatriz"];
$provee_telefono='';
$provee_email='';
$provee_fecharegistro=date("Y-m-d H:i:s");

$inserta_proveedro="INSERT INTO app_proveedor ( emp_id, provee_ruc, provee_nombre, provee_representante, provee_nombrecomercial, provee_direccion, provee_telefono, provee_email, provee_fecharegistro) VALUES ('".$emp_id."','".$provee_ruc."','".$provee_nombre."','".$provee_representante."','".$provee_nombrecomercial."','".$provee_direccion."','".$provee_telefono."','".$provee_email."','".$provee_fecharegistro."'); ";

$rs_lprove = $DB_gogess->executec($inserta_proveedro,array());

$asigna_proveedor=$DB_gogess->funciones_nuevoID(0);

}

//busca proveedor

}
?>
<script type="text/javascript">
<!--



$('#compra_nfactura').val('<?php echo $arreglo_data["estab"]."-".$arreglo_data["ptoEmi"]."-".$arreglo_data["secuencial"]; ?>');
$('#compra_fecha').val('<?php echo $fecha_n; ?>');
$('#compra_valorfactura').val('<?php echo $arreglo_data["importetotal"]; ?>');
$('#compra_claveacceso').val('<?php echo $arreglo_data["claveAcceso"]; ?>');
$('#compra_autorizacion').val('<?php echo $arreglo_data["claveAcceso"]; ?>');
$('#tipop_id').val('1');



function actualiza_cmb1()
{
     
	 $("#cmb_proveevar_id").load("templateformsweb/maestro_standar_compras/proveedor_d/cmb_proveedor.php",{

	  },function(result){  
	  //alert($('#provee_id').val());
	     $('#proveevar_id').val('<?php echo $asigna_proveedor; ?>');
		    
	  });  
	
	  $("#cmb_proveevar_id").html("...");  

}

actualiza_cmb1();

//  End -->
</script>
