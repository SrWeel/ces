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

$conve_id=$rs_dcliente->fields["conve_id"]; 
$nac_id=$rs_dcliente->fields["nac_id"];

$uni_codiog='';
$uni_codiog=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_codigo","where centro_id=",1,$DB_gogess);

$table=$rs_tabla->fields["tab_name"];  
$campo_primariodata=$rs_tabla->fields["tab_campoprimario"]; 

$busca_sihaydata="select * from ".$table." where  conext_id=?";
$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array($valor_id));


//pagina informacion
$array_letrascon=array();
$array_letrascon[1]='A';
$array_letrascon[2]='B';
$array_letrascon[3]='A';
$array_letrascon[4]='B';
$array_letrascon[5]='A';
$array_letrascon[6]='B';
$array_letrascon[7]='A';
$array_letrascon[8]='B';
$array_letrascon[9]='A';
$array_letrascon[10]='B';
$array_letrascon[11]='A';
$array_letrascon[12]='B';
$array_letrascon[13]='A';
$array_letrascon[14]='B';

$anam_idpg=$rs_sihaydata->fields["anam_id"];
$conteo_pg=0;
$busca_listapg="select * from dns_newhospitalizacionconsultaexterna where anam_id='".$anam_idpg."' order by conext_id asc";
$rs_blistapg = $DB_gogess->executec($busca_listapg,array());
   
   if($rs_blistapg)
	{
		while (!$rs_blistapg->EOF) {
		
		  $conteo_pg++;
		  $actualizpg="update dns_newhospitalizacionconsultaexterna set conext_pagina='".$conteo_pg."-".$array_letrascon[$conteo_pg]."' where conext_id='".$rs_blistapg->fields["conext_id"]."'";
		  $rs_acpg= $DB_gogess->executec($actualizpg,array());
		
		 $rs_blistapg->MoveNext();
		}
	}	


//pagina informacion 
	
/**/

//paginar
$numxpagina=11;
 $busca_cuenta="select count(*) as total from ".$table." where  conext_id=?";
$rs_cuenta = $DB_gogess->executec($busca_cuenta,array($valor_id));
$npaginas=0;
$npaginas=$rs_cuenta->fields["total"]/$numxpagina;

$numero_er=explode(".",$npaginas);
$numero_entero=$numero_er[0];
if($numero_er[1]>0)
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

   $url="plantillas/evoform002reversonewveolucionhospimrg.php";
   $lee_plantilla=$objvarios->leer_contenido_completo($url);   
  
   
  $lee_plantilla=str_replace("-nombre-",$nombre_paciente,$lee_plantilla);
  $lee_plantilla=str_replace("-apellido-",$apellido_paciente,$lee_plantilla);
  $lee_plantilla=str_replace("-sexo-",$clie_genero,$lee_plantilla);
  $lee_plantilla=str_replace("-hc-",$hc,$lee_plantilla);
  $lee_plantilla=str_replace("-hcpinos-",$hcpinos,$lee_plantilla);
  
$institucion_valor='';
$institucion_valor=$objvarios->selecciona_institucion($conve_id);
$lee_plantilla=str_replace("-institucion-",$institucion_valor,$lee_plantilla);

$nacionalidad_valor='';
$nacionalidad_valor=$objvarios->selecciona_nacionalidad($nac_id,$DB_gogess);
$lee_plantilla=str_replace("-nac_nombre-",$nacionalidad_valor,$lee_plantilla);

$lee_plantilla=str_replace("-ucodigo-",$uni_codiog,$lee_plantilla);

  
  $busca_pgvalor="select * from ".$table." where  conext_id=?";
  $rs_pgbalor = $DB_gogess->executec($busca_pgvalor,array($valor_id));
  
  $lee_plantilla=str_replace("-pgcont-",$rs_pgbalor->fields["conext_pagina"],$lee_plantilla);
  
  
  ///edad actual 
  $num_mes=array();
  $num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_sihaydata->fields["conext_fechar"]);
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

   
   
   $cuenta_val=0;
   $rs_aevolucion="select * from ".$table." where  conext_id=? limit ".$incio_reg.",".$fin_reg;
   $rs_aevolucion = $DB_gogess->executec($rs_aevolucion,array($valor_id));
   
   if($rs_aevolucion)
	{
		while (!$rs_aevolucion->EOF) {
		
		
		  $nomb_medico=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido","where usua_id=",$rs_aevolucion->fields["usua_id"],$DB_gogess);
		  $usua_codigo=$objformulario->replace_cmb("app_usuario","usua_id,usua_codigo","where usua_id=",$rs_aevolucion->fields["usua_id"],$DB_gogess);
		  $usua_codigoiniciales=$objformulario->replace_cmb("app_usuario","usua_id,usua_codigoiniciales","where usua_id=",$rs_aevolucion->fields["usua_id"],$DB_gogess);		  	  
		
		  $cuenta_val++;  
		  $lee_plantilla=str_replace("-fecha".$cuenta_val."-",$rs_aevolucion->fields["conext_fechar"],$lee_plantilla); 
		  $lee_plantilla=str_replace("-hora".$cuenta_val."-",$rs_aevolucion->fields["conext_horar"],$lee_plantilla);
		  $lee_plantilla=str_replace("-horaf".$cuenta_val."-",$rs_aevolucion->fields["conext_horaf"],$lee_plantilla);
		  $lee_plantilla=str_replace("-notas".$cuenta_val."-",str_replace("\n", "<br>" ,$rs_aevolucion->fields["conext_notasdeevolucion"]),$lee_plantilla);
		  $lee_plantilla=str_replace("-farmaco".$cuenta_val."-",str_replace("\n", "<br>" ,$rs_aevolucion->fields["conext_prescripciones"])."<br>".$usua_codigoiniciales." ".$nomb_medico."<br>".$usua_codigo,$lee_plantilla);
		  $lee_plantilla=str_replace("-otros".$cuenta_val."-","",$lee_plantilla);
		  
		
		  $rs_aevolucion->MoveNext();
		}
	}
	
  for($z=1;$z<=11;$z++)
  {
          $lee_plantilla=str_replace("-fecha".$z."-","",$lee_plantilla); 
		  $lee_plantilla=str_replace("-hora".$z."-","",$lee_plantilla);
		  $lee_plantilla=str_replace("-horaf".$z."-","",$lee_plantilla);
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



echo $comprobantepdf=$concatena_paginas;
  
$xml="Planilla";
$dompdf = new DOMPDF();
$dompdf->set_paper('A4', 'portrait');
$dompdf->load_html($comprobantepdf, 'UTF-8');
$dompdf->render();
$font = Font_Metrics::get_font("helvetica", "bold");
$canvas = $dompdf->get_canvas();
$footer = $canvas->open_object();



//$canvas->close_object();
//$canvas->add_object($footer, "all");

//$dompdf->stream($xml."_".$hc."_".$separa_fecha_hora[0].".pdf");


}

?>