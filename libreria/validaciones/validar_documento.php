<?php
@$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

//Llamando objetos
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
include("lib_ruc.php");
$objcedularuc= new ValidarIdentificacion();


//Conexion a la base de datos
$comparativa1=0;
$comparativa2=1;

//$numero = (string)$_REQUEST[$_POST['campo_validar']];
//$numero = (string)$_GET['campo_validar'];
//$numeroc_validar=$_GET['campo_validar'];

$numero = (string)$_REQUEST[$_POST['campo_validar']];
$numeroc_validar=$_REQUEST[$_POST['campo_validar']];

//$fp = fopen('data.txt', 'w');
//fwrite($fp, $_POST["tipoident_codigo"]);
//fclose($fp);

$resultado_val=0;
if(trim($_POST["tipoident_codigo"])=='05')
{ 
	if(strlen($numero)==10)
	{
	
	   $resultado_val=$objcedularuc->validarCedula($numeroc_validar);
	
	}
}

if(trim($_POST["tipoident_codigo"])=='04')
{ 

	if(strlen($numero)==13)
	{
	//-----------------------------------------------
	
		if ($numero[2] >= 0 OR $numero < 6) {                    
						$resultado_val=$objcedularuc->validarRucPersonaNatural($numeroc_validar);
						}
	
		if ($numero[2] == 9) {
					   $resultado_val=$objcedularuc->validarRucSociedadPrivada($numeroc_validar);
					}
	
		 if ($numero[2] == 6) {
					   $resultado_val=$objcedularuc->validarRucSociedadPublica($numeroc_validar);
					}
	//-----------------------------------------------
	}

}


//----------------valida cedula
if($resultado_val)
 {
   $comparativa1=1;  
  }
else
{
  $comparativa1=0;
}
//----------------valida cedula


if(trim($_POST["tipoident_codigo"])=='06' OR trim($_POST["tipoident_codigo"])=='08' OR trim($_POST["tipoident_codigo"])=='09' OR trim($_POST["tipoident_codigo"])=='07')
{
	
	$comparativa1=1;
}


$resultadocp=$comparativa1*$comparativa2;

if($resultadocp)
{
echo 'true';
}
else
{
echo 'false';
}


?>