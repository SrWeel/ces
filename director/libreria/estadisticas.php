<?php

class estadisticas{

function visitas_new($ar,$apl,$seccionp,$system)
{
   $fecha=date("Y-m-d");
   if (!($ar))
   {
     $ar=0;
   }
   if (!($apl))
   {
     $apl=0;
   }
   if (!($seccionp))
   {
     $seccionp=0;
   }
   $visitas= "insert into `gogess_estadistica` (ar,apl,seccionp,system,fecha) values (".$ar.", ".$apl.", ".$seccionp.",".$system.",'".$fecha."')";			  
   $resultadoCn = mysql_query($visitas);	
}

function porarticulo($ar)
{
 
  $selecTabla=" SELECT count(est_id) as total, con_titulo  FROM `gogess_estadistica`,`gogess_contenido` where con_id=ar  group by con_titulo";   
  $resultado = mysql_query($selecTabla);
  		while($row = mysql_fetch_array($resultado)) 
			{	
			   echo $row["con_titulo"]."=".$row["total"]."<br>";
			}
}

function porapl($apl)
{
 
  $selecTabla=" SELECT count(est_id) as total, ap_nombre  FROM `gogess_estadistica`,`gogess_aplication` where ap_id=apl  group by ap_nombre";   
  $resultado = mysql_query($selecTabla);
  		while($row = mysql_fetch_array($resultado)) 
			{	
			   echo $row["ap_nombre"]."=".$row["total"]."<br>";
			}
}

function porseccion($seccionp)
{
 
  $selecTabla=" SELECT count(est_id) as total, etiqueta  FROM `gogess_estadistica`,`gogess_seccp` where secp_id=seccionp  group by etiqueta";   
  $resultado = mysql_query($selecTabla);
  		while($row = mysql_fetch_array($resultado)) 
			{	
			   echo $row["etiqueta"]."=".$row["total"]."<br>";
			}
}

function porportal($system)
{
 
  $selecTabla=" SELECT count(est_id) as total, sys_titulo  FROM `gogess_estadistica`,`gogess_sys` where sys_id=system  group by sys_titulo";   
  $resultado = mysql_query($selecTabla);
  		while($row = mysql_fetch_array($resultado)) 
			{	
			   echo $row["sys_titulo"]."=".$row["total"]."<br>";
			}
}



}
?>