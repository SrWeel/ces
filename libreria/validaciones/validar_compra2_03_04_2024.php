<?php

//include("../../cfgclases/sessiontime.php");
$tiempossss=167000;
ini_set("session.cookie_lifetime",$tiempossss);

ini_set("session.gc_maxlifetime",$tiempossss);

session_start();

?>

<?php

//Llamando objetos
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
//Conexion a la base de datos
$comparativa1=0;
$comparativa2=0;

$proveevar_id=$_POST["proveevar_id"];
$busca_prove="select * from app_proveedor where provee_id='".$proveevar_id."'";
$rs_brpovee= $DB_gogess->executec($busca_prove,array());

$provee_ruc=$rs_brpovee->fields["provee_ruc"];
$provee_cedula=$rs_brpovee->fields["provee_cedula"];

if($provee_ruc=='')
{
  $provee_ruc='SN';
}
if($provee_cedula=='')
{
  $provee_cedula='SN';
}


$comparativa2=1;
if($_POST["idg"]>0)
{



$buscaruc="select compra_id from dns_compras inner join app_proveedor on dns_compras.proveevar_id=app_proveedor.provee_id where (provee_ruc='".$provee_ruc."' or provee_cedula='".$provee_cedula."') and compra_nfactura='".$_REQUEST[$_POST['campo_validar']]."' and compra_id not in (".trim($_POST["idg"]).")";

}
else
{
$buscaruc="select compra_id from dns_compras inner join app_proveedor on dns_compras.proveevar_id=app_proveedor.provee_id where (provee_ruc='".$provee_ruc."' or provee_cedula='".$provee_cedula."') and compra_nfactura='".$_REQUEST[$_POST['campo_validar']]."'";

}
$estado="true";
$rs_gogessform = $DB_gogess->executec($buscaruc,array());
if($rs_gogessform)
{

     	while (!$rs_gogessform->EOF) {
		     $comparativa2=0;
			 $rs_gogessform->MoveNext();  
		}
}

$fp = fopen("ficherobu.txt", "w");
fputs($fp,$buscaruc );
fclose($fp);

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