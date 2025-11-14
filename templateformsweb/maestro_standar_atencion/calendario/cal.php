<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
?>
<?php
if(@$_POST["anio_id"])
{
$year=@$_POST["anio_id"];
}
else
{
$year=date("Y");

}

if(@$_POST["mes_id"])
{
$month=@$_POST["mes_id"];
}
else
{

$month=date("n");
}

$diaActual=date("j");

# Obtenemos el dia de la semana del primer dia
# Devuelve 0 para domingo, 6 para sabado
$diaSemana=date("w",mktime(0,0,0,$month,1,$year))+7;
# Obtenemos el ultimo dia del mes
$ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));

$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio","Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$comillas="'";
?>
<div align="center">
<table id="calendar" width="600px" >
	<caption><?php echo $meses[$month]." ".$year?></caption>
	<tr>
		<th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th>
		<th>Vie</th><th>Sab</th><th>Dom</th>
	</tr>
	<tr bgcolor="silver" >
		<?php
		$last_cell=$diaSemana+$ultimoDiaMes;
		// hacemos un bucle hasta 42, que es el máximo de valores que puede
		// haber... 6 columnas de 7 dias
		for($i=1;$i<=42;$i++)
		{
			if($i==$diaSemana)
			{
				// determinamos en que dia empieza
				$day=1;
			}
			if($i<$diaSemana || $i>=$last_cell)
			{
				// celca vacia
				echo "<td  >&nbsp;</td>";
			}else{
				// mostramos el dia	
				$dia_valor=str_pad($day, 2, "0", STR_PAD_LEFT);
				$mes_valor=str_pad($month, 2, "0", STR_PAD_LEFT);
				echo '<td width="110px" height="90px" onclick="selecciona_dia('.$comillas.$year.$comillas.','.$comillas.$mes_valor.$comillas.','.$comillas.$dia_valor.$comillas.')"; style="cursor:pointer; font-size:9px"  >';
				
				$fecha_bu=$year."-".$mes_valor."-".$dia_valor;
				
				echo $dia_valor;
				echo '<ul>';
				$busca_citas="select * from dns_horarioterapia inner join dns_atencion on dns_horarioterapia.atenc_enlace=dns_atencion.atenc_enlace inner join app_cliente on dns_atencion.clie_id=app_cliente.clie_id where horat_fecha='".$fecha_bu."'";
				$rs_citas = $DB_gogess->executec($busca_citas,array());
				if($rs_citas)
                   {
	                  while (!$rs_citas->EOF) {	
					   
					   echo '<li>'.$rs_citas->fields["clie_nombre"].' '.$rs_citas->fields["clie_apellido"]."(".$rs_citas->fields["horat_horai"].")".'</li>';
					  
					  $rs_citas->MoveNext();	
					  }
				   }	  
				echo '</ul>';
				
				
				echo '</td>';
				
				
				
				
				$day++;
			}
			// cuando llega al final de la semana, iniciamos una columna nueva
			if($i%7==0)
			{
				echo "</tr><tr>\n";
			}
		}
	?>
	</tr>
</table>
</div>