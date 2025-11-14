<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$insert_log="insert into faesa_terapiasregistrolog (terap_idlog, atenc_hc, especi_id, usua_id, clie_id, terap_fecha, terap_hora, terap_autorizacion, terap_estado, terap_fechapago, terap_nfactura, centro_id, usuar_id, terap_fecharegistro,terap_fechacambio,terap_recuperacion,terap_observacion) select terap_id, atenc_hc, especi_id, usua_id, clie_id, terap_fecha, terap_hora, terap_autorizacion, terap_estado, terap_fechapago, terap_nfactura, centro_id, usuar_id, terap_fecharegistro,'".date("Y-m-d H:i:s")."' as terap_fechacambio,terap_recuperacion,terap_observacion from faesa_terapiasregistro where terap_id=".$_POST["terap_id"];
$rs_log = $DB_gogess->executec($insert_log,array());




$actualiza="update faesa_terapiasregistro set usua_id='".$_POST["usua_idvalcambio"]."',especi_id='".$_POST["especi_idcambio"]."',terap_fecha='".$_POST["terap_fechax"]."', terap_hora='".$_POST["hora_tiempox"]."',terap_recuperacion='".$_POST["terap_recuperacion"]."',terap_observacion='".$_POST["terap_observacion"]."' where terap_id=".$_POST["terap_id"];
$rs_act = $DB_gogess->executec($actualiza,array());

if($rs_act)
{
echo "Actualizado";
echo '<script type="text/javascript">
<!--
ver_calendario_general();
//  End -->
</script>';

}
else
{
echo "Horario ya usado verifique por favor....";


}
}

?>	  