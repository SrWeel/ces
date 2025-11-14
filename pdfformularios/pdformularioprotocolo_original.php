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

$anam_enlace=$rs_sihaydata->fields["anam_enlace"];
$anam_fecharegistro=$rs_sihaydata->fields["anam_fecharegistro"];


$protoop_enlace=$rs_sihaydata->fields["protoop_enlace"];


$nomb_centro='';
$nomb_medico='';
$nomb_centro=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre","where centro_id=",$rs_sihaydata->fields["centro_id"],$DB_gogess);
$nomb_medico=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido","where usua_id=",$rs_sihaydata->fields["usua_id"],$DB_gogess);
$usua_ciruc=$objformulario->replace_cmb("app_usuario","usua_id,usua_ciruc","where usua_id=",$rs_sihaydata->fields["usua_id"],$DB_gogess);
  //=========================================================================  
  
  $url="plantillas/form017_anverso_protocolo_operatorio.php";
  $lee_plantilla=$objvarios->leer_contenido_completo($url);
  
  $lee_plantilla=str_replace("-centro-",$nomb_centro,$lee_plantilla);
  $lee_plantilla=str_replace("-nombre-",$nombre_paciente,$lee_plantilla);
  $lee_plantilla=str_replace("-apellido-",$apellido_paciente,$lee_plantilla);
  $lee_plantilla=str_replace("-sexo-",$clie_genero,$lee_plantilla);
  $lee_plantilla=str_replace("-hc-",$hc,$lee_plantilla);
  $lee_plantilla=str_replace("-motivoconsulta-",$anam_motivoconsulta,$lee_plantilla);
  
 
$lista_standar='protoop_dieresis,protoop_exposicion,protoop_exploracion,protoop_procedimiento';
$lista_standararray=array();
$lista_standararray=explode(",",$lista_standar);
 
 for($i=0;$i<count($lista_standararray);$i++)
 { 
 $lab_marca=$rs_sihaydata->fields[$lista_standararray[$i]];
 //$lab_marca=genera_x($lab_marca);
 $lab_marca=str_replace(PHP_EOL, '<br>', $lab_marca);
 $lee_plantilla=str_replace("-".$lista_standararray[$i]."-",$lab_marca,$lee_plantilla); 
  }
 
  
//=============================================================================
 $lista_standar='protoop_proyectada,protoop_realizada,protoop_cirujanouno,protoop_cirujanodos,protoop_ayudanteuno,protoop_ayudantedos,protoop_instrumentista,protoop_circulante,protoop_anestesiologo,protoop_horainicio,protoop_horafin,protoop_dieresis,protoop_exposicion,protoop_exploracion,protoop_procedimiento,protoop_sintesis,protoop_complicaciones,protoop_examendetalle,protoop_diagnostico,protoop_tecerayudante,protoop_ayudanteanestesia,protoop_tipoanestesia';
 $lista_standararray=array();
 $lista_standararray=explode(",",$lista_standar);
 
 for($i=0;$i<count($lista_standararray);$i++)
 { 
 $lab_marca=$rs_sihaydata->fields[$lista_standararray[$i]];
 //$lab_marca=genera_x($lab_marca);
 $lee_plantilla=str_replace("-".$lista_standararray[$i]."-",$lab_marca,$lee_plantilla); 
  }

//echo nl2br($lab_marca);
$protoop_fechaoperacion=$rs_sihaydata->fields["protoop_fechaoperacion"];
$sepa_fecha=array();
$sepa_fecha=explode("-",$protoop_fechaoperacion);

