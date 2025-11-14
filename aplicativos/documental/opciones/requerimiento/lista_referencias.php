<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=14000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");

include(@$director."libreria/estructura/aqualis_master.php");
for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
 if (@$table)
  {
  $objtableform->select_templateform(@$table,$DB_gogess);	
  }
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
?>
<div class="table-responsive">
<table class="table table-bordered" >
  <tr>
    <td>Nombre</td>
    <td>Ciudad</td>
	 <td>Tel&eacute;fono</td>
  </tr>
  <?php
    $cuenta=0;
  $lista_servicios="select refe_id,usua_id,refe_nombre,refe_ciudad,refe_telefono from app_referencia  where usua_id=".$_POST["usuaidp"];
 $rs_data = $DB_gogess->executec($lista_servicios,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	    $cuenta++;
  ?>
  <tr>
   <td><?php echo utf8_encode($rs_data->fields["refe_nombre"]); ?></td>
    <td><?php echo $rs_data->fields["refe_ciudad"]; ?></td>
	<td><?php echo $rs_data->fields["refe_telefono"]; ?></td>
  </tr>
  <?php
   $rs_data->MoveNext();	   
	  }
  }
  ?>
</table>
<input name="si_referencia" type="hidden" id="si_referencia" value="<?php echo $cuenta ?>">
</div>