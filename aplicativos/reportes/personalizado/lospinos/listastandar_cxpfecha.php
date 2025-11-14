<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
ini_set("session.cookie_lifetime",36000);
ini_set("session.gc_maxlifetime",36000);
session_start();
if($_SESSION['ces1313777_sessid_inicio'])
{

$nombre_mes2=array();
$nombre_mes2["01"]='ENERO';
$nombre_mes2["02"]='FEBRERO';
$nombre_mes2["03"]='MARZO';
$nombre_mes2["04"]='ABRIL';
$nombre_mes2["05"]='MAYO';
$nombre_mes2["06"]='JUNIO';
$nombre_mes2["07"]='JULIO';
$nombre_mes2["08"]='AGOSTO';
$nombre_mes2["09"]='SEPTIEMBRE';
$nombre_mes2["10"]='OCTUBRE';
$nombre_mes2["11"]='NOVIEMBRE';
$nombre_mes2["12"]='DICIEMBRE';
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
   $sql3=" compra_fecha>='".$fecha_i."' and compra_fecha<='".$fecha_f."' and ";
}  
else
{
  
  if($fecha_i!='' and $fecha_f=='')
  {  
    $sql3=" compra_fecha>='".$fecha_i."' and ";
  }
  else
  {
    if($fecha_i=='' and $fecha_f!='')
	{
	   $sql3=" compra_fecha<='".$fecha_f."' and ";  
    }
  }

}  

if($clie_institucionval)
  {
   $sql4=" clie_institucion like '%".$clie_institucionval."%' and ";
  }  

if($cliente_ruc)
{
$sql5=" proveevar_id = '".trim($cliente_ruc)."' and ";
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

 $subtotalnc=0;
 $subtotadelmes=0;
//echo $lista_servicios;
//$xmldata=53;

$cuenta_fac=0;
$documento.='<center>
Desde: '.$fecha_i.' Hasta: '.$fecha_f.'<br>
<br>';

///programacion reporte



$documento.='<table border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td></td>	
	<td>ID_COMPRA</td>
	<td>TIPO</td>
	<td>FECHA EMISION</td>
	<td>PERSONA</td>
	<td>DESCRIPCION</td>
	<td>DOCUMENTO</td>
	<td>NETO</td>
    <td>IMP</td>
    <td>TOTAL</td>
    <td>ANULADO</td>
	<td>RET</td>
	<td>NC</td>
	<td>PG</td>
	<td>SALDO</td>   
  </tr>';
  
if($concatena_sql)
{  
$lista_doc="SELECT compra_id,compra_fecha,provee_nombre,compra_nfactura,compra_descripcion,neto,compra_iva,compra_total,compra_anulado,totalret,saldo,sriretencion,tipdoc_nombre,proveevar_id,compra_autorizacion FROM dns_compras_vista  where ".$concatena_sql."  and compra_anulado=0 and saldo>0 and tipdoc_id!=9";
}
else
{
$lista_doc="SELECT compra_id,compra_fecha,provee_nombre,compra_nfactura,compra_descripcion,neto,compra_iva,compra_total,compra_anulado,totalret,saldo,sriretencion,tipdoc_nombre,proveevar_id,compra_autorizacion FROM dns_compras_vista  where compra_anulado=0 and tipdoc_id!=9 and saldo>0";

}

$suma_saldo=0;
//echo $lista_doc;
$contador_t=0;
$rs_data = $DB_gogess->executec($lista_doc,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	 
	 $array_iva=array();
	 $ivarete=0;
	 $nretencion='';
	 $compretcab_clavedeaccesos='';
	 
	

$contador_t++;


     $suman_nc=0;
     $busca_nc="select * from dns_compras where tipdoc_id in (9,10) and proveevar_id='".$rs_data->fields["proveevar_id"]."' and compra_nummodif='".$rs_data->fields["compra_nfactura"]."' and compra_autmodi='".$rs_data->fields["compra_autorizacion"]."' and compra_anulado=0";
	 
	 $rs_ncx = $DB_gogess->executec($busca_nc,array());
	 
	 if($rs_ncx)
	 {
	   while (!$rs_ncx->EOF) 
			{
	 
	       $suman_nc=$suman_nc+$rs_ncx->fields["compra_total"];
	       
		   $rs_ncx->MoveNext();
		   
		   }	   
	  }
	  
	  
	 $suman_pagos=0;
     $busca_pagos="select * from lpin_cobropagodetalle inner join lpin_cobropago on lpin_cobropagodetalle.crb_enlace=lpin_cobropago.crb_enlace where ttradet_id in (2) and compracp_id='".$rs_data->fields["compra_id"]."'";
	 
	 $rs_pagox = $DB_gogess->executec($busca_pagos,array());
	 
	 if($rs_pagox)
	 {
	   while (!$rs_pagox->EOF) 
			{
	 
	       $suman_pagos=$suman_pagos+$rs_pagox->fields["crpadet_valorapagar"];
	       
		   $rs_pagox->MoveNext();
		   
		   }	   
	  }
	  
	  
	  
  if($suman_nc==0)
  {
    $suman_nc='';
  } 

$documento.='<tr>';
$documento.='<td  nowrap="nowrap">'.$contador_t.'</td>';
$documento.='<td  nowrap="nowrap">'.$rs_data->fields["compra_id"].'</td>';
$documento.='<td  nowrap="nowrap">'.$rs_data->fields["tipdoc_nombre"].'</td>';
$documento.='<td  style=mso-number-format:"@" >'.$rs_data->fields["compra_fecha"].'</td>';
$documento.='<td  style=mso-number-format:"@" >'.$rs_data->fields["provee_nombre"].'</td>';
$documento.='<td  style=mso-number-format:"@" >'.$rs_data->fields["compra_descripcion"].'</td>';
$documento.='<td  style=mso-number-format:"@" >'.$rs_data->fields["compra_nfactura"].'</td>';
$documento.='<td   align="right"  >'.str_replace(".",",",$rs_data->fields["neto"]).'</td>';
$documento.='<td    align="right"  >'.str_replace(".",",",$rs_data->fields["compra_iva"]).'</td>';
$documento.='<td    align="right"  >'.str_replace(".",",",$rs_data->fields["compra_total"]).'</td>';
$documento.='<td  style=mso-number-format:"@" >'.$rs_data->fields["compra_anulado"].'</td>';
$documento.='<td    align="right" >'.str_replace(".",",",$rs_data->fields["totalret"]).'</td>';
$documento.='<td    align="right" >'.str_replace(".",",",$suman_nc).'</td>';
$documento.='<td   align="right" >'.str_replace(".",",",$suman_pagos).'</td>';
$documento.='<td   align="right" >'.str_replace(".",",",$rs_data->fields["saldo"]).'</td>';

$suma_saldo=$suma_saldo+$rs_data->fields["saldo"];
	
$documento.='</tr>';

	     $rs_data->MoveNext();	  
	  }
  }	   



$documento.='<tr>
    <td  nowrap="nowrap"></td>
	<td  nowrap="nowrap"></td>
    <td ></td>
	<td ></td>
	<td ></td>
	<td></td>
    <td ></td>
	<td ></td>
	<td ></td>
	<td></td>
    <td></td>
	<td></td>
    <td></td>
    <td nowrap="nowrap"></td>
    <td  align="right"  nowrap="nowrap">'.$suma_saldo.'</td>
  </tr>
</table>';

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