<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
ini_set("session.cookie_lifetime","36000000");
ini_set("session.gc_maxlifetime","360000000");
session_start();


include("libreria/formulario.php");
include("libreria/dbcc.php");
include("cfgclases/config.php");


//Conexion a la base de datos
  $objBd = new  conecc();
  $objBd->conectardb($basededatos,$host,$userdb,$passwdb);
  $objformulario = new  formulario();
  $link = $objBd->enlace;
  
  $fecha_hoy=date("Y-m-d"); 
  $hora_hoy=date("H:i:s"); 
  
 /* echo $_POST["carr_id"]."<br>";
  echo $_POST["nivl_id"]."<br>";
  echo $_POST["matprof_id"]."<br>";
  echo $_POST["alu_id"]."<br>";
 echo "ac".$_POST["activo"]."<br>";*/
 

if(trim($_POST["activo"]))
  {
  $activo_valor="1";
  }
  else
  {
  $activo_valor="0";  
}
  
  $busca_si="select * from app_asistencia where  clie_id=".$_POST["alu_id"]." and asis_fecharegistro='".$fecha_hoy."'";
  $result_bsi = mysql_query($busca_si);
  if($result_bsi)
			{
			while($row_bs= mysql_fetch_array($result_bsi)) 
				{
				
				    $asialu_id=$row_bs["asis_id"];
				}
			
			}
  
if($asialu_id)
{
 $actualiza_id="update app_asistencia set asis_asiste='".$activo_valor."',asis_fecharegistro='".$fecha_hoy."' where asis_id=".$asialu_id;
  $ok_asis = mysql_query($actualiza_id);
}
else
{
$inserta_asis="insert into  app_asistencia (clie_id,asis_asiste,asis_fecharegistro,asis_fechahora) values ('".$_POST["alu_id"]."','".$activo_valor."','".$fecha_hoy."','".$hora_hoy."')";
$ok_asis = mysql_query($inserta_asis);

}
  
  
  
?>