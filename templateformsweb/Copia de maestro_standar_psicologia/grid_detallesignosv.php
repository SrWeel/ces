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

 $borra_reg="delete from dns_signosvitalesexterna where conext_enlace=".$_POST["enlace"]." and sign_id=".$_POST["idgrid"];
 $rs_borra = $DB_gogess->executec($borra_reg,array());

}


if($_POST["opcion"]==1)
{

$sql_inserta="INSERT INTO `dns_signosvitalesexterna` (conext_enlace,sign_fecha,sign_presionarterial,sign_pulsoxminuto,sign_temperatura,usua_id,sign_fecharegistro) VALUES ('".$_POST["enlace"]."','".$_POST["sign_fechax"]."', '".$_POST["sign_presionarterialx"]."','".$_POST["sign_pulsoxminutox"]."','".$_POST["sign_temperaturax"]."','".$_SESSION['ces1313777_sessid_inicio']."','".date("Y-m-d H:i:s")."')";
$rs_inserta = $DB_gogess->executec($sql_inserta,array());

}

?>

<div class="table-responsive">

<table class="table table-bordered"  style="width:100%" >

  <tr>

    <td>Eliminar</td>

	<td>Fecha</td>

    <td>Presi&oacute;n Arterial</td>

    <td>Pulso x minuto</td>
	<td>Temperatura C</td>

  </tr>

<?php
$cuenta=0;

$lista_servicios="select sign_id,conext_enlace,sign_fecha,sign_presionarterial,sign_pulsoxminuto,sign_temperatura,usua_id,sign_fecharegistro from dns_signosvitalesexterna  where conext_enlace=".$_POST['enlace'];

 $rs_data = $DB_gogess->executec($lista_servicios,array());

 if($rs_data)

 {

	  while (!$rs_data->EOF) {	

	    $cuenta++;

  ?>

  <tr>

    <td onClick="grid_extras_<?php echo $_POST["fie_id"]; ?>('<?php echo $rs_data->fields["conext_enlace"]; ?>','<?php echo $rs_data->fields["sign_id"]; ?>',2)" style="cursor:pointer" ><span class="glyphicon glyphicon-ban-circle"></span></td>

	
	<td><?php echo $rs_data->fields["sign_fecha"]; ?></td>
    <td><?php echo utf8_encode($rs_data->fields["sign_presionarterial"]); ?></td>
    <td><?php echo $rs_data->fields["sign_pulsoxminuto"]; ?></td>
	<td><?php echo $rs_data->fields["sign_temperatura"]; ?></td>

  </tr>

  <?php

   $rs_data->MoveNext();	   

	  }

  }

  ?>

</table>


</div>

