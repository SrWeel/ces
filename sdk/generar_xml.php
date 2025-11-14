<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=4444000000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");

$firma_docvalor='';
if($_SESSION['ces1313777_sessid_inicio'])
{

$objSriFactura=new sri_facturas();

//regenera xml
$lista_fact="select * from beko_documentocabecera where doccab_fechaemision_cliente like '2021-05-04%'";
$rs_buscaid = $DB_gogess->executec($lista_fact,array()); 
				  if($rs_buscaid)
				  {
				      while (!$rs_buscaid->EOF) {
					  
					  $doccab_id=$rs_buscaid->fields["doccab_id"];
					  
$objSriFactura->setdoccab_id($doccab_id);
$objSriFactura->setDataBase($DB_gogess);
$firma_docvalor=$objSriFactura->xml_factura();
                         
						 
						 $rs_buscaid->MoveNext();
                       }
				 }	    

//regenera xml

}


?>