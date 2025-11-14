<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444500000;

ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

$previsual=0;
if(@$_POST["previsual"]==1)
{
$previsual=@$_POST["previsual"];
$fecha_i=$_POST["fecha_inicio"];
$fecha_f=$_POST["fecha_fin"];
$conve_id=$_POST["conve_id"];
}
else
{
$previsual=@$_GET["previsual"];
$fecha_i=$_GET["fecha_inicio"];
$fecha_f=$_GET["fecha_fin"];
$conve_id=$_GET["conve_id"];

}

if($previsual==2)
{
header('Content-type: application/vnd.ms-excel');
$fechahoy=date("Y-m-d");
header("Content-Disposition: attachment; filename="."repxls_".$fechahoy.".xls");
}

$sql1="";
$sql2="";
$sql3="";
$sql4="";
$sql5="";

if($conve_id)
  {
   $sql2=" conve_id = '".$conve_id."' and ";
  }  

if($fecha_i!='' and $fecha_f!='')
{
   $sql3=" terap_fecha>='".$fecha_i."' and terap_fecha<='".$fecha_f."' and ";
}  
else
{
  
  if($fecha_i!='' and $fecha_f=='')
  {  
    $sql3=" terap_fecha>='".$fecha_i."' and ";
  }
  else
  {
    if($fecha_i=='' and $fecha_f!='')
	{
	   $sql3=" terap_fecha<='".$fecha_f."' and ";  
    }
  }

}  

$concatena_sql=$sql1.$sql2.$sql3.$sql4.$sql5;

$concatena_sql=substr($concatena_sql,0,-4);

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
$documento='';
$documento.="<style type='text/css'>
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
-->
</style>";

$documento.='<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#EEF5F7" class="css_titulo">No</td>
	<td bgcolor="#EEF5F7" class="css_titulo">Fecha</td>
    <td bgcolor="#EEF5F7" class="css_titulo">Hora</td>
    <td bgcolor="#EEF5F7" class="css_titulo">CI</td>
	<td bgcolor="#EEF5F7" class="css_titulo">Paciente</td>
	<td bgcolor="#EEF5F7" class="css_titulo">Especialidad</td>
	<td bgcolor="#EEF5F7" class="css_titulo">M&eacute;dico</td>
	<td bgcolor="#EEF5F7" class="css_titulo">Usuario Resgistra</td>
	<td bgcolor="#EEF5F7" class="css_titulo">Fecha Resgistro</td>
  </tr>';
			
			$cuentav=1;
			if($concatena_sql)
            {
			$saca_equeatendio="select * from faesa_terapiasregistro where ".$concatena_sql;
			}
			else
			{
			$saca_equeatendio="select * from faesa_terapiasregistro";	
			}
			//echo $saca_equeatendio;
			$rs_atendio = $DB_gogess->executec($saca_equeatendio,array());
			if($rs_atendio)
            {
				while (!$rs_atendio->EOF) 
				{	
				
				 $nom_paciente=$objformulario->replace_cmb("app_cliente","clie_id,clie_nombre,clie_apellido"," where clie_id =",$rs_atendio->fields["clie_id"],$DB_gogess);
				   $cedula_paciente=$objformulario->replace_cmb("app_cliente","clie_id,clie_rucci"," where clie_id =",$rs_atendio->fields["clie_id"],$DB_gogess); 
				 $nom_especialidad=$objformulario->replace_cmb("cesdb_arextension.dns_profesion","prof_id,prof_nombre"," where prof_id=",$rs_atendio->fields["prof_id"],$DB_gogess);	
				 
				 $nom_medico=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id=",$rs_atendio->fields["usua_id"],$DB_gogess);			
				 
				 $nom_usagenda=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id=",$rs_atendio->fields["usuar_id"],$DB_gogess);				 
				 
				  //   $objformulario->fill_cmb('cesdb_arextension.dns_profesion','prof_id,prof_nombre','',$filtro_espe,$DB_gogess);
				
				$documento.='<tr>
					<td>'.$cuentav++.'</td>
					<td>'.$rs_atendio->fields["terap_fecha"].'</td>
					<td>'.$rs_atendio->fields["terap_hora"].'</td>
					<td style=mso-number-format:"@" >'.$cedula_paciente.'</td>
					<td>'.$nom_paciente.'</td>
					<td>'.$nom_especialidad.'</td>
					<td>'.$nom_medico.'</td>
					<td>'.$nom_usagenda.'</td>
					<td>'.$rs_atendio->fields["terap_fecharegistro"].'</td>					
				</tr>';	
					
			    $rs_atendio->MoveNext();
			}
		}	

$documento.='</table>';

if($previsual==1)
{
echo $documento; 
}
if($previsual==2)
{
echo utf8_encode($documento); 
}

}

?>


