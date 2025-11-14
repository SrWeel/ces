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
   $sql3=" 	date_format(detapre_fecharegistro,'%Y-%m-%d')>='".$fecha_i."' and 	date_format(detapre_fecharegistro,'%Y-%m-%d')<='".$fecha_f."' and ";
}  
else
{
  
  if($fecha_i!='' and $fecha_f=='')
  {  
    $sql3=" date_format(detapre_fecharegistro,'%Y-%m-%d')>='".$fecha_i."' and ";
  }
  else
  {
    if($fecha_i=='' and $fecha_f!='')
	{
	   $sql3=" date_format(detapre_fecharegistro,'%Y-%m-%d')<='".$fecha_f."' and ";  
    }
  }

}  

if($centro_id)
  {
   $sql4=" centrob_id = '".$centro_id."' and ";
  }  

if($clie_id)
{
$sql5=" dns_detalleprecuenta.clie_id = '".trim($clie_id)."' and ";
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
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center"> </div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Bodega </div></td>      
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Detalle</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Costo</div></td>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Cantidad</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Total</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Paciente</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Fecha Registro </div></td>';
if($previsual==1)
{
     $documento.='<td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Ver Asiento</div></td>';
}
$documento.='</tr>';
  
if($concatena_sql)
{  

$lista_doc="select * from dns_precuenta inner join dns_detalleprecuenta on dns_precuenta.precu_id=dns_detalleprecuenta.precu_id  left join dns_centrosalud_ext on dns_detalleprecuenta.centrob_id=dns_centrosalud_ext.centro_id  where ".$concatena_sql." and detapre_tipo in (1,2) and centrob_id not in (9999,8888,55)  order by detapre_id asc";

}


echo $lista_doc;

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
	 
	 $total_p=0;
	 $total_p=$rs_data->fields["detapre_precio"]*$rs_data->fields["detapre_cantidad"];
	 $contador++;
	 
	 $precu_id=$rs_data->fields["precu_id"];
	 $detapre_id=$rs_data->fields["detapre_id"];
	 
	 $busca_paciente="select * from app_cliente where clie_id='".$rs_data->fields["clie_id"]."'";
	 $rs_paciente = $DB_gogess->executec($busca_paciente,array());
	 
	 $documento.='<tr>';	 
	 $documento.='<td  nowrap="nowrap">'.$contador.'</td>';
	 $documento.='<td  nowrap="nowrap">'.$rs_data->fields["centro_nombre"].' '.$rs_data->fields["detapre_observacion"].'</td>';
	 $documento.='<td  nowrap="nowrap">'.$rs_data->fields["detapre_detalle"].'</td>';
	 $documento.='<td  nowrap="nowrap">'.$rs_data->fields["detapre_precio"].'</td>';
	 $documento.='<td  nowrap="nowrap">'.$rs_data->fields["detapre_cantidad"].'</td>';	 
	 $documento.='<td  nowrap="nowrap">'.$total_p.'</td>';
	 $documento.='<td  nowrap="nowrap">'.$rs_paciente->fields["clie_nombre"].' '.$rs_paciente->fields["clie_apellido"].'</td>';
	 $documento.='<td  nowrap="nowrap">'.$rs_data->fields["detapre_fecharegistro"].'</td>';
	 
	 if($previsual==1)
		{
		     $boton_data=" onclick=ver_asientoc('".$precu_id."','".$detapre_id."') ";
			 
			 $documento.='<td><div align="center"><input type="button" name="Submit" value="Ver Asiento"  '.$boton_data.' /></div></td>';
		}
	 
	 $documento.='</tr>';
	 
	 $suma_total_g=$suma_total_g+$total_p;


	     $rs_data->MoveNext();	  
	  }
  }	   

$documento.='<tr>
    <td></td>
	<td></td>
    <td></td>
    <td></td>
	<td></td>
    <td>'.$suma_total_g.'</td>
	<td></td>
	<td></td>';
	if($previsual==1)
		{
			 $documento.='<td></td>';
		}	
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