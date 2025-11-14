<?php
header('Content-type: application/vnd.ms-excel');
$fechahoy=date("Y-m-d");
header("Content-Disposition: attachment; filename="."PLANDECUENTAS_".$fechahoy.".xls");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PLAN DE CUENTAS</title>
<style type='text/css'>
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 15px;
}
-->
</style>
</head>
<body>
<?php
$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$nciudad='';
$nciudad=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id =",1,$DB_gogess);
//area datos
$documento='';
$cabecera='';
$cabecera=$objformulario->replace_cmb("app_empresa","emp_id,emp_cabecerareportes"," where emp_id=",1,$DB_gogess);

$rept_nombre="PLAN DE CUENTAS";
$documento="<div align='center' >".$rept_nombre."</div><p align='center'></p>".utf8_decode($cabecera)."<br><center><b>".$nciudad."</b></center>";



$documento.='<table width="800" border="0" cellpadding="2" cellspacing="0">
    <tr>
    <td><div align="center"><strong></strong></div></td>
	<td><div align="center"><strong></strong></div></td>
  </tr>';
  

$listadiario="select * from lpin_plancuentas order by planc_orden asc";

//echo $lista_doc;

$total_haber=0;
$detcc_debe=0;

$rs_listadiario = $DB_gogess->executec($listadiario,array());
$ib=0;
 if($rs_listadiario)
 {
     while (!$rs_listadiario->EOF) {	
	 
	 
	  $sumatotales="select round(sum(detcc_debe - detcc_haber),2) as totales from lpin_detallecomprobantecontable_vista where ".$concatena_sql." and detcc_cuentacontablep like '".$rs_listadiario->fields["planc_codigoc"].".%'";
	 
	 $rs_stotales = $DB_gogess->executec($sumatotales,array());
	 $total_data=0;
	 $total_data=$rs_stotales->fields["totales"];
	 
	 $negritai='';
	 $negritaf='';
	 if($rs_listadiario->fields["tcuenta_id"]==1)
	 {
	   $negritai='<b>';
	   $negritaf='</b>';
	 }
	 
	 $documento.='<tr>
			<td nowrap="nowrap" style=mso-number-format:"@" >'.$negritai.$rs_listadiario->fields["planc_codigoc"].$negritaf.'</td>
			<td>'.$negritai.$rs_listadiario->fields["planc_nombre"].$negritaf.'</td>
		  </tr>';
	 
	$suma_valores=$suma_valores+number_format($total_data, 2, '.', '');

	$rs_listadiario->MoveNext();	
		} 
 
 }  

$documento.='<tr>
			<td nowrap="nowrap" ></td>
			<td></td>
			<td></td>
		  </tr>';

 $documento.='		  
</table>'; 

echo utf8_decode($documento);
?>
</body>
</html>
