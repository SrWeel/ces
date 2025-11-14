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


$sql_data="select * from dns_atencion_vista where ";
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
.table-striped tbody tr:nth-child(odd) td {
  
}

.table-striped tbody tr.highlight td { 
    background-color:#acbad4;
}


-->
</style>

<br />
<div align="left">
Establecimiento Actual: Es el Centro de Salud en el que se encentra actualmente.<br />
Otros Establecimientos: Si el paciente se realiz&oacute; la atenci&oacute;n en otro Centro de Salud (Aqu&iacute; puede buscar si se atendi&oacute; en otro establecimiento).
</div>
<table width="100%" border="1" align="center" cellpadding="3" cellspacing="1" id="mytable" class="table-striped" >
  <tr>
    <td colspan="12" nowrap="nowrap" bgcolor="#BCD9E7"><input type="button" name="Button" value="Establecimiento Actual" onclick="desplegar_grid_atencion(0);" />
      &nbsp; &nbsp; &nbsp;
    <input type="button" name="Button2" value="Otros Establecimientos" onclick="desplegar_grid_atencion(1);" /></td>
  </tr>
  <tr>
    <td colspan="12" nowrap="nowrap" bgcolor="#9FC9DD"><div align="center"><strong><?php echo $nombre_lista; ?></strong></div></td>
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
    <td nowrap="nowrap" bgcolor="#BCD9E7"><div align="center" style="padding:5px;"  ><strong>Estado Med. </strong></div></td>
    <td nowrap="nowrap" bgcolor="#BCD9E7"><div align="center" style="padding:5px;"  ><strong>Estado Psic. </strong></div></td>
    <td nowrap="nowrap" bgcolor="#BCD9E7"><div align="center" style="padding:5px;"  ><strong>Estado Odont. </strong></div></td>
    <td nowrap="nowrap" bgcolor="#BCD9E7"><div align="center" style="padding:5px;"  ><strong>Estado Reha. </strong></div></td>
  </tr>
