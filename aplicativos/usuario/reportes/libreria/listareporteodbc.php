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

function better_odbc_num_rows($con,$sql){

$sqlparte=split('from',$sql);
$contadoram="select count(*) as total from ".$sqlparte[1];

//echo $contadoram;
    $result = odbc_exec($con,$contadoram);
    $count=0;
    while($temp = odbc_fetch_array($result)){
        $totalreg=$temp[total];
    }
    return $totalreg;
}

	//Datos de cada campo
			function form_format_field($table,$field)
			{
			  $selecTabla="select * from kyradm_sistable,kyradm_sisfield where kyradm_sistable.tab_name = kyradm_sisfield.tab_name and kyradm_sisfield.fie_name like '".$field."' and kyradm_sistable.tab_name like '".$table."' and fie_active=1";    
			  $resultado = mysql_query($selecTabla);
			  if($resultado)
			  {
					while($row = mysql_fetch_array($resultado)) 
						{	
							$this->tab_name=$row[tab_name];
							$this->tab_title=$row[tab_title];
							$this->tab_information=$row[tab_information];
							$this->tab_bextras=$row[tab_bextras];
							$this->fie_name=$row[fie_name];
							$this->tab_datosf=$row[tab_datosf];				
							$this->fie_title=$row[fie_title];
							$this->fie_type=$row[fie_type];
							$this->fie_style=$row[fie_style];
							$this->fie_value=$row[fie_value];
							$this->fie_tabledb=$row[fie_tabledb];
							$this->fie_datadb=$row[fie_datadb];
							$this->fie_active=$row[fie_active];				
							$this->fie_attrib=$row[fie_attrib];
							$this->fie_activesearch=$row[fie_activesearch];
							$this->fie_obl=$row[fie_obl];
							$this->fie_sql=$row[fie_sql];
							$this->fie_group=$row[fie_group];
							$this->fie_sendvar=$row[fie_sendvar];
							$this->fie_tactive=$row[fie_tactive];
							$this->fie_lencampo=$row[fie_lencampo];
							$this->fie_txtextra=$row[fie_txtextra];
							$this->fie_valiextra=$row[fie_valiextra];
							$this->fie_txtizq=$row[fie_txtizq];
							$this->fie_lineas=$row[fie_lineas];
							$this->fie_tabindex=$row[fie_tabindex];
							$this->fie_activarprt=$row[fie_activarprt];
							$this->fie_verificac=$row[fie_verificac];
							$this->fie_tablac=$row[fie_tablac];
							$this->fie_sqlorder=$row[fie_sqlorder];				
							$this->fie_styleobj=$row[fie_styleobj];
							$this->fie_naleatorio=$row[fie_naleatorio];
							$this->fie_sqlconexiontabla=$row[fie_sqlconexiontabla];
							$this->fie_activelista=$row[fie_activelista];
							
							$bandera=$row[fie_name];
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
								 $resultenl = mysql_query($sqlenl);
								 //echo $sqlenl;
								 $num_rows = mysql_num_rows($resultenl); //numero campos
								 if ($num_rows>0)
								 {
								   $this->fie_type="hidden2";
								   $ib=$total1;					  
								 }
								  
							  }
							  
							  
							}
											
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
			}
//Fin datos de cada campo
	
	function gridtabla($listacampos,$sqldatos,$sqldatoscompleto)
	{
	  $listacampos=split(",",$listacampos);
	  //print_r($listacampos);
	   $i=0;
				   while ($i < count($listacampos)) 
     	   			{
					  	//echo $listacampos[$i]."<br>";
						$campotabla=split("[.]",$listacampos[$i]);
						//print_r($campotabla);
				 		$this->form_format_field($campotabla[0],$campotabla[1]);	
						
							$this->arrcampos[]=$campotabla[1];							
							$titulocampo=str_replace(":","",$this->fie_title);
							$this->arrcamposn[]=$titulocampo;									
						
						$i++;
					}	
					
					
					
		///////////////lista datos///////////////////////


                 /////////////sql server


///conectando sqlserver
//echo $this->coneccionsql;
$conectandosqlserver=odbc_connect($this->coneccionsql,$this->usuariosql,$this->clavesql);
//$conectandosqlserver=mssql_connect("(local)","sa","sa");
//if (!$conectandosqlserver) die("Error"); else {echo "conectado";};

///fin conecccion


		//////////////fin sql server

//echo $sqldatos;

			   $resultdatos = odbc_exec($conectandosqlserver,$sqldatos);
			   
			   $resultdatoscompleto =odbc_exec($conectandosqlserver,$sqldatoscompleto);
			   
			    $n_registros=$this->better_odbc_num_rows($conectandosqlserver,$sqldatoscompleto);
				
				 				  
				   $this->totalreg=$n_registros;
				   $this->total_paginas = ceil($n_registros / $this->desplegar); 
			   
			   if ($resultdatos)
			   {
				 while($filasdato = odbc_fetch_array($resultdatos) and ($k<$this->desplegar)) 
					{
				 		$this->filas[]=$filasdato;
						
						$k++;
				    }					
					//print_r($filas);
			   }
		//Fin sql de consulta

//odbc_close($conectandosqlserver);
					
	}
}

?>