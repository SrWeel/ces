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
$tabla_gridvalor="dns_anamnesisfamiliarclinica";
$campo_id='anamf_id';
$campo_enlace='anamn_enlace';
$campo_fecharegistro='anamf_fecharegistro';
$campo_usuarioregistra='usua_id';
$campos_data=array('anamf_nombre','anamf_profesion','anamf_parentesco','anamf_observacion','anamf_edad');
$campos_name=array('Nombre','Profesi&oacute;n','Parentesco','Observacion','Edad');



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


if($_POST["opcion"]==2)
{
$borra_reg="delete from ".$tabla_gridvalor." where atenc_id=".$_POST["enlace"]." and cuabas_id=".$_POST["idgrid"];
$rs_borra = $DB_gogess->executec($borra_reg,array());

}


if($_POST["opcion"]==1)
{

$sql_inserta=$objvarios->genera_insert($tabla_gridvalor,$campo_enlace,$campo_fecharegistro,$_POST["enlace"],$_SESSION['ces1313777_sessid_inicio'],date("Y-m-d"),$_POST,$campos_data);
$rs_inserta = $DB_gogess->executec($sql_inserta,array());

}


$cuenta=0;
$lista_servicios="select ".$campo_id.",".$campo_enlace.",".$sqlcampos." from ".$tabla_gridvalor." where ".$campo_enlace."='".$_POST['enlace']."'";
$rs_data = $DB_gogess->executec($lista_servicios,array());

if($rs_data->fields[$campo_id]>0)
{
 echo "<br><b>".utf8_encode($fie_title)."</b><br><br>";
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
		 echo '<td>'.$rs_data->fields[$campos_data[$i]].'</td>';
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