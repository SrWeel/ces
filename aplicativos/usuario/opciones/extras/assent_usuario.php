<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director="../../../../";
include ("../../../../cfgclases/clases.php");
?>
<?php
//$listaordencont="select * from ktkwe_menu where parent_id=".$_POST["parent_id"]." order by rgt desc";
//echo $listaordencont;
//$resultnum = $DB_gogess->Execute($listaordencont);	

$creadperfil="INSERT INTO spag_usuarios_perfil (usr_cedula, perusu_codobj, perusu_activo, perusu_maker, perusu_checker, perusu_consulta, perusu_desactivar) VALUES
( '".$_POST["usr_cedula"]."', 14, '1', '1', '', '', ''),
('".$_POST["usr_cedula"]."', 13, '1', '1', '', '', ''),
('".$_POST["usr_cedula"]."', 21, '1', '1', '', '', ''),
( '".$_POST["usr_cedula"]."', 22, '1', '1', '', '', ''),
('".$_POST["usr_cedula"]."', 23, '1', '1', '', '', ''),
('".$_POST["usr_cedula"]."', 24, '1', '1', '', '', '');";

$resultnum = $DB_gogess->Execute($creadperfil);	


$creadperfilclv="INSERT INTO spag_historicoing ( hiing_fecha, hiing_cedula, hiing_ip) VALUES
( '".date("Y-m-d H:i:s")."', '".$_POST["usr_cedula"]."', '127.0.0.1')";

$resultnum = $DB_gogess->Execute($creadperfilclv);	

?>