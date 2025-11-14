<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
date_default_timezone_set("America/Guayaquil");

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objvarios=new util_funciones();

require_once "Classes/PHPExcel.php";
$archdt_id=$_POST["archdt_id"];

$busca_archivo="select * from conco_archivosdata where archdt_id='".$archdt_id."'";
$rs_archivo = $DB_gogess->executec($busca_archivo);

$archdt_anio=$rs_archivo->fields["archdt_anio"];
$archdt_mes=$rs_archivo->fields["archdt_mes"];
$usua_id=$_SESSION['ces1313777_sessid_inicio'];

$archdt_fila=$rs_archivo->fields["archdt_fila"];
$tiparch_id=$rs_archivo->fields["tiparch_id"];

$busca_ntabla="select * from cmb_tipoarchivo where tiparch_id='".$rs_archivo->fields["tiparch_id"]."'";
$rs_ntabla = $DB_gogess->executec($busca_ntabla);
$nombre_tabla=$rs_ntabla->fields["tiparch_ntabla"];

//vacida datos
$vacia_data="delete from ".$nombre_tabla." where archdt_anio='".$archdt_anio."' and archdt_mes='".$archdt_mes."'";
//$rs_vaciadata = $DB_gogess->executec($vacia_data);
//vacia datos

$nombre_archivo="";
$url = "../../excel/".$rs_archivo->fields["archdt_archivo"];


$filecontent = file_get_contents($url);
$tmpfname = tempnam(sys_get_temp_dir(),"tmpxls");
file_put_contents($tmpfname,$filecontent);

$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
$excelObj = $excelReader->load($tmpfname);
$sheetnames = $excelReader->listWorksheetNames($tmpfname);


$index_data=0;
for($ival=0;$ival<(count($sheetnames));$ival++)
{
  if($sheetnames[$ival]=='Hoja1')
  {
     $index_data=$ival;
   }

}

$index_val=$index_data;
$worksheet = $excelObj->getSheet($index_val);
$maxCell = $worksheet->getHighestRowAndColumn();
$data = $worksheet->rangeToArray('A'.$archdt_fila.':' . $maxCell['column'] . $maxCell['row']);
$data = array_map('array_filter', $data);

$cuenta_real=0;
$cuenta_real=count($data); 
$cuenta_real=$maxCell['row'];

//print_r($data);

$array_letra=array();
$array_tipo=array();
$contador_letra=0;
$lista_campos="select * from cmb_camposarch inner join appg_tipodata on cmb_camposarch.tipda_id=appg_tipodata.tipda_id where tiparch_id='".$tiparch_id."'";

