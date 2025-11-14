<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
ini_set("session.cookie_lifetime",36000);
ini_set("session.gc_maxlifetime",36000);
session_start();
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

$objformulario= new  ValidacionesFormulario(); 

$bandera_t1=0;
$actual = strtotime(date("Y-m-d"));
$mesmenos = date("Y-m-d", strtotime("-2 month", $actual));




$sql1="";
$sql2="";
$sql3="";
$sql4="";
$sql5="";

if($centro_id)
  {
  // $sql2=" app_cliente.centro_id=".$centro_id." and ";
  }


if($fecha_i!='' and $fecha_f!='')
{
   $sql3=" doccab_fechaemision_cliente>='".$fecha_i."' and doccab_fechaemision_cliente<='".$fecha_f."' and ";
}  
else
{
  
  if($fecha_i!='' and $fecha_f=='')
  {  
    $sql3=" doccab_fechaemision_cliente>='".$fecha_i."' and ";
  }
  else
  {
    if($fecha_i=='' and $fecha_f!='')
	{
	   $sql3=" doccab_fechaemision_cliente<='".$fecha_f."' and ";  
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
	font-size: 10px;
}
-->
</style>";

$reporte_pg="select * from sth_report where rept_id=".$ireport;
$rs_reportepg = $DB_gogess->executec($reporte_pg,array());

$rept_nombre=$rs_reportepg->fields["rept_nombre"];
$documento=$css."<div align='center' >".$rept_nombre."</div><p align='center'>".$rs_reportepg->fields["rept_observacion"]."</p>".utf8_decode($cabecera)."<br><center><b>".$nciudad."</b></center>";


//echo $lista_servicios;
//$xmldata=53;

$cuenta_fac=0;
$documento.='<center>
Desde: '.$fecha_i.' Hasta: '.$fecha_f.'<br>
<br>';

///programacion reporte

$documento.='<table border="1" cellpadding="0" cellspacing="0">
  <tr>
	<td>F. Emisi&oacute;n</td>
    <td>RUC</td>
    <td>CEDULA</td>	
    <td>Raz&oacute;n Social</td>
    <td>Detalle</td>
    <td>No. Comprobante</td>
    <td>No. Autorizaci&oacute;n</td>
    <td>Cod. Sustento</td>
    <td>Cod. Asiento</td>
    <td>Centro de Costo</td>
    <td>12%</td>
    <td>0%</td>
    <td>No objeto</td>
    <td>Subtotal</td>
    <td>IVA</td>
    <td>IVA Gasto</td>
    <td>ICE</td>
    <td>Total</td>
    <td>10%</td>
    <td>20%</td>
    <td>30%</td>
    <td>50%</td>
    <td>70%</td>
    <td>100%</td>
    <td>Subtotal</td>
    <td nowrap="nowrap">Fecha Retenci&oacute;n</td>
    <td nowrap="nowrap">No. Retenci&oacute;n</td>
    <td nowrap="nowrap">No. Autorizaci&oacute;n</td>
    <td>1%</td>
    <td>Cod.</td>
    <td>1.75%</td>
    <td>Cod.</td>
    <td>2%</td>
    <td>Cod.</td>
    <td>2.75%</td>
    <td>Cod.</td>
    <td>8%</td>
    <td>Cod.</td>
    <td>10%</td>
    <td>Cod.</td>
    <td>0%</td>
    <td>Cod.</td>
    <td>Otros %</td>
    <td>Cod.</td>
    <td>Subtotal</td>
    <td>Total Retenciones</td>
  </tr>';
  
if($concatena_sql)
{  
$lista_doc="SELECT *,'0' as ivagasto,'0' as ice FROM beko_documentocabecera inner join app_proveedor on beko_documentocabecera.proveeve_id=app_proveedor.provee_id where ".$concatena_sql." and doccab_anulado=0 and doccab_nousar=0";
}
else
{
$lista_doc="SELECT *,'0' as ivagasto,'0' as ice FROM beko_documentocabecera inner join app_proveedor on beko_documentocabecera.proveeve_id=app_proveedor.provee_id where doccab_anulado=0 and doccab_nousar=0";

}

//echo $lista_doc;

$rs_data = $DB_gogess->executec($lista_doc,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	 
	 $array_iva=array();
	 $ivarete=0;
	 $nretencion='';
	 
	 //$busca_retencion="select * from ventas_retencion_detalle inner join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id where compretcab_anulado=0 and compretcab_nfactura='".str_replace("-","",$rs_data->fields["compra_nfactura"])."' and impur_id=2 and compra_id='".$rs_data->fields["compra_id"]."'";
	 
	 $doccab_id=$rs_data->fields["doccab_id"];	 
	 $busca_retencion="select * from ventas_retencion_detalle  where impur_id=2 and compra_enlace='".$doccab_id."'";
	 
	 $doccab_retnumdoc=$rs_data->fields["doccab_retnumdoc"];
	 $doccab_retfechaemision=$rs_data->fields["doccab_retfechaemision"];
	 $doccab_retautorizacion=$rs_data->fields["doccab_retautorizacion"];
	 
	   $nretencion='';
			  $fechanretencion='';
			  $compretcab_clavedeaccesos='';

	 $rs_listaretencion = $DB_gogess->executec($busca_retencion,array());
	  if($rs_listaretencion)
      {
			  while (!$rs_listaretencion->EOF) {
			  
			  @$array_iva[$rs_listaretencion->fields["porcentaje_id"]]=$array_iva[$rs_listaretencion->fields["porcentaje_id"]]+$rs_listaretencion->fields["compretdet_valorretenido"];
			  $ivarete=$ivarete+$rs_listaretencion->fields["compretdet_valorretenido"];
			  
			  $nretencion=$doccab_retnumdoc;
			  $fechanretencion=$doccab_retfechaemision;
			  $compretcab_clavedeaccesos=$doccab_retautorizacion;
			  
			  $rs_listaretencion->MoveNext();	
			  }
	   }
	   
	 //  print_r($array_iva);
	 
//retencion 
 $array_renta=array();
 $ivaretett=0;
 $busca_retencion1="select * from comprobante_retencion_cab inner join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id where compretcab_anulado=0 and compretcab_nfactura='".str_replace("-","",$rs_data->fields["compra_nfactura"])."' and impur_id=1 and compra_id='".$rs_data->fields["compra_id"]."'";
 
 $busca_retencion1="select * from ventas_retencion_detalle  where impur_id=1 and compra_enlace='".$doccab_id."'";
	 $rs_listaretencion1 = $DB_gogess->executec($busca_retencion1,array());
	  if($rs_listaretencion1)
      {
			  while (!$rs_listaretencion1->EOF) {
			  
			  $nretencion=$doccab_retnumdoc;
			  $fechanretencion=$doccab_retfechaemision;
			  $compretcab_clavedeaccesos=$doccab_retautorizacion;
			  
			   @$array_renta[$rs_listaretencion1->fields["compretdet_porcentaje"]]["valor"]=$array_renta[$rs_listaretencion1->fields["compretdet_porcentaje"]]["valor"]+$rs_listaretencion1->fields["compretdet_valorretenido"];
			   @$array_renta[$rs_listaretencion1->fields["compretdet_porcentaje"]]["codigo"]=$rs_listaretencion1->fields["porcentaje_id"];		
			   $ivaretett=$ivaretett+$rs_listaretencion1->fields["compretdet_valorretenido"];
			  
			  $rs_listaretencion1->MoveNext();	
			  }
	   }
	
	if(count($array_renta)>0)
	{	
	  
	  //print_r(@$array_renta);
	 }
	
$tipocmp_codigo=$rs_data->fields["tipocmp_codigo"];

$signo=1;
if($tipocmp_codigo=='04')
{
 $signo=-1;
 }

$documento.='<tr>';
$documento.='<td  nowrap="nowrap">'.$rs_data->fields["doccab_fechaemision_cliente"].'</td>';
$documento.='<td  style=mso-number-format:"@" >'.$rs_data->fields["doccab_rucci_cliente"].'</td>';
$documento.='<td  style=mso-number-format:"@" ></td>';
$documento.='<td>'.$rs_data->fields["doccab_nombrerazon_cliente"].'</td>';
$documento.='<td>'.$rs_data->fields["doccab_adicional"].'</td>';
$documento.='<td nowrap="nowrap"  style=mso-number-format:"@" >'.$rs_data->fields["doccab_ndocumento"].'</td>';
$documento.='<td nowrap="nowrap"  style=mso-number-format:"@" >'.$rs_data->fields["doccab_nautorizacion"].'</td>';
$documento.='<td  style=mso-number-format:"@" ></td>';
$documento.='<td></td>';
$documento.='<td></td>';
$documento.='<td align="right" >'.($rs_data->fields["doccab_subtotaliva"]*$signo).'</td>';
@$total1=@$total1+ ($rs_data->fields["doccab_subtotaliva"]*$signo);
$documento.='<td align="right" >'.($rs_data->fields["doccab_subtotalsiniva"]*$signo).'</td>';	
@$total2=@$total2+ ($rs_data->fields["doccab_subtotalsiniva"]*$signo);

$documento.='<td align="right" ></td>';
@$total3=@$total3+ ($rs_data->fields["doccab_subtnoobjetoi"]*$signo);

$subtotal=0;
$subtotal=($rs_data->fields["doccab_subtotaliva"]*$signo)+($rs_data->fields["doccab_subtotalsiniva"]*$signo)+($rs_data->fields["doccab_subtnoobjetoi"]*$signo);

$documento.='<td align="right" >'.$subtotal.'</td>';
	@$total4=@$total4+ $subtotal;

$documento.='<td align="right" >'.($rs_data->fields["doccab_iva"]*$signo).'</td>';
	@$total5=@$total5+ ($rs_data->fields["doccab_iva"]*$signo);
	
$documento.='<td align="right" ></td>';
	@$total6=@$total6+ $rs_data->fields["ivagasto"];
	
$documento.='<td align="right" >'.$rs_data->fields["ice"].'</td>'; 
	@$total7=@$total7+ $rs_data->fields["ice"];
	
$documento.='<td align="right" >'.($rs_data->fields["doccab_total"]*$signo).'</td>'; 
	@$total8=@$total8+ ($rs_data->fields["doccab_total"]*$signo);
	
$documento.='<td align="right" >'.@$array_iva[9].'</td>'; 
	@$total9=@$total9+ @$array_iva[9];

$documento.='<td align="right" >'.@$array_iva[10].'</td>'; 
	@$total10=@$total10+ @$array_iva[10];

$documento.='<td align="right" >'.@$array_iva[1].'</td>'; 
	@$total11=@$total11+ @$array_iva[1];

$documento.='<td align="right" >'.@$array_iva[11].'</td>'; 
	@$total12=@$total12+ @$array_iva[11];
	
$documento.='<td align="right" >'.@$array_iva[2].'</td>';
	@$total13=@$total13+ @$array_iva[2];
	
$documento.='<td align="right" >'.@$array_iva[3].'</td>';
	@$total14=@$total14+ @$array_iva[3];

$documento.='<td align="right" >'.@$ivarete.'</td>'; 
	@$total15=@$total15+ @$ivarete;

$documento.='<td nowrap="nowrap">'.@$fechanretencion.'</td>';
$documento.='<td nowrap="nowrap"  style=mso-number-format:"@" >'.@$nretencion.'</td>';
$documento.='<td nowrap="nowrap"  style=mso-number-format:"@" >'.@$compretcab_clavedeaccesos.'</td>';


$documento.='<td align="right" >'.@$array_renta["1"]["valor"].'</td>';
	@$total16=@$total16+ @$array_renta["1"]["valor"];

$documento.='<td align="right" >'.@$array_renta["1"]["codigo"].'</td>';
	@$total17=@$total17+ @$array_renta["1"]["codigo"];

$documento.='<td align="right" >'.@$array_renta["1.75"]["valor"].'</td>';
	@$total18=@$total18+ @$array_renta["1.75"]["valor"];

$documento.='<td align="right" >'.@$array_renta["1.75"]["codigo"].'</td>'; 
	@$total19=@$total19+ @$array_renta["1.75"]["codigo"];

$documento.='<td align="right" >'.@$array_renta["2"]["valor"].'</td>';
	@$total20=@$total20+ @$array_renta["2"]["valor"];

$documento.='<td align="right" >'.@$array_renta["2"]["codigo"].'</td>';
	@$total21=@$total21+ @$array_renta["2"]["codigo"];

$documento.='<td align="right" >'.@$array_renta["2.75"]["valor"].'</td>';
	@$total22=@$total22+ @$array_renta["2.75"]["valor"];

$documento.='<td align="right" >'.@$array_renta["2.75"]["codigo"].'</td>';
	@$total23=@$total23+ @$array_renta["2.75"]["codigo"];

$documento.='<td align="right" >'.@$array_renta["8"]["valor"].'</td>';
	@$total24=@$total24 + @$array_renta["8"]["valor"];

$documento.='<td align="right" >'.@$array_renta["8"]["codigo"].'</td>';
	@$total25=@$total25 + @$array_renta["8"]["codigo"];

$documento.='<td align="right" >'.@$array_renta["10"]["valor"].'</td>';
	@$total26=@$total26 + @$array_renta["10"]["valor"];

$documento.='<td align="right" >'.@$array_renta["10"]["codigo"].'</td>';
	@$total27=@$total27 + @$array_renta["10"]["codigo"];

$documento.='<td align="right" >'.@$array_renta["0"]["valor"].'</td>';
	@$total28=@$total28 + @$array_renta["0"]["valor"];
	
$documento.='<td align="right" >'.@$array_renta["0"]["codigo"].'</td>';
	@$total29=@$total29 + @$array_renta["0"]["codigo"];

$documento.='<td align="right" >0</td>';
$documento.='<td align="right" ></td>';

$documento.='<td align="right" >'.$ivaretett.'</td>'; 
	@$ftotal=$ftotal+$ivaretett;

$tdost=0;
$tdost=$ivaretett+@$ivarete;
$documento.='<td align="right" >'.$tdost.'</td>';
	@$gtotlatotal=$gtotlatotal+($ivaretett+@$ivarete);
	
$documento.='</tr>';

	     $rs_data->MoveNext();	  
	  }
  }	   



$documento.='<tr>
    <td  nowrap="nowrap"></td>
    <td align="right" ></td>
    <td ></td>
	<td align="right" ></td>
    <td align="right" ></td>
    <td nowrap="nowrap"></td>
    <td nowrap="nowrap"></td>
    <td align="right" ></td>
    <td align="right" ></td>
    <td align="right" ></td>
    <td align="right" >'.@$total1.'</td>
    <td align="right" >'.@$total2.'</td>
    <td align="right" >'.@$total3.'</td>
    <td align="right" >'.@$total4.'</td>
    <td align="right" >'.@$total5.'</td>
    <td align="right" >'.@$total6.'</td>
    <td align="right" >'.@$total7.'</td>
    <td align="right" >'.@$total8.'</td>
    <td align="right" >'.@$total9.'</td>
    <td align="right" >'.@$total10.'</td>
    <td align="right" >'.@$total11.'</td>
    <td align="right" >'.@$total12.'</td>
    <td align="right" >'.@$total13.'</td>
    <td align="right" >'.@$total14.'</td>
    <td align="right" >'.@$total15.'</td>
    <td nowrap="nowrap"></td>
    <td nowrap="nowrap"></td>
    <td nowrap="nowrap"></td>
    <td align="right" >'.@$total16.'</td>
    <td align="right" ></td>
    <td align="right" >'.@$total18.'</td>
    <td align="right" ></td>
    <td align="right" >'.@$total20.'</td>
    <td align="right" ></td>
    <td align="right" >'.@$total22.'</td>
    <td align="right" ></td>
    <td align="right" >'.@$total24.'</td>
    <td align="right" ></td>
    <td align="right" >
	'.@$total26.'</td>
    <td align="right" ></td>
    <td align="right" >'.@$total28.'</td>
    <td align="right" ></td>
    <td align="right" >0</td>
    <td align="right" ></td>
    <td align="right" >'.$ftotal.'</td>
    <td align="right" >'.@$gtotlatotal.'</td>
  </tr>
</table>';

///programacion reporte


//area datos 
if($previsual==1)
{
echo str_replace(".",",",$documento); 
}
if($previsual==2)
{
echo utf8_decode(str_replace(".",",",$documento)); 
}


if($previsual==3)
{

$comprobantepdf='';
$comprobantepdf=$documento;  


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


$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('CERENI');
$pdf->SetTitle('CERENI');
$pdf->SetSubject('CERENI');
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
$pdf->SetFont('helvetica', '', 7);
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