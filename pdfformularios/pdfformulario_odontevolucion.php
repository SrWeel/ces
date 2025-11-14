<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8'); 
$tiempossss=54444000;
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

//$busca_sihaydata="select * from ".$table." where  odonto_id=?";
//$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array($valor_id));


	
/**/

//paginar
$numxpagina=11;

$busca_cuenta="select count(*) as total from ".$table." where odonto_id=?";
$rs_cuenta = $DB_gogess->executec($busca_cuenta,array($valor_id));
$npaginas=0;
//$rs_cuenta->fields["total"]."<br>";
$npaginas=$rs_cuenta->fields["total"]/$numxpagina;

$numero_er=explode(".",$npaginas);
$numero_entero=$numero_er[0];

$valor_md=0;
$valor_md="0.".$numero_er[1];

if($valor_md>0)
		{
		  $numtpg=$numero_er[0]+1;
		  $numero_entero=$numero_er[0]+1;
		}

$concatena_paginas='';	


//paginar
$incio_reg=0;
$fin_reg=10;
for($i=0;$i<$numero_entero;$i++)
{

   $url="plantillas/form033reversoodontologia.php";
   $lee_plantilla=$objvarios->leer_contenido_completo($url);   
  
   
  $lee_plantilla=str_replace("-nombre-",$nombre_paciente,$lee_plantilla);
  $lee_plantilla=str_replace("-apellido-",$apellido_paciente,$lee_plantilla);
  $lee_plantilla=str_replace("-sexo-",$clie_genero,$lee_plantilla);
  $lee_plantilla=str_replace("-hc-",$hc,$lee_plantilla);

   
   
   $cuenta_val=0;
   $rs_aevolucion="select * from ".$table." where  odonto_id=? limit ".$incio_reg.",".$fin_reg;
   $rs_aevolucion = $DB_gogess->executec($rs_aevolucion,array($valor_id));
   
   if($rs_aevolucion)
	{
		while (!$rs_aevolucion->EOF) {
		
		
		  $nomb_medico=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido","where usua_id=",$rs_aevolucion->fields["usua_id"],$DB_gogess);
		  $usua_codigo=$objformulario->replace_cmb("app_usuario","usua_id,usua_codigo","where usua_id=",$rs_aevolucion->fields["usua_id"],$DB_gogess);
		  $usua_codigoiniciales=$objformulario->replace_cmb("app_usuario","usua_id,usua_codigoiniciales","where usua_id=",$rs_aevolucion->fields["usua_id"],$DB_gogess);		  	  
		
		  $cuenta_val++;  
		  
		  $numsess='';
		  $numsess="<b>SESI&Oacute;N </b>".$cuenta_val."<br><hr>";
		  
		  //diagnosticos
		  
  //PLANES DE DIAGNÓSTICO, TERAPÉUTICO Y EDUCACIONAL
  
  $datos_rs_dns_odontologiaplandiganostico='';
  $lista_dns_odontologiaplandiganostico="select * from dns_diagnosticosubsecuenteodonto where subsecodont_enlace='".$rs_aevolucion->fields["subsecodont_enlace"]."'";
  $rs_dns_odontologiaplandiganostico = $DB_gogess->executec($lista_dns_odontologiaplandiganostico,array());
  if($rs_dns_odontologiaplandiganostico)
	{
		while (!$rs_dns_odontologiaplandiganostico->EOF) {
		
		  $datos_rs_dns_odontologiaplandiganostico.=$rs_dns_odontologiaplandiganostico->fields["diagn_tipo"]." ".$rs_dns_odontologiaplandiganostico->fields["diagn_descripcion"].", ";		  
		 		
		  $rs_dns_odontologiaplandiganostico->MoveNext();
		}
	}	
	 
  
  //PLANES DE DIAGNÓSTICO, TERAPÉUTICO Y EDUCACIONAL
		  
		  //diagnosticos
		  //."<br>".$usua_codigoiniciales." ".$nomb_medico."<br>".$usua_codigo
		  
	//dns_recetasodontologia
	$prescripcion_val='';
	$prescripcion_val=$rs_aevolucion->fields["subsecodont_prescripciones"]."<br>";
	$lista_receta="select * from dns_recetasodontologia where subsecodont_enlace='".$rs_aevolucion->fields["subsecodont_enlace"]."'";
	$rs_receta = $DB_gogess->executec($lista_receta,array());
	if($rs_receta)
	{
		while (!$rs_receta->EOF) {
		
		$prescripcion_val.=$rs_receta->fields["plantra_medicamento"].' Cantidad:'.$rs_receta->fields["plantra_cantidad"].' '.$rs_receta->fields["plantra_indicaciones"].', ';
		
		$rs_receta->MoveNext();
		}
	}	
	//dns_recetasodontologia	  
		  
		  
		  $lee_plantilla=str_replace("-fecha".$cuenta_val."-",$numsess.$rs_aevolucion->fields["subsecodont_fecharegistro"],$lee_plantilla); 
//		  $lee_plantilla=str_replace("-hora".$cuenta_val."-",$rs_aevolucion->fields["conext_horar"],$lee_plantilla);
		  $lee_plantilla=str_replace("-notas".$cuenta_val."-",$datos_rs_dns_odontologiaplandiganostico." ".$rs_aevolucion->fields["subsecodont_diagnosticoscomplicaciones"],$lee_plantilla);
		  $lee_plantilla=str_replace("-farmaco".$cuenta_val."-",$rs_aevolucion->fields["subsecodont_procedimientos"],$lee_plantilla);
		  $lee_plantilla=str_replace("-otros".$cuenta_val."-",$prescripcion_val,$lee_plantilla);
		  
		
		  $rs_aevolucion->MoveNext();
		}
	}
	
  for($z=1;$z<=11;$z++)
  {
          $lee_plantilla=str_replace("-fecha".$z."-","",$lee_plantilla); 
		  $lee_plantilla=str_replace("-hora".$z."-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-notas".$z."-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-farmaco".$z."-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-otros".$z."-","",$lee_plantilla);
  
  }
   
   $incio_reg=$fin_reg+1;
   $fin_reg=$fin_reg+$numxpagina;
   
   if($i==($numero_entero-1))
   {
   $salto_pagina='';
   }
   else
   {
   $salto_pagina='<div style="page-break-after:always;"></div>';
   }
   $concatena_paginas.=$lee_plantilla.$salto_pagina;	
}


$comprobantepdf=$concatena_paginas;
  
$xml="ODONTOLOGIA";
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

$dompdf->stream($xml."_".$hc."_".date("Y-m-d").".pdf");


}

?>