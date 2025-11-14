<?php
ini_set('display_errors',0);
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
	   
	   
	   require_once "Classes/PHPExcel.php";	   
       //echo $target_path="./files/".trim($rs_files->fields["source_file"]);
	   $target_path="plannuevo.xls";
	   $url = $target_path;
	   $filecontent = file_get_contents($url);
	   $tmpfname = tempnam(sys_get_temp_dir(),"tmpxls");
	   file_put_contents($tmpfname,$filecontent);
	  
	    $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
		$excelObj = $excelReader->load($tmpfname);
		$worksheet = $excelObj->getSheet(0);
		$lastRow = $worksheet->getHighestRow();
		//verificar este punto aqui estaba >= 2019  29_05_2019
		
		$array_letra = array("A", "B");

		
		$yr='';
	    $qtr='';
		$wk='';
		
		$region='';
		$packer='';
		$sltrdate='';
		$tattoo='';
		$pdhd='';
		$avgcwt='';
		$lot='';
		
	    //print_r($ar);
        
		$lista_num=0;
		//$lastRow	 
		for ($row = 1; $row <= $lastRow; $row++) {			 
			
			$lista_num++;
			
			for ($ilet=0;$ilet<count($array_letra);$ilet++)
			{
			 
			  
			  //-----------------------------------------------
			  @$datos[$lista_num][$array_letra[$ilet]] ='';
			  $valorfecha='';
			  //if(@$ar[$ilet]=='tfd_sltrdate')
			  //{
			  // $valorfecha=$worksheet->getCell($array_letra[$ilet].$row)->getValue();
			  // $datos[$ar[$ilet]] = PHPExcel_Style_NumberFormat::toFormattedString($valorfecha, "YYYY-MM-DD");
			  //}
			  //else
			  //{
			      @$datos[$lista_num][$array_letra[$ilet]]=$worksheet->getCell($array_letra[$ilet].$row)->getCalculatedValue();
				  if(@$datos[$lista_num][$array_letra[$ilet]]=='')
				  {
				  @$datos[$lista_num][$array_letra[$ilet]]='0';
				  }			  
			  //}
			  //---------------------------------------------
			  
			  
			}
			
		 
			
			//$concatenacampos='';
			//$valores_g='';
			//for($geni=1;$geni<$numero_camposdata;$geni++)
			//{
			   //$concatenacampos.=$ar[$geni].",";
			   //$valores_g.="'".str_replace("'","\'",$datos[$ar[$geni]])."',";
			//}
			
			//$concatenacampos=substr($concatenacampos,0,-1);
			//$valores_g=substr($valores_g,0,-1);
			
			//$sql_data="INSERT INTO rose_tfdata (".$concatenacampos.") VALUES (".$valores_g.");";
			
		//	echo $sql_data."<br><br>";
			
			//$rs_data = $DB_gogess->Execute($sql_data);
			
			//if(!($rs_data))
			//{
			//echo $row."=".$sql_data."<br><br>";
			//}
			
			//$datos=array();
			// echo $yr." ".$qtr." ".$wk." ".$region." ".$packer." ".$sltrdate." ".$tattoo." ".$pdhd." ".$avgcwt." ".$lot."<br>";
			
		}
		
		
		   //print_r(@$datos);
		   
		   for($i=0;$i<count(@$datos);$i++)
		   {
		   
		      
			  $busca_concidencias="select * from lpin_plancuentas where planc_codigoc='".@$datos[$i]["A"]."'";			  
			  $rs_coincidencia = $DB_gogess->executec($busca_concidencias);
			  
			  echo $rs_coincidencia->fields["planc_codigoc"]." ".$rs_coincidencia->fields["planc_nombre"]." --> Nuevo:".@$datos[$i]["A"]." ".@$datos[$i]["B"]."<br><br>";
		   
		   
		   }
		   
		
	  
}	  
?>