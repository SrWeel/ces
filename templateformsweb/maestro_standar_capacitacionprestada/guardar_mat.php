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
		SELECT 	mate_id  FROM media_capacitamateria WHERE media_capacitamateria.capapr_code='{$_POST["codigo"]}' and media_capacitamateria.mate_id='{$_POST["select_mat"]}' 
QUERY;

$rs_busca_pr= $DB_gogess->executec($busca_existe,array());

if(!($rs_busca_pr->fields["mate_id"]))
{
$sql_inserta = <<<QUERY
		INSERT INTO media_capacitamateria (capapr_code,mate_id,capamat_fecha) VALUES ('{$_POST["codigo"]}','{$_POST["select_mat"]}','{$fecha_hoydia}');
QUERY;
$rs_OKINS = $DB_gogess->executec($sql_inserta,array());
}
else
{
echo "Materia ya fue asignada a esta dependencia...";
}



}
?>