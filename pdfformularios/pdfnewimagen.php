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
  
  function genera_x($valor)
  {
    $marca='';
	if($valor==1)
	{
	 $marca='<b>X</b>';
	}
	else
	{
	 $marca='&nbsp;';	
	}
	
	return $marca;
  }
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

$conve_id=$rs_dcliente->fields["conve_id"]; 
$nac_id=$rs_dcliente->fields["nac_id"];

 

$table=$rs_tabla->fields["tab_name"];  
$campo_primariodata=$rs_tabla->fields["tab_campoprimario"]; 
//$busca_sihaydata="select * from ".$table." where atenc_id=? and clie_id=?";
$busca_sihaydata="select * from ".$table." where  ".$campo_primariodata."=?";
$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array($valor_id));

$nomb_centro='';
$nomb_medico='';
$nomb_medicoci='';
$nomb_centro=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre","where centro_id=",$rs_sihaydata->fields["centro_id"],$DB_gogess);
$nomb_medico=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido","where usua_id=",$rs_sihaydata->fields["usua_id"],$DB_gogess);
$usua_codigo=$objformulario->replace_cmb("app_usuario","usua_id,usua_codigo","where usua_id=",$rs_sihaydata->fields["usua_id"],$DB_gogess);
$nomb_medicoci=$objformulario->replace_cmb("app_usuario","usua_id,usua_ciruc","where usua_id=",$rs_sihaydata->fields["usua_id"],$DB_gogess);

$uni_codiog='';
$uni_codiog=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_codigo","where centro_id=",1,$DB_gogess);
  //=========================================================================
  
  
  $url="plantillas/newimagen_solicitud.php";
  $lee_plantilla=$objvarios->leer_contenido_completo($url);
  
$genero_valor='';
$genero_valor=$objvarios->seleccion_generonombre($clie_genero);
$lee_plantilla=str_replace("-sexo-",$genero_valor,$lee_plantilla);

$institucion_valor='';
$institucion_valor=$objvarios->selecciona_institucion($conve_id);
$lee_plantilla=str_replace("-institucion-",$institucion_valor,$lee_plantilla);

