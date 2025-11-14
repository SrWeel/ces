<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
//header('Content-Type: text/html; charset=UTF-8'); 
$tiempossss=4444000;
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

$griddata='';
$valor_total=0;
$valorsiniva_total=0;
$valornograbado=0;
$pathextrap='';

 $director='../';
 include("../cfg/clases.php");
 include("../cfg/declaracion.php");
 include(@$director."libreria/estructura/aqualis_master.php");
 
 for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
$objformulario= new  ValidacionesFormulario();
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
 
 include("codebarra/Barcode.php");


 $idfac=$xml;
 $listaxml="select * from dns_compras where compra_id='".$xml."'";
 $resultlistat = $DB_gogess->executec($listaxml,array());
 $data_xml=$resultlistat->fields["compra_xmlsri"];
 $comcab_clavedeaccesos=$resultlistat->fields["compra_claveacceso"];
 $doccab_id=$resultlistat->fields["compra_id"];
 
 $nauto=$resultlistat->fields["compra_autorizacion"];
 $fechaaut=$resultlistat->fields["compra_fechaaut"];
 $compra_nfactura=$resultlistat->fields["compra_nfactura"];
 
 $tipo_comp='03';
 
 $offline_valor=1;
 
 
 $datos_empresa="select * from app_empresa where emp_id=".$resultlistat->fields["emp_id"];
						   $rs_empresa = $DB_gogess->executec($datos_empresa,array());
						   if($rs_empresa)
						   {
								while (!$rs_empresa->EOF) {
								
								  $emp_nombre=$rs_empresa->fields["emp_nombre"];
								  $emp_ruc=$rs_empresa->fields["emp_ruc"];
								  $emp_direccion=$rs_empresa->fields["emp_direccion"];
								  $emp_logo=$rs_empresa->fields["emp_logo"];
								
								
								
								if($emp_logo)
								{
								$logotipo_imd= '<div id=div_logo ><img src="../archivo/'.$emp_logo.'"  width="90"  /></div>';
								}
								
								 $rs_empresa->MoveNext();
								}	
						   }
 
 
 
 $data_xml=trim($resultlistat->fields["compra_xmlsri"]);

 $xml_rest=base64_decode($data_xml);


 $path_barracode="../codigodebarra/";
 generacodebarra($path_barracode,$comcab_clavedeaccesos,$xml,$tipo_comp);


//codigo de barras


//$code_barra= '<img src="../codigodebarra/fac'.$idfac.".gif".'"  width="270" height="60" />';

$code_barra='<img src="'.$path_barracode.$tipo_comp.$xml.'.gif'.'" width="300" height="60" >';

//codigo de barras

//echo $xml_rest;

//$xml=leer_contenido_completo("../../XMLPRUEBA.xml");

$comprobantepdf=leer_xml(0,$xml_rest,'03',$nauto,$fechaaut,$logotipo_imd,$code_barra,$griddata,$valor_total,$valorsiniva_total,$valornograbado,$pathextrap,$offline_valor);

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

$dompdf->stream("LQ".$compra_nfactura.".pdf");

unlink($path_barracode.$tipo_comp.$_GET["xml"].'.gif');
}   
?>