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

 $borra_reg="delete from faesa_diagnosticodifirencial where psic_enlace='".$_POST["enlace"]."' and diagn_id=".$_POST["idgrid"];
 $rs_borra = $DB_gogess->executec($borra_reg,array());

}


if($_POST["opcion"]==1)
{

$sql_inserta="INSERT INTO `faesa_diagnosticodifirencial` (psic_enlace,diagn_cie,diagn_descripcion,diagn_marcador,diagn_observacion,usua_id,diagn_fecharegistro) VALUES ('".$_POST["enlace"]."','".$_POST["diagn_ciex"]."', '".$_POST["diagn_descripcionx"]."','".$_POST["diagn_marcadorx"]."','".$_POST["diagn_observacionx"]."','".$_SESSION['ces1313777_sessid_inicio']."','".date("Y-m-d H:i:s")."')";
$rs_inserta = $DB_gogess->executec($sql_inserta,array());

}

?>

<div class="table-responsive">

<table class="table table-bordered"  style="width:100%" >

  <tr>

    <td>Eliminar</td>
	<td>Fecha</td>
    <td>CIE</td>
    <td>Descripci&oacute;n</td>
	<td>Marcador</td>
    <td>Observaciones</td>
  </tr>

<?php
$cuenta=0;

$lista_servicios="select diagn_id,psic_enlace,diagn_cie,diagn_descripcion,diagn_marcador,diagn_observacion,diagn_fecharegistro from faesa_diagnosticodifirencial  where psic_enlace='".$_POST['enlace']."'";

 $rs_data = $DB_gogess->executec($lista_servicios,array());

 if($rs_data)

 {

	  while (!$rs_data->EOF) {	

	    $cuenta++;

  ?>

  <tr>

    <td onClick="grid_extras_<?php echo $_POST["fie_id"]; ?>('<?php echo $rs_data->fields["psic_enlace"]; ?>','<?php echo $rs_data->fields["diagn_id"]; ?>',2)" style="cursor:pointer" ><span class="glyphicon glyphicon-ban-circle"></span></td>

	
	<td><?php echo $rs_data->fields["diagn_cie"]; ?></td>
    <td><?php echo $rs_data->fields["diagn_descripcion"]; ?></td>
    <td><?php echo $rs_data->fields["diagn_marcador"]; ?></td>
	<td><?php echo $rs_data->fields["diagn_observacion"]; ?></td>
	<td><?php echo $rs_data->fields["diagn_fecharegistro"]; ?></td>

  </tr>

  <?php

   $rs_data->MoveNext();	   

	  }

  }

  ?>

</table>


</div>

