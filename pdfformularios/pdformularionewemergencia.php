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
$clie_hcpinos=$rs_dcliente->fields["clie_hcpinos"];
$clie_rucci=$rs_dcliente->fields["clie_rucci"];

$conve_id=$rs_dcliente->fields["conve_id"]; 
$nac_id=$rs_dcliente->fields["nac_id"];



$table=$rs_tabla->fields["tab_name"];  
$campo_primariodata=$rs_tabla->fields["tab_campoprimario"]; 
//$busca_sihaydata="select * from ".$table." where atenc_id=? and clie_id=?";
$busca_sihaydata="select * from ".$table." where  ".$campo_primariodata."=?";
$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array($valor_id));


$nomb_centro='';
$nomb_medico='';
$uni_codiog='';

$nomb_centro=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre","where centro_id=",1,$DB_gogess);
$nomb_medico=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido","where usua_id=",$rs_sihaydata->fields["usua_id"],$DB_gogess);

$uni_codiog=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_codigo","where centro_id=",1,$DB_gogess);

$usua_ciruc=$objformulario->replace_cmb("app_usuario","usua_id,usua_ciruc","where usua_id=",$rs_sihaydata->fields["usua_id"],$DB_gogess);


$zona_id=$rs_sihaydata->fields["zona_id"];
$nomb_zona='';
$nomb_zona=$objformulario->replace_cmb("lpin_zona","zona_id,zona_nombre"," where zona_id=",$zona_id,$DB_gogess);

$anam_lugarnacimiento=$rs_sihaydata->fields["anam_lugarnacimiento"];

 ///edad actual
 
 	$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_sihaydata->fields["anam_fecharegistro"]);
	
 
 //edad actual

$datos_cliente_ubicacion="select prov.prob_nombre,	canton.cant_nombre,	cliente.clie_parroquia 
from app_cliente cliente inner join cesdb_arcombos.app_provincia prov
on prov.prob_codigo = cliente.prob_codigo inner join cesdb_arcombos.app_canton canton
on canton.cant_codigo = cliente.cant_codigo 
where cliente.clie_id ='".$clie_id."'";
$rs_dcliente_ubicacion = $DB_gogess->executec($datos_cliente_ubicacion,array());
$prob_nombre=$rs_dcliente_ubicacion->fields["prob_nombre"];
$cant_nombre=$rs_dcliente_ubicacion->fields["cant_nombre"];
$clie_parroquia=$rs_dcliente_ubicacion->fields["clie_parroquia"];

$datos_cliente_varios="select c.clie_fechanacimiento,c.clie_celular, c.clie_direccion, n.nac_nombre, g.gen_gen, e.civil_nombre, e.civil_id,i.instruccion_nombre, co.conve_nombre
from app_cliente c LEFT JOIN cesdb_arcombos.dns_nacionalidad n on c.nac_id=n.nac_id
LEFT JOIN cesdb_arcombos.app_genero g on c.clie_genero=g.gen_gen
LEFT JOIN cesdb_arcombos.app_estadocivil e on c.civil_id=e.civil_id
LEFT JOIN cesdb_arcombos.dns_instruccion i on c.clie_instruccion=i.instruccion_id 
LEFT JOIN cesdb_arextension.dns_convenios co on c.conve_id=co.conve_id
where c.clie_id='".$clie_id."'";

$rs_dcliente_varios = $DB_gogess->executec($datos_cliente_varios,array());
$clie_fechanacimiento=$rs_dcliente_varios->fields["clie_fechanacimiento"];
$clie_celular=$rs_dcliente_varios->fields["clie_celular"];
$clie_direccion=$rs_dcliente_varios->fields["clie_direccion"];
$nac_nombre=$rs_dcliente_varios->fields["nac_nombre"];
$gen_gen=$rs_dcliente_varios->fields["gen_gen"];
$civil_nombre=$rs_dcliente_varios->fields["civil_nombre"];
$civil_id=$rs_dcliente_varios->fields["civil_id"];
$instruccion_nombre=$rs_dcliente_varios->fields["instruccion_nombre"];
$conve_nombre=$rs_dcliente_varios->fields["conve_nombre"];


$datos_anamnesis="SELECT et.tipoetnia_id, et.tipoetnia_nombre,newem.anam_movfetal,newem.anam_memrotas,newem.anam_pelvisutil,newem.anam_vaginal,
medi.medi_descripcion, medi.medi_posologia
FROM dns_newemergenciaanamesis newem
left join cmb_etnia et on et.tipoetnia_id=newem.tipoetnia_id
left join gogess_sino sino on sino.si_id=newem.anam_movfetal
left join cesdb_arextension.dns_gridplanmedicamentosemergencia medi on medi.anam_enlace=newem.anam_enlace
where newem.clie_id='".$clie_id."' and ".$campo_primariodata."='".$valor_id."'";
$rs_dcdatos_anamnesis = $DB_gogess->executec($datos_anamnesis,array());
$tipoetnia_nombre=$rs_dcdatos_anamnesis->fields["tipoetnia_nombre"];
$anam_movfetal=$rs_dcdatos_anamnesis->fields["anam_movfetal"];
$anam_memrotas=$rs_dcdatos_anamnesis->fields["anam_memrotas"];
$anam_pelvisutil=$rs_dcdatos_anamnesis->fields["anam_pelvisutil"];
$anam_vaginal=$rs_dcdatos_anamnesis->fields["anam_vaginal"];
$medi_descripcion=$rs_dcdatos_anamnesis->fields["medi_descripcion"];
$medi_posologia=$rs_dcdatos_anamnesis->fields["medi_posologia"];


/*//////////////GLASGOW INICIO

/*$datos_glasgow="select newe.anam_enlace, gow.glas_ocular,gow.glas_versal, gow.glas_motora, gow.glas_total, gow.glas_pupilarder, gow.glas_pupilarizq,
gow.glas_capilar 
from dns_newemergenciaanamesis newe
INNER JOIN cesdb_arextension.dns_gridglasgow2008 gow on newe.anam_enlace=gow.anam_enlace
where clie_id='".$clie_id."'";*/
/*$datos_glasgow="select gow.glas_ocular,gow.glas_versal, gow.glas_motora, gow.glas_total, gow.glas_pupilarder, gow.glas_pupilarizq,
gow.glas_capilar 
from cesdb_arextension.dns_gridglasgow2008 gow
where anam_enlace='".$anam_enlace."'";
$rs_dcglasgow = $DB_gogess->executec($datos_glasgow,array());
$glas_ocular=$rs_dcglasgow->fields["glas_ocular"];
$glas_versal=$rs_dcglasgow->fields["glas_versal"];
$glas_motora=$rs_dcglasgow->fields["glas_motora"];
$glas_total=$rs_dcglasgow->fields["glas_total"];
$glas_pupilarder=$rs_dcglasgow->fields["glas_pupilarder"];
$glas_pupilarizq=$rs_dcglasgow->fields["glas_pupilarizq"];
$glas_capilar=$rs_dcglasgow->fields["glas_capilar"];*/

