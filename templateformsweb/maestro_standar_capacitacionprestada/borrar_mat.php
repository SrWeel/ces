<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
$fecha_hoydia=date("Y-m-d");
$objformulario= new  ValidacionesFormulario();
if($_SESSION['ces1313777_sessid_inicio'])
{


$busca_existe= <<<QUERY
		DELETE  FROM  media_capacitamateria WHERE 	capamat_id='{$_POST["capamat_id"]}'
QUERY;

$rs_busca_pr= $DB_gogess->executec($busca_existe,array());


}
?>