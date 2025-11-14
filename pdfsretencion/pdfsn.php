<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8'); 
include("../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);

$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

for($i=0;$i<$numero;$i++){
///
	if ($tags[$i]=='xml')
	{
	///
		if (preg_match('/^[a-z\d_=]{1,200}$/i', $valores[$i])) {
			$$tags[$i]=$valores[$i];
		}
		else
		{
			$$tags[$i]=0;
	    }
	///
	}
///
}



 $director="../";
 include("../cfgclases/clases.php");
include("codebarra/Barcode.php");

  $idfac=$xml;
 $listaxml="select * from comprobante_retencion_cab where compretcab_id='".$xml."'";
 $resultlistat = $DB_gogess->Execute($listaxml);
 $data_xml=$resultlistat->fields["compretcab_xml"];
 $compretcab_clavedeaccesos=$resultlistat->fields["compretcab_clavedeaccesos"];
 $compretcab_id=$resultlistat->fields["compretcab_id"];
 $nauto=$resultlistat->fields["compretcab_nautorizacion"];
 $fechaaut=$resultlistat->fields["compretcab_fechaaut"];
$fechaemi=$resultlistat->fields["compretcab_fechaemision_cliente"];
$tipo_comp=$resultlistat->fields["compretcab_tipocomprobante"];

$offline_valor=$resultlistat->fields["compretcab_offline"];

 $datos_empresa="select * from factura_empresa where emp_id=".$resultlistat->fields["emp_id"];
						   $rs_empresa = $DB_gogess->Execute($datos_empresa);
						   if($rs_empresa)
						   {
								while (!$rs_empresa->EOF) {
								
								  $emp_nombre=$rs_empresa->fields["emp_nombre"];
								  $emp_ruc=$rs_empresa->fields["emp_ruc"];
								  $emp_direccion=$rs_empresa->fields["emp_direccion"];
								  $emp_logo=$rs_empresa->fields["emp_logo"];
								
								
								
								if($emp_logo)
								{
								$logotipo_imd= '<div id=div_logo ><img src="../archivo/'.$emp_logo.'"  width="180"  /></div>';
								}
								
								 $rs_empresa->MoveNext();
								}	
						   }
 
 
 
 $data_xml=trim($resultlistat->fields["compretcab_xml"]);
 
	 $xml_rest=base64_decode($data_xml);

 

//codigo de barras
$path_barracode="../codigodebarra/";
generacodebarra($path_barracode,$compretcab_clavedeaccesos,$xml,$tipo_comp);
//--------------------------------------
	
	//--------------------------------------
//$code_barra= '<img src="../codigodebarra/nsret'.$idfac.".gif".'"   />';
$code_barra='<img src="'.$path_barracode.$tipo_comp.$xml.'.gif'.'" width="300" height="60" >';	

//codigo de barras

//echo $xml_rest;

//$xml=leer_contenido_completo("../../XMLPRUEBA.xml");
$fechaemip=strtotime($fechaemi." 00:00:00");
$fecha_entrada = strtotime("2015-03-12 00:00:00");

if ($fechaemip < $fecha_entrada)
	{
include("../libreria/lib_parametrosant.php");
		}else {
include("../libreria/lib_parametros.php");
		}
$comprobantepdf=leer_xml(0,$xml_rest,'07',$nauto,$fechaaut,$logotipo_imd,$code_barra,$griddata,$valor_total,$valorsiniva_total,$valornograbado,$pathextrap,$offline_valor);
//echo $comprobantepdf;

$dompdf = new DOMPDF();
$dompdf->set_paper('A4', 'portrait');
$dompdf->load_html($comprobantepdf, 'UTF-8');
$dompdf->render();

$font = Font_Metrics::get_font("helvetica", "bold");
$canvas = $dompdf->get_canvas();
$footer = $canvas->open_object();

    ////$canvas->line(10,730,800,730,array(0,0,0),1);
    $canvas->page_text(530, 833, "{PAGE_NUM} de {PAGE_COUNT}",
                   $font, 10, array(0,0,0));

$canvas->close_object();
$canvas->add_object($footer, "all");

$dompdf->stream($xml.".pdf");
unlink($path_barracode.$tipo_comp.$_GET["xml"].'.gif');
 
?>