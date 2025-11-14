<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
include("lib.php");

$objformulario= new  ValidacionesFormulario();

if(@$_SESSION['ces1313777_sessid_inicio'])
{


if($_POST["compra_enlace"])
{

$busca_guardado="select * from dns_compras where compra_enlace='".$_POST["compra_enlace"]."'";
$rs_guardado= $DB_gogess->executec($busca_guardado,array());
$compra_nfactura=$rs_guardado->fields["compra_nfactura"];
$compra_autorizacion=$rs_guardado->fields["compra_autorizacion"];
$compra_id=$rs_guardado->fields["compra_id"];

$detalle='';
$detalle="Usted ha guardado este documento con codigo: ".$compra_id." # de Documento ".$compra_nfactura;

if($compra_id>0)
{
   
echo "<br><span style='color:#009900'>Usted ha guardado este documento con codigo: <b>".$compra_id."</b> # de Documento <b>".$compra_nfactura."</b> <br> con autorizacion: <b>".$compra_autorizacion."</b> en la base de datos, es correcto eso? si no lo es  porfavor informar al administrador.</span>";

}
else
{

 echo "<br><span style='color:#FF0000'>Al momento hay un problema con el internet por favor informe al administrador no salga de esta pantalla...</span>";
 
}



}
else
{

echo "<br><span style='color:#FF0000'>Al momento hay un problema con el internet por favor informe al administrador no salga de esta pantalla</span>";

}


}
else
{
 
 echo "<br><span style='color:#FF0000'>Al momento no tiene una sesion activa por favor abra una pantalla paralela e ingrese el usario y clave</span>";

}

$sql_1=' Codigo intento:'.$_POST["compra_enlace"]." -> ".$detalle;

$file = fopen("log/e_envioguardado".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
fwrite($file,$_SESSION['ces1313777_sessid_inicio']."-->".$sql_1."-->".date("Y-m-d H:i:s"). PHP_EOL);
fclose($file);
?>
