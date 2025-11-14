<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{

$valor_busca=$_GET["idsec"];

$cuadro_valor=array();
$director='../';
include_once("../cfg/clases.php");
include_once("../cfg/declaracion.php");
require_once('tcpdf_include.php');

$objformulario= new  ValidacionesFormulario();


$url="plantillas/informe_inventario.php";
$lee_plantilla=$objvarios->leer_contenido_completo($url);	

$logo='<div align="center"><img src="../images/informe_logo.jpg" width="161" height="70" /></div>';

$lee_plantilla=str_replace("-logo-",$logo,$lee_plantilla);

$nciudad='';
$nciudad=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id =",$_SESSION['ces1313777_centro_id'],$DB_gogess);


//datos personales


$fecha_ciudad=$nciudad.", ".$objvarios->fechaCastellano(date("Y-m-d"));
$lee_plantilla=str_replace("-fecha-",$fecha_ciudad,$lee_plantilla);

//lista centro
$contenido_valor='';
$lista_centro="select * from  dns_centrosalud ";
$rs_centro = $DB_gogess->executec($lista_centro,array());
if($rs_centro)
{
   while (!$rs_centro->EOF) {
  
 $contenido_valor.='<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><span class="css_titulo">'.$rs_centro->fields["centro_nombre"].'</span></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="2">
      <tr>
	    <td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">No</span></div></td>
        <td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">TIPO DE BIEN</span></div></td>
		<td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">MARCA</span></div></td>
		<td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">MODELO</span></div></td>
		<td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">SERIE</span></div></td>   
		<td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">MEDIDAS</span></div></td>      
		<td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">COLOR</span></div></td> 
        <td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">CARACTERISTICAS</span></div></td>
        <td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">OBSERVACION</span></div></td>
		<td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">UBICACION</span></div></td>
        <td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">CANTIDAD</span></div></td>
        <td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">VALOR UNITARIO </span></div></td>
        <td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">ESTADO</span></div></td>
        <td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">ASIGNADO A </span></div></td>
        </tr>';
		$il=0;
	  $lista_inv="select * from  dns_inventariopr left join dns_categoriapr on dns_inventariopr.categ_id = dns_categoriapr.categ_id left join faesa_estadoinv on dns_inventariopr.estinv_id = faesa_estadoinv.estinv_id inner join app_usuario on dns_inventariopr.usua_id=app_usuario.usua_id  where dns_inventariopr.centro_id=".$rs_centro->fields["centro_id"];
      $rs_inv = $DB_gogess->executec($lista_inv,array());
	  if ($rs_inv)
			   {
			      while (!$rs_inv->EOF) {
		$il++;		  
      $contenido_valor.='<tr>
       <td bgcolor="#F4F4F4"><span class="css_texto">'.$il.'</span></td>
        <td bgcolor="#F4F4F4"><span class="css_texto">'.$rs_inv->fields["categ_nombre"].'</span></td>
		<td bgcolor="#F4F4F4"><span class="css_texto">'.$rs_inv->fields["inven_marca"].'</span></td>
		<td bgcolor="#F4F4F4"><span class="css_texto">'.$rs_inv->fields["inven_modelo"].'</span></td>
		<td bgcolor="#F4F4F4"><span class="css_texto">'.$rs_inv->fields["inven_codigo"].'</span></td>
		<td bgcolor="#F4F4F4"><span class="css_texto">'.$rs_inv->fields["inven_medidas"].'</span></td>
		<td bgcolor="#F4F4F4"><span class="css_texto">'.$rs_inv->fields["inven_color"].'</span></td>
        <td bgcolor="#F4F4F4"><span class="css_texto">'.$rs_inv->fields["inven_descripcion"].'</span></td>
        <td bgcolor="#F4F4F4"><span class="css_texto">'.$rs_inv->fields["inven_observacion"].'</span></td>
		<td bgcolor="#F4F4F4"><span class="css_texto">'.$rs_inv->fields["inven_ubicacion"].'</span></td>
        <td bgcolor="#F4F4F4"><span class="css_texto">'.$rs_inv->fields["inven_cantidadalafecha"].'</span></td>
        <td bgcolor="#F4F4F4"><span class="css_texto">'.$rs_inv->fields["inven_valorunit"].'</span></td>
        <td bgcolor="#F4F4F4"><span class="css_texto">'.$rs_inv->fields["estinv_nombre"].'</span></td>
        <td bgcolor="#F4F4F4"><span class="css_texto">'.$rs_inv->fields["usua_nombre"].' '.$rs_inv->fields["usua_apellido"].'</span></td>
        </tr>';
		             $rs_inv->MoveNext();	
		             }
				}	 
					 
		
    $contenido_valor.='</table></td>
  </tr>
</table>';
	 
    $rs_centro->MoveNext();
	}
}


$lee_plantilla=str_replace("-inventario-",$contenido_valor,$lee_plantilla);

//datos de medicos

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
		$image_file = 'centro.png';
        $this->Image($image_file, 85, 10, 31, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 9);
        // Title
		$this->SetFont('helvetica', 'B', 9);
        // Title
		
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom	
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		
    }
}


$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('PichinchaHumana');
$pdf->SetTitle('PichinchaHumana');
$pdf->SetSubject('PichinchaHumana');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->filtro_valor_h1='';
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

echo utf8_encode($comprobantepdf);
//$pdf->writeHTML(utf8_encode($comprobantepdf), true, false, false, false, '');

//echo $comprobantepdf="Holaa";
$nombre_pdf="inventario_".$valor_busca.".pdf";
//$pdf->Output($nombre_pdf, 'I');



}
else
{
 echo '<div style="font-family:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000">Sesi&oacute;n de usuario ha terminado porfavor de clic en F5 para continuar...</div>';
 
 ?>
<script type="text/javascript">
<!--
    location.href = "../index.php";
 //  End -->
</script>
 <?php
}	

?>