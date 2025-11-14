<?php
$tiempossss=4444000000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$firma_docvalor='';
if($_SESSION['ces1313777_sessid_inicio'])
{

$objSriFactura=new sri_facturas();
$objSriFactura->setdoccab_id($_POST["enlace"]);
$objSriFactura->setDataBase($DB_gogess);
$firma_docvalor=$objSriFactura->xml_factura();

}


?>
<textarea name="firm_xmldata" id="firm_xmldata"><?php echo $firma_docvalor; ?></textarea>
