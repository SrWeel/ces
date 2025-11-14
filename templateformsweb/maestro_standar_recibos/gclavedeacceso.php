<?php
$tiempossss=4440000000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

if($_SESSION['ces1313777_sessid_inicio'])
{
$objSriFactura=new sri_facturas();

$objSriFactura->setdoccab_id($_POST["doccab_id"]);
$objSriFactura->setDataBase($DB_gogess);
$clavegenerada=$objSriFactura->genera_claveacceso_rec();

}
?>
<input name="gclaveacceso" type="hidden" id="gclaveacceso" value="<?php echo $clavegenerada; ?>">
