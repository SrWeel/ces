<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
ini_set("session.cookie_lifetime","4");
ini_set("session.gc_maxlifetime","4");
session_start();
$director="../../";
include("../../cfgclases/clases.php");
$actualizacaja="update factur_usuario_caja set fuca_ingreso='',fuca_estadoingreso='' where usr_cedula='".$_SESSION['datafrank_sessid_cedula']."' and emi_id=".$_SESSION['id_cajaval'];
$ac_ok = $DB_gogess->Execute($actualizacaja);


echo 'Cerrando sistema...';
$_SESSION = array();
session_unset();
session_destroy();
 echo '<script type="text/javascript">
		   <!--
			 location.reload(); 
		   //  End -->
       </script>
	   ';

?>