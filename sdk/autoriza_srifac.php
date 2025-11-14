<?php
ini_set('display_errors',1);
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

$doccab_id=$_POST["doccab_id"];

//include("configcentro.php");

$link_envio="https://cel.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantesOffline?wsdl";
$debug=1;


//envia documento
function envia_documentos($tipocmp_tabla,$tipocmp_campofirmado,$tipocmp_sinfirma,$tipocmp_campoxmlfirmado,$tipocmp_campoid,$tipocmp_estadosri,$tipocmp_motivodev,$tipocmp_codigo,$link_envio,$debug,$valcentro,$tipocmp_campofecha,$doccab_id,$DB_gogess)
{

$fechah = date('Y-m-d');
$nuevaFechah = date("Y-m-d",strtotime ( '-1 day' , strtotime ( $fechah ) ) );


$lista_fac="select * from ".$tipocmp_tabla." where ".$tipocmp_campofirmado."='SI' and (".$tipocmp_estadosri."!='AUTORIZADO' and ".$tipocmp_estadosri."!='NO AUTORIZADO' and ".$tipocmp_estadosri." in('RECIBIDA'))  limit 1";

$lista_fac="select * from ".$tipocmp_tabla." where ".$tipocmp_campofirmado."='SI' and doccab_id='".$doccab_id."'  limit 1";

//and doccab_ndocumento='015-001-000079890' 
//$lista_fac="select * from ".$tipocmp_tabla." where ".$tipocmp_campofirmado."='SI' and (".$tipocmp_estadosri."!='AUTORIZADO' and ".$tipocmp_estadosri."!='NO AUTORIZADO' and ".$tipocmp_estadosri." in('RECIBIDA')) and doccab_anulado=0 and DATE_FORMAT(".$tipocmp_campofecha.", '%Y-%m-%d')<='".$nuevaFechah."'  and doccab_ndocumento='006-001-000195953' limit 1";
//and doccab_ndocumento='008-002-000041916'
//echo $lista_fac."<br>";
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
			 		
			  // echo '<meta http-equiv="Refresh" content="2" />';			  
			  
			  $resultlist_fac->MoveNext();
			}
		}	
//===============================================================================
}
//envia documento


//verfica el tipo de documento
$busca_tipox="select * from beko_documentocabecera where doccab_id='".$doccab_id."'";
$resultlist_butipox = $DB_gogess->executec($busca_tipox);
$tipocmp_codigo=$resultlist_butipox->fields["tipocmp_codigo"];
//verfica el tipo de documento
if($tipocmp_codigo=='01')
{
$lista_documentos="select * from beko_tipocomprobante where tipocmp_id=1";
}

if($tipocmp_codigo=='04')
{
$lista_documentos="select * from beko_tipocomprobante where tipocmp_id=2";
}

//echo $lista_documentos;

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
			   
			   @$tipocmp_campofecha=$resultlist_ldocumentos->fields["tipocmp_campofecha"];
			   
envia_documentos($tipocmp_tabla,$tipocmp_campofirmado,$tipocmp_sinfirma,$tipocmp_campoxmlfirmado,$tipocmp_campoid,$tipocmp_estadosri,$tipocmp_motivodev,$tipocmp_codigo,$link_envio,$debug,@$valcentro,$tipocmp_campofecha,$doccab_id,$DB_gogess);
			   
			
			
			   $resultlist_ldocumentos->MoveNext();	
			
			}
		}	

?>