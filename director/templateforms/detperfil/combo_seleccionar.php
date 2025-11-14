<?php
ini_set('display_errors',0);
include("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
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

?>
<?php

//Llamando objetos
$director="../../";

include("../../cfgclases/clases.php");
//Valores globales

$seccion=$_GET["q"];


switch ($seccion) {
    case "menu":        
		include ("listamenu.php");
        break;
    case "boton":
       include ("listaboton.php");
        break;
    case "imenu":        
		include ("listaimenu.php");
        break;
	case "tabla":
       include ("listatabla.php");
        break;	
	case "contenidos":
       include ("listasecc.php");
        break;		
    default:
       echo "";
	   break;
}
								
?>