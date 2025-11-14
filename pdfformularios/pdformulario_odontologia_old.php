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
 include("lib.php");
 
 if(@$table)
 {
 $lista_tbldata=array('gogess_sisfield','gogess_sistable');
 $contenido = file_get_contents(@$director."jason_files/tablas/".$table.".json");
 $gogess_sistable = json_decode($contenido, true);
 }
 
 $objformulario= new  ValidacionesFormulario();
 $objtableform= new templateform();
 
 $objvarios= new util_funciones();
 
 //leer con json
 if(@$table)
 {
 $contenido = file_get_contents(@$director."jason_files/estructura/".$table.".json");
 $gogess_sisfield = json_decode($contenido, true);
 }
 //leer con json 
 

 if(@$table)
  {
  $objtableform->select_templateform(@$table,$DB_gogess);
  }

  @$objformulario->sisfield_arr=$gogess_sisfield;
  @$objformulario->sistable_arr=$gogess_sistable;
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


  //=========================================================================
  
  
  $url="plantillas/form033anversoodontologia.php";
  $lee_plantilla=$objvarios->leer_contenido_completo($url);
  
  $lee_plantilla=str_replace("-centro-",$nomb_centro,$lee_plantilla);
  $lee_plantilla=str_replace("-nombre-",$nombre_paciente,$lee_plantilla);
  $lee_plantilla=str_replace("-apellido-",$apellido_paciente,$lee_plantilla);
  $lee_plantilla=str_replace("-sexo-",$clie_genero,$lee_plantilla);
  $lee_plantilla=str_replace("-hc-",$hc,$lee_plantilla);
  //$lee_plantilla=str_replace("-motivoconsulta-",$anam_motivoconsulta,$lee_plantilla);
  
  $rangoedad_id=0;
  $rangoedad_id=$rs_sihaydata->fields["rangoedad_id"];
  
  $lista_redad="select * from dns_rangoedad";
  $rs_redad = $DB_gogess->executec($lista_redad,array());
  if($rs_redad)
	{
		while (!$rs_redad->EOF) 
		{				  
		   if($rs_redad->fields["rangoed_id"]==$rangoedad_id)
		   {
		   $lee_plantilla=str_replace("-rangoedad_id".$rs_redad->fields["rangoed_id"]."-",'<b>X</b>',$lee_plantilla);
		   }
		   else
		   {
		   $lee_plantilla=str_replace("-rangoedad_id".$rs_redad->fields["rangoed_id"]."-",'',$lee_plantilla);
		   }
		  
		  $rs_redad->MoveNext();
		}
	}	
  
  
  $odonto_motivoconsulta=$rs_sihaydata->fields["odonto_motivoconsulta"];
  $odonto_emferpactual=$rs_sihaydata->fields["odonto_emferpactual"];
  
  
  $lee_plantilla=str_replace("-odonto_motivoconsulta-",$odonto_motivoconsulta,$lee_plantilla);
  $lee_plantilla=str_replace("-odonto_emferpactual-",$odonto_emferpactual,$lee_plantilla);
  
  $odonto_enlace=$rs_sihaydata->fields["odonto_enlace"];
  
  //dns_odontologiaantpf.........
  $datos_rs_dns_odontologiaantpf='';
  $lista_dns_odontologiaantpf="select * from dns_odontologiaantpf where clie_id='".$clie_id."'";
  $rs_dns_odontologiaantpf = $DB_gogess->executec($lista_dns_odontologiaantpf,array());
  if($rs_dns_odontologiaantpf)
	{
		while (!$rs_dns_odontologiaantpf->EOF) {
		
		  $datos_rs_dns_odontologiaantpf.=$rs_dns_odontologiaantpf->fields["oantpf_antecedente"]." ".$rs_dns_odontologiaantpf->fields["oantpf_observacion"].", ";		  
		  $lee_plantilla=str_replace("-oantpf_antecedentex".$rs_dns_odontologiaantpf->fields["oantpf_antecedente"]."-",'<b>X</b>',$lee_plantilla); 
		
		  $rs_dns_odontologiaantpf->MoveNext();
		}
	}	
	
  
  $antecedentes_familiares="select * from dns_antecedentesodonto";
  $rs_af = $DB_gogess->executec($antecedentes_familiares,array());
  if($rs_af)
	{
		while (!$rs_af->EOF) {
		
		     $lee_plantilla=str_replace("-oantpf_antecedentex".$rs_af->fields["anteodo_id"]."-",'',$lee_plantilla); 
		
		  $rs_af->MoveNext();
		}
	}	
	
  $lee_plantilla=str_replace("-oantpf_antecedentex-",$datos_rs_dns_odontologiaantpf,$lee_plantilla);	
  //dns_odontologiaantpf

 
  //signos vitales    
  $odonto_fecharegistro=$rs_sihaydata->fields["odonto_fecharegistro"]; 
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
  
  //EXAMEN DEL SISTEMA ESTOMATOGNÁTICO (DESCRIBIR LA PATOLOGIA DE LA REGION AFECTADA ANOTANDO EL NUMERO)
  
 
  $datos_rs_odonto_gridestomatog='';
  $lista_odonto_gridestomatog="select * from dns_odontologiaestomatognatico where odonto_enlace='".$odonto_enlace."'";
  $rs_odonto_gridestomatog = $DB_gogess->executec($lista_odonto_gridestomatog,array());
  if($rs_odonto_gridestomatog)
	{
		while (!$rs_odonto_gridestomatog->EOF) {
		
		  $datos_rs_odonto_gridestomatog.=$rs_odonto_gridestomatog->fields["oestoma_sistema"]." ".$rs_odonto_gridestomatog->fields["oestoma_observacion"].", ";		  
		  $lee_plantilla=str_replace("-oestoma_sistemax".$rs_odonto_gridestomatog->fields["oestoma_sistema"]."-",'<b>X</b>',$lee_plantilla); 
		
		  $rs_odonto_gridestomatog->MoveNext();
		}
	}	
	
  
  $antecedentes_familiares="select * from dns_sistema";
  $rs_af1 = $DB_gogess->executec($antecedentes_familiares,array());
  if($rs_af1)
	{
		while (!$rs_af1->EOF) {
		
		     $lee_plantilla=str_replace("-oestoma_sistemax".$rs_af1->fields["siste_id"]."-",'',$lee_plantilla); 
		
		  $rs_af1->MoveNext();
		}
	}	
	
  $lee_plantilla=str_replace("-oantpf_antecedentext-",$datos_rs_odonto_gridestomatog,$lee_plantilla);	
  
 
  //EXAMEN DEL SISTEMA ESTOMATOGNÁTICO (DESCRIBIR LA PATOLOGIA DE LA REGION AFECTADA ANOTANDO EL NUMERO)
  
  //INDICADORES DE SALUD BUCAL
  $pl=0;
  $cal=0;
  $gin=0;

  
  
  //dns_gridsaludbucal
  $lista_indice="select * from dns_gridsaludbucal where odonto_enlace='".$odonto_enlace."'";
  $rs_indice = $DB_gogess->executec($lista_indice,array());
  if($rs_indice)
	{
		while (!$rs_indice->EOF) {            
			
			$lee_plantilla=str_replace("-".$rs_indice->fields["gsabucal_piezasdentales"]."-",'X',$lee_plantilla); 
			
			if($rs_indice->fields["gsabucal_piezasdentales"]==16 or $rs_indice->fields["gsabucal_piezasdentales"]==17 or $rs_indice->fields["gsabucal_piezasdentales"]==55)
			{
			   $lee_plantilla=str_replace("-pl16-",$rs_indice->fields["gsabucal_placa"],$lee_plantilla);
			   $pl+=$rs_indice->fields["gsabucal_placa"];
			   $lee_plantilla=str_replace("-cal16-",$rs_indice->fields["gsabucal_calculo"],$lee_plantilla);
			   $cal+=$rs_indice->fields["gsabucal_calculo"];
			   $lee_plantilla=str_replace("-gin16-",$rs_indice->fields["gsabucal_gingivitis"],$lee_plantilla);
			   $gin+=$rs_indice->fields["gsabucal_gingivitis"];
			}  
			
			if($rs_indice->fields["gsabucal_piezasdentales"]==11 or $rs_indice->fields["gsabucal_piezasdentales"]==21 or $rs_indice->fields["gsabucal_piezasdentales"]==51)
			{
			   $lee_plantilla=str_replace("-pl11-",$rs_indice->fields["gsabucal_placa"],$lee_plantilla);
			   $pl+=$rs_indice->fields["gsabucal_placa"];
			   $lee_plantilla=str_replace("-cal11-",$rs_indice->fields["gsabucal_calculo"],$lee_plantilla);
			   $cal+=$rs_indice->fields["gsabucal_calculo"];
			   $lee_plantilla=str_replace("-gin11-",$rs_indice->fields["gsabucal_gingivitis"],$lee_plantilla);
			   $gin+=$rs_indice->fields["gsabucal_gingivitis"];
			}  
			
			if($rs_indice->fields["gsabucal_piezasdentales"]==26 or $rs_indice->fields["gsabucal_piezasdentales"]==67 or $rs_indice->fields["gsabucal_piezasdentales"]==65)
			{
			   $lee_plantilla=str_replace("-pl26-",$rs_indice->fields["gsabucal_placa"],$lee_plantilla);
			   $pl+=$rs_indice->fields["gsabucal_placa"];
			   $lee_plantilla=str_replace("-cal26-",$rs_indice->fields["gsabucal_calculo"],$lee_plantilla);
			   $cal+=$rs_indice->fields["gsabucal_calculo"];
			   $lee_plantilla=str_replace("-gin26-",$rs_indice->fields["gsabucal_gingivitis"],$lee_plantilla);
			   $gin+=$rs_indice->fields["gsabucal_gingivitis"];
			}  
			
			if($rs_indice->fields["gsabucal_piezasdentales"]==36 or $rs_indice->fields["gsabucal_piezasdentales"]==37 or $rs_indice->fields["gsabucal_piezasdentales"]==75)
			{
			   $lee_plantilla=str_replace("-pl36-",$rs_indice->fields["gsabucal_placa"],$lee_plantilla);
			   $pl+=$rs_indice->fields["gsabucal_placa"];
			   $lee_plantilla=str_replace("-cal36-",$rs_indice->fields["gsabucal_calculo"],$lee_plantilla);
			   $cal+=$rs_indice->fields["gsabucal_calculo"];
			   $lee_plantilla=str_replace("-gin36-",$rs_indice->fields["gsabucal_gingivitis"],$lee_plantilla);
			   $gin+=$rs_indice->fields["gsabucal_gingivitis"];
			}  
			
			if($rs_indice->fields["gsabucal_piezasdentales"]==31 or $rs_indice->fields["gsabucal_piezasdentales"]==41 or $rs_indice->fields["gsabucal_piezasdentales"]==71)
			{
			   $lee_plantilla=str_replace("-pl31-",$rs_indice->fields["gsabucal_placa"],$lee_plantilla);
			   $pl+=$rs_indice->fields["gsabucal_placa"];
			   $lee_plantilla=str_replace("-cal31-",$rs_indice->fields["gsabucal_calculo"],$lee_plantilla);
			   $cal+=$rs_indice->fields["gsabucal_calculo"];
			   $lee_plantilla=str_replace("-gin31-",$rs_indice->fields["gsabucal_gingivitis"],$lee_plantilla);
			   $gin+=$rs_indice->fields["gsabucal_gingivitis"];
			}
			
			if($rs_indice->fields["gsabucal_piezasdentales"]==46 or $rs_indice->fields["gsabucal_piezasdentales"]==47 or $rs_indice->fields["gsabucal_piezasdentales"]==85)
			{
			   $lee_plantilla=str_replace("-pl46-",$rs_indice->fields["gsabucal_placa"],$lee_plantilla);
			   $pl+=$rs_indice->fields["gsabucal_placa"];
			   $lee_plantilla=str_replace("-cal46-",$rs_indice->fields["gsabucal_calculo"],$lee_plantilla);
			   $cal+=$rs_indice->fields["gsabucal_calculo"];
			   $lee_plantilla=str_replace("-gin46-",$rs_indice->fields["gsabucal_gingivitis"],$lee_plantilla);
			   $gin+=$rs_indice->fields["gsabucal_gingivitis"];
			}
			
			
  
            $rs_indice->MoveNext();
		}
	}	
	 
  $lee_plantilla=str_replace("-total1-",$pl,$lee_plantilla);
  $lee_plantilla=str_replace("-total2-",$cal,$lee_plantilla);
  $lee_plantilla=str_replace("-total3-",$gin,$lee_plantilla);	
	
  $lista_indice="select * from dns_piezasindice";
  $rs_indice = $DB_gogess->executec($lista_indice,array());
  if($rs_indice)
	{
		while (!$rs_indice->EOF) {            
			
			$lee_plantilla=str_replace("-".$rs_indice->fields["pdental_piezasdentales"]."-",'',$lee_plantilla); 
  
            $rs_indice->MoveNext();
		}
	}	
	
  $lee_plantilla=str_replace("-pl16-","",$lee_plantilla);
  $lee_plantilla=str_replace("-cal16-","",$lee_plantilla);
  $lee_plantilla=str_replace("-gin16-","",$lee_plantilla);	
  
  $lee_plantilla=str_replace("-pl11-","",$lee_plantilla);
  $lee_plantilla=str_replace("-cal11-","",$lee_plantilla);
  $lee_plantilla=str_replace("-gin11-","",$lee_plantilla);

  $lee_plantilla=str_replace("-pl26-","",$lee_plantilla);
  $lee_plantilla=str_replace("-cal26-","",$lee_plantilla);
  $lee_plantilla=str_replace("-gin26-","",$lee_plantilla);  
  
  $lee_plantilla=str_replace("-pl36-","",$lee_plantilla);
  $lee_plantilla=str_replace("-cal36-","",$lee_plantilla);
  $lee_plantilla=str_replace("-gin36-","",$lee_plantilla); 
  
  $lee_plantilla=str_replace("-pl31-","",$lee_plantilla);
  $lee_plantilla=str_replace("-cal31-","",$lee_plantilla);
  $lee_plantilla=str_replace("-gin31-","",$lee_plantilla);  
  
  $lee_plantilla=str_replace("-pl46-","",$lee_plantilla);
  $lee_plantilla=str_replace("-cal46-","",$lee_plantilla);
  $lee_plantilla=str_replace("-gin46-","",$lee_plantilla);      
  //INDICADORES DE SALUD BUCAL
  
  
  //ENFERMEDAD PERIODONTAL
  $odonto_periodontal=0;
  $odonto_periodontal=$rs_sihaydata->fields["odonto_periodontal"];
  
  $lista_redad="select * from dns_opciones";
  $rs_redad = $DB_gogess->executec($lista_redad,array());
  if($rs_redad)
	{
		while (!$rs_redad->EOF) 
		{				  
		   if($rs_redad->fields["opcion_id"]==$odonto_periodontal)
		   {
		     $lee_plantilla=str_replace("-odonto_periodontal".$rs_redad->fields["opcion_id"]."-",'<b>X</b>',$lee_plantilla);
		   }
		   else
		   {
		     $lee_plantilla=str_replace("-odonto_periodontal".$rs_redad->fields["opcion_id"]."-",'',$lee_plantilla);
		   }
		  
		  $rs_redad->MoveNext();
		}
	}	
  //ENFERMEDAD PERIODONTAL 
  
  
  //MAL OCLUSION
  $odonto_periodontal=0;
  $odonto_periodontal=$rs_sihaydata->fields["odonto_maloclusion"];
  
  $lista_redad="select * from dns_opciones";
  $rs_redad = $DB_gogess->executec($lista_redad,array());
  if($rs_redad)
	{
		while (!$rs_redad->EOF) 
		{				  
		   if($rs_redad->fields["opcion_id"]==$odonto_periodontal)
		   {
		     $lee_plantilla=str_replace("-odonto_maloclusion".$rs_redad->fields["opcion_id"]."-",'<b>X</b>',$lee_plantilla);
		   }
		   else
		   {
		     $lee_plantilla=str_replace("-odonto_maloclusion".$rs_redad->fields["opcion_id"]."-",'',$lee_plantilla);
		   }
		  
		  $rs_redad->MoveNext();
		}
	}	
  //MAL OCLUSION  
  

  //FLUOROSIS
  $odonto_periodontal=0;
  $odonto_periodontal=$rs_sihaydata->fields["odonto_fluorosis"];
  
  $lista_redad="select * from dns_opciones";
  $rs_redad = $DB_gogess->executec($lista_redad,array());
  if($rs_redad)
	{
		while (!$rs_redad->EOF) 
		{				  
		   if($rs_redad->fields["opcion_id"]==$odonto_periodontal)
		   {
		     $lee_plantilla=str_replace("-odonto_fluorosis".$rs_redad->fields["opcion_id"]."-",'<b>X</b>',$lee_plantilla);
		   }
		   else
		   {
		     $lee_plantilla=str_replace("-odonto_fluorosis".$rs_redad->fields["opcion_id"]."-",'',$lee_plantilla);
		   }
		  
		  $rs_redad->MoveNext();
		}
	}	
  //FLUOROSIS
  
  $odonto_indicec=$rs_sihaydata->fields["odonto_fluorosis"];
  $odonto_indicep=$rs_sihaydata->fields["odonto_indicep"];
  $odonto_indiceo=$rs_sihaydata->fields["odonto_indiceo"];
  $odonto_total=$rs_sihaydata->fields["odonto_total"];
  
  $odonto_indicec1=$rs_sihaydata->fields["odonto_indicec1"];
  $odonto_indicee=$rs_sihaydata->fields["odonto_indicee"];
  $odonto_indiceo1=$rs_sihaydata->fields["odonto_indiceo1"];
  $odonto_total1=$rs_sihaydata->fields["odonto_total1"];
  
  $lee_plantilla=str_replace("-odonto_indicec-",$odonto_indicec,$lee_plantilla);
  $lee_plantilla=str_replace("-odonto_indicep-",$odonto_indicep,$lee_plantilla);
  $lee_plantilla=str_replace("-odonto_indiceo-",$odonto_indiceo,$lee_plantilla);
  $lee_plantilla=str_replace("-odonto_total-",$odonto_total,$lee_plantilla);
  
  $lee_plantilla=str_replace("-odonto_indicec1-",$odonto_indicec1,$lee_plantilla);
  $lee_plantilla=str_replace("-odonto_indicee-",$odonto_indicee,$lee_plantilla);
  $lee_plantilla=str_replace("-odonto_indiceo1-",$odonto_indiceo1,$lee_plantilla);
  $lee_plantilla=str_replace("-odonto_total1-",$odonto_total1,$lee_plantilla);
   
  $lee_plantilla=str_replace("-medico-",$nomb_medico,$lee_plantilla);
  
  
  //PLANES DE DIAGNÓSTICO, TERAPÉUTICO Y EDUCACIONAL
  
  $datos_rs_dns_odontologiaplandiganostico='';
  $lista_dns_odontologiaplandiganostico="select * from dns_odontologiaplandiganostico where odonto_enlace='".$odonto_enlace."'";
  $rs_dns_odontologiaplandiganostico = $DB_gogess->executec($lista_dns_odontologiaplandiganostico,array());
  if($rs_dns_odontologiaplandiganostico)
	{
		while (!$rs_dns_odontologiaplandiganostico->EOF) {
		
		  $datos_rs_dns_odontologiaplandiganostico.=$rs_dns_odontologiaplandiganostico->fields["plandiag_tipo"]." ".$rs_dns_odontologiaplandiganostico->fields["plandiag_observacion"].", ";		  
		  $lee_plantilla=str_replace("-plandiag_tipox".$rs_dns_odontologiaplandiganostico->fields["plandiag_tipo"]."-",'<b>X</b>',$lee_plantilla); 
		
		  $rs_dns_odontologiaplandiganostico->MoveNext();
		}
	}	
	
  
  $antecedentes_familiares="select * from dns_tipoplan";
  $rs_af1 = $DB_gogess->executec($antecedentes_familiares,array());
  if($rs_af1)
	{
		while (!$rs_af1->EOF) {
		
		     $lee_plantilla=str_replace("-plandiag_tipox".$rs_af1->fields["tipplan_id"]."-",'',$lee_plantilla); 
		
		  $rs_af1->MoveNext();
		}
	}	
	
  $lee_plantilla=str_replace("-dns_odontologiaplandiganostico-",$datos_rs_dns_odontologiaplandiganostico,$lee_plantilla);	
  
  
  //PLANES DE DIAGNÓSTICO, TERAPÉUTICO Y EDUCACIONAL
  
  
  
  //diagnosticos
   $datos_diagnostico='';
   $cuentase=0;
   $diagosticos_rv="select * from dns_diagnosticoodontologia where odonto_enlace='".$odonto_enlace."' limit 6";
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

  $odonto_fecharegistro=$rs_sihaydata->fields["odonto_fecharegistro"];  
  $lee_plantilla=str_replace("-odonto_fecharegistro-",$odonto_fecharegistro,$lee_plantilla); 
 
  $odonto_fechaproximases=$rs_sihaydata->fields["odonto_fechaproximases"];  
  $lee_plantilla=str_replace("-odonto_fechaproximases-",$odonto_fechaproximases,$lee_plantilla);
 
  $lee_plantilla=str_replace("-usua_id-",$nomb_medico,$lee_plantilla);
  
  //odontograma
  
  $nlace_valor=$rs_sihaydata->fields["odonto_enlace"];
  $clie_id=$rs_sihaydata->fields["clie_id"];
  
 $odonto_val=''; 
 $odonto_val.='<table width="550" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>	
	<table width="275" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:7px; font-weight:bold" width="12" >RECESI&Oacute;N</td>';

		$despliega='';
		$despliega=genera_pieza(1,1,1,1,$clie_id,$nlace_valor,$DB_gogess,'desc');
		$odonto_val.=$despliega;

   $odonto_val.='</tr>
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:7px; font-weight:bold" width="12" >MOVILIDAD</td>';

		$despliega='';
		$despliega=genera_pieza(1,2,1,1,$clie_id,$nlace_valor,$DB_gogess,'desc');
		$odonto_val.=$despliega;

   $odonto_val.='</tr>
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:7px; font-weight:bold" width="12" >VESTIBULAR</td>';

		$despliega='';
		$despliega=genera_pieza(1,3,1,2,$clie_id,$nlace_valor,$DB_gogess,'desc');
		$odonto_val.=$despliega;

    $odonto_val.='</tr>
    </table>
	<br>
	<table width="275" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:7px; font-weight:bold" width="12" >LINGUAL</td>';

		$despliega='';
		$despliega=genera_pieza(1,4,1,2,$clie_id,$nlace_valor,$DB_gogess,'desc');
		$odonto_val.=$despliega;

   $odonto_val.='</tr>
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:7px; font-weight:bold" width="12"  >LINGUAL</td>';

		$despliega='';
		$despliega=genera_pieza(1,4,2,2,$clie_id,$nlace_valor,$DB_gogess,'desc');
		$odonto_val.=$despliega;
   $odonto_val.='</tr>      
    </table><br>	
	<table width="275" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:7px; font-weight:bold" width="12" >VESTIBULAR</td>';

		$despliega='';
		$despliega=genera_pieza(1,3,2,2,$clie_id,$nlace_valor,$DB_gogess,'desc');
		$odonto_val.=$despliega;

    $odonto_val.='</tr>
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:7px; font-weight:bold" width="12" >MOVILIDAD</td>';

		$despliega='';
		$despliega=genera_pieza(1,2,2,1,$clie_id,$nlace_valor,$DB_gogess,'desc');
		$odonto_val.=$despliega;

      $odonto_val.='</tr>
	  <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:7px; font-weight:bold" width="12" >RECESI&Oacute;N</td>';

		$despliega='';
		$despliega=genera_pieza(1,1,2,1,$clie_id,$nlace_valor,$DB_gogess,'desc');
		$odonto_val.=$despliega;

     $odonto_val.='</tr>
    </table>
	</td>
    <td><table width="275" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:7px; font-weight:bold" width="12" >RECESI&Oacute;N</td>';

		$despliega='';
		$despliega=genera_pieza(2,1,1,1,$clie_id,$nlace_valor,$DB_gogess,'asc');
		$odonto_val.=$despliega;
	
   $odonto_val.='</tr>
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:7px; font-weight:bold" width="12" >MOVILIDAD</td>';

		$despliega='';
		$despliega=genera_pieza(2,2,1,1,$clie_id,$nlace_valor,$DB_gogess,'asc');
		$odonto_val.=$despliega;

     $odonto_val.='</tr>
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:7px; font-weight:bold" width="12" >VESTIBULAR</td>';

		$despliega='';
		$despliega=genera_pieza(2,3,1,2,$clie_id,$nlace_valor,$DB_gogess,'asc');
		$odonto_val.=$despliega;

    $odonto_val.='</tr>
    </table>
	<br>
      <table width="275" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:7px; font-weight:bold" width="12" >LINGUAL</td>';
   
		$despliega='';
		$despliega=genera_pieza(2,4,1,2,$clie_id,$nlace_valor,$DB_gogess,'asc');
		$odonto_val.=$despliega;

     $odonto_val.='</tr>
        <tr>
          <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:7px; font-weight:bold" width="12" >LINGUAL</td>';
  
		$despliega='';
		$despliega=genera_pieza(2,4,2,2,$clie_id,$nlace_valor,$DB_gogess,'asc');
		$odonto_val.=$despliega;

      $odonto_val.='</tr>
      </table><br>
      <table  width="275" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:7px; font-weight:bold" width="12" >VESTIBULAR</td>';
    
		$despliega='';
		$despliega=genera_pieza(2,3,2,2,$clie_id,$nlace_valor,$DB_gogess,'asc');
		$odonto_val.=$despliega;
	
      $odonto_val.='</tr>
        <tr>
          <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:7px; font-weight:bold" width="12" >MOVILIDAD</td>';
 
		$despliega='';
		$despliega=genera_pieza(2,2,2,1,$clie_id,$nlace_valor,$DB_gogess,'asc');
		$odonto_val.=$despliega;

        $odonto_val.='</tr>
        <tr>
          <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:7px; font-weight:bold" width="12" >RECESI&Oacute;N</td>';
          
		$despliega='';
		$despliega=genera_pieza(2,1,2,1,$clie_id,$nlace_valor,$DB_gogess,'asc');
		$odonto_val.=$despliega;
	
        $odonto_val.='</tr>
      </table>
	  </td>
  </tr>
</table>';
  
  //odontograma

$lee_plantilla=str_replace("-odonto-",$odonto_val,$lee_plantilla);


$comprobantepdf=$lee_plantilla;
 
$xml="ODONTOLOGIA";
$dompdf = new DOMPDF();
$dompdf->set_paper('A4', 'portrait');
$dompdf->load_html($comprobantepdf, 'UTF-8');
$dompdf->render();
$font = Font_Metrics::get_font("helvetica", "bold");
$canvas = $dompdf->get_canvas();
$footer = $canvas->open_object();


$canvas->close_object();
$canvas->add_object($footer, "all");

$dompdf->stream($xml."_".$hc."_".$separa_fecha_hora[0].".pdf");


}
?>