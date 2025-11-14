<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{

$valor_id=$_POST["valor_id"];

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

if($valor_id>0)
{
echo $valor_id."<br>";
$busc_data="select * from beko_mhdetallefactura where mhdetfac_id='".$valor_id."'";
$rs_bdata= $DB_gogess->executec($busc_data);

$moviin_id=$rs_bdata->fields["moviin_id"];

$busca_datos="delete from dns_movimientoinventario where moviin_id='".$moviin_id."'";
$rs_bdatis = $DB_gogess->executec($busca_datos);
}

echo "Procesado";

}

?>