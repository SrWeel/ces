<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
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
$objformulario= new  ValidacionesFormulario();
$datos_fields="select * from gogess_sisfield where fie_id=".$_POST["fie_id"];
$rs_fields = $DB_gogess->executec($datos_fields,array());

//tabla_grid
$sub_tabla=$rs_fields->fields["fie_tablasubgrid"];
//id tabla grid
$campo_id=$rs_fields->fields["fie_tablasubcampoid"];
//campos tabla grid
$campos_dataedit=array();
$campos_dataedit=explode(",",$rs_fields->fields["fie_tablasubgridcampos"]);

$campos_datainserta=array();
$campos_datainserta=explode(",",$rs_fields->fields["fie_tablasubgridcampos"]);
//tabla combo
$tabla_combo=$rs_fields->fields["fie_tblcombogrid"];
$idtabla_combo=$rs_fields->fields["fie_campoidcombogrid"];
//subtablas
//campo enlace
$campo_enlace='';
$campo_enlace=$rs_fields->fields["fie_campoenlacesub"];
//fecha registro grid
$campo_fecharegistro='';
$campo_fecharegistro=$rs_fields->fields["fie_campofecharegistro"];

//titulos
$fie_tituloscamposgrid=array();
$fie_tituloscamposgrid=explode(",",$rs_fields->fields["fie_tituloscamposgrid"]);

//lista
$fie_camposgridselect=array();
$fie_camposgridselect=explode(",",$rs_fields->fields["fie_camposgridselect"]);

$fie_title='';
$fie_title=$rs_fields->fields["fie_title"];


$cuenta=0;
if($tabla_combo)
{
$lista_servicios="select * from ".$sub_tabla." inner join  ".$tabla_combo." on ".$sub_tabla.".".$idtabla_combo."=".$tabla_combo.".".$idtabla_combo." where ".$campo_enlace."='".$_POST['enlace']."'";
}
else
{
$lista_servicios="select * from ".$sub_tabla." where ".$campo_enlace."='".$_POST['enlace']."'";

}

$rs_data = $DB_gogess->executec($lista_servicios,array());

if($rs_data->fields[$campo_id]>0)
{
 echo "<br><b>".$fie_title."</b><br><br><hr>";
?>

<div class="table-responsive">
<table class="table table-bordered"  style="width:100%" border="1" cellpadding="0" cellspacing="0" >
  <tr>
   <?php
	for($i=0;$i<count($fie_tituloscamposgrid);$i++)
	 {
      echo '<td><b>'.$fie_tituloscamposgrid[$i].'</b></td>';
	 }
	?>
		<td><b>Alerta</b></td>
  </tr>
<?php

//echo $lista_servicios;

 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	    $cuenta++;
		
		$vaalerta=0;
		$vaalertacatas=0;
		$vaalertahuefana=0;
		
		$vaalerta=$objformulario->replace_cmb('dns_cie','cie_codigo,cie_reporteobligatorio','where cie_codigo like ',trim($rs_data->fields["diagn_cie"]),$DB_gogess);
		
		$vaalertacatas=$objformulario->replace_cmb('dns_cie','cie_codigo,cie_catastroficas','where cie_codigo like ',trim($rs_data->fields["diagn_cie"]),$DB_gogess);
		
		$vaalertahuefana=$objformulario->replace_cmb('dns_cie','cie_codigo,cie_huerfanas','where cie_codigo like ',trim($rs_data->fields["diagn_cie"]),$DB_gogess);
  ?>
  <tr>
	<?php
	for($i=0;$i<count($fie_camposgridselect);$i++)
	 {
		 echo '<td>'.$rs_data->fields[$fie_camposgridselect[$i]].'</td>';
	 }
	 
	 	$mensaje1='';
	 $mensaje2='';
	 $mensaje3='';
	 if($vaalerta==1)
		 {
		 $mensaje1='<div style="color:#FF0000" >Alerta Enfermedad de Reporte Obligatorio </div>';	 
		}
     if($vaalertacatas==1)
		 {
		 $mensaje2='<div style="color:#FF0000" >Enfermedad Catastr&oacute;fica</div>';	 
		}

	if($vaalertahuefana==1)
		 {
		 $mensaje3='<div style="color:#FF0000" >Enfermedad Huerfana y/o Rara</div>';	 
		}
		
		echo '<td>'.$mensaje1.' '.$mensaje2.' '.$mensaje3.'</td>';
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
