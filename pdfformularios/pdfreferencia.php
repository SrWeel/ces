<?php
include('qr/vendor/autoload.php');//Llamare el autoload de la clase que genera el QR
use Endroid\QrCode\QrCode;
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

$conve_id=$rs_dcliente->fields["conve_id"]; 
$nac_id=$rs_dcliente->fields["nac_id"];



$table=$rs_tabla->fields["tab_name"];  
$campo_primariodata=$rs_tabla->fields["tab_campoprimario"]; 
//$busca_sihaydata="select * from ".$table." where atenc_id=? and clie_id=?";
$busca_sihaydata="select * from ".$table." where  ".$campo_primariodata."=?";
$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array($valor_id));

$referencia_enlace=$rs_sihaydata->fields["referencia_enlace"];





$nomb_centro='';
$nomb_medico='';
$nomb_centro=utf8_decode($objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre","where centro_id=",$rs_sihaydata->fields["centro_id"],$DB_gogess));
$nomb_medico=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido","where usua_id=",$rs_sihaydata->fields["usua_id"],$DB_gogess);
$nomb_msp=$objformulario->replace_cmb("app_usuario","usua_id,usua_msp","where usua_id=",$rs_sihaydata->fields["usua_id"],$DB_gogess);

//qr


$codigo_dataqr=date("Y-m-d H:i:s").' '.$clie_id.' '.$valor_id.' REFERENCIA '.$_SESSION['ces1313777_sessid_inicio'].' '.$nomb_medico;

$qrCode = new QrCode($codigo_dataqr);//Creo una nueva instancia de la clase
$qrCode->setSize("100");//Establece el tamaño del qr
//header('Content-Type: '.$qrCode->getContentType());
$image= $qrCode->writeString();//Salida en formato de texto 
$mombre_grafico='QR_'.date("YmdHis").$_SESSION['ces1313777_sessid_inicio'].'_'.$valor_id.'.png';
$qrCode->writeFile('temporal/'.$mombre_grafico);
$imageData = base64_encode($image);//Codifico la imagen usando base64_encode 
//qr

  //=========================================================================
   $tipref_id=$rs_sihaydata->fields["tipref_id"]; 
  
  if($tipref_id==1 or $tipref_id==2)
  {
  $url="plantillas/referencia.php";
  }
  else
  {
  $url="plantillas/contrareferencia.php";  
  }
  
  $lee_plantilla=$objvarios->leer_contenido_completo($url);
  
  $lee_plantilla=str_replace("-centro-",$nomb_centro,$lee_plantilla);
  $lee_plantilla=str_replace("-nombre-",$nombre_paciente,$lee_plantilla);
  $lee_plantilla=str_replace("-apellido-",$apellido_paciente,$lee_plantilla);
  $lee_plantilla=str_replace("-sexo-",$clie_genero,$lee_plantilla);
  $lee_plantilla=str_replace("-hc-",$hc,$lee_plantilla);
  $lee_plantilla=str_replace("-motivoconsulta-",$anam_motivoconsulta,$lee_plantilla);
  
  $qr_g="<center><br><img src='data:image/png;base64,".$imageData."' width='60px' ><br>".$codigo_dataqr."<br></center>";
  $lee_plantilla=str_replace("-qr-",$qr_g,$lee_plantilla);
  
  ///edad actual 
  $num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_sihaydata->fields["referencia_fecharegistro"]);
  $lee_plantilla=str_replace("-edad-",$num_mes["anio"],$lee_plantilla);
  
   $naci_data=explode("-",$rs_dcliente->fields["clie_fechanacimiento"]);
  
   $lee_plantilla=str_replace("-ndia-",$naci_data[2],$lee_plantilla);
   $lee_plantilla=str_replace("-nmes-",$naci_data[1],$lee_plantilla);
   $lee_plantilla=str_replace("-nanio-",$naci_data[0],$lee_plantilla);
   
   //naionalidad   
   
$nacionalidad_valor='';
$nacionalidad_valor=$objvarios->selecciona_nacionalidad($nac_id,$DB_gogess);
$lee_plantilla=str_replace("-nacionalidad-",$nacionalidad_valor,$lee_plantilla);

