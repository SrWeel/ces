<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
ini_set("session.cookie_lifetime",36000);
ini_set("session.gc_maxlifetime",36000);
session_start();
setlocale(LC_MONETARY, 'en_US');
if($_SESSION['ces1313777_sessid_inicio'])
{

//2 excel
//3 pdf

function ver_ciudadpaciente($ci,$DB_gogess)
{

$lista_hijos="select distinct centro_id from app_cliente inner join dns_representante on app_cliente.clie_enlace=dns_representante.clie_enlace where repres_ci='".trim($ci)."'";
$rs_datahijos = $DB_gogess->executec($lista_hijos,array());

$centro_id=@$rs_datahijos->fields["centro_id"];
if(!(@$rs_datahijos->fields["centro_id"]))
{
   $centro_id=1;
}

return $centro_id;

}

$previsual=0;
if(@$_POST["previsual"])
{
$previsual=@$_POST["previsual"];
$fecha_i=@$_POST["fecha_inicio"];
$fecha_f=@$_POST["fecha_fin"];
$centro_id=@$_POST["centro_id"];
$clie_institucionval=@$_POST["clie_institucionval"];
$ireport=@$_POST["ireport"];
$cliente_ruc=@$_POST["cliente_ruc"];
}
else
{
$previsual=@$_GET["previsual"];
$fecha_i=@$_GET["fecha_inicio"];
$fecha_f=@$_GET["fecha_fin"];
$centro_id=@$_GET["centro_id"];
$clie_institucionval=@$_GET["clie_institucionval"];
$ireport=@$_GET["ireport"];
$cliente_ruc=@$_GET["cliente_ruc"];
}

if($previsual==2)
{
header('Content-type: application/vnd.ms-excel');
$fechahoy=date("Y-m-d");
header("Content-Disposition: attachment; filename="."repxls_".$fechahoy.".xls");
}

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
require_once('tcpdf_include.php');

include("lib.php");

$objformulario= new  ValidacionesFormulario(); 

$bandera_t1=0;
$actual = strtotime(date("Y-m-d"));
$mesmenos = date("Y-m-d", strtotime("-2 month", $actual));


$fecha_iop='2022-01-01';

$sql1="";
$sql2="";
$sql3="";
$sql4="";
$sql5="";

$sql1bu="";
$sql2bu="";
$sql3bu="";
$sql4bu="";
$sql5bu="";


if($centro_id)
  {
  // $sql2=" app_cliente.centro_id=".$centro_id." and ";
  }

//========================================
$fecha = new DateTime($fecha_iop);
$fecha->modify('last day of December');
$fecha_fop=$fecha->format('Y-m-d');

$fechainicial = $fecha_i;
$fecha_fop = date('Y-m-d', strtotime($fechainicial . ' -1 day'));

if($fecha_i!='' and $fecha_f!='')
{
   $sql3=" comcont_fecha>='".$fecha_i." 00:00:00' and comcont_fecha<='".$fecha_f." 23:59:59' and ";
    $sql3bu=" comcont_fecha>='".$fecha_iop." 00:00:00' and comcont_fecha<='".$fecha_fop." 23:59:59' and ";
}  
else
{
  
  if($fecha_i!='' and $fecha_f=='')
  {  
    $sql3=" comcont_fecha>='".$fecha_i." 00:00:00' and ";
  }
  else
  {
    if($fecha_i=='' and $fecha_f!='')
	{
	   $sql3=" comcont_fecha<='".$fecha_f." 23:59:59' and ";  
    }
  }

}  

if($clie_institucionval)
  {
   $sql4=" clie_institucion like '%".$clie_institucionval."%' and ";
  }  

if($cliente_ruc)
{
$sql5=" doccab_rucci_cliente = '".trim($cliente_ruc)."' and ";
}  
      

$concatena_sql=$sql1.$sql2.$sql3.$sql4.$sql5;
$concatena_sql=substr($concatena_sql,0,-4);

$concatena_sqlbu=$sql1bu.$sql2bu.$sql3bu.$sql4bu.$sql5bu;
$concatena_sqlbu=substr($concatena_sqlbu,0,-4);

$nciudad='';
$nciudad=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id =",$centro_id,$DB_gogess);



//area datos
$documento='';
$cabecera='';
$cabecera=$objformulario->replace_cmb("app_empresa","emp_id,emp_cabecerareportes"," where emp_id=",1,$DB_gogess);

$css="<style type='text/css'>
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style>";

$reporte_pg="select * from sth_report where rept_id=".$ireport;
$rs_reportepg = $DB_gogess->executec($reporte_pg,array());

$rept_nombre=$rs_reportepg->fields["rept_nombre"];

$cabecera='<div align="center">
<b>'.$rept_nombre.'<br><br>CL&Iacute,NICA DE ESPECIALIDADES DEL SUR
<br>
RUC: 1792935261001
<br></b>
</div>';

$documento=$css."<div align='center' >".utf8_decode($cabecera)."<br><center><b>".$nciudad."</b></center>";
//echo $lista_servicios;
//$xmldata=53;

$cuenta_fac=0;
$documento.='<center>
Desde: '.$fecha_i.' Hasta: '.$fecha_f.'<br>
<br>';

///programacion reporte

$documento.='<table width="700" border="0"  cellpadding="2" cellspacing="0">
    <tr>
    <td width="153" ><div align="center"><strong></strong></div></td>
	<td width="356" ><div align="center"><strong></strong></div></td>
    <td width="179" ><div align="center"><strong></strong></div></td>
  </tr>';
  

$listadiario="select * from lpin_plancuentas where planc_codigo in (4,5) order by planc_orden asc";

//echo $lista_doc;

$total_haber=0;
$detcc_debe=0;

$rs_listadiario = $DB_gogess->executec($listadiario,array());
$ib=0;
 if($rs_listadiario)
 {
     while (!$rs_listadiario->EOF) {	
	 
	  //saldo anterior
	 $sumatotalesAT="select round(sum(detcc_debe - detcc_haber),2) as totales from  (lpin_detallecomprobantecontable join lpin_comprobantecontable on(lpin_detallecomprobantecontable.comcont_enlace = lpin_comprobantecontable.comcont_enlace)) where ".$concatena_sqlbu." and detcc_cuentacontablepg like '".$rs_listadiario->fields["planc_codigoc"].".%' and comcont_anulado=0";	
	 $rs_stotalesAT = $DB_gogess->executec($sumatotalesAT,array());
	 //saldo anterior	
	 
	 $sumatotales="select round(sum(detcc_debe - detcc_haber),2) as totales from  (lpin_detallecomprobantecontable join lpin_comprobantecontable on(lpin_detallecomprobantecontable.comcont_enlace = lpin_comprobantecontable.comcont_enlace)) where ".$concatena_sql." and detcc_cuentacontablepg like '".$rs_listadiario->fields["planc_codigoc"].".%' and comcont_anulado=0";	
	 $rs_stotales = $DB_gogess->executec($sumatotales,array());
	 
	 //echo "<br>----------------------------------------<br>";
	 //echo $rs_listadiario->fields["planc_codigoc"]."<br>";
	// echo $sumatotalesAT."<br>";
	// echo $sumatotales."<br>";
	 //echo "<br>----------------------------------------<br>";
	 
	 $total_data=0;
	 $total_data=$rs_stotalesAT->fields["totales"]+$rs_stotales->fields["totales"];	 
	 $total_data=$rs_stotales->fields["totales"];
	 
	
	 $cantidadd_valor=0;
	 $cantidadd_valor=busca_conarbol($rs_listadiario->fields["planc_codigoc"],$DB_gogess);
	 
	 $negritai='';
	 $negritaf='';
	 
	 if($cantidadd_valor>0)
	 {
	   $negritai='<b>';
	   $negritaf='</b>';	 
	 }
	 
	 
	 
	 if($total_data!=0)
	 {
	 $documento.='<tr>
			<td nowrap="nowrap" style=mso-number-format:"@" >'.$negritai.$rs_listadiario->fields["planc_codigoc"].$negritaf.'</td>
			<td>'.$negritai.$rs_listadiario->fields["planc_nombre"].$negritaf.'</td>
			<td style="text-align: right;" >'.$negritai.'$'.number_format(abs($total_data), 2, '.', ',').$negritaf.'</td>
		  </tr>';
	 
	}

	$rs_listadiario->MoveNext();	
		} 
 
 }  

//$suma_ingresos="select round(sum(detcc_debe - detcc_haber),2) as totales from lpin_detallecomprobantecontable_vista where ".$concatena_sql." and detcc_cuentacontablep like '4.%' and comcont_anulado=0";
//$rs_ingresos = $DB_gogess->executec($suma_ingresos,array());
//$suma_g="select round(sum(detcc_debe - detcc_haber),2) as totales from lpin_detallecomprobantecontable_vista where ".$concatena_sql." and detcc_cuentacontablep like '5.%' and comcont_anulado=0 ";
//$rs_g = $DB_gogess->executec($suma_g,array());

$suma_ingresosac="select round(sum(detcc_debe - detcc_haber),2) as totales from lpin_detallecomprobantecontable_vista where ".$concatena_sql." and detcc_cuentacontablep like '3.1.7.1%' and comcont_anulado=0";
$rs_ingresosac = $DB_gogess->executec($suma_ingresosac,array());
$vacumulado=0;
$vacumulado=$rs_ingresosac->fields["totales"];


$suma_ingresos="select round(sum(detcc_debe - detcc_haber),2) as totales from (lpin_detallecomprobantecontable join lpin_comprobantecontable on((lpin_detallecomprobantecontable.comcont_enlace = lpin_comprobantecontable.comcont_enlace))) where ".$concatena_sql." and codcuentapg = '4' and comcont_anulado=0";
$rs_ingresos = $DB_gogess->executec($suma_ingresos,array());

$suma_g="select round(sum(detcc_debe - detcc_haber),2) as totales from (lpin_detallecomprobantecontable join lpin_comprobantecontable on((lpin_detallecomprobantecontable.comcont_enlace = lpin_comprobantecontable.comcont_enlace))) where ".$concatena_sql." and codcuentapg like '5' and comcont_anulado=0";
$rs_g = $DB_gogess->executec($suma_g,array());

//echo abs($rs_ingresos->fields["totales"])."<br>";
//echo abs($rs_g->fields["totales"])."<br>";
$vacumulado=0;

$resultado_eje=(abs($rs_ingresos->fields["totales"])-abs($rs_g->fields["totales"]))-$vacumulado;

//echo "Ingreso:".$rs_ingresos->fields["totales"]."<br>";
//echo "Gastos:".$rs_g->fields["totales"]."<br>";

//$resultado_eje=abs($rs_ingresos->fields["totales"])-abs($rs_g->fields["totales"]);

$documento.='<tr>
			<td nowrap="nowrap" ></td>
			<td>UTILIDAD DEL EJERCICO</td>
			<td style="text-align: right;" >$'.number_format(round($resultado_eje,2), 2, '.', ',').'</td>
		  </tr>';

 $documento.='		  
</table>';

$documento.='<center><br><br><br><br><br><br><br><table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center"></div></td>
    <td>&nbsp;</td>
    <td><div align="center"></div></td>
  </tr>
  <tr>
    <td><div align="center">__________________________</div></td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><div align="center">__________________________</div></td>
  </tr>
  <tr>
    <td><div align="center">Gerente General </div></td>
    <td><div align="center"></div></td>
    <td><div align="center">Contador</div></td>
  </tr>
</table>
</center>';

///programacion reporte


//area datos 
if($previsual==1)
{
echo $documento; 
}
if($previsual==2)
{
echo utf8_decode($documento); 
}


if($previsual==3)
{

$comprobantepdf='';
$comprobantepdf=utf8_decode($documento);  


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
    var $filtro_valor_h1;
	var $filtro_valor_h2;
	var $filtro_valor_h3;
	//Page header

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom		
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');		
		//$image_file = 'logopie.fw.png';
       // $this->Image($image_file, 80, 273, 40, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);		
    }
}


$pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('LOS PINOS');
$pdf->SetTitle('LOS PINOS');
$pdf->SetSubject('LOS PINOS');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->filtro_valor_h1='';
$pdf->filtro_valor_h2='';
$pdf->filtro_valor_h3='';
// set default header data
$pdf->setPrintHeader(false);
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);
// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 20, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}
// ---------------------------------------------------------
// set font
$pdf->SetFont('helvetica', 'B', 15);
// add a page
$pdf->AddPage();
//$pdf->Write(0, 'HANOR', '', 0, 'L', true, 0, false, false, 0);
$pdf->SetFont('helvetica', '', 9);
$pdf->writeHTML(utf8_encode($comprobantepdf), true, false, false, false, '');
/*if($_GET["dhoja"]==1)
{
$pdf->AddPage();
$pdf->writeHTML(utf8_encode("<strong>V. RESPONSABLES </strong><div align='center'>".$responsables_cuadro."</div>"), true, false, false, false, '');
}*/
//echo $lee_plantilla;
//echo $comprobantepdf="Holaa";
$nombre_pdf="pdfdocumento_".date("Y-m-d").".pdf";
$pdf->Output($nombre_pdf, 'I');




}


 
 }

?>