<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$valor_enlace='';
$tabla_gridvalor="faesa_griddesarrollofisicoo";
$campo_id='desafisico_id';
$campo_enlace='ocupacio_enlace';
$campo_fecharegistro='desafisico_fecharegistro';
$campo_usuarioregistra='usua_id';
$campos_data=array('escdesafisico_nombre','desafisico_descripcion','desafisico_resultado','desafisico_fecharegistro');
$campos_name=array('&Aacute;rea','Descripci&oacute;n','Resultado','Fecha registro');

$tabla_combo1="faesa_areadesafisico";
$tabla_enlacecombo1="escdesafisico_id";

$sqlcampos='';
for($i=0;$i<count($campos_data);$i++)
	 {
	     $sqlcampos=$sqlcampos.",".$campos_data[$i];
	 }
$sqlcampos=substr($sqlcampos,1);

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
$fie_title=$_POST["fie_title"];
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

$cuenta=0;
if($tabla_combo1)
{
$lista_servicios="select ".$campo_id.",".$campo_enlace.",".$sqlcampos." from ".$tabla_gridvalor." inner join ".$tabla_combo1." on ".$tabla_gridvalor.".".$tabla_enlacecombo1."=".$tabla_combo1.".".$tabla_enlacecombo1." where ".$campo_enlace."='".$_POST['enlace']."'";
}
else
{
$lista_servicios="select ".$campo_id.",".$campo_enlace.",".$sqlcampos." from ".$tabla_gridvalor." where ".$campo_enlace."='".$_POST['enlace']."'";

}

$rs_data = $DB_gogess->executec($lista_servicios,array());

if($rs_data->fields[$campo_id]>0)
{
 echo "<br><b>".$fie_title."</b><br><br>";
?>

<div class="table-responsive">
<table class="table table-bordered"  style="width:100%" border="1" cellpadding="0" cellspacing="0" >
  <tr>
	<?php
	for($i=0;$i<count($campos_name);$i++)
	 {
		 echo '<td><b>'.$campos_name[$i].'</b></td>';

	 }
	?>
  </tr>
<?php

if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	    $cuenta++;

  ?>

  <tr>
	<?php
	for($i=0;$i<count($campos_data);$i++)
	 {
		 echo '<td>'.str_replace(".",".<br>",$rs_data->fields[$campos_data[$i]]).'</td>';
	 }
	?>
  </tr>
  <?php
   $rs_data->MoveNext();	   
	  }
  }
  ?>
</table>
</div>
<?php
}
?>