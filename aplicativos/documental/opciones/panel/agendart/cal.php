<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
?>
<style type="text/css">
<!--
.css_alerta {
	font-size: 12px;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #FF0000;
}
-->
</style>
<?php
if(@$_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");


$bandera_activa=0;
if(@$_POST["areag"]!='' and @$_POST["usua_idvaltx"]!='')
{
  $bandera_activa=1;
}

if($bandera_activa==0)
{

 echo "<div class='css_alerta' ><center>POR FAVOR SELECCIONE EL AREA Y EL TERAPEUTA PARA PODER AGENDAR....</center></div>";
}

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
if(@$_POST["areag"])
{
   $sql1=" especi_id='".$_POST["areag"]."' and ";
}

$sql2='';
if(@$_SESSION['ces1313777_jobt_id']!=13)
{

if(@$_POST["centro_id"])
{
   $sql2=" tu.centro_id='".$_POST["centro_id"]."' and ";
}

}

$sql3='';
if(@$_POST["usua_idvaltx"])
{
   $sql3=" tu.usua_id='".$_POST["usua_idvaltx"]."' and ";

}

$sql4='';
if(@$_POST["clie_id"])
{
  // $sql4=" cli.clie_id='".$_POST["clie_id"]."' and ";

}

//$_POST["clie_id"]


$concatena_data=$sql1.$sql2.$sql3.$sql4;
$diaActual=date("j");

# Obtenemos el dia de la semana del primer dia
# Devuelve 0 para domingo, 6 para sabado
$diaSemana=date("w",mktime(0,0,0,$month,1,$year))+7;
# Obtenemos el ultimo dia del mes
$ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));
$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio","Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$comillas="'";
$fecha_actualdt=date("Y-m-d");
?>
<style>
		#calendar {
			font-family:Arial;
			font-size:12px;
		}
		#calendar caption {
			text-align:left;
			padding:5px 10px;
			background-color:#DFEAF2;
			color:#000000;
			font-weight:bold;
		}
		#calendar th {
			background-color:#006699;
			color:#fff;
			width:40px;
			border:thin solid #000000;
		}
		#calendar td {
			text-align: right;
            padding: 2px 5px;
            border: thin solid #1f1f2a;
		}
		#calendar .hoy {
			background-color:red;
		}
       .Estilo3 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
</style>
<div align="center">
<?php
//$nombre_paciente="select * from app_cliente where clie_id=".$_POST["clie_id"];
// $rs_nombrepaciente = $DB_gogess->executec($nombre_paciente,array());
?>


