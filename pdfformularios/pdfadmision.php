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

$iddata=$_GET["iddata"];
$tab_id=$iddata;

$clie_id=$_GET["clie_id"];

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
  
//$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
//$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($mnupan_id));
//$lista_atencion="select * from dns_atencion where atenc_id=?";
//$rs_atencion = $DB_gogess->executec($lista_atencion,array($atenc_id));

$lista_tabla="select * from gogess_sistable,gogess_styletable where gogess_sistable.st_id=gogess_styletable.st_id and tab_id='".$tab_id."'";
$rs_tabla = $DB_gogess->executec($lista_tabla,array());
//busca datos del paciente
$datos_cliente="select * from app_cliente where clie_id='".$clie_id."'";
$rs_dcliente = $DB_gogess->executec($datos_cliente,array());

$nombre_paciente=$rs_dcliente->fields["clie_nombre"];
$apellido_paciente=$rs_dcliente->fields["clie_apellido"];
$clie_genero=$rs_dcliente->fields["clie_genero"];
//$hc=$rs_atencion->fields["atenc_hc"];
$hc=$rs_dcliente->fields["clie_rucci"];
$hcpinos=$rs_dcliente->fields["clie_hcpinos"]; 
$conve_id=$rs_dcliente->fields["conve_id"]; 
$nac_id=$rs_dcliente->fields["nac_id"];



//$causaexterna=$rs_dcliente->fields["anam_causaexterna"];

$table=$rs_tabla->fields["tab_name"];  
$campo_primariodata=$rs_tabla->fields["tab_campoprimario"]; 
//$busca_sihaydata="select * from ".$table." where atenc_id=? and clie_id=?";
$busca_sihaydata="select * from ".$table." where  ".$campo_primariodata."=?";
$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array($clie_id));

$clie_apellido=$rs_sihaydata->fields["clie_apellido"];
$clie_nombre=$rs_sihaydata->fields["clie_nombre"];

$uni_codiog=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_codigo","where centro_id=",1,$DB_gogess);


$url="plantillas/admisiones_altaegreso.php";
$lee_plantilla=$objvarios->leer_contenido_completo($url);

$genero_valor='';
$genero_valor=$objvarios->seleccion_genero($clie_genero);
$lee_plantilla=str_replace("-genero-",$genero_valor,$lee_plantilla);

$institucion_valor='';
$institucion_valor=$objvarios->selecciona_institucion($conve_id);
$lee_plantilla=str_replace("-institucion-",$institucion_valor,$lee_plantilla);

$nacionalidad_valor='';
$nacionalidad_valor=$objvarios->selecciona_nacionalidad($nac_id,$DB_gogess);
$lee_plantilla=str_replace("-nac_id-",$nacionalidad_valor,$lee_plantilla);

 
$campos_evo=''; 
$campos_evo="select * from gogess_sisfield where tab_name='".$table."'";
$rs_camposevo = $DB_gogess->executec($campos_evo,array());
if($rs_camposevo)
	{
		while (!$rs_camposevo->EOF) {
		
		if($rs_camposevo->fields["fie_value"]=='replace')
		{		
		  $lab_datos=$objformulario->replace_cmb($rs_camposevo->fields["fie_tabledb"],$rs_camposevo->fields["fie_datadb"],$rs_camposevo->fields["fie_sql"],$rs_sihaydata->fields[$rs_camposevo->fields["fie_name"]],$DB_gogess);		  
		}
		else
		{		
		   $lab_datos=$rs_sihaydata->fields[$rs_camposevo->fields["fie_name"]];
		}
		
        $lee_plantilla=str_replace("-".$rs_camposevo->fields["fie_name"]."-",$lab_datos,$lee_plantilla);
		
		$rs_camposevo->MoveNext();
		}
	}	
	
$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_sihaydata->fields["clie_registro"]);
$lee_plantilla=str_replace("-edad-",$num_mes["anio"],$lee_plantilla);

//----------------------//--------------------------------------
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
//----------------------//--------------------------------------

$lee_plantilla=str_replace("-ucodigo-",$uni_codiog,$lee_plantilla);  
$lee_plantilla=str_replace("-hc-",$hc,$lee_plantilla);
    $logo = $objformulario->replace_cmb("app_empresa", "emp_id,emp_logoreporte", "where emp_id=", 1, $DB_gogess);
    $emp_nombre = $objformulario->replace_cmb("app_empresa", "emp_id,emp_nombre", "where emp_id=", 1, $DB_gogess);
    $emp_piedepagina = $objformulario->replace_cmb("app_empresa", "emp_id,emp_piedepagina", "where emp_id=", 1, $DB_gogess);

// Cabecera y pie de página
    $lee_plantilla = str_replace("-logoreporte-", $logo, $lee_plantilla);
    $lee_plantilla = str_replace("-empresanombre-", $emp_nombre, $lee_plantilla);
    $lee_plantilla = str_replace("-piedepagina-", $emp_piedepagina, $lee_plantilla);
//=========================

 
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


//=======================


$canvas->close_object();
$canvas->add_object($footer, "all");
$dompdf->stream($xml."_".$hc."_".$clie_id.".pdf");


}
?>