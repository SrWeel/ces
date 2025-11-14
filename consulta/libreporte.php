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
			function form_format_field($table,$field,$conn)
			{
			  
			  
			$selecTabla="select * from gogess_sistable,gogess_sisfield where gogess_sistable.tab_name = gogess_sisfield.tab_name and gogess_sisfield.fie_name like '".$field."' and gogess_sistable.tab_name like '".$table."'";   
  
  
  
        $rs_gogessform = $conn->executec($selecTabla,array());
     	while (!$rs_gogessform->EOF) {	
		
		      //de campo
		        @$this->field_type=trim($rs_gogessform->fields[$this->maymin("field_type")]);
				@$this->field_flags=trim($rs_gogessform->fields[$this->maymin("field_flags")]);
			  //de campo				
				
				@$this->campo_tipo=trim($rs_gogessform->fields[$this->maymin("tab_tipocampoprimariio")]);
				@$this->campo_tiporeporte=trim($rs_gogessform->fields[$this->maymin("fie_type")]);
				@$this->campo_titulo=trim($rs_gogessform->fields[$this->maymin("fie_title")]);
				
				@$this->campo_cmbtabla=trim($rs_gogessform->fields[$this->maymin("fie_tabledb")]);
				@$this->campo_cmbtcampo=trim($rs_gogessform->fields[$this->maymin("fie_datadb")]);

               @$this->campo_value=trim($rs_gogessform->fields[$this->maymin("fie_value")]);
			   @$this->campo_cmbsql=trim($rs_gogessform->fields[$this->maymin("fie_sql")]);
			   
			    @$this->campo_campoafecta=trim($rs_gogessform->fields[$this->maymin("fie_campoafecta")]);
				@$this->campo_camporecibe=trim($rs_gogessform->fields[$this->maymin("fie_camporecibe")]);
			   
			   @$this->tab_name=trim($rs_gogessform->fields[$this->maymin("tab_name")]);
			   	
				
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
	
	function gridtabla($listacampos,$sqldatos,$sqldatoscompleto,$conn)
	{
	  $listacampos=explode(",",$listacampos);
	  //print_r($listacampos);
	   $i=0;
				   while ($i < count($listacampos)) 
     	   			{
					  	//echo $listacampos[$i]."<br>";
						$campotabla=explode(".",$listacampos[$i]);
						
						$verifica_alias=explode(" as ",$campotabla[1]);
						
						if(count($verifica_alias)>1)
						{
						  $ncampo_data=$verifica_alias[1];
						  $ncamp_budata=$verifica_alias[0];
						}
						else
						{
						  $ncampo_data=$campotabla[1];
						  $ncamp_budata=$campotabla[1];
						}
						
				 		$this->form_format_field($campotabla[0],$ncamp_budata,$conn);	
						
							$this->arrcampos[]=$ncampo_data;							
							$titulocampo=str_replace(":","",$this->campo_titulo);
							$this->arrcamposn[]=$titulocampo;									
						
						$i++;
					}	
					
					
					//print_r($this->arrcampos);
		///////////////lista datos///////////////////////
	
			   $resultdatos = $conn->executec($sqldatos,array());
			   
			   
			   $resultdatoscompleto = $conn->executec($sqldatoscompleto,array());
			  // echo $sqldatoscompleto;
			   if($resultdatoscompleto)
			   {
			    $n_registros  = $resultdatoscompleto->RecordCount();
				}
				 				  
				   $this->totalreg=$n_registros;
				   @$this->total_paginas = ceil($n_registros / $this->desplegar); 
			   
			   if ($resultdatos)
			   {
				 while (!$resultdatos->EOF)  
					{
				 		$this->filas[]=$resultdatos->fields;
						
						@$k++;
						$resultdatos->MoveNext();
				    }					
					//print_r($filas);
			   }
		//Fin sql de consulta
					
	}
	
function textorraro($texto) {
				  $s = trim($texto);
				 
				  return $s;
				 }			
function replace_cmb($tablecmb,$fieldcmb,$sql,$valorbus,$conn)
{

  // echo $fieldcmb;
	$buscawhere=strstr(@$this->fie_sqlorder,'where');
	if($buscawhere)
  {
   $this->fie_sqlorder='';
  }
  
 
  if ($sql)
  {
  $oprb= trim(strchr ($sql,'like'));
 
 if ($oprb=='like')
 {
	  if (@$this->fie_sqlconexiontabla)
	  {
    $selecTabla="select ".$fieldcmb." from ".$tablecmb." ".$sql." '".$valorbus."'"." and ".@$this->fie_sqlconexiontabla." ".@$this->fie_sqlorder;  
		}
		else
		{
	  $selecTabla="select ".$fieldcmb." from ".$tablecmb." ".$sql." '".$valorbus."'"." ".@$this->fie_sqlorder."";  	
		}
 }
 else
 {
   	  if (@$this->fie_sqlconexiontabla)
	  {
 	 $selecTabla="select ".$fieldcmb." from ".$tablecmb." ".$sql.$valorbus." and ".@$this->fie_sqlconexiontabla." ".@$this->fie_sqlorder;
	  }
	  else
	  {
	 $selecTabla="select ".$fieldcmb." from ".$tablecmb." ".$sql.$valorbus." ".@$this->fie_sqlorder; 
	  }
 } 

//echo $selecTabla;
  $rs_cmb = $conn->executec($selecTabla,array());
  
  if ($rs_cmb)
  {
  		while (!$rs_cmb->EOF) {
		
		       
			   
			   $scacampos=explode(",",$fieldcmb);
			  
			   
			   for($ij=1;$ij<count($scacampos);$ij++)
			   {
			     
				 @$textvalor=$textvalor.$rs_cmb->fields[$scacampos[$ij]]." ";
			   
			   }
			   
                return trim($this->textorraro($textvalor));
				
				
				$rs_cmb->MoveNext();
			}   
   }
  }		
}



function fill_cmb($tablecmb,$fieldcmb,$vbus,$orden,$conn)

{

 // $this->fie_sqlconexiontabla=$row[fie_sqlconexiontabla];

 if (trim(@$this->fie_sqlconexiontabla)) 

 {

  $selecTabla="select distinct ".$fieldcmb." from ".$tablecmb." where ".$this->fie_sqlconexiontabla." ".$orden;

 }

  else

 {

  $selecTabla="select distinct ".$fieldcmb." from ".$tablecmb." ".$orden;

 }



  $conn->funciones_ADODB_FETCH_NUM();

  $rs_fill = $conn->executec($selecTabla,array());

  

  if($rs_fill)

  {

  		while (!$rs_fill->EOF) {

	

               $fld=$rs_fill->FetchField(0);

			   $tipocampo =$rs_fill->MetaType($fld->type);

              

		       $textvalor='';

			   for($ij=1;$ij<count($rs_fill->fields);$ij++)

			   {

			     

				 $textvalor=$this->textorraro($textvalor.$rs_fill->fields[$ij]." - ");

			   

			   }

			  



           if ($tipocampo=='C')

             {                  



               if ($rs_fill->fields[0]== $vbus)

                {  

                   echo "<option value='".$rs_fill->fields[0]."' selected>".$textvalor."</option>";

                }

               else

                 {

					

					echo "<option value='".$rs_fill->fields[0]."' >".$textvalor."</option>";

					

                 }

              }

            else 

              {

               if ($rs_fill->fields[0]== $vbus)

                {  

                   

				   echo "<option value='".$rs_fill->fields[0]."' selected>".$textvalor."</option>";

				   

                }

               else

                 {

					

					echo "<option value='".$rs_fill->fields[0]."' >".$textvalor."</option>";

					

                 }

              }

			

			$rs_fill->MoveNext();



             }  

   

    }

	$conn->funciones_ADODB_FETCH_ASSOC();



}



	
}

?>