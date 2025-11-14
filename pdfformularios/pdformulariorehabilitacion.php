<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8'); 
$tiempossss=544444000;
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
$eteneva_id=$pVar5;
$valor_id=$separa_campos[1];

 $director='../';
 include("../cfg/clases.php");
 include("../cfg/declaracion.php");
 
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
//$busca_sihaydata="select * from ".$table." where atenc_id=? and clie_id=?";
$busca_sihaydata="select * from ".$table." where  ".$campo_primariodata."=?";
$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array($valor_id));

$nomb_centro='';
$nomb_medico='';
$nomb_centro=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre","where centro_id=",$rs_sihaydata->fields["centro_id"],$DB_gogess);
$nomb_medico=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido","where usua_id=",$rs_sihaydata->fields["usua_id"],$DB_gogess);



$anam_motivoconsulta=$rs_sihaydata->fields["anam_motivoconsulta"];
$anam_enlace=$rs_sihaydata->fields["anam_enlace"];
$anam_menarquiaedad=$rs_sihaydata->fields["anam_menarquiaedad"];
$anam_menopausiaedad=$rs_sihaydata->fields["anam_menopausiaedad"];
$anam_ciclos=$rs_sihaydata->fields["anam_ciclos"];
$anam_vidasexualactiva=$rs_sihaydata->fields["anam_vidasexualactiva"];
if($anam_vidasexualactiva==1)
{
  $anam_vidasexualactiva='SI';
}
else
{
 $anam_vidasexualactiva='NO';
}
$anam_gesta=$rs_sihaydata->fields["anam_gesta"];
$anam_partos=$rs_sihaydata->fields["anam_partos"];
$anam_abortos=$rs_sihaydata->fields["anam_abortos"];
$anam_cesareas=$rs_sihaydata->fields["anam_cesareas"];

$anam_hijosvivos=$rs_sihaydata->fields["anam_hijosvivos"];
$anam_fum=$rs_sihaydata->fields["anam_fum"];
$anam_fup=$rs_sihaydata->fields["anam_fup"];
$anam_fuc=$rs_sihaydata->fields["anam_fuc"];

$anam_biopsia=$rs_sihaydata->fields["anam_biopsia"];
$anam_biopsiatext=$rs_sihaydata->fields["anam_biopsiatext"];

$anam_metodopfamiliar=$rs_sihaydata->fields["anam_metodopfamiliar"];
$anam_metodopfamiliartex=$rs_sihaydata->fields["anam_metodopfamiliartex"];

$anam_terapiahormonal=$rs_sihaydata->fields["anam_terapiahormonal"];
$anam_terapiahormonaltext=$rs_sihaydata->fields["anam_terapiahormonaltext"];  

$anam_colposcopia=$rs_sihaydata->fields["anam_colposcopia"];
$anam_colposcopiatext=$rs_sihaydata->fields["anam_colposcopiatext"];

$anam_mamografia=$rs_sihaydata->fields["anam_mamografia"];
$anam_mamografiatxt=$rs_sihaydata->fields["anam_mamografiatxt"];

$anam_emferpactual=$rs_sihaydata->fields["anam_emferpactual"];

$anam_planes=$rs_sihaydata->fields["anam_planes"];

