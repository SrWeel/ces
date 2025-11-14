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
$nomb_centro=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombreprint","where centro_id=",$rs_sihaydata->fields["centro_id"],$DB_gogess);
$nomb_medico=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido","where usua_id=",$rs_sihaydata->fields["usua_id"],$DB_gogess);

$usua_ciruc='';
$usua_ciruc=$objformulario->replace_cmb("app_usuario","usua_id,usua_ciruc","where usua_id=",$rs_sihaydata->fields["usua_id"],$DB_gogess);

$lab_enlace=$rs_sihaydata->fields["lab_enlace"];

  //=========================================================================
  
  
  $url="plantillas/newlaboratorio010A_solicitud.php";
  $lee_plantilla=$objvarios->leer_contenido_completo($url);
  
  $lee_plantilla=str_replace("-empresa-","PICHINCHA HUMANA",$lee_plantilla);
  
  $lee_plantilla=str_replace("-centro-",$nomb_centro,$lee_plantilla);
  $lee_plantilla=str_replace("-nombre-",$nombre_paciente,$lee_plantilla);
  $lee_plantilla=str_replace("-apellido-",$apellido_paciente,$lee_plantilla);
  
  $lee_plantilla=str_replace("-hcpinos-",$hcpinos,$lee_plantilla);
  
  
$genero_valor='';
$genero_valor=$objvarios->seleccion_generonombre($clie_genero);
$lee_plantilla=str_replace("-sexo-",$genero_valor,$lee_plantilla);

$institucion_valor='';
$institucion_valor=$objvarios->selecciona_institucion($conve_id);
$lee_plantilla=str_replace("-institucion-",$institucion_valor,$lee_plantilla);

