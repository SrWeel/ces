<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=4444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
ini_set("pcre.jit", "0");
session_start();

$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

for($i=0;$i<$numero;$i++){
    if ($tags[$i]=='ssr'){
        $nombrevarget='';
        if (preg_match('/^[a-z\d_=]{1,200}$/i', $valores[$i])) {
            //$$tags[$i]=$valores[$i];
            $nombrevarget=$tags[$i];
            $$nombrevarget=$valores[$i];
        } else {
            //$$tags[$i]=0;
            $nombrevarget=$tags[$i];
            $$nombrevarget=0;
        }
    }
}

if($_SESSION['ces1313777_sessid_inicio']){

    $decodifica='';
    $separa_campos=explode("|",$_GET["ssr"]);
    $decodifica=base64_decode($separa_campos[0]);

    $splitvar=explode("&",@$decodifica);
    $nombreget='';

    for($ivari=0;$ivari<count($splitvar);$ivari++){
      $sacadatav=explode("=",$splitvar[$ivari]);  
      $nombreget=$sacadatav[0];
      @$$nombreget=$sacadatav[1];
    }

    $clie_id=$pVar2;
    $mnupan_id=$pVar3;
    $atenc_id=$pVar4;
    $eteneva_id=$pVar5;
    $valor_id=$separa_campos[1];

    $include_alt_dompdf = true;
    $director='../';
    include("../cfg/clases.php");
    require_once '../libreria/dompdf_/1.2.2/autoload.inc.php'; 
    include("../cfg/declaracion.php");
    
    $objformulario= new  ValidacionesFormulario();
    $objtableform= new templateform();
    
  
$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($mnupan_id));
$lista_atencion="select * from dns_atencion where atenc_id=?";
$rs_atencion = $DB_gogess->executec($lista_atencion,array($atenc_id));

$lista_tabla="select * from gogess_sistable,gogess_styletable where gogess_sistable.st_id=gogess_styletable.st_id and tab_id=".$rs_datosmenu->fields["tab_id"];
$rs_tabla = $DB_gogess->executec($lista_tabla,array());
//busca datos del paciente
$datos_cliente_ubicacion="select prov.prob_nombre,	canton.cant_nombre,	cliente.clie_parroquia 
from app_cliente cliente inner join cesdb_arcombos.app_provincia prov
on prov.prob_codigo = cliente.prob_codigo inner join cesdb_arcombos.app_canton canton
on canton.cant_codigo = cliente.cant_codigo 
where cliente.clie_id ='".$clie_id."'";
$rs_dcliente_ubicacion = $DB_gogess->executec($datos_cliente_ubicacion,array());


$datos_cliente="select * from app_cliente where clie_id=".$clie_id;
$rs_dcliente = $DB_gogess->executec($datos_cliente,array());



$nombre_paciente=$rs_dcliente->fields["clie_nombre"];
$apellido_paciente=$rs_dcliente->fields["clie_apellido"];
$direccion_paciente=$rs_dcliente->fields["clie_direccion"];
$parroquia_paciente=$rs_dcliente->fields["clie_parroquia"];
$clie_genero=$rs_dcliente->fields["clie_genero"];
$clie_genero_m = $clie_genero == "M" ? "x" : "";
$clie_genero_f = $clie_genero == "F" ? "x" : "";

$hc=$rs_atencion->fields["atenc_hc"];

$table=$rs_tabla->fields["tab_name"];  
$campo_primariodata=$rs_tabla->fields["tab_campoprimario"]; 
//$busca_sihaydata="select * from ".$table." where atenc_id=? and clie_id=?";
$busca_sihaydata="select * from ".$table." where  ".$campo_primariodata."=?";
$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array($valor_id));

$anam_fecharegistro=$rs_sihaydata->fields["anam_fecharegistro"];

$nomb_centro='';
$nomb_medico='';
$nomb_centro=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre","where centro_id=",$rs_sihaydata->fields["centro_id"],$DB_gogess);
$nomb_medico=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido","where usua_id=",$rs_sihaydata->fields["usua_id"],$DB_gogess);

$anam_enlace=$rs_sihaydata->fields["anam_enlace"];

$seguro_med_iess = strlen(trim($rs_sihaydata->fields["anam_iess"]))>0 && $rs_sihaydata->fields["anam_iess"]=="1" ? "x" : "";
$seguro_med_otro = strlen(trim($rs_sihaydata->fields["anam_otroseguro"]))>0 ? "x" : "";
$seguro_med = strlen($seguro_med_otro) > 0 ? $rs_sihaydata->fields["anam_otroseguro"] : "";

$formaLlegada = $rs_sihaydata->fields["anam_formallegada"];
$ambulatorio = "";
$sillaRuedas = "";
$camilla = "";
if($formaLlegada=="1") $ambulatorio = "x";
else if($formaLlegada=="2") $sillaRuedas = "x";
else if($formaLlegada=="3") $camilla = "x";

$viaAereaLibre = strlen(trim($rs_sihaydata->fields["anam_vialibre"]))>0 && $rs_sihaydata->fields["anam_vialibre"]=="1" ? "x" : "";
$viaAereaObst = strlen(trim($rs_sihaydata->fields["anam_viaobstruida"])) > 0 && $rs_sihaydata->fields["anam_viaobstruida"]=="1" ? "x" : "";

$condicionLlegadaEst = "";
$condicionLlegadaInest = "";
$condicionLlegadaOtro = "";
if(strlen(trim($rs_sihaydata->fields["anam_estable"]))>0 && $rs_sihaydata->fields["anam_estable"]=="1") $condicionLlegadaEst = "x";
if(strlen(trim($rs_sihaydata->fields["anam_inestable"]))>0 && $rs_sihaydata->fields["anam_inestable"]=="1") $condicionLlegadaInest = "x";
if(strlen(trim($rs_sihaydata->fields["anam_otracondicion"]))>0) $condicionLlegadaOtro = $rs_sihaydata->fields["anam_otracondicion"];

$tipoEv_accidente = "";
$tipoEv_env = "";
$tipoEv_vio = "";
$tipoEv_otro = "";
$tipoEv_otro_descrip = "";
if(strlen(trim($rs_sihaydata->fields["anam_accidente"]))>0 && $rs_sihaydata->fields["anam_accidente"]=="1") $tipoEv_accidente = "x";
if(strlen(trim($rs_sihaydata->fields["anam_envenenamiento"]))>0 && $rs_sihaydata->fields["anam_envenenamiento"]=="1") $tipoEv_env = "x";
if(strlen(trim($rs_sihaydata->fields["anam_violencia"]))>0 && $rs_sihaydata->fields["anam_violencia"]=="1") $tipoEv_vio = "x";
if(strlen(trim($rs_sihaydata->fields["anam_otroevento"]))>0 && $rs_sihaydata->fields["anam_otroevento"]=="1") {
    $tipoEv_otro = "x";
    $tipoEv_otro_descrip = $rs_sihaydata->fields["anam_otroevento"];
}

$custodiaPolicial = strlen(trim($rs_sihaydata->fields["anam_custodia"])) > 0 && $rs_sihaydata->fields["anam_custodia"]=="1" ? "x" : "";

$intoxicacion_alientoEtil = strlen(trim($rs_sihaydata->fields["anam_etilico"])) > 0 && $rs_sihaydata->fields["anam_etilico"]=="1" ? "x" : "";
$intoxicacion_alcoholemia = strlen(trim($rs_sihaydata->fields["anam_alcoholemia"])) > 0 && $rs_sihaydata->fields["anam_alcoholemia"]=="1" ? "x" : "";
$intoxicacion_otrasSustancia = strlen(trim($rs_sihaydata->fields["anam_otassustancias"])) > 0 && $rs_sihaydata->fields["anam_otassustancias"]=="1" ? "x" : "";

$vio_sospecha = strlen(trim($rs_sihaydata->fields["anam_sospecha"])) > 0 && $rs_sihaydata->fields["anam_sospecha"]=="1" ? "x" : "";
$vio_abfisico = strlen(trim($rs_sihaydata->fields["anam_abusofisico"])) > 0 && $rs_sihaydata->fields["anam_abusofisico"]=="1" ? "x" : "";
$vio_abpsico = strlen(trim($rs_sihaydata->fields["anam_abusopsico"])) > 0 && $rs_sihaydata->fields["anam_abusopsico"]=="1" ? "x" : "";
$vio_absex = strlen(trim($rs_sihaydata->fields["anam_abusosexual"])) > 0 && $rs_sihaydata->fields["anam_abusosexual"]=="1" ? "x" : "";

$quemadura_g1 = strlen(trim($rs_sihaydata->fields["anam_gradouno"])) > 0 && $rs_sihaydata->fields["anam_gradouno"]=="1" ? "x" : "";
$quemadura_g2 = strlen(trim($rs_sihaydata->fields["anam_gradodos"])) > 0 && $rs_sihaydata->fields["anam_gradodos"]=="1" ? "x" : "";
$quemadura_g3 = strlen(trim($rs_sihaydata->fields["anam_gradotres"])) > 0 && $rs_sihaydata->fields["anam_gradotres"]=="1" ? "x" : "";

$anteced_alergicos = strlen(trim($rs_sihaydata->fields["anam_alergicos"])) > 0 && $rs_sihaydata->fields["anam_alergicos"]=="1" ? "x" : "";
$anteced_clinic = strlen(trim($rs_sihaydata->fields["anam_clinicos"])) > 0 && $rs_sihaydata->fields["anam_clinicos"]=="1" ? "x" : "";
$anteced_gine = strlen(trim($rs_sihaydata->fields["anam_ginecologicos"])) > 0 && $rs_sihaydata->fields["anam_ginecologicos"]=="1" ? "x" : "";
$anteced_trauma = strlen(trim($rs_sihaydata->fields["anam_traumatologicos"])) > 0 && $rs_sihaydata->fields["anam_traumatologicos"]=="1" ? "x" : "";
$anteced_pedia = strlen(trim($rs_sihaydata->fields["anam_pediatricos"])) > 0 && $rs_sihaydata->fields["anam_pediatricos"]=="1" ? "x" : "";
$anteced_quirur = strlen(trim($rs_sihaydata->fields["anam_quirurgicos"])) > 0 && $rs_sihaydata->fields["anam_quirurgicos"]=="1" ? "x" : "";
$anteced_farma = strlen(trim($rs_sihaydata->fields["anam_farmacologicos"])) > 0 && $rs_sihaydata->fields["anam_farmacologicos"]=="1" ? "x" : "";
$anteced_otros = strlen(trim($rs_sihaydata->fields["anam_otrosapfr"])) > 0 && $rs_sihaydata->fields["anam_otrosapfr"]=="1" ? "x" : "";
$anteced_observaciones = $rs_sihaydata->fields["anam_observacionap"];

$datos_af='';
$antecedentes_familiares="select * from cesdb_arextension.dns_antecedentesfamiliares a inner join cesdb_arcombos.dns_tipofamiliar b on a.tipfam_id=b.tipfam_id where clie_id='".$clie_id."'";
$rs_af = $DB_gogess->executec($antecedentes_familiares,array());
if($rs_af) {
    while (!$rs_af->EOF) {
      $datos_af.=$rs_af->fields["tipfam_id"]." ".$rs_af->fields["antef_descripcion"].", ";
      $rs_af->MoveNext();
    }
}	

//signos vitales 
$sig_vitales="select * from dns_signosvitales where anam_enlace='".$anam_enlace."' order by signovita_fecharegistro desc limit 1";
$rs_svitales = $DB_gogess->executec($sig_vitales,array());
$signos_vit_presionArt = "";
$signos_vit_frecCard = "";
$signos_vit_frecResp = "";
$signos_vit_tempBuc = "";
$signos_vit_tempAxil = "";
$signos_vit_peso = "";
$signos_vit_talla = "";
$signos_vit_perimCef = "";

if(!$rs_svitales->EOF){
    $signos_vit_presionArt = $rs_svitales->fields["signovita_presionarterial"];
    $signos_vit_frecCard = $rs_svitales->fields["signovita_frecuenciacardiaca"];
    $signos_vit_frecResp = $rs_svitales->fields["signovita_frecuenciarespiratoria"];
    $signos_vit_tempBuc = $rs_svitales->fields["signovita_temperaturabucal"];
    $signos_vit_tempAxil = "";
    $signos_vit_peso = $rs_svitales->fields["signovita_peso"];
    $signos_vit_talla = $rs_svitales->fields["signovita_talla"];
    $signos_vit_perimCef = $rs_svitales->fields["signovita_perimetrocefalico"];
}

$sql="select * from cesdb_arextension.dns_gridglasgow where anam_enlace='".$anam_enlace."' order by glas_fecharegistro";
$rsGLASGOW = $DB_gogess->executec($sql,array());

$sig_vitalesGLASGOW_ocular = "";
$sig_vitalesGLASGOW_verbal = "";
$sig_vitalesGLASGOW_motora = "";
$sig_vitalesGLASGOW_total = "";
$sig_vitalesGLASGOW_reaccPupDer = "";
$sig_vitalesGLASGOW_reaccPupIzq = "";
$sig_vitalesGLASGOW_tLlenadoCap = "";
$sig_vitalesGLASGOW_observ = "";
    
if(!$rsGLASGOW->EOF){
    $sig_vitalesGLASGOW_ocular = $rsGLASGOW->fields["glas_ocular"];
    $sig_vitalesGLASGOW_verbal = $rsGLASGOW->fields["glas_versal"];
    $sig_vitalesGLASGOW_motora = $rsGLASGOW->fields["glas_motora"];
    $sig_vitalesGLASGOW_total = $rsGLASGOW->fields["glas_total"];
    $sig_vitalesGLASGOW_reaccPupDer = $rsGLASGOW->fields["glas_pupilarder"];
    $sig_vitalesGLASGOW_reaccPupIzq = $rsGLASGOW->fields["glas_pupilarizq"];
    $sig_vitalesGLASGOW_tLlenadoCap = $rsGLASGOW->fields["glas_capilar"];
    $sig_vitalesGLASGOW_observ = $rsGLASGOW->fields["glas_observacion"];
}

