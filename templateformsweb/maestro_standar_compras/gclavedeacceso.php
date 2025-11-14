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
$clavegenerada=$objSriFactura->genera_claveacceso_lq();

$busca_ccerradaplq="select * from dns_compras where compra_id='".$_POST["doccab_id"]."'";
$rs_ccerradolq = $DB_gogess->executec($busca_ccerradaplq,array());

$compra_nfactura=$rs_ccerradolq->fields["compra_nfactura"];

}
?>
<input name="gclaveacceso" type="hidden" id="gclaveacceso" value="<?php echo $clavegenerada; ?>">
<input name="nsecuenv2" type="hidden" id="nsecuenv2" value="<?php echo @$compra_nfactura; ?>">
