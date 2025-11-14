<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=440400000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$partop_id=$_POST["partop_id"];

$busca_datos="select * from lpin_parteoperatorio where partop_id='".$partop_id."'";
$rs_bdatos = $DB_gogess->executec($busca_datos,array());

echo "<b>SALA:</b> ".$rs_bdatos->fields["partop_sala"]."<br>";
echo "<b>HORA:</b> ".$rs_bdatos->fields["partop_hora"]."<br>";
echo "<b>PACIENET:</b> ".$rs_bdatos->fields["partop_paciente"]."<br>";
echo "<b>PROCEDIMIENTO:</b> ".$rs_bdatos->fields["partop_procedimiento"]."<br>";
echo "<b>CIRUJANO:</b> ".$rs_bdatos->fields["partop_cirujano"]."<br>";
echo "<b>HAB:</b> ".$rs_bdatos->fields["partop_hab"]."<br>";
echo "<b>T. QUIROFANO:</b> ".$rs_bdatos->fields["partop_tquirofano"]."<br>";



}

?>