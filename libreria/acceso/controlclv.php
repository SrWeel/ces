<?php
class cambio_clvcontrol{
var $estado_clave;
var $mensaje_clave;
function calculodias($fechaconteo,$hoyfecha)
  {
		$libera1=split("-",$fechaconteo);
		$libera2=split("-",$hoyfecha);
			//defino fecha 1
		$ano1 = $libera1[0];
		$mes1 = $libera1[1];
		$dia1 = $libera1[2];
		
		//defino fecha 2
		$ano2 = $libera2[0];
		$mes2 = $libera2[1];
		$dia2 = $libera2[2];
		
		//calculo timestam de las dos fechas
		$timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1);
		$timestamp2 = mktime(4,12,0,$mes2,$dia2,$ano2);
		
		
		//resto a una fecha la otra
		$segundos_diferencia = $timestamp1 - $timestamp2;
		//echo $segundos_diferencia."<br>";
		
		//convierto segundos en días
		$dias_diferencia = $segundos_diferencia / 86400;
		//echo $dias_diferencia;
		//obtengo el valor absoulto de los días (quito el posible signo negativo)
		$dias_diferencia = abs($dias_diferencia);
		
		//quito los decimales a los días de diferencia
		$dias_diferencia = floor($dias_diferencia);
		
		//echo $dias_diferencia;
		return $dias_diferencia; 
  
  }
  
function verificar_cambio($idusuario,$tiempocambio,$DB_gogess)
{
   $hoyfecha=date("Y-m-d");
   $banderacambio=0;
   //fecha cambio clave   
   $buscausuario="select * from spag_postulante where usua_id=".$idusuario;
  
   $resultadous = $DB_gogess->Execute($buscausuario);
   if($resultadous)
   {   
        while (!$resultadous->EOF) {
	  	
		    $fechacambio=$resultadous->fields["usr_fecha_cambioclv"];
			
			if($fechacambio!='0000-00-00')
			{
			 $banderacambio=1;
		    }
		   $resultadous->MoveNext();
		}
   
   }
   //fecha cambio clave

  if($banderacambio==1)
  {


   //busca cambio de clave
 $buscacambio="select * from spag_controlclv where usua_id=".$idusuario." order by clvc_id desc limit 1";
   $resultadocb = $DB_gogess->Execute($buscacambio);
   if($resultadocb)
   {
		while (!$resultadocb->EOF) {
		
		     
			$valorultimo=explode(" ",$resultadocb->fields["clvc_fecha"]);
		
		   $resultadocb->MoveNext();
		}
   }
   //busca cambio de clave
   
   //verifica intervalo de tiempo de la ultima actualizacion
   
   $diastrascurridos=$this->calculodias($valorultimo[0],$hoyfecha);
	
	if($diastrascurridos>=$tiempocambio)
	{
	$this->estado_clave=0;
	
	}
	else
	{
	$this->estado_clave=1;
	
	}
	 
   //verifica intervalo de tiempo de la ultima actualizacion

    
   
   
   }
   else
   {
   
      $this->mensaje_clave="Por favor actualice su clave...";
	  $this->estado_clave=0;
   
   }
   

}


}


?>