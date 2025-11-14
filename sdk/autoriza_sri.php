<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
ini_set('memory_limit', '-1');
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
include("lib.php");
include ("lib/nusoap.php");

include("configcentro.php");

$link_envio="https://cel.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantesOffline?wsdl";
$debug=1;


//envia documento
function envia_documentos($tipocmp_tabla,$tipocmp_campofirmado,$tipocmp_sinfirma,$tipocmp_campoxmlfirmado,$tipocmp_campoid,$tipocmp_estadosri,$tipocmp_motivodev,$tipocmp_codigo,$link_envio,$debug,$valcentro,$DB_gogess)
{
$lista_fac="select * from ".$tipocmp_tabla." where ".$tipocmp_campofirmado."='SI' and (".$tipocmp_estadosri."!='AUTORIZADO' and ".$tipocmp_estadosri." in('RECIBIDA','DEVUELTA')) and doccab_anulado=0 and doccab_ndocumento like '".$valcentro."%' limit 7";
//and doccab_ndocumento='007-001-000258723'
echo $lista_fac."<br>";
//echo $lista_fac."<br>";
echo $tipocmp_codigo."<br>";
$resultlist_fac = $DB_gogess->executec($lista_fac,array());
if($resultlist_fac)
		{
			while (!$resultlist_fac->EOF) {			
			  
			  //$doc['xml']=$_POST["xml"];
			  $documento=$tipocmp_codigo;
			  $id_documento=$resultlist_fac->fields[$tipocmp_campoid];
			  //funcion envia SRI
			  autoriza_sri($DB_gogess,$documento,$id_documento,$link_envio,$debug);
			 		  
			  
			  $resultlist_fac->MoveNext();
			}
		}	
//===============================================================================
}
//envia documento




$lista_documentos="select * from beko_tipocomprobante where tipocmp_activofirma=1";
$resultlist_ldocumentos = $DB_gogess->executec($lista_documentos);
if($resultlist_ldocumentos)
		{
			while (!$resultlist_ldocumentos->EOF) {	
			
			   $tipocmp_tabla=$resultlist_ldocumentos->fields["tipocmp_tabla"];
			   $tipocmp_campofirmado=$resultlist_ldocumentos->fields["tipocmp_campofirmado"];
			   $tipocmp_campoxmlfirmado=$resultlist_ldocumentos->fields["tipocmp_campoxmlfirmado"];
			   $tipocmp_campoid=$resultlist_ldocumentos->fields["tipocmp_campoid"];
			   $tipocmp_sinfirma=$resultlist_ldocumentos->fields["tipocmp_sinfirma"];			   
			   $tipocmp_estadosri=$resultlist_ldocumentos->fields["tipocmp_estadosri"];
			   $tipocmp_motivodev=$resultlist_ldocumentos->fields["tipocmp_motivodev"];
			   
			   $tipocmp_codigo=$resultlist_ldocumentos->fields["tipocmp_codigo"];
			   
			   envia_documentos($tipocmp_tabla,$tipocmp_campofirmado,$tipocmp_sinfirma,$tipocmp_campoxmlfirmado,$tipocmp_campoid,$tipocmp_estadosri,$tipocmp_motivodev,$tipocmp_codigo,$link_envio,$debug,$valcentro,$DB_gogess);
			   
			
			
			   $resultlist_ldocumentos->MoveNext();	
			
			}
		}	

?>