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


				  
	if(@$_POST["xml"])
	{
		$actualiza="update beko_documentocabecera set doccab_xmlfirmado='".$_POST["xml"]."',doccab_firmado='SI' where doccab_id='".$_POST["idfactura"]."'";
		$ok_firma = $DB_gogess->executec($actualiza,array());
				   if($ok_firma)
				   {
				     echo 'Documento firmado con exito...';
				   }
	}
	else
	{
	  echo "Erro de conexi&oacute;n a la firma...";
	
	}
				  

?>