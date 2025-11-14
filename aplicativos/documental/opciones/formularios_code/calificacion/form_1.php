<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Calif</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.Estilo1 {
	font-size: 14px;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.Estilo2 {
	color: #FFFFFF;
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$objperfil=new objetosistema_perfil();

$lista_formualrios="select * from media_formulario where form_id=?";
$rs_listaformularios = $DB_gogess->executec($lista_formualrios,array($_POST["form_idp"]));



function radio_calf($form_idp,$usua_idp,$pregf_id,$DB_gogess)
{
  $lista_result="select * from media_resultados where form_id=? and usua_id=? and pregf_id=? and result_estado='true' and result_periodo='".$_SESSION['ces1313777_sessid_periodoactual']."'";
	$rs_lresultado = $DB_gogess->executec($lista_result,array($form_idp,$usua_idp,$pregf_id));
	if($rs_lresultado)
	{
		while (!$rs_lresultado->EOF) {
		
		//echo $rs_lresultado->fields["resp_id"]."<br>";
		//echo $rs_lresultado->fields["result_estado"];
		
		$busca_valorresp="select resp_valor from media_respuesta where resp_id=?";
		$br_respt=$DB_gogess->executec($busca_valorresp,array($rs_lresultado->fields["resp_id"]));
		$resultado= $br_respt->fields["resp_valor"];
		
		$rs_lresultado->MoveNext();
		}
	}
	
   return @$resultado;
}


function check_calif($rangos,$form_idp,$usua_idp,$pregf_id,$DB_gogess)
{

     $lista_result="select count(*) as total from media_resultados where form_id=? and usua_id=? and pregf_id=? and result_estado='true'  and result_periodo='".$_SESSION['ces1313777_sessid_periodoactual']."'";
	$rs_lresultado = $DB_gogess->executec($lista_result,array($_POST["form_idp"],$_POST["usua_idp"],$pregf_id));
	//echo $rs_lresultado->fields["total"]."<br>";
	
	$lista_valores=explode(";",$rangos);
	
	//print_r($lista_valores);
	for($i=0;$i<count($lista_valores);$i++)
	{
	    $rangos_valoresx=explode("-",$lista_valores[$i]);
		//print_r($rangos_valoresx);
		if($rs_lresultado->fields["total"]>=@$rangos_valoresx[1] and $rs_lresultado->fields["total"]<=@$rangos_valoresx[2])
		{
		  $resultado2=$rangos_valoresx[0];
		}
	
	}
	
	return $resultado2;


}

function porcentaje_calif($form_idp,$usua_idp,$pregf_id,$DB_gogess)
{
  $h=0;
  $lista_result="select * from media_resultados where form_id=? and usua_id=? and pregf_id=? and result_estado!='' and result_periodo='".$_SESSION['ces1313777_sessid_periodoactual']."'";
	$rs_lresultado = $DB_gogess->executec($lista_result,array($form_idp,$usua_idp,$pregf_id));
	if($rs_lresultado)
	{
		while (!$rs_lresultado->EOF) {
		
		//echo $rs_lresultado->fields["resp_id"]."<br>";
		$var_uno[$h]=trim($rs_lresultado->fields["result_estado"]);
		$h++;

		
		$rs_lresultado->MoveNext();
		}
	}
	
	//print_r($var_uno);
	$resultadox=0;
	if(@$var_uno[1])
	{
	$resultadox=($var_uno[0]/$var_uno[1])*100;
	}
	
	if(@$var_uno[2]=='true')
	{
	$resultadox=0;
	}
	
	if(@$var_uno[3]=='true')
	{
	$resultadox=0;
	}
	
    return $resultadox;

}
?>

<table cellspacing="1" cellpadding="2">
  <tr>
    <td width="480" colspan="6" class="xl98 Estilo1"><div align="center">Resultados: </div></td>
  </tr>
 <?php
 $suma_pesos=0;
 $suma_general=0;
 $lista_preguntas="select * from media_preguntas where form_id=?";
 $rs_lresultadox = $DB_gogess->executec($lista_preguntas,array($_POST["form_idp"]));
 if($rs_lresultadox)
	{
		while (!$rs_lresultadox->EOF) {
 ?> 
<tr bgcolor="#BFD5DD" class="resultado_area_<?php echo $rs_lresultadox->fields["pregf_id"]; ?>" >
    <td width="320" colspan="4" bgcolor="#6A9DB0" class="xl96 Estilo2"><?php  echo $rs_lresultadox->fields["pregf_nombre"]; ?></td>
    <td colspan="2" bgcolor="#BFD5DD" class="Estilo1"><div align="center"><?php
	if($rs_lresultadox->fields["pregf_funcion"]==1)
	{
	$resultad_calculo=radio_calf($_POST["form_idp"],$_POST["usua_idp"],$rs_lresultadox->fields["pregf_id"],$DB_gogess);
	
	}
	
	if($rs_lresultadox->fields["pregf_funcion"]==2)
	{
	$resultad_calculo=check_calif(trim($rs_lresultadox->fields["pregf_formula"]),$_POST["form_idp"],$_POST["usua_idp"],$rs_lresultadox->fields["pregf_id"],$DB_gogess);
	}

if($rs_lresultadox->fields["pregf_funcion"]==3)
	{
	$resultad_calculo=porcentaje_calif($_POST["form_idp"],$_POST["usua_idp"],$rs_lresultadox->fields["pregf_id"],$DB_gogess);
	}
	
	
	//calcula pesos
	$suma_pesos+=$rs_lresultadox->fields["pregf_peso"];
	
	//calcula pesos
	$suma_general+=$resultad_calculo*$rs_lresultadox->fields["pregf_peso"];
	
	
	
	//Inserta_totales
	$busca_datos="select tot_id from media_total where form_id=? and usua_id=? and pregf_id=? and tot_periodo='".$_SESSION['ces1313777_sessid_periodoactual']."'";
	$rs_datos = $DB_gogess->executec($busca_datos,array($_POST["form_idp"],$_POST["usua_idp"],$rs_lresultadox->fields["pregf_id"]));
	
	if($rs_datos->fields["tot_id"])
	{
	  $atualiza_v="update media_total set tot_resultado='".round($resultad_calculo)."',tot_pesoap='".$rs_lresultadox->fields["pregf_peso"]."' where tot_id=?";
	  $ok_act=$DB_gogess->executec($atualiza_v,array($rs_datos->fields["tot_id"]));
	}
	else
	{
	  $inserta_v="insert into media_total(usua_id,form_id,pregf_id,tot_resultado,tot_pesoap,tot_periodo) values (?,?,?,?,?,'".$_SESSION['ces1313777_sessid_periodoactual']."')";
	  $ok_ins=$DB_gogess->executec($inserta_v,array($_POST["usua_idp"],$_POST["form_idp"],$rs_lresultadox->fields["pregf_id"],round($resultad_calculo),$rs_lresultadox->fields["pregf_peso"]));
	}
	
	//Inserta totales
	echo round($resultad_calculo)." %";
	$resultad_calculo=0;
	?></div></td>
  </tr>
  <tr>
    <td class="xl95">&nbsp; </td>
    <td class="xl95">&nbsp; </td>
    <td class="xl95">&nbsp; </td>
    <td class="xl95">&nbsp; </td>
    <td class="Estilo1"> <div align="center"></div></td>
    <td class="Estilo1"> <div align="center"></div></td>
  </tr>
 <?php  
       $rs_lresultadox->MoveNext();
      }
 
 }
 
 ?> 
  
  <tr bgcolor="#BFD5DD">
    <td width="480" colspan="4" bgcolor="#660000" class="Estilo2">Calificaci&oacute;n global punto <?php  echo $rs_listaformularios->fields["form_nombre"]; ?> </td>
    <td colspan="2" class="Estilo1"><div align="center"><?php 
	
	$totalgen=$suma_general/$suma_pesos;
	echo round($totalgen)." %";
	
	$actuliz_generales="update media_total set tot_general='".round($totalgen)."' where form_id=? and usua_id=? and tot_periodo='".$_SESSION['ces1313777_sessid_periodoactual']."'";
	$ok_gen=$DB_gogess->executec($actuliz_generales,array($_POST["form_idp"],$_POST["usua_idp"]));
	  ?></div></td>
  </tr>
</table>


</body>
</html>
