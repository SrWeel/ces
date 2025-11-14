<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['ces1313777_sessid_inicio'])
{
$valor_busca=$_GET["fecha"];
$cuadro_valor=array();
$director='../';
include_once("../cfg/clases.php");
include_once("../cfg/declaracion.php");
require_once('tcpdf_include.php');

$objformulario= new  ValidacionesFormulario();

//plantilla receta
$busca_receta="select * from dns_formatoreceta where forrect_id=1";
$rs_receta = $DB_gogess->executec($busca_receta,array());

$lee_plantilla=$rs_receta->fields["forrect_texto"];

$lee_plantilla.='<style type="text/css">
<!--
.css_receta {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.css_receta_txt {
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>';

$lee_grafico1='<img src="/ces/archivo/'.$rs_receta->fields["forrect_grafico1"].'" />';
$lee_grafico2='<img src="/ces/archivo/'.$rs_receta->fields["forrect_grafico2"].'" />';
$lee_grafico3='<img src="/ces/archivo/'.$rs_receta->fields["forrect_grafico3"].'" />';
$lee_grafico4='<img src="/ces/archivo/'.$rs_receta->fields["forrect_grafico4"].'" />';

$lee_plantilla=str_replace("-grafico1-",$lee_grafico1,$lee_plantilla);
$lee_plantilla=str_replace("-grafico2-",$lee_grafico2,$lee_plantilla);
$lee_plantilla=str_replace("-grafico3-",$lee_grafico3,$lee_plantilla);
$lee_plantilla=str_replace("-grafico4-",$lee_grafico4,$lee_plantilla);
//plantilla receta
//datos generales

$ncentro='';
$ncentro=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id =",$_SESSION['ces1313777_centro_id'],$DB_gogess);

$lee_plantilla=str_replace("-centro-",$ncentro,$lee_plantilla);
$lee_plantilla=str_replace("-fecha-",$_GET["fecha"],$lee_plantilla);



//=========================   
$logo = $objformulario->replace_cmb("app_empresa", "emp_id,emp_logoreporte", "where emp_id=", 1, $DB_gogess);
$logoc ='<img src="../archivo/'.$logo.'" alt="125x125" width="140px">';

$emp_nombre = $objformulario->replace_cmb("app_empresa", "emp_id,emp_nombre", "where emp_id=", 1, $DB_gogess);
$razonso = $objformulario->replace_cmb("app_empresa", "emp_id,emp_razonsocial", "where emp_id=", 1, $DB_gogess);
$emp_piedepagina = $objformulario->replace_cmb("app_empresa", "emp_id,emp_direccion", "where emp_id=", 1, $DB_gogess);
$emp_logo = $objformulario->replace_cmb("app_empresa", "emp_id,emp_logo", "where emp_id=", 1, $DB_gogess);
  
  $emp_telefono = $objformulario->replace_cmb("app_empresa", "emp_id,emp_telefono", "where emp_id=", 1, $DB_gogess);
  
  //cabecera y pie de pagina
$lee_plantilla = str_replace("-logo-", $logoc, $lee_plantilla);
$lee_plantilla = str_replace("-razons-", $razonso, $lee_plantilla);
$lee_plantilla = str_replace("-direccionemp-", $emp_piedepagina, $lee_plantilla);
$lee_plantilla = str_replace("-logofondo-", $emp_logo, $lee_plantilla);

$lee_plantilla = str_replace("-cel-", $emp_telefono , $lee_plantilla);

  //=========================


//datos generales



$quitar_t='Precio Techo,Precio Techo menos 6.5%,';
$quitar_lista='plantra_preciotecho,plantra_preciotechosinporcentaje,';

$quitar_t2=',Indicaciones';
$quitar_lista2=',plantra_indicaciones';


$datos_fields="select * from gogess_sisfield where fie_id=".$_GET["fieid"];
$rs_fields = $DB_gogess->executec($datos_fields,array());

$tabla_principal=$rs_fields->fields["fie_tabledb"];

//busca_idtblrincipal
$id_tblp=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_campoprimario"," where tab_name like",$tabla_principal,$DB_gogess);
$lista_idtblprincipal="select ".$id_tblp." from ".$tabla_principal." where ".$rs_fields->fields["fie_campoenlacesub"]."='".$_GET['enlace']."'";
$rs_idnum = $DB_gogess->executec($lista_idtblprincipal,array());

$codigogen=str_replace("-","",$_GET["fecha"])."_".$rs_idnum->fields["$id_tblp"];
$lee_plantilla=str_replace("-codigo-",$codigogen,$lee_plantilla);

//tabla_grid
$sub_tabla=$rs_fields->fields["fie_tablasubgrid"];
//id tabla grid
$campo_id=$rs_fields->fields["fie_tablasubcampoid"];
//campos tabla grid
$campos_dataedit=array();
$campos_dataedit=explode(",",$rs_fields->fields["fie_tablasubgridcampos"]);

$campos_datainserta=array();
$campos_datainserta=explode(",",$rs_fields->fields["fie_tablasubgridcampos"]);
//tabla combo
$tabla_combo=$rs_fields->fields["fie_tblcombogrid"];
$idtabla_combo=$rs_fields->fields["fie_campoidcombogrid"];
//subtablas
//campo enlace
$campo_enlace='';
$campo_enlace=$rs_fields->fields["fie_campoenlacesub"];
//fecha registro grid
$campo_fecharegistro='';
$campo_fecharegistro=$rs_fields->fields["fie_campofecharegistro"];

//titulos
$titulos_quitado='';
$titulos_quitado=str_replace($quitar_t,"",$rs_fields->fields["fie_tituloscamposgrid"]);
$titulos_quitado=str_replace($quitar_t2,"",$titulos_quitado);

$fie_tituloscamposgrid=array();
$fie_tituloscamposgrid=explode(",",$titulos_quitado);

//lista
$camposgrid_quitado=str_replace($quitar_lista,"",$rs_fields->fields["fie_camposgridselect"]);
$camposgrid_quitado=str_replace($quitar_lista2,"",$camposgrid_quitado);
$fie_camposgridselect=array();
$fie_camposgridselect=explode(",",$camposgrid_quitado);




//lee paciente
$datos_paciente="select * from app_cliente where clie_id='".$_GET["idcl"]."'";
$rs_pacient = $DB_gogess->executec($datos_paciente,array());

//edad_a la fecha de la receta

$num_edad=$objvarios->calcular_edad($rs_pacient->fields["clie_fechanacimiento"],$_GET["fecha"]);
$lee_plantilla=str_replace("-edad-",$num_edad["anio"],$lee_plantilla);


$lee_plantilla=str_replace("-hc-",$rs_pacient->fields["clie_rucci"],$lee_plantilla);

$lee_plantilla=str_replace("-encasode-","",$lee_plantilla);
//edad a la fecha de la receta

$lista_campos="select * from gogess_sisfield where tab_name='app_cliente' and fie_guarda=1";
$rs_campos = $DB_gogess->executec($lista_campos,array());
			 if ($rs_campos)
			   {
			      while (!$rs_campos->EOF) {
				  
				    $lee_plantilla=str_replace("-".$rs_campos->fields["fie_name"]."-",$rs_pacient->fields[$rs_campos->fields["fie_name"]],$lee_plantilla);
				  
				   $rs_campos->MoveNext();	
				  }
			  }	  
//lee paciente

//lee recetado
$tbl_listareceta='';
$tbl_listareceta.='<br><table class="table table-bordered"  style="width:350px" border="1" ><tr>';
for($i=0;$i<count($fie_tituloscamposgrid);$i++)
	{
      $tbl_listareceta.='<td bgcolor="#DFE9EE" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:7px" >'.$fie_tituloscamposgrid[$i].'</td>';
	}
$tbl_listareceta.='</tr>';

$cuenta=0;
$plantra_indicaciones='';
$lista_servicios="select * from ".$sub_tabla." where ".$campo_enlace."='".$_GET['enlace']."' and ".$campo_fecharegistro." like '".$_GET["fecha"]."%'";
//echo $lista_servicios;
 $rs_data = $DB_gogess->executec($lista_servicios,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	    if($rs_data->fields["plantra_indicaciones"])
		{
		  $busca_med="select * from dns_cuadrobasicomedicamentos where cuadrobm_codigoatc='".$rs_data->fields["plantra_codigo"]."'";
		  $rs_med = $DB_gogess->executec($busca_med,array());
		  $doc_medi='';
		  if(!($rs_med->fields["cuadrobm_codigoatc"]))
		  {
		    $doc_medi=$rs_data->fields["plantra_medicamento"]." ".$rs_data->fields["plantra_concentracion"]." ".$rs_data->fields["plantra_presentacion"]." ".$rs_data->fields["plantra_via"].": ";
		  }
		
	       $plantra_indicaciones.=$doc_medi.$rs_data->fields["plantra_indicaciones"]."<br>";
		}
	    $cuenta++;
        $tbl_listareceta.='<tr>';
		for($i=0;$i<count($fie_camposgridselect);$i++)
		 {
			
			 
			 $lista_camposxc="select * from gogess_gridfield where  fie_id=".$_GET["fieid"]." and gridfield_nameid='".trim($fie_camposgridselect[$i])."x"."'";
			 $rs_dataxc = $DB_gogess->executec($lista_camposxc,array());
			 $valordt='';
			 switch (trim($rs_dataxc->fields["gridfield_tipo"])) {
					case 'select':
						{
							
							$listac=array();
							$listac=explode(",",$rs_dataxc->fields["gridfield_camposcmb"]);
							$valordt=$objformulario->replace_cmb($rs_dataxc->fields["gridfield_tablecmb"],$rs_dataxc->fields["gridfield_camposcmb"],"where ".$listac[0].'=',$rs_data->fields[$fie_camposgridselect[$i]],$DB_gogess);
							$tbl_listareceta.='<td>'.$valordt.'</td>';
						}
						break;
					case 'check':
						{
						 if($rs_data->fields[$fie_camposgridselect[$i]]==1)
							 {
								 $tbl_listareceta.='<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:8px" ><img src="images/check.png" width="24" height="22" /></td>';
							  }
							else
							{
								 $tbl_listareceta.='<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:8px" ></td>';
							}	
	 
						}
						break;
	
					default:
					   {
						  $tbl_listareceta.='<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:8px" >'.$rs_data->fields[$fie_camposgridselect[$i]].'</td>';
						}
				}
			 
		 }

   $tbl_listareceta.='</tr>';
   $rs_data->MoveNext();	   
	  }
  }
$tbl_listareceta.='</table><br>';




$tbl_listarecetaf='';


//lee recetado

$lee_plantilla=str_replace("-receta-",$tbl_listareceta,$lee_plantilla);
$lee_plantilla=str_replace("-indicaciones-",$plantra_indicaciones,$lee_plantilla);


//datos medico
$lista_usuario="select usua_id from ".$sub_tabla." where ".$campo_enlace."='".$_GET['enlace']."' and ".$campo_fecharegistro." like '".$_GET["fecha"]."%' limit 1";
$rs_usuario = $DB_gogess->executec($lista_usuario,array());

$datos_medico="select * from app_usuario where usua_id='".$rs_usuario->fields["usua_id"]."'";
$rs_medico = $DB_gogess->executec($datos_medico,array());

 
 
 $lee_plantilla=str_replace("-medico-",$rs_medico->fields["usua_siglastitulo"]." ".$rs_medico->fields["usua_nombre"]." ".$rs_medico->fields["usua_apellido"],$lee_plantilla);
 
 $lee_plantilla=str_replace("-cargo-",$rs_medico->fields["usua_cargo"],$lee_plantilla);
 


$lista_campos="select * from gogess_sisfield where tab_name='app_usuario' and fie_guarda=1";
$rs_campos = $DB_gogess->executec($lista_campos,array());
			 if ($rs_campos)
			   {
			      while (!$rs_campos->EOF) {
				  
				    $lee_plantilla=str_replace("-".$rs_campos->fields["fie_name"]."-",$rs_medico->fields[$rs_campos->fields["fie_name"]],$lee_plantilla);
				  
				   $rs_campos->MoveNext();	
				  }
			  }	  

//datos medico


//diagnositco

//diagnostico
$tabla_maestra="dns_atencion";
$id_atencion="atenc_id";
$lista_tablas=array();
$sql_buscadiag=array();
$num_id=0;
$diagnostico_valor='';

$lista_tablas_diag="select * from gogess_sisfield inner join gogess_sistable on gogess_sisfield.tab_name=gogess_sistable.tab_name where ttbl_id=1 and gogess_sistable.tab_name='".$tabla_principal."'";


$rs_diagnost = $DB_gogess->executec($lista_tablas_diag,array());
if ($rs_diagnost)
			   {
			      while (!$rs_diagnost->EOF) {
				  
				    $lista_tablas[$num_id]["tabla"]=$rs_diagnost->fields["tab_name"];
					$lista_tablas[$num_id]["grid"]=$rs_diagnost->fields["fie_tablasubgrid"];
					$lista_tablas[$num_id]["enlace"]=$rs_diagnost->fields["fie_campoenlacesub"];
					$lista_tablas[$num_id]["fechareg"]=$rs_diagnost->fields["fie_campofecharegistro"];
					
					
					if($rs_diagnost->fields["fie_tablasubgrid"])
					{
					
					$sql_buscount[$num_id]="select count(*) as total from ".$tabla_maestra." inner join ".$rs_diagnost->fields["tab_name"]." on ".$tabla_maestra.".".$id_atencion."=".$rs_diagnost->fields["tab_name"].".".$id_atencion." inner join ".$rs_diagnost->fields["fie_tablasubgrid"]." on ".$rs_diagnost->fields["tab_name"].".".$rs_diagnost->fields["fie_campoenlacesub"]."=".$rs_diagnost->fields["fie_tablasubgrid"].".".$rs_diagnost->fields["fie_campoenlacesub"]." where ".$rs_diagnost->fields["tab_name"].".".$campo_enlace."='".$_GET['enlace']."'";
					
					$rs_diacount = $DB_gogess->executec($sql_buscount[$num_id],array());
					if($rs_diacount->fields["total"]>0)
					{
					
					
					$sql_buscadiag[$num_id]="select * from ".$tabla_maestra." inner join ".$rs_diagnost->fields["tab_name"]." on ".$tabla_maestra.".".$id_atencion."=".$rs_diagnost->fields["tab_name"].".".$id_atencion." inner join ".$rs_diagnost->fields["fie_tablasubgrid"]." on ".$rs_diagnost->fields["tab_name"].".".$rs_diagnost->fields["fie_campoenlacesub"]."=".$rs_diagnost->fields["fie_tablasubgrid"].".".$rs_diagnost->fields["fie_campoenlacesub"]." where ".$rs_diagnost->fields["tab_name"].".".$campo_enlace."='".$_GET['enlace']."'";
					 
					//$diagnostico_valor.="<br>".$rs_diagnost->fields["tab_title"]."<ul>";
					$diagnostico_valor.="<ul>";
					//---------------------------------
						$rs_diagtrs = $DB_gogess->executec($sql_buscadiag[$num_id],array());
						if($rs_diagtrs)
						{
						   while (!$rs_diagtrs->EOF) {
						   
						     $diagnostico_valor.="<li>".@$rs_diagtrs->fields["diagn_cie"]." ".@$rs_diagtrs->fields["diagn_descripcion"]." ".@$rs_diagtrs->fields["diagn_tipo"]."</li>";
						   
						     $rs_diagtrs->MoveNext();
						   }
						   
						}
					//---------------------------------
					$diagnostico_valor.="</ul>";
					
					
					
					}
					
					}
						
					
					$num_id++;
				  
				   $rs_diagnost->MoveNext();	
				  }
}	


//echo $diagnostico_valor;
$lee_plantilla=str_replace("-diagnostico-",$diagnostico_valor,$lee_plantilla);

//diagnositco



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


$pdf = new MYPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('CLINICA DE ESPECIALIDADES SUR');
$pdf->SetTitle('CLINICA DE ESPECIALIDADES SUR');
$pdf->SetSubject('CLINICA DE ESPECIALIDADES SUR');
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