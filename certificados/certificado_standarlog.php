<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['ces1313777_sessid_inicio'])
{
$valor_busca=$_GET["id_gen"];
$cuadro_valor=array();
$director='../';
include_once("../cfg/clases.php");
include_once("../cfg/declaracion.php");
require_once('tcpdf_include.php');

$objformulario= new  ValidacionesFormulario();

$busca_empresaval="select * from app_empresa where emp_id='".$_SESSION['ces1313777_sessid_emp_id']."'";
$rs_empval = $DB_gogess->executec($busca_empresaval,array());
$emp_logo=$rs_empval->fields["emp_logo"];

$busca_certificado="select * from dns_certificadogenerado where certifg_id='".$valor_busca."'";
$rs_cert = $DB_gogess->executec($busca_certificado,array());

$lee_plantilla=$rs_cert->fields["certifg_texto"];

//obtiene centro
$obtienecentro="select * from app_usuario inner join dns_centrosalud on app_usuario.centro_id=dns_centrosalud.centro_id where app_usuario.usua_id='".$rs_cert->fields["usua_id"]."'";
$rs_obtcentro = $DB_gogess->executec($obtienecentro,array());

$direccion_centro='';
$direccion_centro=utf8_encode($rs_obtcentro->fields["centro_direccion"]);

$direccion_centro = preg_replace("/[\r\n|\n|\r]+/", " ",$direccion_centro);

$telefono_h3=utf8_encode("Teléfono: ".$rs_obtcentro->fields["centro_telefono"]);




// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    var $filtro_valor_h1;
	var $filtro_valor_h2;
	var $filtro_valor_h3;
	var $piepagina_h3;
	//Page header
    public function Header() {
        // Logo
        //$image_file = 'izq.png';
        //$this->Image($image_file, 13, 7,24, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		
		$image_file = '../archivo/'.$this->filtro_valor_h1;
        $this->Image($image_file, 80, 7, 60, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		
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
        $this->SetFont('helvetica', 'I',6);
		
		$this->Cell(0, 15, $this->piepagina_h3, 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->Ln(3);
		$this->Cell(0, 15, $this->telefono_h3, 0, false, 'C', 0, '', 0, false, 'M', 'M');
		
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
$pdf->SetAuthor('CL&Iacute,NICA DE ESPECIALIDADES DEL SUR');
$pdf->SetTitle('CL&Iacute,NICA DE ESPECIALIDADES DEL SUR');
$pdf->SetSubject('CL&Iacute,NICA DE ESPECIALIDADES DEL SUR');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->filtro_valor_h1=$emp_logo;
$pdf->filtro_valor_h2='';
$pdf->filtro_valor_h3='';
$pdf->piepagina_h3=$direccion_centro;
$pdf->telefono_h3=$telefono_h3;
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
$pdf->writeHTML(utf8_encode($lee_plantilla), true, false, false, false, '');

/*if($_GET["dhoja"]==1)
{
$pdf->AddPage();
$pdf->writeHTML(utf8_encode("<strong>V. RESPONSABLES </strong><div align='center'>".$responsables_cuadro."</div>"), true, false, false, false, '');
}*/


//echo $comprobantepdf="Holaa";
$nombre_pdf="reporteissfa_".$valor_busca.".pdf";
$pdf->Output($nombre_pdf, 'I');

}
?>