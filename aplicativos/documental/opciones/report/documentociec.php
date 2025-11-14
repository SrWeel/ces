<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['ces1313777_sessid_inicio'])
{
$valor_busca='';
$director='../../../../';
include_once("../../../../cfg/clases.php");
include_once("../../../../cfg/declaracion.php");
require_once('tcpdf_include.php');

$opcion='';
$centro_id=$_GET["centro_id"];
$mes_valor=$_GET["mes_valor"];
$anio_valor=$_GET["anio_valor"];
$prase_valor=$_GET["prase_valor"];
$opcion=@$_GET["opcion"];

$objformulario= new  ValidacionesFormulario();

$nivel_establ=0;
$nivel_establ=$objformulario->replace_cmb("dns_centrosalud","centro_id,permif_id"," where centro_id=",$centro_id,$DB_gogess); 

//lee planilla
$lee_plantilla=$objformulario->replace_cmb("dns_planillasplantillas","plapln_id,plapln_plantilla"," where plapln_id=",2,$DB_gogess); 
//lee planilla
$nombre_mes=array();
$nombre_mes["01"]='ENERO';
$nombre_mes["02"]='FEBRERO';
$nombre_mes["03"]='MARZO';
$nombre_mes["04"]='ABRIL';
$nombre_mes["05"]='MAYO';
$nombre_mes["06"]='JUNIO';
$nombre_mes["07"]='JULIO';
$nombre_mes["08"]='AGOSTO';
$nombre_mes["09"]='SEPTIEMBRE';
$nombre_mes["10"]='OCTUBRE';
$nombre_mes["11"]='NOVIEMBRE';
$nombre_mes["12"]='DICIEMBRE';
//calcula datos
$total_sumado=0;
//-------------------------------------------------------------------------------------------------
//codigo generico (TARIFARIO)
$codigo_seguro=2;

$arreglos_data=array();
$cuenta_d=0;
$union_data='';



//$union_data=$busca_paratarifar.' UNION '.$busca_recetas.' UNION '.$busca_dispositivo.' order by clie_apellido asc';


$tarifa_sql="select tabla, ttbl_id, tiposerv_id, atenc_fechaingreso, atenc_fechasalida, centro_numeroestablecimiento, centro_ruc, centro_nombre, tiposerv_nombre, atenc_condiciondeingreso, atenc_hc, sub_enlace, atenc_condiciondeegreso, clie_rucci, clie_nombre, clie_apellido, clie_fechanacimiento, clie_genero, clie_nombretitulardelseguro, clie_numerodecedulatitular, clie_paretesco, usua_ciruc, usua_nombre, usua_apellido, usua_formaciondelprofesional, nac_id, prod_famprod, cuabas_fecharegistro, prod_codigo, prod_descripcion, prod_precio, dns_especialidad, prod_cantidad, prod_techo, prod_iva, gestion_adm, valor_iva, clie_parentescopaciente, prod_clasificacionporcargo from cesdb_arreportes.planilla_tarifariodata where centro_id='".$_GET["centro_id"]."' and cuabas_fecharegistro like '".$_GET["anio_valor"]."-".$_GET["mes_valor"]."-%' and  prod_nivel=".$nivel_establ."  and tipopac_id='".$codigo_seguro."' UNION ";

$receta_sql="select  tabla, ttbl_id, tiposerv_id, atenc_fechaingreso, atenc_fechasalida, centro_numeroestablecimiento, centro_ruc, centro_nombre, tiposerv_nombre, atenc_condiciondeingreso, atenc_hc, sub_enlace, atenc_condiciondeegreso, clie_rucci, clie_nombre, clie_apellido, clie_fechanacimiento, clie_genero, clie_nombretitulardelseguro, clie_numerodecedulatitular, clie_paretesco, usua_ciruc, usua_nombre, usua_apellido, usua_formaciondelprofesional, nac_id, prod_famprod, cuabas_fecharegistro, prod_codigo, prod_descripcion, prod_precio, dns_especialidad, prod_cantidad, prod_techo, prod_iva, gestion_adm, valor_iva, clie_parentescopaciente, prod_clasificacionporcargo from cesdb_arreportes.planilla_recetadata where centro_id='".$_GET["centro_id"]."' and cuabas_fecharegistro like '".$_GET["anio_valor"]."-".$_GET["mes_valor"]."-%'  and tipopac_id='".$codigo_seguro."' UNION ";

$insumos_sql="select tabla, ttbl_id, tiposerv_id, atenc_fechaingreso, atenc_fechasalida, centro_numeroestablecimiento, centro_ruc, centro_nombre, tiposerv_nombre, atenc_condiciondeingreso, atenc_hc, sub_enlace, atenc_condiciondeegreso, clie_rucci, clie_nombre, clie_apellido, clie_fechanacimiento, clie_genero, clie_nombretitulardelseguro, clie_numerodecedulatitular, clie_paretesco, usua_ciruc, usua_nombre, usua_apellido, usua_formaciondelprofesional, nac_id, prod_famprod, cuabas_fecharegistro, prod_codigo, prod_descripcion, prod_precio, dns_especialidad, prod_cantidad, prod_techo, prod_iva, gestion_adm, valor_iva, clie_parentescopaciente, prod_clasificacionporcargo from cesdb_arreportes.planilla_insumodata where centro_id='".$_GET["centro_id"]."' and cuabas_fecharegistro like '".$_GET["anio_valor"]."-".$_GET["mes_valor"]."-%' and tipopac_id='".$codigo_seguro."' UNION ";


 $union_data=$tarifa_sql.$receta_sql.$insumos_sql;


$union_data=substr($union_data,0,-6).' order by clie_apellido asc';

$cuenta_totales="select count(clie_rucci) as total from  (select distinct clie_rucci from (".$union_data.") as t1) as total";
$rs_tbltotales = $DB_gogess->executec($cuenta_totales,array());

$cuenta_val=array();
$numera=0;
$numeracion_exp=0;

$rs_btarifario = $DB_gogess->executec($union_data,array());

if($rs_btarifario)
	{
		while (!$rs_btarifario->EOF) {
	
		
		$saca_datasep=array();
		$saca_datasep=explode("-",$rs_btarifario->fields["cuabas_fecharegistro"]);
		$mesanio=$saca_datasep[0]."-".$saca_datasep[1];
		
		$numera++;
		$cuenta_val[$numera]=$rs_btarifario->fields["clie_rucci"];
		if($cuenta_val[$numera]!=$cuenta_val[$numera-1])
		{
		$numeracion_exp++;
		}
		
		$separa_datafecha=array();
		$separa_datafecha=explode(" ",$rs_btarifario->fields["atenc_fechaingreso"]);
		$separa_datafechaF=array();
		$separa_datafechaF=explode(" ",$rs_btarifario->fields["atenc_fechasalida"]);

	

		 
	
	
	$valor_sumado=0;
	$valor_sumado=number_format($rs_btarifario->fields["prod_precio"], 3, '.', '')*$rs_btarifario->fields["prod_cantidad"];
	$total_sumado=$total_sumado+number_format($valor_sumado, 2, '.', '');
					
						
			$rs_btarifario->MoveNext();			
		}
	}	



//---------------------------------------------------------------------
 



//calcula datos

$cabecera_plailla='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Planilla Isspol</title>
</head>
<body>
<style type="text/css">
<!--
.titulo_suscripcion {font-size: 13px; font-family: Arial, Verdana; font-weight: bold; }
.css_titulo{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
}
.css_texto{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;

}
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>';


$pie_planilla='</body>
</html>
';

$lee_plantilla=$cabecera_plailla.$lee_plantilla.$pie_planilla;

$centro_id=$_GET["centro_id"];
$numero_mes=$_GET["mes_valor"];
$anio_valor=$_GET["anio_valor"];
$nombremes=$nombre_mes[$_GET["mes_valor"]];
$nombre_establ=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$centro_id,$DB_gogess);

