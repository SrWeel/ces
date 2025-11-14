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
$alerta=0;

if(@$_SESSION['ces1313777_sessid_inicio'])
{

$proveevar_id=$_POST["proveevar_id"];
$tipdoc_id=$_POST["tipdoc_id"];

if($tipdoc_id=='1' or $tipdoc_id=='2' or $tipdoc_id=='8' or $tipdoc_id=='9')
{
$busca_ruc="select * from app_proveedor where provee_id='".$_POST["proveevar_id"]."'";
$rs_ruc= $DB_gogess->executec($busca_ruc,array());

if($rs_ruc->fields["tipoident_codigocl"]!='04')
{
    $alerta=1;
}

}

if($alerta==1)
{
?>
<script type="text/javascript">
<!--

alert("Proveedor debe tener ruc para este documento...");


//  End -->
</script>
Proveedor debe tener ruc para este documento...
<?php
}




}
?>
