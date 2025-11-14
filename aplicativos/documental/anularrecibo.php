<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=45544000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");


//echo $_POST["doccab_id"];

//echo $_POST["motivo_an"];

if(@$_POST["doccab_id"])
{
$anula_data="update beko_recibocabecera set doccab_anulado=1,doccab_fechaanulado='".date("Y-m-d")."',doccab_motivoanulado='".$_POST["motivo_an"]."',doccab_usuarioanula='".@$_SESSION['ces1313777_sessid_inicio']."' where doccab_id='".$_POST["doccab_id"]."';";

$rs_anula = $DB_gogess->executec($anula_data,array());
if($rs_anula)
{
echo 'Documento Anulado';
}
}

?>