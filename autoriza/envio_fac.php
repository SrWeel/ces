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
 include("lib.php");
 include ("nusoap/lib/nusoap.php");  
 include(@$director."libreria/estructura/aqualis_master.php");
 
 for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
$objformulario= new  ValidacionesFormulario();
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;



$fechahoy=date("Y-m-d");
$fechahoy=date("Y-m-d", strtotime("-15 day"));
//$fechahoy="2017-11-10";
$buscafacturas="select * from beko_documentocabecera where (doccab_estadosri!='RECIBIDA')  and doccab_id='".$_POST["idfactura"]."'";


$rs_gogessform = $DB_gogess->executec($buscafacturas,array());
if($rs_gogessform)
{
     	while (!$rs_gogessform->EOF) {
		
		if($rs_gogessform->fields["doccab_estadosri"]!='RECIBIDA')
		{	
		  echo $rs_gogessform->fields["doccab_estadosri"]."<br>".$rs_gogessform->fields["doccab_motivodev"];
		}
		
        $auto_offline=1;		
		//envia_sri($DB_gogess,'01',$rs_gogessform->fields["doccab_id"]);
		echo "<br>Envia offline".$auto_offline."<br>";
		if($auto_offline==1)
		{
		
		envia_srioffline($DB_gogess,'01',$rs_gogessform->fields["doccab_id"]);
		}
		else
		{
		envia_sri($DB_gogess,'01',$rs_gogessform->fields["doccab_id"]);
		}
		
		
		
		$rs_gogessform->MoveNext();	
		}
}
?>