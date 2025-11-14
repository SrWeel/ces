<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=4440000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['sessidadm1777_pichincha'])
{

$director='../../';
include("../../cfgclases/clases.php");


$virtual_id=$_POST["virtual_id"];
$obt_datos="select * from gogess_virtualtable where virtual_id=".$virtual_id;
$rs_obtiene = $DB_gogess->Execute($obt_datos);

//busca datos de coneccion
$string_datavalor='';
$string_datavalor=$rs_obtiene->fields["virtual_stringconection"];
//busca datos de coneccion
$sorload_string=explode(",",$string_datavalor);

//obtener campos
$campo_sale=array();
$campo_llega=array();
$cuentai=0;
$lista_campos="select * from gogess_virtualfields where virtual_id='".$virtual_id."'";
$rs_campos = $DB_gogess->Execute($lista_campos);
$conatena_insert='';
if($rs_campos)
  {
	  while (!$rs_campos->EOF) {
	      
		  $campo_sale[$cuentai]=$rs_campos->fields["virtfields_namefield"];
		  $campo_tipo[$cuentai]=$rs_campos->fields["virtfields_typefield"];
		  
		  $campo_llega[$cuentai]=strtolower($rs_campos->fields["virtfields_namefield"]);
		  
		  $conatena_insert=$conatena_insert.$campo_llega[$cuentai].",";
		  
		  $cuentai++;
	  
	  $rs_campos->MoveNext();	
	  }
  }	  

$conatena_insert=substr($conatena_insert,0,-1);
//obtener campos

//obtener nombre campo
$obt_datos="select * from gogess_virtualtable where virtual_id=".$virtual_id;
$rs_obtiene = $DB_gogess->Execute($obt_datos);

$nombre_tabla=strtolower(str_replace(' ','',$rs_obtiene->fields["virtual_name"]));
$nombre_tabla=str_replace('.','',$nombre_tabla);
$nombre_tabla=str_replace('_','',$nombre_tabla);
$nombre_tabla=str_replace('&','',$nombre_tabla);
$sub_index = substr($nombre_tabla, 0, 4)."_";
$nombre_tabla="db_".$nombre_tabla;

//obtener nombre campo

//--------------------------------------

//busca datos de coneccion
$string_datavalor='';
$string_datavalor='localhost,root,,centrosa_replica';
//busca datos de coneccion
$sorload_stringmysql=explode(",",$string_datavalor);
$link_mysqlserver = NewADOConnection('mysqli');
$link_mysqlserver->NConnect($sorload_stringmysql[0],$sorload_stringmysql[1],$sorload_stringmysql[2],$sorload_stringmysql[3]);

$rs_tr = $link_mysqlserver->Execute("TRUNCATE ".$nombre_tabla);
//--------------------------------------

$virtual_scriptalert=$rs_obtiene->fields["virtual_scriptalert"];

if($rs_obtiene->fields["datab_id"]==2)
{

///---------------------------------

$link_sqlserver=mssql_connect($sorload_string[0],$sorload_string[1],$sorload_string[2]);
## seleccionamos la base de datos
mssql_select_db($sorload_string[3],$link_sqlserver);	
$valores_ct='';

$rs_ggrafico=mssql_query($virtual_scriptalert,$link_sqlserver);
if($rs_ggrafico)
		{  
			  //-------------------  
			  while ($fields=mssql_fetch_array($rs_ggrafico))
				{
				   //datos
				    $valores_ct="";
				    for($ivalor=0;$ivalor<count($campo_sale);$ivalor++)
					{  
						  switch ($campo_tipo[$ivalor]) {	
								case 'DATETIME':
									{
									     if(trim($fields[$campo_sale[$ivalor]]))
										  {
										   $valores_ct=$valores_ct."'".$fields[$campo_sale[$ivalor]]."',"; 
										  }
										  else
										  {
										   $valores_ct=$valores_ct."NULL,";
										  }
									
									}
								    break;
								case 'DATE':
									{
									     if(trim($fields[$campo_sale[$ivalor]]))
										  {
										   $valores_ct=$valores_ct."'".$fields[$campo_sale[$ivalor]]."',"; 
										  }
										  else
										  {
										   $valores_ct=$valores_ct."NULL,";
										  }
									
									}
									break;
								case 'INTEGER':
									{
									      if(trim($fields[$campo_sale[$ivalor]]))
										  {
										   $valores_ct=$valores_ct."'".$fields[$campo_sale[$ivalor]]."',"; 
										  }
										  else
										  {
										   $valores_ct=$valores_ct."0,";
										  }
									}
									break;
								case 'WITH DECIMALS':
									{
									     if(trim($fields[$campo_sale[$ivalor]]))
										  {
										   $valores_ct=$valores_ct."'".$fields[$campo_sale[$ivalor]]."',"; 
										  }
										  else
										  {
										   $valores_ct=$valores_ct."0,";
										  }
									}
									break;
								default:
								   {
								      $valores_ct=$valores_ct."'".str_replace("'","\'",$fields[$campo_sale[$ivalor]])."',";
								   }
							}
					  
					  
					
					   
					}
					$valores_ct=substr($valores_ct,0,-1);
				   //datos
				   
				   
				   $sql_data="";   
				   $sql_data="insert into ".$nombre_tabla." (".$conatena_insert.") values (".$valores_ct.")";
				   $rs_inserta = $link_mysqlserver->Execute($sql_data);
				   if(!($rs_inserta))
				   {
				   
				     echo $sql_data;
				  }
				
				}
		}		



///---------------------------------

}
else
{

///---------------------------------


$link_mysqlserverorigen = NewADOConnection('mysqli');
$link_mysqlserverorigen->NConnect($sorload_string[0],$sorload_string[1],$sorload_string[2],$sorload_string[3]);
$valores_ct='';

$rs_ggrafico = $link_mysqlserverorigen->Execute($virtual_scriptalert);

if($rs_ggrafico)
		{  
			  //-------------------  
			 
			  while (!$rs_ggrafico->EOF) 
			  {	
				   //datos
				    $valores_ct="";
				    for($ivalor=0;$ivalor<count($campo_sale);$ivalor++)
					{  
						  switch ($campo_tipo[$ivalor]) {	
								case 'DATETIME':
									{
									     if(trim($rs_ggrafico->fields[$campo_sale[$ivalor]]))
										  {
										   $valores_ct=$valores_ct."'".$rs_ggrafico->fields[$campo_sale[$ivalor]]."',"; 
										  }
										  else
										  {
										   $valores_ct=$valores_ct."NULL,";
										  }
									
									}
								    break;
								case 'DATE':
									{
									     if(trim($rs_ggrafico->fields[$campo_sale[$ivalor]]))
										  {
										   $valores_ct=$valores_ct."'".$rs_ggrafico->fields[$campo_sale[$ivalor]]."',"; 
										  }
										  else
										  {
										   $valores_ct=$valores_ct."NULL,";
										  }
									
									}
									break;
								case 'INTEGER':
									{
									      if(trim($rs_ggrafico->fields[$campo_sale[$ivalor]]))
										  {
										   $valores_ct=$valores_ct."'".$rs_ggrafico->fields[$campo_sale[$ivalor]]."',"; 
										  }
										  else
										  {
										   $valores_ct=$valores_ct."0,";
										  }
									}
									break;
								case 'WITH DECIMALS':
									{
									     if(trim($rs_ggrafico->fields[$campo_sale[$ivalor]]))
										  {
										   $valores_ct=$valores_ct."'".$rs_ggrafico->fields[$campo_sale[$ivalor]]."',"; 
										  }
										  else
										  {
										   $valores_ct=$valores_ct."0,";
										  }
									}
									break;
								default:
								   {
								      @$valores_ct=$valores_ct."'".str_replace("'","\'",$rs_ggrafico->fields[$campo_sale[$ivalor]])."',";
								   }
							}

					}
					$valores_ct=substr($valores_ct,0,-1);
				   //datos
				   
				   
				   $sql_data="";   
				   $sql_data="insert into ".$nombre_tabla." (".$conatena_insert.") values (".$valores_ct.")";
				   $rs_inserta = $link_mysqlserver->Execute($sql_data);
				   if(!($rs_inserta))
				   {
				   
				     echo $sql_data;
				   }
				   
				  $rs_ggrafico->MoveNext(); 
				
				}
		}		




///--------------------------------



}


//echo $sql_data;
echo "<br><br><b>Finished process...</b>";

}


?>