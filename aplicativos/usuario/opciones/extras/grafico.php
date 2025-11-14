<?php
ini_set("session.gc_maxlifetime","14400");
session_start();
$val=microtime();
echo '<img src="aplications/usuario/opciones/extras/captcha.php?v='.$val.'"/>';
?>