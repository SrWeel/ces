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
include("srifile/lib_excel.php");

//$desde_val=$_GET["desde_val"];
//$hasta_val=$_GET["hasta_val"];

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
$comillasimple="'";

$su_quito='';
//$su_quito=$_GET['centro_id'];
$fact_val="";
$arreglo_valorc=array();

 
//tippo_id

$lista_productos="select * from efacsistema_producto inner join dns_gridaplicaen on efacsistema_producto.prod_enlace=dns_gridaplicaen.prod_enlace where prof_id!=0";
$rs_productos = $DB_gogess->executec($lista_productos,array());
$totaleshaber=0;
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
<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>

</head>

<body>';

$documento.='<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td><b>No.</b></td>
    <td><b>Categor&iacute;a</b></td>
    <td><b>C&oacute;digo Pichincha Human</b></td>
    <td><b>Nombre Pichincha Humana</b></td>
    <td><b>C&oacute;digo Sistema Anterior Pichincha Humana</b></td>
    <td><b>C&oacute;digo Tarifario Nacional</b></td>
	<td><b>Nombre Tarifario Nacional</b></td>
	<td><b>Precio Pichincha Humana</b></td>	
  </tr>';

  $conteo=0;
  $comision_total=0;
 if($rs_productos)
	 {

	  while (!$rs_productos->EOF) {
	  
	  	  
	  $lista_d="select * from cesdb_arextension.dns_profesion where prof_id='".$rs_productos->fields["prof_id"]."'";
	  $rs_ld = $DB_gogess->executec($lista_d,array());
	  
	  $conteo++;

	  $documento.='<tr>
	    <td nowrap="nowrap">
        <div align="center">'.$conteo.'</div></td>
	    <td nowrap="nowrap" style=mso-number-format:"@"  >'.$rs_ld->fields["prof_nombre"].'</td>
		<td style=mso-number-format:"@"  >'.$rs_productos->fields["prod_codigo"].'</td>
		<td style=mso-number-format:"@"  >'.utf8_decode($rs_productos->fields["prod_nombre"]).'</td>
		<td style=mso-number-format:"@" >'.$rs_productos->fields["prod_codproducto"].'</td>
		<td style=mso-number-format:"@" >'.$rs_productos->fields["prod_codigotarifario"].'</td>
		<td style=mso-number-format:"@"  >'.utf8_decode($rs_productos->fields["prod_nombredespliegue"]).'</td>
		<td>'.$rs_productos->fields["prod_precio"].'</td>
	  </tr>';

  
         $rs_productos->MoveNext();
	  
	  }
	 }
	 
$documento.='</table>';	 
echo $documento;	
// $obj_xlsx = new  ExcelService();
// $nombre_file=$obj_xlsx->generateExcel($documento,$nombrexls);
 // $obj_xlsx->downloadFile($nombre_file);

?>