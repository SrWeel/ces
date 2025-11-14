<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8'); 
$tiempossss=4444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);

$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

for($i=0;$i<$numero;$i++){
///
	if ($tags[$i]=='ssr')
	{
	///
	     $nombrevarget='';
		if (preg_match('/^[a-z\d_=]{1,200}$/i', $valores[$i])) {
			//$$tags[$i]=$valores[$i];
			$nombrevarget=$tags[$i];
			$$nombrevarget=$valores[$i];
		}
		else
		{
			//$$tags[$i]=0;
			$nombrevarget=$tags[$i];
			$$nombrevarget=0;
	    }
	///
	}
///
}

if($_SESSION['ces1313777_sessid_inicio'])
{


$decodifica='';
$separa_campos=explode("|",$_GET["ssr"]);
$decodifica=base64_decode($separa_campos[0]);

$splitvar=explode("&",@$decodifica);
$nombreget='';

for($ivari=0;$ivari<count($splitvar);$ivari++)
{
  $sacadatav=explode("=",$splitvar[$ivari]);  
  $nombreget=$sacadatav[0];
  @$$nombreget=$sacadatav[1];
}

$clie_id=$pVar2;
$mnupan_id=$pVar3;
$atenc_id=$pVar4;
$valor_id=$separa_campos[1];

$director='../';
 include("../cfg/clases.php");
 include("../cfg/declaracion.php");
 require_once('tcpdf_include.php');
 
 if($table)
 {
 $lista_tbldata=array('gogess_sisfield','gogess_sistable');
 $contenido = file_get_contents(@$director."jason_files/tablas/".$table.".json");
 $gogess_sistable = json_decode($contenido, true);
 }
 
 $objformulario= new  ValidacionesFormulario();
 $objtableform= new templateform();
 
 //leer con json
 if($table)
 {
 $contenido = file_get_contents(@$director."jason_files/estructura/".$table.".json");
 $gogess_sisfield = json_decode($contenido, true);
 }
 //leer con json 
 

 if($table)
  {
  $objtableform->select_templateform(@$table,$DB_gogess);
  }

  $objformulario->sisfield_arr=$gogess_sisfield;
  $objformulario->sistable_arr=$gogess_sistable;
  $comillasimple="'";
  
  
//========================================================================
  
$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($mnupan_id));
$lista_atencion="select * from dns_atencion where atenc_id=?";
$rs_atencion = $DB_gogess->executec($lista_atencion,array($atenc_id));

$lista_tabla="select * from gogess_sistable,gogess_styletable where gogess_sistable.st_id=gogess_styletable.st_id and tab_id=".$rs_datosmenu->fields["tab_id"];
$rs_tabla = $DB_gogess->executec($lista_tabla,array());
//busca datos del paciente
$datos_cliente="select * from app_cliente where clie_id=".$clie_id;
$rs_dcliente = $DB_gogess->executec($datos_cliente,array());

$nombre_paciente=$rs_dcliente->fields["clie_nombre"];
$apellido_paciente=$rs_dcliente->fields["clie_apellido"];
$clie_genero=$rs_dcliente->fields["clie_genero"];
$hc=$rs_atencion->fields["atenc_hc"];

$table=$rs_tabla->fields["tab_name"];  
$campo_primariodata=$rs_tabla->fields["tab_campoprimario"]; 

//$busca_sihaydata="select * from ".$table." where  anam_id=?";
//$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array($valor_id));


	
/**/

//paginar
$numxpagina=11;
$busca_cuenta="select count(*) as total from ".$table." where  anam_id=?";
$rs_cuenta = $DB_gogess->executec($busca_cuenta,array($valor_id));
$npaginas=0;
$npaginas=$rs_cuenta->fields["total"]/$numxpagina;

$numero_er=explode(".",$npaginas);
$numero_entero=$numero_er[0];
if($numero_er[1]>0)
		{
		  $numtpg=$numero_er[0]+1;
		  $numero_entero=$numero_er[0]+1;
		}

