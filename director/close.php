<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Cerrando sistema</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="sisformat.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="3;URL=index.php">
</head>
<body>
<?php
@ini_set("session.gc_maxlifetime","3");
@ini_set("session.cookie_lifetime","3");
@session_start();
foreach($_SESSION as $idprod => $value){
    $_SESSION[$idprod]=NULL;
    #echo $idprod."- $value <br>";
}

session_unset();
session_destroy();

?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p align="center" class="txttitle">Cerrando Sistema... </p>
</body>
</html>
