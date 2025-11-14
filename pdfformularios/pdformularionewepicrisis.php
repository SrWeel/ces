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
$hc=$rs_dcliente->fields["clie_rucci"];
$hcpinos=$rs_dcliente->fields["clie_hcpinos"]; 
//$causaexterna=$rs_dcliente->fields["anam_causaexterna"];

$conve_id=$rs_dcliente->fields["conve_id"]; 
$nac_id=$rs_dcliente->fields["nac_id"];

$uni_codiog='';
$uni_codiog=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_codigo","where centro_id=",1,$DB_gogess);


$table=$rs_tabla->fields["tab_name"];  
$campo_primariodata=$rs_tabla->fields["tab_campoprimario"]; 
//$busca_sihaydata="select * from ".$table." where atenc_id=? and clie_id=?";
$busca_sihaydata="select * from ".$table." where  ".$campo_primariodata."=?";
$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array($valor_id));

$anam_enlace=$rs_sihaydata->fields["anam_enlace"];
$anam_fecharegistro=$rs_sihaydata->fields["anam_fecharegistro"];
$anam_causaexterna=$rs_sihaydata->fields["anam_causaexterna"];

$anam_fechaalta=$rs_sihaydata->fields["anam_fechaalta"];
$anam_horaalta=$rs_sihaydata->fields["anam_horaalta"];


$nomb_centro='';
$nomb_medico='';
$nomb_centro=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre","where centro_id=",1,$DB_gogess);
$nomb_medico=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido","where usua_id=",$rs_sihaydata->fields["usua_id"],$DB_gogess);
$usua_ciruc=$objformulario->replace_cmb("app_usuario","usua_id,usua_ciruc","where usua_id=",$rs_sihaydata->fields["usua_id"],$DB_gogess);


$usua_ciructratante=$objformulario->replace_cmb("app_usuario","usua_id,usua_ciruc","where usua_id=",$rs_sihaydata->fields["usua2_id"],$DB_gogess);
$usua_ntratante=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido","where usua_id=",$rs_sihaydata->fields["usua2_id"],$DB_gogess);
  //=========================================================================  
  
  $url="plantillas/form06anversonewepicrisis.php";
  $lee_plantilla=$objvarios->leer_contenido_completo($url);
  
  $lee_plantilla=str_replace("-centro-",$nomb_centro,$lee_plantilla);
  $lee_plantilla=str_replace("-nombre-",$nombre_paciente,$lee_plantilla);
  $lee_plantilla=str_replace("-apellido-",$apellido_paciente,$lee_plantilla);
  
  $valor_sexo='';
  if($clie_genero=='M')
  {
    $valor_sexo='H';
  }
  if($clie_genero=='F')
  {
    $valor_sexo='M';
  }
  
  $lee_plantilla=str_replace("-sexo-",$valor_sexo,$lee_plantilla);
  $lee_plantilla=str_replace("-hc-",$hc,$lee_plantilla);
  $lee_plantilla=str_replace("-hcpinos-",$hcpinos,$lee_plantilla);
  $lee_plantilla=str_replace("-motivoconsulta-",$anam_motivoconsulta,$lee_plantilla);
  //$lee_plantilla=str_replace("-anam_causaexterna-",$causaexterna,$lee_plantilla);
  
  
  
  $lee_plantilla=str_replace("-citratante-",$usua_ciructratante,$lee_plantilla);
  $lee_plantilla=str_replace("-usua2_id-",$usua_ntratante,$lee_plantilla);
  
$institucion_valor='';
$institucion_valor=$objvarios->selecciona_institucion($conve_id);
$lee_plantilla=str_replace("-institucion-",$institucion_valor,$lee_plantilla);

$nacionalidad_valor='';
$nacionalidad_valor=$objvarios->selecciona_nacionalidad($nac_id,$DB_gogess);
$lee_plantilla=str_replace("-nac_nombre-",$nacionalidad_valor,$lee_plantilla);

$lee_plantilla=str_replace("-ucodigo-",$uni_codiog,$lee_plantilla);

//=========================   
$logo = $objformulario->replace_cmb("app_empresa", "emp_id,emp_logoreporte", "where emp_id=", 1, $DB_gogess);
$logoc ='<img src="../archivo/'.$logo.'" alt="125x125" width="140px">';

$emp_nombre = $objformulario->replace_cmb("app_empresa", "emp_id,emp_nombre", "where emp_id=", 1, $DB_gogess);
$emp_piedepagina = $objformulario->replace_cmb("app_empresa", "emp_id,emp_piedepagina", "where emp_id=", 1, $DB_gogess);
$emp_logo = $objformulario->replace_cmb("app_empresa", "emp_id,emp_logo", "where emp_id=", 1, $DB_gogess);
  
  
  //cabecera y pie de pagina