$nacionalidad_valor='';
$nacionalidad_valor=$objvarios->selecciona_nacionalidad($nac_id,$DB_gogess);
$lee_plantilla=str_replace("-nac_id-",$nacionalidad_valor,$lee_plantilla);
  
   ///edad actual
 
 	$num_mes=calcular_edad($rs_dcliente->fields["clie_fechanacimiento"],$rs_sihaydata->fields["imgag_fecharegistro"]);
	$lee_plantilla=str_replace("-edad-",$num_mes["anio"],$lee_plantilla);
 
 //edad actual
  
  $lee_plantilla=str_replace("-sexo-",$clie_genero,$lee_plantilla);
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
 
  $lab_hora=$rs_sihaydata->fields["lab_hora"];
 $lee_plantilla=str_replace("-lab_hora-",$lab_hora,$lee_plantilla); 
 
  $lab_nombretomamuestra=$rs_sihaydata->fields["lab_nombretomamuestra"];
 $lee_plantilla=str_replace("-lab_nombretomamuestra-",$lab_nombretomamuestra,$lee_plantilla); 
 
  $lab_especialidad=$rs_sihaydata->fields["lab_especialidad"];
 $lee_plantilla=str_replace("-lab_especialidad-",$lab_especialidad,$lee_plantilla); 
 
 
 $lab_otros=$rs_sihaydata->fields["lab_otros"];
 $lee_plantilla=str_replace("-lab_otros-",$lab_otros,$lee_plantilla);
 
 $lab_otros2=$rs_sihaydata->fields["lab_otros2"];
 $lee_plantilla=str_replace("-lab_otros2-",$lab_otros2,$lee_plantilla); 
 
 $prio_id=0;
 $prio_id=$rs_sihaydata->fields["prio_id"];
 
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
	
	
	//////servicio
	
	 $serlab_id=0;
 $serlab_id=$rs_sihaydata->fields["serlab_id"];
  
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
 
 
  //diagnosticos
  $cuentad=0;
   $datos_diagnostico='';
   $cuentase=0;
   $diagosticos_rv="select * from dns_newdiagnosticolaboratorio where lab_enlace='".$lab_enlace."' limit 10";
   $rs_dgnostico = $DB_gogess->executec($diagosticos_rv,array());
   if($rs_dgnostico)
	{
		while (!$rs_dgnostico->EOF) {
	
		   $cuentase++;
		   $cuentad++;
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
		   
		   
		$concatena_diag .='<tr>
    <td class="borde_all css_8" width="20px" >'.$cuentad.'</td>
    <td  class="borde_all css_8"><div align="center">'.$rs_dgnostico->fields["diagn_descripcion"].'</div></td>
    <td  class="borde_all css_8" width="40px"  ><div align="center"><span >'.$rs_dgnostico->fields["diagn_cie"].'</span></div></td>
  </tr>'; 
  
		   //	$concatena_diag .=$rs_dgnostico->fields["diagn_cie"].' '.$rs_dgnostico->fields["diagn_descripcion"]. ' <br> ';
		   
		   
		
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
 
 
$listadiag='<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"  bgcolor="#CCFFCC" class="borde_all css_8"><div align="center">DIAGNOSTICO</div></td>
    <td  bgcolor="#CCFFCC" class="borde_all css_8"><div align="center">CIE</div></td>
  </tr>
  '.$concatena_diag.'
</table>';
 
 	$lee_plantilla = str_replace("-diagnosticot-", $listadiag, $lee_plantilla);
 //diagnosticos
 
  
 //HEMATOLOGIA
 $lista_hema='lab_hemabiometria,lab_hemaplaquetas,lab_hemagrupo,lab_hemareticulocitos,lab_hemahematozoario,lab_hemacelula,lab_hematocritohemoglobina,lab_hemaindices,lab_hemat,lab_hematiempo,lab_hemadrepa,lab_hemacoombs,lab_hemaindirecto,lab_tiemposangria,lab_uroelemental,lab_urogota,lab_uroprueba,lab_coproseriado,lab_copocopro,lab_copoinv,lab_coproseriado,lab_coposangre,lab_coporotavirus,lab_quiglucosa,lab_quihoras,lab_quiurea,lab_quicreatina,lab_quibilirrubinadirecta,lab_quiacidourico,lab_quiproteinas,lab_albumina,lab_globulina,lab_quitrans,lab_quioxa,lab_quifosfa,lab_fosfatasaacida,lab_quicolesterol,lab_quihdl,lab_quildl,lab_quitrigliseridos,lab_amilasa,lab_hierroserico,lab_quibilirrubinas,lab_vdrl,lab_febriles,lab_rflatex,lab_asto,lab_hiv,lab_hepatitisa,lab_hepatitisb,lab_pcr,lab_hepihe,lab_dengue,lab_psa,lab_hepisuero,lab_rpr,lab_bactgram,lab_bactziehl,lab_bacthongos,lab_bactfresco,lab_bactcultivo,lab_eosinofilosmoconasal,lab_eosinofilosmoconasal';
 
 $lista_hema='lab_micromuestra,lab_micrositioana,lab_estudiokoh,lab_cultivomico,lab_uno,lab_dos,lab_tres';
 $lista_hemaarray=array();
 $lista_hemaarray=explode(",",$lista_hema);
 
 for($i=0;$i<count($lista_hemaarray);$i++)
 { 
 $lab_marca=$rs_sihaydata->fields[$lista_hemaarray[$i]];
 $lee_plantilla=str_replace("-".$lista_hemaarray[$i]."-",$lab_marca,$lee_plantilla); 
 }
 
 
 $lista_seleccion='lab_microseleccionuno';
 $lista_sellarray=array();
 $lista_sellarray=explode(",",$lista_seleccion);
 
 for($i=0;$i<count($lista_sellarray);$i++)
 { 
 $lab_marca=$rs_sihaydata->fields[$lista_sellarray[$i]];
 $lista_dataarray=array();
 $lista_dataarray=explode(",",$lab_marca);
  for($l=0;$l<count($lista_dataarray);$l++)
  {
    if($lista_dataarray[$l]>0)
	 {
       $lee_plantilla=str_replace("-u".$l."-","X",$lee_plantilla); 
	 }
	 else
	 {
	   $lee_plantilla=str_replace("-u".$l."-","",$lee_plantilla); 
	 } 
  
  } 
 }
 
 
 
 
 //===================================================
 
 
  $lista_seleccion='lab_microselecciondos';
 $lista_sellarray=array();
 $lista_sellarray=explode(",",$lista_seleccion);
 
 for($i=0;$i<count($lista_sellarray);$i++)
 { 
 $lab_marca=$rs_sihaydata->fields[$lista_sellarray[$i]];
 $lista_dataarray=array();
 $lista_dataarray=explode(",",$lab_marca);
  for($l=0;$l<count($lista_dataarray);$l++)
  {
    if($lista_dataarray[$l]>0)
	 {
       $lee_plantilla=str_replace("-d".$l."-","X",$lee_plantilla); 
	 }
	 else
	 {
	   $lee_plantilla=str_replace("-d".$l."-","",$lee_plantilla); 
	 } 
  
  } 
 }
 
 
/*$lista_hema='lab_micromuestra,lab_micrositioana,lab_estudiokoh,lab_cultivomico,lab_uno,lab_dos,lab_tres'
 $lista_hemaarray=array();
 $lista_hemaarray=explode(",",$lista_hema);
 
 for($i=0;$i<count($lista_hemaarray);$i++)
 { 
 $lab_marca=$rs_sihaydata->fields[$lista_hemaarray[$i]];
 $lab_marca=genera_x($lab_marca);
 $lee_plantilla=str_replace("-".$lista_hemaarray[$i]."-",$lab_marca,$lee_plantilla); 
 }*/
 //HEMATOLOGIA
 

  
 $lab_bactmuestra=$rs_sihaydata->fields["lab_bactmuestra"];
 $lee_plantilla=str_replace("-lab_bactmuestra-",$lab_bactmuestra,$lee_plantilla); 
 
 $lab_otros=$rs_sihaydata->fields["lab_otros"];
 $lee_plantilla=str_replace("-lab_otros-",$lab_otros,$lee_plantilla); 
 
 $lab_tratamiento=$rs_sihaydata->fields["lab_tratamiento"];
 $lee_plantilla=str_replace("-lab_tratamiento-",$lab_tratamiento,$lee_plantilla); 
 
 $lab_moleculargenetica=$rs_sihaydata->fields["lab_moleculargenetica"];
 $lee_plantilla=str_replace("-lab_moleculargenetica-",$lab_moleculargenetica,$lee_plantilla); 
 
 
 
  
 $lee_plantilla=str_replace("-anam_planes-",$anam_planes,$lee_plantilla);
 
 $lab_fecharegistro=$rs_sihaydata->fields["lab_fecharegistro"];
 $separa_fecha_hora=explode(" ",$lab_fecharegistro);
 $lee_plantilla=str_replace("-lab_fecharegistro-",$separa_fecha_hora[0],$lee_plantilla);
 $lee_plantilla=str_replace("-fechhora-",$separa_fecha_hora[1],$lee_plantilla);
 $lee_plantilla=str_replace("-medico-",$nomb_medico,$lee_plantilla);
 
  $lee_plantilla=str_replace("-cedulamedico-",$usua_ciruc,$lee_plantilla);
 

 //===========================================================
 $cuenta_num=0;	
$array_grupo=array();	
$campos_evo=''; 
$campos_evo="select * from gogess_sisfield where tab_name='".$table."' and fie_type='checkboxmulpeke'";
$rs_camposevo = $DB_gogess->executec($campos_evo,array());
if($rs_camposevo)
	{
		while (!$rs_camposevo->EOF) {
		
		$cuenta_num++;
		$fie_id=0;
		$fie_id=$rs_camposevo->fields["fie_id"];
		
		switch ($rs_camposevo->fields["fie_type"]) {
			case 'checkboxmulpeke':
				{
		   $valorfievalue=array();
		   $valorfievalue=explode(",",$rs_sihaydata->fields[$rs_camposevo->fields["fie_name"]]);
		   //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		   $cuadro_check='';
		   $cuadro_check.='<table border="0" cellpadding="0" cellspacing="0">';
		   $sqlchek="select distinct ".$rs_camposevo->fields["fie_datadb"]." from ".$rs_camposevo->fields["fie_tabledb"]." ".$rs_camposevo->fields["fie_sqlorder"];
				 $resulcheck = $DB_gogess->executec($sqlchek,array());  
				 $campos_d=explode(",",$rs_camposevo->fields["fie_datadb"]);
				 
				  if ($resulcheck)
				  {
				  $icheck=1;
				  while(!$resulcheck->EOF) 
						{   
						  if (@$valorfievalue[$icheck-1])
						  {
						  
						  $cuadro_check.='<tr>
								<td><img src="../images/checklab.png" width="10" height="10" /></td>
								<td style="font-size:6px" >'.$resulcheck->fields[$campos_d[1]]." ".@$resulcheck->fields[$campos_d[2]].'</td>
							  </tr>';
						  
						  }
						  else
						  {					

						  //$cuadro_check.='<tr>
						//		<td><img src="../images/checklabblanco.png" width="10" height="10" /></td>
							//	<td style="font-size:6px"  >'.$resulcheck->fields[$campos_d[1]]." ".@$resulcheck->fields[$campos_d[2]].'</td>
							//  </tr>';
						  
						  }					  

						  $icheck++;
						  $resulcheck->MoveNext();
						}
				  }	   
		   
		   
		   $cuadro_check.='</table>';
		   
		
		   //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				}
				break;
			case 'checkbox':
				{
				   
					if($rs_sihaydata->fields[$rs_camposevo->fields["fie_name"]])
					{
					 $lab_datos='<img src="../images/checklab.png" width="9" height="9" align="absmiddle"  />';
					}
					else
					{
					 $lab_datos='';					
					}
				
				}
				break;
			
			case 'txtgraficoarch':
				{					
					 if($rs_sihaydata->fields[$rs_camposevo->fields["fie_name"]])
					 {
					 $lab_datos='<img src="../../archivo/'.$rs_sihaydata->fields[$rs_camposevo->fields["fie_name"]].'" width="180"  align="absmiddle"  />';				
				     }
					 else
					 {
					 $lab_datos='';
					 }
				}
				break;	
			
			case 'campogrid':
				{					
					 
					 $lab_datos='';
					 
					 $sub_tabla=$rs_camposevo->fields["fie_tablasubgrid"];
                     $campo_id=$rs_camposevo->fields["fie_tablasubcampoid"];
                     $campo_enlace='';
                     $campo_enlace=$rs_camposevo->fields["fie_campoenlacesub"];
                     $campo_fecharegistro='';
                     $campo_fecharegistro=$rs_camposevo->fields["fie_campofecharegistro"];
                     $fie_tituloscamposgrid=array();
                     $fie_tituloscamposgrid=explode(",",$rs_camposevo->fields["fie_tituloscamposgrid"]);
					 $fie_camposgridselect=array();
                     $fie_camposgridselect=explode(",",$rs_camposevo->fields["fie_camposgridselect"]);
					 
					 $lab_datos.='<table style="width:100%" border="1" cellpadding="0" cellspacing="0" >';
                     $lab_datos.='<tr>';
 
					 for($i=0;$i<count($fie_tituloscamposgrid);$i++)
					 {
					   $lab_datos.='<td>'.utf8_encode($fie_tituloscamposgrid[$i]).'</td>';
					 }

                    $lab_datos.='</tr>';
					$cuenta=0;
					
					
					$enlace_data=$rs_sihaydata->fields[$campo_enlace];					
					
                    $lista_servicios="select * from ".$sub_tabla." where ".$campo_enlace."='".$enlace_data."'";
					//echo $lista_servicios;
					 $rs_data = $DB_gogess->executec($lista_servicios,array());
					 if($rs_data)
					 {
						  while (!$rs_data->EOF) {	
							$cuenta++;
							$lab_datos.='<tr>';							
							for($i=0;$i<count($fie_camposgridselect);$i++)
	                        {
							        //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
									 $ver_campos="select * from gogess_gridfield where gridfield_nameid='".$fie_camposgridselect[$i]."x' and fie_id='".$fie_id."'"; 
									 $rs_campd = $DB_gogess->executec($ver_campos,array());
									 if($rs_campd->fields["gridfield_tablecmb"])
									 {
									 $dato_valor='';
									 $dataval=array();
									 $dataval=explode(",",$rs_campd->fields["gridfield_camposcmb"]);
									 
									 $busca_valor="select ".$rs_campd->fields["gridfield_camposcmb"]." from ".$rs_campd->fields["gridfield_tablecmb"]." where ".$fie_camposgridselect[$i]."='".$rs_data->fields[$fie_camposgridselect[$i]]."';";
									 $rs_bval = $DB_gogess->executec($busca_valor,array());
									 $dato_valor=$rs_bval->fields[$dataval[1]];									 
									 $lab_datos.='<td>'.$dato_valor.'</td>';									 
									 }
									 else
									 {
										if($fie_camposgridselect[$i]=='usua_id')
												  {
													 $usdata='';
													 $usdata=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido","where usua_id=",$rs_data->fields[$fie_camposgridselect[$i]],$DB_gogess);
													 $lab_datos.='<td><b>'.$usdata.'</b></td>';
												  }
												  else
												  {			
													 if($fie_camposgridselect[$i]=='gridinfoissfa_texto')
													 {
														$lab_datos.='<td>'.substr(strip_tags($rs_data->fields[$fie_camposgridselect[$i]]), 0, 500).'...'.'</td>';
													 }
													 else
													 {
														$lab_datos.='<td>'.$rs_data->fields[$fie_camposgridselect[$i]].'</td>';
													 
													 }
												  }	 
									 
									 }
                                    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
						  }
						
					  $lab_datos.='</tr>';		  
					 $rs_data->MoveNext();	   
					  }
				  }	  			
                  
				 $lab_datos.='</table>';         

					 
				}
				break;		
				
				
			
			default:
			  {
				//===================================
				if($rs_camposevo->fields["fie_value"]=='replace')
				{		
				  $lab_datos=$objformulario->replace_cmb($rs_camposevo->fields["fie_tabledb"],$rs_camposevo->fields["fie_datadb"],$rs_camposevo->fields["fie_sql"],$rs_sihaydata->fields[$rs_camposevo->fields["fie_name"]],$DB_gogess);		  
				}
				else
				{		
				   $lab_datos=$rs_sihaydata->fields[$rs_camposevo->fields["fie_name"]];
				}
				//===================================
		
			  }
		}
		

		
		
        //@$array_grupo[$rs_camposevo->fields["fie_group"]]=str_replace("-".$rs_camposevo->fields["fie_name"]."-",$lab_datos,$lee_plantilla);
		if($rs_camposevo->fields["fie_tactive"]==0)
		{
		  $rs_camposevo->fields["fie_title"]='';
		}
		
		
		switch ($rs_camposevo->fields["fie_type"]) {
				case 'checkboxmulpeke':
					{
					  @$array_grupo[$rs_camposevo->fields["fie_group"]].= $cuadro_check;
					}
					break;
				case 'checkbox':
					{
					@$array_grupo[$rs_camposevo->fields["fie_group"]].='<b>'.$rs_camposevo->fields["fie_title"].'</b> '.'<span id="despliegue_'.$rs_camposevo->fields["fie_name"].'">'.$lab_datos.'</span><br>';
					}
					break;
				case 'txtgraficoarch':
					{
					@$array_grupo[$rs_camposevo->fields["fie_group"]].='<b>'.$rs_camposevo->fields["fie_title"].'</b> '.'<span id="despliegue_'.$rs_camposevo->fields["fie_name"].'">'.$lab_datos.'</span><br>';
					}
					break;	
					
				case 'campogrid':
					{
					 @$array_grupo[$rs_camposevo->fields["fie_group"]].=$lab_datos;
					}
					break;						
				default:
				   {
				    @$array_grupo[$rs_camposevo->fields["fie_group"]].='<b>'.$rs_camposevo->fields["fie_title"].'</b> '.'<span id="despliegue_'.$rs_camposevo->fields["fie_name"].'">'.$lab_datos.'</span><br>';
				   }
			}


	
		
		$rs_camposevo->MoveNext();
		}
	}	
	
 
// print_r($array_grupo);
 
for($iv=1;$iv<=100;$iv++)
					{ 
					  if(@$array_grupo[$iv])
					  {
					     
					     @$lee_plantilla=str_replace("-g".$iv."-",$array_grupo[$iv],$lee_plantilla);
					   } 
					   else
					   {
					     @$lee_plantilla=str_replace("-g".$iv."-",'',$lee_plantilla);
					   }
					}
	
 //===========================================================
 
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