<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444500000;

if(@$_GET["excel"]==1)
{
header('Content-type: application/vnd.ms-excel');
$fechahoy=date("Y-m-d");
header("Content-Disposition: attachment; filename="."rep_".$fechahoy.".xls");
}

ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

if(@$_GET["excel"]==1)
{
$anio_id=$_GET["anio_id"];
$mes_id=$_GET["mes_id"];
$usua_id=$_GET["usua_id"];
}
else
{
$anio_id=$_POST["anio_id"];
$mes_id=$_POST["mes_id"];
$usua_id=$_POST["usua_id"];

}



$lista_mes[1]='ENERO';
$lista_mes[2]='FEBRERO';
$lista_mes[3]='MARZO';
$lista_mes[4]='ABRIL';
$lista_mes[5]='MAYO';
$lista_mes[6]='JUNIO';
$lista_mes[7]='JULIO';
$lista_mes[8]='AGOSTO';
$lista_mes[9]='SEPTIEMBRE';
$lista_mes[10]='OCTUBRE';
$lista_mes[11]='NOVIEMBRE';
$lista_mes[12]='DICIEMBRE';

$number = cal_days_in_month(CAL_GREGORIAN, $mes_id, $anio_id); // 31
//echo $number;
?>
<style type="text/css">
<!--
.css_titulo {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>

<div align="center"><span class="css_titulo"><b>PICHINCHA HUMANA<br>
  PRESTACION POR ITEMES <br>
  SALUD<br>
  DEL 1 DE <?php echo $lista_mes[$mes_id]; ?> DEL <?php echo $anio_id; ?> AL <?php echo $number; ?> DE <?php echo $lista_mes[$mes_id]; ?> DEL <?php echo $anio_id; ?></b></span><br>
</div>





<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td class="css_titulo">Centro</td>
    <td class="css_titulo">&nbsp;</td>
    <td class="css_titulo">&nbsp;</td>
  </tr>
  <tr>
    <td class="css_titulo">Item</td>
    <td class="css_titulo">Nombre del Empleado </td>
    <td class="css_titulo">Atenci&oacute;n</td>
  </tr>
</table>
<?php
$lista_centro="select distinct beko_documentocabecera.centro_id,centro_nombreprint from beko_documentocabecera inner join beko_documentodetalle on beko_documentocabecera.doccab_id=beko_documentodetalle.doccab_id inner join dns_centrosalud on beko_documentocabecera.centro_id=dns_centrosalud.centro_id where usuaat_id='".$usua_id."' and year(doccab_fechaemision_cliente)='".$anio_id."' and month(doccab_fechaemision_cliente)='".$mes_id."'";
$rs_centroli = $DB_gogess->executec($lista_centro,array());
if($rs_centroli)
        {
			while (!$rs_centroli->EOF) {
			
	        echo '<span class="css_titulo" ><b>'.$rs_centroli->fields["centro_nombreprint"].'</b></span><br>';
			
			
			$saca_equeatendio="select distinct 	docdet_codprincipal,docdet_descripcion from beko_documentocabecera inner join beko_documentodetalle on beko_documentocabecera.doccab_id=beko_documentodetalle.doccab_id inner join dns_centrosalud on beko_documentocabecera.centro_id=dns_centrosalud.centro_id where usuaat_id='".$usua_id."' and beko_documentocabecera.centro_id='".$rs_centroli->fields["centro_id"]."' and year(doccab_fechaemision_cliente)='".$anio_id."' and month(doccab_fechaemision_cliente)='".$mes_id."' and doccab_anulado=0";
			$rs_atendio = $DB_gogess->executec($saca_equeatendio,array());
			if($rs_atendio)
            {
				while (!$rs_atendio->EOF) {
				
				echo "<div class='css_titulo'><b>".$rs_atendio->fields["docdet_descripcion"]."</b></div>";
				$nombre_prof="select * from app_usuario where usua_id='".$usua_id."'";
				$rs_prof = $DB_gogess->executec($nombre_prof,array());
				echo "<div class='css_titulo'>Prof: ".$rs_prof->fields["usua_nombre"].' '.$rs_prof->fields["usua_apellido"]."</div>";
				
				?>
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td class="css_titulo">Cliente</td>
					<td class="css_titulo">Fecha</td>
					<td class="css_titulo">Cantidad</td>
				  </tr>
				<?php
				$SUMA_t=0;
				$lista_pacientes="select doccab_identificacionpaciente,doccab_fechaemision_cliente,docdet_cantidad,doccab_nombrerazon_cliente,doccab_apellidorazon_cliente from beko_documentocabecera inner join beko_documentodetalle on beko_documentocabecera.doccab_id=beko_documentodetalle.doccab_id inner join dns_centrosalud on beko_documentocabecera.centro_id=dns_centrosalud.centro_id where usuaat_id='".$usua_id."' and beko_documentocabecera.centro_id='".$rs_centroli->fields["centro_id"]."' and year(doccab_fechaemision_cliente)='".$anio_id."' and month(doccab_fechaemision_cliente)='".$mes_id."' and docdet_codprincipal='".$rs_atendio->fields["docdet_codprincipal"]."' and doccab_anulado=0";
				$rs_listaacientes = $DB_gogess->executec($lista_pacientes,array());
				if($rs_listaacientes)
                 {
				   while (!$rs_listaacientes->EOF) {
				   
				   $busca_paciente="select * from app_cliente where clie_rucci='".$rs_listaacientes->fields["doccab_identificacionpaciente"]."'";
				   $rs_bpaciente = $DB_gogess->executec($busca_paciente,array());
				   
				   $nombre_paciente=$rs_bpaciente->fields["clie_nombre"];
				   $apellido_paciente=$rs_bpaciente->fields["clie_apellido"]; 
				   
				   if($rs_bpaciente->fields["clie_nombre"]=='')
				   {
				      $nombre_paciente=$rs_listaacientes->fields["doccab_nombrerazon_cliente"];
					  $apellido_paciente=$rs_listaacientes->fields["doccab_apellidorazon_cliente"];
				   }
				?> 				  
				  <tr>
					<td class="css_titulo"><?php echo $nombre_paciente." ".$apellido_paciente; ?></td>
					<td class="css_titulo"><?php echo $rs_listaacientes->fields["doccab_fechaemision_cliente"]; ?></td>
					<td class="css_titulo"><?php echo $rs_listaacientes->fields["docdet_cantidad"]; ?></td>
				  </tr>
				<?php
				   $SUMA_t=$SUMA_t+$rs_listaacientes->fields["docdet_cantidad"];
				
				       $rs_listaacientes->MoveNext();	
				    }
				}				
				?>  
				<tr>
					<td class="css_titulo"></td>
					<td class="css_titulo"><div align="center"><strong>SUBTOTAL EMPLEADO</strong></div></td>
					<td class="css_titulo"><?php echo $SUMA_t; ?></td>
				</tr>
				</table>
		
				<?php
					
				$rs_atendio->MoveNext();	
				}
			}
			
			
			
			$rs_centroli->MoveNext();
			}
		}	
?>

<?php
}

?>