$rs_lcampos = $DB_gogess->executec($lista_campos);
if($rs_lcampos)
 {
	  while (!$rs_lcampos->EOF) {
	     
		 $array_letra[$contador_letra]=$rs_lcampos->fields["crch_columnaexcel"];
		 $array_tipo[$contador_letra]=$rs_lcampos->fields["tipda_nombre"];
		 $array_nombrecampo[$contador_letra]=$rs_lcampos->fields["crch_nameid"];
		 
	     $contador_letra++;
	  
	  $rs_lcampos->MoveNext();
	  }
  }	
  
 $campos_data=implode(",",$array_nombrecampo); 
 //echo $campos_data;
 //print_r($array_letra);

      $inicio_val=0; 
      $row='';
	  for ($row = $archdt_fila; $row <= $cuenta_real; $row++) {
	      $datos=array();
		  
		  for ($ilet=0;$ilet<count($array_letra);$ilet++)
			{
				
				switch ($array_tipo[$ilet]) {
					case 'DATE':
					    {
						    $valorfecha=$worksheet->getCell($array_letra[$ilet].$row)->getValue();
							if($valorfecha)
							{
			                 $datos[$array_nombrecampo[$ilet]] = PHPExcel_Style_NumberFormat::toFormattedString($valorfecha, "YYYY-MM-DD");
							}
							else
							{
							 $datos[$array_nombrecampo[$ilet]] ='0000-00-00';
							}
						}
						break;
					case 'DATETIME':
						{
						    $date='';
							$valorfecha=$worksheet->getCell($array_letra[$ilet].$row)->getValue();
						    $date = date_create($valorfecha);
							if($valorfecha)
							{
					          $datos[$array_nombrecampo[$ilet]]=@date_format($date, 'Y-m-d H:i:s');
							  if(!(trim($datos[$array_nombrecampo[$ilet]])))
							  {
							  $datos[$array_nombrecampo[$ilet]]=PHPExcel_Style_NumberFormat::toFormattedString($valorfecha, "YYYY-MM-DD hh:mm:ss");
							  }
							}
							else
							{
							$datos[$array_nombrecampo[$ilet]]='0000-00-00 00:00';
							}
						}
						break;
					case 'TIME':
						{
						    $date='';
							$valorfecha=$worksheet->getCell($array_letra[$ilet].$row)->getValue();
						    $date = date_create($valorfecha);
							if($valorfecha)
							{
					         
							 $datos[$array_nombrecampo[$ilet]]=@date_format($date, 'H:i:s');
							 if(!(trim(($datos[$array_nombrecampo[$ilet]]))))
							 {
							 $datos[$array_nombrecampo[$ilet]]=PHPExcel_Style_NumberFormat::toFormattedString($valorfecha, "hh:mm:ss");
							 }
							 
							}
							else
							{
							 $datos[$array_nombrecampo[$ilet]]='00:00';
							}
						}
						break;	
				     case 'WITH DECIMALS':
						{
						
						    @$datos[$array_nombrecampo[$ilet]]=str_replace("'", "\'",$worksheet->getCell($array_letra[$ilet].$row)->getCalculatedValue());
							@$datos[$array_nombrecampo[$ilet]]=str_replace(",", "",@$datos[$array_nombrecampo[$ilet]]);
							if(@$datos[$array_nombrecampo[$ilet]]=='')
							  {
							  @$datos[$array_nombrecampo[$ilet]]='0';
							  }
						 
						}		
					 break;	
					default:
					   {
						  
						  @$datos[$array_nombrecampo[$ilet]]=str_replace("'", "",$worksheet->getCell($array_letra[$ilet].$row)->getCalculatedValue());
						  @$datos[$array_nombrecampo[$ilet]]=str_replace("-", "",@$datos[$array_nombrecampo[$ilet]]);
								
							if(@$datos[$array_nombrecampo[$ilet]]=='')
							  {
							  @$datos[$array_nombrecampo[$ilet]]='0';
							  }
							  
					   }
					   
				}
					   

			}
						
			$datos["archdt_anio"]=trim($archdt_anio);
			$datos["archdt_mes"]=$archdt_mes;
			$datos["usua_id"]=$usua_id;
			$datos["archdt_fecharegistro"]=date("Y-m-d H:i:s");
		    $array_camposdata=array();
			$array_camposdata=explode(",",$campos_data.",archdt_anio,archdt_mes,usua_id,archdt_fecharegistro");
			$sql_inserta='';
			//echo $array_nombrecampo[0];
			//print_r($datos);
			if($datos[$array_nombrecampo[0]])
			{
			     $busca_existeproducto="select * from dns_cuadrobasicomedicamentos where cuadrobm_codigoatc='".$datos["cuadrobm_codigoatc"]."'";
			     $rs_existepr = $DB_gogess->executec($busca_existeproducto);
				 
				 if($rs_existepr->fields["cuadrobm_id"]>0)
				 {
				    echo "Ya Existe:".$rs_existepr->fields["cuadrobm_id"];
				 }
				 else
				 {			
			       $sql_inserta=$objvarios->genera_insert_general($nombre_tabla,$datos,$array_camposdata);
				 }  
			}
			//echo $sql_inserta."<br>";
			$rs_sitienedata = $DB_gogess->executec($sql_inserta);
		
	  
	  }

echo "<span style='color:#000000' >&nbsp;&nbsp;Processed File...</span>";

}
?>