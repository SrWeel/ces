<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44454000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");

for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {

  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");

 } 
 
function calculaedad($date2){
$diff = abs(strtotime($date2) - strtotime('1999-11-04'));
$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
return $years;
} 
 
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$centro_id=$_GET["centro_id"];
$numero_mes=$_GET["mes_valor"];
$anio_valor=$_GET["anio_valor"];
$nombremes=$nombre_mes[$_GET["mes_valor"]];
$nombre_establ=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$centro_id,$DB_gogess);

$periodo='';
$periodo=$numero_mes."-".$anio_valor;
$fecha_hoy=date("Y-m-d");

//lee planilla
$lee_plantilla=$objformulario->replace_cmb("dns_planillasplantillas","plapln_id,plapln_plantilla"," where plapln_id=",3,$DB_gogess); 
$lee_logo1=$objformulario->replace_cmb("dns_planillasplantillas","plapln_id,plapln_grafico1"," where plapln_id=",1,$DB_gogess);
$lee_logo2=$objformulario->replace_cmb("dns_planillasplantillas","plapln_id,plapln_grafico2"," where plapln_id=",1,$DB_gogess);
$lee_logo3=$objformulario->replace_cmb("dns_planillasplantillas","plapln_id,plapln_grafico3"," where plapln_id=",1,$DB_gogess);
$lee_logo4=$objformulario->replace_cmb("dns_planillasplantillas","plapln_id,plapln_grafico4"," where plapln_id=",1,$DB_gogess);
$lee_logo5=$objformulario->replace_cmb("dns_planillasplantillas","plapln_id,plapln_grafico5"," where plapln_id=",1,$DB_gogess);
//lee planilla

