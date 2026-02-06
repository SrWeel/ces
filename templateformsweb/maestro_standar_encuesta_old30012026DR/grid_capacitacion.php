 <?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
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
  $borra_reg="delete from app_gustos where gust_id=".$_POST["idgrid"];
 $rs_borra = $DB_gogess->executec($borra_reg,array());

}

if($_POST["opcion"]==1)
{

$sql_inserta="INSERT INTO `app_gustos` (`clie_token`, `tipog_id`, `gust_observacion`) VALUES ('".$_POST["enlace"]."','".$_POST["tipoc_val"]."', '".$_POST["descripcion_val"]."')";
$rs_inserta = $DB_gogess->executec($sql_inserta,array());

}
?>
<div class="table-responsive">
<table class="table table-bordered"   style="max-width: 600px"   >
  <tr>
    <td>Eliminar</td>
    <td>Catego&iacute;</td>
    <td>Descripci&oacute;n</td>
	 <td>Archivo</td>
  </tr>
  <?php
    $cuenta=0;
  $lista_servicios="select gust_id,clie_token,app_gustos.tipog_id,tipog_nombre,gust_observacion from app_gustos inner join app_tipogustos on app_gustos.tipog_id=app_tipogustos.tipog_id  where clie_token=".$_POST['enlace'];
 $rs_data = $DB_gogess->executec($lista_servicios,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	    $cuenta++;
  ?>
  <tr>
    <td onClick="grid_capacitacion('<?php echo $rs_data->fields["gust_id"]; ?>',2)" style="cursor:pointer" ><span class="glyphicon glyphicon-ban-circle"></span></td>
    <td><?php echo utf8_encode($rs_data->fields["tipog_nombre"]); ?></td>
    <td><?php echo $rs_data->fields["gust_observacion"]; ?></td>
	
  </tr>
  <?php
   $rs_data->MoveNext();	   
	  }
  }
  ?>
</table>
<input name="si_capacitacion" type="hidden" id="si_capacitacion" value="<?php echo $cuenta ?>">
</div>
