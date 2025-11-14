<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{

header('Content-type: application/vnd.ms-excel');
$fechahoy=date("Y-m-d");
header("Content-Disposition: attachment; filename="."usuarios_".$fechahoy.".xls");

$valor_busca=$_GET["idsec"];

$cuadro_valor=array();
$director='../';
include_once("../cfg/clases.php");
include_once("../cfg/declaracion.php");
require_once('tcpdf_include.php');

$objformulario= new  ValidacionesFormulario();


$busca_datainfomer="select * from faesa_reporte where faereport_seccion='".$_GET["seccion"]."'";
$rs_datainfo = $DB_gogess->executec($busca_datainfomer,array());


$url="plantillas/".$rs_datainfo->fields["faereport_plantillas"];
$lee_plantilla=$objvarios->leer_contenido_completo($url);	

$logo='<div align="center"><img src="../images/informe_logo1.jpg" width="161" height="70" /></div>';
$logo='';
$lee_plantilla=str_replace("-logo-",$logo,$lee_plantilla);

//cabecera
$nciudad='';
$nciudad=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id =",$_SESSION['ces1313777_centro_id'],$DB_gogess);
$fecha_ciudad=$nciudad.", ".$objvarios->fechaCastellano(date("Y-m-d"));
$fecha_ciudad=date("Y-m-d");
$lee_plantilla=str_replace("-fecha-",$fecha_ciudad,$lee_plantilla);

$hora_ac=date("H:i:s");
$lee_plantilla=str_replace("-hora-",$hora_ac,$lee_plantilla);
//cabecera


//pepa data
$busca_ingresosdata="select * from ".$rs_datainfo->fields["faereport_tablaprincipall"]." where ".$rs_datainfo->fields["faereport_campoenlace"]."='".$valor_busca."'";
$rs_ingresodta = $DB_gogess->executec($busca_ingresosdata,array());

 if($rs_ingresodta)
 {
	  while (!$rs_ingresodta->EOF) {
	   
		$clie_id=$rs_ingresodta->fields["clie_id"];
		$usua_id=$rs_ingresodta->fields["usua_id"];
		
	    $rs_ingresodta->MoveNext();
	  }
  }
//pepa data

//datos personales
$busca_cliente="select * from app_cliente where clie_id=".$clie_id;
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


// reactivos


$valor_busca=$_GET["idsec"];




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


$datos_usuario="select * from app_usuario where usua_id='".$usua_id."'";
$rs_us = $DB_gogess->executec($datos_usuario,array());
$profesional=utf8_encode($rs_us->fields["usua_siglastitulo"]." ".$rs_us->fields["usua_nombre"]." ".$rs_us->fields["usua_apellido"]);
$codigop="CODIGO:".utf8_encode($rs_us->fields["usua_codigo"])." <br> FOLIO:".utf8_encode($rs_us->fields["usua_msp"]); 
$lee_plantilla=str_replace("-profesional-",$profesional,$lee_plantilla);
$lee_plantilla=str_replace("-codigo-",$codigop,$lee_plantilla);
//datos de medicos


//responsables

//LISTA USUARIOS 
$lista_usuarios='';
$lista_usuarios.='<style type="text/css">
<!--
.css_val5 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.css_val8 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style><table width="750" border="1" align="center" cellpadding="0" cellspacing="0">
<thead>
  <tr>
    <th bgcolor="#EAF1F4"><div align="center"><span class="css_val5">No.</span></div></th>
    <th bgcolor="#EAF1F4"><div align="center"><span class="css_val5">CEDULA</span></div></th>
    <th bgcolor="#EAF1F4"><div align="center"><span class="css_val5">NOMBRES</span></div></th>
	 <th bgcolor="#EAF1F4"><div align="center"><span class="css_val5">ETNIA</span></div></th>
	  <th bgcolor="#EAF1F4"><div align="center"><span class="css_val5">NACIONALIDAD</span></div></th>
	  <th bgcolor="#EAF1F4"><div align="center"><span class="css_val5">FECHA DE NACIMIENTO</span></div></th> 
	  <th bgcolor="#EAF1F4"><div align="center"><span class="css_val5">CELULAR</span></div></th> 
	  <th bgcolor="#EAF1F4"><div align="center"><span class="css_val5">ESTADO CIVIL</span></div></th> 
	 <th bgcolor="#EAF1F4"><div align="center"><span class="css_val5">GENERO</span></div></th>   
	 <th bgcolor="#EAF1F4"><div align="center"><span class="css_val5">EMAIL</span></div></th>  	
	 <th bgcolor="#EAF1F4"><div align="center"><span class="css_val5">CENTRO</span></div></th>  
	  <th bgcolor="#EAF1F4"><div align="center"><span class="css_val5">FECHA DE INGRESO</span></div></th>
	   <th bgcolor="#EAF1F4"><div align="center"><span class="css_val5">FECHA DE SALIDA</span></div></th>
	   <th bgcolor="#EAF1F4"><div align="center"><span class="css_val5">TIPO CONTRATO</span></div></th>
	  <th bgcolor="#EAF1F4"><div align="center"><span class="css_val5">HORAS CONTRATO</span></div></th>   
	 <th bgcolor="#EAF1F4"><div align="center"><span class="css_val5">TIPO HORARIO DE TRABAJO</span></div></th>  
	 <th bgcolor="#EAF1F4"><div align="center"><span class="css_val5">CODIGO</span></div></th>  
	<th bgcolor="#EAF1F4"><div align="center"><span class="css_val5">MSP</span></div></th> 
	<th bgcolor="#EAF1F4"><div align="center"><span class="css_val5">FORMACION PROFESIONAL</span></div></th>  
	<th bgcolor="#EAF1F4"><div align="center"><span class="css_val5">CARNET CONADIS</span></div></th>   
	<th bgcolor="#EAF1F4"><div align="center"><span class="css_val5">TIPO DISCAPACIDAD</span></div></th>  
	<th bgcolor="#EAF1F4"><div align="center"><span class="css_val5">% DISCAPACIDAD</span></div></th> 
	 <th bgcolor="#EAF1F4"><div align="center"><span class="css_val5">PERMISOS</span></div></th>
  </tr></thead>';
$numera=0;
$lista_ucampos="select * from app_usuario where usua_estado=1";
$rs_ucampos = $DB_gogess->executec($lista_ucampos,array());
			 if ($rs_ucampos)
			   {
			      while (!$rs_ucampos->EOF) {
				  $numera++;
			
				
				
		$tabla_permisos='';		
		$tabla_permisos.='<table width="400" border="1" cellpadding="2" cellspacing="2">
            <tr>
              <td bgcolor="#DFEEEA" style="font-size:11px"><div align="center"><strong>Opcion</strong></div></td>
              <td bgcolor="#DFEEEA" style="font-size:11px"><div align="center"><strong>Activo</strong></div></td>
            </tr>';
	
	 $listaitem="select * from gogess_menupanel where mnupan_activo=1  order by mnupan_id asc"; 	  
	 $resultadoitem = $DB_gogess->executec($listaitem,array());
	  if($resultadoitem)
	    {  

		   while (!$resultadoitem->EOF) {

		         $activochek='';
				 $makerchek='';
				 $checkerchek='';
				 $consultak='';
			 //datos perfil
			$listaperfil="select * from app_usuariosperfil where usua_id='".$rs_ucampos->fields["usua_id"]."' and per_codobj=".$resultadoitem->fields["mnupan_id"];
			$resultadolper = $DB_gogess->executec($listaperfil,array());	

			if($resultadolper)
			{  
			  while (!$resultadolper->EOF) {

                     $activochek='';
					  if($resultadolper->fields["per_activo"]=='1')
					  {
					  $activochek='checked="checked"';
					  }
					  else
					  {
					  $activochek='';
					  }
			  $resultadolper->MoveNext();
			  }
			 } 
			 
           if($activochek)
		   {
		   $tabla_permisos.='<tr>
              <td bgcolor="#F0F3F4" style="font-size:11px"><div align="center">'.$resultadoitem->fields["mnupan_nombre"].'</div></td>
              <td bgcolor="#F0F3F4" style="font-size:11px" ><div align="center">
                X
              </div></td>
		   </tr>';		   
		   }

		   $resultadoitem->MoveNext();
		   }

     	}

       $tabla_permisos.='</table>';	
				
				
				
				//saca perfiles	
					
					
				  $nombreetnia=$objformulario->replace_cmb("dns_etnia","etn_id,etn_nombre","where etn_id=",$rs_ucampos->fields["etn_id"],$DB_gogess);
				  $nombrenacionalidad=$objformulario->replace_cmb("cesdb_arcombos.dns_nacionalidad","nac_id,nac_nombre","where nac_id=",$rs_ucampos->fields["nac_id"],$DB_gogess);
				  
				  $nombrecivil=$objformulario->replace_cmb("cesdb_arcombos.app_estadocivil","civil_id,civil_nombre","where civil_id=",$rs_ucampos->fields["etn_id"],$DB_gogess);
				  
				  $nombrecentro=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre","where centro_id=",$rs_ucampos->fields["etn_id"],$DB_gogess);
				  
				  $nombretcontrato=$objformulario->replace_cmb("cesdb_arcombos.dns_tipocontrato","tipcont_id,tipcont_nombre","where tipcont_id=",$rs_ucampos->fields["tipcont_id"],$DB_gogess);
				  
				  $nombre_horario=$objformulario->replace_cmb("cesdb_arcombos.dns_tipohorario","tipoh_id,tipoh_nombre","where tipoh_id=",$rs_ucampos->fields["tipoh_id"],$DB_gogess);
				  
				  
					
$lista_usuarios.='<tr>
    <td><span class="css_val8">'.$numera.'</span></td>
    <td><span class="css_val8">'.$rs_ucampos->fields["usua_ciruc"].'</span></td>
    <td><span class="css_val8">'.$rs_ucampos->fields["usua_nombre"].' '.$rs_ucampos->fields["usua_apellido"].'</span></td>
	
	
	
	<td><span class="css_val8">'.$nombreetnia.'</span></td>
	<td><span class="css_val8">'.$nombrenacionalidad.'</span></td>
	<td><span class="css_val8">'.$rs_ucampos->fields["usua_fechanacimiento"].'</span></td>
	<td><span class="css_val8">'.$rs_ucampos->fields["usua_celular"].'</span></td>
	<td><span class="css_val8">'.$nombrecivil.'</span></td>
	<td><span class="css_val8">'.$rs_ucampos->fields["usua_genero"].'</span></td>
	<td><span class="css_val8">'.$rs_ucampos->fields["usua_email"].'</span></td>
	<td><span class="css_val8">'.$nombrecentro.'</span></td>
	<td><span class="css_val8">'.$rs_ucampos->fields["usua_fechaingrero"].'</span></td>
	<td><span class="css_val8">'.$rs_ucampos->fields["usua_fechasalida"].'</span></td>
	<td><span class="css_val8">'.$nombretcontrato.'</span></td>
	<td><span class="css_val8">'.$rs_ucampos->fields["usua_horascontrato"].'</span></td>
	<td><span class="css_val8">'.$nombre_horario.'</span></td>
	<td><span class="css_val8">'.$rs_ucampos->fields["usua_codigo"].'</span></td>
	<td><span class="css_val8">'.$rs_ucampos->fields["usua_msp"].'</span></td>
	<td><span class="css_val8">'.$rs_ucampos->fields["usua_formaciondelprofesional"].'</span></td>
	<td><span class="css_val8">'.$rs_ucampos->fields["usua_carnetconadis"].'</span></td>
	<td><span class="css_val8">'.$rs_ucampos->fields["usua_tipodiscapacidad"].'</span></td>
	<td><span class="css_val8">'.$rs_ucampos->fields["usua_porcentajediscapacidad"].'</span></td>
	<td><span class="css_val8">'.$tabla_permisos.'</span></td>
	
  </tr>';
					
				  
				   $rs_ucampos->MoveNext();	
				  }
			  }	  
			  
$lista_usuarios.='<tfoot>
<tr>
    <th bgcolor="#EAF1F4"></th>
    <th bgcolor="#EAF1F4"></th>
    <th bgcolor="#EAF1F4"></th>
    <th bgcolor="#EAF1F4"></th>
    <th bgcolor="#EAF1F4"></th>
    <th bgcolor="#EAF1F4"></th>
  </tr>
</tfoot>';		  

$lista_usuarios.='</table>';
//LISTA USUARIOS



$lee_plantilla=str_replace("-listados-",$lista_usuarios,$lee_plantilla);

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
		$this->Ln(3);
        $this->Cell(0, 15, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		
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
$pdf->SetMargins(PDF_MARGIN_LEFT, 50, PDF_MARGIN_RIGHT);
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
$pdf->SetFont('helvetica', '', 7);
$pdf->writeHTML(utf8_encode($comprobantepdf), true, false, false, false, '');

//echo $comprobantepdf;
$nombre_pdf=$rs_binforme->fields["atenc_hc"]."_".$valor_busca.".pdf";
//$pdf->Output($nombre_pdf, 'I');


echo utf8_encode($comprobantepdf);
}
else
{
echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; ">Tu sesi&oacute;n ha expirado</div>';
//enviar


}	

?>