<?php
$tiempossss=167000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

//Llamando objetos
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
//Conexion a la base de datos
$comparativa1=0;
$comparativa2=0;


if($objvalidacion->validarID($_REQUEST[$_POST['campo_validar']])=='NO')
 {
   $resultadocp=0;  
  }
else
{
  $resultadocp=1;
}

if($_POST["tipoident_codigocl"]=='06' or $_POST["tipoident_codigocl"]=='07' or $_POST["tipoident_codigocl"]=='08' or $_POST["tipoident_codigocl"]=='09')
{
  $resultadocp=1;
}

//$fp = fopen("fichero2.txt", "w");
//fputs($fp, $validacion_data.'->'.$_POST["tipoident_codigocl"].'->'.$_REQUEST[$_POST['campo_validar']]);
//fclose($fp);

if($resultadocp)
{
echo 'true';
}
else
{
echo 'false';
}


?>