//diagrama topografico
$diagramTopo_HerPenetrante = strlen(trim($rs_sihaydata->fields["anam_penetrante"])) > 0 && $rs_sihaydata->fields["anam_penetrante"]=="1" ? "x" : "";
$diagramTopo_HerNoPenetrante = strlen(trim($rs_sihaydata->fields["anam_nopenetrante"])) > 0 && $rs_sihaydata->fields["anam_nopenetrante"]=="1" ? "x" : "";
$diagramTopo_FractExp = strlen(trim($rs_sihaydata->fields["anam_expuesta"])) > 0 && $rs_sihaydata->fields["anam_expuesta"]=="1" ? "x" : "";
$diagramTopo_FractCerr = strlen(trim($rs_sihaydata->fields["anam_cerrada"])) > 0 && $rs_sihaydata->fields["anam_cerrada"]=="1" ? "x" : "";
$diagramTopo_Amp = strlen(trim($rs_sihaydata->fields["anam_amputacion"])) > 0 && $rs_sihaydata->fields["anam_amputacion"]=="1" ? "x" : "";
$diagramTopo_Hemorr = strlen(trim($rs_sihaydata->fields["anam_hemorragia"])) > 0 && $rs_sihaydata->fields["anam_hemorragia"]=="1" ? "x" : "";
$diagramTopo_Mordedura = strlen(trim($rs_sihaydata->fields["anam_diagmordedura"])) > 0 && $rs_sihaydata->fields["anam_diagmordedura"]=="1" ? "x" : "";
$diagramTopo_Pica = strlen(trim($rs_sihaydata->fields["anam_diagpicadura"])) > 0 && $rs_sihaydata->fields["anam_diagpicadura"]=="1" ? "x" : "";
$diagramTopo_Excor = strlen(trim($rs_sihaydata->fields["anam_excoriacion"])) > 0 && $rs_sihaydata->fields["anam_excoriacion"]=="1" ? "x" : "";
$diagramTopo_Deform = strlen(trim($rs_sihaydata->fields["anam_masa"])) > 0 && $rs_sihaydata->fields["anam_masa"]=="1" ? "x" : "";
$diagramTopo_Hematoma = strlen(trim($rs_sihaydata->fields["anam_hematoma"])) > 0 && $rs_sihaydata->fields["anam_hematoma"]=="1" ? "x" : "";
$diagramTopo_QuemaG1 = strlen(trim($rs_sihaydata->fields["anam_gi"])) > 0 && $rs_sihaydata->fields["anam_gi"]=="1" ? "x" : "";
$diagramTopo_QuemaG2 = strlen(trim($rs_sihaydata->fields["anam_gii"])) > 0 && $rs_sihaydata->fields["anam_gii"]=="1" ? "x" : "";
$diagramTopo_QuemaG3 = strlen(trim($rs_sihaydata->fields["anam_giii"])) > 0 && $rs_sihaydata->fields["anam_giii"]=="1" ? "x" : "";
$diagramTopo_Otros1 = strlen(trim($rs_sihaydata->fields["anam_otrosdt"])) > 0 && $rs_sihaydata->fields["anam_otrosdt"]=="1" ? "x" : "";
$diagramTopo_Otros2 = strlen(trim($rs_sihaydata->fields["anam_otrosdtuno"])) > 0 && $rs_sihaydata->fields["anam_otrosdtuno"]=="1" ? "x" : "";

$movFetal = strlen(trim($rs_sihaydata->fields["anam_fetal"])) > 0 && $rs_sihaydata->fields["anam_fetal"]=="1" ? "x" : "";
$membRotas = strlen(trim($rs_sihaydata->fields["anam_rotas"])) > 0 && $rs_sihaydata->fields["anam_rotas"]=="1" ? "x" : "";


$pelvisUtil = strlen(trim($rs_sihaydata->fields["anam_pelvis"])) > 0 && $rs_sihaydata->fields["anam_pelvis"]=="1" ? "x" : "";
$sangradoVag = strlen(trim($rs_sihaydata->fields["anam_sangrado"])) > 0 && $rs_sihaydata->fields["anam_sangrado"]=="1" ? "x" : "";

$planDiag_biometria = strlen(trim($rs_sihaydata->fields["anam_biometria"])) > 0 && $rs_sihaydata->fields["anam_biometria"]=="1" ? "x" : "";
$planDiag_uro = strlen(trim($rs_sihaydata->fields["anam_uroanalisis"])) > 0 && $rs_sihaydata->fields["anam_uroanalisis"]=="1" ? "x" : "";
$planDiag_quimicaSang = strlen(trim($rs_sihaydata->fields["anam_quimicasanguinea"])) > 0 && $rs_sihaydata->fields["anam_quimicasanguinea"]=="1" ? "x" : "";
$planDiag_electrolitos = strlen(trim($rs_sihaydata->fields["anam_electrolitos"])) > 0 && $rs_sihaydata->fields["anam_electrolitos"]=="1" ? "x" : "";
$planDiag_gaso = strlen(trim($rs_sihaydata->fields["anam_gasometria"])) > 0 && $rs_sihaydata->fields["anam_gasometria"]=="1" ? "x" : "";
$planDiag_electrocardio = strlen(trim($rs_sihaydata->fields["anam_electrocardiograma"])) > 0 && $rs_sihaydata->fields["anam_electrocardiograma"]=="1" ? "x" : "";
$planDiag_endo = strlen(trim($rs_sihaydata->fields["anam_endoscopia"])) > 0 && $rs_sihaydata->fields["anam_endoscopia"]=="1" ? "x" : "";
$planDiag_rxtorax = strlen(trim($rs_sihaydata->fields["anam_rxtorax"])) > 0 && $rs_sihaydata->fields["anam_rxtorax"]=="1" ? "x" : "";
$planDiag_rxabdomen = strlen(trim($rs_sihaydata->fields["anam_rxabdomen"])) > 0 && $rs_sihaydata->fields["anam_rxabdomen"]=="1" ? "x" : "";
$planDiag_rxosea = strlen(trim($rs_sihaydata->fields["anam_rxosea"])) > 0 && $rs_sihaydata->fields["anam_rxosea"]=="1" ? "x" : "";
$planDiag_tomografia = strlen(trim($rs_sihaydata->fields["anam_tomografia"])) > 0 && $rs_sihaydata->fields["anam_tomografia"]=="1" ? "x" : "";
$planDiag_resonancia = strlen(trim($rs_sihaydata->fields["anam_resonancia"])) > 0 && $rs_sihaydata->fields["anam_resonancia"]=="1" ? "x" : "";
$planDiag_ecopelv = strlen(trim($rs_sihaydata->fields["anam_ecografiapelvica"])) > 0 && $rs_sihaydata->fields["anam_ecografiapelvica"]=="1" ? "x" : "";
$planDiag_ecoabdomen = strlen(trim($rs_sihaydata->fields["anam_ecoabdomen"])) > 0 && $rs_sihaydata->fields["anam_ecoabdomen"]=="1" ? "x" : "";
$planDiag_interconsult = strlen(trim($rs_sihaydata->fields["anam_interconsulta"])) > 0 && $rs_sihaydata->fields["anam_interconsulta"]=="1" ? "x" : "";
$planDiag_otros = "";


$salida_domicilio = strlen(trim($rs_sihaydata->fields["anam_domiciliosal"])) > 0 && $rs_sihaydata->fields["anam_domiciliosal"]=="1" ? "x" : "";
$salida_consultExt = strlen(trim($rs_sihaydata->fields["anam_conexterna"])) > 0 && $rs_sihaydata->fields["anam_conexterna"]=="1" ? "x" : "";
$salida_Observ = strlen(trim($rs_sihaydata->fields["anam_obssalida"])) > 0 && $rs_sihaydata->fields["anam_obssalida"]=="1" ? "x" : "";
$salida_intern = strlen(trim($rs_sihaydata->fields["anam_internacion"])) > 0 && $rs_sihaydata->fields["anam_internacion"]=="1" ? "x" : "";
$salida_vivo = strlen(trim($rs_sihaydata->fields["anam_vivo"])) > 0 && $rs_sihaydata->fields["anam_vivo"]=="1" ? "x" : "";
$salida_estable = strlen(trim($rs_sihaydata->fields["anam_establesal"])) > 0 && $rs_sihaydata->fields["anam_establesal"]=="1" ? "x" : "";
$salida_inestable = strlen(trim($rs_sihaydata->fields["anam_inestablesal"])) > 0 && $rs_sihaydata->fields["anam_inestablesal"]=="1" ? "x" : "";
$salida_muertoEmerg = strlen(trim($rs_sihaydata->fields["anam_muertoemergencia"])) > 0 && $rs_sihaydata->fields["anam_muertoemergencia"]=="1" ? "x" : "";

//6 data caracteristicas del dolor
$sql=<<<SQL
    SELECT  
        x.dolor_anatomica,
        x.dolor_doloroso,
        
        x.dolor_agudo,
        x.dolor_subagudo,
        x.dolor_cronico,
        x.dolor_episodico,
        x.dolor_continuo,
        x.dolor_colico,
        x.dolor_posicion,
        x.dolor_ingesta,
        x.dolor_esfuerzo,
        x.dolor_presion,
        x.dolor_irradia,
        x.dolor_pasmodico,
        x.dolor_opiaceo,
        x.dolor_aine,
        x.dolor_noalivia,
        dnsopt.opcion_opcionuno intensidad 
        
    FROM cesdb_arextension.dns_dolor x INNER JOIN dns_opciones dnsopt
    ON dnsopt.opcion_id = x.dolor_intensidad 
    WHERE x.anam_enlace='{$anam_enlace}' 
    ORDER BY x.dolor_fecharegistro DESC
SQL;
$rsCaractDolor = $DB_gogess->executec($sql,array());
$htmlTable6 = "";

if(!$rsCaractDolor->EOF){
    while(!$rsCaractDolor->EOF){
        $caractDolor_agudo = strlen(trim($rsCaractDolor->fields["dolor_agudo"])) > 0 && $rsCaractDolor->fields["dolor_agudo"]=="1" ? "x" : "";
        $caractDolor_subagudo = strlen(trim($rsCaractDolor->fields["dolor_subagudo"])) > 0 && $rsCaractDolor->fields["dolor_subagudo"]=="1" ? "x" : "";
        $caractDolor_cronico = strlen(trim($rsCaractDolor->fields["dolor_cronico"])) > 0 && $rsCaractDolor->fields["dolor_cronico"]=="1" ? "x" : "";
        $caractDolor_epis = strlen(trim($rsCaractDolor->fields["dolor_episodico"])) > 0 && $rsCaractDolor->fields["dolor_episodico"]=="1" ? "x" : "";
        $caractDolor_continuo = strlen(trim($rsCaractDolor->fields["dolor_continuo"])) > 0 && $rsCaractDolor->fields["dolor_continuo"]=="1" ? "x" : "";
        $caractDolor_colico = strlen(trim($rsCaractDolor->fields["dolor_colico"])) > 0 && $rsCaractDolor->fields["dolor_colico"]=="1" ? "x" : "";
        $caractDolor_posicion = strlen(trim($rsCaractDolor->fields["dolor_posicion"])) > 0 && $rsCaractDolor->fields["dolor_posicion"]=="1" ? "x" : "";
        $caractDolor_ingesta = strlen(trim($rsCaractDolor->fields["dolor_ingesta"])) > 0 && $rsCaractDolor->fields["dolor_ingesta"]=="1" ? "x" : "";
        $caractDolor_esfuerzo = strlen(trim($rsCaractDolor->fields["dolor_esfuerzo"])) > 0 && $rsCaractDolor->fields["dolor_esfuerzo"]=="1" ? "x" : "";
        $caractDolor_presion = strlen(trim($rsCaractDolor->fields["dolor_presion"])) > 0 && $rsCaractDolor->fields["dolor_presion"]=="1" ? "x" : "";
        $caractDolor_irradia = strlen(trim($rsCaractDolor->fields["dolor_irradia"])) > 0 && $rsCaractDolor->fields["dolor_irradia"]=="1" ? "x" : "";
        $caractDolor_pasmodico = strlen(trim($rsCaractDolor->fields["dolor_pasmodico"])) > 0 && $rsCaractDolor->fields["dolor_pasmodico"]=="1" ? "x" : "";
        $caractDolor_opiaceo = strlen(trim($rsCaractDolor->fields["dolor_opiaceo"])) > 0 && $rsCaractDolor->fields["dolor_opiaceo"]=="1" ? "x" : "";
        $caractDolor_aine = strlen(trim($rsCaractDolor->fields["dolor_aine"])) > 0 && $rsCaractDolor->fields["dolor_aine"]=="1" ? "x" : "";
        $caractDolor_noalivia = strlen(trim($rsCaractDolor->fields["dolor_noalivia"])) > 0 && $rsCaractDolor->fields["dolor_noalivia"]=="1" ? "x" : "";
        
        //*
        $htmlTable6 .= <<<TEMPLATE
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 4cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$rsCaractDolor->fields["dolor_anatomica"]}</div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 3.91cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$rsCaractDolor->fields["dolor_doloroso"]}</div></td>

                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$caractDolor_agudo}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$caractDolor_subagudo}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.56cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$caractDolor_cronico}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$caractDolor_epis}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$caractDolor_continuo}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.56cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$caractDolor_colico}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$caractDolor_posicion}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$caractDolor_ingesta}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$caractDolor_esfuerzo}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$caractDolor_presion}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.52cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$caractDolor_irradia}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$caractDolor_pasmodico}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$caractDolor_opiaceo}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$caractDolor_aine}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.54cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$caractDolor_noalivia}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="fs-6 hidden-content" style="width: 1.26cm; height:0.4cm; text-align:center; line-height:0.3cm;">{$rsCaractDolor->fields["intensidad"]}</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
TEMPLATE;
        //*/
        $rsCaractDolor->MoveNext();
    }
}
//*/

//8 examen fisico
$organoEvidPatolog = [];
$organoEvidPatologDetalle = "";
$sql=<<<SQL
    SELECT  
        x.opcexa_id,
        x.tiporg_nombre,
        x.gexamfis_observacion,
        x.gexamfis_fecharegistro,
        z.opcexa_nombre,
        z.opcexa_tipo
        
    FROM cesdb_arextension.dns_emergenciagridexamenfisico x INNER JOIN cesdb_arcombos.dns_opcionexamenfisico z
    ON z.opcexa_id = x.opcexa_id
    WHERE x.anam_enlace='{$anam_enlace}' 
    ORDER BY z.opcexa_orden ASC
