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



 $lista_servicios="select * from beko_recibocabecera  cab inner join beko_recibodetalle detall on cab.doccab_id=detall.doccab_id where doccab_fechaemision_cliente>='".$desde_val."' and doccab_fechaemision_cliente<='".$hasta_val."' and doccab_ndocumento like '".$fact_val."%' order by doccab_ndocumento asc";
 
$lista_servicios="select * from beko_recibocabecera  cab inner join beko_recibodetalle detall on cab.doccab_id=detall.doccab_id where (DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')>='".$desde_val."' and DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')<='".$hasta_val."') and cab.centro_id = '".$_GET['centro_id']."' and doccab_anulado=0  order by doccab_ndocumento asc";

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
-->
</style>

</head>

<body>
';

$documento.='<table width="100" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td><span class="arplano">forma de pago</span></td>
    <td><span class="arplano">tipo</span></td>
    <td><span class="arplano">serie1</span></td>
    <td><span class="arplano">serie2</span></td>
    <td><span class="arplano">numero</span></td>
    <td><span class="arplano">fecha</span></td>
    <td><span class="arplano">codigo_cliente</span></td>
    <td><span class="arplano">nombre_cliente</span></td>
	<td><span class="arplano">direccion</span></td>
    <td><span class="arplano">ruc</span></td>
    <td><span class="arplano">codigo_grupo</span></td>
    <td><span class="arplano">codigo_producto</span></td>
    <td><span class="arplano">nombre_producto</span></td>
    <td><span class="arplano">cantidad</span></td>
    <td><span class="arplano">valor_unitario</span></td>
	<td><span class="arplano">total</span></td>
    <td><span class="arplano">impuesto</span></td>
    <td><span class="arplano">codigocontableproducto</span></td>
    <td><span class="arplano">numeroautorizacion</span></td>

  </tr>';
  $suma_valot=0;
 $rs_data = $DB_gogess->executec($lista_servicios,array());
 if($rs_data)
 {
$suma_cantidades=0;
$suma_valorunitario=0;
	  while (!$rs_data->EOF) {	
	   $numseries=array();
	   $numseries=explode("-",$rs_data->fields["doccab_ndocumento"]);
	   
	   /* if($rs_data->fields["impu_codigo"]==2)
	   {
	     $impuesto_iv=12;
	   
	   }*/
	   $nueva_fecha='';
	   $separa_fecha=explode("-",$rs_data->fields["doccab_fechaemision_cliente"]);
	   $nueva_fecha=$separa_fecha[1]."/".$separa_fecha[2]."/".$separa_fecha[0];
	   
	   
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
		  

  $documento.='<tr>
    <td nowrap="nowrap"><span class="arplano">'.$forma_pago.'</span></td>
    <td nowrap="nowrap"><span class="arplano">RECIBO</span></td>
    <td nowrap="nowrap"><span class="arplano">'.$numseries[0].'</span></td>
    <td nowrap="nowrap"><span class="arplano">'.$numseries[1].'</span></td>
    <td nowrap="nowrap"><span class="arplano">'.$numseries[2].'</span></td>
    <td nowrap="nowrap"><span class="arplano">'.$nueva_fecha.'</span></td>
    <td nowrap="nowrap"><span class="arplano">'.$rs_data->fields["doccab_rucci_cliente"].'</span></td>
    <td nowrap="nowrap"><span class="arplano">'.$rs_data->fields["doccab_nombrerazon_cliente"].'</span></td>
	<td nowrap="nowrap"><span class="arplano">'.$rs_data->fields["doccab_direccion_cliente"].'</span></td>
    <td nowrap="nowrap"><span class="arplano">'.$rs_data->fields["doccab_rucci_cliente"].'</span></td>
    <td nowrap="nowrap"><span class="arplano">1</span></td>
    <td nowrap="nowrap"><span class="arplano">'.$rs_data->fields["docdet_codprincipal"].'</span></td>
    <td nowrap="nowrap"><span class="arplano">'.$rs_data->fields["docdet_descripcion"].'</span></td>
    <td nowrap="nowrap">'.$rs_data->fields["docdet_cantidad"].'</td>
    <td nowrap="nowrap">'.$rs_data->fields["docdet_preciou"].'</td>
	<td nowrap="nowrap">'.$rs_data->fields["docdet_total"].'</td>
    <td nowrap="nowrap">'.$rs_data->fields["docdet_porcentaje"].'</td>
    <td nowrap="nowrap"><span class="arplano"></span></td>
    <td nowrap="nowrap"><span class="arplano">'.$rs_data->fields["doccab_clavedeaccesos"].'</span></td>

  </tr>';
  $suma_cantidades=$suma_cantidades+$rs_data->fields["docdet_cantidad"];
  $suma_valorunitario=$suma_valorunitario+$rs_data->fields["docdet_preciou"];
  
  $suma_valot=$suma_valot+$rs_data->fields["docdet_total"];


  $rs_data->MoveNext();	   

	  }

  }