$nombre_jefe=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombrejefe"," where centro_id=",$centro_id,$DB_gogess);
$nombre_cargo=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_cargo"," where centro_id=",$centro_id,$DB_gogess);

$nciudad='';
$code_ciudad='';
$code_ciudad=$objformulario->replace_cmb("dns_centrosalud","centro_id,cant_codigo"," where centro_id =",$_SESSION['ces1313777_centro_id'],$DB_gogess);
$nciudad=$objformulario->replace_cmb("app_canton","cant_codigo,cant_nombre"," where cant_codigo like ",$code_ciudad,$DB_gogess);

$fecha_ciudad=$nciudad.", ".$objvarios->fechaCastellano(date("Y-m-d"));


$lee_plantilla=str_replace("-fecha-",$fecha_ciudad,$lee_plantilla);
//reemplaza datos
$codigo_val='';
$codigo_val=$numero_mes."-".$nombremes."-".str_replace("ESTABLECIMIENTO DE ","",$nombre_establ)."-".$anio_valor; 


$lee_plantilla=str_replace("-oficio-",$codigo_val,$lee_plantilla);
$lee_plantilla=str_replace("-centro-",$nombre_establ,$lee_plantilla);
$lee_plantilla=str_replace("-ciudad-",$nciudad,$lee_plantilla);
$lee_plantilla=str_replace("-dr-",utf8_decode($nombre_jefe),$lee_plantilla);
$lee_plantilla=str_replace("-crg-",utf8_decode($nombre_cargo),$lee_plantilla);

