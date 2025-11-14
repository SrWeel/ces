<?php

class formulas_globales{

  function comparafechas($fecha1,$fecha2)
  {
       $libera1=split("-",$fecha1);
		$libera2=split("-",$fecha2);
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
  }
    
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
  
  
  function validarCI($cedula){
    $result = "SI";

    if(preg_match("/[a-zA-Z]/", $cedula)) return "NO";

    if(strlen($cedula)==10){
        $ultimoDigito = substr($cedula, strlen($cedula)-1,1);
        $sum=0;
        for($j=0; $j<strlen($cedula)-1; $j++){
            if($j % 2) $mul = intval(substr($cedula,$j,1)) * 1;
            else $mul = intval(substr($cedula,$j,1)) * 2;
            if($mul >= 10){
                $res = intval(substr($mul,0,1)) + intval(substr($mul,1,1));
                $mul=$res;
            }
            $sum+=$mul;
        }
        $residuo = ($sum % 10);
        if($residuo == 0) $verificador = 0;
        else $verificador = 10 - $residuo;

        if($verificador == $ultimoDigito) $result = "SI";
        else $result = "NO";
    } else $result = "NO";

    #return $verificador;
    return $result;
}
  
 


function validarRUC($strRUC)
{
   $cedularuc=substr($strRUC,0,-3);   
   $datoruc=substr($strRUC, -3);
  
   if($datoruc=='001')
   {
      return $this->validarCI($cedularuc);   
   }
   else
   {
    return 'NO';
   
   }
   
}

function validarID($strId)
{
   switch(strlen($strId)) {
      case 10:
         return $this->validarCI($strId);
         break;
      case 13:
	     //return $this->validarRUC($strId);
		 return 'SI';
         break;
      default:
         return 'NO';
   }
}


///////////////////////////////////////////////////////////

function num2letras($num, $fem = false, $dec = true) { 
//if (strlen($num) > 14) die("El n?mero introducido es demasiado grande"); 
   $matuni[2]  = "dos"; 
   $matuni[3]  = "tres"; 
   $matuni[4]  = "cuatro"; 
   $matuni[5]  = "cinco"; 
   $matuni[6]  = "seis"; 
   $matuni[7]  = "siete"; 
   $matuni[8]  = "ocho"; 
   $matuni[9]  = "nueve"; 
   $matuni[10] = "diez"; 
   $matuni[11] = "once"; 
   $matuni[12] = "doce"; 
   $matuni[13] = "trece"; 
   $matuni[14] = "catorce"; 
   $matuni[15] = "quince"; 
   $matuni[16] = "dieciseis"; 
   $matuni[17] = "diecisiete"; 
   $matuni[18] = "dieciocho"; 
   $matuni[19] = "diecinueve"; 
   $matuni[20] = "veinte"; 
   $matunisub[2] = "dos"; 
   $matunisub[3] = "tres"; 
   $matunisub[4] = "cuatro"; 
   $matunisub[5] = "quin"; 
   $matunisub[6] = "seis"; 
   $matunisub[7] = "sete"; 
   $matunisub[8] = "ocho"; 
   $matunisub[9] = "nove"; 

   $matdec[2] = "veint"; 
   $matdec[3] = "treinta"; 
   $matdec[4] = "cuarenta"; 
   $matdec[5] = "cincuenta"; 
   $matdec[6] = "sesenta"; 
   $matdec[7] = "setenta"; 
   $matdec[8] = "ochenta"; 
   $matdec[9] = "noventa"; 
   $matsub[3]  = 'mill'; 
   $matsub[5]  = 'bill'; 
   $matsub[7]  = 'mill'; 
   $matsub[9]  = 'trill'; 
   $matsub[11] = 'mill'; 
   $matsub[13] = 'bill'; 
   $matsub[15] = 'mill'; 
   $matmil[4]  = 'millones'; 
   $matmil[6]  = 'billones'; 
   $matmil[7]  = 'de billones'; 
   $matmil[8]  = 'millones de billones'; 
   $matmil[10] = 'trillones'; 
   $matmil[11] = 'de trillones'; 
   $matmil[12] = 'millones de trillones'; 
   $matmil[13] = 'de trillones'; 
   $matmil[14] = 'billones de trillones'; 
   $matmil[15] = 'de billones de trillones'; 
   $matmil[16] = 'millones de billones de trillones'; 

   $num = trim((string)@$num); 
   if ($num[0] == '-') { 
      $neg = 'menos '; 
      $num = substr($num, 1); 
   }else 
      $neg = ''; 
   while ($num[0] == '0') $num = substr($num, 1); 
   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num; 
   $zeros = true; 
   $punt = false; 
   $ent = ''; 
   $fra = ''; 
   for ($c = 0; $c < strlen($num); $c++) { 
      $n = $num[$c]; 
      if (! (strpos(".,'''", $n) === false)) { 
         if ($punt) break; 
         else{ 
            $punt = true; 
            continue; 
         } 

      }elseif (! (strpos('0123456789', $n) === false)) { 
         if ($punt) { 
            if ($n != '0') $zeros = false; 
            $fra .= $n; 
         }else 

            $ent .= $n; 
      }else 

         break; 

   } 
   $ent = '     ' . $ent; 
   if ($dec and $fra and ! $zeros) { 
      $fin = ' coma'; 
      for ($n = 0; $n < strlen($fra); $n++) { 
         if (($s = $fra[$n]) == '0') 
            $fin .= ' cero'; 
         elseif ($s == '1') 
            $fin .= $fem ? ' una' : ' un'; 
         else 
            $fin .= ' ' . $matuni[$s]; 
      } 
   }else 
      $fin = ''; 
   if ((int)$ent === 0) return 'Cero ' . $fin; 
   $tex = ''; 
   $sub = 0; 
   $mils = 0; 
   $neutro = false; 
   while ( ($num = substr($ent, -3)) != '   ') { 
      $ent = substr($ent, 0, -3); 
      if (++$sub < 3 and $fem) { 
         $matuni[1] = 'una'; 
         $subcent = 'as'; 
      }else{ 
         $matuni[1] = $neutro ? 'un' : 'uno'; 
         $subcent = 'os'; 
      } 
      $t = ''; 
      $n2 = substr($num, 1); 
      if ($n2 == '00') { 
      }elseif ($n2 < 21) 
         $t = ' ' . $matuni[(int)$n2]; 
      elseif ($n2 < 30) { 
         $n3 = $num[2]; 
         if ($n3 != 0) $t = 'i' . $matuni[$n3]; 
         $n2 = $num[1]; 
         $t = ' ' . $matdec[$n2] . $t; 
      }else{ 
         $n3 = $num[2]; 
         if ($n3 != 0) $t = ' y ' . $matuni[$n3]; 
         $n2 = $num[1]; 
         $t = ' ' . $matdec[$n2] . $t; 
      } 
      $n = $num[0]; 
      if ($n == 1) { 
         $t = ' ciento' . $t; 
      }elseif ($n == 5){ 
         $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t; 
      }elseif ($n != 0){ 
         $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t; 

      } 
      if ($sub == 1) { 
      }elseif (! isset($matsub[$sub])) { 
         if ($num == 1) { 
            $t = ' mil'; 
         }elseif ($num > 1){ 
            $t .= ' mil'; 
         } 
      }elseif ($num == 1) { 
         $t .= ' ' . $matsub[$sub] . 'ón'; // Modificacion por p4scu41
      }elseif ($num > 1){ 
         $t .= ' ' . $matsub[$sub] . 'ones'; 
      }   
      if ($num == '000') $mils ++; 
      elseif ($mils != 0) { 
         if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub]; 
         $mils = 0; 
      } 
      $neutro = true; 
      $tex = $t . $tex; 
   } 
   $tex = $neg . substr($tex, 1) . $fin; 
   return ucfirst($tex); 
}

//////////////////////////////////////////////////////////


}

?>