$nacionalidad_valor='';
$nacionalidad_valor=$objvarios->selecciona_nacionalidad($nac_id,$DB_gogess);
$lee_plantilla=str_replace("-nac_id-",$nacionalidad_valor,$lee_plantilla);
  
  $lee_plantilla=str_replace("-centro-",$nomb_centro,$lee_plantilla);
  $lee_plantilla=str_replace("-nombre-",$nombre_paciente,$lee_plantilla);
  $lee_plantilla=str_replace("-apellido-",$apellido_paciente,$lee_plantilla);
  $lee_plantilla=str_replace("-sexo-",$clie_genero,$lee_plantilla);
  $lee_plantilla=str_replace("-hc-",$hc,$lee_plantilla);
  $lee_plantilla=str_replace("-hcpinos-",$hcpinos,$lee_plantilla);
  $lee_plantilla=str_replace("-motivoconsulta-",$anam_motivoconsulta,$lee_plantilla);
  
    $lee_plantilla=str_replace("-ucodigo-",$uni_codiog,$lee_plantilla);
  
 

  $num_mes=array();
  $num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_sihaydata->fields["imgag_fecharegistro"]);
  $lee_plantilla=str_replace("-edad-",$num_mes["anio"],$lee_plantilla);
  
  
  if($num_mes["anio"]>0)
  {
       $lee_plantilla=str_replace("-cea-","X",$lee_plantilla);
  }
  else
  {  
	  if($num_mes["mes"]>0)
	  {
		 $lee_plantilla=str_replace("-cem-","X",$lee_plantilla);
	  }
      else
	  {
	      $lee_plantilla=str_replace("-ced-","X",$lee_plantilla);	  
	  }  
  }

  $lee_plantilla=str_replace("-cea-","",$lee_plantilla);
  $lee_plantilla=str_replace("-cem-","",$lee_plantilla);
  $lee_plantilla=str_replace("-ced-","",$lee_plantilla);


  
 
 $prob_codigo=$objformulario->replace_cmb("cesdb_arcombos.app_provincia","prob_codigo,prob_nombre","where prob_codigo=",$rs_sihaydata->fields["prob_codigo"],$DB_gogess);
 $lee_plantilla=str_replace("-prob_codigo-",$prob_codigo,$lee_plantilla);
 
 $cant_codigo=$objformulario->replace_cmb("cesdb_arcombos.app_canton","cant_codigo,cant_nombre","where cant_codigo=",$rs_sihaydata->fields["cant_codigo"],$DB_gogess);
 $lee_plantilla=str_replace("-cant_codigo-",$cant_codigo,$lee_plantilla);
 
 $imgag_parroquia=$rs_sihaydata->fields["imgag_parroquia"];
 $lee_plantilla=str_replace("-imgag_parroquia-",$imgag_parroquia,$lee_plantilla);
 
 
 $clie_rucci=$rs_dcliente->fields["clie_rucci"];
 $lee_plantilla=str_replace("-cedula-",$clie_rucci,$lee_plantilla);
 
 $imgag_fecharegistro=$rs_sihaydata->fields["imgag_fecharegistro"];
 $lee_plantilla=str_replace("-imgag_fecharegistro-",$imgag_fecharegistro,$lee_plantilla);
 
 $imgag_fechatoma=$rs_sihaydata->fields["imgag_fechatoma"];
 $lee_plantilla=str_replace("-imgag_fechatoma-",$imgag_fechatoma,$lee_plantilla);
 
 
 $imgag_cama=$rs_sihaydata->fields["imgag_cama"];
 $lee_plantilla=str_replace("-imgag_cama-",$imgag_cama,$lee_plantilla);
 
 $imgag_servicio=$rs_sihaydata->fields["imgag_servicio"];
 $lee_plantilla=str_replace("-imgag_servicio-",$imgag_servicio,$lee_plantilla);
  
 $imgag_sala=$rs_sihaydata->fields["imgag_sala"];
 $lee_plantilla=str_replace("-imgag_sala-",$imgag_sala,$lee_plantilla); 
 
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
 
 ///edad actual
 
 	$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_sihaydata->fields["imgag_fecharegistro"]);
	$lee_plantilla=str_replace("-edad-",$num_mes["anio"],$lee_plantilla);
 
 //edad actual
 
 $prio_id=0;
 $prio_id=$rs_sihaydata->fields["prio_id"];
  
  $lista_cmb="select * from dns_prioridad";
  $rs_cmb = $DB_gogess->executec($lista_cmb,array());
  if($rs_cmb)
	{
		while (!$rs_cmb->EOF) 
		{				  
		   if($rs_cmb->fields["prio_id"]==$prio_id)
		   {
		   $lee_plantilla=str_replace("-prio_id".$rs_cmb->fields["prio_id"]."-",'<b>X</b>',$lee_plantilla);
		   }
		   else
		   {
		   $lee_plantilla=str_replace("-prio_id".$rs_cmb->fields["prio_id"]."-",'',$lee_plantilla);
		   }
		  
		  $rs_cmb->MoveNext();
		}
	}	
	
/////////////////////////// sedacion si no
 
 
 $imgag_sedacion=0;
 $imgag_sedacion=$rs_sihaydata->fields["imgag_sedacion"];
  
  $lista_cmb="select * from gogess_sino";
  $rs_cmb = $DB_gogess->executec($lista_cmb,array());
  if($rs_cmb)
	{
		while (!$rs_cmb->EOF) 
		{				  
		   if($rs_cmb->fields["value"]==$imgag_sedacion)
		   {
		   $lee_plantilla=str_replace("-imgag_sedacion".$rs_cmb->fields["imgag_sedacion"]."-",'<b>X</b>',$lee_plantilla);
		   }
		   else
		   {
		   $lee_plantilla=str_replace("-imgag_sedacion".$rs_cmb->fields["imgag_sedacion"]."-",'',$lee_plantilla);
		   }
		  
		  $rs_cmb->MoveNext();
		}
	}	
