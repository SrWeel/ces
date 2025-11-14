<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../../';
include("../../../../../../cfg/clases.php");
include("../../../../../../cfg/declaracion.php");
$sqltotal="";
$objformulario= new  ValidacionesFormulario();

$cuadrobm_id=$_POST["cuadrobm_id"];
$cantidad_val=$_POST["cantidad_val"];
$egrec_id=$_POST["egrec_id"];

$busca_lote="select * from dns_movimientoinventario where cuadrobm_id='".$cuadrobm_id."' and tipom_id=1 and tipomov_id=6 order by moviin_id asc";
$rs_blote = $DB_gogess->executec($busca_lote);

$moviin_id=$rs_blote->fields["moviin_id"];
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$tempdsp_fecharegistro=date("Y-m-d H:i:s");

$inserta_despacho="insert into dns_invtemporaldespacho (egrec_id,cuadrobm_id,cantidad_val,usua_id,tempdsp_fecharegistro,moviin_id) values ('".$egrec_id."','".$cuadrobm_id."','".$cantidad_val."','".$usua_id."','".$tempdsp_fecharegistro."','".$moviin_id."')";

$rs_despacho = $DB_gogess->executec($inserta_despacho);



}
?>
