<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=144000;
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


$url="plantillas/informe_alta.php";
$lee_plantilla=$objvarios->leer_contenido_completo($url);	

$logo='<div align="center"><img src="../images/informe_logo.jpg" width="161" height="70" /></div>';
$logo='';
$lee_plantilla=str_replace("-logo-",$logo,$lee_plantilla);

$nciudad='';
$nciudad=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id =",$_SESSION['ces1313777_centro_id'],$DB_gogess);

//datos personales

$busca_informe="select * from dns_atencion where atenc_id='".$valor_busca."'";
$rs_binforme = $DB_gogess->executec($busca_informe,array());

//busca el ultimo evaluacion

$busca_informe="select * from dns_atencionevaluacion inner join dns_atencion on dns_atencionevaluacion.atenc_enlace=dns_atencion.atenc_enlace where dns_atencion.atenc_id='".$valor_busca."' order by eteneva_id desc limit 1";
$rs_binforme = $DB_gogess->executec($busca_informe,array());

if(!($rs_binforme->fields["clie_id"]))
{
  $busca_informe="select * from dns_atencion where atenc_id='".$valor_busca."'";
  $rs_binforme = $DB_gogess->executec($busca_informe,array());

}

//busca el ultimo evaluacion

$busca_cliente="select * from app_cliente where clie_id=".$rs_binforme->fields["clie_id"];
$rs_cliente = $DB_gogess->executec($busca_cliente,array());

$lista_campos="select * from gogess_sisfield where tab_name='app_cliente' and fie_guarda=1";
$rs_campos = $DB_gogess->executec($lista_campos,array());
			 if ($rs_campos)
			   {
			      while (!$rs_campos->EOF) {
				  
				    $lee_plantilla=str_replace("-".$rs_campos->fields["fie_name"]."-",$rs_cliente->fields[$rs_campos->fields["fie_name"]],$lee_plantilla);
				  
				   $rs_campos->MoveNext();	
				  }
			  }	  


$lee_plantilla=str_replace("-atenc_hc-",$rs_binforme->fields["atenc_hc"],$lee_plantilla);
//datos personales

//fecha y edad
$busca_fechaedad="select * from faesa_asigahorario where eteneva_id=".$valor_busca;
$rs_fechaedad = $DB_gogess->executec($busca_fechaedad,array());
$edad_texto='';
$edad_actualalatencion=array();
$edad_actualalatencion=$objvarios->calcular_edad($rs_cliente->fields["clie_fechanacimiento"],$rs_fechaedad->fields["asighor_fecha"]);
$edad_texto=$edad_actualalatencion["anio"]." a&ntilde;os ".$edad_actualalatencion["mes"]." meses";
$lee_plantilla=str_replace("-edad-",$edad_texto,$lee_plantilla);
$lee_plantilla=str_replace("-fechaevaluacion-",$rs_fechaedad->fields["asighor_fecha"],$lee_plantilla);
//fecha y edad

///concatena datos
$tomadatos_persona_ing='';
$infoalta_diagnostico='';
$infoalta_avance='';
$infoalta_concluciones='';
$infoalta_recomendaciones='';
$infoalta_rterapeuticas='';
$infoalta_rfamiliares='';
$infoalta_rescolares='';
$infoalta_rmultidiciplinarias='';


$busca_ingresosdata="select * from faesa_informealta where atenc_id='".$valor_busca."'";
$rs_ingresodta = $DB_gogess->executec($busca_ingresosdata,array());

 if($rs_ingresodta)
 {
	  while (!$rs_ingresodta->EOF) {
	  
	    
		$tomadatos_persona_ing.=$rs_ingresodta->fields["usua_id"].",";
		
		$infoalta_diagnostico.=$rs_ingresodta->fields["infoalta_diagnostico"];
		$infoalta_avance.=$rs_ingresodta->fields["infoalta_avance"];
		$infoalta_concluciones.=$rs_ingresodta->fields["infoalta_concluciones"];
		$infoalta_recomendaciones.=$rs_ingresodta->fields["infoalta_recomendaciones"];
		$infoalta_rterapeuticas.=$rs_ingresodta->fields["infoalta_rterapeuticas"];
		$infoalta_rfamiliares.=$rs_ingresodta->fields["infoalta_rfamiliares"];
		$infoalta_rescolares.=$rs_ingresodta->fields["infoalta_rescolares"];
		$infoalta_rmultidiciplinarias.=$rs_ingresodta->fields["infoalta_rmultidiciplinarias"];
		
		$infoalta_fechaalta=$rs_ingresodta->fields["infoalta_fechaalta"];
	  
	  $rs_ingresodta->MoveNext();
	  }
  }	  