///////////////////// fin si no

 $imgag_contaminado=0;
 $imgag_contaminado=$rs_sihaydata->fields["imgag_contaminado"];
  
  $lista_cmb="select * from gogess_sino";
  $rs_cmb = $DB_gogess->executec($lista_cmb,array());
  if($rs_cmb)
	{
		while (!$rs_cmb->EOF) 
		{				  
		   if($rs_cmb->fields["value"]==$imgag_contaminado)
		   {
		   $lee_plantilla=str_replace("-imgag_contaminado".$rs_cmb->fields["imgag_contaminado"]."-",'<b>X</b>',$lee_plantilla);
		   }
		   else
		   {
		   $lee_plantilla=str_replace("-imgag_contaminado".$rs_cmb->fields["imgag_contaminado"]."-",'',$lee_plantilla);
		   }
		  
		  $rs_cmb->MoveNext();
		}
	}	



  
 //check
 
 //$lista_standar='imgag_rxconvencional,imgag_tomografia,imgag_resonacia,imgag_ecografia,imgag_procedimiento,imgag_otros,imgag_puedemovilizarse,imgag_puederetirarse,imgag_medicopresente,imgag_tomacama';
 $lista_standar='imgag_emergencia,imgag_consulta,imgag_hospital,imgag_rxconvencional,imgag_rxportatil,imgag_tomografia,imgag_mamografia,imgag_resonacia,imgag_ecografia,imgag_procedimiento,imgag_otros';
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
  
 //check
 
 
 //texto
 
 $lista_standar='imgag_describir,imgag_motivo,imgag_resumenclinico';
 $lista_standararray=array();
 $lista_standararray=explode(",",$lista_standar);
 
 for($i=0;$i<count($lista_standararray);$i++)
 { 
	 $lab_marca=$rs_sihaydata->fields[$lista_standararray[$i]];
	 $lee_plantilla=str_replace("-".$lista_standararray[$i]."-",$lab_marca,$lee_plantilla);  
 }
 
 //texto
 
 //diagnostico
 
 //diagnosticos
   
   $imgag_enlace=$rs_sihaydata->fields["imgag_enlace"];
   
   $datos_diagnostico='';
   $cuentase=0;
   $diagosticos_rv="select * from dns_diagnosticonewimagensolicitud where imgag_enlace='".$imgag_enlace."' limit 6";
   $rs_dgnostico = $DB_gogess->executec($diagosticos_rv,array());
   if($rs_dgnostico)
	{
		while (!$rs_dgnostico->EOF) {
	
		   $cuentase++;
		   
		   $lee_plantilla=str_replace("-diagnostico".$cuentase."-",utf8_decode($rs_dgnostico->fields["diagn_descripcion"]),$lee_plantilla);
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
 
 //diagnostico
 
 $imgag_fecharegistro=$rs_sihaydata->fields["imgag_fecharegistro"];
 $separa_fecha_hora=explode(" ",$imgag_fecharegistro);
 $lee_plantilla=str_replace("-imgag_date-",$separa_fecha_hora[0],$lee_plantilla);
 $lee_plantilla=str_replace("-fechhora-",$separa_fecha_hora[1],$lee_plantilla);
 $lee_plantilla=str_replace("-medico-",$nomb_medico,$lee_plantilla);
 $lee_plantilla=str_replace("-medicoci-",$nomb_medicoci,$lee_plantilla);
 
 //$lee_plantilla=str_replace("-codemed-",$usua_codigo,$lee_plantilla);

 
 
$comprobantepdf=$lee_plantilla;
  
$xml="IMAGE";
$dompdf = new DOMPDF();
$dompdf->set_paper('A4', 'portrait');
$dompdf->load_html($comprobantepdf, 'UTF-8');
$dompdf->render();
$font = Font_Metrics::get_font("helvetica", "bold");
$canvas = $dompdf->get_canvas();
$footer = $canvas->open_object();

$canvas->close_object();
$canvas->add_object($footer, "all");
$dompdf->stream($xml."_".$hc."_".date("Y-m-d").$valor_id.".pdf");

}
?>