$documento.='<tr>
    <td><span class="arplano">&nbsp;</span></td>
    <td><span class="arplano">&nbsp;</span></td>
    <td><span class="arplano">&nbsp;</span></td>
    <td><span class="arplano">&nbsp;</span></td>
    <td><span class="arplano">&nbsp;</span></td>
    <td><span class="arplano">&nbsp;</span></td>
	<td><span class="arplano">&nbsp;</span></td>
    <td><span class="arplano">&nbsp;</span></td>
    <td><span class="arplano">&nbsp;</span></td>
    <td><span class="arplano">&nbsp;</span></td>
    <td><span class="arplano">&nbsp;</span></td>
    <td><span class="arplano"></span></td>
    <td><span class="arplano"></span></td>
	<td><span class="arplano">'.$suma_valot.'</span></td>
    <td><span class="arplano">&nbsp;</span></td>
    <td><span class="arplano">&nbsp;</span></td>
    <td><span class="arplano">&nbsp;</span></td>

  </tr>';

$documento.='</table>';


$listapor_producto="select docdet_codprincipal,sum(docdet_cantidad) as cantidad,sum(docdet_total) as total from beko_recibocabecera  cab inner join beko_recibodetalle detall on cab.doccab_id=detall.doccab_id where (DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')>='".$desde_val."' and DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')<='".$hasta_val."') and cab.centro_id like '".$_GET['centro_id']."' and 	doccab_anulado=0 group by docdet_codprincipal";

$resumen_uno='<p></p><table width="100" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td><span class="arplano"><B>Producto</B></span></td>
    <td><span class="arplano"><B>Cantidad</B></span></td>
    <td><span class="arplano"><B>Total</B></span></td>
  </tr>';  
$suma_cantidad=0;
$suma_total=0;
$rs_datalp = $DB_gogess->executec($listapor_producto,array());
 if($rs_datalp)
 {
    while (!$rs_datalp->EOF) {
	
	$busca_producto="select * from efacsistema_producto where prod_codigo='".$rs_datalp->fields["docdet_codprincipal"]."'";
	$rs_prd = $DB_gogess->executec($busca_producto,array());
	
    $resumen_uno.='<tr>
    <td nowrap="nowrap" ><span class="arplano" >'.$rs_datalp->fields["docdet_codprincipal"]."-".$rs_prd->fields["prod_nombre"].'</span></td>
	<td nowrap="nowrap" ><span class="arplano">'.$rs_datalp->fields["cantidad"].'</span></td>
	<td nowrap="nowrap" ><span class="arplano">'.$rs_datalp->fields["total"].'</span></td>
    </tr>';
	$suma_cantidad=$suma_cantidad+$rs_datalp->fields["cantidad"];
	$suma_total=$suma_total+$rs_datalp->fields["total"];
	
    $rs_datalp->MoveNext();	
	}
 } 

$resumen_uno.='<tr>
    <td nowrap="nowrap" bgcolor="#D0DCEA" ><span class="arplano" ><B>TOTALES</B></span></td>
	<td nowrap="nowrap" bgcolor="#D0DCEA" ><span class="arplano"><B>'.$suma_cantidad.'</B></span></td>
	<td nowrap="nowrap" bgcolor="#D0DCEA" ><span class="arplano"><B>'.$suma_total.'</B></span></td>
    </tr>';
	
$resumen_uno.='</table>'; 



$documento.=$resumen_uno.'</body>
</html>';





echo $documento
?> 