$lee_plantilla = str_replace("-graficologo-", $logoc, $lee_plantilla);
$lee_plantilla = str_replace("-empresanombre-", $emp_nombre, $lee_plantilla);
$lee_plantilla = str_replace("-piedepagina-", $emp_piedepagina, $lee_plantilla);
$lee_plantilla = str_replace("-logofondo-", $emp_logo, $lee_plantilla);
  //=========================
  
$conteo_pg=0;
$protoop_idenlacex=$rs_sihaydata->fields["protoop_idenlace"];  
$protoop_tblprincipalx=$rs_sihaydata->fields["protoop_tblprincipal"]; 
$clie_idx=$rs_sihaydata->fields["clie_id"];
$anam_idpg=$rs_sihaydata->fields["anam_id"];

$busca_listapg="select * from dns_newepicrisisanamesis where  clie_id='".$clie_idx."' and protoop_idenlace='".$protoop_idenlacex."' and protoop_tblprincipal='".$protoop_tblprincipalx."' order by anam_id asc";

$rs_blistapg = $DB_gogess->executec($busca_listapg,array());
   
   if($rs_blistapg)
	{
		while (!$rs_blistapg->EOF) {
		
		  $conteo_pg++;
		  $actualizpg="update dns_newepicrisisanamesis set anam_secuencial='".$conteo_pg."' where anam_id='".$rs_blistapg->fields["anam_id"]."'";
		  $rs_acpg= $DB_gogess->executec($actualizpg,array());
		
		 $rs_blistapg->MoveNext();
		}
	}	

   $busca_pgvalor="select * from ".$table." where  ".$campo_primariodata."=?";
   $rs_pgbalor = $DB_gogess->executec($busca_pgvalor,array($valor_id));
   $lee_plantilla=str_replace("-secuencial-",$rs_pgbalor->fields["anam_secuencial"],$lee_plantilla);
  
   ///edad actual 
  $num_mes=array();
  $num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_sihaydata->fields["anam_fecharegistro"]);
  //$lee_plantilla=str_replace("-edad-",$num_mes["anio"],$lee_plantilla);
  
  
  ///edad actual 
  $num_mes=array();
  $num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_sihaydata->fields["anam_fecharegistro"]);
 // $lee_plantilla=str_replace("-edad-",$num_mes["anio"],$lee_plantilla);
  
  
  
   if($num_mes["anio"]>0)
  {
       $lee_plantilla=str_replace("-cea-","X",$lee_plantilla);
	   
	   $lee_plantilla=str_replace("-edad-",$num_mes["anio"],$lee_plantilla);
	   
  }
  else
  {  
	  if($num_mes["mes"]>0)
	  {
		 $lee_plantilla=str_replace("-cem-","X",$lee_plantilla);
		 $lee_plantilla=str_replace("-edad-",$num_mes["mes"],$lee_plantilla);
	  }
      else
	  {
	      if($num_mes["dia"]>0)
		  {
		   $lee_plantilla=str_replace("-ced-","X",$lee_plantilla);	
		   $lee_plantilla=str_replace("-edad-",$num_mes["dia"],$lee_plantilla);
		  }
		   
	  }  
  }
  
   $lee_plantilla=str_replace("-cea-","",$lee_plantilla);
   $lee_plantilla=str_replace("-cem-","",$lee_plantilla);
   $lee_plantilla=str_replace("-ced-","",$lee_plantilla);
   
$anam_resumenclinico_txt=$rs_sihaydata->fields["anam_resumenclinico"];  
$anam_resumenclinico_txt=str_replace("\n", "<br>" ,$anam_resumenclinico_txt);
$lee_plantilla=str_replace("-anam_resumenclinico-",$anam_resumenclinico_txt,$lee_plantilla);


$anam_resumentratamiento_txt=$rs_sihaydata->fields["anam_resumentratamiento"];  
$anam_resumentratamiento_txt=str_replace("\n", "<br>" ,$anam_resumentratamiento_txt);
$lee_plantilla=str_replace("-anam_resumentratamiento-",$anam_resumentratamiento_txt,$lee_plantilla);


$anam_condicionegreso_txt=$rs_sihaydata->fields["anam_condicionegreso"];  
$anam_condicionegreso_txt=str_replace("\n", "<br>" ,$anam_condicionegreso_txt);
$lee_plantilla=str_replace("-anam_condicionegreso-",$anam_condicionegreso_txt,$lee_plantilla);



   
  
$lista_standar='anam_resumenclinico,anam_resumentratamiento,anam_condicionegreso,anam_control';
$lista_standararray=array();
$lista_standararray=explode(",",$lista_standar);
 
 for($i=0;$i<count($lista_standararray);$i++)
 { 
 $lab_marca=$rs_sihaydata->fields[$lista_standararray[$i]];
 //$lab_marca=genera_x($lab_marca);
 $lab_marca=str_replace(PHP_EOL, '', $lab_marca);
 $lee_plantilla=str_replace("-".$lista_standararray[$i]."-",$lab_marca,$lee_plantilla); 
  }
  
 
