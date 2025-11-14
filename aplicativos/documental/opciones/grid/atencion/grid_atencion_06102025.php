<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444456000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

//saca datos de la tabla
$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array(39));

$lista_tabla="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tab_id"];
$rs_tabla = $DB_gogess->executec($lista_tabla,array());

$lista_tabla_vista="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tabgrid_id"];
$rs_tabla_vista = $DB_gogess->executec($lista_tabla_vista,array());

//saca datos de la tabla

$carpeta='substandar';
$tabla=$rs_tabla->fields["tab_name"];
if($rs_tabla_vista->fields["tab_name"])
{
$tabla_vista=$rs_tabla_vista->fields["tab_name"];
}
else
{
$tabla_vista=$rs_tabla->fields["tab_name"];
}



$subindice="_substandar";
$campos_paragrid=$rs_datosmenu->fields["mnupan_campogrid"];
$campo_id=$rs_tabla->fields["tab_campoprimario"];
$sqltotal="";

//busca si abrio ya historial
$atenc_id_encentro=0;
$busca_atencion="select * from dns_atencion where clie_id='".@$_POST['pVar2']."' and centro_id='".@$_SESSION['ces1313777_centro_id']."'";
$rs_buscaat = $DB_gogess->executec($busca_atencion,array());
$atenc_id_encentro=$rs_buscaat->fields["atenc_id"];
//busca si abrio ya historial

$sql_data="select atenc_id,centro_nombre,atenc_hc,clie_nombre,clie_apellido,atenc_fecharegistro,estaatenc_nombre,atenc_estadopsicologia,atenc_estadoodontologia,atenc_estadorehabilitacion from dns_atencion_vista where ";
//filtros

if($rs_datosmenu->fields["mnupan_campoenlace"])
{

if(@$_SESSION['ces1313777_sessid_emp_id'])
{
   $sql1=$rs_datosmenu->fields["mnupan_campoenlace"]." = ".@$_SESSION['ces1313777_sessid_emp_id']." and ";
}

}

if(@$_POST['pVar2'])
{
   $sql2="clie_id = ".@$_POST['pVar2']." and ";
}

if(@$_SESSION['ces1313777_centro_id'])
{
   $sql3="centro_id = ".@$_SESSION['ces1313777_centro_id']." and ";
   $sql3="";
}

$nombre_lista='';
if($_POST["filtro"]==1)
{  
   $sql3="centro_id not in (".@$_SESSION['ces1313777_centro_id'].") and ";
   $nombre_lista='OTROS ESTABLECIMIENTOS';
}
else
{
   $sql3="centro_id = ".@$_SESSION['ces1313777_centro_id']." and ";
   
    $nombre_lista='ESTABLECIMIENTO ACTUAL';
}

$sql3="";

/*if($_SESSION['ces1313777_sessid_cedula']=='1718446451' or $_SESSION['ces1313777_sessid_cedula']=='1804215109' or  $_SESSION['ces1313777_sessid_cedula']=='1713825600' or  $_SESSION['ces1313777_sessid_cedula']=='1707255533' or  $_SESSION['ces1313777_sessid_cedula']=='1711467884')
{
$sql3="";
}*/


@$sqltotal=$sql1.$sql2.$sql3;
$sqltotal=substr($sqltotal,0,-4);

$sql_data=$sql_data.$sqltotal." order by atenc_id desc";

