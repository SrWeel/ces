<?php
class listadoreportegrid{
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
	//Datos de cada campo
			function form_format_field($table,$field,$DB_gogess)
			{
			  
			  
			 $selecTabla="select * from gogess_sistable,gogess_sisfield where gogess_sistable.tab_name = gogess_sisfield.tab_name and gogess_sisfield.fie_name like '".$field."' and gogess_sistable.tab_name like '".$table."' and fie_active=1";   
  
  $rs_gogessform = $DB_gogess->Execute($selecTabla);
     	while (!$rs_gogessform->EOF) {	
		
		      //de campo
		        $this->field_type=trim($rs_gogessform->fields[$this->maymin("field_type")]);
				$this->field_flags=trim($rs_gogessform->fields[$this->maymin("field_flags")]);
			  //de campo				
				$this->tab_name=trim($rs_gogessform->fields[$this->maymin("tab_name")]);
				$this->tab_title=trim($rs_gogessform->fields[$this->maymin("tab_title")]);
				$this->tab_information=trim($rs_gogessform->fields[$this->maymin("tab_information")]);
				$this->tab_bextras=trim($rs_gogessform->fields[$this->maymin("tab_bextras")]);
				$this->fie_name=trim($rs_gogessform->fields[$this->maymin("fie_name")]);
				$this->tab_datosf=trim($rs_gogessform->fields[$this->maymin("tab_datosf")]);				
				$this->fie_title=trim($rs_gogessform->fields[$this->maymin("fie_title")]);
				$this->fie_type=trim($rs_gogessform->fields[$this->maymin("fie_type")]);
				$this->fie_style=trim($rs_gogessform->fields[$this->maymin("fie_style")]);
				$this->fie_value=trim($rs_gogessform->fields[$this->maymin("fie_value")]);
				$this->fie_tabledb=trim($rs_gogessform->fields[$this->maymin("fie_tabledb")]);
				$this->fie_datadb=trim($rs_gogessform->fields[$this->maymin("fie_datadb")]);
				$this->fie_active=trim($rs_gogessform->fields[$this->maymin("fie_active")]);				
				$this->fie_attrib=trim($rs_gogessform->fields[$this->maymin("fie_attrib")]);
				$this->fie_activesearch=trim($rs_gogessform->fields[$this->maymin("fie_activesearch")]);
				$this->fie_obl=trim($rs_gogessform->fields[$this->maymin("fie_obl")]);
				$this->fie_sql=trim($rs_gogessform->fields[$this->maymin("fie_sql")]);
				$this->fie_group=trim($rs_gogessform->fields[$this->maymin("fie_group")]);
				$this->fie_sendvar=trim($rs_gogessform->fields[$this->maymin("fie_sendvar")]);
				$this->fie_tactive=trim($rs_gogessform->fields[$this->maymin("fie_tactive")]);
				$this->fie_lencampo=trim($rs_gogessform->fields[$this->maymin("fie_lencampo")]);
				$this->fie_txtextra=trim($rs_gogessform->fields[$this->maymin("fie_txtextra")]);
				$this->fie_valiextra=trim($rs_gogessform->fields[$this->maymin("fie_valiextra")]);
				$this->fie_txtizq=trim($rs_gogessform->fields[$this->maymin("fie_txtizq")]);
				$this->fie_lineas=trim($rs_gogessform->fields[$this->maymin("fie_lineas")]);
				$this->fie_tabindex=trim($rs_gogessform->fields[$this->maymin("fie_tabindex")]);
				$this->fie_activarprt=trim($rs_gogessform->fields[$this->maymin("fie_activarprt")]);
				$this->fie_verificac=trim($rs_gogessform->fields[$this->maymin("fie_verificac")]);
				$this->fie_tablac=trim($rs_gogessform->fields[$this->maymin("fie_tablac")]);
				$this->fie_sqlorder=trim($rs_gogessform->fields[$this->maymin("fie_sqlorder")]);				
				$this->fie_styleobj=trim($rs_gogessform->fields[$this->maymin("fie_styleobj")]);
				$this->fie_naleatorio=trim($rs_gogessform->fields[$this->maymin("fie_naleatorio")]);
				$this->fie_sqlconexiontabla=trim($rs_gogessform->fields[$this->maymin("fie_sqlconexiontabla")]);
				$this->fie_activelista=trim($rs_gogessform->fields[$this->maymin("fie_activelista")]);
				$this->fie_campoafecta=trim($rs_gogessform->fields[$this->maymin("fie_campoafecta")]);
				$this->fie_camporecibe=trim($rs_gogessform->fields[$this->maymin("fie_camporecibe")]);
				$this->fie_inactivoftabla=trim($rs_gogessform->fields[$this->maymin("fie_inactivoftabla")]);
				
				
				$this->fie_evitaambiguo=trim($rs_gogessform->fields[$this->maymin("fie_evitaambiguo")]);
				$this->fie_activogrid=trim($rs_gogessform->fields[$this->maymin("fie_activogrid")]);
				
				$this->field_maxcaracter=trim($rs_gogessform->fields[$this->maymin("field_maxcaracter")]);
				$this->fie_typereport=trim($rs_gogessform->fields[$this->maymin("fie_typereport")]);
				
				
				
				$rs_gogessform->MoveNext();	            
			}
			   
  if (@$bandera)
  {
        return 1;
  }
  else
  {
        return 0;
   }
			  
			  
			}
//Fin datos de cada campo
	
	function gridtabla($listacampos,$sqldatos,$sqldatoscompleto,$DB_gogess)
	{
	  $listacampos=explode(",",$listacampos);
	  //print_r($listacampos);
	   $i=0;
				   while ($i < count($listacampos)) 
     	   			{
					  	//echo $listacampos[$i]."<br>";
						$campotabla=explode(".",$listacampos[$i]);
						//print_r($campotabla);
				 		$this->form_format_field($campotabla[0],$campotabla[1],$DB_gogess);	
						
							$this->arrcampos[]=$campotabla[1];							
							$titulocampo=str_replace(":","",$this->fie_title);
							$this->arrcamposn[]=$titulocampo;									
						
						$i++;
					}	
					
					
					
		///////////////lista datos///////////////////////
	
			   $resultdatos = $DB_gogess->Execute($sqldatos);
			   
			   $k=0;
			   $resultdatoscompleto = $DB_gogess->Execute($sqldatoscompleto);
			  // echo $sqldatoscompleto;
			   if($resultdatoscompleto)
			   {
			    $n_registros  = $resultdatoscompleto->RecordCount();
				}
				 				  
				   $this->totalreg=$n_registros;
				   if(@$this->desplegar)
				   {
				   @$this->total_paginas = ceil(@$n_registros / @$this->desplegar); 
			       }
			   if ($resultdatos)
			   {
				 while (!$resultdatos->EOF)  
					{
				 		$this->filas[]=$resultdatos->fields;
						
						$k++;
						$resultdatos->MoveNext();
				    }					
					print_r(@$filas);
			   }
		//Fin sql de consulta
					
	}
}

?>