$nomb_pais='';
$nomb_pais=$objformulario->replace_cmb("cesdb_arcombos.dns_nacionalidad","nac_id,nac_nombre","where nac_id=",$nac_id,$DB_gogess);
$lee_plantilla=str_replace("-pais-",$nomb_pais,$lee_plantilla);

     
$lee_plantilla=str_replace("-cedula-",$rs_dcliente->fields["clie_rucci"],$lee_plantilla);
   
   
 $prob_codigo=$objformulario->replace_cmb("cesdb_arcombos.app_provincia","prob_codigo,prob_nombre","where prob_codigo=",$rs_dcliente->fields["prob_codigo"],$DB_gogess);
 $lee_plantilla=str_replace("-prob_codigo-",$prob_codigo,$lee_plantilla);
 
 $cant_codigo=$objformulario->replace_cmb("cesdb_arcombos.app_canton","cant_codigo,cant_nombre","where cant_codigo=",$rs_dcliente->fields["cant_codigo"],$DB_gogess);
 $lee_plantilla=str_replace("-cant_codigo-",$cant_codigo,$lee_plantilla);
 
 $clie_parroquia=$rs_dcliente->fields["clie_parroquia"];
 $lee_plantilla=str_replace("-clie_parroquia-",$clie_parroquia,$lee_plantilla); 
 
 $clie_direccion=$rs_dcliente->fields["clie_direccion"];
 $lee_plantilla=str_replace("-clie_direccion-",$clie_direccion,$lee_plantilla);
 
 $clie_celular=$rs_dcliente->fields["clie_celular"];
 $lee_plantilla=str_replace("-clie_celular-",$clie_celular,$lee_plantilla);   
 
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
   

 
  $lista_cmb="select * from cesdb_arcombos.cmb_tiporef";
  $rs_cmb = $DB_gogess->executec($lista_cmb,array());
  if($rs_cmb)
	{
		while (!$rs_cmb->EOF) 
		{				  
		   if($rs_cmb->fields["tipref_id"]==$tipref_id)
		   {
		   $lee_plantilla=str_replace("-tipref_id".$rs_cmb->fields["tipref_id"]."-",'<b>X</b>',$lee_plantilla);
		   }
		   else
		   {
		   $lee_plantilla=str_replace("-tipref_id".$rs_cmb->fields["tipref_id"]."-",'&nbsp;',$lee_plantilla);
		   }
		  
		  $rs_cmb->MoveNext();
		}
	}	
  
  //==============================================
  if($tipref_id==1 or $tipref_id==2)
  {
       $lista_nempresa="select * from app_empresa where emp_id=1";
       $rs_nempresa = $DB_gogess->executec($lista_nempresa,array());	   
	   $lee_plantilla=str_replace("-empresa1-",$rs_nempresa->fields["emp_nombre"],$lee_plantilla);  
       $lee_plantilla=str_replace("-hc1-",$hc,$lee_plantilla);
       $lee_plantilla=str_replace("-centro1-",$nomb_centro,$lee_plantilla);
	   
	   $lee_plantilla=str_replace("-referencia_tipo-",$rs_sihaydata->fields["referencia_tipo"],$lee_plantilla);
	   $lee_plantilla=str_replace("-referencia_distrito-",$rs_sihaydata->fields["referencia_distrito"],$lee_plantilla);
	   
	 $lista_standar='referencia_entidad,referencia_entidadr,referencia_establecimientor,referencia_fechar,referencia_especifique,referencia_resumen,referencia_hallazgos';
	 $lista_standararray=array();
	 $lista_standararray=explode(",",$lista_standar);
	 
	 for($i=0;$i<count($lista_standararray);$i++)
	 { 
	 $lab_marca=$rs_sihaydata->fields[$lista_standararray[$i]];
	 //$lab_marca=genera_x($lab_marca);
	 $lee_plantilla=str_replace("-".$lista_standararray[$i]."-",$lab_marca,$lee_plantilla); 
	 } 
	 
	 
	 //listas
	 
	 $lista_standar='referencia_servicior,referencia_especialidadr,permif_id';
	 $lista_standararray=array();
	 $lista_standararray=explode(",",$lista_standar);
	 
	 for($i=0;$i<count($lista_standararray);$i++)
	 { 
	 
	 $busca_campo="select * from gogess_sisfield where fie_name='".$lista_standararray[$i]."' and tab_name='".$table."'";
	 $rs_ncampo = $DB_gogess->executec($busca_campo,array());
	 $lab_marca=$objformulario->replace_cmb($rs_ncampo->fields["fie_tabledb"],$rs_ncampo->fields["fie_datadb"],$rs_ncampo->fields["fie_sql"],$rs_sihaydata->fields[$lista_standararray[$i]],$DB_gogess);

	 //$lab_marca=genera_x($lab_marca);
	 $lee_plantilla=str_replace("-".$lista_standararray[$i]."-",$lab_marca,$lee_plantilla); 
	 
	 } 
	 
	   
	   
	   
	   $lee_plantilla=str_replace("-referencia_limitada-",genera_x($rs_sihaydata->fields["referencia_limitada"]),$lee_plantilla);
	   $lee_plantilla=str_replace("-referencia_ausenciaprofesional-",genera_x($rs_sihaydata->fields["referencia_ausenciaprofesional"]),$lee_plantilla);
	   $lee_plantilla=str_replace("-referencia_faltaprofesional-",genera_x($rs_sihaydata->fields["referencia_faltaprofesional"]),$lee_plantilla);
	   $lee_plantilla=str_replace("-referencia_saturacion-",genera_x($rs_sihaydata->fields["referencia_saturacion"]),$lee_plantilla);
	   $lee_plantilla=str_replace("-referencia_otros-",genera_x($rs_sihaydata->fields["referencia_otros"]),$lee_plantilla);
	    
	   
//diagnosticos
   $datos_diagnostico='';
   $cuentase=0;
   $diagosticos_rv="select * from dns_diagnosticoreferencia where referencia_enlace='".$referencia_enlace."' limit 6";
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
	   	   
	   $lee_plantilla=str_replace("-profesional1-",$nomb_medico,$lee_plantilla);
	   $lee_plantilla=str_replace("-msp1-",$nomb_msp,$lee_plantilla);
	   
	   
	   
	   
	   
  }
  
  //==============================================
   
  if($tipref_id==3 or $tipref_id==4)
  {
  
       $lista_nempresa="select * from app_empresa where emp_id=1";
       $rs_nempresa = $DB_gogess->executec($lista_nempresa,array());	   
	   $lee_plantilla=str_replace("-empresa1-",$rs_nempresa->fields["emp_nombre"],$lee_plantilla);  
       $lee_plantilla=str_replace("-hc1-",$hc,$lee_plantilla);
       $lee_plantilla=str_replace("-centro1-",$nomb_centro,$lee_plantilla);
	   
	   $lista_standar='referencia_entidadcr,referencia_entidadinv,referencia_establecimientoinv,referencia_tipoinv,referencia_distritoinv,referencia_fechainv,referencia_resumen,referencia_hallazgos,referencia_tratamientos,referencia_tratamientorecomendado';
	 $lista_standararray=array();
	 $lista_standararray=explode(",",$lista_standar);
	 
	 for($i=0;$i<count($lista_standararray);$i++)
	 { 
	 $lab_marca=$rs_sihaydata->fields[$lista_standararray[$i]];
	 //$lab_marca=genera_x($lab_marca);
	 $lee_plantilla=str_replace("-".$lista_standararray[$i]."-",$lab_marca,$lee_plantilla); 
	 } 
	 
	 
	 //listas	 
	 $lista_standar='referencia_serviciocr,referencia_especialidadcr,referencia_tipocr';
	 $lista_standararray=array();
	 $lista_standararray=explode(",",$lista_standar);
	 
	 for($i=0;$i<count($lista_standararray);$i++)
	 { 
	 
	 $busca_campo="select * from gogess_sisfield where fie_name='".$lista_standararray[$i]."' and tab_name='".$table."'";
	 $rs_ncampo = $DB_gogess->executec($busca_campo,array());
	 $lab_marca=$objformulario->replace_cmb($rs_ncampo->fields["fie_tabledb"],$rs_ncampo->fields["fie_datadb"],$rs_ncampo->fields["fie_sql"],$rs_sihaydata->fields[$lista_standararray[$i]],$DB_gogess); 
	 //$lab_marca=genera_x($lab_marca);
	 
	 $lee_plantilla=str_replace("-".$lista_standararray[$i]."-",$lab_marca,$lee_plantilla); 
	 } 
	 //listas
	 
	 
	 //diagnosticos
   $datos_diagnostico='';
   $cuentase=0;
   $diagosticos_rv="select * from dns_diagnosticoreferencia where referencia_enlace='".$referencia_enlace."' limit 6";
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
 
 $lee_plantilla=str_replace("-profesional1-",$nomb_medico,$lee_plantilla);
 $lee_plantilla=str_replace("-msp1-",$nomb_msp,$lee_plantilla);
	   
  
  
  }
 
 
 
 
 $lee_plantilla=str_replace("-referencia_justificada-",genera_x($rs_sihaydata->fields["referencia_justificada"]),$lee_plantilla);
 

$comprobantepdf=$lee_plantilla;
  
$xml="Planilla";
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