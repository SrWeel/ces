<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

if($_SESSION['ces1313777_sessid_inicio'])
{

$categesp_id=$_POST["categesp_id"];

$busca_listafiltro="select * from dns_categoriaespecialidad where categesp_id='".$categesp_id."'";
$rs_lisfiltro = $DB_gogess->executec($busca_listafiltro);

$categesp_lista=$rs_lisfiltro->fields["categesp_lista"];

?>
<select name="especipr_id" id="especipr_id" style="width:200px">
      <option value="">--seleccionar--</option>
	  <?php
	    $objformulario->fill_cmb("dns_especialidad","especi_id,especi_nombre",@$especipr_id," where especi_id in (".$categesp_lista.") and especi_paraprecuenta=1 order by especi_nombre asc",$DB_gogess);
	  ?> 
</select>
<?php

}
?>