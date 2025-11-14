<?php
include("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
?>
<?php
//Llamando objetos
$director="../../";
include("../../cfgclases/clases.php");
include("lib_ruc.php");

$objcedularuc= new ValidarIdentificacion();



//Conexion a la base de datos
$comparativa1=0;
$comparativa2=0;



//$numero = (string)$_REQUEST[$_POST['campo_validar']];

//$numero = (string)$_GET['campo_validar'];
//$numeroc_validar=$_GET['campo_validar'];

$numero = (string)$_REQUEST[$_POST['campo_validar']];
$numeroc_validar=$_REQUEST[$_POST['campo_validar']];


if(strlen($numero)==10)
{

   $resultado_val=$objcedularuc->validarCedula($numeroc_validar);

}



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



$comparativa2=1;
$buscaruc="select usr_cedula from factur_empresa where dat_ruc='".$_REQUEST[$_POST['campo_validar']]."'";
$estado="true";
$rs_gogessform = $DB_gogess->Execute($buscaruc);
if($rs_gogessform)
{
     	while (!$rs_gogessform->EOF) {
		     $comparativa2=0;
			 $rs_gogessform->MoveNext();  
		}
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