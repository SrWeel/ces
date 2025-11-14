<?php
$tiempossss=140000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//echo $_POST["cant_val"]."<br>";
//echo $_POST["produ_id"]."<br>";
//echo $_POST["enlace"]."<br>";
if($_SESSION['ces1313777_sessid_inicio'])
{
$ic=0;

$busca_nivel="select  clie_genero,clie_fechanacimiento from app_cliente where clie_id=".$_POST['clie_id'];
$rs_dcliente = $DB_gogess->executec($busca_nivel,array());

$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],date("Y-m-d"));


echo "<b>Genero: </b>".$rs_dcliente->fields["clie_genero"]." <b>Edad:</b> ".$num_mes["anio"]." a&ntildeos y ".$num_mes["mes"]." meses";

}
?>