?>
<style type="text/css">
<!--
.csslitsa_ate {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.csslitsa_li {font-size: 9px; font-family: Verdana, Arial, Helvetica, sans-serif; }

-->
</style>

<br />
<div align="left">
Establecimiento Actual: CL&Iacute,NICA DE ESPECIALIDADES DEL SUR.<br />
Buscar Paciente: Busca al paciente en Establecimiento Actual (CL&Iacute,NICA DE ESPECIALIDADES DEL SUR).
</div>
<table width="100%" border="1" align="center" cellpadding="3" cellspacing="1" id="mytable" class="table-striped" >
  <tr>
    <td colspan="12" nowrap="nowrap" bgcolor="#BCD9E7"><input type="button" name="Button" value="Establecimiento Actual" onclick="desplegar_grid_atencion(0);" style="background-color:#003366; color:#FFFFFF; height:40px" />
      &nbsp; &nbsp; &nbsp;
    <input type="button" name="Button2" value="Buscar Paciente" onclick="desplegar_grid_atencion(1);" style="background-color:#006600; color:#FFFFFF; height:40px" /></td>
  </tr>
  <tr>
    <td colspan="8" nowrap="nowrap" bgcolor="#9FC9DD"><div align="center"><strong><?php echo $nombre_lista; ?></strong></div></td>
  </tr>
  <tr>
    <td nowrap="nowrap" bgcolor="#BCD9E7"><div align="center" style="padding:5px;" ><strong>Editar</strong></div></td>
    <td nowrap="nowrap" bgcolor="#BCD9E7"><div align="center" style="padding:5px;"  ><strong>Resumen</strong></div></td>
    <td nowrap="nowrap" bgcolor="#BCD9E7"><div align="center" style="padding:5px;"  ><strong>Id</strong></div></td>
    <td nowrap="nowrap" bgcolor="#BCD9E7"><div align="center" style="padding:5px;"  ><strong>Centro</strong></div></td>
    <td nowrap="nowrap" bgcolor="#BCD9E7"><div align="center" style="padding:5px;"  ><strong>Historia Clinica </strong></div></td>
    <td nowrap="nowrap" bgcolor="#BCD9E7"><div align="center" style="padding:5px;"  ><strong>Nombre</strong></div></td>
    <td nowrap="nowrap" bgcolor="#BCD9E7"><div align="center" style="padding:5px;"  ><strong>Apellido</strong></div></td>
    <td nowrap="nowrap" bgcolor="#BCD9E7"><div align="center" style="padding:5px;"  ><strong>Fecha Registro </strong></div></td>
  </tr>
<?php
$rs_atencionlista = $DB_gogess->executec($sql_data,array());
if($rs_atencionlista)
	       {
		       while (!$rs_atencionlista->EOF) {
			   
		$lista_nuevo='<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="ver_formularioenpantalla(\'aplicativos/documental/opciones/grid/atencion/grid_atencion_nuevo.php\',\'Editar\',\'divBody_interno'.$_POST["indice_grid"].'\','.$rs_atencionlista->fields[$campo_id].',\''.@$_POST["pVar2"].'\',\'39\',0,0,0,0)" style=cursor:pointer ><center><img src="images/preconsulta.png"  /></center></td></tr></table>';
		
		$lista_lista='<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="abrir_standar(\'aplicativos/documental/opciones/grid/atencion/resumen.php\',\'Resumen\',\'divBody_resumen\',\'divDialog_resumen\',700,500,'.$rs_atencionlista->fields[$campo_id].',\''.@$_POST["pVar2"].'\',\'39\',0,0,0,0)" style=cursor:pointer ><center><img src="images/listados.png"  /></center></td></tr></table>';

//atenc_id,centro_nombre,atenc_hc,clie_nombre,clie_apellido,atenc_fecharegistro,estaatenc_nombre,atenc_estadopsicologia,atenc_estadoodontologia,atenc_estadorehabilitacion
?>  
  <tr>
    <td valign="top" bgcolor="#EBF3F3"><div align="center" style="padding:5px;"  ><div class="csslitsa_ate"><?php echo $lista_nuevo; ?></div></div></td>
    <td valign="top" bgcolor="#EBF3F3"><div align="center" style="padding:5px;"  ><div class="csslitsa_ate"><?php echo $lista_lista; ?></div></div></td>
    <td valign="top" bgcolor="#EBF3F3"><div class="csslitsa_ate" style="padding:5px;"  ><?php echo $rs_atencionlista->fields["atenc_id"]; ?></div></td>
    <td valign="top" bgcolor="#EBF3F3"><div class="csslitsa_ate" style="padding:5px;"  ><?php echo $rs_atencionlista->fields["centro_nombre"]; ?></div></td>
    <td valign="top" bgcolor="#EBF3F3"><div class="csslitsa_ate" style="padding:5px;"  ><?php echo $rs_atencionlista->fields["atenc_hc"]; ?></div></td>
    <td valign="top" nowrap="nowrap" bgcolor="#EBF3F3"><div class="csslitsa_ate" style="padding:5px;"  ><?php echo $rs_atencionlista->fields["clie_nombre"]; ?></div></td>
    <td valign="top" nowrap="nowrap" bgcolor="#EBF3F3"><div class="csslitsa_ate" style="padding:5px;"  ><?php echo $rs_atencionlista->fields["clie_apellido"]; ?></div></td>
    <td valign="top" nowrap="nowrap" bgcolor="#EBF3F3"><div class="csslitsa_ate" style="padding:5px;"  ><?php echo $rs_atencionlista->fields["atenc_fecharegistro"]; ?></div></td>
  </tr>
  <tr>
    <td colspan="12" valign="top" bgcolor="#EBF3F3">
	
	
	<?php
	echo '<table border="1" cellpadding="0" cellspacing="0"  width="100%" >';
	
	$lista_tablaspop="select * from gogess_sistable inner join gogess_sisfield on gogess_sistable.tab_name=gogess_sisfield.tab_name where ttbl_id=1 and fie_tablasubgrid!='' and gogess_sistable.tab_name not in ('dns_consultaexterna','dns_ginecologiaconsultaexterna','dns_traumatologiaconsultaexterna') order by tab_title asc";
	
    $rs_tablastop = $DB_gogess->executec($lista_tablaspop,array());

    if($rs_tablastop)
	{
		while (!$rs_tablastop->EOF) {
		     
			 $estado_formulario='';
		     $separa_subind=array();
			 $campo_moitvo='';
			 $campo_moitvo2='';
			 $campo_moitvo3='';
			 $campo_moitvo4='';
			 $campo_moitvo5='';
			 $campo_moitvo6='';
			 $campo_moitvo7='';
			 $campo_moitvo8='';
			 $campo_fechareg='';
			 $separa_subind=explode("_",$rs_tablastop->fields["fie_campoenlacesub"]);
			 $campo_moitvo=$separa_subind[0]."_motivodeconsulta";
			 $campo_moitvo2=$separa_subind[0]."_motivo";
			 $campo_moitvo3=$separa_subind[0]."_motivoconsulta";
			 $campo_moitvo4=$separa_subind[0]."_describir";	
			 $campo_moitvo5=$separa_subind[0]."_clinicoactual";	
			 $campo_moitvo6=$separa_subind[0]."_descripcion";	
			 $campo_moitvo7=$separa_subind[0]."_resumen";
			 $campo_moitvo8=$separa_subind[0]."_resumenclinico";			 	 
			 $campo_fechareg=$separa_subind[0]."_fecharegistro";			 
			 $campo_moitvo_valor="";			 
			 $estaatenc_id_valor="";
			 
			 $campoprimario_id="";
			 $campoprimario_id=",".$rs_tablastop->fields["tab_campoprimario"]." as data_idv ";	
			 
			 if($rs_tablastop->fields["tab_name"]=='dns_anamesisexamenfisico')
			 {			 
			   $campo_moitvo_valor=",".$campo_moitvo3." as data_moitvo ";			   
			   $estaatenc_id_valor=",estaatenc_id as data_estado ";			   
			 }
			 
			 if($rs_tablastop->fields["tab_name"]=='dns_ginecologiaanamesis')
			 {			 
			   $campo_moitvo_valor=",".$campo_moitvo3." as data_moitvo ";			   
			   $estaatenc_id_valor=",estaatenc_id as data_estado ";			   
			 }
			 
			 if($rs_tablastop->fields["tab_name"]=='dns_traumatologiaanamesis')
			 {			 
			   $campo_moitvo_valor=",".$campo_moitvo3." as data_moitvo ";			   
			   $estaatenc_id_valor=",estaatenc_id as data_estado ";			   
			 }
			 
			 
			 if($rs_tablastop->fields["tab_name"]=='dns_consultaexterna')
			 {			 
			   $campo_moitvo_valor=",".$campo_moitvo3." as data_moitvo ";
			   $estaatenc_id_valor=",'' as data_estado ";
			 }
			 
			 if($rs_tablastop->fields["tab_name"]=='dns_ginecologiaconsultaexterna')
			 {			 
			   $campo_moitvo_valor=",".$campo_moitvo3." as data_moitvo ";
			   $estaatenc_id_valor=",'' as data_estado ";
			 }
			 
			 
			 
			 if($rs_tablastop->fields["tab_name"]=='dns_enfermeria')
			 {
			   $campo_moitvo_valor=",'' as data_moitvo ";
			   $estaatenc_id_valor=",'' as data_estado ";
			 
			 }
			 
			 if($rs_tablastop->fields["tab_name"]=='dns_imagenologiainfo' or $rs_tablastop->fields["tab_name"]=='dns_imagenologia')
			 {
			   $campo_moitvo_valor=",".$campo_moitvo4." as data_moitvo ";
			   $estaatenc_id_valor=",'' as data_estado ";
			 
			 }
			 
			 if($rs_tablastop->fields["tab_name"]=='dns_interconsulta')
			 {
			   $campo_moitvo_valor=",".$campo_moitvo5." as data_moitvo ";
			   $estaatenc_id_valor=",'' as data_estado ";			 
			 }
			 
			 if($rs_tablastop->fields["tab_name"]=='dns_laboratorioinforme')
			 {
			   $campo_moitvo_valor=",'' as data_moitvo ";
			   $estaatenc_id_valor=",'' as data_estado ";			 
			 }
			 
			 if($rs_tablastop->fields["tab_name"]=='dns_laboratorio')
			 {
			   $campo_moitvo_valor=",'' as data_moitvo ";
			   $estaatenc_id_valor=",'' as data_estado ";			 
			 }
			 
			 if($rs_tablastop->fields["tab_name"]=='dns_odontologia')
			 {
			   $campo_moitvo_valor=",".$campo_moitvo3." as data_moitvo ";
			   $estaatenc_id_valor=",'' as data_estado ";		 
			 }
			 
			 if($rs_tablastop->fields["tab_name"]=='dns_prehospitalario')
			 {
			   $campo_moitvo_valor=",".$campo_moitvo6." as data_moitvo ";
			   $estaatenc_id_valor=",'' as data_estado ";			 
			 }
		
		
		     if($rs_tablastop->fields["tab_name"]=='dns_procediminetosinvasivos')
			 {
			   $campo_moitvo_valor=",".$campo_moitvo6." as data_moitvo ";
			   $estaatenc_id_valor=",'' as data_estado ";			 
			 }
		
		     if($rs_tablastop->fields["tab_name"]=='dns_psicologia')
			 {
			   $campo_moitvo_valor=",".$campo_moitvo." as data_moitvo ";
			   $estaatenc_id_valor=",'' as data_estado ";			 
			 }
		
		     if($rs_tablastop->fields["tab_name"]=='dns_referencia')
			 {
			   $campo_moitvo_valor=",".$campo_moitvo7." as data_moitvo ";
			   $estaatenc_id_valor=",'' as data_estado ";		 
			 }
		
		
		     if($rs_tablastop->fields["tab_name"]=='dns_fisioterapia')
			 {
			   $campo_moitvo_valor=",'' as data_moitvo ";
			   $estaatenc_id_valor=",'' as data_estado ";			 
			 }
			 
			 if($rs_tablastop->fields["tab_name"]=='dns_histopatologia')
			 {
			   $campo_moitvo_valor=",".$campo_moitvo8." as data_moitvo ";
			   $estaatenc_id_valor=",'' as data_estado ";			 
			 }
			 
			 
			 if($rs_tablastop->fields["tab_name"]=='dns_subsecuenteodontologia')
			 {
			   $campo_moitvo_valor=",'' as data_moitvo ";
			   $estaatenc_id_valor=",'' as data_estado ";			 
			 }
			 
			 
			 if($rs_tablastop->fields["tab_name"]=='dns_subsecuentepsicologia')
			 {
			   $campo_moitvo_valor=",'' as data_moitvo ";	
			   $estaatenc_id_valor=",'' as data_estado ";		 
			 }
			 
			 
			
			$lista_secciones="select ".$campo_fechareg.$campo_moitvo_valor.$estaatenc_id_valor.$campoprimario_id.",clie_id,atenc_id,centro_id from ".$rs_tablastop->fields["tab_name"]." where ".$rs_tablastop->fields["tab_name"].".atenc_id='".$rs_atencionlista->fields["atenc_id"]."' order by ".$campo_fechareg." desc";
			
			$rs_seccion = $DB_gogess->executec($lista_secciones,array());
		    if($rs_seccion)
			{
				while (!$rs_seccion->EOF) {
				
				$alerta_diag='';
				
				$fecha_registro=$rs_seccion->fields[$campo_fechareg];
				
				$estado_formulario='';
				$fondo_alerta='';
				if($rs_seccion->fields["data_estado"]==4)
				{
				  $estado_formulario='VIGENTE';
				  $fondo_alerta='bgcolor="#93D29E"';
				}
			
			
			
			$imagen_subsecuente='';
			$linsk_subsecuente='';	
			$linsk_accesodirecto='';
			$imagen_accesodirecto='';
			
			if($rs_tablastop->fields["tab_name"]=='dns_anamesisexamenfisico')
			 {
				$imagen_subsecuente='<img src="images/subsecuente_data.png" width="20" height="17">';				
				$linsk_subsecuente=' onclick=abrir_standar("aplicativos/documental/opciones/grid/atencion/anamesis_subsecuente.php","SUBSECUENTES","divBody_resumen","divDialog_resumen",800,400,"'.$rs_seccion->fields["data_idv"].'",0,0,0,0,0,0); style="cursor:pointer" ';
				
				
				
				$linsk_accesodirecto=' onclick=ver_formularioenpantalla("aplicativos/documental/datos_substandarformunicoanamnesis.php","EDITAR","divBody_ext","'.$rs_seccion->fields["data_idv"].'","'.$rs_seccion->fields["clie_id"].'",44,"'.$rs_seccion->fields["atenc_id"].'",0,0,"'.$rs_seccion->fields["centro_id"].'"); style="cursor:pointer" ';
				$imagen_accesodirecto='<img src="images/accesodirecto.png" width="20" height="17">';
				
				
			 }	
			 
			 if($rs_tablastop->fields["tab_name"]=='dns_ginecologiaanamesis')
			 {
				$imagen_subsecuente='<img src="images/subsecuente_data.png" width="20" height="17">';				
				$linsk_subsecuente=' onclick=abrir_standar("aplicativos/documental/opciones/grid/atencion/ginecologia_subsecuente.php","SUBSECUENTES","divBody_resumen","divDialog_resumen",800,400,"'.$rs_seccion->fields["data_idv"].'",0,0,0,0,0,0); style="cursor:pointer" ';
				
				
				
				$linsk_accesodirecto=' onclick=ver_formularioenpantalla("aplicativos/documental/datos_substandarginecologiaanamnesis.php","EDITAR","divBody_ext","'.$rs_seccion->fields["data_idv"].'","'.$rs_seccion->fields["clie_id"].'",105,"'.$rs_seccion->fields["atenc_id"].'",0,0,"'.$rs_seccion->fields["centro_id"].'"); style="cursor:pointer" ';
				$imagen_accesodirecto='<img src="images/accesodirecto.png" width="20" height="17">';
				
				
			 }	
			 
			 if($rs_tablastop->fields["tab_name"]=='dns_traumatologiaanamesis')
			 {
				$imagen_subsecuente='<img src="images/subsecuente_data.png" width="20" height="17">';				
				$linsk_subsecuente=' onclick=abrir_standar("aplicativos/documental/opciones/grid/atencion/traumatologia_subsecuente.php","SUBSECUENTES","divBody_resumen","divDialog_resumen",800,400,"'.$rs_seccion->fields["data_idv"].'",0,0,0,0,0,0); style="cursor:pointer" ';
				
				
				
				$linsk_accesodirecto=' onclick=ver_formularioenpantalla("aplicativos/documental/datos_substandartraumatologiaanamnesis.php","EDITAR","divBody_ext","'.$rs_seccion->fields["data_idv"].'","'.$rs_seccion->fields["clie_id"].'",107,"'.$rs_seccion->fields["atenc_id"].'",0,0,"'.$rs_seccion->fields["centro_id"].'"); style="cursor:pointer" ';
				$imagen_accesodirecto='<img src="images/accesodirecto.png" width="20" height="17">';
				
				
			 }	
			 
			 
				
				$imagen_check='<img src="images/check.jpg" width="20" height="17">';
				
				echo '<tr>
				    <td '.$linsk_accesodirecto.' >'.$imagen_accesodirecto.'</td>
				    <td '.$linsk_subsecuente.' >'.$imagen_subsecuente.'</td>
					<td class="csslitsa_li" >'.$rs_tablastop->fields["tab_title"].'</td>
					<td>'.$imagen_check.'</td>
					<td>Motivo Consulta:<b>'.@$rs_seccion->fields["data_moitvo"].'</b></td>
					<td>'.$alerta_diag.'</td>
					<td  nowrap="nowrap" >Fecha Registro: <b>'.$fecha_registro.'</b></td>
					<td  nowrap="nowrap" '.$fondo_alerta.' >Estado: <b>'.$estado_formulario.'</b></td>
				  </tr>';
				
				 $rs_seccion->MoveNext();
				}
			}	
			
			
		 
		
		 $rs_tablastop->MoveNext();
		}
	}	


	
	echo '</table>';
	?>	</td>
  </tr>
  <tr>
    <td colspan="12" valign="top"><hr /></td>
  </tr>
<?php

                 $rs_atencionlista->MoveNext(); 
			   }
			}   

?>  
</table>
<div id="divBody_causasdet" ></div>
 <div id="divBody_arbidet" ></div>
 <div id="divBody_resumen" ></div>
 <script>
// $('#mytable').on('click', 'tbody tr', function(event) {
//    $(this).addClass('highlight').siblings().removeClass('highlight');
//});

<?php
if($atenc_id_encentro>0)
{
   echo "$('#btn_nuevaatencion').html('')";

}
?>
 
 </script>
<?php
}
else
{

echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; ">Tu sesi&oacute;n ha expirado</div>';
//enviar
$varable_enviafunc=base64_encode("desplegar_grid_atencion();");
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