SQL;
$rsPatolog = $DB_gogess->executec($sql,array());
while(!$rsPatolog->EOF){
    $organoEvidPatolog[$rsPatolog->fields["opcexa_id"]] = ["name"=>$rsPatolog->fields["opcexa_nombre"], "tipo"=>$rsPatolog->fields["opcexa_tipo"], "cp"=>strlen(trim($rsPatolog->fields["tiporg_nombre"])) > 0 && $rsPatolog->fields["tiporg_nombre"]=="CP" ? "x" : "", "sp"=>trim($rsPatolog->fields["tiporg_nombre"])!="CP" ? "x" : "", "observ"=>$rsPatolog->fields["gexamfis_observacion"]];
    if(strlen(trim($rsPatolog->fields["tiporg_nombre"])) > 0 && $rsPatolog->fields["tiporg_nombre"]=="CP"){
        $organoEvidPatologDetalle .= <<<DATA
        {$rsPatolog->fields["opcexa_nombre"]} Tipo: {$rsPatolog->fields["tiporg_nombre"]} Descripción: {$rsPatolog->fields["gexamfis_observacion"]} Fecha Registro: {$rsPatolog->fields["gexamfis_fecharegistro"]}<br>
DATA;
    }
    $rsPatolog->MoveNext();
}

//13, 14
$sql=<<<SQL
    SELECT  
        x.diagn_cie,
        x.diagn_descripcion,
        x.diagn_tipo,
        x.diagn_fecharegistro
    FROM cesdb_arextension.dns_emergenciadiagnosticoanamnesis x 
    WHERE x.anam_enlace='{$anam_enlace}' 
    ORDER BY x.diagn_fecharegistro, x.diagn_tipo ASC
SQL;
$rsDiagnost = $DB_gogess->executec($sql,array());
$aDiagnostPresuntivo = [];
$aDiagnostDefinitivo = [];

while(!$rsDiagnost->EOF){
    if(trim($rsDiagnost->fields["diagn_tipo"]) == "DEFINITIVO"){
        $aDiagnostDefinitivo[] = ["cie"=>$rsDiagnost->fields["diagn_cie"], "descripcion"=>$rsDiagnost->fields["diagn_descripcion"]];
    } else {
        $aDiagnostPresuntivo[] = ["cie"=>$rsDiagnost->fields["diagn_cie"], "descripcion"=>$rsDiagnost->fields["diagn_descripcion"]];
    }
    $rsDiagnost->MoveNext();
}

$htmlTable13 = "";
$htmlTable14 = "";

$num=0;
for($g=0; $g<count($aDiagnostPresuntivo); $g++){
    $num++;
    $htmlTable13 .= <<<HTML
        <tr>
            <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-left:0.02cm solid #000; border-right:0.02cm solid #000; border-bottom:0.02cm solid #000;">{$num}</div></td>
            <td style="margin:0px; padding:0px;"><div class="bg-white fs-6" style="width: 6.85cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-right:0.02cm solid #000; border-bottom:0.02cm solid #000;">{$aDiagnostPresuntivo[$g]["descripcion"]}</div></td>
            <td style="margin:0px; padding:0px;"><div class="bg-white fs-6" style="width: 1.16cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000; border-bottom:0.02cm solid #000;">{$aDiagnostPresuntivo[$g]["cie"]}</div></td>
        </tr>
HTML;
}

$num=0;
for($g=0; $g<count($aDiagnostDefinitivo); $g++){
    $num++;
    $htmlTable14 .= <<<HTML
        <tr>
            <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000; border-bottom:0.02cm solid #000;">{$num}</div></td>
            <td style="margin:0px; padding:0px;"><div class="bg-white fs-6" style="width: 6.82cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-right:0.02cm solid #000; border-bottom:0.02cm solid #000;">{$aDiagnostDefinitivo[$g]["descripcion"]}</div></td>
            <td style="margin:0px; padding:0px;"><div class=" fs-6" style="width: 1.20cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000; border-bottom:0.02cm solid #000;">{$aDiagnostDefinitivo[$g]["cie"]}</div></td>
        </tr>
HTML;
}

//15
$planTrat_indicacionesGen = strlen(trim($rs_sihaydata->fields["anam_indicacionesgeneral"])) > 0 && $rs_sihaydata->fields["anam_indicacionesgeneral"]=="1" ? "x" : "";
$planTrat_Proced = strlen(trim($rs_sihaydata->fields["anam_procedimientos"])) > 0 && $rs_sihaydata->fields["anam_procedimientos"]=="1" ? "x" : "";
$planTrat_ConsentInform = strlen(trim($rs_sihaydata->fields["anam_conceninformado"])) > 0 && $rs_sihaydata->fields["anam_conceninformado"]=="1" ? "x" : "";
$planTrat_Otros = strlen(trim($rs_sihaydata->fields["anam_otrosplanemergencia"])) > 0 && $rs_sihaydata->fields["anam_otrosplanemergencia"]=="1" ? "x" : "";
$planTrat_Detalle = $rs_sihaydata->fields["anam_obsplanemergencia"];

$sql=<<<SQL
    SELECT  
        x.planeme_medicamento,
        x.planeme_via,
        x.planeme_dosis,
        x.planeme_posologia,
        x.planeme_dias
        
    FROM cesdb_arextension.dns_planemergencia x 
    WHERE x.anam_enlace='{$anam_enlace}' 
    ORDER BY x.planeme_fecharegistro ASC
SQL;
$rsPlanTrat = $DB_gogess->executec($sql,array());
$num = 0;
$htmlTable15 = "";
while(!$rsPlanTrat->EOF){
    $num++;
    $htmlTable15 .= <<<HTML
        <tr>
            <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-left:0.02cm solid #000; border-bottom:0.02cm solid #000;">{$num}</div></td>
            <td style="margin:0px; padding:0px;"><div class="bg-white fs-6" style="width: 4.78cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-left:0.02cm solid #000; border-bottom:0.02cm solid #000;">{$rsPlanTrat->fields["planeme_medicamento"]}</div></td>
            <td style="margin:0px; padding:0px;"><div class="bg-white fs-6" style="width: 0.8cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-left:0.02cm solid #000; border-bottom:0.02cm solid #000;">{$rsPlanTrat->fields["planeme_via"]}</div></td>
            <td style="margin:0px; padding:0px;"><div class="bg-white fs-6" style="width: 0.8cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-left:0.02cm solid #000; border-bottom:0.02cm solid #000;">{$rsPlanTrat->fields["planeme_dosis"]}</div></td>
            <td style="margin:0px; padding:0px;"><div class="bg-white fs-6" style="width: 0.8cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-left:0.02cm solid #000; border-bottom:0.02cm solid #000;">{$rsPlanTrat->fields["planeme_posologia"]}</div></td>
            <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 0.76cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-left:0.02cm solid #000; border-right:0.02cm solid #000; border-bottom:0.02cm solid #000;">{$rsPlanTrat->fields["planeme_dias"]}</div></td>
        </tr>
HTML;
    $rsPlanTrat->MoveNext();
}

//**********************************************************************************************************************************************


$separa_fecha_hora=explode(" ",$anam_fecharegistro);

//Getting image
$image=file_get_contents("../templateformsweb/maestro_standar_emergenciaanam/images/diagramatopografico.jpg");
$imagedata=base64_encode($image);
$mimect = "image/jpg";
$imgpath='<img style="width: 7.77cm; height: 7.3cm;" src="data:'.$mimect.';base64, '.$imagedata.'" />';

