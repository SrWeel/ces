<?php
class formulas{

function calculoentrefecha($fechainicial,$fechafinal,$opcion)
{
   if($fechainicial)
   {
   if($fechafinal)
   {
   $fecha1=split("-",$fechainicial);
   $fecha2=split("-",$fechafinal);
   
   
   
$ano1 = $fecha1[0];
$mes1 = $fecha1[1];
$dia1 = $fecha1[2];

//defino fecha 2
$ano2 = $fecha2[0];
$mes2 = $fecha2[1];
$dia2 = $fecha2[2];

//calculo timestam de las dos fechas
$timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1);
$timestamp2 = mktime(4,12,0,$mes2,$dia2,$ano2);

//resto a una fecha la otra
$segundos_diferencia = $timestamp1 - $timestamp2;
//echo $segundos_diferencia;

//convierto segundos en días
$dias_diferencia = $segundos_diferencia / (60 * 60 * 24);

//obtengo el valor absoulto de los días (quito el posible signo negativo)
$dias_diferencia = abs($dias_diferencia);

//quito los decimales a los días de diferencia
$dias_diferencia = floor($dias_diferencia);

$semanadiferencia=$dias_diferencia/7;
if($opcion==1)
{
  return $dias_diferencia;

}
if ($opcion==2)
{
   return number_format($semanadiferencia,0);

}
   }
}
}
//////////////////////fecha edad
function calculoedad($dob)
{

            $dia=date(j); 
			$mes=date(n); 
			$ano=date(Y); 
			
			//fecha de nacimiento 
			list($y,$m,$d)=explode("-",$dob);
			$dianaz=$d; 
			$mesnaz=$m; 
			$anonaz=$y; 
			
			//si el mes es el mismo pero el dia inferior aun no ha cumplido años, le quitaremos un año al actual 
			
			
			if (($mesnaz == $mes) && ($dianaz > $dia)) { 
			$ano=($ano-1); } 
			
			
			//si el mes es superior al actual tampoco abra cumplido años, por eso le quitamos un año al actual 
			
			if ($mesnaz > $mes) { 
			$ano=($ano-1);} 
			
			//ya no habria mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad 
			
			$edad=($ano-$anonaz); 
			
			if ($dob)
			{
			    $edadnac= $edad;
				return  $edadnac;
			}


}


function sumaDia($fecha,$dia)
{	
  if($fecha)
  {
    list($year,$mon,$day) = explode('-',$fecha);
	return date('Y-m-d',mktime(0,0,0,$mon,$day+$dia,$year));		
	}
	else
	{
	  echo 'Seleccione una fecha...';
	}
}

function nombredelmes($nmes)
{
     switch ($nmes) {
    case '01':
        $nombremes='Ene';
        break;
    case '02':
         $nombremes='Feb';
        break;
    case '03':
         $nombremes='Mar';
        break;
    case '04':
         $nombremes='Abr';
        break;
    case '05':
         $nombremes='May';
        break;
    case '06':
         $nombremes='Jun';
        break;
    case '07':
         $nombremes='Jul';
        break;
    case '08':
         $nombremes='Ago';
        break;
    case '09':
         $nombremes='Sep';
        break;
    case '10':
         $nombremes='Oct';
        break;
    case '11':
         $nombremes='Nov';
        break;
    case '12':
         $nombremes='Dic';
        break;																								
    


}
   return $nombremes;
}