<table id="calendar" width="1050px" >
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
				echo '<td  valign="top" height="40px" onclick="selecciona_dia_general('.$comillas.$year.$comillas.','.$comillas.$mes_valor.$comillas.','.$comillas.$dia_valor.$comillas.')"; style=" font-size:9px" >';
				$fecha_bu=$year."-".$mes_valor."-".$dia_valor;
				echo $dia_valor."<br>";
				
				 
				
				$link_agregar='';//$link_agregar="abrir_standar('aplicativos/documental/opciones/panel/agendar/seleccion.php','PANTALLA','divBody_pantallag','divDialog_pantallag',600,590,'".$fecha_bu."','".$_POST["atenc_hc"]."','".$_POST["clie_id"]."','".@$_POST["centro_id"]."','".@$_SESSION['ces1313777_sessid_inicio']."',0,0); ";
				
				echo '<table border="0" cellpadding="0" cellspacing="0"  >';
				
				if($fecha_actualdt<$fecha_bu)
				{
				   if($bandera_activa==1)
				   {
				   $link_agregar='';
				echo '<tr>
					<td colspan="2" style="border:thin; color:#FFFFFF; cursor:pointer" onclick="'.$link_agregar.'" ></td>
					 </tr>';
					 }
				}
				else
				{
				echo '<tr>
					<td colspan="2" style="border:thin; color:#FFFFFF;" >&nbsp;</td>
					 </tr>';
				
				}
				
				if($concatena_data)
				{

				$busca_citas="select tu.usua_id,integr_hora,faesa_asigahorario.clie_id,clie_nombre,clie_apellido,atenc_id from faesa_asigahorario inner join faesa_integragrupo tu on faesa_asigahorario.grup_id=tu.grup_id inner join app_cliente cli on faesa_asigahorario.clie_id=cli.clie_id where ".$concatena_data." asighor_fecha='".$fecha_bu."'";

				}
				else
				{


				$busca_citas="select tu.usua_id,integr_hora,faesa_asigahorario.clie_id,clie_nombre,clie_apellido,atenc_id from faesa_asigahorario inner join faesa_integragrupo tu on faesa_asigahorario.grup_id=tu.grup_id inner join app_cliente cli on faesa_asigahorario.clie_id=cli.clie_id where asighor_fecha='".$fecha_bu."'";

				}

				$rs_citas = $DB_gogess->executec($busca_citas,array());
				if($rs_citas)
                   {
	                  while (!$rs_citas->EOF) {	

                      
					   $link_data=" onclick=ver_formularioenpantalla('aplicativos/documental/datos_standarterapia.php','Editar','divBody_ext',".$rs_citas->fields["atenc_id"].",'42',0,0,0,0,0) style='cursor:pointer;' ";



					   $nombre_medico="select * from app_usuario where usua_id=".$rs_citas->fields["usua_id"];
					   $rs_nmedico = $DB_gogess->executec($nombre_medico,array());
					   
					   $color='';
					   //identifica al ninio
					   if($_POST["clie_id"]==$rs_citas->fields["clie_id"])
					   {
					      $color='bgcolor="#E8E8E8"';
					   }
					   else
					   {
					      $color='';
					   }
					   //identifica al ninio
					   

					   echo '<tr>
						     <td '.$color.' >&nbsp;</td>
						     <td '.$color.' >'.$rs_nmedico->fields["usua_codigoiniciales"].' - '.$rs_citas->fields["integr_hora"].'</td>
							 <td '.$color.' >'.utf8_encode($rs_citas->fields["clie_nombre"]).'</td>
					        </tr>';

					  

					  $rs_citas->MoveNext();	

					  }

				   }	  

			
				
				//terapias

                if($concatena_data)
					  {
				$busca_terapias="select terap_id,tu.especi_id,tu.usua_id,terap_hora,cli.clie_id,clie_nombre,clie_apellido,tipopac_id from faesa_terapiasregistro  tu inner join app_cliente cli on  tu.clie_id=cli.clie_id  where ".$concatena_data." terap_fecha='".$fecha_bu."' order by terap_hora asc";
				  }
				  else
				  {
				  $busca_terapias="select terap_id,tu.especi_id,tu.usua_id,terap_hora,cli.clie_id,clie_nombre,clie_apellido,tipopac_id from faesa_terapiasregistro  tu inner join app_cliente cli on  tu.clie_id=cli.clie_id  where terap_fecha='".$fecha_bu."' order by terap_hora asc";
				  
				  }
				//echo $busca_terapias;
				$rs_terapia = $DB_gogess->executec($busca_terapias,array());
				$cuenta=0;
				if($rs_terapia)
                   {
                      
	                  while (!$rs_terapia->EOF) {	
					          $estado=0;
					         //ver area
							   $lista_area="select * from dns_especialidad where especi_id=".$rs_terapia->fields["especi_id"];
							   $rs_area = $DB_gogess->executec($lista_area,array());
							 //ver area
							 //inciial del terapista
							 $nombre_medico="select * from app_usuario where usua_id=".$rs_terapia->fields["usua_id"];
					         $rs_nmedico = $DB_gogess->executec($nombre_medico,array());
							 
							 //inicial del treraposta
							 $link_b="";
							  $img_b="";
							// if($fecha_actualdt<$fecha_bu)
				             //{
							 $link_b="borrar_terapia('faesa_terapiasregistro','terap_id','".$rs_terapia->fields["terap_id"]."')";
							 $img_b='<img src="images/borrar_t.png" />';
							 //}
							// else
							// {
							// $link_b="";
							// $img_b="";
							 
							// }
							 
							   $color='';
							   //identifica al ninio
							   //if($_POST["clie_id"]==$rs_terapia->fields["clie_id"])
							   //{
								//  $color='bgcolor="#E8E8E8"';
							  // }
							  // else
							  // {
								  //$color='';
							  // }
							   //identifica al ninio
							 $click_fisico="onclick=facturas_fisicas('".$rs_terapia->fields["terap_id"]."')";
							 
							 $click_cambiohorario="onclick=cambio_horario('".$rs_terapia->fields["terap_id"]."')";;
							 $estado=$objvarios->verifica_siyafuepagada($rs_terapia->fields["terap_id"],$rs_terapia->fields["clie_id"],$DB_gogess);
							 if($estado==1)
							 {
							 $link_b='';
							 $img_b='';
							 }
							 $nissfa='';
							 if($rs_terapia->fields["tipopac_id"]==1)
							 {
							    $link_b="borrar_terapia('faesa_terapiasregistro','terap_id','".$rs_terapia->fields["terap_id"]."')";
							    $img_b='<img src="images/borrar_t.png" />';
								$nissfa='ISSFA<br>';
							 }
							 
							 echo '<tr>
						     <td onclick="'.$link_b.'" style="cursor:pointer" '.$color.' >'.$img_b.'</td>
						     <td style="color:#3169D2" '.$color.' '.$click_fisico.' ><b>'.$nissfa;
							 
							 
							 if($estado==0)
							 {
							   echo "<span style='color:#FF0000' >No pagado</span>";
							 }
							 

							 echo ' T-'.$rs_area->fields["especi_iniciales"].' '.$rs_terapia->fields["terap_hora"].'<br>'.$rs_nmedico->fields["usua_codigoiniciales"].'</b></td>
							 <td '.$color.' >'.ucwords(strtolower(utf8_encode($rs_terapia->fields["clie_nombre"]." ".$rs_terapia->fields["clie_apellido"]))).'
							 <div '.$click_cambiohorario.' style="cursor:pointer" >
							 <img src="images/cambio_horario.png" width="30" height="26" />
							 </div>
							 </td>
					        </tr>';

							 $cuenta++;
					   
					   $rs_terapia->MoveNext();
					  }
				   
				   }  

                echo '</table>';
				

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
<br />
<div align="center">


