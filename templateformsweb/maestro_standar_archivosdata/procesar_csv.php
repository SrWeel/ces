<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
date_default_timezone_set("America/Guayaquil");

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objvarios=new util_funciones();


$archdt_id=$_POST["archdt_id"];

$busca_archivo="select * from conco_archivosdata where archdt_id='".$archdt_id."'";
$rs_archivo = $DB_gogess->executec($busca_archivo);

$archdt_anio=$rs_archivo->fields["archdt_anio"];
$archdt_mes=$rs_archivo->fields["archdt_mes"];
$usua_id=$_SESSION['iduser1109'];

$archdt_fila=$rs_archivo->fields["archdt_fila"];
$tiparch_id=$rs_archivo->fields["tiparch_id"];

$busca_ntabla="select * from cmb_tipoarchivo where tiparch_id='".$rs_archivo->fields["tiparch_id"]."'";
$rs_ntabla = $DB_gogess->executec($busca_ntabla);
$nombre_tabla=$rs_ntabla->fields["tiparch_ntabla"];

//vacida datos
$vacia_data="delete from ".$nombre_tabla." where archdt_anio='".$archdt_anio."' and archdt_mes='".$archdt_mes."'";
$rs_vaciadata = $DB_gogess->executec($vacia_data);
//vacia datos

$nombre_archivo="";
$url = "../../excel/".$rs_archivo->fields["archdt_archivo"];

$cl=0;
$fp = fopen($url, "r");
while (!feof($fp)){
    $cl++;
	$linea = fgets($fp);
	
	if($cl>=$archdt_fila)
	{
       $array_fila=array();
	   $array_fila=explode(",",$linea);
	   //print_r($array_fila);
	   
	   $busca_idcli="select *from app_cliente where clie_rucci='".$array_fila[0]."'";
	   $rs_bucli = $DB_gogess->executec($busca_idcli);
		   
	   $busca_infolab="select * from app_cliente inner join grid_infolaboral3 on app_cliente.clie_enlace=grid_infolaboral3.standar_enlace where (info_fechadesalida='0000-00-00' or info_fechadesalida is null) and clie_id='".$rs_bucli->fields["clie_id"]."'  order by info_id desc";
       $rs_buinfolab = $DB_gogess->executec($busca_infolab); 
	   
	   //echo $rs_buinfolab->fields["info_fondosdereserva"]."<br>";
	   $info_id=0;
	   $info_id=$rs_buinfolab->fields["info_id"];
	   
	   //echo $info_id."<br>";
	   
	   $variable_regfondos=0;
	   
	   
	   if(trim($array_fila[6])=='NO')
	   {
		 //3-NO APLICA  
		 $variable_regfondos=3;
	   }
	   else
	   {
	   
		   if(trim($array_fila[3])=='SI')
		   {
			 //2-ACUMULA
             $variable_regfondos=2;			 
		   }
		   
		   if(trim($array_fila[3])=='NO')
		   {
			 //1-ROL DE PAGOS 
			 $variable_regfondos=1;
		   }
	   
	   }
	   
	   //echo $variable_regfondos."<br>";
	   if($variable_regfondos)
	   {
		  //actualiza
		   	   
		   $ac_data="update grid_infolaboral3 set info_fondosdereserva='".$variable_regfondos."' where info_id='".$info_id."'";
		   $rs_ccdata = $DB_gogess->executec($ac_data); 
		   //echo $ac_data."<br>";
		   
	   }
	   
	   
	   
	}
}
fclose($fp);


 
 
			//if($datos[$array_nombrecampo[0]])
			//{
			//$sql_inserta=$objvarios->genera_insert_general($nombre_tabla,$datos,$array_camposdata);
			//}
			//echo $sql_inserta."<br>";
			//$rs_sitienedata = $DB_gogess->executec($sql_inserta);
		
	  


echo "<span style='color:#000000' >&nbsp;&nbsp;Processed File (Actualizado Fondos de reserva)...</span>";

}
?>