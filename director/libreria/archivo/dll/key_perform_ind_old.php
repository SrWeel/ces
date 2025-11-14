<?php
$target_path='201611 nc nov.csv';

$fp = fopen($target_path, "r");
$contador=0;	
	while(!feof($fp)) {
	
				$linea = fgets($fp);
			    $linea_separada=array();
			    $linea_separada=explode(",",$linea);

	     // print_r($linea_separada);
		  
		  if($contador==1)
		  {
		    $arreglo_guarda["kpi_regio"]=$linea_separada[0];
		  
		  }
		  
		  if($contador==2)
		  {
		   $arreglo_guarda["kip_dateexp"]=$linea_separada[0];
		   }
		   
		  if($contador==3)
		  {
		   $arreglo_guarda["kip_between"]=$linea_separada[0];
		   }
		   
		   
		  if($contador==6)
		  {
		  // $arreglo_guarda["kip_between"]=$linea_separada[0];
		   $lista_farm=$linea_separada;
		 //  print_r($lista_farm);
		    }
			
			 if($contador==8)
		  {
		   $arreglo_guarda["kpi_groupvar"]=$linea_separada[0];
		  }
			
		if($contador>=10)
		  {
		   echo '------------------------';
			  for($i=0;$i<count($linea_separada)-1;$i++)
			  {
			 
			  $arreglo_guarda[$i]=$linea_separada[$i];
			  
			  }
		   echo '------------------------';
		  
		  }
			
		  $contador++;
		  
		  print_r($arreglo_guarda);
	
	}


?>