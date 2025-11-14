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
 $borra_reg="delete from app_servicios where serv_id=".$_POST["idgrid"];
 $rs_borra = $DB_gogess->executec($borra_reg,array());

}

if($_POST["opcion"]==1)
{
$busca_serv="select catag_id from app_servicios where catag_id=".$_POST["categoria_val"]." and usua_id=".$_POST["enlace"];
$rs_bserv = $DB_gogess->executec($busca_serv,array());
if(@$rs_bserv->fields["catag_id"])
{
 echo "<center>Esta carego&iacute;a ya esta agregada en la lista</center>";
}
else
{
$sql_inserta="INSERT INTO `app_servicios` (`usua_id`, `catag_id`, `serv_obeservacion`, `serv_activo`) VALUES ('".$_POST["enlace"]."','".$_POST["categoria_val"]."', '".$_POST["experiencia_val"]."', 1)";
$rs_inserta = $DB_gogess->executec($sql_inserta,array());
}
}
?>
<div class="table-responsive">
<table class="table table-bordered" >
  <tr>
    <td>Eliminar</td>
    <td>Categor&iacute;a</td>
    <td>Experiencia</td>
  </tr>
  <?php
   $cuenta=0;
  $lista_servicios="select serv_id,usua_id,app_servicios.catag_id,catag_nombre,serv_obeservacion from app_servicios inner join  app_catalogo on app_servicios.catag_id=app_catalogo.catag_id where usua_id=".$_POST['enlace'];
 $rs_data = $DB_gogess->executec($lista_servicios,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  $cuenta++;
  ?>
  <tr>
    <td onClick="grid_factura('<?php echo $rs_data->fields["serv_id"]; ?>',2)" style="cursor:pointer" ><span class="glyphicon glyphicon-ban-circle"></span></td>
    <td><?php echo utf8_encode($rs_data->fields["catag_nombre"]); ?></td>
    <td><?php echo $rs_data->fields["serv_obeservacion"]; ?></td>
  </tr>
  <?php
   $rs_data->MoveNext();	   
	  }
  }
  ?>
</table>

<input name="si_oficio" type="hidden" id="si_oficio" value="<?php echo $cuenta ?>">

</div>
