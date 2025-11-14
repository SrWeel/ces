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
$nomb_centro=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombreprint","where centro_id=",1,$DB_gogess);
$nomb_medico=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido","where usua_id=",$rs_sihaydata->fields["usua_id"],$DB_gogess);

$usua_ciruc='';
$usua_ciruc=$objformulario->replace_cmb("app_usuario","usua_id,usua_ciruc","where usua_id=",$rs_sihaydata->fields["usua_id"],$DB_gogess);


  //=========================================================================
  
  
  $url="plantillas/laboratorio010B_informe.php";
  $lee_plantilla=$objvarios->leer_contenido_completo($url);
  
  $lee_plantilla=str_replace("-empresa-","PICHINCHA HUMANA",$lee_plantilla);
  $lee_plantilla=str_replace("-centro-",$nomb_centro,$lee_plantilla);
  $lee_plantilla=str_replace("-nombre-",$nombre_paciente,$lee_plantilla);
  $lee_plantilla=str_replace("-apellido-",$apellido_paciente,$lee_plantilla);
  
  
$genero_valor='';
$genero_valor=$objvarios->seleccion_generonombre($clie_genero);
$lee_plantilla=str_replace("-sexo-",$genero_valor,$lee_plantilla);

$institucion_valor='';
$institucion_valor=$objvarios->selecciona_institucion($conve_id);
$lee_plantilla=str_replace("-institucion-",$institucion_valor,$lee_plantilla);

$nacionalidad_valor='';
$nacionalidad_valor=$objvarios->selecciona_nacionalidad($nac_id,$DB_gogess);
$lee_plantilla=str_replace("-nac_id-",$nacionalidad_valor,$lee_plantilla);

$lee_plantilla=str_replace("-cedulamedico-",$usua_ciruc,$lee_plantilla);  

///=============
$logo = $objformulario->replace_cmb("app_empresa", "emp_id,emp_logoreporte", "where emp_id=", 1, $DB_gogess);
$logoc ='<img src="../archivo/'.$logo.'" alt="125x125" width="180px">';

$emp_nombre = $objformulario->replace_cmb("app_empresa", "emp_id,emp_nombre", "where emp_id=", 1, $DB_gogess);
$emp_piedepagina = $objformulario->replace_cmb("app_empresa", "emp_id,emp_piedepagina", "where emp_id=", 1, $DB_gogess);
$emp_logo = $objformulario->replace_cmb("app_empresa", "emp_id,emp_logo", "where emp_id=", 1, $DB_gogess);
  
  
  //cabecera y pie de pagina
$lee_plantilla = str_replace("-graficologo-", $logoc, $lee_plantilla);
$lee_plantilla = str_replace("-empresanombre-", $emp_nombre, $lee_plantilla);
$lee_plantilla = str_replace("-piedepagina-", $emp_piedepagina, $lee_plantilla);
$lee_plantilla = str_replace("-logofondo-", $emp_logo, $lee_plantilla);
//==============

