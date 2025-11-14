<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44544000;
//ini_set("session.cookie_lifetime",$tiempossss);
//ini_set("session.gc_maxlifetime",$tiempossss);
//session_start();
$nombre_archivo_t='';
include("lib_excel.php");

$desde_val=$_GET["desde_val"];
$hasta_val=$_GET["hasta_val"];

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
$comillasimple="'";

$su_quito='';
$su_quito=$_GET['centro_id'];
$fact_val="";
if($su_quito==1)
{
  $fact_val="001-002-";
}

if($su_quito==2)
{
  $fact_val="002-002-";
}

$arreglo_valorc=array();

 
 
$lista_servicios="SELECT usuaat_id,prof_id,sum(docdet_cantidad) as valt FROM beko_documentocabecera inner join beko_documentodetalle on beko_documentocabecera.doccab_id=beko_documentodetalle.doccab_id  where (DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')>='".$desde_val."' and DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')<='".$hasta_val."') and beko_documentocabecera.centro_id = '".$_GET['centro_id']."' and doccab_anulado=0 group by prof_id,usuaat_id";


//$xmldata=53;
$documento='';
$documento.='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Doc PDF</title>

<style type="text/css">
<!--
.arplano {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.espetxt {font-size: 11px; font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; }
.espetxt1 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>

</head>

<body>
';
 $cuentasn=0;
$suma_valortotales=0;
$documento.='<center><b>FACTURAS</b><br>
<b>Fecha desde:</b>'.$desde_val.' <b>Hasta:</b>'.$hasta_val.' <br>
<br><table width="100" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td bgcolor="#BEE1EF" ><span class="arplano"><b>Profesional</b></span></td>
    <td bgcolor="#BEE1EF" ><span class="arplano"><b>Especialidad</b></span></td>
    <td bgcolor="#BEE1EF" ><span class="arplano"><b>Cantidad</b></span></td>
  </tr>';
  
 $rs_data = $DB_gogess->executec($lista_servicios,array());
 if($rs_data)
 {
$suma_cantidades=0;
$suma_valorunitario=0;
	  while (!$rs_data->EOF) {	
	 

    $busca_us="select * from app_usuario where usua_id='".$rs_data->fields["usuaat_id"]."'";
	$rs_us = $DB_gogess->executec($busca_us,array());
	

	$n_nom=$rs_us->fields["usua_nombre"]." ".$rs_us->fields["usua_apellido"];
	
	$busca_prof="select * from cesdb_arextension.dns_profesion where prof_id='".$rs_data->fields["prof_id"]."'";
	$rs_prof = $DB_gogess->executec($busca_prof,array());
	
	$documento.='<tr>
    <td nowrap="nowrap"><span class="arplano">'.$n_nom.'</span></td>
    <td nowrap="nowrap"><span class="arplano">'.$rs_prof->fields["prof_nombre"].'</span></td>
    <td nowrap="nowrap"><span class="arplano">'.$rs_data->fields["valt"].'</span></td>';
   

  $rs_data->MoveNext();	   

	  }

  }

$documento.='<tr>
    <td><span class="arplano">&nbsp;</span></td>
    <td><span class="arplano">&nbsp;</span></td>
    <td><span class="arplano">&nbsp;</span></td>
   
  </tr>';

$documento.='</table></center>';




$lista_servicios2="SELECT usuaat_id,prof_id,docdet_codprincipal,sum(docdet_cantidad) as valt FROM beko_documentocabecera inner join beko_documentodetalle on beko_documentocabecera.doccab_id=beko_documentodetalle.doccab_id  where (DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')>='".$desde_val."' and DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')<='".$hasta_val."') and beko_documentocabecera.centro_id = '".$_GET['centro_id']."' and doccab_anulado=0 group by usuaat_id,prof_id,docdet_codprincipal";


$documento2.='<center><br><br>
<b>Fecha desde:</b>'.$desde_val.' <b>Hasta:</b>'.$hasta_val.' <br>
<br><table width="100" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td bgcolor="#BEE1EF" ><span class="arplano"><b>Profesional</b></span></td>
    <td bgcolor="#BEE1EF" ><span class="arplano"><b>Especialidad</b></span></td>
	<td bgcolor="#BEE1EF" ><span class="arplano"><b>Producto</b></span></td>
    <td bgcolor="#BEE1EF" ><span class="arplano"><b>Cantidad</b></span></td>
  </tr>';
  
 $rs_data = $DB_gogess->executec($lista_servicios2,array());
 if($rs_data)
 {
$suma_cantidades=0;
$suma_valorunitario=0;
	  while (!$rs_data->EOF) {	
	 

    $busca_us="select * from app_usuario where usua_id='".$rs_data->fields["usuaat_id"]."'";
	$rs_us = $DB_gogess->executec($busca_us,array());
	

	$n_nom=$rs_us->fields["usua_nombre"]." ".$rs_us->fields["usua_apellido"];
	
	$busca_prof="select * from cesdb_arextension.dns_profesion where prof_id='".$rs_data->fields["prof_id"]."'";
	$rs_prof = $DB_gogess->executec($busca_prof,array());
	
	$busca_producto="select * from efacsistema_producto where prod_codigo='".$rs_data->fields["docdet_codprincipal"]."'";
	$rs_prd = $DB_gogess->executec($busca_producto,array());
	
	$documento2.='<tr>
    <td nowrap="nowrap"><span class="arplano">'.$n_nom.'</span></td>
    <td nowrap="nowrap"><span class="arplano">'.$rs_prof->fields["prof_nombre"].'</span></td>
	<td nowrap="nowrap"><span class="arplano">'.$rs_prd->fields["prod_nombre"].'</span></td>
    <td nowrap="nowrap"><span class="arplano">'.$rs_data->fields["valt"].'</span></td>';
   

  $rs_data->MoveNext();	   

	  }

  }

$documento2.='<tr>
    <td><span class="arplano">&nbsp;</span></td>
    <td><span class="arplano">&nbsp;</span></td>
    <td><span class="arplano">&nbsp;</span></td>
	<td><span class="arplano">&nbsp;</span></td>
   
  </tr>';

$documento2.='</table></center>';


echo $documento.$documento2;


?> 
