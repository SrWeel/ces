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

$url = "ARCHIVOS_MIGRAR/ARCHIVO_RX.xlsx";
$filecontent = file_get_contents($url);
$tmpfname = tempnam(sys_get_temp_dir(),"tmpxls");
file_put_contents($tmpfname,$filecontent);

@$ejecuta=$_GET["ejecuta"];

$lista_tabs=explode(",","TARIFARIO DE RX Y ECO");

$cuenta_data=0;

$lista_campo='';

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
	  //echo $sheetnames[$i]." -- ".trim($lista_tabs[$iexcl])."<br>";
	   if(trim($sheetnames[$i])==trim($lista_tabs[$iexcl]))
	   {
		 $index_val=$i;
	   }
	}
	
	//echo $index_val."<br>";
	$excelObj->setActiveSheetIndex($index_val);
	
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
			 
			 $contador_letra++;
			 
			 $array_letra[$contador_letra]="M";
			 $array_tipo[$contador_letra]="text";
			 $array_nombrecampo[$contador_letra]="13";
	
	  $row='';
	  for ($row = 0; $row <= $lastRow; $row++) {
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
			
			//print_r($datos);		
			
			//$excelObj->getActiveSheet()->SetCellValue('B12', 'DAF123');
			
			
			
			//inserta en tarifario
			
			$nombre_tarifario=trim($datos[4]);
			$numera=trim($datos[1]);
			
			
			if($nombre_tarifario!='' and $numera>0)
			{
			//++++++++++++++++++++++++++++++++++++++++++++++++++
			
			$busca_codigo="select * from efacsistema_producto where prod_nombre like '%".$nombre_tarifario."%'";
		    $rs_bdata = $DB_gogess->executec($busca_codigo);	
			
			$lista_campo.=$rs_bdata->fields["prod_codigo"].','.$rs_bdata->fields["prod_nombre"].','.$nombre_tarifario."\n";
			
			//echo 'B'.$row;
				if($rs_bdata->fields["prod_codigo"])
			{
			  $excelObj->getActiveSheet()->SetCellValue('B'.$row, $rs_bdata->fields["prod_codigo"]);
			}
			else
			{
			  $excelObj->getActiveSheet()->SetCellValue('B'.$row, '');
			}
			//++++++++++++++++++++++++++++++++++++++++++++++++++
			}
			//inserta en tarifario
			
			
	 }		
	
	//Guardamos los cambios
	        $objWriter = PHPExcel_IOFactory::createWriter($excelObj, 'Excel2007');
	        $objWriter->save("ARCHIVOS_CODE/ARCHIVO_RX_CODE.xlsx");
	  
	echo "<br><br><br>Actualizados=".$cuenta_data."<br>";	
	
	///=========================================================
	
	
 // $fechahoy=date('Ymd');		
  //$fh = fopen("Generaconcodigos-".$fechahoy.".csv", 'w') or die("Se produjo un error al crear el archivo");
  //fwrite($fh, $lista_campo) or die("No se pudo escribir en el archivo");  
  //fclose($fh);
  
  
  
	
}	

?>