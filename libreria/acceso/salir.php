<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();

echo 'Cerrando sistema...';
$_SESSION = array();
session_unset();
session_destroy();
 echo '<script type="text/javascript">
		   <!--
			 location.reload(); 
			// window.location.href = "../portal/index.php";
		   //  End -->
       </script>
	   ';

?>