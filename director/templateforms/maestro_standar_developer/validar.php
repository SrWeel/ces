
<?php
include("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director="../../";
include("../../cfgclases/clases.php");

$listatablas="select vardevdet_operation from sth_vddetalle where vardevdet_campo='".$_POST["ingreso"]."'";
$resultlistat = $DB_gogess->Execute($listatablas);


$posicion_coincidencia = strpos($resultlistat->fields["vardevdet_operation"], $_POST["nfield"]);

if (!($posicion_coincidencia === false)) {	
	echo '<input name="valor_validacion" type="hidden" id="valor_validacion" value="1">';
    } 
 else
 {
	 echo '<input name="valor_validacion" type="hidden" id="valor_validacion" value="0">';
 }
?>