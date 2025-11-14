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

$busca_cliente="select tarterial_id,clie_genero from app_cliente where clie_id=".$_POST["clie_id"];
$rs_cliente = $DB_gogess->executec($busca_cliente,array());
$idten=$rs_cliente->fields["tarterial_id"];
$genero_clie=$rs_cliente->fields["clie_genero"];

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
<table class="table table-bordered"  style="width:100%" >
  <tr>
    
   <?php
	for($i=0;$i<count($fie_tituloscamposgrid);$i++)
	 {
      echo '<td bgcolor="#DFE9EE" >'.utf8_encode($fie_tituloscamposgrid[$i]).'</td>';
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
		 $lista_camposxc="select * from gogess_gridfield where fie_id=".$_POST["fie_id"]." and gridfield_nameid='".trim($fie_camposgridselect[$i])."x"."'";
		 $rs_dataxc = $DB_gogess->executec($lista_camposxc,array());
		 $valordt='';
		 
		 switch (trim($rs_dataxc->fields["gridfield_tipo"])) {
				case 'select':
					{
						
						$listac=array();
						$listac=explode(",",$rs_dataxc->fields["gridfield_camposcmb"]);
						$valordt=$objformulario->replace_cmb($rs_dataxc->fields["gridfield_tablecmb"],$rs_dataxc->fields["gridfield_camposcmb"],"where ".$listac[0].'=',$rs_data->fields[$fie_camposgridselect[$i]],$DB_gogess);
						echo '<td>'.$valordt.'</td>';
					}
					break;
				case 'check':
					{
					 if($rs_data->fields[$fie_camposgridselect[$i]]==1)
						 {
							 echo '<td><img src="images/check.png" width="24" height="22" /></td>';
							}
							else
							{
							 echo '<td></td>';
							}	

							 
					}
					break;

				default:
				   {
					   if($fie_camposgridselect[$i]=='gquimica_resultado')
					   {
					    
						$lista_valid="select * from dns_tipoquimica where tqui_nombre='".$rs_data->fields["gquimica_tipo"]."'";
						$unidad_medida='';
						$valor_referncia='';
						$rs_valid = $DB_gogess->executec($lista_valid,array());
						 if($rs_valid)
						 {
							  while (!$rs_valid->EOF) {	

								if($genero_clie=='F')
								{
									
									$tqui_i=$rs_valid->fields["tqui_mi"];
									$tqui_f=$rs_valid->fields["tqui_mf"];	
									
								}
								else
								{
									
									$tqui_i=$rs_valid->fields["tqui_hi"];
									$tqui_f=$rs_valid->fields["tqui_hf"];
							
								}
							  
							  $rs_valid->MoveNext();	
							  }
						}	  
                          $mensaje="";
						 if($rs_data->fields[$fie_camposgridselect[$i]]<$tqui_i)
						 {
							 $mensaje="<span style='color:#FF0000' ><b>Valor bajo</b></span>";
						 }
						
						 if($rs_data->fields[$fie_camposgridselect[$i]]>$tqui_f)
						 {
							 $mensaje="<span style='color:#FF0000' ><b>Valor Alto</b></span>";
						 }
						
						echo '<td>'.$rs_data->fields[$fie_camposgridselect[$i]].' '.$mensaje.'</td>';
					   }
					   else
					   {
						echo '<td>'.$rs_data->fields[$fie_camposgridselect[$i]].'</td>';   
					   }
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