//////////////GLASGOW FIN*/
//////////NEW EMERGENCIA SI HAY DATA INICIO xxxx  

$anam_ambulatorio=$rs_sihaydata->fields["anam_ambulatorio"];
$anam_ambulancia=$rs_sihaydata->fields["anam_ambulancia"];  
$anam_otrotransporte=$rs_sihaydata->fields["anam_otrotransporte"];  
$anam_trauma=$rs_sihaydata->fields["anam_trauma"];  
$anam_clinica=$rs_sihaydata->fields["anam_clinica"];   
$anam_obstetrica=$rs_sihaydata->fields["anam_obstetrica"];
$anam_quirurgica=$rs_sihaydata->fields["anam_quirurgica"];  
$anam_policia=$rs_sihaydata->fields["anam_policia"]; 
$anam_otromotivo=$rs_sihaydata->fields["anam_otromotivo"];   
$anam_custodiapolicial=$rs_sihaydata->fields["anam_custodiapolicial"];
$anam_accidentetransito=$rs_sihaydata->fields["anam_accidentetransito"];  
$anam_caida=$rs_sihaydata->fields["anam_caida"];
$anam_quemadura=$rs_sihaydata->fields["anam_quemadura"];
$anam_mordedura=$rs_sihaydata->fields["anam_mordedura"];
$anam_ahogamiento=$rs_sihaydata->fields["anam_ahogamiento"];  
$anam_cuerpoextra=$rs_sihaydata->fields["anam_cuerpoextra"];  
$anam_aplastamiento=$rs_sihaydata->fields["anam_aplastamiento"];   
$anam_otroaccidente=$rs_sihaydata->fields["anam_otroaccidente"];    
$anam_armafuego=$rs_sihaydata->fields["anam_armafuego"];   
$anam_armapunzante=$rs_sihaydata->fields["anam_armapunzante"];   
$anam_rina=$rs_sihaydata->fields["anam_rina"];   
$anam_violenciafamiliar=$rs_sihaydata->fields["anam_violenciafamiliar"];   
$anam_abusofisico=$rs_sihaydata->fields["anam_abusofisico"];   
$anam_psicologico=$rs_sihaydata->fields["anam_psicologico"];
$anam_sexual=$rs_sihaydata->fields["anam_sexual"];  
$anam_otraviolencia=$rs_sihaydata->fields["anam_otraviolencia"];  
$anam_intoxalcoholica=$rs_sihaydata->fields["anam_intoxalcoholica"];    
$anam_intoxalimentaria=$rs_sihaydata->fields["anam_intoxalimentaria"];  
$anam_intoxdrogas=$rs_sihaydata->fields["anam_intoxdrogas"];	
$anam_gases=$rs_sihaydata->fields["anam_gases"];  
$anam_otraintoxicacion=$rs_sihaydata->fields["anam_otraintoxicacion"];  
$anam_envenenamiento=$rs_sihaydata->fields["anam_envenenamiento"];   
$anam_picadura=$rs_sihaydata->fields["anam_picadura"];  
$anam_anafilaxia=$rs_sihaydata->fields["anam_anafilaxia"]; 
$anam_etilico=$rs_sihaydata->fields["anam_etilico"];  
$anam_antalergico=$rs_sihaydata->fields["anam_antalergico"];   
$anam_antclinico=$rs_sihaydata->fields["anam_antclinico"];  
$anam_antginecologico=$rs_sihaydata->fields["anam_antginecologico"];  
$anam_anttraumatologico=$rs_sihaydata->fields["anam_anttraumatologico"];   
$anam_antquirurgico=$rs_sihaydata->fields["anam_antquirurgico"];  
$anam_antfarmacologico=$rs_sihaydata->fields["anam_antfarmacologico"];  
$anam_antpsiquiatrico=$rs_sihaydata->fields["anam_antpsiquiatrico"];  
$anam_antotro=$rs_sihaydata->fields["anam_antotro"];   
$anam_vialibre=$rs_sihaydata->fields["anam_vialibre"];  
$anam_viaobstruida=$rs_sihaydata->fields["anam_viaobstruida"];   
$anam_condestable=$rs_sihaydata->fields["anam_condestable"];   
$anam_condinestable=$rs_sihaydata->fields["anam_condinestable"];
$anam_exobstruida=$rs_sihaydata->fields["anam_exobstruida"];   
$anam_excabeza=$rs_sihaydata->fields["anam_excabeza"];   
$anam_excuello=$rs_sihaydata->fields["anam_excuello"];   
$anam_extorax=$rs_sihaydata->fields["anam_extorax"];  
$anam_exextremidad=$rs_sihaydata->fields["anam_exextremidad"];  
$anam_exabdomen=$rs_sihaydata->fields["anam_exabdomen"];   
$anam_excolumna=$rs_sihaydata->fields["anam_excolumna"];  
$anam_expelvis=$rs_sihaydata->fields["anam_expelvis"]; 
$anam_biometria=$rs_sihaydata->fields["anam_biometria"];   
$anam_quimica=$rs_sihaydata->fields["anam_quimica"];   
$anam_gasometria=$rs_sihaydata->fields["anam_gasometria"];  
$anam_endoscopia=$rs_sihaydata->fields["anam_endoscopia"];  
$anam_rxabdomen=$rs_sihaydata->fields["anam_rxabdomen"];  
$anam_tomografia=$rs_sihaydata->fields["anam_tomografia"];   
$anam_ecografia=$rs_sihaydata->fields["anam_ecografia"];  
$anam_interconsulta=$rs_sihaydata->fields["anam_interconsulta"];   
$anam_uroanalisis=$rs_sihaydata->fields["anam_uroanalisis"];   
$anam_electrolitos=$rs_sihaydata->fields["anam_electrolitos"];   
$anam_electrocardiograma=$rs_sihaydata->fields["anam_electrocardiograma"];  
$anam_rxtorax=$rs_sihaydata->fields["anam_rxtorax"];   
$anam_rxosea=$rs_sihaydata->fields["anam_rxosea"];    
$anam_resonancia=$rs_sihaydata->fields["anam_resonancia"];   
$anam_ecografiaabdomen=$rs_sihaydata->fields["anam_ecografiaabdomen"];  
$anam_planes=$rs_sihaydata->fields["anam_planes"];  

$anam_horafin=$rs_sihaydata->fields["anam_horafin"]; 
$anam_fechafin=$rs_sihaydata->fields["anam_fechafin"]; 


//////NEW EMERGENCIA SI HAY DATA FIN  xxxx
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
$anam_gestas=$rs_sihaydata->fields["anam_gestas"];
$anam_partos=$rs_sihaydata->fields["anam_partos"];
$anam_abortos=$rs_sihaydata->fields["anam_abortos"];
$anam_cesareas=$rs_sihaydata->fields["anam_cesareas"];
$anam_mestruacion=$rs_sihaydata->fields["anam_mestruacion"];
$anam_gestacion=$rs_sihaydata->fields["anam_gestacion"];
$anam_frefetal=$rs_sihaydata->fields["anam_frefetal"];
$anam_tiempo=$rs_sihaydata->fields["anam_tiempo"];
$anam_uterina=$rs_sihaydata->fields["anam_uterina"];
$anam_presentacion=$rs_sihaydata->fields["anam_presentacion"];
$anam_dilatacion=$rs_sihaydata->fields["anam_dilatacion"];
$anam_borramiento=$rs_sihaydata->fields["anam_borramiento"];
$anam_plano=$rs_sihaydata->fields["anam_plano"];
$anam_contracciones=$rs_sihaydata->fields["anam_contracciones"];
$anam_obsesvacionobs=$rs_sihaydata->fields["anam_obsesvacionobs"];

