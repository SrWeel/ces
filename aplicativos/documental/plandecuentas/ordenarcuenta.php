<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();


$listadiario="select * from lpin_plancuentas order by planc_codigoc asc";
//echo $lista_doc;
$total_haber=0;
$detcc_debe=0;
$id_campo=0;

$rs_listadiario = $DB_gogess->executec($listadiario,array());
$ib=0;
 if($rs_listadiario)
 {
     while (!$rs_listadiario->EOF) {	
	 
	 $numero_array=array();	 
	 $numero_array=explode(".",$rs_listadiario->fields["planc_codigoc"]);
	 
	// print_r($numero_array);
	 
	 for($i=0;$i<count($numero_array);$i++)
	 {
	   $id_campo=0;
	   $id_campo=$i+1;
	   $actualiz_code="update lpin_plancuentas set planc_code".$id_campo."='".$numero_array[$i]."' where planc_id='".$rs_listadiario->fields["planc_id"]."'";
	   $rs_acode = $DB_gogess->executec($actualiz_code,array());
	 
	 }
	 
	 
	 
	 $rs_listadiario->MoveNext();	
	 }
}



//////////////////////////////////////////////////

$listadiario="select * from lpin_plancuentas  order by planc_code1,planc_code2,planc_code3,planc_code4,planc_code5,planc_code6,planc_code7 asc";
//echo $lista_doc;
$total_haber=0;
$detcc_debe=0;
$id_campo=0;

$contador_pla=0;
$rs_listadiario = $DB_gogess->executec($listadiario,array());
$ib=0;
 if($rs_listadiario)
 {
     while (!$rs_listadiario->EOF) {	
	 
	    
		$contador_pla++;
		$actualiz_code="update lpin_plancuentas set planc_orden='".$contador_pla."' where planc_id='".$rs_listadiario->fields["planc_id"]."'";
	    $rs_acode = $DB_gogess->executec($actualiz_code,array());
		
	 
	 
       $rs_listadiario->MoveNext();	
	 }
}
	 
	 


	 

}

?>