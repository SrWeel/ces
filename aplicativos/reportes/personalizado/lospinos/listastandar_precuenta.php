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
$clie_id=@$_POST["clie_id"];

$precu_activo=@$_POST["precu_activo"];
$convepr_id=@$_POST["convepr_id"];
$categesp_id=@$_POST["categesp_id"];
$especipr_id=@$_POST["especipr_id"];
$precu_facturar=@$_POST["precu_facturar"];

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

$precu_activo=@$_GET["precu_activo"];
$convepr_id=@$_GET["convepr_id"];
$categesp_id=@$_GET["categesp_id"];
$especipr_id=@$_GET["especipr_id"];
$precu_facturar=@$_GET["precu_facturar"];

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
$sql8="";
$sql9="";

if($centro_id)
  {
  // $sql2=" app_cliente.centro_id=".$centro_id." and ";
  }


if($fecha_i!='' and $fecha_f!='')
{
   $sql3=" precu_fechainicio>='".$fecha_i."' and precu_fechainicio<='".$fecha_f."' and ";
}  
else
{
  
  if($fecha_i!='' and $fecha_f=='')
  {  
    $sql3=" precu_fechainicio>='".$fecha_i."' and ";
  }
  else
  {
    if($fecha_i=='' and $fecha_f!='')
	{
	   $sql3=" precu_fechainicio<='".$fecha_f."' and ";  
    }
  }

}  



if($clie_id)
  {
   $sql5=" app_cliente.clie_id = '".trim($clie_id)."' and ";
  } 

if($precu_activo)
  {
   $sql6=" precu_activo ='".$precu_activo."' and ";
  }   

if($convepr_id)
  {
   $sql7=" convepr_id ='".$convepr_id."' and ";
  } 
  
if($categesp_id)
  {
   $sql8=" categesp_id ='".$categesp_id."' and ";
  } 

if($especipr_id)
  {
   $sql9=" especipr_id ='".$especipr_id."' and ";
  }    

if($precu_facturar)
  {
   $sql10=" precu_facturar ='".$precu_facturar."' and ";
  } 


        

$concatena_sql=$sql1.$sql2.$sql3.$sql4.$sql5.$sql6.$sql7.$sql8.$sql9.$sql10;
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
//	<td>Productos Descargados</td>


$documento.='<table border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td></td>	
	<td>ID_PRECUENTA</td>
	<td>CI</td>
	<td>Cliente</td>
	<td>Observaciones</td>
	<td>Fecha Inicio</td>
	<td>Fecha Cierre</td>
	<td>Estado</td>
	<td>Seguro</td>
	<td>Categoria</td>
	<td>Especialidad</td>
	<td>Factura</td>
	<td>Para Factura</td>
	<td>Usuario Registra</td>
	<td>Fecha Registro</td>
  </tr>';
  
if($concatena_sql)
{  
$lista_doc="SELECT doccab_id,doccab_ndocumento,doccab_rucci_cliente,doccab_nombrerazon_cliente,doccab_fechaemision_cliente,doccab_estadosri,doccab_anulado,doccab_motivoanulado,doccab_total,retencion,subtotal,doccab_iva,saldo,tipocmp_nombre FROM beko_documentocabecera_vista  where ".$concatena_sql."  and doccab_anulado!='ANULADO' and tipocmp_nombre='FACTURA'";

$lista_doc="select * from app_cliente inner join dns_atencion on app_cliente.clie_id=dns_atencion.clie_id inner join dns_precuenta on dns_atencion.atenc_enlace=dns_precuenta.atenc_enlace where ".$concatena_sql." order by precu_fechainicio asc";

}
else
{
$lista_doc="SELECT doccab_id,doccab_ndocumento,doccab_rucci_cliente,doccab_nombrerazon_cliente,doccab_fechaemision_cliente,doccab_estadosri,doccab_anulado,doccab_motivoanulado,doccab_total,retencion,subtotal,doccab_iva,saldo,tipocmp_nombre FROM beko_documentocabecera_vista  where compra_anulado!='ANULADO' and tipocmp_nombre='FACTURA'";

$lista_doc="select * from app_cliente inner join dns_atencion on app_cliente.clie_id=dns_atencion.clie_id inner join dns_precuenta on dns_atencion.atenc_enlace=dns_precuenta.atenc_enlace order by precu_fechainicio asc";

}