<?php
$rs_atencionlista = $DB_gogess->executec($sql_data,array());
if($rs_atencionlista)
	       {
		       while (!$rs_atencionlista->EOF) {
			   
		$lista_nuevo='<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="ver_formularioenpantalla(\'aplicativos/documental/opciones/grid/atencion/grid_atencion_nuevo.php\',\'Editar\',\'divBody_interno'.$_POST["indice_grid"].'\','.$rs_atencionlista->fields[$campo_id].',\''.@$_POST["pVar2"].'\',\'39\',0,0,0,0)" style=cursor:pointer ><center><img src="images/preconsulta.png"  /></center></td></tr></table>';
		
		$lista_lista='<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="abrir_standar(\'aplicativos/documental/opciones/grid/atencion/resumen.php\',\'Resumen\',\'divBody_resumen\',\'divDialog_resumen\',700,500,'.$rs_atencionlista->fields[$campo_id].',\''.@$_POST["pVar2"].'\',\'39\',0,0,0,0)" style=cursor:pointer ><center><img src="images/listados.png"  /></center></td></tr></table>';
				   
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
    <td valign="top" bgcolor="#EBF3F3"><div class="csslitsa_ate" style="padding:5px;"  ><?php echo $rs_atencionlista->fields["estaatenc_nombre"]; ?></div></td>
    <td valign="top" bgcolor="#EBF3F3"><div class="csslitsa_ate" style="padding:5px;"  ><?php echo $rs_atencionlista->fields["atenc_estadopsicologia"]; ?></div></td>
    <td valign="top" bgcolor="#EBF3F3"><div class="csslitsa_ate" style="padding:5px;"  ><?php echo $rs_atencionlista->fields["atenc_estadoodontologia"]; ?></div></td>
    <td valign="top" bgcolor="#EBF3F3"><div class="csslitsa_ate" style="padding:5px;"  ><?php echo $rs_atencionlista->fields["atenc_estadorehabilitacion"]; ?></div></td>
  </tr>
  <tr>
    <td colspan="12" valign="top" bgcolor="#EBF3F3">
	
	
	<?php
	echo '<table border="1" cellpadding="0" cellspacing="0"  width="100%" >';
	
	$lista_tablaspop="select * from gogess_sistable inner join gogess_sisfield on gogess_sistable.tab_name=gogess_sisfield.tab_name where ttbl_id in(1) and fie_tablasubgrid!='' order by tab_title asc";
    $rs_tablastop = $DB_gogess->executec($lista_tablaspop,array());

    if($rs_tablastop)
	{
		while (!$rs_tablastop->EOF) {
		
		     $lista_diag="select * from ".$rs_tablastop->fields["tab_name"]." left join ".$rs_tablastop->fields["fie_tablasubgrid"]." on ".$rs_tablastop->fields["tab_name"].".".$rs_tablastop->fields["fie_campoenlacesub"]."=".$rs_tablastop->fields["fie_tablasubgrid"].".".$rs_tablastop->fields["fie_campoenlacesub"]." where ".$rs_tablastop->fields["tab_name"].".atenc_id='".$rs_atencionlista->fields["atenc_id"]."' order by diagn_fecharegistro desc";
			
			 $separa_subind=array();
			 $campo_moitvo='';
			 $campo_moitvo2='';
			 $campo_moitvo3='';
			 $campo_moitvo4='';
			 $campo_fechareg='';
			 $separa_subind=explode("_",$rs_tablastop->fields["fie_campoenlacesub"]);
			 $campo_moitvo=$separa_subind[0]."_motivodeconsulta";
			 $campo_moitvo2=$separa_subind[0]."_motivo";
			 $campo_moitvo3=$separa_subind[0]."_motivoconsulta";
			 $campo_moitvo4=$separa_subind[0]."_describir";
			 
			 $campo_fechareg=$separa_subind[0]."_fecharegistro";
			 
			 
			 
			
			$rs_diag = $DB_gogess->executec($lista_diag,array());
		    if($rs_diag)
			{
				while (!$rs_diag->EOF) {
		   
		           
				$separa_data=array();
				$separa_data=str_split(trim($rs_diag->fields["diagn_cie"]));
				//echo count($separa_data);
				$num_punto='';
				if(count($separa_data)>3)
				{
					$num_punto='';
					for($ival=0;$ival<count($separa_data);$ival++)
					{
					   if($ival==2)
					   {
					   $num_punto.=$separa_data[$ival].".";
					   }
					   else
					   {
					   $num_punto.=$separa_data[$ival];
					   }
					   
					}
				}
				else
				{
					$num_punto=trim($rs_diag->fields["diagn_cie"]);
				} 
				   
		        //if($num_punto)
				//{
				  $fecha_registro='';
				  if($rs_diag->fields["diagn_fecharegistro"]=='')
				  {
				         $fecha_registro=$rs_diag->fields[$campo_fechareg];
				  }
				  else
				  {
				         $fecha_registro=$rs_diag->fields["diagn_fecharegistro"];				  
				  }
				  
				  $alerta_diag='';
				  if(!($num_punto))
				  {
				    $alerta_diag='Sin diagnostico';
				  }
				  else
				  {
				     $alerta_diag=$num_punto.': <b>'.$rs_diag->fields["diagn_descripcion"];
				  }
				  
		          $imagen_check='<img src="images/check.jpg" width="20" height="17">';
				  echo '<tr>
					<td class="csslitsa_li" >'.utf8_encode($rs_tablastop->fields["tab_title"]).'</td>
					<td>'.$imagen_check.'</td>
					<td>Motivo Consulta:<b>'.utf8_encode(@$rs_diag->fields[$campo_moitvo]." ".@$rs_diag->fields[$campo_moitvo2].' '.@$rs_diag->fields[$campo_moitvo3].' '.@$rs_diag->fields[$campo_moitvo4]).'</b></td>
					<td>'.$alerta_diag.'</b></td>
					<td  nowrap="nowrap" >Fecha Registro: <b>'.$fecha_registro.'</b></td>
				  </tr>';
				  $cuadro_lista='';
				  //}
			
		           $rs_diag->MoveNext();	
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
 $('#mytable').on('click', 'tbody tr', function(event) {
    $(this).addClass('highlight').siblings().removeClass('highlight');
});
 
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