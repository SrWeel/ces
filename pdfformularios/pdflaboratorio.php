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
$hc=$rs_atencion->fields["atenc_hc"];


$table=$rs_tabla->fields["tab_name"];  
$campo_primariodata=$rs_tabla->fields["tab_campoprimario"]; 
//$busca_sihaydata="select * from ".$table." where atenc_id=? and clie_id=?";
$busca_sihaydata="select * from ".$table." where  ".$campo_primariodata."=?";
$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array($valor_id));

$nomb_centro='';
$nomb_medico='';
$nomb_centro=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombreprint","where centro_id=",$rs_sihaydata->fields["centro_id"],$DB_gogess);
$nomb_medico=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido","where usua_id=",$rs_sihaydata->fields["usua_id"],$DB_gogess);



  //=========================================================================
  
  
  $url="plantillas/laboratorio010A_solicitud.php";
  $lee_plantilla=$objvarios->leer_contenido_completo($url);
  
  $lee_plantilla=str_replace("-empresa-","PICHINCHA HUMANA",$lee_plantilla);
  
  $lee_plantilla=str_replace("-centro-",$nomb_centro,$lee_plantilla);
  $lee_plantilla=str_replace("-nombre-",$nombre_paciente,$lee_plantilla);
  $lee_plantilla=str_replace("-apellido-",$apellido_paciente,$lee_plantilla);
  
   ///edad actual
 
 	$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_sihaydata->fields["imgag_fecharegistro"]);
	$lee_plantilla=str_replace("-edad-",$num_mes["anio"],$lee_plantilla);
 
 //edad actual
  
  $lee_plantilla=str_replace("-sexo-",$clie_genero,$lee_plantilla);
  $lee_plantilla=str_replace("-hc-",$hc,$lee_plantilla);
  $lee_plantilla=str_replace("-motivoconsulta-",$anam_motivoconsulta,$lee_plantilla);
  
 
 $prob_codigo=$objformulario->replace_cmb("cesdb_arcombos.app_provincia","prob_codigo,prob_nombre","where prob_codigo=",$rs_sihaydata->fields["prob_codigo"],$DB_gogess);
 $lee_plantilla=str_replace("-prob_codigo-",$prob_codigo,$lee_plantilla);
 
 $cant_codigo=$objformulario->replace_cmb("cesdb_arcombos.app_canton","cant_codigo,cant_nombre","where cant_codigo=",$rs_sihaydata->fields["cant_codigo"],$DB_gogess);
 $lee_plantilla=str_replace("-cant_codigo-",$cant_codigo,$lee_plantilla);
 
 $lab_parroquia=$rs_sihaydata->fields["lab_parroquia"];
 $lee_plantilla=str_replace("-lab_parroquia-",$lab_parroquia,$lee_plantilla);
 
 
 $lab_parroquia=$rs_sihaydata->fields["lab_parroquia"];
 $lee_plantilla=str_replace("-lab_parroquia-",$lab_parroquia,$lee_plantilla);
 
 $clie_rucci=$rs_dcliente->fields["clie_rucci"];
 $lee_plantilla=str_replace("-cedula-",$clie_rucci,$lee_plantilla);
 
 $lab_fechasolicitud=$rs_sihaydata->fields["lab_fechasolicitud"];
 $lee_plantilla=str_replace("-lab_fechasolicitud-",$lab_fechasolicitud,$lee_plantilla);
 
 $lab_cama=$rs_sihaydata->fields["lab_cama"];
 $lee_plantilla=str_replace("-lab_cama-",$lab_cama,$lee_plantilla);
 
 $lab_servicio=$rs_sihaydata->fields["lab_servicio"];
 $lee_plantilla=str_replace("-lab_servicio-",$lab_servicio,$lee_plantilla);
  
 $lab_sala=$rs_sihaydata->fields["lab_sala"];
 $lee_plantilla=str_replace("-lab_sala-",$lab_sala,$lee_plantilla); 
 
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
  
 //HEMATOLOGIA
 $lista_hema='lab_hemabiometria,lab_hemaplaquetas,lab_hemagrupo,lab_hemareticulocitos,lab_hemahematozoario,lab_hemacelula,lab_hematocritohemoglobina,lab_hemaindices,lab_hemat,lab_hematiempo,lab_hemadrepa,lab_hemacoombs,lab_hemaindirecto,lab_tiemposangria,lab_uroelemental,lab_urogota,lab_uroprueba,lab_coproseriado,lab_copocopro,lab_copoinv,lab_coproseriado,lab_coposangre,lab_coporotavirus,lab_quiglucosa,lab_quihoras,lab_quiurea,lab_quicreatina,lab_quibilirrubinadirecta,lab_quiacidourico,lab_quiproteinas,lab_albumina,lab_globulina,lab_quitrans,lab_quioxa,lab_quifosfa,lab_fosfatasaacida,lab_quicolesterol,lab_quihdl,lab_quildl,lab_quitrigliseridos,lab_amilasa,lab_hierroserico,lab_quibilirrubinas,lab_vdrl,lab_febriles,lab_rflatex,lab_asto,lab_hiv,lab_hepatitisa,lab_hepatitisb,lab_pcr,lab_hepihe,lab_dengue,lab_psa,lab_hepisuero,lab_rpr,lab_bactgram,lab_bactziehl,lab_bacthongos,lab_bactfresco,lab_bactcultivo,lab_eosinofilosmoconasal,lab_eosinofilosmoconasal';
 $lista_hemaarray=array();
 $lista_hemaarray=explode(",",$lista_hema);
 
 for($i=0;$i<count($lista_hemaarray);$i++)
 { 
 $lab_marca=$rs_sihaydata->fields[$lista_hemaarray[$i]];
 $lab_marca=genera_x($lab_marca);
 $lee_plantilla=str_replace("-".$lista_hemaarray[$i]."-",$lab_marca,$lee_plantilla); 
 }
 //HEMATOLOGIA
 

  
 $lab_bactmuestra=$rs_sihaydata->fields["lab_bactmuestra"];
 $lee_plantilla=str_replace("-lab_bactmuestra-",$lab_bactmuestra,$lee_plantilla); 
 
 $lab_otros=$rs_sihaydata->fields["lab_otros"];
 $lee_plantilla=str_replace("-lab_otros-",$lab_otros,$lee_plantilla); 
 
  
 $lee_plantilla=str_replace("-anam_planes-",$anam_planes,$lee_plantilla);
 
 $lab_fecharegistro=$rs_sihaydata->fields["lab_fecharegistro"];
 $separa_fecha_hora=explode(" ",$lab_fecharegistro);
 $lee_plantilla=str_replace("-lab_fecharegistro-",$separa_fecha_hora[0],$lee_plantilla);
 $lee_plantilla=str_replace("-fechhora-",$separa_fecha_hora[1],$lee_plantilla);
 $lee_plantilla=str_replace("-medico-",$nomb_medico,$lee_plantilla);
 

 
 
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