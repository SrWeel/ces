<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();

$lista_hijos="select distinct clie_nombre,clie_apellido,app_cliente.clie_id from app_cliente where clie_nombre like '%".trim($_POST["busca_paciente"])."%' or clie_apellido like '%".trim($_POST["busca_paciente"])."%'";
$rs_datahijos = $DB_gogess->executec($lista_hijos,array());

echo '<table width="700" border="1" cellpadding="0" cellspacing="0">
<tr> 
  <td nowrap="nowrap" bgcolor="#6AB3C8" style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:10px" ><center>SELECCIONAR</center></td>
    <td nowrap="nowrap" bgcolor="#6AB3C8" style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:10px" ><center>HISTORIA CLINICA</center></td>
    <td bgcolor="#6AB3C8" style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:10px" ><center>PACIENTE</center></td>
  </tr>
';
if($rs_datahijos)

 {

	  while (!$rs_datahijos->EOF) {	

		
		$busca_at="select * from dns_atencion where clie_id='".$rs_datahijos->fields["clie_id"]."' order by atenc_id desc";
		$rs_buscaat = $DB_gogess->executec($busca_at,array());
		
		// busca atencion la ultima
		$nombre_valor='';
		$nombre_valor=utf8_encode($rs_datahijos->fields["clie_nombre"]." ".$rs_datahijos->fields["clie_apellido"])."<br>";
		$comilla_simple="'";
		echo '<tr>
	<td><input name="radio_hc" type="radio" value="'.$rs_buscaat->fields["atenc_hc"]."|".$rs_buscaat->fields["clie_id"].'" /></td>	
    <td nowrap="nowrap" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; cursor:pointer" >'.$rs_buscaat->fields["atenc_hc"].'</td>
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" >'.$nombre_valor.'</td>
  </tr>';


        $rs_datahijos->MoveNext();	   

	  }

  }
echo '</table>';



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