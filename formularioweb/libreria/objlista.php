<?php
class listagrid{


		function despliegalista($sql,$funcionlink,$titulolink,$anchotabla,$objformulario,$csstitulo,$csslista,$csslink,$cssborde,$colortitulos,$colorlistas,$sessid)
		{
		////////////////////////////////////////////////////////////////////////
			echo '<div class="'.$cssborde.'"><table width="'.$anchotabla.'" cellspacing="2">'; 
			$header = false;
			$comillas="'";
			$icampo=0;
			$resultadobarra = mysql_query($sql);
			while ($row = mysql_fetch_array($resultadobarra)) {
			///while 1
                 // Encabezado Tabla
				if (!$header) {			   
					echo '<tr class="header" >';
				    echo '<th  nowrap="nowrap" class='.$csstitulo.' bgcolor="'.$colortitulos.'" >Link</th>';
					for ($i = 1; ($i + 1) <= mysql_num_fields($resultadobarra); ++$i) {					
					//Saca el titulo del campo
						$table = mysql_field_table($resultadobarra, $i);
						$field = mysql_field_name($resultadobarra, $i);
						$buscadatos="select * from iba_sistable,iba_sisfield where iba_sistable.tab_name = iba_sisfield.tab_name and iba_sistable.tab_name like '".$table."' and fie_name like '".$field."' and fie_active=1";
						$resultadobu = mysql_query($buscadatos);
						if($resultadobu)
						{
							while($rowbu = mysql_fetch_array($resultadobu)) 
							{	
								$titulotxt= $rowbu["fie_title"];
							}
						}									
					//Saca el titulo del campo
					
					//Campos para busqueda
					
					     $objformulario->form_format_field($table,$field);		  
						 $selecSql="select ".$field." from `".$table."`";      
						  $resultadoSql = mysql_query($selecSql); 
						  if($resultadoSql) 
						  {
						  $typeSql  = mysql_field_type  ($resultadoSql, 0);
						  }						  
						   $nombre_campo=$field;		
						 
					
					//Campos para busqueda
					$completar='';
					if($icampo>=1)
					{
					if (strlen($titulotxt)<=40)
					{
					   $espacioag=50-strlen($titulotxt);
					   for($ic=0;$ic<=$espacioag;$ic++)
					   {
						 $completar=$completar."_";
					   }
					}
					}
					   echo '<th  nowrap="nowrap" class='.$csstitulo.' bgcolor="'.$colortitulos.'" >';
				  echo str_replace(':','',$titulotxt);
					  }
					 
					   
					   echo '</th>';
					   
					   $icampo++;
					
					}			
					echo '</tr>  </thead> <tbody>';		
					$header = true;
					
					 //creando insercion de datos
					echo '<tr >';
					echo '<td onclick="agregar_detalle('.$comillas.$row[0].$comillas.','.$comillas.$sessid.$comillas.')" class="'.$csslink.'"  nowrap="nowrap"  bgcolor="'.$colorlistas.'" >'.$titulolink.'</td>';
                    
					//creando insercion de datos 
 
    for ($i = 1; ($i + 1) <= mysql_num_fields($resultadobarra); ++$i) {
     //for dos   

                      //Saca el titulo del campo
							$table = mysql_field_table($resultadobarra, $i);
							$field = mysql_field_name($resultadobarra, $i);
							$buscadatos="select * from iba_sistable,iba_sisfield where iba_sistable.tab_name = iba_sisfield.tab_name and iba_sistable.tab_name like '".$table."' and fie_name like '".$field."' and fie_active=1";
							$resultadobu = mysql_query($buscadatos);
							if($resultadobu)
							{
								while($rowbu = mysql_fetch_array($resultadobu)) 
								{	
									$titulotxt= $rowbu["fie_title"];
									$fie_value= $rowbu["fie_value"];
									$fie_tabledb= $rowbu["fie_tabledb"];
									$fie_datadb= $rowbu["fie_datadb"];
									$fie_sql= $rowbu["fie_sql"];
									
									$fie_type= $rowbu["fie_type"];
								}
							}
						//Saca el titulo del campo
						
						if ($fie_value=='replace')
						{
						  $rmp= $objformulario->replace_cmb($fie_tabledb,$fie_datadb,$fie_sql,$row[$i]); 						  
						  if (strlen($rmp) > 50)
								{
								
								   $rmp=substr($rmp, 0, 50)."...";
								}
							
						}
						else
						{
							if($fie_type=='txtarchivo')
							{
								  if($row[$i])
								  {
								  $rmp='<a href="'.$row[$i].'" target="_blank" ><img src="imgtxtarchivo/descarga.jpg" width="20" height="21" border="0"></a>';
								  }
								  else
								  {
								  $rmp='';							  
								  }
							 }
						  	else
						    {
						     $rmp=$row[$i];
							  if (strlen($rmp) > 40)
								{
								
								   $rmp=substr($rmp, 0, 40)."...";
								}
						  
						    }
						}
						
						
						
							if(!($rmp))
							{
							   $rmp=0;
							}
						
                           $klm++;
 

	
	   echo '<td  nowrap="nowrap"  class="'.$csslista.'"  bgcolor="'.$colorlistas.'" ><div id="txtHint_cambio'.$klm.'"><div  onclick="funcionmodificar('.$klm.','.$comillas.$field.$comillas.','.$comillas.$row[0].$comillas.','.$comillas.$table.$comillas.','.$comillas.'adu_id'.$comillas.')" >'.$rmp. '</div></div></td>';
	//for dos 
        }
			  echo '</tr>';		
			///while 1		
			}	
				
		echo '</tbody></table></div>';		
				
		///////////////////////////////////////////////////////////////////////////////
		}


}


?>