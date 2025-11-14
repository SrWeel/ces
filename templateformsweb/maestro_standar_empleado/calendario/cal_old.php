<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");


if(@$_POST["anio_idg"])

{

$year=@$_POST["anio_idg"];

}

else

{

$year=date("Y");



}



if(@$_POST["mes_idg"])

{

$month=@$_POST["mes_idg"];

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

<table id="calendar" width="900px" >

	<caption><?php echo $meses[$month]." ".$year?></caption>

	<tr>

		<th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th>

		<th>Vie</th><th>Sab</th><th>Dom</th>

	</tr>

	<tr bgcolor="silver">

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

				echo '<td width="130px" height="90px" onclick="selecciona_dia_general('.$comillas.$year.$comillas.','.$comillas.$mes_valor.$comillas.','.$comillas.$dia_valor.$comillas.')"; style="cursor:pointer; font-size:9px" >';

				

				$fecha_bu=$year."-".$mes_valor."-".$dia_valor;

				echo $dia_valor."<br>";

				$busca_citas="select faesa_integragrupo.usua_id,integr_hora,faesa_asigahorario.clie_id,clie_nombre,clie_apellido from faesa_asigahorario inner join faesa_integragrupo on faesa_asigahorario.grup_id=faesa_integragrupo.grup_id inner join app_cliente on faesa_asigahorario.clie_id=app_cliente.clie_id where asighor_fecha='".$fecha_bu."' and faesa_asigahorario.clie_id='".$_POST["clie_id"]."'";

				$rs_citas = $DB_gogess->executec($busca_citas,array());

				if($rs_citas)

                   {

	                  while (!$rs_citas->EOF) {	

					   

					   $nombre_medico="select * from app_usuario where usua_id=".$rs_citas->fields["usua_id"];

					   $rs_nmedico = $DB_gogess->executec($nombre_medico,array());

					   $nombres_p=array();
					   $nombres_p=explode(" ",$rs_citas->fields["clie_nombre"]);
					   
					   $apellido_p=array();
					   $apellido_p=explode(" ",$rs_citas->fields["clie_apellido"]);

					   echo ucwords(strtolower(utf8_encode($nombres_p[0].' '.$apellido_p[0]))).'('.$rs_nmedico->fields["usua_codigoiniciales"].')';
					   echo '<br>';

					  $rs_citas->MoveNext();	

					  }

				   }	  
		
				//terapias

				$busca_terapias="select * from faesa_terapiasregistro inner join app_cliente on  faesa_terapiasregistro.clie_id=app_cliente.clie_id  where terap_fecha='".$fecha_bu."' and faesa_terapiasregistro.clie_id='".$_POST["clie_id"]."' order by terap_hora asc";
				$rs_terapia = $DB_gogess->executec($busca_terapias,array());
				if($rs_terapia)
                   {

	                  while (!$rs_terapia->EOF) {	
					  
					    $alerta='';
						  if($rs_terapia->fields["terap_nfactura"]=='')
						  {
						    $alerta='<img src="images/red.png" width="10" height="10" />';
						  }
						  
						   if($rs_terapia->fields["terap_autorizacion"]!='')
						  {
						    $alerta='<img src="images/autorizado.png" width="10" height="10" />';
						  }
						  
					  
					  
					   $nombres_p=array();
					   $nombres_p=explode(" ",$rs_terapia->fields["clie_nombre"]);
					   
					   $apellido_p=array();
					   $apellido_p=explode(" ",$rs_terapia->fields["clie_apellido"]);  
							
						echo ucwords(strtolower(utf8_encode($nombres_p[0].' '.$apellido_p[0]))).'(T-'.$rs_terapia->fields["terap_hora"].')'.$alerta;
					    echo '<br />';
					   
					   $rs_terapia->MoveNext();
					  }
				   
				   }  
		

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