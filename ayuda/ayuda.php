<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.css_textoayuda {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>
</head>

<body>
<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8'); 
$tiempossss=4444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);

$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles


for($i=0;$i<$numero;$i++){
///
	if ($tags[$i]=='xml')
	{
	///
		if (preg_match('/^[a-z\d_=]{1,200}$/i', $valores[$i])) {
			$$tags[$i]=$valores[$i];
		}
		else
		{
			$$tags[$i]=0;
	    }
	///
	}
///
}


if($_SESSION['ces1313777_sessid_inicio'])
{

$griddata=0;
$valor_total=0;
$valorsiniva_total=0;
$valornograbado=0;
$pathextrap='';

 $director='../';
 include("../cfg/clases.php");
 include("../cfg/declaracion.php");
 


 $idfac=$xml;
 $listaxml="select * from dns_ayuda where ayu_seccion='".$_POST['pVar1']."'";
 $resultlistat = $DB_gogess->executec($listaxml,array());
 
 echo '<p align="center" class="css_textoayuda"><strong>'.utf8_encode($resultlistat->fields["ayu_titulo"]).'</strong></p>';
 
 echo $resultlistat->fields["ayu_texto"];
 
 
}   
?>



</body>
</html>
