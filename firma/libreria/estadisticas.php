<?php

class estadisticas{

function visitas_new($ar,$apl,$seccionp,$system,$DB_gogess)
{
   
  /* if ($_SERVER) {
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
	
    $selecTabla1="select * from sibase_estadistica where ar=$ar and apl=$apl and seccionp=$seccionp and system=$system and ip='$realip' and fecha='$fecha'"; 
	$rs_resultado1 = $DB_gogess->Execute($selecTabla1);  
	
   if(!($rs_resultado1->fields["est_id"]))
   {
   
   $visitas= "insert into `sibase_estadistica` (ar,apl,seccionp,system,ip,fecha) values (".$ar.", ".$apl.", ".$seccionp.",".$system.",'".$realip."','".$fecha."')";   
    $DB_gogess->Execute($visitas);   
   
   }
   */
   
}

function porarticulo($ar,$DB_gogess)
{
 
/*  $selecTabla=" SELECT count(est_id) as total, con_titulo  FROM sibase_estadistica,sibase_contenido where sibase_estadistica.ar=sibase_contenido.con_id and sibase_contenido.con_id=$ar  group by con_titulo";   
  
  $rs_resultado = $DB_gogess->Execute($selecTabla);
			
		while (!$rs_resultado->EOF) {
				echo $rs->fields["con_titulo"]."=".$rs->fields["total"]."<br>";
				$rs_resultado->MoveNext();
          }	
	*/		
			
}

function porapl($apl,$DB_gogess)
{
 
 /* $selecTabla=" SELECT count(est_id) as total, ap_nombre  FROM `sibase_estadistica`,`sibase_aplication` where ap_id=apl  group by ap_nombre";   
  $rs_resultado = $DB_gogess->Execute($selecTabla);
  
  while (!$rs_resultado->EOF) {
				echo $rs->fields["ap_nombre"]."=".$rs->fields["total"]."<br>";
				$rs_resultado->MoveNext();
          }	
		*/
}

function porseccion($seccionp,$DB_gogess)
{
 
 /* $selecTabla=" SELECT count(est_id) as total, etiqueta  FROM `sibase_estadistica`,`sibase_seccp` where secp_id=seccionp  group by etiqueta";  
  
  
  $rs_resultado = $DB_gogess->Execute($selecTabla);
  
  while (!$rs_resultado->EOF) {
				echo $rs->fields["etiqueta"]."=".$rs->fields["total"]."<br>";
				$rs_resultado->MoveNext();
          }	
  	*/	
}

function porportal($system,$DB_gogess)
{
 
 /* $selecTabla=" SELECT count(est_id) as total, sys_titulo  FROM `sibase_estadistica`,`sibase_sys` where sys_id=system  group by sys_titulo";  
  $rs_resultado = $DB_gogess->Execute($selecTabla);
  
  while (!$rs_resultado->EOF) {
				echo $rs->fields["sys_titulo"]."=".$rs->fields["total"]."<br>";
				$rs_resultado->MoveNext();
          }		
	*/		
}

function porportalhome($system,$DB_gogess)
{
 
  /*$selecTabla=" SELECT count(est_id) as total, sys_titulo  FROM `sibase_estadistica`,`sibase_sys` where sys_id=system and ar=0 and apl=0  group by sys_titulo";   
  $rs_resultado = $DB_gogess->Execute($selecTabla);  
   while (!$rs_resultado->EOF) {
				echo "Visitas:".$rs->fields["total"]."<br>";				
				$rs_resultado->MoveNext();
          }		
	*/		
}

function porip($system,$DB_gogess)
{
 
  /* $selecTabla=" SELECT count(est_id) as total, sys_titulo  FROM `sibase_estadistica`,`sibase_sys` where sys_id=system  group by sys_titulo";   
   $rs_resultado = $DB_gogess->Execute($selecTabla);  
   while (!$rs_resultado->EOF) {				
				echo $rs->fields["sys_titulo"]."=".$rs->fields["total"]."<br>";			
				$rs_resultado->MoveNext();
          }			
			
		*/	
}


}
?>