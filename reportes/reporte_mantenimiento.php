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


$url="plantillas/informe_mantenimiento.php";
$lee_plantilla=$objvarios->leer_contenido_completo($url);	

$logo='<div align="center"><img src="../images/informe_logo.jpg" width="161" height="70" /></div>';
$logo='';
$lee_plantilla=str_replace("-logo-",$logo,$lee_plantilla);

$nciudad='';
$nciudad=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id =",$_SESSION['ces1313777_centro_id'],$DB_gogess);


//datos personales


$fecha_ciudad=$nciudad.", ".$objvarios->fechaCastellano(date("Y-m-d"));
$lee_plantilla=str_replace("-fecha-",$fecha_ciudad,$lee_plantilla);

//lista centro
$contenido_valor='';
$lista_centro="select * from  dns_centrosalud where centro_id =".$_SESSION['ces1313777_centro_id'];
$rs_centro = $DB_gogess->executec($lista_centro,array());
if($rs_centro)
{
   while (!$rs_centro->EOF) {
  
 $contenido_valor.='<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><span class="css_titulo">'.$rs_centro->fields["centro_nombre"].'</span></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="4" cellspacing="0">
      ';
		$il=0;
	  $lista_inv="select * from  dns_inventariopr left join dns_categoriapr on dns_inventariopr.categ_id = dns_categoriapr.categ_id left join faesa_estadoinv on dns_inventariopr.estinv_id = faesa_estadoinv.estinv_id inner join app_usuario on dns_inventariopr.usua_id=app_usuario.usua_id  where dns_inventariopr.centro_id=".$rs_centro->fields["centro_id"]."";
      $rs_inv = $DB_gogess->executec($lista_inv,array());
	  if ($rs_inv)
			   {
			      while (!$rs_inv->EOF) {
				$il++; 
		$nresponsable=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id =",$rs_inv->fields["usua_id"],$DB_gogess);		
	  $contenido_valor.='<tr>
	    <td bgcolor="#F4F4F4"><span class="css_texto"><b>RESPONSABLE:</b></span></td>
        <td bgcolor="#F4F4F4"><span class="css_texto">'.$nresponsable.'</span></td>
		<td bgcolor="#F4F4F4"><span class="css_texto"><b>VIDA UTIL:&nbsp;&nbsp;</b></span></td>
		<td bgcolor="#F4F4F4"><span class="css_texto"><b>FECHA ADQUISICION:</b></span></td>
		<td bgcolor="#F4F4F4"><span class="css_texto">'.$rs_inv->fields["invenm_fechaadquisicion"].'</span></td>
        <td bgcolor="#F4F4F4"><span class="css_texto">&nbsp;</span></td>
		
        </tr>';		
				
		 $contenido_valor.='<tr>
	    <td bgcolor="#F4F4F4"><span class="css_texto"><b>AREA:</b></span></td>
        <td bgcolor="#F4F4F4"><span class="css_texto">'.$rs_inv->fields["invenm_area"].'</span></td>
		<td bgcolor="#F4F4F4"><span class="css_texto">&nbsp;&nbsp;</span></td>
		<td bgcolor="#F4F4F4"><span class="css_texto">&nbsp;&nbsp;</span></td>
		<td bgcolor="#F4F4F4"><span class="css_texto"><b>PROVEEDOR:</b></span></td>
        <td bgcolor="#F4F4F4"><span class="css_texto">'.$rs_inv->fields["invenm_proveedor"].'</span></td>
		
        </tr>';	
				 
	  $contenido_valor.='<tr>
	    <td bgcolor="#F4F4F4"><span class="css_texto"><b>NOMBRE EQUIPO</b></span></td>
        <td bgcolor="#F4F4F4"><span class="css_texto"><b>SERIE</b></span></td>
		<td bgcolor="#F4F4F4"><span class="css_texto"><b>FECHA MANTTO</b></span></td>
		<td bgcolor="#F4F4F4"><span class="css_texto"><b>PROXIMO MANTENIMIENTO</b></span></td>
		<td bgcolor="#F4F4F4"><span class="css_texto"><b>RESPONSABLE EXTERNO</b></span></td>
        <td bgcolor="#F4F4F4"><span class="css_texto"><b>ACTIVIDADES</b></span></td>
		
        </tr>';		
		
		
		$periodo=$objformulario->replace_cmb("faesa_periodomantenimiento","permant_id,permant_tiempo"," where permant_id =",$rs_inv->fields["permant_id"],$DB_gogess);
		
		$actual = strtotime($rs_inv->fields["invenm_fechamantenimiento"]);
        $fechapmant = date("Y-m-d", strtotime("+".$periodo." month", $actual));
		
      $contenido_valor.='<tr>
	    <td ><span class="css_texto">'.$rs_inv->fields["inven_descripcion"].'</span></td>
        <td ><span class="css_texto">'.$rs_inv->fields["inven_codigo"].'</span></td>
		<td ><span class="css_texto">'.$rs_inv->fields["invenm_fechamantenimiento"].'</span></td>
		<td ><span class="css_texto">'.$fechapmant.'</span></td>
		<td ><span class="css_texto"> &nbsp; </span></td>
        <td ><span class="css_texto"> &nbsp; </span></td>

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




$busca_cliente="select * from app_usuario inner join app_jobtitle on app_usuario.jobt_id=app_jobtitle.jobt_id where usua_id='".$_GET["ivalor"]."'";
        $cuantadata=0;
        $rs_bcliente = $DB_gogess->executec($busca_cliente,array());
		$nombre_persona='';
		if($rs_bcliente->fields["usua_nombre"])
		{
		$obtiene_nombres[$cuantadata]="<b>".$rs_bcliente->fields["usua_siglastitulo"]." ".$rs_bcliente->fields["usua_nombre"]." ".$rs_bcliente->fields["usua_apellido"]."</b><br>".$rs_bcliente->fields["jobt_name"]."<br>COD: ".$rs_bcliente->fields["usua_codigo"]."<br>MSP: ".$rs_bcliente->fields["usua_msp"]."<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
		
		$nombre_persona=$rs_bcliente->fields["usua_siglastitulo"]." ".$rs_bcliente->fields["usua_nombre"]." ".$rs_bcliente->fields["usua_apellido"];
		
		$cuantadata++;
		}


$responsables_cuadro='';
$responsables_cuadro=$objvarios->desplegarencuadrosv2($obtiene_nombres,0,15,0,1);


$lee_plantilla=str_replace("-datos-",$nombre_persona,$lee_plantilla);

$lee_plantilla=str_replace("-inventario-",$contenido_valor,$lee_plantilla);

$lee_plantilla=str_replace("-firma-",$responsables_cuadro,$lee_plantilla);
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
$pdf->SetAuthor('Faesa');
$pdf->SetTitle('Faesa');
$pdf->SetSubject('Faesa');
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

//echo utf8_encode($comprobantepdf);
$pdf->writeHTML(utf8_encode($comprobantepdf), true, false, false, false, '');

//echo $comprobantepdf="Holaa";
$nombre_pdf="inventario_".$valor_busca.".pdf";
$pdf->Output($nombre_pdf, 'I');



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