$anam_hijosvivos=$rs_sihaydata->fields["anam_hijosvivos"];

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



$anam_fecharegistro=$rs_sihaydata->fields["anam_fecharegistro"]; 
////////NEW EMERGENCIA
$anam_fechaadmision=$rs_sihaydata->fields["anam_fechaadmision"];
$anam_ocupacion=$rs_sihaydata->fields["anam_ocupacion"];
$anam_referido=$rs_sihaydata->fields["anam_referido"];
$anam_avisar=$rs_sihaydata->fields["anam_avisar"];
$anam_perentesco=$rs_sihaydata->fields["anam_perentesco"];
$anam_direccionpariente=$rs_sihaydata->fields["anam_direccionpariente"];
$anam_telefonopariente=$rs_sihaydata->fields["anam_telefonopariente"];
$anam_fuenteinfo=$rs_sihaydata->fields["anam_fuenteinfo"];
$anam_entrega=$rs_sihaydata->fields["anam_entrega"];
$anam_telefonoentrega=$rs_sihaydata->fields["anam_telefonoentrega"];
$anam_horaatencion=$rs_sihaydata->fields["anam_horaatencion"];
$anam_rh=$rs_sihaydata->fields["anam_rh"];
$anam_fechahoraevento=$rs_sihaydata->fields["anam_fechahoraevento"];
$anam_lugarevento=$rs_sihaydata->fields["anam_lugarevento"];
$anam_direccionevento=$rs_sihaydata->fields["anam_direccionevento"];
$anam_observacioneseve=$rs_sihaydata->fields["anam_observacioneseve"];
$anam_alcocheck=$rs_sihaydata->fields["anam_alcocheck"];
$anam_observacionap=$rs_sihaydata->fields["anam_observacionap"];
$anam_exobservacion=$rs_sihaydata->fields["anam_exobservacion"];
$anam_otrosexamenes=$rs_sihaydata->fields["anam_otrosexamenes"];  
$anam_domicilio=$rs_sihaydata->fields["anam_domicilio"];  
$anam_consultaext=$rs_sihaydata->fields["anam_consultaext"];  
$anam_observacionalta=$rs_sihaydata->fields["anam_observacionalta"];  
$anam_internacion=$rs_sihaydata->fields["anam_internacion"];   
$anam_referencia=$rs_sihaydata->fields["anam_referencia"];    
$anam_servreferencia=$rs_sihaydata->fields["anam_servreferencia"];
$anam_establecimiento=$rs_sihaydata->fields["anam_establecimiento"];  
$anam_egresavivo=$rs_sihaydata->fields["anam_egresavivo"];  
$anam_condicionestable=$rs_sihaydata->fields["anam_condicionestable"];   
$anam_condicioninestable=$rs_sihaydata->fields["anam_condicioninestable"];  
$anam_muerto=$rs_sihaydata->fields["anam_muerto"];  
$anam_diasincapacidad=$rs_sihaydata->fields["anam_diasincapacidad"];   
$anam_causamuerto=$rs_sihaydata->fields["anam_causamuerto"]; 
$anam_fecharegistro=$rs_sihaydata->fields["anam_fecharegistro"];
$anam_emferpactual=$rs_sihaydata->fields["anam_emferpactual"];

$anam_fechaatencion=$rs_sihaydata->fields["anam_fechaatencion"];

  //=========================================================================
  
  
  $url="plantillas/newform008anversoemergencia.php";
  $lee_plantilla=$objvarios->leer_contenido_completo($url);
  
  $lee_plantilla=str_replace("-centro-",$nomb_centro,$lee_plantilla);
  $lee_plantilla=str_replace("-ucodigo-",$uni_codiog,$lee_plantilla);
  
$institucion_valor='';
$institucion_valor=$objvarios->selecciona_institucion($conve_id);
$lee_plantilla=str_replace("-institucion-",$institucion_valor,$lee_plantilla);

