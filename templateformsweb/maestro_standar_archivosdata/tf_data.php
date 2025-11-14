<?php
      require_once "Classes/PHPExcel.php";
	   
     //echo $target_path="./files/".trim($rs_files->fields["source_file"]);
	  $target_path="../../../../files/".trim($rs_files->fields["source_file"]);
	  $url = $target_path;
	  $filecontent = file_get_contents($url);
	  $tmpfname = tempnam(sys_get_temp_dir(),"tmpxls");
	  file_put_contents($tmpfname,$filecontent);
	  
	    $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
		$excelObj = $excelReader->load($tmpfname);
		$worksheet = $excelObj->getSheet(0);
		$lastRow = $worksheet->getHighestRow();
		//verificar este punto aqui estaba >= 2019  29_05_2019
		 if($_POST["year_id"]>=2018)
		{
		//$array_letra = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB", "AC", "AD","BC");
		$array_letra = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB", "AC", "AD","AE","AF","AG","BF");
		}
		else
		{
		$array_letra = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB", "AC", "AD", "AE","BD");
		
		}
		
		
		//print_r($array_letra);
		
		//$sql_inserta="INSERT INTO rose_tfdata (tfd_id, tfd_yr, tfd_qtr, tfd_wk, tfd_region, tfd_packer, tfd_sltrdate, tfd_tattoo, tfd_pdhd, tfd_avgcwt, tfd_lot, tfd_cut, tfd_sex, tfd_lean, tfd_totalbase, tfd_totaldeducts, tfd_totalcarwt, tfd_site, tfd_sp, tfd_bluestem, tfd_hdless160, tfd_hd160higequtolessequ180, tfd_hdhigequ270, tfd_hddoa, tfd_hdkoa, tfd_hddip, tfd_hddead, tfd_hdcondemned, tfd_hdsub_rsl, tfd_hdrslhigequ351, tfd_avglivewtswift) VALUES (NULL, '1', '1', '1', '1', '1', '2018-02-09', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');";
		
		
		
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
		
		$numero_camposdata=0;
		$ar = $DB_gogess->metaColumnNames($rs_file_process->fields["sorload_tabledestination"],true);
        //print_r($ar);
        if($_POST["year_id"]>=2018)
		{
	    //array_splice($ar, 19, 1); para 2017
		array_splice($ar, 20, 1);
		
		}
	    //print_r($ar);
		
		
		
	    $numero_camposdata=count($ar);
	    
		//$lastRow	 
		for ($row = 2; $row <= $lastRow; $row++) {
			 
			
			for ($ilet=1;$ilet<count($array_letra);$ilet++)
			{
			 
			  
			  //-----------------------------------------------
			  @$datos[$ar[$ilet]] ='';
			  $valorfecha='';
			  if(@$ar[$ilet]=='tfd_sltrdate')
			  {
			   $valorfecha=$worksheet->getCell($array_letra[$ilet].$row)->getValue();
			   $datos[$ar[$ilet]] = PHPExcel_Style_NumberFormat::toFormattedString($valorfecha, "YYYY-MM-DD");
			  }
			  else
			  {
			      @$datos[$ar[$ilet]]=$worksheet->getCell($array_letra[$ilet].$row)->getCalculatedValue();
				  if(@$datos[$ar[$ilet]]=='')
				  {
				  @$datos[$ar[$ilet]]='0';
				  }
			  
			  }
			  //---------------------------------------------
			  
			  
			}
			
		    
			
			$concatenacampos='';
			$valores_g='';
			for($geni=1;$geni<$numero_camposdata;$geni++)
			{
			
			   $concatenacampos.=$ar[$geni].",";
			   $valores_g.="'".str_replace("'","\'",$datos[$ar[$geni]])."',";
			}
			
			$concatenacampos=substr($concatenacampos,0,-1);
			$valores_g=substr($valores_g,0,-1);
			$sql_data="INSERT INTO rose_tfdata (".$concatenacampos.") VALUES (".$valores_g.");";
			
		//	echo $sql_data."<br><br>";
			
			$rs_data = $DB_gogess->Execute($sql_data);
			
			if(!($rs_data))
			{
			echo $row."=".$sql_data."<br><br>";
			}
			
			$datos=array();
			// echo $yr." ".$qtr." ".$wk." ".$region." ".$packer." ".$sltrdate." ".$tattoo." ".$pdhd." ".$avgcwt." ".$lot."<br>";
			
		}
		
	  
	  
?>