///concatena datos

$fecha_ciudad=$nciudad.", ".$objvarios->fechaCastellano($infoalta_fechaalta);
$lee_plantilla=str_replace("-fecha-",$fecha_ciudad,$lee_plantilla);

//datos anemesis clinica

$busca_datosane="select * from faesa_anamnesisclinica where atenc_id=".$rs_binforme->fields["atenc_id"];
$rs_datosane = $DB_gogess->executec($busca_datosane,array());

$tomadatos_persona='';

if($rs_datosane)
{
$lee_plantilla=str_replace("-fuente-",$rs_datosane->fields["anamn_fuentededatos"],$lee_plantilla);

$tomadatos_persona=$rs_datosane->fields["usua_id"];
}
//datos anemesis clinica

//motivo de consulta
if(@$rs_datosane->fields["anamn_entrevistaclinica"])
{

$lee_plantilla=str_replace("-motivo-",$rs_datosane->fields["anamn_entrevistaclinica"],$lee_plantilla);
}
else
{
$lee_plantilla=str_replace("-motivo-",$rs_binforme->fields["atenc_observacion"],$lee_plantilla);
}

if($rs_binforme->fields["atenc_fechaingreso"]=='0000-00-00')
{
$lee_plantilla=str_replace("-fechaingreso-",$rs_cliente->fields["clie_fechaingreso"],$lee_plantilla);
}
else
{
$lee_plantilla=str_replace("-fechaingreso-",$rs_binforme->fields["atenc_fecharegistro"],$lee_plantilla);

}
//motivo de consulta

// reactivos
$busca_datainfomer="select * from faesa_reporte where faereport_seccion='".$_GET["seccion"]."'";
$rs_datainfo = $DB_gogess->executec($busca_datainfomer,array());

$lista_tbl=array();
if($rs_datainfo)
{
$lista_tbl=explode(",",$rs_datainfo->fields["faereport_tabla"]);
}


$valor_busca=$_GET["idsec"];
$contenido_informes='';


$datos_diagnosticos='';
$datos_terapeutica='';
$datos_recomfamiliares='';
$datos_recomescolares='';
$datos_recommultidiciplinarias='';
$usuario_lista='';

// reactivos

//diagnosticos
if($datos_diagnosticos)
{
$lee_plantilla=str_replace("-diagnostico-",$datos_diagnosticos,$lee_plantilla);
}
else
{
$lee_plantilla=str_replace("-diagnostico-",$infoalta_diagnostico,$lee_plantilla);

}


//recomendaciones
if($infoalta_recomendaciones)
{
$lee_plantilla=str_replace("-recomendaciones_alta-",utf8_decode($infoalta_recomendaciones),$lee_plantilla);
}
else
{
$lee_plantilla=str_replace("-recomendaciones_alta-","",$lee_plantilla);
}
//terapeutica
if($infoalta_rterapeuticas)
{
$titulo_tera="<b>Terap&eacute;uticas</b>".utf8_decode($infoalta_rterapeuticas);
$lee_plantilla=str_replace("-recomendacionest-",$titulo_tera,$lee_plantilla);
}
else
{
$lee_plantilla=str_replace("-recomendacionest-","",$lee_plantilla);
}
//terapeutica

