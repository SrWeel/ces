<?php
class listadogrid{
var $tabla;
var $campofiltro;
var $desplegar;
var $filas;
var $id_inicio;
var $campoorden;
var $forden;

var $campo;
var $obp;
var $listab;

function maymin($txt)
{
   return $txt;
}


//Datos de la tabla
function form_format_tabla($table)
			{
			  $selecTabla="select * from sibase_sistable where  sibase_sistable.tab_name like '".$table."'"; 
			  $rs_grid = $DB_gogess->Execute($selecTabla); 

			  
				 if($rs_grid)
				 {
						while (!$rs_grid->EOF) 
						{										
							$this->tab_name=$rs_grid->fields[maymin("tab_name")];
							$this->tab_title=$rs_grid->fields[maymin("tab_title")];
							$this->tab_information=$rs_grid->fields[maymin("tab_information")];
							$this->tab_bextras=$rs_grid->fields[maymin("tab_bextras")];
							
							$this->tab_datosf=$rs_grid->fields[maymin("tab_datosf")];				
							$this->tab_scriptguardar=$rs_grid->fields[maymin("tab_valextguardar")];		
							$this->tab_archivo=$rs_grid->fields[maymin("tab_archivo")];	
							$this->tab_formatotabla=$rs_grid->fields[maymin("tab_formatotabla")];	
							$rs_grid->MoveNext();
					   }
				}	   
					   
					   	
			}
//Fin datos de la tabla
//Datos de cada campo
			function form_format_field($table,$field,$DB_gogess)
{
  $selecTabla="select * from sibase_sisfield where sibase_sisfield.fie_name like '".$field."' and sibase_sisfield.tab_name like '".$table."' and fie_active=1";   
  
  
  
  $rs_gogessform = $DB_gogess->Execute($selecTabla);
     	while (!$rs_gogessform->EOF) {
						
				$this->tab_name=$rs_gogessform->fields[$this->maymin("tab_name")];				
				$this->fie_name=$rs_gogessform->fields[$this->maymin("fie_name")];
				$this->tab_datosf=$rs_gogessform->fields[$this->maymin("tab_datosf")];				
				$this->fie_title=$rs_gogessform->fields[$this->maymin("fie_title")];
				$this->fie_type=$rs_gogessform->fields[$this->maymin("fie_type")];
				$this->fie_style=$rs_gogessform->fields[$this->maymin("fie_style")];
				$this->fie_value=$rs_gogessform->fields[$this->maymin("fie_value")];
				$this->fie_tabledb=$rs_gogessform->fields[$this->maymin("fie_tabledb")];
				$this->fie_datadb=$rs_gogessform->fields[$this->maymin("fie_datadb")];
				$this->fie_active=$rs_gogessform->fields[$this->maymin("fie_active")];				
				$this->fie_attrib=$rs_gogessform->fields[$this->maymin("fie_attrib")];
				$this->fie_activesearch=$rs_gogessform->fields[$this->maymin("fie_activesearch")];
				$this->fie_obl=$rs_gogessform->fields[$this->maymin("fie_obl")];
				$this->fie_sql=$rs_gogessform->fields[$this->maymin("fie_sql")];
				$this->fie_group=$rs_gogessform->fields[$this->maymin("fie_group")];
				$this->fie_sendvar=$rs_gogessform->fields[$this->maymin("fie_sendvar")];
				$this->fie_tactive=$rs_gogessform->fields[$this->maymin("fie_tactive")];
				$this->fie_lencampo=$rs_gogessform->fields[$this->maymin("fie_lencampo")];
				$this->fie_txtextra=$rs_gogessform->fields[$this->maymin("fie_txtextra")];
				$this->fie_valiextra=$rs_gogessform->fields[$this->maymin("fie_valiextra")];
				$this->fie_txtizq=$rs_gogessform->fields[$this->maymin("fie_txtizq")];
				$this->fie_lineas=$rs_gogessform->fields[$this->maymin("fie_lineas")];
				$this->fie_tabindex=$rs_gogessform->fields[$this->maymin("fie_tabindex")];
				$this->fie_activarprt=$rs_gogessform->fields[$this->maymin("fie_activarprt")];
				$this->fie_verificac=$rs_gogessform->fields[$this->maymin("fie_verificac")];
				$this->fie_tablac=$rs_gogessform->fields[$this->maymin("fie_tablac")];
				$this->fie_sqlorder=$rs_gogessform->fields[$this->maymin("fie_sqlorder")];				
				$this->fie_styleobj=$rs_gogessform->fields[$this->maymin("fie_styleobj")];
				$this->fie_naleatorio=$rs_gogessform->fields[$this->maymin("fie_naleatorio")];
				$this->fie_sqlconexiontabla=$rs_gogessform->fields[$this->maymin("fie_sqlconexiontabla")];
				$this->fie_activelista=$rs_gogessform->fields[$this->maymin("fie_activelista")];
				$this->fie_campoafecta=$rs_gogessform->fields[$this->maymin("fie_campoafecta")];
				$this->fie_camporecibe=$rs_gogessform->fields[$this->maymin("fie_camporecibe")];
				$this->fie_inactivoftabla=$rs_gogessform->fields[$this->maymin("fie_inactivoftabla")];
				
				
				$this->fie_evitaambiguo=$rs_gogessform->fields[$this->maymin("fie_evitaambiguo")];
				$bandera=$rs_gogessform->fields[$this->maymin("fie_name")];
				//Verifcar enlace
				if ($this->fie_verificac and $this->contenid[$this->fie_name])
				{
				  $partes = explode("-",$this->fie_tablac); 				  
				  $subparte1=explode(",",$partes[0]);
				  $subparte2=explode(",",$partes[1]);
				  $total1=count($subparte1);
				  $total2=count($subparte2);
				  //Recorriedo tablas extras anexadas
				  for ($ib = 0; $ib < $total1; $ib++) {
				    
                     $sqlenl="select * from ".$subparte1[$ib]." where ".$this->fie_name ." like '".$this->contenid[$this->fie_name]."'";						 
					 $rs_resultenl = $DB_gogess->Execute($sqlenl);	
					 $num_rows = $rs_resultenl->RecordCount();//numero campos
                     if ($num_rows>0)
					 {
					   $this->fie_type="hidden2";
					   $ib=$total1;					  
					 }
					  
                  }				  
				  
				}
                     
				$rs_gogessform->MoveNext();	            
			}
			   
  if ($bandera)
  {
        return 1;
  }
  else
  {
        return 0;
   }
}

//Fin datos de cada campo

//Tabla grid de despliegue
		function gridtabla($DB_gogess)
		{
		
			$sqltabla="select * from ".$this->tabla." limit 1";  
			
			$rs_grt = $DB_gogess->Execute($sqltabla);
			 if ($rs_grt)
			   {
			       $ncampos = $rs_grt->FieldCount();	   
				   
				   $i=0;
				   while ($i < $ncampos) 
     	   			{
					  	$fld=$rs_grt->FetchField($i);
	                    $nombre_campo=strtolower($fld->name);
						
				 		$this->form_format_field($this->tabla,$nombre_campo,$DB_gogess);	
						if ($this->fie_activelista)
						{
							$this->arrcampos[]=$nombre_campo;							
							$titulocampo=str_replace(":","",$this->fie_title);
							$this->arrcamposn[]=$titulocampo;									
						}
						$i++;
					}	
			   }
			   //Creando sql de consulta

           if(!($this->listab))
		   {
					 ////////////////////////////////
					  if ($this->campoorden)
					  {
						if($this->forden==1)
						{
						 //$datos="select * from ".$this->tabla." order by ".$this->campoorden." asc limit ".$this->id_inicio.",".$this->desplegar;	
						 $datos="select * from ".$this->tabla." order by ".$this->campoorden." asc ";
						 $datoscompleto="select * from ".$this->tabla." order by ".$this->campoorden." asc ";	
						}
						else
						{
						 //$datos="select * from ".$this->tabla." order by ".$this->campoorden." desc limit ".$this->id_inicio.",".$this->desplegar;
						 $datos="select * from ".$this->tabla." order by ".$this->campoorden." desc ";	
						 $datoscompleto="select * from ".$this->tabla." order by ".$this->campoorden." desc ";	
						} 		  
					  }
					  else
					  {
					   //$datos="select * from ".$this->tabla." limit ".$this->id_inicio.",".$this->desplegar;	
					   $datos="select * from ".$this->tabla;	
					   $datoscompleto="select * from ".$this->tabla;
					  }
					 ///////////////////////////////////// 
			  }
			  else
			  {
			        /////////////////////////////////////	
					 if ($this->obp=='num')
						{
						   $obpd='=';
						}
					     else
						{
						   $obpd='like ';
						}
						
					 if ($this->obp=='=')
						   {
						     $comillas=" ";
						   }
						   else
						   {
						     $comillas="'";
						   }
					  if ($this->campoorden)
					  {
						if($this->forden==1)
						{
						// $datos="select * from ".$this->tabla." where ".$this->campo." ".$obpd.$comillas.$this->listab.$comillas." order by ".$this->campoorden." asc limit ".$this->id_inicio.",".$this->desplegar;
						 
						 
						 $datos="select * from ".$this->tabla." where ".$this->campo." ".$obpd.$comillas.$this->listab.$comillas." order by ".$this->campoorden." asc ";	
						 $datoscompleto="select * from ".$this->tabla." where ".$this->campo." ".$obpd.$comillas.$this->listab.$comillas." order by ".$this->campoorden." asc ";	
						}
						else
						{
						 //$datos="select * from ".$this->tabla." where ".$this->campo." ".$obpd.$comillas.$this->listab.$comillas." order by ".$this->campoorden." desc limit ".$this->id_inicio.",".$this->desplegar;
						 
						 $datos="select * from ".$this->tabla." where ".$this->campo." ".$obpd.$comillas.$this->listab.$comillas." order by ".$this->campoorden." desc ";	 	
						 $datoscompleto="select * from ".$this->tabla." where ".$this->campo." ".$obpd.$comillas.$this->listab.$comillas." order by ".$this->campoorden." desc ";	
						} 		  
					  }
					  else
					  {
					   //$datos="select * from ".$this->tabla." where ".$this->campo." ".$obpd.$comillas.$this->listab.$comillas." limit ".$this->id_inicio.",".$this->desplegar;	
					   $datos="select * from ".$this->tabla." where ".$this->campo." ".$obpd.$comillas.$this->listab.$comillas." ";		
					   $datoscompleto="select * from ".$this->tabla." where ".$this->campo." ".$obpd.$comillas.$this->listab.$comillas;		
					  }
					/////////////////////////////////////			  
			  }
			  
			
			//echo $datos;
			  // 	echo $this->id_inicio."<br>";
				//echo $this->desplegar."<br>";   
			   	   
			   $resultdatos = $DB_gogess->SelectLimit($datos,$this->desplegar,$this->id_inicio);
			   
			   
			  
			   			   
			   
			   $resultdatoscompleto = $DB_gogess->Execute($datoscompleto);
				
				$n_registros = $resultdatoscompleto->RecordCount();
								  
				   $this->totalreg=$n_registros;
				   $this->total_paginas = ceil($n_registros / $this->desplegar); 
			   
			   if ($resultdatos)
			   {
				 while((!$resultdatos->EOF) and ($k<$this->desplegar)) 
					{
				 		//print_r($resultdatos->fields);
						$this->filas[]=$resultdatos->fields;
						
						
				 		$k++;
						$resultdatos->MoveNext();
						//echo $k."<br>";
				    }					
					//print_r($this->filas);
			   }
			   //Fin sql de consulta
			   
			   
		}
//Fin tabla grid de despliegue

}

?>