<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=140000;
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

  $borra_reg="delete from dns_horarioevaluacion where atenc_enlace='".$_POST["enlace"]."' and horaeva_id=".$_POST["idgrid"];

 $rs_borra = $DB_gogess->executec($borra_reg,array());



}


if($_POST["opcion"]==1)
{



$sql_inserta="INSERT INTO `dns_horarioevaluacion` (horaeva_fecha,horaeva_horai,horaeva_horaf,horaeva_area,horaeva_proceso,horaeva_fecharegistro,atenc_enlace,usua_id ) VALUES ('".$_POST["horaeva_fechax"]."','".str_replace(' ', '',$_POST["horaeva_horaix"])."', '".str_replace(' ', '',$_POST["horaeva_horafx"])."','".$_POST["horaeva_areax"]."','".$_POST["horaeva_procesox"]."','".date("Y-m-d")."','".$_POST["enlace"]."','".$_SESSION['ces1313777_sessid_inicio']."')";

$rs_inserta = $DB_gogess->executec($sql_inserta,array());



}

?>

<div class="table-responsive">

<table class="table table-bordered"  style="width:100%" >

  <tr>

    <td>Eliminar</td>
	<td>Fecha</td>
	<td>Hora Inicio</td>
	<td>Hora Fin</td>
    <td>Area</td>
	<td>Proceso</td>
  </tr>

  <?php

    $cuenta=0;

 $lista_servicios="select * from dns_horarioevaluacion where atenc_enlace='".$_POST['enlace']."'";

 $rs_data = $DB_gogess->executec($lista_servicios,array());

 if($rs_data)

 {

	  while (!$rs_data->EOF) {	

	    $cuenta++;

  ?>

  <tr>

    <td onClick="grid_extras_<?php echo $_POST["fie_id"]; ?>('<?php echo $rs_data->fields["atenc_enlace"]; ?>','<?php echo $rs_data->fields["horaeva_id"]; ?>',2)" style="cursor:pointer" ><span class="glyphicon glyphicon-ban-circle"></span></td>

	
	<td><?php echo $rs_data->fields["horaeva_fecha"]; ?></td>
	<td><?php echo $rs_data->fields["horaeva_horai"]; ?></td>
	<td><?php echo $rs_data->fields["horaeva_horaf"]; ?></td>
	<td><?php echo utf8_encode($rs_data->fields["horaeva_area"]); ?></td>
    <td><?php echo utf8_encode($rs_data->fields["horaeva_proceso"]); ?></td>
    
  </tr>

  <?php

   $rs_data->MoveNext();	   

	  }

  }

  ?>

</table>

<input name="si_capacitacion" type="hidden" id="si_capacitacion" value="<?php echo $cuenta ?>">

</div>

<div id='divBody_calendario' ></div>
