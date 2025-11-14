<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444500000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['ces1313777_sessid_inicio'])
{
$compra_id=$_POST["compra_id"];
$director='../../../../../../';
include("../../../../../../cfg/clases.php");
include("../../../../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

$procesado_data="update dns_compras set compra_procesado='0',compra_fechaprocesado='".date("Y-m-d H:i:s")."',compra_usprocesa='".$_SESSION['ces1313777_sessid_inicio']."' where compra_id='".$compra_id."';";
$rs_pd = $DB_gogess->executec($procesado_data);


$trasfiere_data="delete from dns_principalmovimientoinventario where compra_id='".$compra_id."';";


$rs_listaprocesa = $DB_gogess->executec($trasfiere_data);


}


?>