$lee_plantilla=str_replace("-hcpinos-",$hcpinos,$lee_plantilla);
   ///edad actual
 
 	$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_sihaydata->fields["imgag_fecharegistro"]);
	$lee_plantilla=str_replace("-edad-",$num_mes["anio"],$lee_plantilla);
 
 //edad actual
  
  //$lee_plantilla=str_replace("-edad-",$clie_genero,$lee_plantilla);
  $lee_plantilla=str_replace("-hc-",$hc,$lee_plantilla);
  $lee_plantilla=str_replace("-motivoconsulta-",$anam_motivoconsulta,$lee_plantilla);
  
  $lee_plantilla=str_replace("-fechana-",$rs_dcliente->fields["clie_fechanacimiento"],$lee_plantilla); 
  $num_mes=array();
  $num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_sihaydata->fields["lab_fecharegistro"]);
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
  
  
  //obtiene====================================solicitud
  
  
  $datos_solicitud="select * from dns_laboratorio where lab_id='".$rs_sihaydata ->fields["lab_id"]."'";
  $rs_solicitud = $DB_gogess->executec($datos_solicitud,array());
  
  //obtiene====================================solicitud
  
 
 $prob_codigo=$objformulario->replace_cmb("cesdb_arcombos.app_provincia","prob_codigo,prob_nombre","where prob_codigo=",$rs_sihaydata->fields["prob_codigo"],$DB_gogess);
 $lee_plantilla=str_replace("-prob_codigo-",$prob_codigo,$lee_plantilla);
 
 $cant_codigo=$objformulario->replace_cmb("cesdb_arcombos.app_canton","cant_codigo,cant_nombre","where cant_codigo=",$rs_sihaydata->fields["cant_codigo"],$DB_gogess);
 $lee_plantilla=str_replace("-cant_codigo-",$cant_codigo,$lee_plantilla);
 
 $labinfor_parroquia=$rs_sihaydata->fields["labinfor_parroquia"];
 $lee_plantilla=str_replace("-labinfor_parroquia-",$labinfor_parroquia,$lee_plantilla); 
 
  
 $clie_rucci=$rs_dcliente->fields["clie_rucci"];
 $lee_plantilla=str_replace("-cedula-",$clie_rucci,$lee_plantilla);
 
 $lab_fechasolicitud=$rs_sihaydata->fields["labinfor_fecharegistro"];
 $lee_plantilla=str_replace("-labinfor_fecharegistro-",$lab_fechasolicitud,$lee_plantilla);
 
 $lab_cama=$rs_solicitud->fields["lab_cama"];
 $lee_plantilla=str_replace("-lab_cama-",$lab_cama,$lee_plantilla);
 
 $lab_servicio=$rs_solicitud->fields["lab_servicio"];
 $lee_plantilla=str_replace("-lab_servicio-",$lab_servicio,$lee_plantilla);
  
 $lab_sala=$rs_solicitud->fields["lab_sala"];
 $lee_plantilla=str_replace("-lab_sala-",$lab_sala,$lee_plantilla); 
 
 
 
  
	
	//persona solicitante	
	$solicitante=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido","where usua_id=",$rs_solicitud->fields["usua_id"],$DB_gogess);     	
	
	if($rs_sihaydata->fields["labinfor_solicitanteexterno"])
	{
	  $labinfor_solicitanteexterno=$rs_sihaydata->fields["labinfor_solicitanteexterno"];
	  $lee_plantilla=str_replace("-labinfor_solicitanteexterno-",$labinfor_solicitanteexterno,$lee_plantilla);	
	}
	else
	{
	   $lee_plantilla=str_replace("-labinfor_solicitanteexterno-",$solicitante,$lee_plantilla);
	}
	//persona solicitante
	
  //hematologia==========================
  $rebicion_hemato="select * from dns_gridhematologico where labinfor_enlace='".$rs_sihaydata->fields["labinfor_enlace"]."'";
  $rs_hemato = $DB_gogess->executec($rebicion_hemato,array());
  if($rs_hemato)
	{
		while (!$rs_hemato->EOF) {
			  
			  
			  
		  $lee_plantilla=str_replace("-tipohem_id".$rs_hemato->fields["ghemato_tipo"]."-",$rs_hemato->fields["ghemato_valor"],$lee_plantilla);
		
		  $rs_hemato->MoveNext();
		}
	}	
   
   $rebicion_hemato="select * from dns_tiposhematologico";
  $rs_hemato = $DB_gogess->executec($rebicion_hemato,array());
  if($rs_hemato)
	{
		while (!$rs_hemato->EOF) {
			  
		  $lee_plantilla=str_replace("-tipohem_id".$rs_hemato->fields["tipohem_id"]."-",'',$lee_plantilla);
		
		  $rs_hemato->MoveNext();
		}
	}	
	
	
	
	$labinfor_hematologicoobs=$rs_sihaydata->fields["labinfor_hematologicoobs"];
	$lee_plantilla=str_replace("-labinfor_hematologicoobs-",$labinfor_hematologicoobs,$lee_plantilla); 	
	
	
	//diagnosticos
   $datos_diagnostico='';
   $cuentase=0;
   $diagosticos_rv="select * from cesdb_arextension.dns_diagnosticolaboratorioinforme where labinfor_enlace='".$rs_sihaydata->fields["labinfor_enlace"]."' limit 2";
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
 
 //////servicio
	
 $serlab_id=0;
 $serlab_id=$rs_sihaydata->fields["serlabi_id"];
  
  $lista_cmb="select * from dns_serviciolab";
  $rs_cmb = $DB_gogess->executec($lista_cmb,array());
  if($rs_cmb)
	{
		while (!$rs_cmb->EOF) 
		{				  
		   if($rs_cmb->fields["serlab_id"]==$serlab_id)
		   {
		   $lee_plantilla=str_replace("-serlab_id".$rs_cmb->fields["serlab_id"]."-",'<b>X</b>',$lee_plantilla);
		   }
		   else
		   {
		   $lee_plantilla=str_replace("-serlab_id".$rs_cmb->fields["serlab_id"]."-",'',$lee_plantilla);
		   }
		  
		  $rs_cmb->MoveNext();
		}
	}	
 
	
 $labinfor_especialidad=$rs_sihaydata->fields["labinfor_especialidad"];
 $lee_plantilla=str_replace("-labinfor_especialidad-",$labinfor_especialidad,$lee_plantilla); 	
 
 $labinfor_cama=$rs_sihaydata->fields["labinfor_cama"];
 $lee_plantilla=str_replace("-labinfor_cama-",$labinfor_cama,$lee_plantilla);
 
 $labinfor_servicio=$rs_sihaydata->fields["labinfor_servicio"];
 $lee_plantilla=str_replace("-labinfor_servicio-",$labinfor_servicio,$lee_plantilla);
  
 $labinfor_sala=$rs_sihaydata->fields["labinfor_sala"];
 $lee_plantilla=str_replace("-labinfor_sala-",$labinfor_sala,$lee_plantilla);
 
 $labinfor_especialidad=$rs_sihaydata->fields["labinfor_especialidad"];
 $lee_plantilla=str_replace("-labinfor_especialidad-",$labinfor_especialidad,$lee_plantilla); 
 
 
 $prio_id=0;
 $prio_id=$rs_sihaydata->fields["prioi_id"];
  
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
	
  //hematologia=========================
  
  $labinfor_personarecibe=$rs_sihaydata->fields["labinfor_personarecibe"];
  
  if($labinfor_personarecibe=='')
  {
      $lee_plantilla=str_replace("-labinfor_personarecibe-",$nombre_paciente." ".$apellido_paciente,$lee_plantilla); 
  
  }
  
 //copro=======
 $lista_standar='labinfor_color,labinfor_consist,labinfor_ph,labinfor_hempglobina,labinfor_glob_rojos,labinfor_polimorfos,labinfor_esporas,labinfor_micelios,labinfor_moco,labinfor_fibras,labinfor_almidon,labinfor_grasa,labinfor_coprolootros,labinfor_densidad,labinfor_phuro,labinfor_proteina,labinfor_glucosa,labinfor_cetona,labinfor_hemoglobina,labinfor_bilirrubina,labinfor_urobilinogeno,labinfor_leucocitosem,labinfor_piocitospc,labinfor_eritrocitospc,labinfor_celulasaltas,labinfor_bacterias,labinfor_hongos,labinfor_moco1,labinfor_cristales,labinfor_cilindros,labinfor_parasitos,labinfor_gram,labinfor_nitrito,labinfor_leucocitospc,labinfor_vdrl,labinfor_aglufebriles,labinfor_latex,labinfor_asto,labinfor_bacteriologia,labinfor_varios,labinfor_serologia,labinfor_fecharecibo,labinfor_personarecibe,labinfor_otros';
 $lista_standararray=array();
 $lista_standararray=explode(",",$lista_standar);
 
 for($i=0;$i<count($lista_standararray);$i++)
 { 
 $lab_marca=$rs_sihaydata->fields[$lista_standararray[$i]];
 //$lab_marca=genera_x($lab_marca);
 $lee_plantilla=str_replace("-".$lista_standararray[$i]."-",$lab_marca,$lee_plantilla); 
 } 
  
  //copro=======
  
  
  
 

  
 $lab_bactmuestra=$rs_sihaydata->fields["lab_bactmuestra"];
 $lee_plantilla=str_replace("-lab_bactmuestra-",$lab_bactmuestra,$lee_plantilla); 
 
 $lab_otros=$rs_sihaydata->fields["lab_otros"];
 $lee_plantilla=str_replace("-lab_otros-",$lab_otros,$lee_plantilla); 
 
  
 $lee_plantilla=str_replace("-anam_planes-",$anam_planes,$lee_plantilla);
 
 $lab_fecharegistro=$rs_sihaydata->fields["labinfor_fecharegistro"];
 $separa_fecha_hora=explode(" ",$lab_fecharegistro);
 $lee_plantilla=str_replace("-lab_fecharegistro-",$separa_fecha_hora[0],$lee_plantilla);
 $lee_plantilla=str_replace("-fechhora-",$separa_fecha_hora[1],$lee_plantilla);
 $lee_plantilla=str_replace("-medico-",$nomb_medico,$lee_plantilla);
 
 
 
 
  $lista_proto="select * from dns_gridprotozoarios where labinfor_enlace='".$rs_sihaydata->fields["labinfor_enlace"]."'";
  $rs_proto= $DB_gogess->executec($lista_proto,array());
  $li_proto='';
  if($rs_proto)
	{
		while (!$rs_proto->EOF) {
			  
		   $li_proto.='<tr>
                        <td  valign="top" bgcolor="#FFFFFF" class="borde_all css_7"><center>'.$rs_proto->fields["gproto_protozoarios"].'</center></td>
                        <td  valign="top" bgcolor="#FFFFFF" class="borde_all css_7"><center>'.$rs_proto->fields["gproto_quiste"].'</center></td>
                        <td  valign="top" bgcolor="#FFFFFF" class="borde_all css_7"><center>'.$rs_proto->fields["gproto_trofozoito"].'</center></td>
                      </tr>';
		
		  $rs_proto->MoveNext();
		}
	}
		
 $lista_proto='';
 $lista_proto='<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" >
                      <tr>
                        <td nowrap="nowrap" bgcolor="#CCFFFF" class="css_7 borde_all" ><strong>PROTOZOARIOS </strong></td>
                        <td nowrap="nowrap" bgcolor="#CCFFFF" class="borde_all css_7" >QUISTE</td>
                        <td width="10" bgcolor="#CCFFFF" class="borde_all css_7" >TROFO   ZOITO</td>
                      </tr>
                      '.$li_proto.'
                    </table>';
 
 $lee_plantilla=str_replace("-proto-",$lista_proto,$lee_plantilla);


 $lista_helmi="select * from dns_gridhelmintos where labinfor_enlace='".$rs_sihaydata->fields["labinfor_enlace"]."'";
 $rs_helmi= $DB_gogess->executec($lista_helmi,array());
 $li_hemi='';
 if($rs_helmi)
	{
		while (!$rs_helmi->EOF) {
			  
		   $li_hemi.='<tr>
                        <td  valign="top" bgcolor="#FFFFFF" class="borde_all css_7"><center>'.$rs_helmi->fields["ghelmi_helmintos"].'</center></td>
                        <td  valign="top" bgcolor="#FFFFFF" class="borde_all css_7"><center>'.$rs_helmi->fields["ghelmi_huevo"].'</center></td>
                        <td  valign="top" bgcolor="#FFFFFF" class="borde_all css_7"><center>'.$rs_helmi->fields["ghelmi_larva"].'</center></td>
                      </tr>';
		
		  $rs_helmi->MoveNext();
		}
  }
   
 $lista_helmi='<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" >
                      <tr>
                        <td nowrap="nowrap" bgcolor="#CCFFFF" class="css_7 borde_all" ><strong>HELMINTOS   </strong></td>
                        <td nowrap="nowrap" bgcolor="#CCFFFF" class="borde_all css_7" >HUEVO</td>
                        <td width="10" bgcolor="#CCFFFF" class="borde_all css_7" >LARVA</td>
                      </tr>
                      '.$li_hemi.'
                    </table>';				
 
  $lee_plantilla=str_replace("-helmi-",$lista_helmi,$lee_plantilla);
  
  
  //quimica==========================
  $rebicion_quimica="select * from dns_gridquimica where labinfor_enlace='".$rs_sihaydata->fields["labinfor_enlace"]."'";
  $rs_quimica = $DB_gogess->executec($rebicion_quimica,array());
  if($rs_quimica)
	{
		while (!$rs_quimica->EOF) {
			  
		  $lee_plantilla=str_replace("-gquimica_resultado".$rs_quimica->fields["gquimica_tipo"]."-",$rs_quimica->fields["gquimica_resultado"],$lee_plantilla);
		  $lee_plantilla=str_replace("-gquimica_unidad".$rs_quimica->fields["gquimica_tipo"]."-",$rs_quimica->fields["gquimica_unidad"],$lee_plantilla);
		  $lee_plantilla=str_replace("-gquimica_valor".$rs_quimica->fields["gquimica_tipo"]."-",$rs_quimica->fields["gquimica_valor"],$lee_plantilla);
		
		  $rs_quimica->MoveNext();
		}
	}	
   
  $rebicion_quimica="select * from dns_tipoquimica";
  $rs_quimica = $DB_gogess->executec($rebicion_quimica,array());
  if($rs_quimica)
	{
		while (!$rs_quimica->EOF) {
			  
		  $lee_plantilla=str_replace("-gquimica_resultado".$rs_quimica->fields["tqui_id"]."-",'',$lee_plantilla);
		  $lee_plantilla=str_replace("-gquimica_unidad".$rs_quimica->fields["tqui_id"]."-",'',$lee_plantilla);
		  $lee_plantilla=str_replace("-gquimica_valor".$rs_quimica->fields["tqui_id"]."-",'',$lee_plantilla);
		
		  $rs_quimica->MoveNext();
		}
	}	
	
	
	$labinfor_observaquimica=$rs_sihaydata->fields["labinfor_observaquimica"];
	$lee_plantilla=str_replace("-labinfor_observaquimica-",$labinfor_observaquimica,$lee_plantilla); 	
	
  //quimica=========================
 
 
$comprobantepdf=$lee_plantilla;
  
$xml="LAB";
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

$dompdf->stream($xml."_".$hc."_".date("Y-m-d").$valor_id.".pdf");


}
?>