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
if($rs_fields->fields["fie_tactive"]==1)
{
$fie_title="<br><b>".$rs_fields->fields["fie_title"]."</b><br><br>";
}

$cuenta=0;

$lista_servicios="select * from ".$sub_tabla." where clie_id='".$_POST['clie_id']."' order by ".$campo_fecharegistro." desc";


$rs_data = $DB_gogess->executec($lista_servicios,array());

if($rs_data->fields[$campo_id]>0)
{
 echo $fie_title;
?>

<div class="table-responsive">
<table class="table table-bordered"  style="width:100%;padding:4px;" border="1" cellpadding="0" cellspacing="0" >
  <tr>
   <?php
	for($i=0;$i<count($fie_tituloscamposgrid);$i++)
	 {
      echo '<td style="font-size:10px;" ><b>'.$fie_tituloscamposgrid[$i].'</b></td>';
	 }
	?>
  </tr>
<?php

//echo $lista_servicios;

 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	    $cuenta++;
  ?>
  <tr>
	<?php
	for($i=0;$i<count($fie_camposgridselect);$i++)
	 {
		// echo '<td>'.$rs_data->fields[$fie_camposgridselect[$i]].'</td>';
		 
		 $lista_camposxc="select * from gogess_gridfield where fie_id=".$_POST["fie_id"]." and gridfield_nameid='".trim($fie_camposgridselect[$i])."x"."'";
		 $rs_dataxc = $DB_gogess->executec($lista_camposxc,array());
		 $valordt='';
		 
		 switch (trim($rs_dataxc->fields["gridfield_tipo"])) {
				case 'select':
					{
						
						$listac=array();
						$listac=explode(",",$rs_dataxc->fields["gridfield_camposcmb"]);
						$valordt=$objformulario->replace_cmb($rs_dataxc->fields["gridfield_tablecmb"],$rs_dataxc->fields["gridfield_camposcmb"],"where ".$listac[0].'=',$rs_data->fields[$fie_camposgridselect[$i]],$DB_gogess);
						echo '<td style="font-size:10px;" >'.$valordt.'</td>';
					}
					break;
				case 'check':
					{
					 if($rs_data->fields[$fie_camposgridselect[$i]]==1)
						 {
							 echo '<td><img src="visto_dns.png"  width="20" height="18" /></td>';
							}
							else
							{
							 echo '<td></td>';
							}	

							 
					}
					break;

				default:
				   {
					 echo '<td style="font-size:10px;" >'.$rs_data->fields[$fie_camposgridselect[$i]].'</td>';
					}
			}
		 
		 
		 
		 
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
