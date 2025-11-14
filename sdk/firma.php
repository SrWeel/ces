<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
ini_set('memory_limit', '-1');
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

for($i=0;$i<$numero;$i++){
///
	if ($tags[$i]=='xml')
	{
	///
		if (preg_match('/^[a-z\d_=]{1,200}$/i', $valores[$i])) {
			//$$tags[$i]=$valores[$i];			
			$nombrevarget='';
			$nombrevarget=$tags[$i];
			$$nombrevarget=$valores[$i];
			
		}
		else
		{
			//$$tags[$i]=0;			
			$nombrevarget='';
			$nombrevarget=$tags[$i];
			$$nombrevarget=0;
			
	    }
	///
	}
///
}


$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");
include("configcentro.php");

//cfg
$doc['usuario']='heifer';
$doc['clave']=md5('123456');
//cfg

//facturas
require_once('lib/nusoap.php');



//firma
function firma_documentos($tipocmp_tabla,$tipocmp_campofirmado,$tipocmp_sinfirma,$tipocmp_campoxmlfirmado,$tipocmp_campoid,$valcentro,$tipocmp_anulado,$DB_gogess)
{
//===============================================================================


//and doccab_ndocumento='007-001-000259179'

//$lista_fac="select * from ".$tipocmp_tabla." where ".$tipocmp_campofirmado."=''  and ".$tipocmp_anulado."='0' and doccab_ndocumento like '".$valcentro."%' limit 7";

//$lista_fac="select * from ".$tipocmp_tabla." where ".$tipocmp_campofirmado."=''  and ".$tipocmp_anulado."!='1'  and compretcab_nretencion='001-002-000000868' limit 1 ";

$lista_fac="select * from ".$tipocmp_tabla." where ".$tipocmp_campofirmado."=''  and ".$tipocmp_anulado."!='1' limit 1 ";


echo $lista_fac."<br>";
$resultlist_fac = $DB_gogess->executec($lista_fac);
if($resultlist_fac)
		{
			while (!$resultlist_fac->EOF) {			
			  
			  //$doc['xml']=$_POST["xml"];
			  
			  //$resultlist_fac->fields["usua_id"]
			  $busca_us="select usua_ciruc from app_usuario where usua_id='".$resultlist_fac->fields["usua_id"]."'";
			  $resultlist_us = $DB_gogess->executec($busca_us);
			  
			  $busca_cert="select * from factura_cerficado where usua_ciruc='1711467884'";
			  $result_cert = $DB_gogess->executec($busca_cert);
			  
			  //echo $result_cert->fields["usua_ciruc"];
			 // echo $result_cert->fields["cert_nombre"];
			  //echo $result_cert->fields["cert_clv"];			  
			  $doc['usuario']=$result_cert->fields["usua_ciruc"];
              $doc['clave']=md5($result_cert->fields["cert_clv"]);
			  
			  echo $doc['usuario']."<br>";
			  
			  echo @$resultlist_fac->fields["doccab_ndocumento"]."<br>";
			  
			  
			  $doc['xml']=$resultlist_fac->fields[$tipocmp_sinfirma];			   
              //$cliente = new nusoap_client('http://186.4.218.184/doc_signhumana/server.php?wsdl');
              //$resultado = $cliente->call('SignDoc', array('Documento' =>$doc));	
			  
			  
              $cliente = new nusoap_client('http://186.4.218.184/doc_signalospinos/server.php?wsdl');
              $resultado = $cliente->call('SignDoc', array('Documento' =>$doc));	
			  
			   
			  if($resultado["motivo"])
			   { 
				   echo $resultado["motivo"]."<br>";
			   }
			   else
			   { 
				if($resultado["resultado"]!='')
				 {
				  $actualiza="update ".$tipocmp_tabla." set ".$tipocmp_campoxmlfirmado." ='".$resultado["resultado"]."',".$tipocmp_campofirmado." ='SI' where  ".$tipocmp_campoid."='".$resultlist_fac->fields[$tipocmp_campoid]."'";
		           $ok_firma = $DB_gogess->executec($actualiza,array());				     
				 }				   
			   }	  
			  
			  
			  
			  $resultlist_fac->MoveNext();
			}
		}	
//===============================================================================
}
//firma


$lista_documentos="select * from beko_tipocomprobante where tipocmp_id=5";
$resultlist_ldocumentos = $DB_gogess->executec($lista_documentos);
if($resultlist_ldocumentos)
		{
			while (!$resultlist_ldocumentos->EOF) {	
			
			    $tipocmp_tabla=$resultlist_ldocumentos->fields["tipocmp_tabla"];
				$tipocmp_campofirmado=$resultlist_ldocumentos->fields["tipocmp_campofirmado"];
				$tipocmp_campoxmlfirmado=$resultlist_ldocumentos->fields["tipocmp_campoxmlfirmado"];
				$tipocmp_campoid=$resultlist_ldocumentos->fields["tipocmp_campoid"];
				$tipocmp_sinfirma=$resultlist_ldocumentos->fields["tipocmp_sinfirma"];
				$tipocmp_anulado=$resultlist_ldocumentos->fields["tipocmp_anulado"];
			    firma_documentos($tipocmp_tabla,$tipocmp_campofirmado,$tipocmp_sinfirma,$tipocmp_campoxmlfirmado,$tipocmp_campoid,$valcentro,$tipocmp_anulado,$DB_gogess);
			
			   $resultlist_ldocumentos->MoveNext();
			}
		}	

?>