$detalle_evo=''; 
$evolucion_rv="select * from cesdb_arextension.dns_evolucionepicrisis where anam_enlace='".$anam_enlace."'";
$rs_evolucion = $DB_gogess->executec($evolucion_rv,array());
if($rs_evolucion)
	{
		while (!$rs_evolucion->EOF) {
		
		$detalle_evo.=$rs_evolucion->fields["evoepi_descripcion"]."<br>";
		
		$rs_evolucion->MoveNext();
		}
	}	

$evolucion_txt=$rs_sihaydata->fields["anam_resumenevolucion"]."<br>";  
$evolucion_txt=str_replace("\n", "<br>" ,$evolucion_txt);

$lee_plantilla=str_replace("-anam_resumenevolucion-",$evolucion_txt.$detalle_evo,$lee_plantilla);



$detalle_allazgo=''; 
$allazgo_rv="select * from cesdb_arextension.dns_hallazgosepicrisis where anam_enlace='".$anam_enlace."'";
$rs_allazgo = $DB_gogess->executec($allazgo_rv,array());
if($rs_allazgo)
	{
		while (!$rs_allazgo->EOF) {
		
		$detalle_allazgo.=$rs_allazgo->fields["hallaepi_descripcion"]."<br>";
		
		$rs_allazgo->MoveNext();
		}
	}	
	
$allazgo_txt=$rs_sihaydata->fields["anam_hallazgos"]."<br>";  

$allazgo_txt=str_replace("\n", "<br>" ,$allazgo_txt);


$lee_plantilla=str_replace("-anam_hallazgos-",$allazgo_txt.$detalle_allazgo,$lee_plantilla);
	   
//=============================================================================
 $lista_standar='anam_resumenclinico,anam_resumentratamiento,anam_condicionegreso,anam_diasestadia,anam_diasincapacidad';
 $lista_standararray=array();
 $lista_standararray=explode(",",$lista_standar);
 
 for($i=0;$i<count($lista_standararray);$i++)
 { 
 $lab_marca=$rs_sihaydata->fields[$lista_standararray[$i]];
 //$lab_marca=genera_x($lab_marca);
 $lee_plantilla=str_replace("-".$lista_standararray[$i]."-",$lab_marca,$lee_plantilla); 
 } 
//=============================================================================

 //diagnosticos
   $datos_diagnostico='';
   $cuentase=0;
   $diagosticos_rv="select * from cesdb_arextension.dns_newepicrisisdiagnosticoanamnesis where anam_enlace='".$anam_enlace."' limit 6";
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
 
 
 
 //diagnosticos2
   $datos_diagnostico='';
   $cuentase=0;
   $diagosticos_rv="select * from cesdb_arextension.dns_newepicrisisdiagnosticoanamnesisegreso where anam_enlace='".$anam_enlace."' limit 6";
   $rs_dgnostico = $DB_gogess->executec($diagosticos_rv,array());
   if($rs_dgnostico)
	{
		while (!$rs_dgnostico->EOF) {
	
		   $cuentase++;
		   
		   $lee_plantilla=str_replace("-diagnosticoeg".$cuentase."-",$rs_dgnostico->fields["diagneg_descripcion"],$lee_plantilla);
		   $lee_plantilla=str_replace("-cieeg".$cuentase."-",$rs_dgnostico->fields["diagneg_cie"],$lee_plantilla);
		   
		   
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
 
 

 $lee_plantilla=str_replace("-anam_causaexterna-", $anam_causaexterna,$lee_plantilla);
 $lee_plantilla=str_replace("-anam_planes-",$anam_planes,$lee_plantilla);
 
 $separa_fecha_hora=explode(" ",$anam_fecharegistro);
 
 $lee_plantilla=str_replace("-anam_fecharegistro-",$separa_fecha_hora[0],$lee_plantilla);
 $lee_plantilla=str_replace("-fechhora-",$separa_fecha_hora[1],$lee_plantilla);
 
 $lee_plantilla=str_replace("-medico-",$nomb_medico,$lee_plantilla);
 $lee_plantilla=str_replace("-codigo-",$usua_ciruc,$lee_plantilla);
 
 
$anam_fechaalta=$rs_sihaydata->fields["anam_fechaalta"];
$anam_horaalta=$rs_sihaydata->fields["anam_horaalta"];

if($anam_fechaalta)
{  
   $lee_plantilla=str_replace("-fechaalta-",$anam_fechaalta,$lee_plantilla);
}
else
{
   $lee_plantilla=str_replace("-fechaalta-",date("Y-m-d"),$lee_plantilla);
}

if($anam_horaalta=='00:00:00')
{
  $anam_horaalta='';
}

if($anam_horaalta)
{
   $lee_plantilla=str_replace("-horaalta-",$anam_horaalta,$lee_plantilla);
}
else
{
   $lee_plantilla=str_replace("-horaalta-",date("H:i"),$lee_plantilla);
}




 
 
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