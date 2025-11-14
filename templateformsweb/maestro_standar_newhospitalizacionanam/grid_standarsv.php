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

$atenc_id=0;
$atenc_id=$_POST["atenc_id"];
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
.Estilo1 {font-size: 11px}
-->
</style>
<?php
$objformulario= new  ValidacionesFormulario();
$datos_fields="select * from gogess_sisfield where fie_id=".$_POST["fie_id"];
$rs_fields = $DB_gogess->executec($datos_fields,array());

$enlaceorigen=$_POST["enlaceorigen"];

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


//signos vitales
$busca_cliente="select tarterial_id,clie_genero from app_cliente where clie_id=".$_POST["clie_id"];
$rs_cliente = $DB_gogess->executec($busca_cliente,array());
@$idten=$rs_cliente->fields["tarterial_id"];
$genero_clie=$rs_cliente->fields["clie_genero"];

$busca_rangoverif="select * from dns_tensionarterial where tarterial_id=".$idten;
$rs_rangovalor = $DB_gogess->executec($busca_rangoverif,array());

$tarterial_sisinicio=$rs_rangovalor->fields["tarterial_sisinicio"];
$tarterial_sisfin=$rs_rangovalor->fields["tarterial_sisfin"];

$tarterial_diainicio=$rs_rangovalor->fields["tarterial_diainicio"];
$tarterial_diafin=$rs_rangovalor->fields["tarterial_diafin"];
//signos vitaless

//rango frecuencia respiratoria

$busca_rangofr="select * from dns_frespiratoria where frespira_id=".$idten;
$rs_fr = $DB_gogess->executec($busca_rangofr,array());

$fr_rangoi=$rs_fr->fields["frespira_inicio"];
$fr_rangof=$rs_fr->fields["frespira_fin"];

//rango frecuencia respratoria

//rango frecuencia cardiaca

$busca_rangofc="select * from dns_fcardiaca where fcardiaca_id=".$idten;
$rs_fc = $DB_gogess->executec($busca_rangofc,array());

$fc_rangoi=$rs_fc->fields["fcardiaca_inicio"];
$fc_rangof=$rs_fc->fields["fcardiaca_fin"];

//renago frecuencia cardiaca

//rnago temperatura

$busca_rangofc="select * from dns_temperatura where ttemp_id=".$idten;
$rs_fc = $DB_gogess->executec($busca_rangofc,array());

$temp_rangoi=$rs_fc->fields["ttemp_inicio"];
$temp_rangof=$rs_fc->fields["ttemp_fin"];

//rango temperatura

if($_POST["opcion"]==2)
{
 $borra_reg="delete from ".$sub_tabla." where ".$campo_enlace."='".$_POST["enlace"]."' and ".$campo_id."=".$_POST["idgrid"];
 $rs_borra = $DB_gogess->executec($borra_reg,array());
}


if($_POST["opcion"]==1)
{


		if($_POST[$campo_id."x"]>0)
			{
			 $sql_edita='';
			 $_POST["anam_enlacex"]=$enlaceorigen;
			 $sql_edita=$objvarios->genera_update($sub_tabla,$campo_id,$_POST[$campo_id."x"],$_POST,$campos_datainserta);
			 $rs_edita = $DB_gogess->executec($sql_edita,array());
			
			}
			else
			{
			 $rs_inserta ='';
			 
			 $_POST["anam_enlacex"]=$enlaceorigen;			 
			 $sql_inserta=$objvarios->genera_insert($sub_tabla,$campo_enlace,$campo_fecharegistro,$_POST["enlace"],$_POST["sess_id"],date("Y-m-d H:i:s"),$_POST,$campos_datainserta);
			 $rs_inserta = $DB_gogess->executec($sql_inserta,array());
			
			}



}
?>

<div class="table-responsive">
<table class="table table-bordered"  style="width:100%" >
  <tr>
    <td bgcolor="#DFE9EE"  style="font-size:11px;padding:2px;" >Eliminar</td>
	<td bgcolor="#DFE9EE"  style="font-size:11px;padding:2px;" >Editar</td>
   <?php
	for($i=0;$i<count($fie_tituloscamposgrid);$i++)
	 {
      echo '<td bgcolor="#DFE9EE" style="font-size:11px;padding:2px;" >'.$fie_tituloscamposgrid[$i].'</td>';
	 }
	?>
  </tr>
