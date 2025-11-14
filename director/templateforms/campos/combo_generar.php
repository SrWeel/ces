<?php
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

//Conexion a la base de datos
  $objBd = new  conecc();
  $objBd->conectardb($basededatos,$host,$userdb,$passwdb);
  $objformulario = new  formulario();
  $link = $objBd->enlace;
//Valores globales

$opcion=$_GET["q"];
$tabla=trim($_GET["q1"]);
$campos=trim($_GET["q2"]);

$listacampo=split(',',$campos);
if($opcion==0)
{

$cratabla='CREATE TABLE `'.$tabla.'` (
`'.$listacampo[0].'` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`'.$listacampo[1].'` VARCHAR( 250 ) NOT NULL
) ';



 $resultado = mysql_query($cratabla);

}

echo 'Proceso terminado...';
?>