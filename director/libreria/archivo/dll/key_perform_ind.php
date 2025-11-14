<?php
//$target_path='201611 nc nov.csv';
// vacia data

$vaciar="delete from file_kpi where kpi_archivo='".trim($nombre_archivo)."'";
$rs_vaciar = $DB_gogess->Execute($vaciar);
//

$arreglo_guarda=array();
if (file_exists($target_path)) {


$fp = fopen($target_path, "r");
$contador=0;	
$i=0;
	while(!feof($fp)) {
	
				$linea = fgets($fp);
			    $linea_separada=array();
			    $linea_separada=explode(",",$linea);
	            if(trim($linea_separada[0])!='')
				{
				//print_r($linea_separada);
				//----------------------------------------------------
				//echo $linea;
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
		   
		                  if($linea_separada[0]=='"Farm"')
						  {
						    $lista_farm=$linea_separada;
							//print_r($lista_farm);
						  }
						  
						  if( $contador>=5)
						  {
						  
						   if(count($linea_separada)==1)
						   {
						     $arreglo_guarda["kpi_groupvar"]=str_replace('"','',$linea_separada[0]);
							 $arreglo_guarda["kpi_valores"]=array();
						   }
						   
						   if(count($linea_separada)>1)
						   {
						   
						    
							 
							  $arreglo_guarda["kpi_valores"]=$linea_separada;
							 
						   
						   
						   }
						  
						  }
				//echo $linea_separada[0];
				 
				 if(count(@$arreglo_guarda["kpi_valores"])>2)
				 {
				 //print_r($arreglo_guarda);
				 
				 
				 for($ti=1;$ti<count($arreglo_guarda["kpi_valores"]);$ti++)
				 {
				    
					
					
					$inserta_data="insert into file_kpi (kpi_regio,kip_dateexp,kip_between,kpi_groupvar,kpi_var,kpi_farm,kpi_value,kpi_fecha,kpi_archivo) values ('".preg_replace("/[\n|\r|\n\r]/",'',$arreglo_guarda["kpi_regio"])."','".preg_replace("/[\n|\r|\n\r]/",'',$arreglo_guarda["kip_dateexp"])."','".preg_replace("/[\n|\r|\n\r]/",'',$arreglo_guarda["kip_between"])."','".preg_replace("/[\n|\r|\n\r]/",'',$arreglo_guarda["kpi_groupvar"])."','".preg_replace("/[\n|\r|\n\r]/",'',str_replace('"','',$arreglo_guarda["kpi_valores"][0]))."','".preg_replace("/[\n|\r|\n\r]/",'',str_replace('"','',$lista_farm[$ti]))."','".preg_replace("/[\n|\r|\n\r]/",'',$arreglo_guarda["kpi_valores"][$ti])."','".date("Y-m-d")."','".trim($nombre_archivo)."');";
				    
					
/*$fp2 = fopen("fichero.txt", "w");
fputs($fp2, $inserta_data);
fclose($fp2);*/
                    $rs_insertadata = $DB_gogess->Execute($inserta_data);
					
				 }
				 
				 
				 
				 }
				 
				 $contador++;
				//----------------------------------------------------
				
		        }
		 
		  
		//  print_r($arreglo_guarda);
	
	}


}
else
{
echo "El fichero  no existe";
}

?>