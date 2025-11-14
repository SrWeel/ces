<?php
$tiempossss=444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();



?>

<select name="tari_codigo_val" id="tari_codigo_val"  class="form-control" >
<option value="">-- Tarifa --</option>
<?php
$objformulario->fill_cmb("beko_tarifa","tari_codigo,tari_nombre",$tari_codigo_val," where impu_codigo='".$_POST["impu_codigo_val"]."' order by tari_nombre desc",$DB_gogess);
?>
</select>