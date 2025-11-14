<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8'); 
$tiempossss=44440000;
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
	     $nombrevarget='';
		if (preg_match('/^[a-z\d_=]{1,200}$/i', $valores[$i])) {
			//$$tags[$i]=$valores[$i];
			$nombrevarget=$tags[$i];
			$$nombrevarget=$valores[$i];
		}
		else
		{
			//$$tags[$i]=0;
			$nombrevarget=$tags[$i];
			$$nombrevarget=0;
	    }
	///
	}
///
}

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");
 
$objformulario= new  ValidacionesFormulario();
$obj_funciones=new util_funciones();
include("codebarra/Barcode.php");
 
$url="../plantillas/rolde_pagos.php";
$comprobantepdf=$obj_funciones->leer_contenido_completo($url);
 
 
 
$xml="roldepagos";
$dompdf = new DOMPDF();
$dompdf->set_paper('A4', 'portrait');
$dompdf->load_html($comprobantepdf, 'UTF-8');
$dompdf->render();
$font = Font_Metrics::get_font("helvetica", "bold");
$canvas = $dompdf->get_canvas();
$footer = $canvas->open_object();
////$canvas->line(10,730,800,730,array(0,0,0),1);
$canvas->page_text(530, 833, "{PAGE_NUM} de {PAGE_COUNT}",$font, 10, array(0,0,0));
$canvas->close_object();
$canvas->add_object($footer, "all");
$dompdf->stream($xml.".pdf");
 
 
}

?>