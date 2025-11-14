<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=444445000;
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

 $borra_reg="delete from faesa_evoluciondetalle where evolu_enlace=".$_POST["enlace"]." and evoludet_id=".$_POST["idgrid"];
 $rs_borra = $DB_gogess->executec($borra_reg,array());

}


if($_POST["opcion"]==1)
{


if($_POST["evoludet_idx"]>0)
{


$actauliza_data="update faesa_evoluciondetalle set evoludet_fecha='".$_POST["evoludet_fechax"]."',evoludet_hora='".$_POST["evoludet_horax"]."',evoludet_notas='".$_POST["evoludet_notasx"]."',evoludet_farmaindica='".$_POST["evoludet_farmaindicax"]."',evoludet_farmaotros='".$_POST["evoludet_farmaotrosx"]."' where evoludet_id=".$_POST["evoludet_idx"];
$rs_actualiza = $DB_gogess->executec($actauliza_data,array());

}
else
{

$sql_inserta="INSERT INTO `faesa_evoluciondetalle` (evolu_enlace,evoludet_fecha,evoludet_hora,evoludet_notas,evoludet_farmaindica,evoludet_farmaotros,usua_id,evoludet_fecharegistro) VALUES ('".$_POST["enlace"]."','".$_POST["evoludet_fechax"]."', '".$_POST["evoludet_horax"]."','".$_POST["evoludet_notasx"]."','".$_POST["evoludet_farmaindicax"]."','".$_POST["evoludet_farmaotrosx"]."','".$_POST["sess_id"]."','".date("Y-m-d H:i:s")."')";
$rs_inserta = $DB_gogess->executec($sql_inserta,array());

}


}
?>
<div class="table-responsive">
<table class="table table-bordered"  style="width:100%" >
  <tr>
    <td>Eliminar</td>
	<td>Editar</td>
	<td>Fecha</td>
    <td>Hora</td>
    <td>Notas de Evoluci&oacute;n</td>
	<td>Farmacoterapia e indicaciones</td>
    <td>Farmacos y otros</td>
	<td>Registra</td>
  </tr>
<?php
if($_POST["sess_id"]==74)
{
$cuenta=0;
$lista_servicios="select evoludet_id,evolu_enlace,evoludet_fecha,evoludet_hora,evoludet_notas,evoludet_farmaindica,evoludet_farmaotros,evoludet_fecharegistro,faesa_evoluciondetalle.usua_id,usua_nombre,usua_apellido from faesa_evoluciondetalle inner join app_usuario on faesa_evoluciondetalle.usua_id=app_usuario.usua_id where evolu_enlace='".$_POST['enlace']."' and (evoludet_fecha>='".$_POST['fechai']."' and evoludet_fecha<='".$_POST['fechaf']."') order by evoludet_fecha desc";

}
else
{


$cuenta=0;
$lista_servicios="select evoludet_id,evolu_enlace,evoludet_fecha,evoludet_hora,evoludet_notas,evoludet_farmaindica,evoludet_farmaotros,evoludet_fecharegistro,faesa_evoluciondetalle.usua_id,usua_nombre,usua_apellido from faesa_evoluciondetalle inner join app_usuario on faesa_evoluciondetalle.usua_id=app_usuario.usua_id where evolu_enlace='".$_POST['enlace']."' and faesa_evoluciondetalle.usua_id=".$_POST["sess_id"]." and (evoludet_fecha>='".$_POST['fechai']."' and evoludet_fecha<='".$_POST['fechaf']."') order by evoludet_fecha desc";

}

 $rs_data = $DB_gogess->executec($lista_servicios,array());
 if($rs_data)
 {

	  while (!$rs_data->EOF) {	
	    $cuenta++;
  ?>
  <tr>
    <td onClick="grid_extras_<?php echo $_POST["fie_id"]; ?>('<?php echo $rs_data->fields["evolu_enlace"]; ?>','<?php echo $rs_data->fields["evoludet_id"]; ?>',2)" style="cursor:pointer" ><span class="glyphicon glyphicon-ban-circle"></span></td>
	
	<td onClick="grid_editar_<?php echo $_POST["fie_id"]; ?>('<?php echo $rs_data->fields["evolu_enlace"]; ?>','<?php echo $rs_data->fields["evoludet_id"]; ?>',2)" style="cursor:pointer" ><span class="glyphicon glyphicon-pencil"></span></td>
	
	<td><?php echo $rs_data->fields["evoludet_fecha"]; ?></td>
    <td><?php echo $rs_data->fields["evoludet_hora"]; ?></td>
    <td><?php echo $rs_data->fields["evoludet_notas"]; ?></td>
	<td><?php echo $rs_data->fields["evoludet_farmaindica"]; ?></td>
	<td><?php echo $rs_data->fields["evoludet_farmaotros"]; ?></td>
    <td><?php echo $rs_data->fields["usua_nombre"]." ".$rs_data->fields["usua_apellido"]; ?></td>
  </tr>
  <?php
   $rs_data->MoveNext();	   
	  }
  }
  ?>
</table>
</div>

<?php
if(!(@$_SESSION['ces1313777_sessid_inicio']))
{

echo 'n
<script type="text/javascript">
<!--
abrir_standar("aplicativos/documental/activar_sesion.php","Activar_Sesi&oacute;n","divBody_acsession'.$_POST["fie_id"].'","divDialog_acsession'.$_POST["fie_id"].'",400,400,"",0,0,0,0,0,0);
//  End -->
</script>n

<div id="divBody_acsession'.$_POST["fie_id"].'"></div>
';

}
?>