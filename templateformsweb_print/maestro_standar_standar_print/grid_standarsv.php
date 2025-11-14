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



//signos vitales
$busca_cliente="select tarterial_id from app_cliente where clie_id=".$_POST["clie_id"];
$rs_cliente = $DB_gogess->executec($busca_cliente,array());
$idten=$rs_cliente->fields["tarterial_id"];

$busca_rangoverif="select * from dns_tensionarterial where tarterial_id=".$idten;
$rs_rangovalor = $DB_gogess->executec($busca_rangoverif,array());

$tarterial_sisinicio=$rs_rangovalor->fields["tarterial_sisinicio"];
$tarterial_sisfin=$rs_rangovalor->fields["tarterial_sisfin"];

$tarterial_diainicio=$rs_rangovalor->fields["tarterial_diainicio"];
$tarterial_diafin=$rs_rangovalor->fields["tarterial_diafin"];
//signos vitaless



$cuenta=0;
if($tabla_combo)
{
$lista_servicios="select * from ".$sub_tabla." inner join  ".$tabla_combo." on ".$sub_tabla.".".$idtabla_combo."=".$tabla_combo.".".$idtabla_combo." where ".$campo_enlace."='".$_POST['enlace']."'";
}
else
{
$lista_servicios="select * from ".$sub_tabla." where ".$campo_enlace."='".$_POST['enlace']."' order by ".$campo_id." desc";

}

$rs_data = $DB_gogess->executec($lista_servicios,array());

if($rs_data->fields[$campo_id]>0)
{

if($rs_fields->fields["fie_tactive"])
{
 echo "<br><b>".$fie_title."</b><br><br>";
}
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
		//------------------------------------------------------------------------
		$valor_txt='';		
		$sistolico='0';		
		$diastolico='0';
		$atenc_presionarterial=array();
		$totalv=0;	
		switch ($fie_camposgridselect[$i]) {
			case 'signovita_presionarterial':
				{

				$atenc_presionarterial=explode("/",$rs_data->fields[$fie_camposgridselect[$i]]);
				
				//print_r($atenc_presionarterial);
				$sistolico='0';
				
				if($atenc_presionarterial[0]<$tarterial_sisinicio or $atenc_presionarterial[0]>$tarterial_sisfin)
					{
						   $sistolico=1;
					}
				$diastolico='0';
				if(@$atenc_presionarterial[1]<$tarterial_diainicio or  @$atenc_presionarterial[1]>$tarterial_diafin)
					{
						   $diastolico=1;
					}	
				
				$totalv=$sistolico+$diastolico;
				if($totalv>0)
				{	
				  $valor_txt='<span style="color:#FF0000" ><b>Signo Alterado</b></span>';
				}
				else
				{
				  $valor_txt='<span style="color:#000000" ><b>Normal</b></span>';
				}		
                echo '<td style="font-size:10px;" >'.$rs_data->fields[$fie_camposgridselect[$i]].' '.$valor_txt.'</td>';
				
				
				}
				break;
			case 'signovita_masacorporal':
				{
				    $berifica_estado='';
					if($idten==7)
					{
							$busca_rangoverif="select * from dns_pesoadultos";
							$rs_rangovalor = $DB_gogess->executec($busca_rangoverif,array());
							$berifica_estado='';
							if($rs_rangovalor)
							 {
								  while (!$rs_rangovalor->EOF) {
									  
									  if($rs_data->fields["signovita_masacorporal"]>=$rs_rangovalor->fields["padultos_inicio"] and  $rs_data->fields["signovita_masacorporal"]<=$rs_rangovalor->fields["padultos_fin"])
									  {
										  if(trim($rs_rangovalor->fields["padultos_nombre"])=='Normal')
											  {
												$berifica_estado='<span style="color:#00CC00" ><b>'.$rs_rangovalor->fields["padultos_nombre"].'</b></span>';  
												}  
										  else
											  {
												$berifica_estado='<span style="color:#FF0000" ><b>'.$rs_rangovalor->fields["padultos_nombre"].'</b></span>'; 
												} 
										   
										  
									  }	  
									$rs_rangovalor->MoveNext();	   
								  }
							 }
							
					 
					}
		
				  echo '<td style="font-size:10px;" >'.number_format($rs_data->fields[$fie_camposgridselect[$i]], 2, '.', '' ).' '.$berifica_estado.'</td>';
				}
				break;
			default:
			   {
			      echo '<td style="font-size:10px;" >'.$rs_data->fields[$fie_camposgridselect[$i]].'</td>';
			   
			   }
		}
		
		
		//------------------------------------------------------------------------
		
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
