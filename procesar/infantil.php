<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$system=1;
@$director="../";
include("../cfg/clases.php");
include("../cfg/declaracion.php");
include(@$director."libreria/variables/variables.php");

require_once "Classes/PHPExcel.php";

$url = "infantil.xlsx";
$filecontent = file_get_contents($url);
$tmpfname = tempnam(sys_get_temp_dir(),"tmpxls");
file_put_contents($tmpfname,$filecontent);

$lista_tabs=explode(",","Hoja1");

$concatena_campos='';
$concatena_campos_valores='';

$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
$excelObj = $excelReader->load($tmpfname);
$sheetnames = $excelReader->listWorksheetNames($tmpfname);

//print_r($sheetnames);

for($iexcl=0;$iexcl<count($lista_tabs);$iexcl++)
{

    $index_val=0;
	for($i=0;$i<count($sheetnames);$i++)
	{
	   if($sheetnames[$i]==trim($lista_tabs[$iexcl]))
	   {
		 $index_val=$i;
	   }
	}
	
	
	$worksheet = $excelObj->getSheet($index_val);
    $lastRow = $worksheet->getHighestRow();
	
	//print_r($worksheet);
	
	///=========================================================
	
	
			 $array_letra=array();
			 $array_tipo=array();
			 $array_nombrecampo=array();			
			 $contador_letra=0;	
			 
			 $array_letra[$contador_letra]="A";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="1";
			 
			 $contador_letra++;
			 
			 $array_letra[$contador_letra]="B";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="2";
			 
			 $contador_letra++;
			 
			 $array_letra[$contador_letra]="C";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="3";
			 
			 $contador_letra++;
			 
			 $array_letra[$contador_letra]="D";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="4";
			 
			 $contador_letra++;
			 
			 $array_letra[$contador_letra]="E";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="5";
			 
			  $contador_letra++;
			 
			 $array_letra[$contador_letra]="F";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="6";
		  
		  
		     $contador_letra++;
			 
			 $array_letra[$contador_letra]="G";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="7";
			
			 $contador_letra++;
			 
			 $array_letra[$contador_letra]="H";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="8";
			 
			 $contador_letra++;
			 
			 $array_letra[$contador_letra]="I";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="9";
			 
			 $contador_letra++;
			 
			 $array_letra[$contador_letra]="J";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="10";
			 
			 $contador_letra++;
			 
			 $array_letra[$contador_letra]="K";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="11";
			 
			 $contador_letra++;
			 
			 $array_letra[$contador_letra]="L";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="12";
	
	  $row='';
	  for ($row = 1; $row <= $lastRow; $row++) {
	      $datos=array();
		  
		  for ($ilet=0;$ilet<count($array_letra);$ilet++)
			{
			
			   //+++++++++++++++++++++++++++++++++++++++++++++++
				switch ($array_tipo[$ilet]) {
						case 'DATE':
							{
								$valorfecha=$worksheet->getCell($array_letra[$ilet].$row)->getValue();
								$datos[$array_nombrecampo[$ilet]] = PHPExcel_Style_NumberFormat::toFormattedString($valorfecha, "YYYY-MM-DD");
							}
							break;
						case 'DATETIME':
							{
								$date='';
								$valorfecha=$worksheet->getCell($array_letra[$ilet].$row)->getValue();
								$date = date_create($valorfecha);
								$datos[$array_nombrecampo[$ilet]]=@date_format($date, 'Y-m-d H:i:s');
							}
							break;
						default:
						   {
						   
							 // @$datos[$array_nombrecampo[$ilet]]=$worksheet->getCell($array_letra[$ilet].$row)->getCalculatedValue();
								@$datos[$array_nombrecampo[$ilet]]=str_replace("'", "\'",$worksheet->getCell($array_letra[$ilet].$row)->getCalculatedValue());
								if(@$datos[$array_nombrecampo[$ilet]]=='')
								  {
								  @$datos[$array_nombrecampo[$ilet]]='';
								  }
								  
						   }
						   
					}
				
				//+++++++++++++++++++++++++++++++++++++++++++++++	
			
			}
			
			print_r($datos);
			
			
			//inserta en tarifario
			
			$emp_id=1;
			$catgp_id=9;
			$tipp_id=2;
			$prod_codigo="INFA".$datos[1];
			$prod_nombre=$datos[2];
			$prod_precio=$datos[3];
			$impu_codigo=2;
			$tari_codigo=0;
			$prod_fecharegistro=date("Y-m-d H:i:s");
			$sisu_id=0;
			$prod_activo=1;
			$prod_pedido='';
			$usua_id=0;
			$prod_paraevaluacion=0;
			$prod_paraterapia=0;
			$prod_nivel=1;
			
			$valoralet=mt_rand(1,500);
			$aletorioid='04'.$datos[1].date("Ymdhis").$valoralet;
			
			$prod_enlace=$aletorioid;
			$prod_preciotarifarionacional='';
			$prod_codigotarifario='';
			$prod_nombredespliegue='';
			$prod_codproducto='';
			
			$inserta_data="INSERT INTO efacsistema_producto (emp_id, catgp_id, tipp_id, prod_codigo, prod_nombre, prod_precio, impu_codigo, tari_codigo, prod_fecharegistro, sisu_id, prod_activo, prod_pedido, usua_id, prod_paraevaluacion, prod_paraterapia, prod_nivel, prod_enlace, prod_preciotarifarionacional, prod_codigotarifario, prod_nombredespliegue, prod_codproducto) VALUES
('".$emp_id."','".$catgp_id."','".$tipp_id."','".$prod_codigo."','".$prod_nombre."','".$prod_precio."','".$impu_codigo."','".$tari_codigo."','".$prod_fecharegistro."','".$sisu_id."','".$prod_activo."','".$prod_pedido."','".$usua_id."','".$prod_paraevaluacion."','".$prod_paraterapia."','".$prod_nivel."','".$prod_enlace."','".$prod_preciotarifarionacional."','".$prod_codigotarifario."','".$prod_nombredespliegue."','".$prod_codproducto."')";

$rs_ok1 = $DB_gogess->executec($inserta_data,array());

 echo $inserta_data."<br>";
		  
//if($datos[3]>0)
//{
//para convenio		  

//$gconve_convenio=16;
//$gconve_precio=$datos[3];
//$usua_id=1;
//$centrod_id=0;
//$gconve_fecharegistro=date("Y-m-d H:i:s");
		  
//$inserta_data2="INSERT INTO cesdb_arextension.dns_gridconvenios ( prod_enlace, gconve_convenio, gconve_precio, usua_id, centrod_id, gconve_fecharegistro) VALUES
//('".$prod_enlace."','".$gconve_convenio."','".$gconve_precio."','".$usua_id."','".$centrod_id."','".$gconve_fecharegistro."');";

//$rs_ok2 = $DB_gogess->executec($inserta_data2,array());			
//para convenio
//}


if($datos[4]>0)
{
//privilegio
$gconve_convenio=4;
$gconve_precio=$datos[4];
$usua_id=1;
$centrod_id=0;
$gconve_fecharegistro=date("Y-m-d H:i:s");
		  
$inserta_data2="INSERT INTO cesdb_arextension.dns_gridconvenios ( prod_enlace, gconve_convenio, gconve_precio, usua_id, centrod_id, gconve_fecharegistro) VALUES
('".$prod_enlace."','".$gconve_convenio."','".$gconve_precio."','".$usua_id."','".$centrod_id."','".$gconve_fecharegistro."');";

$rs_ok2 = $DB_gogess->executec($inserta_data2,array());			
//privilegio
}


if($datos[5]>0)
{
//farmaenlace
$gconve_convenio=14;
$gconve_precio=$datos[5];
$usua_id=1;
$centrod_id=0;
$gconve_fecharegistro=date("Y-m-d H:i:s");
		  
$inserta_data2="INSERT INTO cesdb_arextension.dns_gridconvenios ( prod_enlace, gconve_convenio, gconve_precio, usua_id, centrod_id, gconve_fecharegistro) VALUES
('".$prod_enlace."','".$gconve_convenio."','".$gconve_precio."','".$usua_id."','".$centrod_id."','".$gconve_fecharegistro."');";

$rs_ok2 = $DB_gogess->executec($inserta_data2,array());			
//farmaenlace
}


if($datos[6]>0)
{
//auditan
$gconve_convenio=17;
$gconve_precio=$datos[6];
$usua_id=1;
$centrod_id=0;
$gconve_fecharegistro=date("Y-m-d H:i:s");
		  
$inserta_data2="INSERT INTO cesdb_arextension.dns_gridconvenios ( prod_enlace, gconve_convenio, gconve_precio, usua_id, centrod_id, gconve_fecharegistro) VALUES
('".$prod_enlace."','".$gconve_convenio."','".$gconve_precio."','".$usua_id."','".$centrod_id."','".$gconve_fecharegistro."');";

$rs_ok2 = $DB_gogess->executec($inserta_data2,array());			
//auditan
}


if($datos[7]>0)
{
//vida buena
$gconve_convenio=8;
$gconve_precio=$datos[7];
$usua_id=1;
$centrod_id=0;
$gconve_fecharegistro=date("Y-m-d H:i:s");
		  
$inserta_data2="INSERT INTO cesdb_arextension.dns_gridconvenios ( prod_enlace, gconve_convenio, gconve_precio, usua_id, centrod_id, gconve_fecharegistro) VALUES
('".$prod_enlace."','".$gconve_convenio."','".$gconve_precio."','".$usua_id."','".$centrod_id."','".$gconve_fecharegistro."');";

$rs_ok2 = $DB_gogess->executec($inserta_data2,array());			
//vida buena
}

if($datos[8]>0)
{
//coris
$gconve_convenio=18;
$gconve_precio=$datos[8];
$usua_id=1;
$centrod_id=0;
$gconve_fecharegistro=date("Y-m-d H:i:s");
		  
$inserta_data2="INSERT INTO cesdb_arextension.dns_gridconvenios ( prod_enlace, gconve_convenio, gconve_precio, usua_id, centrod_id, gconve_fecharegistro) VALUES
('".$prod_enlace."','".$gconve_convenio."','".$gconve_precio."','".$usua_id."','".$centrod_id."','".$gconve_fecharegistro."');";

$rs_ok2 = $DB_gogess->executec($inserta_data2,array());			
//coris
}

if($datos[9]>0)
{
//medicompanies
$gconve_convenio=2;
$gconve_precio=$datos[9];
$usua_id=1;
$centrod_id=0;
$gconve_fecharegistro=date("Y-m-d H:i:s");
		  
$inserta_data2="INSERT INTO cesdb_arextension.dns_gridconvenios ( prod_enlace, gconve_convenio, gconve_precio, usua_id, centrod_id, gconve_fecharegistro) VALUES
('".$prod_enlace."','".$gconve_convenio."','".$gconve_precio."','".$usua_id."','".$centrod_id."','".$gconve_fecharegistro."');";

$rs_ok2 = $DB_gogess->executec($inserta_data2,array());			
//medicompnies
}
		
		
if($datos[10]>0)
{
//humana
$gconve_convenio=15;
$gconve_precio=$datos[10];
$usua_id=1;
$centrod_id=0;
$gconve_fecharegistro=date("Y-m-d H:i:s");
		  
$inserta_data2="INSERT INTO cesdb_arextension.dns_gridconvenios ( prod_enlace, gconve_convenio, gconve_precio, usua_id, centrod_id, gconve_fecharegistro) VALUES
('".$prod_enlace."','".$gconve_convenio."','".$gconve_precio."','".$usua_id."','".$centrod_id."','".$gconve_fecharegistro."');";

$rs_ok2 = $DB_gogess->executec($inserta_data2,array());			
//humana
}

if($datos[11]>0)
{
//proassislife
$gconve_convenio=21;
$gconve_precio=$datos[11];
$usua_id=1;
$centrod_id=0;
$gconve_fecharegistro=date("Y-m-d H:i:s");
		  
$inserta_data2="INSERT INTO cesdb_arextension.dns_gridconvenios ( prod_enlace, gconve_convenio, gconve_precio, usua_id, centrod_id, gconve_fecharegistro) VALUES
('".$prod_enlace."','".$gconve_convenio."','".$gconve_precio."','".$usua_id."','".$centrod_id."','".$gconve_fecharegistro."');";

$rs_ok2 = $DB_gogess->executec($inserta_data2,array());			
//proassislife
}

if($datos[12]>0)
{
//confiamed
$gconve_convenio=19;
$gconve_precio=$datos[12];
$usua_id=1;
$centrod_id=0;
$gconve_fecharegistro=date("Y-m-d H:i:s");
		  
$inserta_data2="INSERT INTO cesdb_arextension.dns_gridconvenios ( prod_enlace, gconve_convenio, gconve_precio, usua_id, centrod_id, gconve_fecharegistro) VALUES
('".$prod_enlace."','".$gconve_convenio."','".$gconve_precio."','".$usua_id."','".$centrod_id."','".$gconve_fecharegistro."');";

$rs_ok2 = $DB_gogess->executec($inserta_data2,array());			
//confiamed
}
			
			
			//inserta en tarifario
			
			
	 }		
	
	
	  
	
	
	///=========================================================
	
	
}	

?>