$nacionalidad_valor='';
$nacionalidad_valor=$objvarios->selecciona_nacionalidad($nac_id,$DB_gogess);
$lee_plantilla=str_replace("-nac_nombre-",$nacionalidad_valor,$lee_plantilla);
  
  
  $lee_plantilla=str_replace("-nombre-",$nombre_paciente,$lee_plantilla);
  $lee_plantilla=str_replace("-apellido-",$apellido_paciente,$lee_plantilla);
  $lee_plantilla=str_replace("-sexo-",$clie_genero,$lee_plantilla);
  $lee_plantilla=str_replace("-hc-",$hc,$lee_plantilla);
  $lee_plantilla=str_replace("-zona-",$nomb_zona,$lee_plantilla);
  
  $lee_plantilla=str_replace("-codigo-",$usua_ciruc,$lee_plantilla);
  
  $lee_plantilla=str_replace("-edad-",$num_mes["anio"],$lee_plantilla);
  

  $lee_plantilla=str_replace("-lugarn-",$anam_lugarnacimiento,$lee_plantilla);
 
  
  $lee_plantilla=str_replace("-cedulap-",$clie_rucci,$lee_plantilla);
  
  $lee_plantilla=str_replace("-motivoconsulta-",$anam_motivoconsulta,$lee_plantilla);
  //NEW EMERGENCIA
  $lee_plantilla=str_replace("-clie_hcpinos-",$clie_hcpinos,$lee_plantilla);
  $lee_plantilla=str_replace("-prob_nombre-",$prob_nombre,$lee_plantilla);
  $lee_plantilla=str_replace("-cant_nombre-",$cant_nombre,$lee_plantilla);
  $lee_plantilla=str_replace("-clie_parroquia-",$clie_parroquia,$lee_plantilla);
  $lee_plantilla=str_replace("-clie_fechanacimiento-",$clie_fechanacimiento,$lee_plantilla);
  $lee_plantilla=str_replace("-clie_celular-",$clie_celular,$lee_plantilla);
  $lee_plantilla=str_replace("-clie_direccion-",$clie_direccion,$lee_plantilla);
  $lee_plantilla=str_replace("-nac_nombre-",$nac_nombre,$lee_plantilla);
  
  if($gen_gen=='M'){
  $lee_plantilla=str_replace("-gen_masculino-",'X',$lee_plantilla);
  $lee_plantilla=str_replace("-gen_femenino-",'',$lee_plantilla);
  }else{
  $lee_plantilla=str_replace("-gen_femenino-",'X',$lee_plantilla);
  $lee_plantilla=str_replace("-gen_masculino-",'',$lee_plantilla);
  }
  //$lee_plantilla=str_replace("-gen_gen-",$gen_gen,$lee_plantilla);
  switch($civil_id){
  case 1:
        $lee_plantilla=str_replace("-civil_casado-",'',$lee_plantilla);
		$lee_plantilla=str_replace("-civil_soltero-",'X',$lee_plantilla);
		$lee_plantilla=str_replace("-civil_viudo-",'',$lee_plantilla);
		$lee_plantilla=str_replace("-civil_divorciado-",'',$lee_plantilla);
		$lee_plantilla=str_replace("-civil_ulibre-",'',$lee_plantilla);
        break;
  case 2:
		$lee_plantilla=str_replace("-civil_casado-",'X',$lee_plantilla);
		$lee_plantilla=str_replace("-civil_soltero-",'',$lee_plantilla);
		$lee_plantilla=str_replace("-civil_viudo-",'',$lee_plantilla);
		$lee_plantilla=str_replace("-civil_divorciado-",'',$lee_plantilla);
		$lee_plantilla=str_replace("-civil_ulibre-",'',$lee_plantilla);
		break;
  case 3:
  		$lee_plantilla=str_replace("-civil_casado-",'',$lee_plantilla);
		$lee_plantilla=str_replace("-civil_soltero-",'',$lee_plantilla);
		$lee_plantilla=str_replace("-civil_viudo-",'',$lee_plantilla);
		$lee_plantilla=str_replace("-civil_divorciado-",'X',$lee_plantilla);
		$lee_plantilla=str_replace("-civil_ulibre-",'',$lee_plantilla);
		break;
  case 4:
  		$lee_plantilla=str_replace("-civil_casado-",'',$lee_plantilla);
		$lee_plantilla=str_replace("-civil_soltero-",'',$lee_plantilla);
		$lee_plantilla=str_replace("-civil_viudo-",'',$lee_plantilla);
		$lee_plantilla=str_replace("-civil_divorciado-",'',$lee_plantilla);
		$lee_plantilla=str_replace("-civil_ulibre-",'X',$lee_plantilla);
		break;
	case 6:
  		$lee_plantilla=str_replace("-civil_casado-",'',$lee_plantilla);
		$lee_plantilla=str_replace("-civil_soltero-",'',$lee_plantilla);
		$lee_plantilla=str_replace("-civil_viudo-",'',$lee_plantilla);
		$lee_plantilla=str_replace("-civil_divorciado-",'X',$lee_plantilla);
		$lee_plantilla=str_replace("-civil_ulibre-",'',$lee_plantilla);
		break;
	}
	
	
	//XXXXXXXXXX 
	if($anam_ambulatorio==1){
	  $lee_plantilla=str_replace("-anam_ambulatorio-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_ambulatorio-",'',$lee_plantilla);
	  }
	if($anam_ambulancia==1){
	  $lee_plantilla=str_replace("-anam_ambulancia-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_ambulancia-",'',$lee_plantilla);
	  }
	if($anam_otrotransporte==1){
	  $lee_plantilla=str_replace("-anam_otrotransporte-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_otrotransporte-",'',$lee_plantilla);
	  }
	  if($anam_trauma==1){
	  $lee_plantilla=str_replace("-anam_trauma-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_trauma-",'',$lee_plantilla);
	  }
	  if($anam_clinica==1){
	  $lee_plantilla=str_replace("-anam_clinica-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_clinica-",'',$lee_plantilla);
	  }
	  if($anam_obstetrica==1){
	  $lee_plantilla=str_replace("-anam_obstetrica-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_obstetrica-",'',$lee_plantilla);
	  }
	  if($anam_quirurgica==1){
	  $lee_plantilla=str_replace("-anam_quirurgica-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_quirurgica-",'',$lee_plantilla);
	  }
	  if($anam_policia==1){
	  $lee_plantilla=str_replace("-anam_policia-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_policia-",'',$lee_plantilla);
	  }
	  if($anam_otromotivo==1){
	  $lee_plantilla=str_replace("-anam_otromotivo-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_otromotivo-",'',$lee_plantilla);
	  }
	  if($anam_custodiapolicial==1){
	  $lee_plantilla=str_replace("-anam_custodiapolicial-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_custodiapolicial-",'',$lee_plantilla);
	  }	
	  if($anam_accidentetransito==1){
	  $lee_plantilla=str_replace("-anam_accidentetransito-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_accidentetransito-",'',$lee_plantilla);
	  }
	  if($anam_accidentetransito==1){
	  $lee_plantilla=str_replace("-anam_accidentetransito-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_accidentetransito-",'',$lee_plantilla);
	  }
	  if($anam_caida==1){
	  $lee_plantilla=str_replace("-anam_caida-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_caida-",'',$lee_plantilla);
	  }
	  if($anam_quemadura==1){
	  $lee_plantilla=str_replace("-anam_quemadura-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_quemadura-",'',$lee_plantilla);
	  }
	  if($anam_mordedura==1){
	  $lee_plantilla=str_replace("-anam_mordedura-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_mordedura-",'',$lee_plantilla);
	  }  
	  if($anam_ahogamiento==1){
	  $lee_plantilla=str_replace("-anam_ahogamiento-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_ahogamiento-",'',$lee_plantilla);
	  }
      if($anam_cuerpoextra==1){
	  $lee_plantilla=str_replace("-anam_cuerpoextra-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_cuerpoextra-",'',$lee_plantilla);
	  }
	  if($anam_aplastamiento==1){
	  $lee_plantilla=str_replace("-anam_aplastamiento-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_aplastamiento-",'',$lee_plantilla);
	  }
  	  if($anam_otroaccidente==1){
	  $lee_plantilla=str_replace("-anam_otroaccidente-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_otroaccidente-",'',$lee_plantilla);
	  }  
  	  if($anam_armafuego==1){
	  $lee_plantilla=str_replace("-anam_armafuego-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_armafuego-",'',$lee_plantilla);
	  }  
  	  if($anam_armapunzante==1){
	  $lee_plantilla=str_replace("-anam_armapunzante-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_armapunzante-",'',$lee_plantilla);
	  }  
  	  if($anam_rina==1){
	  $lee_plantilla=str_replace("-anam_rina-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_rina-",'',$lee_plantilla);
	  }  
   	  if($anam_violenciafamiliar==1){
	  $lee_plantilla=str_replace("-anam_violenciafamiliar-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_violenciafamiliar-",'',$lee_plantilla);
	  } 
      if($anam_abusofisico==1){
	  $lee_plantilla=str_replace("-anam_abusofisico-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_abusofisico-",'',$lee_plantilla);
	  }   
      if($anam_psicologico==1){
	  $lee_plantilla=str_replace("-anam_psicologico-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_psicologico-",'',$lee_plantilla);
	  }    
      if($anam_sexual==1){
	  $lee_plantilla=str_replace("-anam_sexual-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_sexual-",'',$lee_plantilla);
	  }  
      if($anam_otraviolencia==1){
	  $lee_plantilla=str_replace("-anam_otraviolencia-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_otraviolencia-",'',$lee_plantilla);
	  }  
      if($anam_intoxalcoholica==1){
	  $lee_plantilla=str_replace("-anam_intoxalcoholica-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_intoxalcoholica-",'',$lee_plantilla);
	  }  
      if($anam_intoxalimentaria==1){
	  $lee_plantilla=str_replace("-anam_intoxalimentaria-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_intoxalimentaria-",'',$lee_plantilla);
	  }  
      if($anam_intoxdrogas==1){
	  $lee_plantilla=str_replace("-anam_intoxdrogas-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_intoxdrogas-",'',$lee_plantilla);
	  } 
      if($anam_gases==1){
	  $lee_plantilla=str_replace("-anam_gases-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_gases-",'',$lee_plantilla);
	  }  
      if($anam_otraintoxicacion==1){
	  $lee_plantilla=str_replace("-anam_otraintoxicacion-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_otraintoxicacion-",'',$lee_plantilla);
	  }  
      if($anam_envenenamiento==1){
	  $lee_plantilla=str_replace("-anam_envenenamiento-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_envenenamiento-",'',$lee_plantilla);
	  }  
      if($anam_picadura==1){
	  $lee_plantilla=str_replace("-anam_picadura-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_picadura-",'',$lee_plantilla);
	  }  
      if($anam_anafilaxia==1){
	  $lee_plantilla=str_replace("-anam_anafilaxia-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_anafilaxia-",'',$lee_plantilla);
	  } 
      if($anam_etilico==1){
	  $lee_plantilla=str_replace("-anam_etilico-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_etilico-",'',$lee_plantilla);
	  } 
      if($anam_antalergico==1){
	  $lee_plantilla=str_replace("-anam_antalergico-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_antalergico-",'',$lee_plantilla);
	  }  
      if($anam_antclinico==1){
	  $lee_plantilla=str_replace("-anam_antclinico-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_antclinico-",'',$lee_plantilla);
	  }  
	  if($anam_antginecologico==1){
	  $lee_plantilla=str_replace("-anam_antginecologico-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_antginecologico-",'',$lee_plantilla);
	  }    
	  if($anam_anttraumatologico==1){
	  $lee_plantilla=str_replace("-anam_anttraumatologico-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_anttraumatologico-",'',$lee_plantilla);
	  }   
	  if($anam_antquirurgico==1){
	  $lee_plantilla=str_replace("-anam_antquirurgico-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_antquirurgico-",'',$lee_plantilla);
	  }   
	  if($anam_antfarmacologico==1){
	  $lee_plantilla=str_replace("-anam_antfarmacologico-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_antfarmacologico-",'',$lee_plantilla);
	  }  
	  if($anam_antpsiquiatrico==1){
	  $lee_plantilla=str_replace("-anam_antpsiquiatrico-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_antpsiquiatrico-",'',$lee_plantilla);
	  }  
	  if($anam_antotro==1){
	  $lee_plantilla=str_replace("-anam_antotro-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_antotro-",'',$lee_plantilla);
	  }	  
	  if($anam_vialibre==1){
	  $lee_plantilla=str_replace("-anam_vialibre-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_vialibre-",'',$lee_plantilla);
	  }	  
	  if($anam_viaobstruida==1){
	  $lee_plantilla=str_replace("-anam_viaobstruida-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_viaobstruida-",'',$lee_plantilla);
	  }	 
	  if($anam_condestable==1){
	  $lee_plantilla=str_replace("-anam_condestable-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_condestable-",'',$lee_plantilla);
	  }	 
	  if($anam_condinestable==1){
	  $lee_plantilla=str_replace("-anam_condinestable-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_condinestable-",'',$lee_plantilla);
	  }	
	  if($anam_exobstruida==1){
	  $lee_plantilla=str_replace("-anam_exobstruida-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_exobstruida-",'',$lee_plantilla);
	  }	
	  if($anam_excabeza==1){
	  $lee_plantilla=str_replace("-anam_excabeza-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_excabeza-",'',$lee_plantilla);
	  }  
	  if($anam_excuello==1){
	  $lee_plantilla=str_replace("-anam_excuello-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_excuello-",'',$lee_plantilla);
	  }  	  
	  if($anam_extorax==1){
	  $lee_plantilla=str_replace("-anam_extorax-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_extorax-",'',$lee_plantilla);
	  }	  
	  if($anam_exextremidad==1){
	  $lee_plantilla=str_replace("-anam_exextremidad-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_exextremidad-",'',$lee_plantilla);
	  }	  
	  if($anam_exabdomen==1){
	  $lee_plantilla=str_replace("-anam_exabdomen-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_exabdomen-",'',$lee_plantilla);
	  }	  
	  if($anam_excolumna==1){
	  $lee_plantilla=str_replace("-anam_excolumna-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_excolumna-",'',$lee_plantilla);
	  }		  
	  if($anam_expelvis==1){
	  $lee_plantilla=str_replace("-anam_expelvis-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_expelvis-",'',$lee_plantilla);
	  }		  
	  if($anam_movfetal==1){
	  $lee_plantilla=str_replace("-anam_movfetal-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_movfetal-",'',$lee_plantilla);
	  }	 
	  if($anam_memrotas==1){
	  $lee_plantilla=str_replace("-anam_memrotas-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_memrotas-",'',$lee_plantilla);
	  }	 
	  if($anam_pelvisutil==1){
	  $lee_plantilla=str_replace("-anam_pelvisutil-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_pelvisutil-",'',$lee_plantilla);
	  }	  
	  if($anam_vaginal==1){
	  $lee_plantilla=str_replace("-anam_vaginal-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_vaginal-",'',$lee_plantilla);
	  }		  
	  if($anam_biometria==1){
	  $lee_plantilla=str_replace("-anam_biometria-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_biometria-",'',$lee_plantilla);
	  }		  
	  if($anam_quimica==1){
	  $lee_plantilla=str_replace("-anam_quimica-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_quimica-",'',$lee_plantilla);
	  }		  
	  if($anam_gasometria==1){
	  $lee_plantilla=str_replace("-anam_gasometria-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_gasometria-",'',$lee_plantilla);
	  }	  
	  if($anam_endoscopia==1){
	  $lee_plantilla=str_replace("-anam_endoscopia-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_endoscopia-",'',$lee_plantilla);
	  }   
	  if($anam_rxabdomen==1){
	  $lee_plantilla=str_replace("-anam_rxabdomen-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_rxabdomen-",'',$lee_plantilla);
	  }  
	  if($anam_tomografia==1){
	  $lee_plantilla=str_replace("-anam_tomografia-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_tomografia-",'',$lee_plantilla);
	  }    
	  if($anam_ecografia==1){
	  $lee_plantilla=str_replace("-anam_ecografia-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_ecografia-",'',$lee_plantilla);
	  }  
	  if($anam_interconsulta==1){
	  $lee_plantilla=str_replace("-anam_interconsulta-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_interconsulta-",'',$lee_plantilla);
	  }  	  
	  if($anam_uroanalisis==1){
	  $lee_plantilla=str_replace("-anam_uroanalisis-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_uroanalisis-",'',$lee_plantilla);
	  }  
	  if($anam_electrolitos==1){
	  $lee_plantilla=str_replace("-anam_electrolitos-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_electrolitos-",'',$lee_plantilla);
	  }  
	  if($anam_electrocardiograma==1){
	  $lee_plantilla=str_replace("-anam_electrocardiograma-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_electrocardiograma-",'',$lee_plantilla);
	  }	  
	  if($anam_rxtorax==1){
	  $lee_plantilla=str_replace("-anam_rxtorax-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_rxtorax-",'',$lee_plantilla);
	  }  
	  if($anam_rxosea==1){
	  $lee_plantilla=str_replace("-anam_rxosea-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_rxosea-",'',$lee_plantilla);
	  } 
	  if($anam_resonancia==1){
	  $lee_plantilla=str_replace("-anam_resonancia-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_resonancia-",'',$lee_plantilla);
	  }  
      if($anam_ecografiaabdomen==1){
	  $lee_plantilla=str_replace("-anam_ecografiaabdomen-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_ecografiaabdomen-",'',$lee_plantilla);
	  }  
	  if($anam_domicilio==1){
	  $lee_plantilla=str_replace("-anam_domicilio-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_domicilio-",'',$lee_plantilla);
	  }  
	  if($anam_consultaext==1){
	  $lee_plantilla=str_replace("-anam_consultaext-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_consultaext-",'',$lee_plantilla);
	  }  
	  if($anam_observacionalta==1){
	  $lee_plantilla=str_replace("-anam_observacionalta-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_observacionalta-",'',$lee_plantilla);
	  }  
	  if($anam_internacion==1){
	  $lee_plantilla=str_replace("-anam_internacion-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_internacion-",'',$lee_plantilla);
	  }   
	  if($anam_referencia==1){
	  $lee_plantilla=str_replace("-anam_referencia-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_referencia-",'',$lee_plantilla);
	  }  
	  if($anam_egresavivo==1){
	  $lee_plantilla=str_replace("-anam_egresavivo-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_egresavivo-",'',$lee_plantilla);
	  }   
	  if($anam_condicionestable==1){
	  $lee_plantilla=str_replace("-anam_condicionestable-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_condicionestable-",'',$lee_plantilla);
	  }   
	  if($anam_condicioninestable==1){
	  $lee_plantilla=str_replace("-anam_condicioninestable-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_condicioninestable-",'',$lee_plantilla);
	  }    
	  if($anam_muerto==1){
	  $lee_plantilla=str_replace("-anam_muerto-",'X',$lee_plantilla);
	  }else{
	  $lee_plantilla=str_replace("-anam_muerto-",'',$lee_plantilla);
	  }  
	  
	  
	  
  //$lee_plantilla=str_replace("-anam_ahogamiento-",'X',$lee_plantilla);
  
  $lee_plantilla=str_replace("-civil_nombre-",$civil_nombre,$lee_plantilla);
  $lee_plantilla=str_replace("-instruccion_nombre-",$instruccion_nombre,$lee_plantilla);
  $lee_plantilla=str_replace("-conve_nombre-",$conve_nombre,$lee_plantilla);
  $lee_plantilla=str_replace("-tipoetnia_nombre-",$tipoetnia_nombre,$lee_plantilla);

  
  $lee_plantilla=str_replace("-anam_fechaadmision-",$anam_fechaadmision,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_ocupacion-",$anam_ocupacion,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_referido-",$anam_referido,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_avisar-",$anam_avisar,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_perentesco-",$anam_perentesco,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_direccionpariente-",$anam_direccionpariente,$lee_plantilla); 
  $lee_plantilla=str_replace("-anam_telefonopariente-",$anam_telefonopariente,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_fuenteinfo-",$anam_fuenteinfo,$lee_plantilla); 
  $lee_plantilla=str_replace("-anam_entrega-",$anam_entrega,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_telefonoentrega-",$anam_telefonoentrega,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_horaatencion-",$anam_horaatencion,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_fechaatencion-",$anam_fechaatencion,$lee_plantilla);
  
  
  $lee_plantilla=str_replace("-anam_rh-",$anam_rh,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_fechahoraevento-",$anam_fechahoraevento,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_lugarevento-",$anam_lugarevento,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_direccionevento-",$anam_direccionevento,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_observacioneseve-",$anam_observacioneseve,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_alcocheck-",$anam_alcocheck,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_observacionap-",$anam_observacionap,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_exobservacion-",$anam_exobservacion,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_otrosexamenes-",$anam_otrosexamenes,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_planes-",$anam_planes,$lee_plantilla); 
  $lee_plantilla=str_replace("-medi_descripcion-",$medi_descripcion,$lee_plantilla); 
  $lee_plantilla=str_replace("-medi_posologia-",$medi_posologia,$lee_plantilla);  
  $lee_plantilla=str_replace("-anam_servreferencia-",$anam_servreferencia,$lee_plantilla);  
  $lee_plantilla=str_replace("-anam_establecimiento-",$anam_establecimiento,$lee_plantilla); 
  $lee_plantilla=str_replace("-anam_diasincapacidad-",$anam_diasincapacidad,$lee_plantilla);  
  $lee_plantilla=str_replace("-anam_causamuerto-",$anam_causamuerto,$lee_plantilla); 
  //$lee_plantilla=str_replace("-anam_fecharegistro-",$anam_fecharegistro,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_emferpactual-",$anam_emferpactual,$lee_plantilla);

    $logo = $objformulario->replace_cmb("app_empresa", "emp_id,emp_logoreporte", "where emp_id=", 1, $DB_gogess);
    $emp_nombre = $objformulario->replace_cmb("app_empresa", "emp_id,emp_nombre", "where emp_id=", 1, $DB_gogess);
    $emp_piedepagina = $objformulario->replace_cmb("app_empresa", "emp_id,emp_piedepagina", "where emp_id=", 1, $DB_gogess);

//cabecera y pie de pagina
    $lee_plantilla = str_replace("-logoreporte-", $logo, $lee_plantilla);
    $lee_plantilla = str_replace("-empresanombre-", $emp_nombre, $lee_plantilla);
    $lee_plantilla = str_replace("-piedepagina-", $emp_piedepagina, $lee_plantilla);
//=========================
    //=========================

  
  //////////////GLASGOW INICIO

/*$datos_glasgow="select newe.anam_enlace, gow.glas_ocular,gow.glas_versal, gow.glas_motora, gow.glas_total, gow.glas_pupilarder, gow.glas_pupilarizq,
gow.glas_capilar 
from dns_newemergenciaanamesis newe
INNER JOIN cesdb_arextension.dns_gridglasgow2008 gow on newe.anam_enlace=gow.anam_enlace
where clie_id='".$clie_id."'";*/
$datos_glasgow="select gow.glas_ocular,gow.glas_versal, gow.glas_motora, gow.glas_total, gow.glas_pupilarder, gow.glas_pupilarizq,
gow.glas_capilar 
from cesdb_arextension.dns_gridglasgow2008 gow
where anam_enlace='".$anam_enlace."'";
$rs_dcglasgow = $DB_gogess->executec($datos_glasgow,array());
$glas_ocular=$rs_dcglasgow->fields["glas_ocular"];
$glas_versal=$rs_dcglasgow->fields["glas_versal"];
$glas_motora=$rs_dcglasgow->fields["glas_motora"];
$glas_total=$rs_dcglasgow->fields["glas_total"];
$glas_pupilarder=$rs_dcglasgow->fields["glas_pupilarder"];
$glas_pupilarizq=$rs_dcglasgow->fields["glas_pupilarizq"];
$glas_capilar=$rs_dcglasgow->fields["glas_capilar"];

//////////////GLASGOW FIN
  //GLAS GOW
   $lee_plantilla=str_replace("-glas_ocular-",$glas_ocular,$lee_plantilla);
   $lee_plantilla=str_replace("-glas_versal-",$glas_versal,$lee_plantilla);
   $lee_plantilla=str_replace("-glas_motora-",$glas_motora,$lee_plantilla);
   $lee_plantilla=str_replace("-glas_total-",$glas_total,$lee_plantilla); 
   $lee_plantilla=str_replace("-glas_pupilarder-",$glas_pupilarder,$lee_plantilla);
   $lee_plantilla=str_replace("-glas_pupilarizq-",$glas_pupilarizq,$lee_plantilla); 
   $lee_plantilla=str_replace("-glas_capilar-",$glas_capilar,$lee_plantilla);
  
  
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
  
  //Revicion actual de organos  
  $datos_ro='';
  $rebicion_organos="select * from cesdb_arextension.dns_newemergenciagridorgano a inner join cesdb_arcombos.dns_opcionorgano b on a.opcorg_id=b.opcorg_id where tiporg_nombre='CP' and anam_enlace='".$anam_enlace."'";
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
  

  //$lee_plantilla=str_replace("-ap-",$datos_ap,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_menarquiaedad-",$anam_menarquiaedad,$lee_plantilla); 
  $lee_plantilla=str_replace("-anam_menopausiaedad-",$anam_menopausiaedad,$lee_plantilla);  
  $lee_plantilla=str_replace("-anam_ciclos-",$anam_ciclos,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_vidasexualactiva-",$anam_vidasexualactiva,$lee_plantilla);
  
if($clie_genero=='F')
{
//================================================== 
  $lee_plantilla=str_replace("-anam_gestas-",$anam_gestas,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_partos-",$anam_partos,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_abortos-",$anam_abortos,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_cesareas-",$anam_cesareas,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_mestruacion-",$anam_mestruacion,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_gestacion-",$anam_gestacion,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_frefetal-",$anam_frefetal,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_tiempo-",$anam_tiempo,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_uterina-",$anam_uterina,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_presentacion-",$anam_presentacion,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_dilatacion-",$anam_dilatacion,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_borramiento-",$anam_borramiento,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_plano-",$anam_plano,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_contracciones-",$anam_contracciones,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_obsesvacionobs-",$anam_obsesvacionobs,$lee_plantilla);
  

//==================================================
}
else
{
//================================================== 
  $lee_plantilla=str_replace("-anam_gestas-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_partos-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_abortos-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_cesareas-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_mestruacion-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_gestacion-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_frefetal-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_tiempo-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_uterina-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_presentacion-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_dilatacion-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_borramiento-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_plano-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_contracciones-",'',$lee_plantilla);
  $lee_plantilla=str_replace("-anam_obsesvacionobs-",'',$lee_plantilla); 
  

//==================================================
}
  
  
  $lee_plantilla=str_replace("-anam_hijosvivos-",$anam_hijosvivos,$lee_plantilla);

  $lee_plantilla=str_replace("-anam_biopsia-",$anam_biopsia,$lee_plantilla);
  
  $lee_plantilla=str_replace("-anam_metodopfamiliar-",$anam_metodopfamiliar,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_terapiahormonal-",$anam_terapiahormonal,$lee_plantilla);
  
  $lee_plantilla=str_replace("-anam_colposcopia-",$anam_colposcopia,$lee_plantilla);
  $lee_plantilla=str_replace("-anam_mamografia-",$anam_mamografia,$lee_plantilla);

  //$lee_plantilla=str_replace("-af-",$datos_af,$lee_plantilla);
  
 // $lee_plantilla=str_replace("-anam_emferpactual-",$anam_emferpactual,$lee_plantilla);
  
  
  //signos vitales 
  
  $sig_vitales="select * from dns_signosvitales where atenc_enlace='".$rs_atencion->fields["atenc_enlace"]."' order by signovita_fecharegistro desc limit 1";
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
		  $lee_plantilla=str_replace("-signovita_saturacionoxigeno-",$rs_svitales->fields["signovita_saturacionoxigeno"],$lee_plantilla);
		  
		
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
   $lee_plantilla=str_replace("-signovita_saturacionoxigeno-","",$lee_plantilla);
  //signos vitales
  
 //examen fisco regional  
   
 $datos_freg='';
 $fisco_regional="select * from cesdb_arextension.dns_newemergenciagridexamenfisico a inner join cesdb_arcombos.dns_opcionexamenfisico b on a.opcexa_id=b.opcexa_id where tiporg_nombre='CP' and anam_enlace='".$anam_enlace."'";
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
   $cuentasea=3;
   $diagosticos_rv="select * from cesdb_arextension.dns_newemergenciadiagnosticoanamnesis where anam_enlace='".$anam_enlace."' limit 6";
   $rs_dgnostico = $DB_gogess->executec($diagosticos_rv,array());
   if($rs_dgnostico)
	{
			while (!$rs_dgnostico->EOF) {	 
			   if($rs_dgnostico->fields["diagn_alta"]==1){
			       $cuentase++;			     
				   $lee_plantilla=str_replace("-diagnosticoi".$cuentase."-",$rs_dgnostico->fields["diagn_descripcion"],$lee_plantilla);
				   $lee_plantilla=str_replace("-ciei".$cuentase."-",$rs_dgnostico->fields["diagn_cie"],$lee_plantilla);  
				   if($rs_dgnostico->fields["diagn_tipo"]=='PRESUNTIVO')
				   {
				   
				   $lee_plantilla=str_replace("-prei".$cuentase."-","X",$lee_plantilla);
				   $lee_plantilla=str_replace("-defi".$cuentase."-","",$lee_plantilla);
				   
				   }
				   
				   if($rs_dgnostico->fields["diagn_tipo"]=='DEFINITIVO')
				   {
				   $lee_plantilla=str_replace("-prei".$cuentase."-","",$lee_plantilla);
				   $lee_plantilla=str_replace("-defi".$cuentase."-","X",$lee_plantilla); 
				   }
			   }else { 
			        $cuentasea++;
			   		$lee_plantilla=str_replace("-diagnosticoa".$cuentasea."-",$rs_dgnostico->fields["diagn_descripcion"],$lee_plantilla);
				   $lee_plantilla=str_replace("-ciea".$cuentasea."-",$rs_dgnostico->fields["diagn_cie"],$lee_plantilla);   
				   if($rs_dgnostico->fields["diagn_tipo"]=='PRESUNTIVO')
				   {				   
				   $lee_plantilla=str_replace("-prea".$cuentasea."-","X",$lee_plantilla);
				   $lee_plantilla=str_replace("-defa".$cuentasea."-","",$lee_plantilla);				   
				   }
				   
				   if($rs_dgnostico->fields["diagn_tipo"]=='DEFINITIVO')
				   {
				   $lee_plantilla=str_replace("-prea".$cuentasea."-","",$lee_plantilla);
				   $lee_plantilla=str_replace("-defa".$cuentasea."-","X",$lee_plantilla); 
				   } 
			}
			$rs_dgnostico->MoveNext();
		}
	}	
	
 for($iv=1;$iv<=6;$iv++)
 {
	$lee_plantilla=str_replace("-diagnosticoi".$iv."-","",$lee_plantilla);
	$lee_plantilla=str_replace("-ciei".$iv."-","",$lee_plantilla);
    $lee_plantilla=str_replace("-prei".$iv."-","",$lee_plantilla);
	$lee_plantilla=str_replace("-defi".$iv."-","",$lee_plantilla);
	$lee_plantilla=str_replace("-diagnosticoa".$iv."-","",$lee_plantilla);
	$lee_plantilla=str_replace("-ciea".$iv."-","",$lee_plantilla);
    $lee_plantilla=str_replace("-prea".$iv."-","",$lee_plantilla);
	$lee_plantilla=str_replace("-defa".$iv."-","",$lee_plantilla);

 }	
 //diagnosticos
 
 //medicamentos
   $datos_diagnostico='';
   $cuentase=0;
   $medicamentos_rv="select * from  cesdb_arextension.dns_gridplanmedicamentosemergencia where anam_enlace='".$anam_enlace."' limit 7";
   $rs_medicamentos = $DB_gogess->executec($medicamentos_rv,array());
   if($rs_medicamentos)
	{
			while (!$rs_medicamentos->EOF) {	 
			       $cuentase++;			     
				   $lee_plantilla=str_replace("-medi_descripcion".$cuentase."-",$rs_medicamentos->fields["medi_descripcion"],$lee_plantilla);
				   $lee_plantilla=str_replace("-medi_posologia".$cuentase."-",$rs_medicamentos->fields["medi_posologia"],$lee_plantilla);     
			$rs_medicamentos->MoveNext();
			}
	}	
	
 for($iv=1;$iv<=7;$iv++)
 {
	$lee_plantilla=str_replace("-medi_descripcion".$iv."-","",$lee_plantilla);
	$lee_plantilla=str_replace("-medi_posologia".$iv."-","",$lee_plantilla);
 }	
 //medicamentos 



 
 $separa_fecha_hora=explode(" ",$anam_fecharegistro);
 
 
 
 if($anam_horafin)
 {
 $lee_plantilla=str_replace("-fechhora-",$anam_horafin,$lee_plantilla);
 }
 else
 {
 $lee_plantilla=str_replace("-fechhora-",$separa_fecha_hora[1],$lee_plantilla); 
 }
 
 
 if($anam_fechafin)
 {
 $lee_plantilla=str_replace("-anam_fecharegistro-",$anam_fechafin,$lee_plantilla);
 }
 else
 {
 $lee_plantilla=str_replace("-anam_fecharegistro-",$separa_fecha_hora[0],$lee_plantilla);
 }
 
 
 $lee_plantilla=str_replace("-medico-",$nomb_medico,$lee_plantilla);
 
$stylemapa=''; 
$stylemapa='<style type="text/css">
<!--

 #contenedor_imp {
	font-size: 11px;
	font-style: normal;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	height: 300px;
	width: 300px;
	top:0px;
	left:0px;
	position: relative;
	background-image:url(images/diagramatopografico.png);
}
';


$listacamposcss="select * from dns_registrolesiones where anam_enlace='".$anam_enlace."'"; 
 $rs_camposcss = $DB_gogess->executec($listacamposcss,array()); 
   if($rs_camposcss)
   {
			 while (!$rs_camposcss->EOF) {

			 $stylemapa.='#L'.strtolower($rs_camposcss->fields["less_id"]).'_div { top:'.$rs_camposcss->fields["less_y"].'px; left:'.$rs_camposcss->fields["less_x"].'px;
			 position: absolute;
			 font-size: 11px;
			 font-style: normal;
			 font-family: Verdana, Arial, Helvetica, sans-serif;
			  }
			 ';
			 $rs_camposcss->MoveNext();
			 }
   }
   
$stylemapa.='
-->
</style>';


$lesionesx='';
$lesionesx.='<table width="300" height="300" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top" >
<div id="contenedor_imp" >';	  

$listacamposcss="select * from dns_registrolesiones inner join cesdb_arextension.dns_lesiones on dns_registrolesiones.les_id=cesdb_arextension.dns_lesiones.les_id where anam_enlace='".$anam_enlace."'"; 
 $rs_camposcss = $DB_gogess->executec($listacamposcss,array()); 
   if($rs_camposcss)
   {
			 while (!$rs_camposcss->EOF) {
              
			$lesionesx.='<div id=L'.strtolower($rs_camposcss->fields["less_id"]).'_div ><img src="images/'.$rs_camposcss->fields["les_id"].'.png" width="13" height="13"  /></div>';

			 $rs_camposcss->MoveNext();
			 }
   }


$lesionesx.='</div>			  
		</td>
		</tr>
	</table>';
	
	
	


$lee_plantilla=str_replace("-stylemapa-",$stylemapa,$lee_plantilla);
$lee_plantilla=str_replace("-lessiones-",$lesionesx,$lee_plantilla);

$cuentase=0;	
$listacamposcss="select * from dns_registrolesiones inner join cesdb_arextension.dns_lesiones on dns_registrolesiones.les_id=cesdb_arextension.dns_lesiones.les_id where anam_enlace='".$anam_enlace."'"; 
   $rs_lessines = $DB_gogess->executec($listacamposcss,array());
   if($rs_lessines)
	{
			while (!$rs_lessines->EOF) {	
			 
			       $cuentase++;			     
				   $lee_plantilla=str_replace("-les_id".$rs_lessines->fields["les_id"]."-",'X',$lee_plantilla);   
			   
			   
			   $rs_lessines->MoveNext();
			}
	}	

$cuentase=0;	
$listacamposcss="select * from cesdb_arextension.dns_lesiones"; 
   $rs_lessines = $DB_gogess->executec($listacamposcss,array());
   if($rs_lessines)
	{
			while (!$rs_lessines->EOF) {	
			 
			       $cuentase++;			     
				   $lee_plantilla=str_replace("-les_id".$rs_lessines->fields["les_id"]."-","",$lee_plantilla);     
			   
			   
			   $rs_lessines->MoveNext();
			}
	}	 
 
$comprobantepdf=$lee_plantilla;
  
$xml="Formulario_008";
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