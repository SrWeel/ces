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
$lee_plantilla=$objformulario->replace_cmb("dns_planillasplantillas","plapln_id,plapln_plantilla"," where plapln_id=",5,$DB_gogess); 
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
<title>Planilla RDACAA</title>
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
clie_nombre,
clie_apellido,
clie_fechanacimiento,
clie_genero,
clie_nombretitulardelseguro,
clie_numerodecedulatitular,
clie_paretesco,
tipoci_id,
usua_ciruc,
usua_nombre,
usua_apellido,
usua_formaciondelprofesional,
usua_msp,
usua_genero,
usua_fechanacimiento,
etn_id,
app_usuario.nac_id,
'HONORARIOS PROFESIONALES' as prod_famprod,
dns_cuadrobasico.prod_codigo,
prod_descripcion,
dns_cuadrobasico.prod_precio,
TIMESTAMPDIFF(year, clie_fechanacimiento, NOW()) AS edad_anio,
TIMESTAMPDIFF(month, clie_fechanacimiento, NOW())%12 AS edad_mes, 
TIMESTAMPDIFF( day, DATE_ADD( adddate(curdate(), day(clie_fechanacimiento) - day(curdate())), interval -(day(clie_fechanacimiento)>day(curdate())) month), curdate()) as edad_dia,
clie_numerodecedulatitular
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
clie_nombre,
clie_apellido,
clie_fechanacimiento,
clie_genero,
clie_nombretitulardelseguro,
clie_numerodecedulatitular,
clie_paretesco,
tipoci_id,
usua_ciruc,
usua_nombre,
usua_apellido,
usua_formaciondelprofesional,
usua_msp,
usua_genero,
usua_fechanacimiento,
etn_id,
app_usuario.nac_id,
'MEDICACION' as prod_famprod,
dns_recetaanamesisexamenfisico.plantra_codigo as prod_codigo,
CONCAT(plantra_medicamento,' ',plantra_concentracion) as prod_descripcion,
dns_recetaanamesisexamenfisico.plantra_preciotecho as prod_precio,
TIMESTAMPDIFF(year, clie_fechanacimiento, NOW()) AS edad_anio,
TIMESTAMPDIFF(month, clie_fechanacimiento, NOW())%12 AS edad_mes, 
TIMESTAMPDIFF( day, DATE_ADD( adddate(curdate(), day(clie_fechanacimiento) - day(curdate())), interval -(day(clie_fechanacimiento)>day(curdate())) month), curdate()) as edad_dia,
clie_numerodecedulatitular
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

//$genera_sumado="select centro_nombre,clie_rucci,clie_nombre,sum(prod_precio) as prod_precio from ((".$union_data.") as dns) group by clie_rucci";

$nombre_establ=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$centro_id,$DB_gogess);

$cuadro_lista='';
$cuadro_lista.='<table  border="1" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Unidad_Operativa</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>id_n&uacute;mero</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>D&iacute;a_atenci&oacute;n</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Mes_atenci&oacute;n</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>A&ntilde;o_atencion</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Lugar_atenci&oacute;n</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Apellidos_profesional</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Nombres_profesional</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Tipo_identificaci&oacute;n_profesional</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Identificacion_profesional</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Formacion_profesional</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Especialidad_subespecialidad_profesional</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Codigo_msp_profesional</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Sexo_profesional</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Fecha_nacimiento_profesional</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Nacionalidad_profesional</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Autoidentificaci&oacute;n_profesional</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Apellidos_paciente</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Nombres_paciente</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Tipo_identificaci&oacute;n_paciente</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Identificaci&oacute;n_paciente</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Sexo_paciente</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Fecha_nacimiento_paciente</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Edad_a&ntilde;os_paciente</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Edad_meses_paciente</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Edad_dias_paciente</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Cedula_ciudadania_representante</strong></div></td>
	

	
  </tr>';
  

$cuenta_val=array();
$numera=0;
$numeracion_exp=0;
$rs_btarifario = $DB_gogess->executec($union_data,array());

$totalexp=0;

