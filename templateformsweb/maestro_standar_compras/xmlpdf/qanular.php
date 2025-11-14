<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=45544000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");


//echo $_POST["compretcab_id"];

//echo $_POST["motivo_an"];

if(@$_POST["compretcab_id"])
{
$anula_data="update comprobante_retencion_cab set compretcab_anulado=0,compretcab_fechaanulado='".date("Y-m-d")."',compretcab_motivoanulado='".$_POST["motivo_an"]."',compretcab_usuarioanula='".@$_SESSION['ces1313777_sessid_inicio']."' where compretcab_id='".$_POST["compretcab_id"]."';";

$rs_anula = $DB_gogess->executec($anula_data,array());
if($rs_anula)
{
echo 'Sin Anular';
}
}

?>