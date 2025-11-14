<style type="text/css">
<!--
.style5 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; color: #000000; }
.style6 {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.favstl1 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; color: #990000; }
.favstl2 {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.favstl3 {
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
	border: thin solid #FFFFFF;
	color: #000000;
	background-color: #FFFFFF;
}
-->
</style>
<?
/***VARIABLES POR GET ***/

$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
for($i=0;$i<$numero;$i++){
$$tags[$i]=$valores[$i];
}

/***VARIABLES POR POST ***/

$numero2 = count($_POST);
$tags2 = array_keys($_POST); // obtiene los nombres de las varibles
$valores2 = array_values($_POST);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
for($i=0;$i<$numero2;$i++){ 
$$tags2[$i]=$valores2[$i]; 
}



//Llamando objetos
include("../../libreria/formulario.php");
include("../../libreria/dbcc.php");
include("../../cfgclases/config.php");
include("../../libreria/acces.php");
include("../../libreria/session.php");

//Sesiones
  $objacceso_system = new  acceso_system();
  $objacceso_session = new  session_system(); 
//Conexion a la base de datos
  $objBd = new  conecc();
  $objBd->conectardb($basededatos,$host,$userdb,$passwdb);
  $objformulario = new  formulario();
  $link = $objBd->enlace;

$q=$_GET["q"];
$q1=$_GET["q1"];
$q2=$_GET["q2"];
$q3=$_GET["q3"];
$q4=$_GET["q4"];
?>

<?php
if ($q2==3)
{

include("ingreso.php");

}
?>