$anam_fecharegistro=$rs_sihaydata->fields["anam_fecharegistro"];


  //=========================================================================
  
  
  $url="plantillas/form003anversorehabilitacion.php";
  $lee_plantilla=$objvarios->leer_contenido_completo($url);
  
  $lee_plantilla=str_replace("-centro-",$nomb_centro,$lee_plantilla);
  $lee_plantilla=str_replace("-nombre-",$nombre_paciente,$lee_plantilla);
  $lee_plantilla=str_replace("-apellido-",$apellido_paciente,$lee_plantilla);
  $lee_plantilla=str_replace("-sexo-",$clie_genero,$lee_plantilla);
  $lee_plantilla=str_replace("-hc-",$hc,$lee_plantilla);
  $lee_plantilla=str_replace("-motivoconsulta-",$anam_motivoconsulta,$lee_plantilla);
  
  //antecedentes personales
  $datos_ap='';
  $antecedentes_personales="select * from cesdb_arextension.dns_antecedentespersonales a inner join cesdb_arcombos.dns_opcionantecedentes b on a.opcioante_id=b.opcioante_id where clie_id='".$clie_id."'";
  $rs_ap = $DB_gogess->executec($antecedentes_personales,array());
  if($rs_ap)
	{
		while (!$rs_ap->EOF) {
		
		  $datos_ap.=$rs_ap->fields["opcioante_id"]." ".$rs_ap->fields["antep_descripcion"].", ";
		
		  $rs_ap->MoveNext();
		}
	}	



 
  if($anam_biopsia==1)
  {     
	 $datos_ap.=", Biopsia:".$anam_biopsiatext; 
	 $anam_biopsia='SI'; 
  }
  else
  {
     $anam_biopsia='';
  }
  
  if($anam_metodopfamiliar==1)
  {     
	 $datos_ap.=", Metodo P.Familiar:".$anam_metodopfamiliartex; 
	 $anam_metodopfamiliar='SI'; 
  } 
  else
  {
     $anam_metodopfamiliar=''; 
  } 

  if($anam_terapiahormonal==1)
  {     
	 $datos_ap.=", Terapia hormonal:".$anam_terapiahormonaltext; 
	 $anam_terapiahormonal='SI'; 
  }  
  else
  {
    $anam_terapiahormonal='';
  }
  
  if($anam_colposcopia==1)
  {     
	 $datos_ap.=", Colposcopia:".$anam_colposcopiatext; 
	 $anam_colposcopia='SI'; 
  } 
  else
  {
     $anam_colposcopia='';   
  }
 

  if($anam_mamografia==1)
  {     
	 $datos_ap.=", Mamograf&iacute;a:".$anam_mamografiatxt; 
	 $anam_mamografia='SI'; 
  } 
  else
  {
     $anam_mamografia='';   
  }
  
  
  $datos_ap.=" ".$rs_sihaydata->fields["anam_observacionap"];
  //antecedentes personales
  
  
  //antecedentes familiares
  $datos_af='';
  $antecedentes_familiares="select * from cesdb_arextension.dns_antecedentesfamiliares a inner join cesdb_arcombos.dns_tipofamiliar b on a.tipfam_id=b.tipfam_id where clie_id='".$clie_id."'";
  $rs_af = $DB_gogess->executec($antecedentes_familiares,array());
  if($rs_af)
	{
		while (!$rs_af->EOF) {
		
		  $datos_af.=$rs_af->fields["tipfam_id"]." ".$rs_af->fields["antef_descripcion"].", ";
		  
		  $lee_plantilla=str_replace("-af".$rs_af->fields["tipfam_id"]."-",'X',$lee_plantilla); 
		
		  $rs_af->MoveNext();
		}
	}	

  $lee_plantilla=str_replace("-af1-",'',$lee_plantilla); 
  $lee_plantilla=str_replace("-af2-",'',$lee_plantilla); 
  $lee_plantilla=str_replace("-af3-",'',$lee_plantilla); 
  $lee_plantilla=str_replace("-af4-",'',$lee_plantilla); 
  $lee_plantilla=str_replace("-af5-",'',$lee_plantilla); 
  $lee_plantilla=str_replace("-af6-",'',$lee_plantilla); 
  $lee_plantilla=str_replace("-af7-",'',$lee_plantilla); 
  $lee_plantilla=str_replace("-af8-",'',$lee_plantilla); 
  $lee_plantilla=str_replace("-af9-",'',$lee_plantilla); 
  $lee_plantilla=str_replace("-af10-",'',$lee_plantilla); 
  	
  //antecedentes familiares
  
  $datos_af.=" ".$rs_sihaydata->fields["anam_observacionaf"];
  
  //Revicion actual de organos  
  $datos_ro='';
  $rebicion_organos="select * from cesdb_arextension.dns_rehabilitaciongridorgano a inner join cesdb_arcombos.dns_opcionorgano b on a.opcorg_id=b.opcorg_id where tiporg_nombre='CP' and anam_enlace='".$anam_enlace."'";
  $rs_ro = $DB_gogess->executec($rebicion_organos,array());
  if($rs_ro)
	{
		while (!$rs_ro->EOF) {
		
		  $datos_ro.=$rs_ro->fields["opcorg_id"]." ".$rs_ro->fields["gorgano_observacion"].", ";		  
		  $lee_plantilla=str_replace("-rocp".$rs_ro->fields["opcorg_id"]."-",'X',$lee_plantilla); 
		  $lee_plantilla=str_replace("-rosp".$rs_ro->fields["opcorg_id"]."-",'',$lee_plantilla);
		
		  $rs_ro->MoveNext();
		}
	}	
  
  $rebicion_organossp="select * from cesdb_arcombos.dns_opcionorgano";
  $rs_rosp = $DB_gogess->executec($rebicion_organossp,array());
  if($rs_rosp)
	{
		while (!$rs_rosp->EOF) {
			  
		  $lee_plantilla=str_replace("-rocp".$rs_rosp->fields["opcorg_id"]."-",'',$lee_plantilla); 
		  $lee_plantilla=str_replace("-rosp".$rs_rosp->fields["opcorg_id"]."-",'X',$lee_plantilla);
		
		  $rs_rosp->MoveNext();
		}
	}	
  
  //$lee_plantilla=str_replace("-rocp".$rs_ro->fields["opcorg_id"]."-",'X',$lee_plantilla); 
  
  $lee_plantilla=str_replace("-ro-",$datos_ro,$lee_plantilla);
  //Revicion actual de organos
  
  $lee_plantilla=str_replace("-ap-",$datos_ap,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_menarquiaedad-",$anam_menarquiaedad,$lee_plantilla); 
  $lee_plantilla=str_replace("-anam_menopausiaedad-",$anam_menopausiaedad,$lee_plantilla);  
  $lee_plantilla=str_replace("-anam_ciclos-",$anam_ciclos,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_vidasexualactiva-",$anam_vidasexualactiva,$lee_plantilla);
  
if($clie_genero=='F')
{
//================================================== 
  $lee_plantilla=str_replace("-anam_gesta-",$anam_gesta,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_partos-",$anam_partos,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_abortos-",$anam_abortos,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_cesareas-",$anam_cesareas,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_fum-",$anam_fum,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_fup-",$anam_fup,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_fuc-",$anam_fuc,$lee_plantilla);
//==================================================
}
else
{
//================================================== 
  $lee_plantilla=str_replace("-anam_gesta-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_partos-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_abortos-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_cesareas-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_fum-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_fup-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_fuc-",'',$lee_plantilla);
//==================================================
}
  
  
  $lee_plantilla=str_replace("-anam_hijosvivos-",$anam_hijosvivos,$lee_plantilla);

  $lee_plantilla=str_replace("-anam_biopsia-",$anam_biopsia,$lee_plantilla);
  
  $lee_plantilla=str_replace("-anam_metodopfamiliar-",$anam_metodopfamiliar,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_terapiahormonal-",$anam_terapiahormonal,$lee_plantilla);
  
  $lee_plantilla=str_replace("-anam_colposcopia-",$anam_colposcopia,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_mamografia-",$anam_mamografia,$lee_plantilla);

  $lee_plantilla=str_replace("-af-",$datos_af,$lee_plantilla);
  
  $lee_plantilla=str_replace("-anam_emferpactual-",$anam_emferpactual,$lee_plantilla);
  
  
  //signos vitales 
  $odonto_fecharegistro=$rs_sihaydata->fields["anam_fecharegistro"]; 
  $solo_fechareg=array();
  $solo_fechareg=explode(" ",$odonto_fecharegistro);

  $sig_vitales="select * from dns_signosvitales where atenc_enlace='".$rs_atencion->fields["atenc_enlace"]."' and DATE_FORMAT(signovita_fecharegistro, '%Y-%m-%d')='".$solo_fechareg[0]."' order by signovita_fecharegistro desc limit 1";
  
  $rs_svitales = $DB_gogess->executec($sig_vitales,array());
  if($rs_svitales)
	{
		while (!$rs_svitales->EOF) {
			  
		  $lee_plantilla=str_replace("-signovita_presionarterial-",$rs_svitales->fields["signovita_presionarterial"],$lee_plantilla); 
		  $lee_plantilla=str_replace("-signovita_frecuenciacardiaca-",$rs_svitales->fields["signovita_frecuenciacardiaca"],$lee_plantilla);
		  $lee_plantilla=str_replace("-signovita_frecuenciarespiratoria-",$rs_svitales->fields["signovita_frecuenciarespiratoria"],$lee_plantilla);
		  $lee_plantilla=str_replace("-signovita_temperaturabucal-",$rs_svitales->fields["signovita_temperaturabucal"],$lee_plantilla);
		  $lee_plantilla=str_replace("-signovita_peso-",$rs_svitales->fields["signovita_peso"],$lee_plantilla);
		  $lee_plantilla=str_replace("-signovita_talla-",$rs_svitales->fields["signovita_talla"],$lee_plantilla);
		  $lee_plantilla=str_replace("-signovita_perimetrocefalico-",$rs_svitales->fields["signovita_perimetrocefalico"],$lee_plantilla);
		
		  $rs_svitales->MoveNext();
		}
	}
  
  $lee_plantilla=str_replace("-signovita_presionarterial-","",$lee_plantilla); 
  $lee_plantilla=str_replace("-signovita_frecuenciacardiaca-","",$lee_plantilla);
  $lee_plantilla=str_replace("-signovita_frecuenciarespiratoria-","",$lee_plantilla);
  $lee_plantilla=str_replace("-signovita_temperaturabucal-","",$lee_plantilla);
  $lee_plantilla=str_replace("-signovita_peso-","",$lee_plantilla);
  $lee_plantilla=str_replace("-signovita_talla-","",$lee_plantilla);
  $lee_plantilla=str_replace("-signovita_perimetrocefalico-","",$lee_plantilla);
  //signos vitales
  
 //examen fisco regional  
   
 $datos_freg='';
 $fisco_regional="select * from cesdb_arextension.dns_rehabilitaciongridexamenfisico a inner join cesdb_arcombos.dns_opcionexamenfisico b on a.opcexa_id=b.opcexa_id where tiporg_nombre='CP' and anam_enlace='".$anam_enlace."'";
  $rs_freg = $DB_gogess->executec($fisco_regional,array());
  if($rs_freg)
	{
		while (!$rs_freg->EOF) {
		
		  $datos_freg.=$rs_freg->fields["opcexa_orden"]." ".$rs_freg->fields["opcexa_tipo"]." ".$rs_freg->fields["gexamfis_observacion"].", ";		  
		  $lee_plantilla=str_replace("-".$rs_freg->fields["opcexa_orden"].strtolower($rs_freg->fields["opcexa_tipo"])."cp-",'X',$lee_plantilla); 
		  $lee_plantilla=str_replace("-".$rs_freg->fields["opcexa_orden"].strtolower($rs_freg->fields["opcexa_tipo"])."sp-",'',$lee_plantilla); 
		
		  $rs_freg->MoveNext();
		}
	}	
	

  $fisicoreg_fr="select * from cesdb_arcombos.dns_opcionexamenfisico";
  $rs_fregv = $DB_gogess->executec($fisicoreg_fr,array());
  if($rs_fregv)
	{
		while (!$rs_fregv->EOF) {
			  
		  $lee_plantilla=str_replace("-".$rs_fregv->fields["opcexa_orden"].strtolower($rs_fregv->fields["opcexa_tipo"])."cp-",'',$lee_plantilla); 
		  $lee_plantilla=str_replace("-".$rs_fregv->fields["opcexa_orden"].strtolower($rs_fregv->fields["opcexa_tipo"])."sp-",'X',$lee_plantilla);
		
		  $rs_fregv->MoveNext();
		}
	}		
  
  $lee_plantilla=str_replace("-freg-",$datos_freg,$lee_plantilla);
 //examen fisico regional
 
 //diagnosticos
   $datos_diagnostico='';
   $cuentase=0;
   $diagosticos_rv="select * from cesdb_arextension.dns_rehabilitaciondiagnosticoanamnesis where anam_enlace='".$anam_enlace."' limit 6";
   $rs_dgnostico = $DB_gogess->executec($diagosticos_rv,array());
   if($rs_dgnostico)
	{
		while (!$rs_dgnostico->EOF) {
	
		   $cuentase++;
		   
		   $lee_plantilla=str_replace("-diagnostico".$cuentase."-",$rs_dgnostico->fields["diagn_descripcion"],$lee_plantilla);
		   $lee_plantilla=str_replace("-cie".$cuentase."-",$rs_dgnostico->fields["diagn_cie"],$lee_plantilla);
		   
		   
		   if($rs_dgnostico->fields["diagn_tipo"]=='PRESUNTIVO')
		   {
		   
		   $lee_plantilla=str_replace("-pre".$cuentase."-","X",$lee_plantilla);
		   $lee_plantilla=str_replace("-def".$cuentase."-","",$lee_plantilla);
		   
		   }
		   
		   if($rs_dgnostico->fields["diagn_tipo"]=='DEFINITIVO')
		   {
		   
		   $lee_plantilla=str_replace("-pre".$cuentase."-","",$lee_plantilla);
		   $lee_plantilla=str_replace("-def".$cuentase."-","X",$lee_plantilla);
		   
		   }
		   
		   
		
		  $rs_dgnostico->MoveNext();
		}
	}	
	
 for($iv=1;$iv<=6;$iv++)
 {
    $lee_plantilla=str_replace("-diagnostico".$iv."-","",$lee_plantilla);
	$lee_plantilla=str_replace("-cie".$iv."-","",$lee_plantilla);
    $lee_plantilla=str_replace("-pre".$iv."-","",$lee_plantilla);
	$lee_plantilla=str_replace("-def".$iv."-","",$lee_plantilla);
 
 }	
 //diagnosticos
 
 
 $lee_plantilla=str_replace("-anam_planes-",$anam_planes,$lee_plantilla);
 
 $separa_fecha_hora=explode(" ",$anam_fecharegistro);
 
 $lee_plantilla=str_replace("-anam_fecharegistro-",$separa_fecha_hora[0],$lee_plantilla);
 $lee_plantilla=str_replace("-fechhora-",$separa_fecha_hora[1],$lee_plantilla);
 
 $lee_plantilla=str_replace("-medico-",$nomb_medico,$lee_plantilla);
 
 
 



$comprobantepdf=$lee_plantilla;
  
$xml="REHA";
$dompdf = new DOMPDF();
$dompdf->set_paper('A4', 'portrait');
$dompdf->load_html($comprobantepdf, 'UTF-8');
$dompdf->render();
$font = Font_Metrics::get_font("helvetica", "bold");
$canvas = $dompdf->get_canvas();
$footer = $canvas->open_object();

    ////$canvas->line(10,730,800,730,array(0,0,0),1);
//$canvas->page_text(530, 833, "", $font, 10, array(0,0,0));

$canvas->close_object();
$canvas->add_object($footer, "all");

$dompdf->stream($xml."_".$hc."_".$separa_fecha_hora[0].".pdf");


}
?>