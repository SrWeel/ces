<?php
$tiempossss=1589000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
?>
<?php
//Llamando objetos
$director="../../";
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
//Conexion a la base de datos
$comparativa2=1;

//$numero = (string)$_REQUEST[$_POST['campo_validar']];

//$numero = (string)$_GET['campo_validar'];
//$numeroc_validar=$_GET['campo_validar'];

if(trim($_POST["idg"]))
{
 $buscaruc="select usua_ciruc from app_usuario where usua_ciruc='".$_REQUEST[$_POST['campo_validar']]."' and usua_id not in(".trim($_POST["idg"]).")";
}
else
{
 $buscaruc="select usua_ciruc from app_usuario where usua_ciruc='".$_REQUEST[$_POST['campo_validar']]."'";
}



$estado="true";
$nombreu='';
$rs_gogessform = $DB_gogess->executec($buscaruc,array());
if($rs_gogessform)
{
     	while (!$rs_gogessform->EOF) {
		     $comparativa2=0;
			 $nombreu=$rs_gogessform->fields["usua_ciruc"];
			 $rs_gogessform->MoveNext();  
		}
}


/*$fp = fopen("fichero.txt", "w");
fputs($fp, $nombreu.$buscaruc);
fclose($fp);*/

$resultadocp=$comparativa2;

if($resultadocp)
{
echo 'true';
}
else
{
echo 'false';
}
?>