$lee_plantilla=str_replace("-durante-",$nombremes."-".$anio_valor,$lee_plantilla);



$corresponde_al="mes de ".$nombre_mes[$saca_datasep[1]]." del ".$saca_datasep[0];
$lee_plantilla=str_replace("-corresponde-",$corresponde_al,$lee_plantilla);

$lee_plantilla=str_replace("-totalsumado-",$total_sumado,$lee_plantilla);
$lee_plantilla=str_replace("-expediente-",$rs_tbltotales->fields["total"],$lee_plantilla);

$obj_convert=new NumerosEnLetras();
$en_texto=$obj_convert->convertir($total_sumado, $currency = '', $format = true);

$lee_plantilla=str_replace("-entexto-",$en_texto,$lee_plantilla);
$lee_plantilla=str_replace("ISSPOL"," IESS ",$lee_plantilla);


$imagenencabezado="select * from app_empresa where emp_id='".$_SESSION['ces1313777_sessid_emp_id']."'";
$rs_imagen = $DB_gogess->executec($imagenencabezado,array());
$imagen_reporte="../../../../archivo/".$rs_imagen->fields["emp_logo"];
//$imagen_reporte="centro.png";
//reemplaza datos


$comprobantepdf='';
$comprobantepdf=$lee_plantilla;



// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    var $filtro_valor_h1;
	var $filtro_valor_h2;
	var $filtro_valor_h3;
	//Page header
    public function Header() {
        // Logo
        //$image_file = 'logoizq.fw.png';
        //$this->Image($image_file, 13, 10, 23, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		
		$image_file =$this->filtro_valor_h1;
		
       $this->Image($image_file, 85, 10, 31, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		
		
		
     //   
	//	$this->Image($rs_imagen, 85, 10, 31, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		
        	
        // Set font
        $this->SetFont('helvetica', 'B', 9);
        // Title
		//$this->Ln(3);
        //$this->Cell(0, 15, $this->filtro_valor_h1, 0, false, 'C', 0, '', 0, false, 'M', 'M');
		
		$this->SetFont('helvetica', 'B', 9);
        // Title
		//$this->Ln(4);
        //$this->Cell(0, 15, $this->filtro_valor_h2, 0, false, 'C', 0, '', 0, false, 'M', 'M');
		//$this->Ln(4);
        //$this->Cell(0, 15, $this->filtro_valor_h3, 0, false, 'C', 0, '', 0, false, 'M', 'M');
		
    }

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


$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('DNS');
$pdf->SetTitle('DNS');
$pdf->SetSubject('DNS');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->filtro_valor_h1=$imagen_reporte;
$pdf->filtro_valor_h2='';
$pdf->filtro_valor_h3='';
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
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
$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage();

//$pdf->Write(0, 'HANOR', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

//echo utf8_encode($comprobantepdf);
$pdf->writeHTML(utf8_encode($comprobantepdf), true, false, false, false, '');

/*if($_GET["dhoja"]==1)
{
$pdf->AddPage();
$pdf->writeHTML(utf8_encode("<strong>V. RESPONSABLES </strong><div align='center'>".$responsables_cuadro."</div>"), true, false, false, false, '');
}*/


//echo $comprobantepdf="Holaa";
$nombre_pdf="documento_".$valor_busca.".pdf";
$pdf->Output($nombre_pdf, 'I');




}

?>