<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=44544000;

$nombrexls="Archivo_".date("YmdHis");
header('Content-type: application/vnd.ms-excel');
$fechahoy=date("Y-m-d");
header("Content-Disposition: attachment; filename=".$nombrexls.".xls");
//ini_set("session.cookie_lifetime",$tiempossss);
//ini_set("session.gc_maxlifetime",$tiempossss);
//session_start();
$nombre_archivo_t='';
include("lib_excel.php");

$desde_val=$_GET["desde_val"];
$hasta_val=$_GET["hasta_val"];

$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
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


if($_POST['centro_id'])
{
$lista_servicios="select * from beko_recibocabecera  cab inner join beko_recibodetalle detall on cab.doccab_id=detall.doccab_id left join dns_centrosalud on cab.centro_id=dns_centrosalud.centro_id where (DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')>='".$desde_val."' and DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')<='".$hasta_val."') and cab.centro_id = '".$_POST['centro_id']."' and 	doccab_anulado=0 order by centro_nombre,doccab_ndocumento asc";
}
else
{
$lista_servicios="select * from beko_recibocabecera  cab inner join beko_recibodetalle detall on cab.doccab_id=detall.doccab_id left join dns_centrosalud on cab.centro_id=dns_centrosalud.centro_id where (DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')>='".$desde_val."' and DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')<='".$hasta_val."') and doccab_anulado=0 order by centro_nombre,doccab_ndocumento asc";
}

//$xmldata=53;
$documento='';
$documento.='<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Doc PDF</title>

<style type="text/css">
<!--
.arplano {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>

</head>

<body>
';

$documento.='<table width="100" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td><span class="arplano">tipo</span></td>
    <td><span class="arplano">centro</span></td>
    <td><span class="arplano">forma de pago</span></td>
    <td><span class="arplano">serie1</span></td>
    <td><span class="arplano">serie2</span></td>
    <td><span class="arplano">numero</span></td>
    <td><span class="arplano">fecha</span></td>
    <td><span class="arplano">cedula/ruc</span></td>
    <td><span class="arplano">nombre_cliente</span></td>
	<td><span class="arplano">direccion</span></td>
    <td><span class="arplano">codigo_producto</span></td>
    <td><span class="arplano">nombre_producto</span></td>
    <td><span class="arplano">cantidad</span></td>
    <td><span class="arplano">valor_unitario</span></td>
    <td><span class="arplano">valor_total</span></td>
    <td><span class="arplano">impuesto</span></td>
    <td><span class="arplano">codigocontableproducto</span></td>
    <td><span class="arplano">codigo_medico</span></td>
    <td><span class="arplano">nombre_medico</span></td>
  </tr>';
  
 $rs_data = $DB_gogess->executec($lista_servicios,array());
 if($rs_data)
 {

	  while (!$rs_data->EOF) {	
	   $numseries=array();
	   $numseries=explode("-",$rs_data->fields["doccab_ndocumento"]);
	  
	   
	   
	    $forma_pago='';
	 
	   if($rs_data->fields["tippo_id"]==2)
		  {
		    $forma_pago='CONVENIOS'; 
		  }
		 if($rs_data->fields["tippo_id"]==4)
		  {
		    $forma_pago='IESS'; 
		  }
		 if($rs_data->fields["tippo_id"]==5)
		  {
		    $forma_pago='MOVILIDAD'; 
		  }
		 if($rs_data->fields["tippo_id"]==6)
		  {
		    $forma_pago='GRATUIDAD'; 
		  } 
		  
		  
 $solo_fecha=array();	
$solo_fecha=explode(" ",$rs_data->fields["doccab_fechaemision_cliente"]);



 $busca_medico="select * from  app_usuario where usua_id='".$rs_data->fields["usuaat_id"]."'";
 $rs_medico = $DB_gogess->executec($busca_medico,array());
 

  $documento.='<tr>
    <td nowrap="nowrap"><span class="arplano">RECIBO</span></td>
    <td nowrap="nowrap"><span class="arplano">'.utf8_decode($rs_data->fields["centro_nombre"]).'</span></td>
	<td nowrap="nowrap"><span class="arplano">'.$forma_pago.'</span></td>
    <td nowrap="nowrap" style=mso-number-format:"@" ><span class="arplano">'.$numseries[0].'</span></td>
    <td nowrap="nowrap" style=mso-number-format:"@" ><span class="arplano">'.$numseries[1].'</span></td>
    <td nowrap="nowrap" style=mso-number-format:"@" ><span class="arplano">'.$numseries[2].'</span></td>
    <td nowrap="nowrap"><span class="arplano">'.$solo_fecha[0].'</span></td>
    <td nowrap="nowrap" style=mso-number-format:"@" ><span class="arplano">'.$rs_data->fields["doccab_rucci_cliente"].'</span></td>
    <td nowrap="nowrap"><span class="arplano">'.utf8_encode($rs_data->fields["doccab_nombrerazon_cliente"]).'</span></td>
	<td nowrap="nowrap"><span class="arplano">'.utf8_encode($rs_data->fields["doccab_direccion_cliente"]).'</span></td>
    <td nowrap="nowrap" style=mso-number-format:"@" ><span class="arplano">'.$rs_data->fields["docdet_codprincipal"].'</span></td>
    <td nowrap="nowrap"><span class="arplano">'.utf8_decode($rs_data->fields["docdet_descripcion"]).'</span></td>
    <td nowrap="nowrap">'.$rs_data->fields["docdet_cantidad"].'</td>
    <td nowrap="nowrap">'.$rs_data->fields["docdet_preciou"].'</td>
    <td nowrap="nowrap">'.$rs_data->fields["docdet_total"].'</td>
    <td nowrap="nowrap">'.$rs_data->fields["docdet_porcentaje"].'</td>
    <td nowrap="nowrap"><span class="arplano"></span></td>
    <td nowrap="nowrap" style=mso-number-format:"@" ><span class="arplano">'.$rs_medico->fields["usua_ciruc"].'</span></td>
    <td nowrap="nowrap"><span class="arplano">'.utf8_decode($rs_medico->fields["usua_nombre"]." ".$rs_medico->fields["usua_apellido"]).'</span></td>
  </tr>';

  $rs_data->MoveNext();	   

	  }

  }

$documento.='</table>';




$documento.='</body>
</html>';

echo $documento;

 $nombrexls="Archivo_".date("YmdHis");
 
 //$obj_xlsx = new  ExcelService();
 //$nombre_file=$obj_xlsx->generateExcel($documento,$nombrexls);
 
 //$obj_xlsx->downloadFile($nombre_file);

?> 