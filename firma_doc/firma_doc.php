<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8'); 
$tiempossss=4444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);

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

//echo $_POST["idfactura"];

 $listaxml="select * from beko_documentocabecera where doccab_id='".$_POST["idfactura"]."'";
 $resultlistat = $DB_gogess->executec($listaxml,array());
 $data_xml=$resultlistat->fields["doccab_xml"];
 
 $doc['usuario']="faesa";
 $doc['clave']=md5("123456");
 $doc['xml']=$data_xml;
 
 $resultado=array();
 
 require_once('lib/nusoap.php');
 $resultado["resultado"]=1;
 $resultado["motivo"]='Sin conexi&oacute;n';
 
 $resultado=array();
 
 echo 'http://186.4.157.126:75/doc_sign/server.php?wsdl<br>';
 //print_r($doc);
 
 $cliente = new nusoap_client('http://186.4.157.126:75/doc_sign/server.php?wsdl');
 $sError = $cliente->getError();
 $resultado = $cliente->call('SignDoc', array('Documento' =>$doc));
 

 
 print_r($resultado);
 switch($resultado["resultado"])
		{
			case '1';
					{
					$motivo_texto='Archivo a firmar no existe...';
					 echo $motivo_texto;
					}
			break;
			case '2';
				{
				
				  $motivo_texto='Certificado no existe...';
				   echo $motivo_texto;
				}
			break;
			case '3';
				{
				
				  $motivo_texto='Clave del certificado incorrecto...';
				   echo $motivo_texto;
				}
				break;
			break;
			default;
				{
				  $motivo_texto='';
				  
				  if($resultado["resultado"])
				  {
				  $actualiza="update beko_documentocabecera set doccab_xmlfirmado='".$resultado["resultado"]."',doccab_firmado='SI' where doccab_id='".$_POST["idfactura"]."'";
				   $ok_firma = $DB_gogess->executec($actualiza,array());
				   if($ok_firma)
				   {
				     echo 'Documento firmado con exito...';
				   }
				  }
				  else
				  {
				    echo 'Sin conexi&oacute;n';
				  
				  }
				
				}
			break;
		}
 


?>