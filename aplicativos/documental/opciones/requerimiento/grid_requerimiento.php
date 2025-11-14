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
 $borra_reg="delete from app_requerimiento where requ_id=".$_POST["idgrid"];
 $rs_borra = $DB_gogess->executec($borra_reg,array());

}

if($_POST["opcion"]==1)
{

$sql_inserta="INSERT INTO `app_requerimiento` (`usua_id`, `catag_id`, `requ_observacion`, `requ_estado`) VALUES ('".$_POST["enlace"]."','".$_POST["categoria_val"]."', '".$_POST["observacion_val"]."', 1)";
$rs_inserta = $DB_gogess->executec($sql_inserta,array());

}
?>.

<div class="table-responsive">
<table class="table table-bordered" >
  <tr>
    <td>Eliminar</td>
	<td>Manos levantadas</td>
    <td>Categor&iacute;a</td>
    <td>Experiencia</td>
	
  </tr>
  <?php
   $cuenta=0;
  $lista_servicios="select requ_id,usua_id,app_requerimiento.catag_id,catag_nombre,requ_observacion from app_requerimiento inner join  app_catalogo on app_requerimiento.catag_id=app_catalogo.catag_id where usua_id=".$_POST['enlace']." order by requ_id desc";
 $rs_data = $DB_gogess->executec($lista_servicios,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  $cuenta++;
	  
	  $busca_manos="select count(1) as total from app_manolevantada where requ_id=".$rs_data->fields["requ_id"];
	$rs_manos = $DB_gogess->executec($busca_manos,array());
	$link_vermano='';
	if($rs_manos->fields["total"]>0)
	{
	  $borra_btn="alerta_borrado()";
	  $link_vermano="onClick=lista_manos('".$rs_data->fields["requ_id"]."') style='cursor:pointer' ";
	}
	else
	{
	  
	  $borra_btn="grid_requerimiento('".$rs_data->fields["requ_id"]."',2)";
	  
	  $link_vermano="";
	}
	
	
  ?>
  <tr>
    <td onClick="<?php echo $borra_btn; ?>" style="cursor:pointer" ><span class="glyphicon glyphicon-ban-circle"></span></td>
    <td  <?php echo $link_vermano; ?> ><?php 
	
	if($rs_manos->fields["total"]>0)
	{
	  echo '<img src="images/mlevantada.png"> '.$rs_manos->fields["total"];
	}
	 ?></td>
	<td><?php echo utf8_encode($rs_data->fields["catag_nombre"]); ?></td>
    <td><?php echo $rs_data->fields["requ_observacion"]; ?></td>
	
  </tr>
  <?php
   $rs_data->MoveNext();	   
	  }
  }
  ?>
</table>
</div>