<table id="calendar" width="1050px" border="0" >
<tr>
<td width="321">
<div id="grid_borrart"></div>
</td>
<td width="319">
<b>T: Terapia</b><br />
<?php
$lista_t="select * from dns_especialidad where especi_id not in(5,6)";
$rs_t = $DB_gogess->executec($lista_t,array());
	if($rs_t)
       {
	         while (!$rs_t->EOF) 
			 {	
					  
				echo '<b>'.$rs_t->fields["especi_iniciales"].': '.utf8_encode($rs_t->fields["especi_nombre"]).'</b><br>';
				
				$rs_t->MoveNext();	  
			 }
		}  
?>
</td>
</tr>
</table>
</div>
<div id="divBody_pantallag" ></div>
<div id="divBody_fisica"></div>

<center>


<input name="busca_paciente" type="text" id="busca_paciente" value="" />
<input type="button" name="Submit" value="Buscar" onclick="busca_paciente()" />
<div id="listap"></div>
</center>

<script type="text/javascript">
<!--
function busca_paciente()
{

$("#listap").load("aplicativos/documental/opciones/panel/agendart/lista_hc.php",{
  busca_paciente:$('#busca_paciente').val()

 },function(result){       


  });  

$("#listap").html("Espere un momento...");

}


function facturas_fisicas(terap_id)
{
      abrir_standar("aplicativos/documental/opciones/panel/agendar/facturafisica.php","FacturaFisica","divBody_fisica","divDialog_fisica",400,400,terap_id,0,0,0,0,0,0);
   
}

function cambio_horario(terap_id)
{
      abrir_standar("aplicativos/documental/opciones/panel/agendar/cambiohorario.php","CambioHorario","divBody_fisica","divDialog_fisica",400,400,terap_id,0,0,0,0,0,0);
   
}
//  End -->
</script>

<?php
}
else
{
 echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; ">Tu sesi&oacute;n ha expirado, ingrese su usuario y clave y vuelva a seleccionar la opci&oacute;n</div>';
//enviar
//$varable_enviafunc=base64_encode("desplegar_grid_atencion();");
$varable_enviafunc='';
//enviar
echo '
<script type="text/javascript">
<!--
abrir_standar("aplicativos/documental/activar_sesion.php","Activar_Sesi&oacute;n","divBody_acsession","divDialog_acsession",400,400,"'.$varable_enviafunc.'",0,0,0,0,0,0);
//  End -->
</script>

<div id="divBody_acsession"></div>
';

}

?>