function rangosfechas($fechainicial,$fechafinal,$opcion)
{
    if($opcion==99999991)
	{
	   //// saca rango para dias
			$ndias=$this->calculoentrefecha($fechainicial,$fechafinal,1);
			for ($i=0;$i<=$ndias;$i++)
			{
				 $fechanueva= $this->sumaDia($fechainicial,$i);
				 
				 $nombredia=date('N', strtotime($fechanueva));
				 
				 switch ($nombredia) {
						case 1:
							$nombredeldia='Lunes';
							break;
						case 2:
							$nombredeldia='Martes';
							break;
						case 3:
							$nombredeldia='Miercoles';
							break;
						case 4:
							$nombredeldia='Jueves';
							break;
						case 5:
							$nombredeldia='Viernes';
							break;
						case 6:
							$nombredeldia='Sabado';
							break;
						case 7:
							$nombredeldia='Domingo';
							break;				
					}
				 
				 
				 $arreglorango[$i]=$fechanueva."|".$fechanueva."|".$nombredeldia;
			
			}
	
	}
	
	 if($opcion==99999992)
	{
	  ///saca rango por semanas   
	  
	     $ndias=$this->calculoentrefecha($fechainicial,$fechafinal,1); 
		 $ui=0;
		 $i=0;
		 $fechanueva= $this->sumaDia($fechainicial,$i);		
		 
		 $nombredia=date('N', strtotime($fechanueva));
		  if($nombredia<=6)
		  {
		     $arreglorango[$ui]=$fechanueva;
			 $banderainicio=1;		  
		  }
		  
		  if($nombredia==7)
		  {
		     $arreglorango[$ui]=$fechanueva."--".$fechanueva;
			 $banderainicio=0;		  
		  }
		
		 
			for ($i=1;$i<=$ndias;$i++)
			{
				if($banderainicio==1)
				{
				     $fechanueva= $this->sumaDia($fechainicial,$i);
					 $quediases=date('N', strtotime($fechanueva));
				     if ($quediases==7)
					 {
					   $arreglorango[$ui]=$arreglorango[$ui]."|".$fechanueva."|".' - Semana';
					   $banderainicio=0;
					   $ui++;
					 }
				
				}
				else
				{
				   $fechanueva= $this->sumaDia($fechainicial,$i);
				   $quediases=date('N', strtotime($fechanueva));
				   if($quediases==1)
				   {				   
				      $arreglorango[$ui]=$fechanueva;
					  $banderainicio=1;
				   }			   			   	
				}
				
			}
			
			if($arreglorango[$ui])
			{
			     $arreglorango[$ui]= $arreglorango[$ui]."|".$fechanueva;
			}
		
			$arreglorango[$ui]=$arreglorango[$ui]."|".' - Semana';			
		//$fechanueva= $this->sumaDia($fechainicial,$i); 
	}
	
	if($opcion==99999993)
	{
	     if($fechainicial)
		 {
		 
		 $ndias=$this->calculoentrefecha($fechainicial,$fechafinal,1); 
		 $ui=0;
		 $i=0;
		 $fechanueva= $this->sumaDia($fechainicial,$i);	
		 /////////////////////////////////////////////////
		 
		 $fechaarr=split("-",$fechanueva);
		 $ndiasmes = cal_days_in_month(CAL_GREGORIAN, $fechaarr[1],$fechaarr[0]); 
		 //echo $ndiasmes;
		 
		 /////////////////////////////////////////////////
		 $nombredia=date('j', strtotime($fechanueva));
		 
		 
		 
		  if($nombredia<=$ndiasmes)
		  {
		     $arreglorango[$ui]=$fechanueva;
			 $banderainicio=1;		  
		  }
		  
		  if($nombredia==$ndiasmes)
		  {
		     $arreglorango[$ui]=$fechanueva."--".$fechanueva;
			 $banderainicio=0;		  
		  }
		  
		
	//////////////////////////////////////////////////	
			for ($i=1;$i<=$ndias;$i++)
			{
				if($banderainicio==1)
				{
				     $fechanueva= $this->sumaDia($fechainicial,$i);
					 $quediases=date('j', strtotime($fechanueva));
					 
					 ///////////////////////////////////////////////////
					 		 $fechaarr=split("-",$fechanueva);
		                     $ndiasmes = cal_days_in_month(CAL_GREGORIAN, $fechaarr[1],$fechaarr[0]); 
					 
					 ////////////////////////////////////////////////////
					 
					 
					 
				     if ($quediases==$ndiasmes)
					 {
					     $nummes=date('m', strtotime($arreglorango[$ui]));
						 
					   $arreglorango[$ui]=$arreglorango[$ui]."|".$fechanueva."|".$this->nombredelmes($nummes);
					   $banderainicio=0;
					   $ui++;
					 }
				
				}
				else
				{
				   $fechanueva= $this->sumaDia($fechainicial,$i);
				   $quediases=date('j', strtotime($fechanueva));



					 ///////////////////////////////////////////////////
					 		 $fechaarr=split("-",$fechanueva);
		                     $ndiasmes = cal_days_in_month(CAL_GREGORIAN, $fechaarr[1],$fechaarr[0]); 
					 
					 ////////////////////////////////////////////////////

				   
				   
				   if($quediases==1)
				   {				   
				      $arreglorango[$ui]=$fechanueva;
					  $banderainicio=1;
				   }			   			   	
				}
			}		
		
		
	/////////////////////////////////	
		
			if($arreglorango[$ui])
			{
			     $nummes=date('m', strtotime($arreglorango[$ui]));
				 $arreglorango[$ui]= $arreglorango[$ui]."|".$fechanueva."|".$this->nombredelmes($nummes);
			}
		$nummes='';
		
		  
	
	 } 
	 else
	 {
	  echo 'Seleccione una fecha...';
	 }
	}
	
   return $arreglorango;
   
}


}

?>

