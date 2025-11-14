<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$fechahoy=date("Y-m-d");
//header("Content-type: application/vnd.ms-excel");
//header("Content-Disposition: attachment; filename="."calificaciones_".$fechahoy.".xls");
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
require_once($director."libreria/dompdf/dompdf_config.inc.php");

$objperfil=new objetosistema_perfil();
if($_SESSION['ces1313777_sessid_inicio'])
{
$saca_datosus="select * from media_usuario inner join media_pais on media_usuario.pais_id=media_pais.pais_id where usua_id=?";
$ok_resultado=$DB_gogess->executec($saca_datosus,array($_SESSION['ces1313777_sessid_inicio']));


?><?php
$variable_imp='<style type="text/css">
<!--
td,th {
	font-size: 11px;
}
.Estilo1 {
	font-size: 14px;
	font-weight: bold;
}
.Estilo6 {
	font-size: 11px;
	font-weight: bold;
	color: #FFFFFF;
}

.nomform_css {
	font-size: 11px;
	font-weight: bold;
}

.Estilo9 {
	font-size: 11px;
	
}
.borde_tabla{
	font-size: 11px;
	color: #000000;
	text-decoration: none;
	border: 1px solid #000000;
}
.titulo_nombre
{
	font-size: 12px;
	color: #000000;
}
.Estilo11 { font-size: 12px; color: #000000; font-weight: bold; }
-->
</style>

<page style="font-size: 11px" footer="page" >';
?>
<?php
$comilla="'";
$variable_imp.='<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="181"><img src="http://10.1.13.103/Iberoamericana/images/logocumbre.png" width="181" height="166"></td>
    <td width="300"><div align="center"><span class="Estilo1">Herramienta de autoevaluaci&oacute;n de la transparencia, rendici&oacute;n de cuentas e integridad judicial Iberoamericana</span><br>
    </div></td>
  </tr>
</table>
<table width="400" border="0" align="center" cellpadding="1" cellspacing="2">
  <tr>
    <td width="198"><span class="Estilo11">Nombres y apellidos:</span></td>
    <td width="486"><span class="Estilo9">'.$ok_resultado->fields["usua_nombre"]." ".$ok_resultado->fields["usua_apellido"].'</span></td>
  </tr>
  <tr>
    <td><span class="Estilo11">Pa&iacute;s:</span></td>
    <td><span class="Estilo9">'.$ok_resultado->fields["pais_nombre"].'</span></td>
  </tr>
  <tr>
    <td><span class="Estilo11">Instituci&oacute;n:</span></td>
    <td><span class="Estilo9">'.$ok_resultado->fields["usua_institucion"].'</span></td>
  </tr>
  <tr>
    <td><span class="Estilo11">Periodo evaluado:</span></td>
    <td><span class="Estilo9">'.$ok_resultado->fields["usua_periodo"].'</span></td>
  </tr>
</table>
<table width="250" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr bgcolor="#000000" >
    <td colspan="4"><div align="center"><span class="Estilo6">Calificaciones globales</span></div></td>
  </tr>
  <tr bgcolor="#4270BB">
    <td><div align="center"><span class="Estilo6">EJE</span></div></td>
    <td class="Estilo6"><div align="center">Variable</div></td>
    <td class="Estilo6"><div align="center">Calificación</div></td>
	<td class="Estilo6"><div align="center">Estado</div></td>
  </tr>';
 ?>
 <?php
 //$lista_vr="select * from media_formulario inner join media_categoriaform on media_formulario.categf_id=media_categoriaform.categf_id";
 $suma_total_valor=0;
 $suma_total_pesos=0;
 $lista_vr="select * from media_categoriaform";
 $rs_lvr = $DB_gogess->executec($lista_vr,array());
 if($rs_lvr)
	{
		while (!$rs_lvr->EOF) {

$numero=0;
	  /*$lista_calf="select * from media_total where usua_id=? and form_id=?  and tot_periodo='".$_SESSION['ces1313777_sessid_periodoactual']."'";
	  $rs_okcalif= $DB_gogess->executec($lista_calf,array($_SESSION['ces1313777_sessid_inicio'],$rs_listaform->fields["form_id"]));
	  $total_gen=$rs_okcalif->fields["tot_general"];
	
		  
		$aplicando_div=0;
		$estado_f='';
		$aplicando_div=$total_gen/100;
		if($aplicando_div>=0 and $aplicando_div<=0.33)
		{
		  $estado_f='En riesgo';
		}
		
		if($aplicando_div>0.33 and $aplicando_div<=0.67)
		{
		  $estado_f='&Aacute;rea de oportunidad';
		}
		
		if($aplicando_div>0.67)
		{
		  $estado_f='Buena pr&aacute;ctica';
		}*/
		
		//busca para el row
	    $cuenta_preg="select count(*) as npreg from media_formulario where categf_id=?";
	    $rs_cantiprg= $DB_gogess->executec($cuenta_preg,array($rs_lvr->fields["categf_id"]));
	    $cant_span=$rs_cantiprg->fields["npreg"]+1;
		//busca para el row
		
		$idc=1;
	   $lista_dtpreg="select * from  media_formulario where categf_id=?";
	   $rs_listapreg= $DB_gogess->executec($lista_dtpreg,array($rs_lvr->fields["categf_id"]));
	   if($rs_listapreg)
	   {
	       while (!$rs_listapreg->EOF) {
		   
		   if($idc==1)
		   {
		     
			 $valor_rowspan='<td rowspan="'.$cant_span.'"  class=borde_tabla bgcolor="#77A0D2" ><div align="center" class="Estilo6">'.$rs_lvr->fields["categf_nombre"].'</div></td>';
		   }
		   $idc++;
		   
		   //total
		   $total_gen=0;
		   $lista_calf="select * from media_total where usua_id=? and form_id=? and tot_periodo='".$_SESSION['ces1313777_sessid_periodoactual']."'";
	  $rs_okcalif= $DB_gogess->executec($lista_calf,array($_SESSION['ces1313777_sessid_inicio'],$rs_listapreg->fields["form_id"]));
	  $total_gen=$rs_okcalif->fields["tot_general"];
		   //total
		   
		$aplicando_div=0;
		$estado_f='';
		$grafico_f='';
		$aplicando_div=$total_gen/100;
		if($aplicando_div>=0 and $aplicando_div<=0.33)
		{
		  $estado_f='En riesgo';
		   $grafico_f='<img src="http://10.1.13.103/Iberoamericana/images/enriesgo.png" >';
		}
		
		if($aplicando_div>0.33 and $aplicando_div<=0.67)
		{
		  $estado_f='&Aacute;rea de oportunidad';
		  $grafico_f='<img src="http://10.1.13.103/Iberoamericana/images/oportunidad.png" >';
		}
		
		if($aplicando_div>0.67)
		{
		  $estado_f='Buena pr&aacute;ctica';
		   $grafico_f='<img src="http://10.1.13.103/Iberoamericana/images/buena.png" >';
		}
		
		$numero++;
		$color_par="";
		//echo $numero%2;
		//@$calc=$numero%2;
		if (!($numero%2)){
          $color_par="bgcolor=#BDD7EE";
		}else{
		   $color_par="bgcolor=#ffffff";
		}
		
		   
		   $variable_imp.='<tr class="Estilo9">'.$valor_rowspan.'<td class=borde_tabla '.$color_par.' height="30" ><div class="nomform_css" align="center">'.$rs_listapreg->fields["form_nombre"].'</div></td>
    <td class=borde_tabla '.$color_par.' ><div class="nomform_css">'.$grafico_f.$total_gen.'%</div></td><td class=borde_tabla  '.$color_par.' ><div class="nomform_css">'.$estado_f.'</div></td> </tr>';
	
	//cambiar aqui
	//$rs_listapreg->fields["form_peso"]
	       $suma_total_valor=$suma_total_valor+($total_gen*$rs_listapreg->fields["form_peso"]);
	       $suma_total_pesos= $suma_total_pesos+$rs_listapreg->fields["form_peso"];
		   $valor_rowspan='';
		   
		   
		   $rs_listapreg->MoveNext();
		   
		}   
		   
		}
		
		//finales
		$nombre_i='';
		$nombre_i=str_replace("III/ ","",$rs_lvr->fields["categf_nombre"]);
		$nombre_i=str_replace("II/ ","",$nombre_i);
		$nombre_i=str_replace("I/ ","",$nombre_i);
		$nombre_i=str_replace("Indicadores de","",$nombre_i);
		$resultado_finalpori=0;
		$resultado_finalpori=$suma_total_valor/$suma_total_pesos;
		
		
		$aplicando_div=0;
		$estado_f='';
		$grafico_f='';
		$aplicando_div=@round($resultado_finalpori)/100;
		if($aplicando_div>=0 and $aplicando_div<=0.33)
		{
		  $estado_f='En riesgo';
		  $grafico_f='<img src="http://10.1.13.103/Iberoamericana/images/enriesgo.png" >';
		}
		
		if($aplicando_div>0.33 and $aplicando_div<=0.67)
		{
		  $estado_f='&Aacute;rea de oportunidad';
		  $grafico_f='<img src="http://10.1.13.103/Iberoamericana/images/oportunidad.png" >';
		}
		
		if($aplicando_div>0.67)
		{
		  $estado_f='Buena pr&aacute;ctica';
		  $grafico_f='<img src="http://10.1.13.103/Iberoamericana/images/buena.png" >';
		}
		
		
		$variable_imp.='<tr class="Estilo9"><td class=borde_tabla bgcolor="#549ECB" height="30" ><div class="Estilo6" align="center">Calificaci&oacute;n '.$nombre_i.'</div></td>
    <td class=borde_tabla  bgcolor="#549ECB" ><div class="Estilo6">'.$grafico_f.round($resultado_finalpori).'%</div></td><td class=borde_tabla  bgcolor="#549ECB" ><div class="Estilo6">'.$estado_f.'</div></td> </tr>';
		//finales

  
		$suma_total_valor=0;
		$suma_total_pesos=0;
 
 
               $rs_lvr->MoveNext();
                }
  
   }
  
  $variable_imp.='<tr bgcolor="#4270BB" >
    <td colspan="4"><div align="center"><span class="Estilo6">*Si en alguna de las calificaciones anteriores obtuvo el siguiente resultado "%", favor revisar que hay contestado todas las preguntas.</span></div></td>
  </tr>';
  
  $variable_imp.='<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>';


$variable_imp.='</page>';

echo utf8_encode($variable_imp);

/*$dompdf = new DOMPDF();
$dompdf->load_html($variable_imp, 'UTF-8');
$dompdf->render();
$dompdf->stream("resultados.pdf");
*/
}
?>