//PDF Generate 
$comprobantepdf=ob_get_clean();
$comprobantepdf=<<<TEMPLATE
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <style>
            .tr-common-bg {
                background-color: #CCFFCC;
            }
            .tr-header-bg {
                background-color: #FF99FF;
            }
            .bg-white {
                background-color: #FFF;
            }
            .bg-yellow {
                background-color: #FFFF99;
            }
            .hidden-content {
                overflow: hidden;
            }
            .fw-bold {
                font-weight: bold;
            }
            .fs-5 {
                font-size: 5px;
            }
            .fs-6 {
                font-size: 6px;
            }
            .fs-7 {
                font-size: 7px;
            }
            .fs-8 {
                font-size: 8px;
            }
            .text-rotate-90 {
                -moz-transform: rotate(-90.0deg);  /* FF3.5+ */
                -o-transform: rotate(-90.0deg);  /* Opera 10.5 */
                -webkit-transform: rotate(-90.0deg);  /* Saf3.1+, Chrome */
                filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);  /* IE6,IE7 */
                -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)"; /* IE8 */
            }
        </style>
    </head>
    <body>
    <!-- 17.1 width + 0.1cm borders -->
    <main>
    <div style="font-size:11px;">
        <!-- #0 -->
        <table border="0" style="border-collapse: collapse; margin-bottom:0.1cm;">
            <tr>
                <td style="margin:0px; padding:0px; border-top:0.02cm solid #000; border-left:0.02cm solid #000;"><div class="tr-common-bg" style="width: 4.3cm; font-weight:bold; text-align:center; border-right:0.02cm solid #CCFFCC;">INSTITUCI&Oacute;N DEL SISTEMA</div></td>
                <td style="margin:0px; padding:0px; border-top:0.02cm solid #000;"><div class="tr-common-bg" style="width: 5cm; font-weight:bold; text-align:center; border-right:0.02cm solid #CCFFCC;">UNIDAD OPERATIVA</div></td>
                <td style="margin:0px; padding:0px; border-top:0.02cm solid #000;"><div class="tr-common-bg" style="width: 1.3cm; font-weight:bold; text-align:center; border-right:0.02cm solid #CCFFCC;">C&Oacute;DIGO</div></td>
                <td style="margin:0px; padding:0px; border-top:0.02cm solid #000; border-right:0.02cm solid #000;"><div class="tr-common-bg" style="width: 3.3cm; font-weight:bold; text-align:center; border-right:0.02cm solid #CCFFCC;">LOCALIZACI&Oacute;N</div></td>
                <td style="margin:0px; padding:0px; border-top:0.02cm solid #000; border-right:0.02cm solid #000; border-left:0.02cm solid #000;"><div class="tr-common-bg" style="width: 3.2cm; font-weight:bold; text-align:center;">N° HISTORIA CL&Iacute;NICA</div></td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000; "><div class="fs-8" style="width: 4.3cm; height:0.8cm; text-align:center; overflow:hidden; line-height:0.6cm;">{$nomb_centro}</div></td>
                <td style="margin:0px; padding:0px; border-top:0.02cm solid #000; border-right:0.02cm solid #000; border-bottom:0.02cm solid #000;"><div class="fs-8" style="width: 5cm; height:0.8cm; text-align:center; overflow:hidden; line-height:0.6cm;"><!-- ## -->&nbsp;</div></td>
                <td style="margin:0px; padding:0px; border-top:0.02cm solid #000; border-right:0.02cm solid #000; border-bottom:0.02cm solid #000;"><div class="fs-8" style="width: 1.3cm; height:0.8cm; text-align:center; overflow:hidden; line-height:0.6cm;"><!-- ## -->&nbsp;</div></td>
                <td style="margin:0px; padding:0px; border-top:0.02cm solid #000; border-right:0.02cm solid #000; border-bottom:0.02cm solid #000; ">
                    <div style="width: 3.3cm; height:0.8cm; text-align:center; font-size:6px;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg" style="width:1.1cm; height: 0.3cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #CCFFCC;">PARROQUIA</div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg" style="width:1.1cm; height: 0.3cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #CCFFCC;">CANT&Oacute;N</div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg" style="width:1.1cm; height: 0.3cm; text-align:center; line-height:0.3cm;">PROVINCIA</div></td>
                            </tr>
                            <tr>
                                <td style="margin:0px; padding:0px;"><div style="width:1.1cm; height: 0.5cm; text-align:center; border-right:0.02cm solid #000; border-top:0.02cm solid #000; overflow:hidden; line-height:0.4cm;">{$parroquia_paciente}</div></td>
                                <td style="margin:0px; padding:0px;"><div style="width:1.1cm; height: 0.5cm; text-align:center; border-right:0.02cm solid #000; border-top:0.02cm solid #000; overflow:hidden; line-height:0.4cm;">{$rs_dcliente_ubicacion->fields["cant_nombre"]}</div></td>
                                <td style="margin:0px; padding:0px;"><div style="width:1.08cm; height: 0.5cm; text-align:center; border-top:0.02cm solid #000; overflow:hidden; line-height:0.4cm;">{$rs_dcliente_ubicacion->fields["prob_nombre"]}</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
                <td style="margin:0px; padding:0px; border-top:0.02cm solid #000; border-right:0.02cm solid #000; border-bottom:0.02cm solid #000;"><div class="fs-8" style="width: 3.2cm; height:0.8cm; text-align:center; overflow:hidden; line-height:0.6cm;">{$hc}</div></td>
            </tr>
        </table>
        
        <!-- #1 -->
        <table border="0" style="border-collapse: collapse;">
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;"><div class="tr-header-bg" style="width: 17.2cm; font-weight:bold; text-align:left;">&nbsp;&nbsp;1&nbsp;&nbsp;REGISTRO DE ADMISI&Oacute;N</div></td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-8" style="width: 3.5cm; text-align:center; border-right:0.02cm solid #CCFFCC;">APELLIDO PATERNO</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-8" style="width: 3.5cm; text-align:center; border-right:0.02cm solid #CCFFCC;">APELLIDO MATERNO</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-8" style="width: 4.8cm; text-align:center; border-right:0.02cm solid #CCFFCC;">NOMBRES</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-8" style="width: 2.2cm; text-align:center; border-right:0.02cm solid #CCFFCC;">NACIONALIDAD</div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-8" style="width: 3.1cm; text-align:center; border-right:0.02cm solid #CCFFCC;">N° C&Eacute;DULA DE CIUDADAN&Iacute;A</div></td>
                            </tr>
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="fs-8" style="border-top:0.02cm solid #000; border-right: 0.02cm solid #000; width: 3.5cm; text-align:center; overflow:hidden;">{$apellido_paciente}</div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-8" style="border-top:0.02cm solid #000; border-right: 0.02cm solid #000; width: 3.5cm; text-align:center; overflow:hidden;">{$apellido_paciente}</div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-8" style="border-top:0.02cm solid #000; border-right: 0.02cm solid #000; width: 4.8cm; text-align:center; overflow:hidden;">{$nombre_paciente}</div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-8" style="border-top:0.02cm solid #000; border-right: 0.02cm solid #000; width: 2.2cm; text-align:center; overflow:hidden;"><!-- ## -->&nbsp;</div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-8" style="border-top:0.02cm solid #000; width: 3.14cm; text-align:center; overflow:hidden;">{$hc}</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-8" style="width: 10.6cm; text-align:center; border-right:0.02cm solid #CCFFCC;">DIRECCI&Oacute;N DE RESIDENCIA HABITUAL</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-8" style="width: 1.6cm; text-align:center; border-right:0.02cm solid #CCFFCC;">CANT&Oacute;N</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-8" style="width: 1.82cm; text-align:center; border-right:0.02cm solid #CCFFCC;">PROVINCIA</div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-8" style="width: 3.08cm; text-align:center; border-right:0.03cm solid #CCFFCC;">N° TEL&Eacute;FONO</div></td>
                            </tr>
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="fs-8" style="border-top:0.02cm solid #000; border-right: 0.02cm solid #000; width: 10.6cm; text-align:center; overflow:hidden;">{$direccion_paciente}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="fs-8" style="border-top:0.02cm solid #000; border-right: 0.02cm solid #000; width: 1.6cm; text-align:center; overflow:hidden;">{$rs_dcliente_ubicacion->fields["cant_nombre"]}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="fs-8" style="border-top:0.02cm solid #000; border-right: 0.02cm solid #000; width: 1.82cm; text-align:center; overflow:hidden;">{$rs_dcliente_ubicacion->fields["prob_nombre"]}</div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-8" style="border-top:0.02cm solid #000; width: 3.13cm; text-align:center; overflow:hidden;"><!-- ## -->&nbsp;</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-8" style="width: 2.1cm; height:0.8cm; line-height:0.4cm; text-align:center; border-right:0.02cm solid #000;">FECHA DE ATENCI&Oacute;N</div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-8" style="width: 1.9cm; height:0.8cm; line-height:0.6cm; text-align:center; border-right:0.02cm solid #000;">HORA</div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-8" style="width: 1.3cm; height:0.8cm; line-height:0.6cm; text-align:center; border-right:0.02cm solid #000;">EDAD</div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-8" style="width: 1.1cm; height:0.8cm; text-align:center; border-right:0.02cm solid #000;">
                                    <table border="0" style="border-collapse: collapse;">
                                        <tr>
                                            <td colspan="2" style="margin:0px; padding:0px;"><div class="tr-common-bg fs-8" style="width: 1.1cm; height:0.4cm; text-align:center; border-bottom:0.02cm solid #000;">SEXO</div></td>
                                        </tr>
                                        <tr>
                                            <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">MAS</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; line-height:0.3cm;">FEM</div></td>
                                        </tr>
                                    </table>
                                </div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-8" style="width: 2.6cm; height:0.8cm; text-align:center; border-right:0.02cm solid #000;">
                                    <table border="0" style="border-collapse: collapse;">
                                        <tr>
                                            <td colspan="5" style="margin:0px; padding:0px;"><div class="tr-common-bg fs-8" style="width: 2.6cm; height:0.4cm; text-align:center; border-bottom:0.02cm solid #000;">ESTADO CIVIL</div></td>
                                        </tr>
                                        <tr>
                                            <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">SOL</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">CAS</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">DIV</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">VIU</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; line-height:0.3cm;">UL</div></td>
                                        </tr>
                                    </table>
                                </div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-8" style="width: 2.6cm; height:0.8cm; text-align:center; border-right:0.02cm solid #000;">
                                    <table border="0" style="border-collapse: collapse;">
                                        <tr>
                                            <td colspan="5" style="margin:0px; padding:0px;"><div class="tr-common-bg fs-8" style="width: 2.6cm; height:0.4cm; text-align:center; border-bottom:0.02cm solid #000;">INSTRUCCI&Oacute;N</div></td>
                                        </tr>
                                        <tr>
                                            <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">SIN</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">BASI</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">BACH</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">SUPE</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.45cm; height:0.4cm; text-align:center; line-height:0.3cm;">ESPE</div></td>
                                        </tr>
                                    </table>
                                </div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-8" style="width: 2.34cm; height:0.8cm; line-height:0.6cm; text-align:center; border-right:0.02cm solid #000;">OCUPACI&Oacute;N</div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-8" style="width: 3.1cm; height:0.8cm; text-align:center; border-right:0.02cm solid #CCFFCC;">
                                    <table border="0" style="border-collapse: collapse;">
                                        <tr>
                                            <td colspan="4" style="margin:0px; padding:0px;"><div class="tr-common-bg fs-8" style="width: 3.13cm; height:0.4cm; text-align:center; border-bottom:0.02cm solid #000;">N° SEGURO DE SALUD</div></td>
                                        </tr>
                                        <tr>
                                            <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">IESS</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$seguro_med_iess}</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">OTRO</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.54cm; height:0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #FFFF99;">{$seguro_med_otro}</div></td>
                                        </tr>
                                    </table>
                                </div></td>
                            </tr>
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="fs-8" style="border-top:0.02cm solid #000; border-right: 0.02cm solid #000; width: 2.1cm; text-align:center; overflow:hidden;">{$rs_sihaydata->fields["anam_fechaatencion"]}</div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-8" style="border-top:0.02cm solid #000; border-right: 0.02cm solid #000; width: 1.9cm; text-align:center; overflow:hidden;"><!-- ## -->&nbsp;</div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-8" style="border-top:0.02cm solid #000; border-right: 0.02cm solid #000; width: 1.3cm; text-align:center; overflow:hidden;"><!-- ## -->&nbsp;</div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-8" style="border-top:0.02cm solid #000; border-right: 0.02cm solid #000; width: 1.1cm; text-align:center; overflow:hidden;">
                                    <table border="0" style="border-collapse: collapse;">
                                        <tr>
                                            <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.25cm; text-align:center; border-right:0.02cm solid #000;">{$clie_genero_m}</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.56cm; height:0.25cm; text-align:center; border-right:0.02cm solid #FFFF99;">{$clie_genero_f}</div></td>
                                        </tr>
                                    </table>
                                </div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-8" style="border-top:0.02cm solid #000; border-right: 0.02cm solid #000; width: 2.6cm; text-align:center; overflow:hidden;">
                                    <table border="0" style="border-collapse: collapse;">
                                        <tr>
                                            <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.25cm; text-align:center; border-right:0.02cm solid #000;"><!-- ## -->&nbsp;</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.25cm; text-align:center; border-right:0.02cm solid #000;"><!-- ## -->&nbsp;</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.25cm; text-align:center; border-right:0.02cm solid #000;"><!-- ## -->&nbsp;</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.25cm; text-align:center; border-right:0.02cm solid #000;"><!-- ## -->&nbsp;</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.25cm; text-align:center; border-right:0.02cm solid #FFFF99;"><!-- ## -->&nbsp;</div></td>
                                        </tr>
                                    </table>
                                </div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-8" style="border-top:0.02cm solid #000; border-right: 0.02cm solid #000; width: 2.6cm; text-align:center; overflow:hidden;">
                                    <table border="0" style="border-collapse: collapse;">
                                        <tr>
                                            <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.25cm; text-align:center; border-right:0.02cm solid #000;"><!-- ## -->&nbsp;</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.25cm; text-align:center; border-right:0.02cm solid #000;"><!-- ## -->&nbsp;</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.25cm; text-align:center; border-right:0.02cm solid #000;"><!-- ## -->&nbsp;</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.25cm; text-align:center; border-right:0.02cm solid #000;"><!-- ## -->&nbsp;</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.25cm; text-align:center; border-right:0.02cm solid #FFFF99;"><!-- ## -->&nbsp;</div></td>
                                        </tr>
                                    </table>
                                </div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-8" style="border-top:0.02cm solid #000; border-right: 0.02cm solid #000; width: 2.34cm; text-align:center; overflow:hidden;"><!-- ## -->&nbsp;</div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-8" style="border-top:0.02cm solid #000; width: 3.13cm; text-align:center; overflow:hidden;">{$seguro_med}</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 5.7cm; text-align:center; border-right:0.02cm solid #CCFFCC;">NOMBRE DE LA PERSONA PARA NOTIFICACI&Oacute;N</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6" style="width: 2.4cm; text-align:center; border-right:0.02cm solid #CCFFCC;">PARENTESCO O AFINIDAD</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6" style="width: 5.92cm; text-align:center; border-right:0.02cm solid #CCFFCC;">DIRECCI&Oacute;N</div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 3.09cm; text-align:center; border-right:0.03cm solid #CCFFCC;">N° TEL&Eacute;FONO</div></td>
                            </tr>
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="border-top:0.02cm solid #000; border-right: 0.02cm solid #000; width: 5.7cm; height:0.4cm; text-align:center; overflow:hidden; line-height:0.3cm;">{$rs_sihaydata->fields["anam_personanotificacion"]}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="fs-6" style="border-top:0.02cm solid #000; border-right: 0.02cm solid #000; width: 2.4cm; height:0.4cm; text-align:center; overflow:hidden; line-height:0.3cm;">{$rs_sihaydata->fields["anam_parentesco"]}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="fs-6" style="border-top:0.02cm solid #000; border-right: 0.02cm solid #000; width: 5.92cm; height:0.4cm; text-align:center; overflow:hidden; line-height:0.3cm;">{$rs_sihaydata->fields["anam_direccionnotificacion"]}</div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="border-top:0.02cm solid #000; width: 3.12cm; height:0.4cm; text-align:center; overflow:hidden; line-height:0.3cm;">{$rs_sihaydata->fields["anam_telefononotificacion"]}</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 5.7cm; text-align:center; border-right:0.02cm solid #CCFFCC;">NOMBRE DEL ACOMPA&Ntilde;ANTE</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6" style="width: 2.4cm; text-align:center; border-right:0.02cm solid #CCFFCC;">N° C&Eacute;DULA DE IDENTIDAD</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6" style="width: 5.92cm; text-align:center; border-right:0.02cm solid #CCFFCC;">DIRECCI&Oacute;N</div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 3.09cm; text-align:center; border-right:0.03cm solid #CCFFCC;">N° TEL&Eacute;FONO</div></td>
                            </tr>
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="border-top:0.02cm solid #000; border-right: 0.02cm solid #000; width: 5.7cm; height:0.4cm; text-align:center; overflow:hidden; line-height:0.3cm;">{$rs_sihaydata->fields["anam_acompanante"]}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="fs-6" style="border-top:0.02cm solid #000; border-right: 0.02cm solid #000; width: 2.4cm; height:0.4cm; text-align:center; overflow:hidden; line-height:0.3cm;">{$rs_sihaydata->fields["anam_ciacompanante"]}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="fs-6" style="border-top:0.02cm solid #000; border-right: 0.02cm solid #000; width: 5.92cm; height:0.4cm; text-align:center; overflow:hidden; line-height:0.3cm;">{$rs_sihaydata->fields["anam_direccionacompanante"]}</div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="border-top:0.02cm solid #000; width: 3.12cm; height:0.4cm; text-align:center; overflow:hidden; line-height:0.3cm;">{$rs_sihaydata->fields["anam_telefonoacompanante"]}</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 5.7cm; text-align:center; border-right:0.02cm solid #CCFFCC;">FORMA DE LLEGADA</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6" style="width: 2.4cm; text-align:center; border-right:0.02cm solid #CCFFCC;">FUENTE DE INFORMACI&Oacute;N</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6" style="width: 5.92cm; text-align:center; border-right:0.02cm solid #CCFFCC;">INSTITUCI&Oacute;N O PERSONA QUE ENTREGA AL PACIENTE</div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 3.09cm; text-align:center; border-right:0.03cm solid #CCFFCC;">N° TEL&Eacute;FONO</div></td>
                            </tr>
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="border-top:0.02cm solid #000; border-right: 0.02cm solid #000; width: 5.7cm; text-align:center; overflow:hidden;">
                                    <table border="0" style="border-collapse: collapse;">
                                        <tr>
                                            <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">AMBULATORIO</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$ambulatorio}</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.4cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.2cm;">SILLA DE RUEDAS</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$sillaRuedas}</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">CAMILLA</div></td>
                                            <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.57cm; height:0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #FFFF99;">{$camilla}</div></td>
                                        </tr>
                                    </table>
                                </div></td>
                                <td style="margin:0px; padding:0px; "><div class="fs-6" style="border-top:0.02cm solid #000; border-right: 0.02cm solid #000; width: 2.4cm; height:0.4cm; text-align:center; overflow:hidden; line-height:0.3cm;">{$rs_sihaydata->fields["anam_fuenteinfo"]}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="fs-6" style="border-top:0.02cm solid #000; border-right: 0.02cm solid #000; width: 5.92cm; height:0.4cm; text-align:center; overflow:hidden; line-height:0.3cm;">{$rs_sihaydata->fields["anam_entregapaciente"]}</div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="border-top:0.02cm solid #000; width: 3.12cm; height:0.4cm; text-align:center; overflow:hidden; line-height:0.3cm;">{$rs_sihaydata->fields["anam_telefonoentrega"]}</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px;">
                    <div style="width: 17.2cm; text-align:center;" class="fs-5">
                        MAS = MASCULINO&nbsp;&nbsp;FEM = FEMENINO&nbsp;&nbsp;SOL = SOLTERO&nbsp;&nbsp;CAS = CASADO&nbsp;&nbsp;DIV = DIVORCIADO&nbsp;&nbsp;VIU = VIUDO&nbsp;&nbsp;UL = UNI&Oacute;N LIBRE&nbsp;&nbsp;SIN = SIN INSTRUCCI&Oacute;N&nbsp;&nbsp;BASI = B&Aacute;SICA&nbsp;&nbsp;BACH = BACHILLERATO&nbsp;&nbsp;SUPE = SUPERIOR&nbsp;&nbsp;ESPE = ESPECIAL
                    </div>
                </td>
            </tr>
        </table>
        
        <!-- #2 -->
        <table border="0" style="border-collapse: collapse; margin-bottom:0.2cm;">
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;"><div class="tr-header-bg" style="width: 17.2cm; font-weight:bold; text-align:left;">&nbsp;&nbsp;2&nbsp;&nbsp;INICIO DE ATENCI&Oacute;N</div></td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">HORA</div></td>
                                <td style="margin:0px; padding:0px; "><div class="fs-6" style="width: 1.4cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$rs_sihaydata->fields["anam_hora"]}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">VIA AEREA LIBRE</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$viaAereaLibre}</div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">VIA AEREA OBSTRUIDA</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$viaAereaObst}</div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">GRUPO - Rh</div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 1.6cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$rs_sihaydata->fields["anam_rh"]}</div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.8cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">CONDICIONES DE LLEGADA</div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.16cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">ESTABLE</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$condicionLlegadaEst}</div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.16cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">INESTABLE</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$condicionLlegadaInest}</div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.16cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">OTRO</div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 1.42cm; height:0.4cm; text-align:center; line-height:0.3cm;">{$condicionLlegadaOtro}</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.9cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">MOTIVO DE LLEGADA</div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 15.3cm; height:0.4cm; text-align:left; line-height:0.3cm;">{$rs_sihaydata->fields["anam_motivollegada"]}</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
        
        <!-- #3 -->
        <table border="0" style="border-collapse: collapse; margin-bottom:0.2cm;">
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div class="tr-header-bg" style="width: 17.2cm; font-weight:bold; text-align:left;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="" style="width: 15.9cm; text-align:left; border-right:0.02cm solid #000;">&nbsp;&nbsp;3&nbsp;&nbsp;ACCIDENTE, VIOLENCIA, INTOXICACI&Oacute;N</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6" style="width: 0.75cm; text-align:center; border-right:0.02cm solid #000;">NO APLICA</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; line-height:0.3cm;"><!-- ## -->&nbsp;</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6 fw-bold" style="width: 3.2cm; text-align:center; border-right:0.02cm solid #000;">LUGAR DEL EVENTO</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6 fw-bold" style="width: 6.1cm; text-align:center; border-right:0.02cm solid #000;">DIRECCI&Oacute;N DEL EVENTO</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6 fw-bold" style="width: 1.8cm; text-align:center; border-right:0.02cm solid #000;">FECHA</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6 fw-bold" style="width: 1.3cm; text-align:center; border-right:0.02cm solid #000;">HORA</div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6 fw-bold" style="width: 4.72cm; text-align:center;">VEH&Iacute;CULO O ARMA</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 3.2cm; text-align:center; border-right:0.02cm solid #000;">{$rs_sihaydata->fields["anam_lugarevento"]}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="fs-6" style="width: 6.1cm; text-align:center; border-right:0.02cm solid #000;">{$rs_sihaydata->fields["anam_direccionevento"]}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="fs-6" style="width: 1.8cm; text-align:center; border-right:0.02cm solid #000;">{$rs_sihaydata->fields["anam_fechaevento"]}</div></td>
                                <td style="margin:0px; padding:0px; "><div class="fs-6" style="width: 1.3cm; text-align:center; border-right:0.02cm solid #000;">{$rs_sihaydata->fields["anam_horaevento"]}</div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 4.72cm; text-align:center;">{$rs_sihaydata->fields["anam_vehiculo"]}</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6 fw-bold" style="width: 7.4cm; text-align:center; border-right:0.02cm solid #000;">TIPO DE EVENTO</div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6 fw-bold" style="width: 9.78cm; text-align:center;">AUTORIDAD COMPETENTE</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">ACCIDENTE</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$tipoEv_accidente}</div></td>
        
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6" style="width: 1.36cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">ENVENENA<br>MIENTO</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$tipoEv_env}</div></td>
        
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">VIOLENCIA</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$tipoEv_vio}</div></td>
        
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">OTRO</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$tipoEv_otro}</div></td>
        
                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 5.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$tipoEv_otro_descrip}</div></td>
        
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">HORA DENUNCIA</div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 1cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.2cm;">{$rs_sihaydata->fields["anam_horadenuncia"]}</div></td>
        
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.6cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">&nbsp;CUSTODIA POLICIAL</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; line-height:0.3cm;">{$custodiaPolicial}</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.82cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">OBSERVACIONES</div></td>
                                <td style="margin:0px; padding:0px; "><div class="fs-6" style="width: 15.3cm; height:0.4cm; text-align:left; line-height:0.3cm;">{$rs_sihaydata->fields["anam_obsevento"]}</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6 fw-bold" style="width: 9.5cm; text-align:center; border-right:0.02cm solid #000;">INTOXICACI&Oacute;N</div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6 fw-bold" style="width: 7.68cm; text-align:center;">VIOLENCIA</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">ALIENTO ETILICO</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$intoxicacion_alientoEtil}</div></td>
        
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6" style="width: 1.12cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">VALOR ALCOCHECK</div></td>
                                <td style="margin:0px; padding:0px; "><div class="fs-6" style="width: 1cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$rs_sihaydata->fields["anam_valor"]}</div></td>
        
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.8cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">HORA EXAMEN</div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 1cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$rs_sihaydata->fields["anam_horaexamen"]}</div></td>
        
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">SE HACE ALCOHOLEMIA</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$intoxicacion_alcoholemia}</div></td>
        
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">OTRAS SUSTANCIAS</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$intoxicacion_otrasSustancia}</div></td>
        
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">SOSPECHA</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$vio_sospecha}</div></td>
        
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">ABUSO F&Iacute;SICO</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$vio_abfisico}</div></td>
        
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">ABUSO PSICOL&Oacute;GICO</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$vio_abpsico}</div></td>
        
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.64cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">ABUSO SEXUAL</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; line-height:0.3cm;">{$vio_absex}</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.82cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">OBSERVACIONES</div></td>
                                <td style="margin:0px; padding:0px; "><div class="fs-6" style="width: 15.3cm; height:0.4cm; text-align:left; line-height:0.3cm;">{$rs_sihaydata->fields["anam_obsabuso"]}</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6 fw-bold" style="width: 8cm; text-align:center; border-right:0.02cm solid #000;">QUEMADURA</div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6 fw-bold" style="width: 4.5cm; text-align:center; border-right:0.02cm solid #000;">PICADURA</div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6 fw-bold" style="width: 4.65cm; text-align:center;">MORDEDURA</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">GRADO I</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$quemadura_g1}</div></td>
        
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6" style="width: 1.36cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">GRADO II</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$quemadura_g2}</div></td>
        
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">GRADO III</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$quemadura_g3}</div></td>
        
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">PORCENTAJE SUPERFICIE</div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 1.1cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$rs_sihaydata->fields["anam_porcentaje"]}</div></td>
        
                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 4.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$rs_sihaydata->fields["anam_picadura"]}</div></td>
        
                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 4.65cm; height:0.4cm; text-align:center; line-height:0.3cm;">{$rs_sihaydata->fields["anam_mordedura"]}</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
        
        <!-- #4 -->
        <table border="0" style="border-collapse: collapse; margin-bottom:0.2cm;">
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div class="tr-header-bg" style="width: 17.2cm; font-weight:bold; text-align:left;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="" style="width: 9.2cm; text-align:left;">&nbsp;&nbsp;4&nbsp;&nbsp;ANTECEDENTES PERSONALES Y FAMILIARES RELEVANTES</div></td>
                                <td style="margin:0px; padding:0px; "><div class="fs-6" style="width: 6.7cm; text-align:center; border-right:0.02cm solid #000; font-weight:normal;">PARA DESCRIBIR SE&Ntilde;ALE EL N&Uacute;MERO Y LA LETRA CORRESPONDIENTE <br>P = PERSONAL, F = FAMILIAR</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6" style="width: 0.75cm; text-align:center; border-right:0.02cm solid #000;">NO APLICA</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; line-height:0.3cm;"><!-- ## -->&nbsp;</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.6cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">1. AL&Eacute;RGICOS</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$anteced_alergicos}</div></td>
        
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6" style="width: 1.6cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">2. CL&Iacute;NICOS</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$anteced_clinic}</div></td>
        
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.6cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">3. GINECOL&Oacute;GICOS</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$anteced_gine}</div></td>
        
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.64cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">4. TRAUMATOL&Oacute;GICOS</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$anteced_trauma}</div></td>
        
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.6cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">5. PEDI&Aacute;TRICOS</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$anteced_pedia}</div></td>
        
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.6cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">6. QUIR&Uacute;RGICOS</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$anteced_quirur}</div></td>
        
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.64cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">7. FARMACOL&Oacute;GICOS</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">{$anteced_farma}</div></td>
        
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.61cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">8. OTROS</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; line-height:0.3cm;">{$anteced_otros}</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div class="fs-6 hidden-content" style="width: 17.2cm; height:1.9cm; text-align:left;">{$datos_af}{$anteced_observaciones}</div>
                </td>
            </tr>
        </table>
        
        <!-- #5 -->
        <table border="0" style="border-collapse: collapse; margin-bottom:0.2cm;">
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div class="tr-header-bg" style="width: 17.2cm; font-weight:bold; text-align:left;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="" style="width: 9.9cm; text-align:left;">&nbsp;&nbsp;5&nbsp;&nbsp;ENFERMEDAD ACTUAL Y REVISI&Oacute;N DE SISTEMAS</div></td>
                                <td style="margin:0px; padding:0px; "><div class="fs-6" style="width: 6cm; text-align:center; border-right:0.02cm solid #000; font-weight:normal;">CRONOLOG&Iacute;A - LOCALIZACI&Oacute;N - CARACTER&Iacute;STICAS - INTENSIDAD - FRECUENCIA - FACTORES AGRAVANTES</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6" style="width: 0.75cm; text-align:center; border-right:0.02cm solid #000;">NO APLICA</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; line-height:0.3cm;"><!-- ## -->&nbsp;</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div class="fs-6 hidden-content" style="width: 17.2cm; height:2.8cm; text-align:left;">{$rs_sihaydata->fields["anam_emferpactual"]}</div>
                </td>
            </tr>
        </table>
        
        <!-- #6 -->
        <table border="0" style="border-collapse: collapse; margin-bottom:0.2cm;">
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div class="tr-header-bg" style="width: 17.2cm; font-weight:bold; text-align:left;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="" style="width: 7.93cm; text-align:left; border-right:0.02cm solid #000;">&nbsp;&nbsp;6&nbsp;&nbsp;CARACTER&Iacute;STICAS DEL DOLOR</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6" style="width: 1.6cm; height: 0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">EVOLUCI&Oacute;N</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6" style="width: 1.6cm; height: 0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">TIPO</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6" style="width: 2.6cm; height: 0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">MODIFICACIONES</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6" style="width: 2.1cm; height: 0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">ALIVIA CON</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6" style="width: 0.75cm; height: 0.4cm; text-align:center; border-right:0.02cm solid #000;">NO APLICA</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; line-height:0.3cm;"><!-- ## -->&nbsp;</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 4cm; height:1.2cm; text-align:center; border-right:0.02cm solid #000; line-height:0.8cm;">REGI&Oacute;N ANAT&Oacute;MICA</div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 3.91cm; height:1.2cm; text-align:center; border-right:0.02cm solid #000; line-height:0.8cm;">PUNTO DOLOROSO</div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5 hidden-content" style="width: 0.5cm; height:1.2cm; border-right:0.02cm solid #000;"><div class="text-rotate-90" style="width: 1.2cm; height:1.2cm; text-align:center; line-height:0.4cm;">AGUDO</div></div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5 hidden-content" style="width: 0.5cm; height:1.2cm; border-right:0.02cm solid #000;"><div class="text-rotate-90" style="width: 1.2cm; height:1.2cm; text-align:center; line-height:0.4cm;">SUB AGUDO</div></div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5 hidden-content" style="width: 0.56cm; height:1.2cm; border-right:0.02cm solid #000;"><div class="text-rotate-90" style="width: 1.2cm; height:1.2cm; text-align:center; line-height:0.4cm;">CR&Oacute;NICO</div></div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5 hidden-content" style="width: 0.5cm; height:1.2cm; border-right:0.02cm solid #000;"><div class="text-rotate-90" style="width: 1.2cm; height:1.2cm; text-align:center; line-height:0.4cm;">EPISODICO</div></div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5 hidden-content" style="width: 0.5cm; height:1.2cm; border-right:0.02cm solid #000;"><div class="text-rotate-90" style="width: 1.2cm; height:1.2cm; text-align:center; line-height:0.4cm;">CONTINUO</div></div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5 hidden-content" style="width: 0.56cm; height:1.2cm; border-right:0.02cm solid #000;"><div class="text-rotate-90" style="width: 1.2cm; height:1.2cm; text-align:center; line-height:0.4cm;">COLICO</div></div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5 hidden-content" style="width: 0.5cm; height:1.2cm; border-right:0.02cm solid #000;"><div class="text-rotate-90" style="width: 1.2cm; height:1.2cm; text-align:center; line-height:0.4cm;">POSICI&Oacute;N</div></div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5 hidden-content" style="width: 0.5cm; height:1.2cm; border-right:0.02cm solid #000;"><div class="text-rotate-90" style="width: 1.2cm; height:1.2cm; text-align:center; line-height:0.4cm;">INGESTA</div></div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5 hidden-content" style="width: 0.5cm; height:1.2cm; border-right:0.02cm solid #000;"><div class="text-rotate-90" style="width: 1.2cm; height:1.2cm; text-align:center; line-height:0.4cm;">ESFUERZO</div></div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5 hidden-content" style="width: 0.5cm; height:1.2cm; border-right:0.02cm solid #000;"><div class="text-rotate-90" style="width: 1.2cm; height:1.2cm; text-align:center; line-height:0.4cm;">DIGITO PRESI&Oacute;N</div></div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5 hidden-content" style="width: 0.52cm; height:1.2cm; border-right:0.02cm solid #000;"><div class="text-rotate-90" style="width: 1.2cm; height:1.2cm; text-align:center; line-height:0.4cm;">SE IRRADIA</div></div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5 hidden-content" style="width: 0.5cm; height:1.2cm; border-right:0.02cm solid #000;"><div class="text-rotate-90" style="width: 1.2cm; height:1.2cm; text-align:center; line-height:0.4cm;">ANTIES PASMODICO</div></div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5 hidden-content" style="width: 0.5cm; height:1.2cm; border-right:0.02cm solid #000;"><div class="text-rotate-90" style="width: 1.2cm; height:1.2cm; text-align:center; line-height:0.4cm;">OPIACEO</div></div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5 hidden-content" style="width: 0.5cm; height:1.2cm; border-right:0.02cm solid #000;"><div class="text-rotate-90" style="width: 1.2cm; height:1.2cm; text-align:center; line-height:0.4cm;">A I N E</div></div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5 hidden-content" style="width: 0.54cm; height:1.2cm; border-right:0.02cm solid #000;"><div class="text-rotate-90" style="width: 1.2cm; height:1.2cm; text-align:center; line-height:0.4cm;">NO ALIVIA</div></div></td>
                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5 hidden-content" style="width: 1.26cm; height:1.18cm; text-align:center;"><br>INTENSIDAD<br><br>LEVE<br>MODERADO O GRAVE</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <!-- row repeat -->
            <!--
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 4cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">##</div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 3.91cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">##</div></td>
                                
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">##</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">##</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.56cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">##</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">##</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">##</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.56cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">##</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">##</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">##</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">##</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">##</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.52cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">##</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">##</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">##</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">##</div></td>
                                <td style="margin:0px; padding:0px; "><div class="bg-yellow fs-6 hidden-content" style="width: 0.54cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;">##</div></td>
                                <td style="margin:0px; padding:0px; "><div class="fs-6 hidden-content" style="width: 1.26cm; height:0.4cm; text-align:center; line-height:0.3cm;">##</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            -->
            <!-- row repeat -->
            {$htmlTable6}
        </table>
        
        <table border="0" style="page-break-after: always; border-collapse: collapse;" class="fw-bold fs-8">
            <tr>
                <td style="margin:0px; padding:0px;">
                    <div class="" style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;">
                                    <div class="" style="width: 8.7cm; text-align:left;">
                                        SNS-MSP / HCU-form.008 / 2007
                                    </div>
                                </td>
                                <td style="margin:0px; padding:0px;">
                                    <div class="" style="width: 8.7cm; text-align:right;">
                                        EMERGENCIA (1)
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
        
        <!-- #7 -->
        <table border="0" style="border-collapse: collapse; margin-bottom:0.2cm;">
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div class="tr-header-bg" style="width: 17.2cm; font-weight:bold; text-align:left;">
                        &nbsp;&nbsp;7&nbsp;&nbsp;SIGNOS VITALES, MEDICIONES Y VALORES
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div style="width: 17.2cm; height:0.8cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px; border-bottom:0.02cm solid #000;">
                                    <div style="width: 17.2cm; height: 0.4cm;">
                                        <table border="0" style="border-collapse: collapse;">
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.1cm; height: 0.4cm; text-align:center; border-right:0.02cm solid #000;">PRESI&Oacute;N ARTERIAL</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="fs-6 hidden-content" style="width: 1.3cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$signos_vit_presionArt}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">FRECUENCIA CARDIACA min</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="fs-6 hidden-content" style="width: 0.8cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$signos_vit_frecCard}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">FRECUENCIA RESPIRAT. min</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="fs-6 hidden-content" style="width: 0.8cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$signos_vit_frecResp}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">TEMPERATUR BUCAL °C</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="fs-6 hidden-content" style="width: 0.8cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$signos_vit_tempBuc}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">TEMPERATUR AXILAR °C</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="fs-6 hidden-content" style="width: 0.8cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;"><!-- ## -->&nbsp;</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">PESO<br>Kg</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="fs-6 hidden-content" style="width: 0.8cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$signos_vit_peso}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.3cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">TALLA<br>m</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="fs-6 hidden-content" style="width: 0.8cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$signos_vit_talla}</div></td>
                                                
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.1cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">PERIMET. CEFALIC cm</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-white fs-6 hidden-content" style="width: 0.79cm; height: 0.4cm; text-align:center; line-height:0.3cm;">{$signos_vit_perimCef}</div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="margin:0px; padding:0px; border-bottom:0.02cm solid #000;">
                                    <div style="width: 17.2cm; height: 0.4cm;">
                                        <table border="0" style="border-collapse: collapse;">
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.1cm; height: 0.4cm; text-align:center; border-right:0.02cm solid #000;">GLASGOW INICIAL</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 0.78cm; height:0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">OCULAR</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-white fs-6 hidden-content" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$sig_vitalesGLASGOW_ocular}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 0.78cm; height:0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">VERBAL</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-white fs-6 hidden-content" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$sig_vitalesGLASGOW_verbal}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 0.8cm; height:0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">MOTORA</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-white fs-6 hidden-content" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$sig_vitalesGLASGOW_motora}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 0.78cm; height:0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">TOTAL</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-white fs-6 hidden-content" style="width: 0.8cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$sig_vitalesGLASGOW_total}</div></td>
        
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.05cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">REACCI&Oacute;N PUPILAR DER</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-white fs-6 hidden-content" style="width: 0.8cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$sig_vitalesGLASGOW_reaccPupDer}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.05cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">REACCI&Oacute;N PUPILAR IZQ</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-white fs-6 hidden-content" style="width: 0.8cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$sig_vitalesGLASGOW_reaccPupIzq}</div></td>
        
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 0.98cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">T. LLENADO CAPILAR</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-white fs-6 hidden-content" style="width: 0.8cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$sig_vitalesGLASGOW_tLlenadoCap}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-white fs-6 hidden-content" style="width: 4.87cm; height: 0.4cm; text-align:center; line-height:0.3cm;">{$sig_vitalesGLASGOW_observ}</div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
        
        <!-- #8 -->
        <table border="0" style="border-collapse: collapse; margin-bottom:0.2cm;">
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div class="tr-header-bg" style="width: 17.2cm; font-weight:bold; text-align:left;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="" style="width: 3.1cm; text-align:left;">&nbsp;&nbsp;8&nbsp;&nbsp;EXAMEN F&Iacute;SICO</div></td>
                                <td style="margin:0px; padding:0px; "><div class="fs-7" style="width: 4.2cm; text-align:left;">R = REGIONAL&nbsp;&nbsp;S = SISTEMICO</div></td>
                                <td style="margin:0px; padding:0px; "><div class="fs-6" style="width: 6.4cm; text-align:center;">CP <span style="font-weight:normal;">= CON EVIDENCIA DE PATOLOG&Iacute;A: MARCAR "X" Y DESCRIBIR ABAJO ANOTANDO EL N&Uacute;MERO Y LETRA CORRESPONDIENTES</span></div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 3.5cm; height:0.4cm; text-align:center;">SP <span style="font-weight:normal;">= SIN EVIDENCIA DE PATOLOG&Iacute;A: MARCAR "X" Y NO DESCRIBIR</span></div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border-left:0.02cm solid #000; border-right:0.02cm solid #000; border-bottom:0.02cm solid #000;">
                    <div style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
        
                                <td style="margin:0px; padding:0px; ">
                                    <div style="width: 3.49cm; height:2.5cm;">
                                        <table border="0" style="border-collapse: collapse;">
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.43cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #CCFFCC;">&nbsp;</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #CCFFCC;">C P</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #CCFFCC;">S P</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.43cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;1<i>{$organoEvidPatolog[7]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[7]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[7]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[7]["sp"]}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.43cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;2<i>{$organoEvidPatolog[1]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[1]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[1]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[1]["sp"]}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.43cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;3<i>{$organoEvidPatolog[8]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[8]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[8]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[8]["sp"]}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.43cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;4<i>{$organoEvidPatolog[9]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[9]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[9]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[9]["sp"]}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.43cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-right:0.02cm solid #000;">&nbsp;&nbsp;5<i>{$organoEvidPatolog[10]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[10]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">{$organoEvidPatolog[10]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">{$organoEvidPatolog[10]["sp"]}</div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                                <td style="margin:0px; padding:0px; border-right:0.02cm solid #CCFFCC;">
                                    <div style="width: 3.38cm; height:2.5cm;">
                                        <table border="0" style="border-collapse: collapse;">
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.3cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #CCFFCC; border-left:0.02cm solid #CCFFCC;">&nbsp;</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #CCFFCC;">C P</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #CCFFCC;">S P</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.3cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000; border-left:0.02cm solid #CCFFCC;">&nbsp;&nbsp;6<i>{$organoEvidPatolog[11]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[11]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[11]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[11]["sp"]}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.3cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000; border-left:0.02cm solid #CCFFCC;">&nbsp;&nbsp;7<i>{$organoEvidPatolog[12]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[12]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[12]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[12]["sp"]}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.3cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000; border-left:0.02cm solid #CCFFCC;">&nbsp;&nbsp;8<i>{$organoEvidPatolog[2]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[2]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[2]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[2]["sp"]}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.3cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000; border-left:0.02cm solid #CCFFCC;">&nbsp;&nbsp;9<i>{$organoEvidPatolog[13]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[13]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[13]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[13]["sp"]}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.3cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-right:0.02cm solid #000; border-left:0.02cm solid #CCFFCC;">&nbsp;&nbsp;10<i>{$organoEvidPatolog[3]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[3]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">{$organoEvidPatolog[3]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">{$organoEvidPatolog[3]["sp"]}</div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                                <td style="margin:0px; padding:0px;">
                                    <div style="width: 3.37cm; height:2.5cm;">
                                        <table border="0" style="border-collapse: collapse;">
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.3cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #CCFFCC;">&nbsp;</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #CCFFCC;">C P</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #CCFFCC;">S P</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.3cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;11<i>{$organoEvidPatolog[4]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[4]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[4]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[4]["sp"]}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.3cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;12<i>{$organoEvidPatolog[14]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[14]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[14]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[14]["sp"]}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.3cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;13<i>{$organoEvidPatolog[15]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[15]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[15]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[15]["sp"]}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.3cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;14<i>{$organoEvidPatolog[16]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[16]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[16]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[16]["sp"]}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.3cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-right:0.02cm solid #000;">&nbsp;&nbsp;15<i>{$organoEvidPatolog[17]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[17]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">{$organoEvidPatolog[17]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">{$organoEvidPatolog[17]["sp"]}</div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                                <td style="margin:0px; padding:0px;">
                                    <div style="width: 3.47cm; height:2.5cm;">
                                        <table border="0" style="border-collapse: collapse;">
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.4cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #CCFFCC;">&nbsp;</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #CCFFCC;">C P</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #CCFFCC;">S P</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.4cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;1<i>{$organoEvidPatolog[18]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[18]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[18]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[18]["sp"]}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.4cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;2<i>{$organoEvidPatolog[19]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[19]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[19]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[19]["sp"]}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.4cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;3<i>{$organoEvidPatolog[20]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[20]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[20]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[20]["sp"]}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.4cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;4<i>{$organoEvidPatolog[21]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[21]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[21]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[21]["sp"]}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.4cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-right:0.02cm solid #000;">&nbsp;&nbsp;5<i>{$organoEvidPatolog[22]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[22]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">{$organoEvidPatolog[22]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">{$organoEvidPatolog[22]["sp"]}</div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                                <td style="margin:0px; padding:0px; ">
                                    <div style="width: 3.50cm; height:2.5cm;">
                                        <table border="0" style="border-collapse: collapse;">
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.42cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #CCFFCC;">&nbsp;</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #CCFFCC;">C P</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #CCFFCC;">S P</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.42cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;6<i>{$organoEvidPatolog[23]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[23]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[23]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[23]["sp"]}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.42cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;7<i>{$organoEvidPatolog[24]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[24]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[24]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[24]["sp"]}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.42cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;8<i>{$organoEvidPatolog[25]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[25]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[25]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[25]["sp"]}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.42cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;9<i>{$organoEvidPatolog[26]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[26]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[26]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$organoEvidPatolog[26]["sp"]}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.42cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-right:0.02cm solid #000;">&nbsp;&nbsp;10<i>{$organoEvidPatolog[27]["tipo"]}</i>&nbsp;&nbsp;{$organoEvidPatolog[27]["name"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">{$organoEvidPatolog[27]["cp"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">{$organoEvidPatolog[27]["sp"]}</div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border-bottom:0.02cm solid #000; border-left:0.02cm solid #000; border-right:0.02cm solid #000;">
                    <div class="fs-6" style="width: 17.2cm; height:2.3cm; text-align:left;">{$organoEvidPatologDetalle}</div>
                </td>
            </tr>
        </table>
        
        <!-- #9, 10, 11 -->
        <table border="0" style="border-collapse: collapse; margin-bottom:0.2cm;">
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div class="tr-header-bg" style="width: 17.2cm; font-weight:bold; text-align:left;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="" style="width: 4.7cm; text-align:left;">&nbsp;&nbsp;9&nbsp;&nbsp;DIAGRAMA TOPOGR&Aacute;FICO</div></td>
                                <td style="margin:0px; padding:0px; "><div class="fs-6" style="width: 4.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm; font-weight:normal;">ANOTAR EL N&Uacute;MERO SOBRE EL LUGAR DE LA LESI&Oacute;N</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6" style="width: 0.75cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">NO APLICA</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm;"><!-- ## -->&nbsp;</div></td>
                                
                                <td style="margin:0px; padding:0px;"><div class="" style="width: 5.4cm; height: 0.4cm; text-align:left; border-right:0.02cm solid #000;">&nbsp;&nbsp;10&nbsp;&nbsp;EMBARAZO - PARTO</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6" style="width: 0.75cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">NO APLICA</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; line-height:0.3cm;"><!-- ## -->&nbsp;</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div class="fs-6 hidden-content" style="width: 17.2cm; height:7.3cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="" style="width: 7.77cm; height:7.3cm; border-right:0.02cm solid #000;">
                                    {$imgpath}
                                </div></td>
                                <td style="margin:0px; padding:0px;">
                                    <div class="tr-common-bg hidden-content" style="width: 2.7cm; height:7.3cm; border-right:0.02cm solid #000;">
                                        <table border="0" style="border-collapse: collapse;">
                                            <!-- row repeat -->
                                            <tr>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="tr-common-bg fs-5" style="width: 2.18cm; height: 0.4cm; text-align:left; text-transform: uppercase; line-height:0.3cm; border-right:0.02cm solid #000;">&nbsp;&nbsp;1 Herida Penetrante</div>
                                                </td>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-bottom:0.02cm solid #000;">{$diagramTopo_HerPenetrante}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="tr-common-bg fs-5" style="width: 2.18cm; height: 0.4cm; text-align:left; text-transform: uppercase; line-height:0.3cm; border-right:0.02cm solid #000;">&nbsp;&nbsp;2 Herida No Penetrante</div>
                                                </td>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-bottom:0.02cm solid #000;">{$diagramTopo_HerNoPenetrante}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="tr-common-bg fs-5" style="width: 2.18cm; height: 0.4cm; text-align:left; text-transform: uppercase; line-height:0.3cm; border-right:0.02cm solid #000;">&nbsp;&nbsp;3 Fractura Expuesta</div>
                                                </td>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-bottom:0.02cm solid #000;">{$diagramTopo_FractExp}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="tr-common-bg fs-5" style="width: 2.18cm; height: 0.4cm; text-align:left; text-transform: uppercase; line-height:0.3cm; border-right:0.02cm solid #000;">&nbsp;&nbsp;4 Fractura Cerrada</div>
                                                </td>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-bottom:0.02cm solid #000;">{$diagramTopo_FractCerr}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="tr-common-bg fs-5" style="width: 2.18cm; height: 0.4cm; text-align:left; text-transform: uppercase; line-height:0.3cm; border-right:0.02cm solid #000;">&nbsp;&nbsp;5 Amputacion</div>
                                                </td>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-bottom:0.02cm solid #000;">{$diagramTopo_Amp}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="tr-common-bg fs-5" style="width: 2.18cm; height: 0.4cm; text-align:left; text-transform: uppercase; line-height:0.3cm; border-right:0.02cm solid #000;">&nbsp;&nbsp;6 Hemorragia</div>
                                                </td>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-bottom:0.02cm solid #000;">{$diagramTopo_Hemorr}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="tr-common-bg fs-5" style="width: 2.18cm; height: 0.4cm; text-align:left; text-transform: uppercase; line-height:0.3cm; border-right:0.02cm solid #000;">&nbsp;&nbsp;7 Mordedura</div>
                                                </td>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-bottom:0.02cm solid #000;">{$diagramTopo_Mordedura}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="tr-common-bg fs-5" style="width: 2.18cm; height: 0.4cm; text-align:left; text-transform: uppercase; line-height:0.3cm; border-right:0.02cm solid #000;">&nbsp;&nbsp;8 Picadura</div>
                                                </td>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-bottom:0.02cm solid #000;">{$diagramTopo_Pica}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="tr-common-bg fs-5" style="width: 2.18cm; height: 0.4cm; text-align:left; text-transform: uppercase; line-height:0.3cm; border-right:0.02cm solid #000;">&nbsp;&nbsp;9 Excoriacion</div>
                                                </td>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-bottom:0.02cm solid #000;">{$diagramTopo_Excor}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="tr-common-bg fs-5" style="width: 2.18cm; height: 0.4cm; text-align:left; text-transform: uppercase; line-height:0.3cm; border-right:0.02cm solid #000;">&nbsp;&nbsp;10 Deformidad O Masa</div>
                                                </td>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-bottom:0.02cm solid #000;">{$diagramTopo_Deform}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="tr-common-bg fs-5" style="width: 2.18cm; height: 0.4cm; text-align:left; text-transform: uppercase; line-height:0.3cm; border-right:0.02cm solid #000;">&nbsp;&nbsp;11 Hematoma</div>
                                                </td>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-bottom:0.02cm solid #000;">{$diagramTopo_Hematoma}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="tr-common-bg fs-5" style="width: 2.18cm; height: 0.4cm; text-align:left; text-transform: uppercase; line-height:0.3cm; border-right:0.02cm solid #000;">&nbsp;&nbsp;12 Quemadura G-I</div>
                                                </td>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-bottom:0.02cm solid #000;">{$diagramTopo_QuemaG1}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="tr-common-bg fs-5" style="width: 2.18cm; height: 0.4cm; text-align:left; text-transform: uppercase; line-height:0.3cm; border-right:0.02cm solid #000;">&nbsp;&nbsp;13 Quemadura G-II</div>
                                                </td>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-bottom:0.02cm solid #000;">{$diagramTopo_QuemaG2}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="tr-common-bg fs-5" style="width: 2.18cm; height: 0.4cm; text-align:left; text-transform: uppercase; line-height:0.3cm; border-right:0.02cm solid #000;">&nbsp;&nbsp;14 Quemadura G-III</div>
                                                </td>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-bottom:0.02cm solid #000;">{$diagramTopo_QuemaG3}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="tr-common-bg fs-5" style="width: 2.18cm; height: 0.4cm; text-align:left; text-transform: uppercase; line-height:0.3cm; border-right:0.02cm solid #000;">&nbsp;&nbsp;15</div>
                                                </td>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-bottom:0.02cm solid #000;">{$diagramTopo_Otros1}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="tr-common-bg fs-5" style="width: 2.18cm; height: 0.4cm; text-align:left; text-transform: uppercase; line-height:0.3cm; border-right:0.02cm solid #000;">&nbsp;&nbsp;16</div>
                                                </td>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-bottom:0.02cm solid #000;">{$diagramTopo_Otros2}</div>
                                                </td>
                                            </tr>
                                            <!-- row repeat -->
                                        </table>
                                    </div>
                                </td>
                                <td style="margin:0px; padding:0px;">
                                    <div class="" style="width: 5.8cm; height:7.3cm;">
                                        <table border="0" style="border-collapse: collapse;">
                                            <tr>
                                                <td style="margin:0px; padding:0px;">
                                                    <div class="" style="width: 6.7cm; height: 4.1cm; border-bottom:0.02cm solid #000;">
                                    
                                                        <table border="0" style="border-collapse: collapse;">
                                                            <tr>
                                                                <td style="margin:0px; padding:0px; border-bottom:0.02cm solid #000;">
                                                                    <div class="" style="width: 6.7cm;">
                                                                        <table border="0" style="border-collapse: collapse;">
                                                                            <tr>
                                                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.13cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">GESTAS</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="fs-6 hidden-content" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$rs_sihaydata->fields["anam_gesta"]}</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.13cm; height:0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">PARTOS</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="fs-6 hidden-content" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$rs_sihaydata->fields["anam_partos"]}</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.13cm; height:0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">ABORTOS</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="fs-6 hidden-content" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$rs_sihaydata->fields["anam_abortos"]}</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.16cm; height:0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">CESAREAS</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="fs-6 hidden-content" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm;">{$rs_sihaydata->fields["anam_cesareas"]}</div></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="margin:0px; padding:0px; border-bottom:0.02cm solid #000;">
                                                                    <div class="" style="width: 6.7cm;">
                                                                        <table border="0" style="border-collapse: collapse;">
                                                                            <tr>
                                                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.65cm; height: 0.4cm; text-align:center; border-right:0.02cm solid #000;">FECHA &Uacute;LTIMA MENSTRUACI&Oacute;N</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="fs-6 hidden-content" style="width: 1.4cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$rs_sihaydata->fields["anam_menstruacion"]}</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.08cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">SEMANAS GESTACI&Oacute;N</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="fs-6 hidden-content" style="width: 0.8cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$rs_sihaydata->fields["anam_gestacion"]}</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.16cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">MOVIMIENTO FETAL</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm;">{$movFetal}</div></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="margin:0px; padding:0px; border-bottom:0.02cm solid #000;">
                                                                    <div class="" style="width: 6.7cm;">
                                                                        <table border="0" style="border-collapse: collapse;">
                                                                            <tr>
                                                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.5cm; height: 0.4cm; text-align:center; border-right:0.02cm solid #000;">FRECUENCIA C. FETAL</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="fs-6 hidden-content" style="width: 1cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$rs_sihaydata->fields["anam_frecuenciafetal"]}</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.5cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">MEMBRANAS ROTAS</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$membRotas}</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.1cm; height:0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">TIEMPO</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="fs-6 hidden-content" style="width: 1cm; height: 0.4cm; text-align:center; line-height:0.3cm;">{$rs_sihaydata->fields["anam_tiempo"]}</div></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="margin:0px; padding:0px; border-bottom:0.02cm solid #000;">
                                                                    <div class="" style="width: 6.7cm;">
                                                                        <table border="0" style="border-collapse: collapse;">
                                                                            <tr>
                                                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">ALTURA UTERINA</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="fs-6 hidden-content" style="width: 1cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$rs_sihaydata->fields["anam_uterna"]}</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.5cm; height:0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">PRESENTACI&Oacute;N</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="fs-6 hidden-content" style="width: 2.64cm; height: 0.4cm; text-align:center; line-height:0.3cm;">{$rs_sihaydata->fields["anam_presentacion"]}</div></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="margin:0px; padding:0px; border-bottom:0.02cm solid #000;">
                                                                    <div class="" style="width: 6.7cm;">
                                                                        <table border="0" style="border-collapse: collapse;">
                                                                            <tr>
                                                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">DILATACI&Oacute;N</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="fs-6 hidden-content" style="width: 1cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$rs_sihaydata->fields["anam_dilatacion"]}</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.5cm; height:0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">BORRAMIENTO</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="fs-6 hidden-content" style="width: 0.93cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$rs_sihaydata->fields["anam_borramiento"]}</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.8cm; height:0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">PLANO</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="fs-6 hidden-content" style="width: 0.9cm; height: 0.4cm; text-align:center; line-height:0.3cm;">{$rs_sihaydata->fields["anam_plano"]}</div></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="margin:0px; padding:0px; border-bottom:0.02cm solid #000;">
                                                                    <div class="" style="width: 6.7cm;">
                                                                        <table border="0" style="border-collapse: collapse;">
                                                                            <tr>
                                                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">PELVIS UTIL</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$pelvisUtil}</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.48cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">SANGRADO VAGINAL</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6 hidden-content" style="width: 0.5cm; height: 0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">{$sangradoVag}</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 1.6cm; height:0.4cm; text-align:center; line-height:0.3cm; border-right:0.02cm solid #000;">CONTRACCIONES</div></td>
                                                                                <td style="margin:0px; padding:0px;"><div class="fs-6 hidden-content" style="width: 1cm; height: 0.4cm; text-align:center; line-height:0.3cm;">{$rs_sihaydata->fields["anam_contracciones"]}</div></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="margin:0px; padding:0px;">
                                                                    <div class="fs-6 hidden-content" style="width: 6.7cm; height:1.56cm; text-align:left;">{$rs_sihaydata->fields["anam_observaciones"]}</div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                    
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="" style="width: 6.7cm; height: 3.2cm;">
                                                    <table border="0" style="border-collapse: collapse;">
                                                        <tr>
                                                            <td style="margin:0px; padding:0px;"><div class="tr-header-bg" style="font-size: 10px; font-weight:bold; width: 5.4cm; height: 0.4cm; text-align:left; border-right:0.02cm solid #000;">&nbsp;&nbsp;11&nbsp;&nbsp;AN&Aacute;LISIS DE PROBLEMAS</div></td>
                                                            <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.75cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">NO APLICA</div></td>
                                                            <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; line-height:0.3cm;"><!-- ## -->&nbsp;</div></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" style="margin:0px; padding:0px;">
                                                                <div class="fs-6 hidden-content" style="width: 6.7cm; height:3.2cm; text-align:left; border-top:0.02cm solid #000;">{$rs_sihaydata->fields["anam_problemas"]}</div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
        
        <!-- #12 -->
        <table border="0" style="border-collapse: collapse; margin-bottom:0.2cm;">
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div class="tr-header-bg" style="width: 17.2cm; font-weight:bold; text-align:left;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="" style="width: 9.5cm; text-align:left;">&nbsp;&nbsp;12&nbsp;&nbsp;PLAN DIAGN&Oacute;STICO</div></td>
                                <td style="margin:0px; padding:0px; "><div class="fs-6" style="width: 6.41cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000; line-height:0.3cm; font-weight:normal;">REGISTRAR ABAJO COMENTARIOS Y RESULTADOS, ANOTANDO EL N&Uacute;MERO</div></td>
                                <td style="margin:0px; padding:0px; "><div class="tr-common-bg fs-6" style="width: 0.75cm; height:0.4cm; text-align:center; border-right:0.02cm solid #000;">NO APLICA</div></td>
                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height:0.4cm; text-align:center; line-height:0.3cm;"><!-- ## -->&nbsp;</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border-left:0.02cm solid #000; border-right:0.02cm solid #000; border-bottom:0.02cm solid #000;">
                    <div style="width: 17.2cm; height:0.83cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px; ">
                                    <div style="width: 1.85cm; height:0.83cm;">
                                        <table border="0" style="border-collapse: collapse;">
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.33cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;1.&nbsp;&nbsp;BIOMETRIA</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$planDiag_biometria}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.33cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;2.&nbsp;&nbsp;UROANALISIS</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$planDiag_uro}</div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                                <td style="margin:0px; padding:0px; border-left:0.02cm solid #000;">
                                    <div style="width: 2.38cm; height:0.83cm;">
                                        <table border="0" style="border-collapse: collapse;">
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.86cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;3.&nbsp;&nbsp;QUIMICA SANGUINEA</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$planDiag_quimicaSang}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.86cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;4.&nbsp;&nbsp;ELECTROLITOS</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$planDiag_electrolitos}</div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                                <td style="margin:0px; padding:0px; border-left:0.02cm solid #000;">
                                    <div style="width: 2.55cm; height:0.83cm;">
                                        <table border="0" style="border-collapse: collapse;">
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.03cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;5.&nbsp;&nbsp;GASOMETRIA</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$planDiag_gaso}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.03cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;6.&nbsp;&nbsp;ELECTROCARDIOGRAMA</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$planDiag_electrocardio}</div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                                <td style="margin:0px; padding:0px; border-left:0.02cm solid #000;">
                                    <div style="width: 1.90cm; height:0.83cm;">
                                        <table border="0" style="border-collapse: collapse;">
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.38cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;7.&nbsp;&nbsp;ENDOSCOPIA</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$planDiag_endo}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.38cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;8.&nbsp;&nbsp;R-X TORAX</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$planDiag_rxtorax}</div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                                <td style="margin:0px; padding:0px; border-left:0.02cm solid #000;">
                                    <div style="width: 1.85cm; height:0.83cm;">
                                        <table border="0" style="border-collapse: collapse;">
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.33cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;9.&nbsp;&nbsp;R-X ABDOMEN</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$planDiag_rxabdomen}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.33cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;10.&nbsp;&nbsp;R-X OSEA</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$planDiag_rxosea}</div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                                <td style="margin:0px; padding:0px; border-left:0.02cm solid #000;">
                                    <div style="width: 1.85cm; height:0.83cm;">
                                        <table border="0" style="border-collapse: collapse;">
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.33cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;11.&nbsp;&nbsp;TOMOGRAFIA</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$planDiag_tomografia}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.33cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;12.&nbsp;&nbsp;RESONANCIA</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$planDiag_resonancia}</div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                                <td style="margin:0px; padding:0px; border-left:0.02cm solid #000;">
                                    <div style="width: 2.55cm; height:0.83cm;">
                                        <table border="0" style="border-collapse: collapse;">
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.03cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;13.&nbsp;&nbsp;ECOGRAFIA PELVICA</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$planDiag_ecopelv}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 2.03cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;14.&nbsp;&nbsp;ECOGRAFIA ABDOMEN</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$planDiag_ecoabdomen}</div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                                <td style="margin:0px; padding:0px; border-left:0.02cm solid #000;">
                                    <div style="width: 2.13cm; height:0.83cm;">
                                        <table border="0" style="border-collapse: collapse;">
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.61cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;15.&nbsp;&nbsp;INTERCONSULTA</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$planDiag_interconsult}</div></td>
                                            </tr>
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.61cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #CCFFCC; border-right:0.02cm solid #000;">&nbsp;&nbsp;16.&nbsp;&nbsp;OTROS</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$planDiag_otros}</div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px; border-left:0.02cm solid #000; border-right:0.02cm solid #000; border-bottom:0.02cm solid #000;">
                    <div class="hidden-content fs-6" style="width: 17.2cm; height:0.4cm; text-align:left;">{$rs_sihaydata->fields["anam_obsplandiagnostico"]}</div>
                </td>
            </tr>
        </table>
        
        <!-- #13, 14 -->
        <table border="0" style="border-collapse: collapse; margin-bottom:0.2cm;">
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div class="tr-header-bg" style="width: 17.2cm; font-weight:bold; text-align:left;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="" style="width: 7.4cm; text-align:left;">&nbsp;&nbsp;13&nbsp;&nbsp;DIAGN&Oacute;STICOS PRESUNTIVOS</div></td>
                                <td style="margin:0px; padding:0px; border-right:0.02cm solid #000;"><div class="fs-7" style="width: 1.20cm; text-align:center;">CIE</div></td>
                                <td style="margin:0px; padding:0px;"><div class="" style="width: 7.4cm; text-align:left;">&nbsp;&nbsp;14&nbsp;&nbsp;DIAGN&Oacute;STICOS DEFINITIVOS</div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-7" style="width: 1.20cm; text-align:center;">CIE</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px;">
                    <div class="hidden-content" style="width: 17.2cm; height:1.25cm;">
                        <table border="0" style="border-collapse: collapse;">
                            
                            <tr>
                                <td style="margin:0px; padding:0px;">
                                    <div style="width: 17.2cm; height:1.25cm;">
                                        <table border="0" style="border-collapse: collapse;">
                                        <tr>
                                        <td>
                                        <div style="width: 8.55cm; height:1.25cm;">
                                            <table border="0" style="border-collapse: collapse;">
                                                <!-- row repeat -->
                                                <!--
                                                <tr>
                                                    <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">##</div></td>
                                                    <td style="margin:0px; padding:0px;"><div class="bg-white fs-6" style="width: 6.85cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-right:0.02cm solid #000;">##</div></td>
                                                    <td style="margin:0px; padding:0px;"><div class="bg-white fs-6" style="width: 1.2cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">##</div></td>
                                                </tr>
                                                -->
                                                <!-- row repeat -->
                                                {$htmlTable13}
                                            </table>
                                        </div>
                                        </td>
                                        <td>
                                        <div style="width: 8.52cm; height:1.25cm;">
                                            <table border="0" style="border-collapse: collapse;">
                                                <!-- row repeat -->
                                                <!--
                                                <tr>
                                                    <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">##</div></td>
                                                    <td style="margin:0px; padding:0px;"><div class="bg-white fs-6" style="width: 6.82cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-right:0.02cm solid #000;">##</div></td>
                                                    <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 1.2cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">##</div></td>
                                                </tr>
                                                -->
                                                <!-- row repeat -->
                                                {$htmlTable14}
                                            </table>
                                        </div>
                                        </td>
                                        </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            
                        </table>
                    </div>
                </td>
            </tr>
        </table>
        
        <!-- #15 -->
        <table border="0" style="border-collapse: collapse; margin-bottom:0.2cm;">
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div class="tr-header-bg" style="width: 17.2cm; font-weight:bold; text-align:left;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;"><div class="" style="width: 13.6cm; text-align:left;">&nbsp;&nbsp;15&nbsp;&nbsp;PLAN DE TRATAMIENTO</div></td>
                                <td style="margin:0px; padding:0px;"><div class="fs-5" style="width: 3.5cm; height:0.4cm; text-align:right; line-height:0.3cm; font-weight:normal;">DESCRIBIR ABAJO, ANOTANDO EL N&Uacute;MERO</div></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px;">
                    <div class="hidden-content" style="width: 17.2cm; height:2.10cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;">
                                    <div style="width: 17.2cm; height:0.4cm; border-left:0.02cm solid #000; border-right:0.02cm solid #000; border-bottom:0.02cm solid #000;">
                                        <table border="0" style="border-collapse: collapse;">
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center;"></div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 4.88cm; height: 0.4cm; line-height:0.3cm; text-align:left;">MEDICAMENTO GEN&Eacute;RICO</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.8cm; height: 0.4cm; line-height:0.3cm; text-align:center;">VIA</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.8cm; height: 0.4cm; line-height:0.3cm; text-align:center;">DOSIS</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.8cm; height: 0.4cm; text-align:center;">POSO<br>LOGIA</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.8cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">D&Iacute;AS</div></td>
                                    
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.6cm; height: 0.4cm; line-height:0.2cm; text-align:center; border-right:0.02cm solid #000;">1. INDICACIONES GENERALES</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">{$planTrat_indicacionesGen}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.6cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">2. PROCEDIMIENTOS</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">{$planTrat_Proced}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.6cm; height: 0.4cm; line-height:0.2cm; text-align:center; border-right:0.02cm solid #000;">3. CONSENTIMIENTO INFORMADO</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">{$planTrat_ConsentInform}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.63cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">4. OTROS</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">{$planTrat_Otros}</div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td style="margin:0px; padding:0px;">
                                    <div style="width: 17.2cm; height:1.7cm;">
                                        <table border="0" style="border-collapse: collapse;">
                                        <tr>
                                        <td>
                                        <div class="" style="width: 8.52cm; height:1.7cm;">
                                            <table border="0" style="border-collapse: collapse;">
                                                <!-- row repeat -->
                                                <!--
                                                <tr>
                                                    <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center;">1</div></td>
                                                    <td style="margin:0px; padding:0px;"><div class="bg-white fs-6" style="width: 4.78cm; height: 0.4cm; line-height:0.3cm; text-align:left; border-left:0.02cm solid #000;">##</div></td>
                                                    <td style="margin:0px; padding:0px;"><div class="bg-white fs-6" style="width: 0.8cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-left:0.02cm solid #000;">##</div></td>
                                                    <td style="margin:0px; padding:0px;"><div class="bg-white fs-6" style="width: 0.8cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-left:0.02cm solid #000;">##</div></td>
                                                    <td style="margin:0px; padding:0px;"><div class="bg-white fs-6" style="width: 0.8cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-left:0.02cm solid #000;">##</div></td>
                                                    <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 0.8cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-left:0.02cm solid #000; border-right:0.02cm solid #000;">##</div></td>
                                                </tr>
                                                -->
                                                <!-- row repeat -->
                                                {$htmlTable15}
                                            </table>
                                        </div>
                                        </td>
                                        <td>
                                        <div class="" style="width: 8.7cm; height:1.7cm;">
                                            <table border="0" style="border-collapse: collapse;">
                                                <tr>
                                                    <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 8.55cm; height: 1.65cm; text-align:left; border-left:0.02cm solid #000; border-bottom:0.02cm solid #000; border-right:0.02cm solid #000;">{$planTrat_Detalle}</div></td>
                                                </tr>
                                            </table>
                                        </div>
                                        </td>
                                        </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
        
        <!-- #16 -->
        <table border="0" style="border-collapse: collapse; margin-bottom:0.2cm;">
            <tr>
                <td style="margin:0px; padding:0px; border:0.02cm solid #000;">
                    <div class="tr-header-bg" style="width: 17.2cm; font-weight:bold; text-align:left;">
                        &nbsp;&nbsp;16&nbsp;&nbsp;SALIDA
                    </div>
                </td>
            </tr>
            <tr>
                <td style="margin:0px; padding:0px;">
                    <div style="width: 17.2cm; height:1.44cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;">
                                    <div style="width: 17.2cm; height:0.4cm; border-bottom:0.02cm solid #000; border-left:0.02cm solid #000; border-right:0.02cm solid #000;">
                                        <table border="0" style="border-collapse: collapse;">
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.21cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">DOMICILIO</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">{$salida_domicilio}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1cm; height: 0.4cm; line-height:0.2cm; text-align:center; border-right:0.02cm solid #000;">CONSULTA EXTERNA</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">{$salida_consultExt}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.3cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">OBSERVACION</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">{$salida_Observ}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.3cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">INTERNACION</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">{$salida_intern}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.1cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">REFERENCIA</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;"><!-- ## -->&nbsp;</div></td>
                                    
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.6cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">VIVO</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">{$salida_vivo}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.6cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">ESTABLE</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">{$salida_estable}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.6cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">INESTABLE</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">{$salida_inestable}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.33cm; height: 0.4cm; line-height:0.2cm; text-align:center; border-right:0.02cm solid #000;">DIAS DE INCAPACIDAD</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.82cm; height: 0.4cm; line-height:0.3cm; text-align:center;">{$rs_sihaydata->fields["anam_diasincapacidad"]}</div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="margin:0px; padding:0px;">
                                    <div style="width: 17.2cm; height:0.4cm; border-bottom:0.02cm solid #000; border-left:0.02cm solid #000; border-right:0.02cm solid #000;">
                                        <table border="0" style="border-collapse: collapse;">
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.21cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">SERVICIO</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-white fs-6" style="width: 3.36cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;"><!-- ## -->&nbsp;</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.6cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">ESTABLECIMIENTO</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-white fs-6" style="width: 2.36cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;"><!-- ## -->&nbsp;</div></td>
                                    
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.6cm; height: 0.4cm; line-height:0.2cm; text-align:center; border-right:0.02cm solid #000;">MUERTO EN EMERGENCIA</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-yellow fs-6" style="width: 0.5cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">{$salida_muertoEmerg}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.3cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">CAUSA</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="bg-white fs-6" style="width: 5.12cm; height: 0.4cm; line-height:0.3cm; text-align:center;">{$rs_sihaydata->fields["anam_causa"]}</div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td style="margin:0px; padding:0px;">
                                    <div style="width: 17.2cm; height:0.2cm;">
                                        <table border="0" style="border-collapse: collapse;">
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="bg-white fs-5" style="width: 16.12cm; height: 0.2cm;"></div></td>
                                                <td style="margin:0px; padding:0px;"><div class="fs-5" style="width: 1.1cm; height: 0.2cm; text-align:center;">CODIGO</div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                                    
                            <tr>
                                <td style="margin:0px; padding:0px;">
                                    <div style="width: 17.2cm; height:0.4cm; border-top:0.02cm solid #000; border-bottom:0.02cm solid #000; border-left:0.02cm solid #000; border-right:0.02cm solid #000;">
                                        <table border="0" style="border-collapse: collapse;">
                                            <tr>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.21cm; height: 0.4cm; line-height:0.2cm; text-align:center; border-right:0.02cm solid #000;">FECHA DE<br>SALIDA</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 1.1cm; height: 0.4cm; line-height:0.2cm; text-align:center; border-right:0.02cm solid #000;">{$rs_sihaydata->fields["anam_fecharegistro"]}</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 0.8cm; height: 0.4cm; line-height:0.2cm; text-align:center; border-right:0.02cm solid #000;">HORA DE SALIDA</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 1.1cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;"><!-- ## -->&nbsp;</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.1cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">MEDICO</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 4.8cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;"><!-- ## -->&nbsp;</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="tr-common-bg fs-5" style="width: 1.1cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;">FIRMA</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 4.73cm; height: 0.4cm; line-height:0.3cm; text-align:center; border-right:0.02cm solid #000;"><!-- ## -->&nbsp;</div></td>
                                                <td style="margin:0px; padding:0px;"><div class="fs-6" style="width: 1.1cm; height: 0.4cm; line-height:0.3cm; text-align:center;"><!-- ## -->&nbsp;</div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
                                    
        <table border="0" style="border-collapse: collapse;" class="fw-bold fs-8">
            <tr>
                <td style="margin:0px; padding:0px;">
                    <div class="" style="width: 17.2cm;">
                        <table border="0" style="border-collapse: collapse;">
                            <tr>
                                <td style="margin:0px; padding:0px;">
                                    <div class="" style="width: 8.7cm; text-align:left;">
                                        SNS-MSP / HCU-form.008 / 2007
                                    </div>
                                </td>
                                <td style="margin:0px; padding:0px;">
                                    <div class="" style="width: 8.7cm; text-align:right;">
                                        EMERGENCIA (2)
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    </main>
    </body>
    </html>
TEMPLATE;

$xml="SNS-MSP_HCU-form.008_2007";

$optionsDompdf = new Dompdf\Options();
$optionsDompdf->set('isRemoteEnabled', true);
$optionsDompdf->set('defaultFont', 'Helvetica');

$dompdf = new Dompdf\Dompdf($optionsDompdf);

$dompdf->loadHtml($comprobantepdf);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

header("Content-type: application/pdf");
header("Content-Disposition: inline; filename={$xml}_{$hc}_{$separa_fecha_hora[0]}.pdf");
echo $dompdf->output();
}