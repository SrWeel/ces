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
//Conexion a la base de datos
$comparativa1=0;
$comparativa2=0;

if($objvalidacion->validarID($_REQUEST[$_POST['campo_validar']])=='NO')
 {
   $comparativa1=0;  
  }
else
{
  $comparativa1=1;
}

$comparativa2=1;

if(trim($_POST["idg"]))
{
 $buscaruc="select bene_ci from ca_beneficiario where bene_ci='".$_REQUEST[$_POST['campo_validar']]."' bene_id not in(".trim($_POST["idg"]).")";
}
else
{
 $buscaruc="select bene_ci from ca_beneficiario where bene_ci='".$_REQUEST[$_POST['campo_validar']]."'";
}


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