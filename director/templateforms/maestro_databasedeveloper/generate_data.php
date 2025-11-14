<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4440000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['sessidadm1777_pichincha'])
{
$director='../../';
include("../../cfgclases/clases.php");

$tipo_variable["STRING"]='varchar(250)';
$tipo_variable["DATE"]='date';
$tipo_variable["DATETIME"]='datetime';
$tipo_variable["INTEGER"]='int';
$tipo_variable["WITH DECIMALS"]='double';


$virtual_id=$_POST["virtual_id"];
$obt_datos="select * from gogess_virtualtable where virtual_id=".$virtual_id;
$rs_obtiene = $DB_gogess->Execute($obt_datos);

$nombre_tabla=strtolower(str_replace(' ','',$rs_obtiene->fields["virtual_name"]));
$nombre_tabla=str_replace('.','',$nombre_tabla);
$nombre_tabla=str_replace('_','',$nombre_tabla);
$nombre_tabla=str_replace('&','',$nombre_tabla);
$sub_index = substr($nombre_tabla, 0, 4)."_";
$nombre_tabla="db_".$nombre_tabla;
$inserta_camposvirtua=array();
$script_select='';


//busca datos de coneccion
$string_datavalor='';
$string_datavalor='localhost,usrosv2,PwFrnk2018.,centrosa_replica';
//busca datos de coneccion
$sorload_string=explode(",",$string_datavalor);

$script_data.="CREATE TABLE ".$nombre_tabla." (
";
$script_data.=" ".$sub_index."id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
";


$contador_fields=0;
$lista_campos="select * from gogess_virtualfields where virtual_id='".$rs_obtiene->fields["virtual_id"]."'";
$rs_campos = $DB_gogess->Execute($lista_campos);
if($rs_campos)
  {
	  while (!$rs_campos->EOF) {
	  
	     $nombre_type='';
		
		  if($rs_campos->fields["virtfields_typefield"])
		  {
		  $nombre_type=$rs_campos->fields["virtfields_typefield"];
		  }
		  else
		  {
		  $nombre_type='STRING';
		  }
	  
		$script_data.=strtolower($rs_campos->fields["virtfields_namefield"])." ".$tipo_variable[trim($nombre_type)]." NULL,";
		
		$script_select.=$rs_campos->fields["virtfields_namefield"].",";
		
		$contador_fields++;
		
	    $rs_campos->MoveNext();	
	  }
	  
  }	 

$script_data=substr($script_data,0,-1);

$script_data.=") ";

try {

   $link_mysqlserver = NewADOConnection('mysqli');
   $link_mysqlserver->Connect($sorload_string[0],$sorload_string[1],$sorload_string[2],$sorload_string[3]);
	
	$busca_sitienedatos="select count(*) as total from ".$nombre_tabla." limit 3";
	$rs_sitienedata = $link_mysqlserver->Execute($busca_sitienedatos);
	if($rs_sitienedata->fields["total"]>0)
	{
		$mensaje="[toot]# Table has information can not be updated...<br>";
	}
	else
	{
	    $mensaje="[root]# Table will be updated...<br>";
		$datos_drop="DROP TABLE IF EXISTS ".$nombre_tabla;
		$rs_drop = $link_mysqlserver->Execute($datos_drop);
	
	
	
	}
	
	echo $mensaje;
    echo "[root]# ".$script_data."<br>";
	$busca_creadata=$script_data;
	$rs_creadata = $link_mysqlserver->Execute($busca_creadata);
	if($rs_creadata)
	{
	   echo "[root]# Table Created<br>";
	   
	}

} catch (Exception $e) {
    echo "[root]# Caught Exception ('{$e->getMessage()}')\n{$e}<br>";
}


}
?>
