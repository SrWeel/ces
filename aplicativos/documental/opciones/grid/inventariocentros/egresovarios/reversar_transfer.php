<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444500000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['ces1313777_sessid_inicio'])
{
$egrec_id=$_POST["egrec_id"];
$director='../../../../../../';
include("../../../../../../cfg/clases.php");
include("../../../../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

$procesado_data="update dns_invegresosvarios set egrec_procesado='0',egrec_fechaprocesa='".date("Y-m-d H:i:s")."',usuapr_id='".$_SESSION['ces1313777_sessid_inicio']."' where egrec_id='".$egrec_id."';";
$rs_pd = $DB_gogess->executec($procesado_data);


$busca_lista="select tempdsp_id from dns_invtemporaldespacho where egrec_id='".$egrec_id."'";

//echo $trasfiere_data="delete from dns_movimientoinventario where tempdspcent_id in (".$busca_lista.");";

$trasfiere_data="delete from dns_movimientoinventario where egrecentrecentro_id='".$egrec_id."'";

$rs_listaprocesa = $DB_gogess->executec($trasfiere_data);


}


?>