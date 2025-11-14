<?php
class funciones_calculo{


	function dateadd($date, $dd=0, $mm=0, $yy=0, $hh=0, $mn=0, $ss=0){
	
		$date_r = getdate(strtotime($date));
	
		$date_result = date("Y-m-d", mktime(($date_r["hours"]+$hh),($date_r["minutes"]+$mn),($date_r["seconds"]+$ss),($date_r["mon"]+$mm),($date_r["mday"]+$dd),($date_r["year"]+$yy)));
	
		return $date_result;
	
	}

		function formatear_fecha($fecha) {
			$a = explode ("-", $fecha);
			$fecha_formateada = $a[1]."/".$a[2]."/".$a[0];
			return $fecha_formateada;
		}

  function restarfechas($startDate,$endDate)
  {
		list($year, $month, $day) = explode('-', $startDate);  
		$startDate = mktime(0, 0, 0, $month, $day, $year);  
		list($year, $month, $day) = explode('-', $endDate);  
		$endDate = mktime(0, 0, 0, $month, $day, $year);  
		$totalDays = ($endDate - $startDate)/(60 * 60 * 24) ;  
		return floor($totalDays);
  }
	 function fechahoy()
	 {
	   $fechahoy=date("Y-m-d");
	   return $fechahoy;
	 }

}


?>