//recomfamiliares
if($infoalta_rfamiliares)
{
$titulo_fam="<b>Familiares</b>".utf8_decode($infoalta_rfamiliares);
$lee_plantilla=str_replace("-familiares-",$titulo_fam,$lee_plantilla);
}
else
{
$lee_plantilla=str_replace("-familiares-","",$lee_plantilla);
}
//recomfamiliares
//recomescolares
if($infoalta_rescolares)
{
$titulo_esco="<b>Escolares</b>".utf8_decode($infoalta_rescolares);
$lee_plantilla=str_replace("-escolares-",$titulo_esco,$lee_plantilla);
}
else
{
$lee_plantilla=str_replace("-escolares-","",$lee_plantilla);
}
//recomescolares
// recommultidiciplinarias
if($infoalta_rmultidiciplinarias)
{
$titulo_multi="<b>Multidisciplinarias</b>".utf8_decode($infoalta_rmultidiciplinarias);
$lee_plantilla=str_replace("-multi-",$titulo_multi,$lee_plantilla);
}
else
{
$lee_plantilla=str_replace("-multi-","",$lee_plantilla);
}

$lee_plantilla=str_replace("-avances-",utf8_decode($infoalta_avance),$lee_plantilla);
$lee_plantilla=str_replace("-concluciones-",utf8_decode($infoalta_concluciones),$lee_plantilla);

$infoalta_avance='';
$infoalta_concluciones='';

$lista_medico=array();
$lista_medico=explode(",",$usuario_lista.$tomadatos_persona.",".$tomadatos_persona_ing);
$lista_medico = array_values(array_unique($lista_medico));


$obtiene_nombres=array();
$lista_medicos='';

$contador_lista=0;

for($id=0;$id<count($lista_medico);$id++)
{
        
		
		$busca_cliente="select * from app_usuario inner join app_jobtitle on app_usuario.jobt_id=app_jobtitle.jobt_id where usua_id='".$lista_medico[$id]."'";
        $rs_bcliente = $DB_gogess->executec($busca_cliente,array());
		if($rs_bcliente->fields["usua_codigo"])
		{
		$obtiene_nombres[$contador_lista]="<b>".$rs_bcliente->fields["usua_siglastitulo"]." ".$rs_bcliente->fields["usua_nombre"]." ".$rs_bcliente->fields["usua_apellido"]."</b><br>".$rs_bcliente->fields["jobt_name"]."<br>COD: ".$rs_bcliente->fields["usua_codigo"]."<br>MSP: ".$rs_bcliente->fields["usua_msp"]."";
		
		$lista_medicos.= $rs_bcliente->fields["usua_siglastitulo"]." ".$rs_bcliente->fields["usua_nombre"]." ".$rs_bcliente->fields["usua_apellido"].", ";
		$contador_lista++;
		}

}

//print_r($obtiene_nombres);
$responsables_cuadro='';
if(count($obtiene_nombres)>1)
{
$responsables_cuadro=$objvarios->desplegarencuadrosv2($obtiene_nombres,0,15,0,2);
}
else
{
$responsables_cuadro=$objvarios->desplegarencuadrosv2($obtiene_nombres,0,15,0,1);

}
// recommultidiciplinarias

//datos de medicos

$lee_plantilla=str_replace("-listatr-",$lista_medicos,$lee_plantilla);

//datos de medicos


//responsables
if($_GET["dhoja"]==0)
{
$datos_responsables='';
$datos_responsables=utf8_encode("<strong>VI. RESPONSABLES </strong><div align='center'>".$responsables_cuadro."</div>");
$lee_plantilla=str_replace("-responsables-",$datos_responsables,$lee_plantilla);
}
else
{
$datos_responsables='';
$lee_plantilla=str_replace("-responsables-",$datos_responsables,$lee_plantilla);
}



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
		
		$image_file = 'centro.png';
        $this->Image($image_file, 85, 10, 31, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		
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
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTML(utf8_encode($comprobantepdf), true, false, false, false, '');

if($_GET["dhoja"]==1)
{
$pdf->AddPage();
$pdf->writeHTML(utf8_encode("<strong>VI. RESPONSABLES </strong><div align='center'>".$responsables_cuadro."</div>"), true, false, false, false, '');
}

$nombre_pdf=$rs_binforme->fields["atenc_hc"]."_".$valor_busca.".pdf";
$pdf->Output($nombre_pdf, 'I');



}
else
{
echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; ">Tu sesi&oacute;n ha expirado</div>';
//enviar


}	

?>