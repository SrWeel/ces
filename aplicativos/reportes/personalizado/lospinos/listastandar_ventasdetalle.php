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
$clie_id=@$_POST["clie_id"];
$codigo_producto=$_POST["codigo_producto"];
$codigo_varios=$_POST["codigo_varios"];
$codigo_cuentas=$_POST["codigo_cuentas"];
$nombre_p=$_POST["nombre_p"];
}
else
{
$previsual=@$_GET["previsual"];
$fecha_i=@$_GET["fecha_inicio"];
$fecha_f=@$_GET["fecha_fin"];
$centro_id=@$_GET["centro_id"];
$clie_institucionval=@$_GET["clie_institucionval"];
$ireport=@$_GET["ireport"];
$clie_id=@$_GET["clie_id"];
$codigo_producto=$_GET["codigo_producto"];
$codigo_varios=$_GET["codigo_varios"];
$codigo_cuentas=$_GET["codigo_cuentas"];
$nombre_p=$_GET["nombre_p"];
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
$sql6="";
$sql7="";

if($centro_id)
  {
  // $sql2=" app_cliente.centro_id=".$centro_id." and ";
  }


if($fecha_i!='' and $fecha_f!='')
{
   $sql3=" 	doccab_fechaemision_cliente>='".$fecha_i."' and doccab_fechaemision_cliente<='".$fecha_f."' and ";
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

if($codigo_producto)
{
   $sql4=" 	docdet_codprincipal='".trim($codigo_producto)."' or ";
}  

if($codigo_varios)
{
   $sql5=" docdet_codprincipal='".trim($codigo_varios)."' or ";
}  

if($codigo_cuentas)
{
   $sql6=" docdet_codprincipal='".trim($codigo_cuentas)."' or ";
}  
      
///arma or
$sql_code="";
$concatena_sqlsub="";
$concatena_sqlsub=substr($sql4.$sql5.$sql6,0,-3);
if($concatena_sqlsub)
{
$sql_code=" (".$concatena_sqlsub.") and ";
}	  
	  
if($nombre_p)
{
  
     $sql7=" (docdet_descripcion like '%".$nombre_p."%' or  docdet_codprincipal like '%".$nombre_p."%') and ";

}     


	  

$concatena_sql=$sql1.$sql2.$sql3.$sql_code.$sql7;
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

$documento.='
EN FACTURAS
<table border="1" cellpadding="0" cellspacing="0">
  <tr>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center"> </div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">No. FACTURA</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">DESCRIPCI&Oacute;N</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">CODIGO</div></td>      
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">NOMBRE PRODUCTO</div></td>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">CANTIDAD</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">TOTAL $</div></td>	 	  
	  ';

$documento.='</tr>';
  
if($concatena_sql)
{  

$lista_doc="select 	docdet_codprincipal,docdet_descripcion,sum(docdet_cantidad) as cantidad,round(sum(docdet_total),2) as total,doccab_ndocumento,doccab_adicional from beko_documentocabecera inner join beko_documentodetalle_factur on beko_documentocabecera.doccab_id=beko_documentodetalle_factur.doccab_id  where doccab_anulado=0 and tipocmp_codigo='01' and ".$concatena_sql." group by doccab_ndocumento,docdet_codprincipal,docdet_descripcion order by doccab_ndocumento asc";

}

//echo $lista_doc;

$contador=0;
$suma_total_g=0;

$rs_data = $DB_gogess->executec($lista_doc,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	 
	 $array_iva=array();
	 $ivarete=0;
	 $nretencion='';
	 $boton_data='';
	 $contador++;
	 
	 $texto_wrap='';
	 $texto_wrap=wordwrap($rs_data->fields["docdet_descripcion"], 40, "<br />\n",true);	
	 
	 $texto_wrapt='';
	 $texto_wrapt=wordwrap($rs_data->fields["doccab_adicional"], 40, "<br />\n",true);	
	 
	 $documento.='<tr>';	 
	 $documento.='<td  nowrap="nowrap">'.$contador.'</td>';
	 $documento.='<td  nowrap="nowrap">'.$rs_data->fields["doccab_ndocumento"].'</td>';
	 $documento.='<td  nowrap="nowrap">'.$texto_wrapt.'</td>';	 
	 $documento.='<td  nowrap="nowrap">'.$rs_data->fields["docdet_codprincipal"].'</td>';
	 $documento.='<td  nowrap="nowrap">'.$texto_wrap.'</td>';
	 $documento.='<td  nowrap="nowrap" align="right" >'.$rs_data->fields["cantidad"].'</td>';
	 $documento.='<td  nowrap="nowrap" align="right" >'.str_replace(".",",",$rs_data->fields["total"]).'</td>';	 

	 
	 $documento.='</tr>';
	 
	 $suma_total_g=$suma_total_g+$rs_data->fields["total"];


	     $rs_data->MoveNext();	  
	  }
  }	   

$documento.='<tr>
    <td></td>
	<td></td>
    <td></td>
    <td></td>
	<td align="right" >'.str_replace(".",",",$suma_total_g).'</td>
';
$documento.='</tr>
</table>';



$documento.='
EN NOTAS DE CREDITO
<table border="1" cellpadding="0" cellspacing="0">
  <tr>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center"> </div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">No. FACTURA</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">DESCRIPCI&Oacute;N</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">CODIGO</div></td>      
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">NOMBRE PRODUCTO</div></td>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">CANTIDAD</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">TOTAL $</div></td>	 	  
	  ';

$documento.='</tr>';
  
if($concatena_sql)
{  

$lista_doc="select 	docdet_codprincipal,docdet_descripcion,sum(docdet_cantidad) as cantidad,round(sum(docdet_total),2) as total,doccab_ndocumento,doccab_adicional from beko_documentocabecera inner join beko_documentodetalle_factur on beko_documentocabecera.doccab_id=beko_documentodetalle_factur.doccab_id  where doccab_anulado=0 and tipocmp_codigo='04' and ".$concatena_sql." group by  doccab_ndocumento,docdet_codprincipal,docdet_descripcion order by docdet_codprincipal asc";

}

//echo $lista_doc;

$contador=0;
$suma_total_g=0;

$rs_data = $DB_gogess->executec($lista_doc,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	 
	 $array_iva=array();
	 $ivarete=0;
	 $nretencion='';
	 $boton_data='';
	 $contador++;
	 
	 $texto_wrap='';
	 $texto_wrap=wordwrap($rs_data->fields["docdet_descripcion"], 40, "<br />\n",true);	
	 
	 $texto_wrapt='';
	 $texto_wrapt=wordwrap($rs_data->fields["doccab_adicional"], 40, "<br />\n",true);	
	 
	 
	 $documento.='<tr>';	 
	 $documento.='<td  nowrap="nowrap">'.$contador.'</td>';
	  $documento.='<td  nowrap="nowrap">'.$rs_data->fields["doccab_ndocumento"].'</td>';
	 $documento.='<td  nowrap="nowrap">'.$texto_wrapt.'</td>';	
	 $documento.='<td  nowrap="nowrap">'.$rs_data->fields["docdet_codprincipal"].'</td>';
	 $documento.='<td  nowrap="nowrap">'.$texto_wrap.'</td>';
	 $documento.='<td  nowrap="nowrap" align="right" >'.$rs_data->fields["cantidad"].'</td>';
	 $documento.='<td  nowrap="nowrap" align="right" >'.str_replace(".",",",$rs_data->fields["total"]).'</td>';	 

	 
	 $documento.='</tr>';
	 
	 $suma_total_g=$suma_total_g+$rs_data->fields["total"];


	     $rs_data->MoveNext();	  
	  }
  }	   

$documento.='<tr>
    <td></td>
	<td></td>
    <td></td>
    <td></td>
	<td>'.$suma_total_g.'</td>
';
$documento.='</tr>
</table>';

if($previsual==1)
		{
			
$documento.="

<script type='text/javascript'>
<!--

function ver_asientoc(precu_id,detapre_id)
{
   
      myWindow3=window.open('../../../pdfasientos/pdfasientoprecuenta_i.php?xml=' + precu_id+'&detapre_id='+detapre_id,'ventana_asientocontable','width=850,height=700,scrollbars=YES');
      myWindow3.focus();
    
}	

//  End -->
</script>

";
    }

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