$lee_plantilla=str_replace("-dia-",$sepa_fecha[2],$lee_plantilla);
$lee_plantilla=str_replace("-mes-",$sepa_fecha[1],$lee_plantilla);
$lee_plantilla=str_replace("-anio-",$sepa_fecha[0],$lee_plantilla); 
//=============================================================================
$cie_uno='';
 //diagnosticos
   $datos_diagnostico='';
   $cuentase=0;
   $diagosticos_rv="select * from cesdb_arextension.dns_protocolodiagnosticospre where protoop_enlace='".$protoop_enlace."' limit 6";
   $rs_dgnostico = $DB_gogess->executec($diagosticos_rv,array());
   if($rs_dgnostico)
	{
		while (!$rs_dgnostico->EOF) {
	
		   $cuentase++;
		   
		   $lee_plantilla=str_replace("-diagnostico".$cuentase."-",$rs_dgnostico->fields["diagnpre_descripcion"],$lee_plantilla);
		   $lee_plantilla=str_replace("-cie".$cuentase."-",$rs_dgnostico->fields["diagnpre_cie"],$lee_plantilla);
		   
		   
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
		   
		   $cie_uno.=$rs_dgnostico->fields["diagnpre_cie"].",";
		   	   
		
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
 
 $cie_dos='';
 
 //diagnosticos2
   $datos_diagnostico='';
   $cuentase=0;
   $diagosticos_rv="select * from cesdb_arextension.dns_protocolodiagnosticospost where protoop_enlace='".$protoop_enlace."' limit 6";
   $rs_dgnostico = $DB_gogess->executec($diagosticos_rv,array());
   if($rs_dgnostico)
	{
		while (!$rs_dgnostico->EOF) {
	
		   $cuentase++;
		   
		   $lee_plantilla=str_replace("-diagnosticoeg".$cuentase."-",$rs_dgnostico->fields["diagnpost_descripcion"],$lee_plantilla);
		   $lee_plantilla=str_replace("-cieeg".$cuentase."-",$rs_dgnostico->fields["diagnpost_cie"],$lee_plantilla);
		   
		   
		   if($rs_dgnostico->fields["diagneg_tipo"]=='PRESUNTIVO')
		   {		   
		   $lee_plantilla=str_replace("-preeg".$cuentase."-","X",$lee_plantilla);
		   $lee_plantilla=str_replace("-defeg".$cuentase."-","",$lee_plantilla);		   
		   }
		   
		   if($rs_dgnostico->fields["diagneg_tipo"]=='DEFINITIVO')
		   {		   
		   $lee_plantilla=str_replace("-preeg".$cuentase."-","",$lee_plantilla);
		   $lee_plantilla=str_replace("-defeg".$cuentase."-","X",$lee_plantilla);		   
		   }
		   	   
			 $cie_dos.=$rs_dgnostico->fields["diagnpost_cie"].",";   
		
		  $rs_dgnostico->MoveNext();
		}
	}	
	
 for($iv=1;$iv<=6;$iv++)
 {
    $lee_plantilla=str_replace("-diagnosticoeg".$iv."-","",$lee_plantilla);
	$lee_plantilla=str_replace("-cieeg".$iv."-","",$lee_plantilla);
    $lee_plantilla=str_replace("-preeg".$iv."-","",$lee_plantilla);
	$lee_plantilla=str_replace("-defeg".$iv."-","",$lee_plantilla);
 
 }	
 //diagnosticos2
 
    $lee_plantilla=str_replace("-protoop_preoperatorio-",$cie_uno,$lee_plantilla);
	$lee_plantilla=str_replace("-protoop_postoperatorio-",$cie_dos,$lee_plantilla);
 
 //medicos tratantes
   $datos_mtratantes='';
   $cuentase=0;
   $tratantes_rv="select * from cesdb_arextension.dns_medicostratantes where anam_enlace='".$anam_enlace."' limit 4";
   $rs_tratantes = $DB_gogess->executec($tratantes_rv,array());
   if($rs_tratantes)
	{
		while (!$rs_tratantes->EOF) {
	
		   $cuentase++;
		   
		   $lee_plantilla=str_replace("-nombre".$cuentase."-",$rs_tratantes->fields["medtra_nombres"],$lee_plantilla);
		   $lee_plantilla=str_replace("-espe".$cuentase."-",$rs_tratantes->fields["medtra_especialidad"],$lee_plantilla);
		   $lee_plantilla=str_replace("-code".$cuentase."-",$rs_tratantes->fields["medtra_codigo"],$lee_plantilla);
		   $lee_plantilla=str_replace("-periodo".$cuentase."-",$rs_tratantes->fields["medtra_responsabilidad"],$lee_plantilla);
		
		  $rs_tratantes->MoveNext();
		}
	}	
 
 for($iv=1;$iv<=4;$iv++)
 {
    $lee_plantilla=str_replace("-nombre".$iv."-","",$lee_plantilla);
	$lee_plantilla=str_replace("-espe".$iv."-","",$lee_plantilla);
    $lee_plantilla=str_replace("-code".$iv."-","",$lee_plantilla);
	$lee_plantilla=str_replace("-periodo".$iv."-","",$lee_plantilla);
 
 }	
 //medicos tratantes
 
 //cruz 
 $lista_standar='anam_altadefinitiva,anam_asintomatico,anam_discapacidadmoderada,anam_retiroautorizado,anam_defuncionmenos48,anam_altatransitoria,anam_discapacidadleve,anam_discapacidadgrave,anam_retironoautorizado,anam_defuncionmas48';
 $lista_standararray=array();
 $lista_standararray=explode(",",$lista_standar);
 
 for($i=0;$i<count($lista_standararray);$i++)
 { 
	 $lab_marca=$rs_sihaydata->fields[$lista_standararray[$i]];
	 //$lab_marca=genera_x($lab_marca);
	 if($lab_marca==1)
	 {
	 $lee_plantilla=str_replace("-".$lista_standararray[$i]."-","<b>X</b>",$lee_plantilla); 
	 }
	 else
	 {
	 $lee_plantilla=str_replace("-".$lista_standararray[$i]."-","&nbsp;",$lee_plantilla); 
	 }
 
 } 
 //cruz
 
 
 
 $lee_plantilla=str_replace("-anam_planes-",$anam_planes,$lee_plantilla);
 
 $separa_fecha_hora=explode(" ",$anam_fecharegistro);
 
 $lee_plantilla=str_replace("-anam_fecharegistro-",$separa_fecha_hora[0],$lee_plantilla);
 $lee_plantilla=str_replace("-fechhora-",$separa_fecha_hora[1],$lee_plantilla);
 
 $lee_plantilla=str_replace("-medico-",$nomb_medico,$lee_plantilla);
 $lee_plantilla=str_replace("-codigo-",$usua_ciruc,$lee_plantilla);
 
 
$comprobantepdf=$lee_plantilla;
  
$xml="Planilla";
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