$cabecera_plailla='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Planilla MSP</title>
</head>
<body>
<style type="text/css">
<!--
.css_txtval {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.css_txttitulo {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo1 {
	font-size: 10px;
	font-weight: bold;
}
.Estilo2 {font-size: 10px}
-->
</style>';


$pie_planilla='</body>
</html>
';

$lee_plantilla=$cabecera_plailla.$lee_plantilla.$pie_planilla;

$busca_paratarifar="select 
cuabas_fecharegistro,
atenc_fechaingreso,
atenc_fechasalida,
centro_ruc,
centro_nombre,
UPPER(tiposerv_nombre) as tiposerv_nombre,
atenc_condiciondeingreso,
atenc_hc,
dns_anamesisexamenfisico.anam_enlace,
atenc_condiciondeegreso,
clie_rucci,
CONCAT(clie_apellido,' ',clie_nombre) as clie_nombre,
clie_apellido,
clie_fechanacimiento,
clie_genero,
clie_nombretitulardelseguro,
clie_numerodecedulatitular,
clie_paretesco,
usua_ciruc,
usua_nombre,
usua_formaciondelprofesional,
app_usuario.nac_id,
'HONORARIOS PROFESIONALES' as prod_famprod,
dns_cuadrobasico.prod_codigo,
prod_descripcion,
dns_cuadrobasico.prod_precio
from dns_atencion 
inner join app_cliente on dns_atencion.clie_id=app_cliente.clie_id
inner join dns_anamesisexamenfisico on dns_atencion.clie_id=dns_anamesisexamenfisico.clie_id
inner join dns_cuadrobasico on dns_anamesisexamenfisico.anam_enlace=dns_cuadrobasico.anam_enlace
inner join dns_tiposervicio on dns_atencion.tiposerv_id=dns_tiposervicio.tiposerv_id
inner join efacsistema_producto on efacsistema_producto.prod_codigo=dns_cuadrobasico.prod_codigo 
inner join app_usuario on dns_cuadrobasico.usua_id=app_usuario.usua_id
inner join dns_centrosalud on dns_atencion.centro_id=dns_centrosalud.centro_id
where dns_atencion.centro_id='".$_GET["centro_id"]."' and cuabas_fecharegistro like '".$_GET["anio_valor"]."-".$_GET["mes_valor"]."-%' and  prod_nivel=1";

//echo "<br>";
//Medicamentos
$busca_recetas="select 
plantra_fechadespacho as cuabas_fecharegistro,
atenc_fechaingreso,
atenc_fechasalida,
centro_ruc,
centro_nombre,
'MEDICACION' as tiposerv_nombre,
atenc_condiciondeingreso,
atenc_hc,
dns_anamesisexamenfisico.anam_enlace,
atenc_condiciondeegreso,
clie_rucci,
CONCAT(clie_apellido,' ',clie_nombre) as clie_nombre,
clie_apellido,
clie_fechanacimiento,
clie_genero,
clie_nombretitulardelseguro,
clie_numerodecedulatitular,
clie_paretesco,
usua_ciruc,
usua_nombre,
usua_formaciondelprofesional,
app_usuario.nac_id,
'MEDICACION' as prod_famprod,
dns_recetaanamesisexamenfisico.plantra_codigo as prod_codigo,
CONCAT(plantra_medicamento,' ',plantra_concentracion) as prod_descripcion,
dns_recetaanamesisexamenfisico.plantra_preciotecho as prod_precio

from dns_atencion 
inner join app_cliente on dns_atencion.clie_id=app_cliente.clie_id
inner join dns_anamesisexamenfisico on dns_atencion.clie_id=dns_anamesisexamenfisico.clie_id
inner join dns_recetaanamesisexamenfisico on dns_anamesisexamenfisico.anam_enlace=dns_recetaanamesisexamenfisico.anam_enlace
inner join dns_tiposervicio on dns_atencion.tiposerv_id=dns_tiposervicio.tiposerv_id
inner join dns_cuadrobasicomedicamentos on dns_cuadrobasicomedicamentos.cuadrobm_codigoatc=dns_recetaanamesisexamenfisico.plantra_codigo 
inner join app_usuario on dns_recetaanamesisexamenfisico.usua_id=app_usuario.usua_id
inner join dns_centrosalud on dns_atencion.centro_id=dns_centrosalud.centro_id
where dns_atencion.centro_id='".$_GET["centro_id"]."' and plantra_despachado='SI' and plantra_fechadespacho like '".$_GET["anio_valor"]."-".$_GET["mes_valor"]."-%'";


$union_data=$busca_paratarifar.' UNION '.$busca_recetas." order by clie_apellido asc";

$genera_sumado="select clie_rucci,clie_nombre,sum(prod_precio) as prod_precio from ((".$union_data.") as dns) group by clie_rucci";

$nombre_establ=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$centro_id,$DB_gogess);

$cuadro_lista='';
$cuadro_lista.='<table width="800" border="1" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>No</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>CODIGO DE VALIDACION/CARGA</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>IDENTIFICACION No</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>BENEFICIARIO</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>VALOR TOTAL SOLICITADO</strong></div></td>
  </tr>';
  

$cuenta_val=array();
$numera=0;
$numeracion_exp=0;
$rs_btarifario = $DB_gogess->executec($genera_sumado,array());

$totalexp=0;

if($rs_btarifario)
	{
		while (!$rs_btarifario->EOF) {
		      
			  $totalexp++;
			  $cuadro_lista.='<tr>';
		      $cuadro_lista.='<td><span class="css_txtval">'.$totalexp.'</span></td>';
			  $cuadro_lista.='<td><span class="css_txtval"></span></td>';
			  $cuadro_lista.='<td><span class="css_txtval">'.$rs_btarifario->fields["clie_rucci"].'</span></td>';
			  $cuadro_lista.='<td><span class="css_txtval">'.$rs_btarifario->fields["clie_nombre"].'</span></td>';
		      $cuadro_lista.='<td><span class="css_txtval">'.number_format($rs_btarifario->fields["prod_precio"], 2, '.', '').'</span></td>';
		      $cuadro_lista.='</tr>';
			  
			  $calcula_gestion=$rs_btarifario->fields["prod_precio"]*0.10;
	          $calcula_gestion=number_format($calcula_gestion, 2, '.', '');
			  
			  $valor_sumado=0;
	          $valor_sumado=number_format($rs_btarifario->fields["prod_precio"], 2, '.', '')+$calcula_gestion;
	          $total_sumado=$total_sumado+$valor_sumado;
	
			$rs_btarifario->MoveNext();			
		}
	}	


$cuadro_lista.='</table>';

$logo_data1='<img src="../../../../archivo/'.$lee_logo1.'" style="height:98px; width:123px" />';
$logo_data2='<img src="../../../../archivo/'.$lee_logo2.'" style="height:98px; width:123px" />';

$lee_plantilla=str_replace("-grafico1-",$logo_data,$lee_plantilla);
$lee_plantilla=str_replace("-grafico2-",$logo_data,$lee_plantilla);

$lee_plantilla=str_replace("-listados-",$cuadro_lista,$lee_plantilla);
$lee_plantilla=str_replace("-numero-",$codigo_val,$lee_plantilla);
$lee_plantilla=str_replace("-totalsumado-",$total_sumado,$lee_plantilla);
$lee_plantilla=str_replace("-expediente-",$totalexp,$lee_plantilla);
$lee_plantilla=str_replace("-establecimiento-",$nombesta,$lee_plantilla);
$lee_plantilla=str_replace("-mesanio-",$periodo,$lee_plantilla);
$lee_plantilla=str_replace("-fecha-",$fecha_hoy,$lee_plantilla);


echo utf8_encode($lee_plantilla);
}
?>