if($rs_btarifario)
	{
		while (!$rs_btarifario->EOF) {
		      
			  $totalexp++;
			  $cuadro_lista.='<tr>';
		      $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["centro_nombre"].'</span></td>';
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval"></span></td>';
			  $separa_fecha=array();
			  $separa_fecha=explode(" ",$rs_btarifario->fields["cuabas_fecharegistro"]);
			  
			  $diamesanio=array();
			  $diamesanio=explode("-",$separa_fecha[0]);
			  	  
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">'.$diamesanio[2].'</span></td>';
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">'.$diamesanio[1].'</span></td>'; 
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">'.$diamesanio[0].'</span></td>';
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">1| - ESTABLECIMIENTO</span></td>';
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["usua_apellido"].'</span></td>';
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["usua_nombre"].'</span></td>';
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">CEDULA</span></td>';
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["usua_ciruc"].'</span></td>';
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["usua_formaciondelprofesional"].'</span></td>';
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">0| - NO APLICA</span></td>';
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["usua_msp"].'</span></td>';
			  $genero='';
			  if($rs_btarifario->fields["usua_genero"]=='FEMENINO')
			  {
			    $genero='2| - MUJER';
			  }
			   if($rs_btarifario->fields["usua_genero"]=='MASCULINO')
			  {
			    $genero='1| - HOMBRE';
			  }
			  
			  $nombre_nacinalidad='';
			  $nombre_inicial='';
			  $nombre_nacinalidad=$objformulario->replace_cmb("dns_nacionalidad","nac_id,nac_nombre"," where nac_id=",$rs_btarifario->fields["nac_id"],$DB_gogess);
			  $nombre_nacinalidad=strtoupper($nombre_nacinalidad);
			  $nombre_inicial=$objformulario->replace_cmb("dns_nacionalidad","nac_id,nac_inicial"," where nac_id=",$rs_btarifario->fields["nac_id"],$DB_gogess);
			  
			  $datos_nacionalidad='';
			  if($nombre_inicial)
			  {
			    $datos_nacionalidad=$nombre_inicial.'| -  '.$nombre_nacinalidad;
			  }
 
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">'.$genero.'</span></td>';
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["usua_fechanacimiento"].'</span></td>';
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">'.$datos_nacionalidad.'</span></td>';
			  
			  $nombre_etnia='';
			  $nombre_etnia=$objformulario->replace_cmb("dns_etnia","etn_id,etn_nombre"," where etn_id=",$rs_btarifario->fields["etn_id"],$DB_gogess);
			  $datos_etnia='';
			  if($nombre_etnia)
			  {
		      $datos_etnia=$rs_btarifario->fields["etn_id"].'| - '.$nombre_etnia;
              }
			  
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">'.$datos_etnia.'</span></td>';
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["clie_apellido"].'</span></td>';
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["clie_nombre"].'</span></td>';
			  
			  $nombre_tdoc='';
			  $nombre_tdoc=$objformulario->replace_cmb("faesa_tipoci","tipoci_id,tipoci_nombre"," where tipoci_id=",$rs_btarifario->fields["tipoci_id"],$DB_gogess);
			  
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">'.$nombre_tdoc.'</span></td>';
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["clie_rucci"].'</span></td>';
			  
			  $genero_paciente='';
			  if($rs_btarifario->fields["clie_genero"]=='M')
			  {
			    $genero_paciente='1| - HOMBRE';
			  }
			  if($rs_btarifario->fields["clie_genero"]=='F')
			  {
			    $genero_paciente='2| - MUJER';
			  }
			  
			  
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">'.$genero_paciente.'</span></td>';
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["clie_fechanacimiento"].'</span></td>';
			  
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["edad_anio"].'</span></td>';
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["edad_mes"].'</span></td>';
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">'.$rs_btarifario->fields["edad_dia"].'</span></td>';
			  
			  $numced_rep='0| - NO APLICA';
			  if($rs_btarifario->fields["clie_numerodecedulatitular"])
			  {
			      $numced_rep=$rs_btarifario->fields["clie_numerodecedulatitular"];
			  }
			  
			  
			  $cuadro_lista.='<td nowrap="nowrap" ><span class="css_txtval">'.$numced_rep.'</span></td>';
			  
		      $cuadro_lista.='</tr>';
			  


	
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