$arra_sumacateg=array();

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
	 

	$precu_activox='';
	$convepr_idx='';
	$categesp_idx='';
	$especipr_idx='';
	$clie_idx='';
	
	$precu_activox=$objformulario->replace_cmb("dns_estadoprecuenta","estap_id,estap_nombre"," where estap_id =",$rs_data->fields["precu_activo"],$DB_gogess);	
	$convepr_idx=$objformulario->replace_cmb("cesdb_arextension.dns_convenios","conve_id,conve_nombre"," where conve_id =",$rs_data->fields["convepr_id"],$DB_gogess);
	$categesp_idx=$objformulario->replace_cmb("dns_categoriaespecialidad","categesp_id,categesp_nombre"," where categesp_id =",$rs_data->fields["categesp_id"],$DB_gogess);
	
	$sparra_fecha=array();
	$sparra_fecha=explode("-",$rs_data->fields["precu_fechainicio"]);
	
	@$arra_sumacateg[$sparra_fecha[0]][$rs_data->fields["categesp_id"]]=$arra_sumacateg[$sparra_fecha[0]][$rs_data->fields["categesp_id"]]+1;
	
	$especipr_idx=$objformulario->replace_cmb("dns_especialidad","especi_id,especi_nombre"," where especi_id =",$rs_data->fields["especipr_id"],$DB_gogess);	
	$clie_idx=$objformulario->replace_cmb("app_cliente","clie_id,clie_apellido,clie_nombre"," where clie_id =",$rs_data->fields["clie_id"],$DB_gogess);
	

$contador_t++;

$busca_cantidad="select count(*) as total from dns_detalleprecuenta where precu_id='".$rs_data->fields["precu_id"]."'";
$rs_bcantidad = $DB_gogess->executec($busca_cantidad,array());

$total_reg=0;
$total_reg=$rs_bcantidad->fields["total"];

$bfactura_valor="select doccab_id from beko_documentodetalle_precuentafactu where precu_id='".$rs_data->fields["precu_id"]."'";

$n_facturav='';

$busca_facturasnum="select * from beko_documentocabecera where doccab_id in (".$bfactura_valor.")";
$rs_nfactu = $DB_gogess->executec($busca_facturasnum,array());
 if($rs_nfactu)
 {
	  while (!$rs_nfactu->EOF) {	
	  
	    $n_facturav=$rs_nfactu->fields["doccab_ndocumento"]."<br>";
	  
	   $rs_nfactu->MoveNext();
	  }
  }	  

$precu_facturar=$rs_data->fields["precu_facturar"];

$parafacturar='';
if($precu_facturar==1)
{
  $parafacturar='SI';
}

$busca_nusuario="";
$busca_nusuario=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido","where usua_id=",$rs_data->fields["usua_id"],$DB_gogess);

$documento.='<tr>';
$documento.='<td  nowrap="nowrap">'.$contador_t.'</td>';
$documento.='<td  style=mso-number-format:"@" >'.$rs_data->fields["precu_id"].'</td>';
$documento.='<td  style=mso-number-format:"@" >'.$rs_data->fields["clie_rucci"].'</td>';
$documento.='<td  style=mso-number-format:"@" >'.$clie_idx.'</td>';
$documento.='<td  style=mso-number-format:"@" >'.$rs_data->fields["precu_observacion"].'</td>';
$documento.='<td  style=mso-number-format:"@"  nowrap="nowrap" >'.$rs_data->fields["precu_fechainicio"].'</td>';
$documento.='<td  style=mso-number-format:"@"  nowrap="nowrap" >'.$rs_data->fields["precu_fechafinal"].'</td>';
$documento.='<td  nowrap="nowrap">'.$precu_activox.'</td>';
$documento.='<td  nowrap="nowrap">'.$convepr_idx.'</td>';
$documento.='<td  nowrap="nowrap">'.$categesp_idx.'</td>';
$documento.='<td  nowrap="nowrap">'.$especipr_idx.'</td>';	
//$documento.='<td  nowrap="nowrap">'.$total_reg.'</td>';	
$documento.='<td  nowrap="nowrap">'.$n_facturav.'</td>';	
$documento.='<td  nowrap="nowrap">'.$parafacturar.'</td>';
$documento.='<td  nowrap="nowrap">'.$busca_nusuario.'</td>';
$documento.='<td  nowrap="nowrap">'.$rs_data->fields["precu_fecharegistro"].'</td>';
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
	<td></td>
    <td></td>
	<td></td>	
	<td></td>
	<td></td>
	<td></td>
	<td></td>	
  </tr>
</table><br>';


$documento.='<table border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>A&Ntilde;O</td>
    <td>CATEGORIA</td>
    <td>CANTIDAD</td>
  </tr>';
for ($ival=2021;$ival<=2050;$ival++)
{

$busca_catgv="select * from dns_categoriaespecialidad order by categesp_nombre asc";
$rs_catvc = $DB_gogess->executec($busca_catgv,array());
 if($rs_catvc)
 {
	  while (!$rs_catvc->EOF) {	
	  $categesp_idxnombre='';
	  if(@$arra_sumacateg[$ival][$rs_catvc->fields["categesp_id"]])
	  {
		$categesp_idxnombre='';
		$categesp_idxnombre=$objformulario->replace_cmb("dns_categoriaespecialidad","categesp_id,categesp_nombre"," where categesp_id =",$rs_catvc->fields["categesp_id"],$DB_gogess);
		
		$documento.='<tr>
			<td>'.$ival.'</td>
			<td>'.$categesp_idxnombre.'</td>
			<td>'.@$arra_sumacateg[$ival][$rs_catvc->fields["categesp_id"]].'</td>
		  </tr>';
	  }	  
	  
	   $rs_catvc->MoveNext();	
	  }
  }	  


}

$documento.='</table>';





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