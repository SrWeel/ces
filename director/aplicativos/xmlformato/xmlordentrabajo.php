<?
header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="UTF-8"?>';

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
include("../../libreria/formulario.php");
include("../../libreria/dbcc.php");
include("../../cfgclases/config.php");
include("../../libreria/formatoxml.php"); 
//Conexion a la base de datos
  $objBd = new  conecc();
  $objBd->conectardb($basededatos,$host,$userdb,$passwdb);
  $objformulario = new  formulario();
  $link = $objBd->enlace;
  $fechahoy=date("Y-m-d");   
  $objxml=new formatoxml();
?>
<?php
// Creando formato xml

$sqlxml="select * from sli_ordentrabajo";
$tablasxml="sli_ordentrabajo";
$xmlreg="<ordent>-</ordent>";
$xmlfichero="<fichero>-</fichero>";
$objxml->consulatdatos($sqlxml,$tablasxml,$xmlreg,$xmlfichero)
?>