$concatena_paginas='';	
//paginar
$incio_reg=0;
$fin_reg=10;
for($i=0;$i<$numero_entero;$i++)
{

   $url="plantillas/evoform002reversohospital.php";
   $lee_plantilla=$objvarios->leer_contenido_completo($url);   
  
   
  $lee_plantilla=str_replace("-nombre-",$nombre_paciente,$lee_plantilla);
  $lee_plantilla=str_replace("-apellido-",$apellido_paciente,$lee_plantilla);
  $lee_plantilla=str_replace("-sexo-",$clie_genero,$lee_plantilla);
  $lee_plantilla=str_replace("-hc-",$hc,$lee_plantilla);

   
   
   $cuenta_val=0;
   $rs_aevolucion="select * from ".$table." where  anam_id=? limit ".$incio_reg.",".$fin_reg;
   $rs_aevolucion = $DB_gogess->executec($rs_aevolucion,array($valor_id));
   
   if($rs_aevolucion)
	{
		while (!$rs_aevolucion->EOF) {
		
		
		  $nomb_medico=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido","where usua_id=",$rs_aevolucion->fields["usua_id"],$DB_gogess);
		  $usua_codigo=$objformulario->replace_cmb("app_usuario","usua_id,usua_codigo","where usua_id=",$rs_aevolucion->fields["usua_id"],$DB_gogess);
		  $usua_codigoiniciales=$objformulario->replace_cmb("app_usuario","usua_id,usua_codigoiniciales","where usua_id=",$rs_aevolucion->fields["usua_id"],$DB_gogess);		  	 
		  
		 	  
		  $lista_prescrip='<table width="100%" border="0" cellpadding="0" cellspacing="0">';
		  if($rs_aevolucion->fields["conext_prescripciones"])
		  {
		  $lista_prescrip.='<tr><td class="supinfelinea" width="70%" >'.$rs_aevolucion->fields["conext_prescripciones"].'</td><td class="supinfelinea" style="font-size:9px" width="30%"></td></tr>';
		  }
		  
		  $busca_notasevolista="select * from cesdb_arextension.dns_hospitalgridprescripcion where conext_enlace='".$rs_aevolucion->fields["conext_enlace"]."'"; 
		  $rs_notasevolista = $DB_gogess->executec($busca_notasevolista,array());
		  if($rs_notasevolista)
	      {
			while (!$rs_notasevolista->EOF) {
			
			  $usua_prescr=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido","where usua_id=",$rs_notasevolista->fields["usua_id"],$DB_gogess);
			//.$usua_prescr.'<br>'.$rs_notasevolista->fields["gridhpres_fecharegistro"]
			  $lista_prescrip.='<tr><td class="supinfelinea"  width="70%"  >'.$rs_notasevolista->fields["gridhpres_descripcion"].'</td><td class="supinfelinea" style="font-size:9px" width="30%" ></td></tr>';
			
			  $rs_notasevolista->MoveNext();
			}
		  }
		  $lista_prescrip.='</table>';
		  
		  $saca_hora=array();
		  $saca_hora=explode(":",$rs_aevolucion->fields["conext_horar"]);
		  
		  
		
		  $cuenta_val++;  
		  $lee_plantilla=str_replace("-fecha".$cuenta_val."-",$rs_aevolucion->fields["conext_fechar"],$lee_plantilla); 
		  $lee_plantilla=str_replace("-hora".$cuenta_val."-",$saca_hora[0].":".$saca_hora[1],$lee_plantilla);
		  $lee_plantilla=str_replace("-notas".$cuenta_val."-",str_replace("\n","<br>",$rs_aevolucion->fields["conext_notasdeevolucion"]),$lee_plantilla);
		  $lee_plantilla=str_replace("-farmaco".$cuenta_val."-",$lista_prescrip,$lee_plantilla);
		  $lee_plantilla=str_replace("-otros".$cuenta_val."-","",$lee_plantilla);
		  
		
		  $rs_aevolucion->MoveNext();
		}
	}
	
  for($z=1;$z<=11;$z++)
  {
          $lee_plantilla=str_replace("-fecha".$z."-","",$lee_plantilla); 
		  $lee_plantilla=str_replace("-hora".$z."-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-notas".$z."-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-farmaco".$z."-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-otros".$z."-","",$lee_plantilla);
  
  }
   
   $incio_reg=$fin_reg+1;
   $fin_reg=$fin_reg+$numxpagina;
   
   if($i==($numero_entero-1))
   {
   $salto_pagina='';
   }
   else
   {
  // $salto_pagina='<div style="page-break-after:always;"></div>';
   }
   $concatena_paginas.=$lee_plantilla.$salto_pagina;	
}


$comprobantepdf=$concatena_paginas;
  
$lee_plantilla=$comprobantepdf;



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


$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('CL&Iacute,NICA DE ESPECIALIDADES DEL SUR');
$pdf->SetTitle('CL&Iacute,NICA DE ESPECIALIDADES DEL SUR');
$pdf->SetSubject('CL&Iacute,NICA DE ESPECIALIDADES DEL SUR');
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
$pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
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

$pdf->writeHTML($lee_plantilla.$tbl_listarecetaf, true, false, false, false, '');

/*if($_GET["dhoja"]==1)
{
$pdf->AddPage();
$pdf->writeHTML(utf8_encode("<strong>V. RESPONSABLES </strong><div align='center'>".$responsables_cuadro."</div>"), true, false, false, false, '');
}*/

//echo $lee_plantilla;
//echo $comprobantepdf="Holaa";
$nombre_pdf="receta_".$valor_busca.".pdf";
$pdf->Output($nombre_pdf, 'I');



}

?>