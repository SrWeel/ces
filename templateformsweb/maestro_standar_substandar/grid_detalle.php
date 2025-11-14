<?php

header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=14000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
?>

<style type="text/css">

<!--

.txt_titulo {

	font-size: 11px;

	font-family: Verdana, Arial, Helvetica, sans-serif;

	font-weight: bold;

	border: 1px solid #666666;			

 }

.txt_txt {

	font-size: 11px;

	font-family: Verdana, Arial, Helvetica, sans-serif;

	border: 1px solid #666666;			

 }

.Estilo1 {font-size: 10px}

-->

</style>

<?php
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





if($_POST["opcion"]==2)

{

  $borra_reg="delete from dns_detalleconsultaexterna where empr_enlace=".$_POST["enlace"]." and detext_id=".$_POST["idgrid"];

 $rs_borra = $DB_gogess->executec($borra_reg,array());



}


if($_POST["opcion"]==1)

{



$sql_inserta="INSERT INTO `dns_detalleconsultaexterna` (conext_enlace,detext_fecha,detext_hora,detext_evolucion,detext_prescripciones,prod_id,detext_fecharegistro ) VALUES ('".$_POST["enlace"]."','".$_POST["fecha_valx"]."', '".$_POST["hora_valx"]."','".$_POST["evol_valx"]."','".$_POST["perscripcion_valx"]."','".$_POST["prod_idx"]."','".date("Y-m-d")."')";

$rs_inserta = $DB_gogess->executec($sql_inserta,array());



}

?>

<div class="table-responsive">

<table class="table table-bordered"  style="max-width: 700px" >

  <tr>

    <td>Eliminar</td>

	<td>Fecha</td>

    <td>Evoluci&oacute;n</td>

    <td>Prescripciones</td>
	<td>Producto</td>

  </tr>

  <?php

    $cuenta=0;

 $lista_servicios="select detext_id,detext_fecha,detext_evolucion,detext_prescripciones,prod_nombre from dns_detalleconsultaexterna inner join  efacsistema_producto on dns_detalleconsultaexterna.prod_id=efacsistema_producto.prod_id where conext_enlace=".$_POST['enlace'];

 $rs_data = $DB_gogess->executec($lista_servicios,array());

 if($rs_data)

 {

	  while (!$rs_data->EOF) {	

	    $cuenta++;

  ?>

  <tr>

    <td onClick="grid_extras('<?php echo $rs_data->fields["conext_enlace"]; ?>','<?php echo $rs_data->fields["detext_id"]; ?>',2)" style="cursor:pointer" ><span class="glyphicon glyphicon-ban-circle"></span></td>

	
	<td><?php echo $rs_data->fields["detext_fecha"]; ?></td>
    <td><?php echo utf8_encode($rs_data->fields["detext_evolucion"]); ?></td>
    <td><?php echo $rs_data->fields["detext_prescripciones"]; ?></td>
	<td><?php echo $rs_data->fields["prod_nombre"]; ?></td>

  </tr>

  <?php

   $rs_data->MoveNext();	   

	  }

  }

  ?>

</table>

<input name="si_capacitacion" type="hidden" id="si_capacitacion" value="<?php echo $cuenta ?>">

</div>

