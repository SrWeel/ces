<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
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


 $listaxml="select * from beko_documentocabecera where doccab_id='".$xml."'";
 $resultlistat = $DB_gogess->executec($listaxml,array());
 $data_xml=trim($resultlistat->fields["doccab_xml"]);
 $data_xmlfirmado=trim($resultlistat->fields["doccab_xmlfirmado"]);
 $doccab_estadosri=trim($resultlistat->fields["doccab_estadosri"]);
 
 $doccab_nautorizacion=trim($resultlistat->fields["doccab_nautorizacion"]);
 $doccab_fechaaut=trim($resultlistat->fields["doccab_fechaaut"]);
 
 $doccab_ndocumento=trim($resultlistat->fields["doccab_ndocumento"]);
 
 


	 if($data_xmlfirmado)
	 {
		 //$xml_rest=base64_decode($data_xmlfirmado);
		 if($doccab_estadosri=='AUTORIZADO')
		 {
			   
	            $datosrrlee=leercampos_xml($data_xmlfirmado);
				$archivostring=base64_decode($data_xmlfirmado);
				$comprovante_aut='<?xml version="1.0" encoding="UTF-8"?>
				<autorizacion>
				<estado>'.$doccab_estadosri.'</estado>
				<numeroAutorizacion>'.$doccab_nautorizacion.'</numeroAutorizacion>
				<fechaAutorizacion>'.$doccab_fechaaut.'</fechaAutorizacion>
				<ambiente>'.$datosrrlee["ambiente"].'</ambiente>
				<comprobante><![CDATA[';			
				
				$comprovante_autpie=']]></comprobante>
				<mensajes/>
				</autorizacion>';
				$xml_rest=$comprovante_aut.$archivostring.$comprovante_autpie; 
			 
		 }
		 else
		 {
			 $xml_rest=base64_decode($data_xmlfirmado);
			 
		 }
	 }
	 else
	 {
		 $xml_rest=base64_decode($data_xml);
		 
	 }
	 


 header("Content-type: application/xml; charset=UTF-8");
 header("Content-Disposition: attachment; filename=NC_".$doccab_ndocumento.".xml");
 echo $xml_rest;
}


?>