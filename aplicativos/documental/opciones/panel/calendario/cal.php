<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if(@$_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");


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



$buscapor='';

$sql1='';

if($_POST["areag"])

{



   $sql1=" especi_id='".$_POST["areag"]."' and ";

}



$concatena_data=$sql1;





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

				echo '<td  height="90px" onclick="selecciona_dia_general('.$comillas.$year.$comillas.','.$comillas.$mes_valor.$comillas.','.$comillas.$dia_valor.$comillas.')"; style=" font-size:9px" > <div class="TableScroll_grid" >';

				

				$fecha_bu=$year."-".$mes_valor."-".$dia_valor;

				echo $dia_valor;


				if($concatena_data)
				{

				$busca_citas="select faesa_integragrupo.usua_id,integr_hora,faesa_asigahorario.clie_id,clie_nombre,clie_apellido,atenc_id,faesa_asigahorario.grup_id from faesa_asigahorario inner join faesa_integragrupo on faesa_asigahorario.grup_id=faesa_integragrupo.grup_id inner join app_cliente on faesa_asigahorario.clie_id=app_cliente.clie_id where ".$concatena_data." asighor_fecha='".$fecha_bu."'";

				}
				else
				{

				$busca_citas="select faesa_integragrupo.usua_id,integr_hora,faesa_asigahorario.clie_id,clie_nombre,clie_apellido,atenc_id,faesa_asigahorario.grup_id from faesa_asigahorario inner join faesa_integragrupo on faesa_asigahorario.grup_id=faesa_integragrupo.grup_id inner join app_cliente on faesa_asigahorario.clie_id=app_cliente.clie_id where asighor_fecha='".$fecha_bu."'";

				}

				

				$rs_citas = $DB_gogess->executec($busca_citas,array());

				if($rs_citas)
                   {

	                  while (!$rs_citas->EOF) {	

					   
					   $grupos_locales="select * from faesa_grupos where grup_id=".$rs_citas->fields["grup_id"];
					   $rs_grlocal = $DB_gogess->executec($grupos_locales,array());
					   
					   
                       if($rs_grlocal->fields["centro_id"]==$_SESSION['ces1313777_centro_id'])
					   {
					   
					   $link_data=" onclick=ver_formularioenpantalla('aplicativos/documental/datos_standarterapia.php','Editar','divBody_ext',".$rs_citas->fields["atenc_id"].",'42',0,0,0,0,0) style='cursor:pointer;' ";

					   $nombre_medico="select * from app_usuario where usua_id=".$rs_citas->fields["usua_id"];

					   $rs_nmedico = $DB_gogess->executec($nombre_medico,array());

					   $nombres_p=array();
					   $nombres_p=explode(" ",$rs_citas->fields["clie_nombre"]);
					   
					   $apellido_p=array();
					   $apellido_p=explode(" ",$rs_citas->fields["clie_apellido"]);

					   echo '<div '.$link_data.' > '.$nombres_p[0].' '.$apellido_p[0].'('.$rs_nmedico->fields["usua_codigoiniciales"].' - '.$rs_citas->fields["integr_hora"].')';
					   echo '</div>';
					   
                       }
					   

					  

					  $rs_citas->MoveNext();	

					  }

				   }	  

				
				//terapias

				$busca_terapias="select * from faesa_terapiasregistro inner join app_cliente on  faesa_terapiasregistro.clie_id=app_cliente.clie_id  where terap_fecha='".$fecha_bu."'";
				$rs_terapia = $DB_gogess->executec($busca_terapias,array());
				if($rs_terapia)
                   {

	                  while (!$rs_terapia->EOF) {	
					  
					   $grupos_locales="select * from app_usuario where usua_id=".$rs_terapia->fields["usua_id"];
					   $rs_grlocal = $DB_gogess->executec($grupos_locales,array());
					   
					   
                       if($rs_grlocal->fields["centro_id"]==$_SESSION['ces1313777_centro_id'])
					   {
					  
					   $nombres_p=array();
					   $nombres_p=explode(" ",$rs_terapia->fields["clie_nombre"]);
					   
					   $apellido_p=array();
					   $apellido_p=explode(" ",$rs_terapia->fields["clie_apellido"]);
							
							 echo '<div  > '.$nombres_p[0].' '.$apellido_p[0].'(TERAPIA-'.$rs_terapia->fields["terap_hora"].')';

					   echo '</div>';
					   
					   }
					   
					   $rs_terapia->MoveNext();
					  }
				   
				   }  
			

				echo '</div></td>';

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

<?php
}
else
{
echo '<div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Su sesi&oacute;n a caducado de precione F5 para continuar...</div>';
	
}		
?>

