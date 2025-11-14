<?php

class estadisticas{

function visitas_new($ar,$apl,$seccionp,$system)
{
   
   if ($_SERVER) {
if ( $_SERVER[HTTP_X_FORWARDED_FOR] ) {
$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
} elseif ( $_SERVER["HTTP_CLIENT_IP"] ) {
$realip = $_SERVER["HTTP_CLIENT_IP"];
} else {
$realip = $_SERVER["REMOTE_ADDR"];
}
} else {
if ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
$realip = getenv( 'HTTP_X_FORWARDED_FOR' );
} elseif ( getenv( 'HTTP_CLIENT_IP' ) ) {
$realip = getenv( 'HTTP_CLIENT_IP' );
} else {
$realip = getenv( 'REMOTE_ADDR' );
}
}


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
   
    $banderacontador=0;	
	if (!($system))
	{
	  $system=0;
	}
    $selecTabla1="select * from iba_estadistica where ar=$ar and apl=$apl and seccionp=$seccionp and system=$system and ip='$realip' and fecha='$fecha'";    

    $resultado1 = mysql_query($selecTabla1);
  		while($row1 = mysql_fetch_array($resultado1)) 
			{	
			 $banderacontador=1;			
			}
   
   if(!($banderacontador))
   {
   $visitas= "insert into `iba_estadistica` (ar,apl,seccionp,system,ip,fecha) values (".$ar.", ".$apl.", ".$seccionp.",".$system.",'".$realip."','".$fecha."')";			  
   $resultadoCn = mysql_query($visitas);	
   }
}

function porarticulo($ar)
{
 
  $selecTabla=" SELECT count(est_id) as total, con_titulo  FROM `iba_estadistica`,`iba_contenido` where con_id=ar  group by con_titulo";   
  $resultado = mysql_query($selecTabla);
  		while($row = mysql_fetch_array($resultado)) 
			{	
			   echo $row["con_titulo"]."=".$row["total"]."<br>";
			}
}

function porapl($apl)
{
 
  $selecTabla=" SELECT count(est_id) as total, ap_nombre  FROM `iba_estadistica`,`iba_aplication` where ap_id=apl  group by ap_nombre";   
  $resultado = mysql_query($selecTabla);
  		while($row = mysql_fetch_array($resultado)) 
			{	
			   echo $row["ap_nombre"]."=".$row["total"]."<br>";
			}
}

function porseccion($seccionp)
{
 
  $selecTabla=" SELECT count(est_id) as total, etiqueta  FROM `iba_estadistica`,`iba_seccp` where secp_id=seccionp  group by etiqueta";   
  $resultado = mysql_query($selecTabla);
  		while($row = mysql_fetch_array($resultado)) 
			{	
			   echo $row["etiqueta"]."=".$row["total"]."<br>";
			}
}

function porportal($system)
{
 
  $selecTabla=" SELECT count(est_id) as total, sys_titulo  FROM `iba_estadistica`,`iba_sys` where sys_id=system  group by sys_titulo";   
  $resultado = mysql_query($selecTabla);
  		while($row = mysql_fetch_array($resultado)) 
			{	
			   echo $row["sys_titulo"]."=".$row["total"]."<br>";
			}
}

function porportalhome($system)
{
 
  $selecTabla=" SELECT count(est_id) as total, sys_titulo  FROM `iba_estadistica`,`iba_sys` where sys_id=system and ar=0 and apl=0  group by sys_titulo";   
  $resultado = mysql_query($selecTabla);
  		while($row = mysql_fetch_array($resultado)) 
			{	
			   echo "Visitas: ".$row["total"]."<br>";
			}
}

function porip($system)
{
 
  $selecTabla=" SELECT count(est_id) as total, sys_titulo  FROM `iba_estadistica`,`iba_sys` where sys_id=system  group by sys_titulo";   
  $resultado = mysql_query($selecTabla);
  		while($row = mysql_fetch_array($resultado)) 
			{	
			   echo $row["sys_titulo"]."=".$row["total"]."<br>";
			}
}


}
?>