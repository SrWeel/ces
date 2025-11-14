<?php
class formatoxml{
var $dato;
var $formatoporcampo;
var $xmlactivo;
function consulatdatos($sql,$tablas,$formatoxmlreg,$formatofichero)
{
 //Desplegando datos
  $selecTabla=$sql;    
  $resultado = mysql_query($selecTabla);
  $ncampos=mysql_num_fields($resultado);
  
  list($inicio, $fin) = split('-', $formatoxmlreg);
  list($iniciof, $finf) = split('-', $formatofichero);
  
  echo $iniciof;
  while($row = mysql_fetch_array($resultado)) 
			{	
			  echo $inicio;
			   for ( $i = 0 ; $i < $ncampos ; $i ++) {
				
				$nombrecampo=mysql_field_name($resultado,$i);				
				$tablacampo=mysql_field_table($resultado, $i);
						
				//ver formato xml de cada campo
				$this->transformacampo($tablacampo,$nombrecampo);
				if ($this->xmlactivo==1)
				{
				  list($inicioc, $finc) = split('-',$this->formatoporcampo);
				  echo $inicioc;
				  
				  if (trim($this->valor)=='replace')
				  {
				   $deplieguedatoenl=$this->replace_cmb($this->tablacmb,$this->fieldcmb,$this->sqlextra,$row[$i]);
				   echo $deplieguedatoenl;
				  }
				  else
				  {
				  echo $row[$i];
				  }
				  
				  echo $finc;
				}
				//fin ver formato xml de cada campo
				
				$nombrecampo="";
				
				}
			  echo $fin;
			}
 	 echo  $finf;		
 //Fin desplegar datos
}
function transformacampo($tabla,$campo)
{

$sqlformato="select * from gogess_sisfield where fie_name like '".trim($campo)."' and  tab_name like '".trim($tabla)."'";
$this->xmlactivo="";
$this->formatoporcampo="";
$resultadocmp = mysql_query($sqlformato);
  		while($rowcmp = mysql_fetch_array($resultadocmp)) 
			{	
			   $this->xmlactivo=$rowcmp["fie_xmlactivo"];			   
			   if ($rowcmp["fie_xmlactivo"]==1)
			   {
			     $this->formatoporcampo=$rowcmp["fie_xmlformato"];
				 $this->tablacmb=$rowcmp["fie_tabledb"];
				 $this->fieldcmb=$rowcmp["fie_datadb"];
				 $this->sqlextra=$rowcmp["fie_sql"];
				 $this->valor=$rowcmp["fie_value"];	 			 
				 	
			   }
			   
			}



}


function replace_cmb($tablecmb,$fieldcmb,$sql,$valorbus)
{
  if ($sql)
  {
  $oprb= strchr ($sql,'like');
 if ($oprb=='like')
 {
	  if ($this->fie_sqlconexiontabla)
	  {
    $selecTabla="select ".$fieldcmb." from ".$tablecmb." ".$sql." '".$valorbus."'"." and ".$this->fie_sqlconexiontabla;  
		}
		else
		{
	$selecTabla="select ".$fieldcmb." from ".$tablecmb." ".$sql." '".$valorbus."'";  	
		}
 }
 else
 {
   	  if ($this->fie_sqlconexiontabla)
	  {
 	 $selecTabla="select ".$fieldcmb." from ".$tablecmb." ".$sql.$valorbus." and ".$this->fie_sqlconexiontabla;  
	  }
	  else
	  {
	 $selecTabla="select ".$fieldcmb." from ".$tablecmb." ".$sql.$valorbus;  
	  }
 } 

  $resultado = mysql_query($selecTabla);
  if ($resultado)
  {
  		while($row = mysql_fetch_array($resultado)) 
			{	
                return $row[1]." ".$row[2]." ".$row[3]." ".$row[4]." ".$row[5];
			}   
   }
  }		
}



}

?>