<?php
$cuenta=0;
if($tabla_combo)
{
$lista_servicios="select *,DATE_ADD(".$campo_fecharegistro.",INTERVAL 3 DAY) as fechacierre from ".$sub_tabla." inner join  ".$tabla_combo." on ".$sub_tabla.".".$idtabla_combo."=".$tabla_combo.".".$idtabla_combo." where (".$campo_enlace."='".$_POST['enlace']."' or atenc_enlace in (select atenc_enlace  from dns_atencion where atenc_id='".$atenc_id."') )";
}
else
{
$lista_servicios="select *,DATE_ADD(".$campo_fecharegistro.",INTERVAL 3 DAY) as fechacierre from ".$sub_tabla." where (".$campo_enlace."='".$_POST['enlace']."' or atenc_enlace in (select atenc_enlace  from dns_atencion where atenc_id='".$atenc_id."') ) order by ".$campo_id." desc";


}
//echo $lista_servicios;
 $rs_data = $DB_gogess->executec($lista_servicios,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	    $cuenta++;
		
		$bloque_registro=0;
		if(@$rs_data->fields[$campo_fecharegistro])
			{
			  //echo $rs_sihaydata->fields["fechacierre"];
			   if(date("Y-m-d")>$rs_data->fields["fechacierre"])
			   {			   
			     $bloque_registro=1;
			   }
			   
			}
			
		if($bloque_registro==1)
		{
	?>
	<tr><td style="font-size:11px;padding:2px;" >&nbsp;</td>
    <td style="font-size:11px;padding:2px;" >&nbsp;</td>
	<?php	
		}
		else
		{
  ?>
  <tr><td  onClick="grid_extras_<?php echo $_POST["fie_id"]; ?>('<?php echo $rs_data->fields[$campo_enlace]; ?>','<?php echo $rs_data->fields[$campo_id]; ?>',2)" style="cursor:pointer;padding:2px;" ><span class="glyphicon glyphicon-ban-circle"></span></td>
    <td onClick="grid_editar_<?php echo $_POST["fie_id"]; ?>('<?php echo $rs_data->fields[trim($campo_enlace)]; ?>','<?php echo $rs_data->fields[$campo_id]; ?>',2)" style="cursor:pointer;padding:2px;" ><span class="glyphicon glyphicon-pencil"></span></td>
	<?php
	   }
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
                echo '<td style="font-size:11px;padding:2px;" >'.$rs_data->fields[$fie_camposgridselect[$i]].' '.$valor_txt.'</td>';
				
				
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
					else
					{
					
					//-------------------------------
					//$genero_clie
					$fecha_reg='';
					$fecha_reg=$rs_data->fields[$campo_fecharegistro];
					
					$obtiene_edaad="select TIMESTAMPDIFF(year, clie_fechanacimiento, '".$fecha_reg."') AS edad_anio,TIMESTAMPDIFF(month, clie_fechanacimiento, '".$fecha_reg."')%12 AS edad_mes from app_cliente where clie_id=".$_POST["clie_id"];
					$rs_mesesedad = $DB_gogess->executec($obtiene_edaad,array());
					$valor_meses=0;
					$valor_meses=($rs_mesesedad->fields["edad_anio"]*12)+$rs_mesesedad->fields["edad_mes"];
					$lista_rgf='';
					if($genero_clie=='F')
					{
					
						$lista_rgf="select * from dns_pesoninas where  pninas_edadini<=".$valor_meses." and pninas_edadfin>=".$valor_meses;
						$rs_rgf = $DB_gogess->executec($lista_rgf,array());
						
						if($rs_rgf)
							 {
								  while (!$rs_rgf->EOF) {
								  
									$pninas_inicio=0;
									$pninas_fin=0;
									$pninas_inicio=$rs_rgf->fields["pninas_inicio"];
									$pninas_fin=$rs_rgf->fields["pninas_fin"];
									$colorvx='';
									if($rs_rgf->fields["pninas_nombre"]=='normal')
									{
									$colorvx='#000000';
									}
									else
									{
									$colorvx='#FF0000';
									}
									
									if($rs_data->fields[$fie_camposgridselect[$i]]>=$pninas_inicio and $rs_data->fields[$fie_camposgridselect[$i]]<=$pninas_fin)
									{
									   $berifica_estado='<span style="color:'.$colorvx.'" ><b>'.$rs_rgf->fields["pninas_nombre"].'</b></span>';				
									}
						
						           $rs_rgf->MoveNext();	   
								  }
							 }

					
					}
					
					if($genero_clie=='M')
					{
					    
						$lista_rgf="select * from dns_pesoninos where  pninos_edadini<=".$valor_meses." and pninos_edadfin>=".$valor_meses;
						$rs_rgf = $DB_gogess->executec($lista_rgf,array());
						if($rs_rgf)
							 {
								  while (!$rs_rgf->EOF) {
						
									$pninas_inicio=0;
									$pninas_fin=0;
									$pninas_inicio=$rs_rgf->fields["pninos_inicio"];
									$pninas_fin=$rs_rgf->fields["pninos_fin"];
									
									if($rs_rgf->fields["pninos_nombre"]=='normal')
									{
									$colorvx='#000000';
									}
									else
									{
									$colorvx='#FF0000';
									}
									
									if($rs_data->fields[$fie_camposgridselect[$i]]>=$pninas_inicio and $rs_data->fields[$fie_camposgridselect[$i]]<=$pninas_fin)
									{
									   $berifica_estado='<span style="color:'.$colorvx.'" ><b>'.$rs_rgf->fields["pninos_nombre"].'</b></span>';				
									}
						
						          $rs_rgf->MoveNext();	   
								  }
							 }
					
					
					}
					
					//-------------------------------
					
					}
		
				  echo '<td style="font-size:11px;padding:2px;" >'.number_format($rs_data->fields[$fie_camposgridselect[$i]], 2, '.', '' ).' '.$berifica_estado.'</td>';
				}
				break;
			
			case 'signovita_frecuenciarespiratoria':
			{
						
				if($rs_data->fields[$fie_camposgridselect[$i]]>=$fr_rangoi and $rs_data->fields[$fie_camposgridselect[$i]]<=$fr_rangof)
				{
				   $valor_txt='<span style="color:#000000" ><b>Normal</b></span>';				
				}
				else
				{
				  $valor_txt='<span style="color:#FF0000" ><b>Signo Alterado</b></span>';
				}
				echo '<td style="font-size:11px;padding:2px;" >'.$rs_data->fields[$fie_camposgridselect[$i]].' '.$valor_txt.'</td>';
			         
			}
			break;	
			case 'signovita_frecuenciacardiaca':
			{
			    
				if($rs_data->fields[$fie_camposgridselect[$i]]>=$fc_rangoi and $rs_data->fields[$fie_camposgridselect[$i]]<=$fc_rangof)
				{
				   $valor_txt='<span style="color:#000000" ><b>Normal</b></span>';				
				}
				else
				{
				  $valor_txt='<span style="color:#FF0000" ><b>Signo Alterado</b></span>';
				}
				echo '<td style="font-size:11px;padding:2px;" >'.$rs_data->fields[$fie_camposgridselect[$i]].' '.$valor_txt.'</td>';
			    
			
			}
			break;
			case 'signovita_temperaturabucal':
			{
			    if($rs_data->fields[$fie_camposgridselect[$i]]>=$temp_rangoi and $rs_data->fields[$fie_camposgridselect[$i]]<=$temp_rangof)
				{
				   $valor_txt='<span style="color:#000000" ><b>Normal</b></span>';				
				}
				else
				{
				  $valor_txt='<span style="color:#FF0000" ><b>Signo Alterado</b></span>';
				}
				echo '<td style="font-size:11px;padding:2px;" >'.$rs_data->fields[$fie_camposgridselect[$i]].' '.$valor_txt.'</td>';
			
			}
			break;
			default:
			   {
			      echo '<td style="font-size:11px;padding:2px;" >'.$rs_data->fields[$fie_camposgridselect[$i]].'</td>';
			   
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
if(!(@$_SESSION['ces1313777_sessid_inicio']))
{

echo '
<script type="text/javascript">
<!--
abrir_standar("aplicativos/documental/activar_sesion.php","Activar_Sesi&oacute;n","divBody_acsession'.$_POST["fie_id"].'","divDialog_acsession'.$_POST["fie_id"].'",400,400,"",0,0,0,0,0,0);
//  End -->
</script>

<div id="divBody_acsession'.$_POST["fie_id"].'"></div>
';

}
?>