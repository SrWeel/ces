<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
ini_set('memory_limit','256M');
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{

$valor_busca=$_GET["idsec"];
if($valor_busca)
{

$cuadro_valor=array();
$director='../';
include_once("../cfg/clases.php");
include_once("../cfg/declaracion.php");
require_once('tcpdf_include.php');
include_once(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();


$url="plantillas/informe_integral.php";
$lee_plantilla=$objvarios->leer_contenido_completo($url);	

$logo='<div align="center"><img src="../images/informe_logo.jpg" width="161" height="70" /></div>';
$lee_plantilla=str_replace("-logo-",$logo,$lee_plantilla);

$nciudad='';
$nciudad=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id =",$_SESSION['ces1313777_centro_id'],$DB_gogess);


//datos personales

$busca_informe="select * from dns_atencionevaluacion inner join dns_atencion on dns_atencionevaluacion.atenc_enlace=dns_atencion.atenc_enlace where eteneva_id='".$valor_busca."'";
$rs_binforme = $DB_gogess->executec($busca_informe,array());

$fecha_ciudad=$nciudad.", ".$objvarios->fechaCastellano($rs_binforme->fields["eteneva_fechaentrega"]);
$lee_plantilla=str_replace("-fecha-",$fecha_ciudad,$lee_plantilla);

$busca_cliente="select * from app_cliente where clie_id=".$rs_binforme->fields["clie_id"];
$rs_cliente = $DB_gogess->executec($busca_cliente,array());

$lista_campos="select * from gogess_sisfield where tab_name='app_cliente' and 	fie_guarda=1";
$rs_campos = $DB_gogess->executec($lista_campos,array());
			 if ($rs_campos)
			   {
			      while (!$rs_campos->EOF) {
				  
				    $lee_plantilla=str_replace("-".$rs_campos->fields["fie_name"]."-",$rs_cliente->fields[$rs_campos->fields["fie_name"]],$lee_plantilla);
				  
				   $rs_campos->MoveNext();	
				  }
			  }	  


$lee_plantilla=str_replace("-atenc_hc-",$rs_binforme->fields["atenc_hc"],$lee_plantilla);
//datos personales

//fecha y edad
$busca_fechaedad="select * from faesa_asigahorario where eteneva_id=".$valor_busca;
$rs_fechaedad = $DB_gogess->executec($busca_fechaedad,array());
$edad_texto='';
$edad_actualalatencion=array();
$edad_actualalatencion=$objvarios->calcular_edad($rs_cliente->fields["clie_fechanacimiento"],$rs_fechaedad->fields["asighor_fecha"]);
$edad_texto=$edad_actualalatencion["anio"]." a&ntilde;os ".$edad_actualalatencion["mes"]." meses";
$lee_plantilla=str_replace("-edad-",$edad_texto,$lee_plantilla);
$lee_plantilla=str_replace("-fechaevaluacion-",$rs_fechaedad->fields["asighor_fecha"],$lee_plantilla);
//fecha y edad

//datos anemesis clinica

$busca_datosane="select * from faesa_anamnesisclinica where atenc_id=".$rs_binforme->fields["atenc_id"];
$rs_datosane = $DB_gogess->executec($busca_datosane,array());

$tomadatos_persona='';

if($rs_datosane)
{
$lee_plantilla=str_replace("-fuente-",$rs_datosane->fields["anamn_fuentededatos"],$lee_plantilla);

$tomadatos_persona=$rs_datosane->fields["usua_id"];
}
//datos anemesis clinica

//motivo de consulta
if(@$rs_datosane->fields["anamn_entrevistaclinica"])
{

$lee_plantilla=str_replace("-motivo-",$rs_datosane->fields["anamn_entrevistaclinica"],$lee_plantilla);
}
else
{
$lee_plantilla=str_replace("-motivo-",$rs_binforme->fields["atenc_observacion"],$lee_plantilla);
}
//motivo de consulta

// reactivos
$busca_datainfomer="select * from faesa_reporte where faereport_seccion='".$_GET["seccion"]."'";
$rs_datainfo = $DB_gogess->executec($busca_datainfomer,array());

$lista_tbl=array();
if($rs_datainfo)
{
$lista_tbl=explode(",",$rs_datainfo->fields["faereport_tabla"]);
}


$valor_busca=$_GET["idsec"];
$contenido_informes='';


$grupo_blck=array();
$grupo_blck["faesa_psicologia"]["grupo"]=16;
$grupo_blck["faesa_pedagogia"]["grupo"]=10;
$grupo_blck["faesa_lenguaje"]["grupo"]=10;
$grupo_blck["faesa_terapiafisica"]["grupo"]=9;
$grupo_blck["faesa_ocupacional"]["grupo"]=9;

$grupo_blck["faesa_psicologia"]["campodiagnostico"]='psic_impresiondiagnostica';
$grupo_blck["faesa_pedagogia"]["campodiagnostico"]='pedago_impresiondiagnostica';
$grupo_blck["faesa_lenguaje"]["campodiagnostico"]='lenguaj_impresiondiagnostica';
$grupo_blck["faesa_terapiafisica"]["campodiagnostico"]='terfisic_impresiondiagnostica';
$grupo_blck["faesa_ocupacional"]["campodiagnostico"]='ocupacio_impresiondiagnostica';


$grupo_blck["faesa_psicologia"]["terapeutica"]='psic_recomterapeutica';
$grupo_blck["faesa_pedagogia"]["terapeutica"]='pedago_recomterapeutica';
$grupo_blck["faesa_lenguaje"]["terapeutica"]='lenguaj_recomterapeutica';
$grupo_blck["faesa_terapiafisica"]["terapeutica"]='terfisic_recomterapeutica';
$grupo_blck["faesa_ocupacional"]["terapeutica"]='ocupacio_recomterapeutica';


$grupo_blck["faesa_psicologia"]["recomfamiliares"]='psic_recomfamiliares';
$grupo_blck["faesa_pedagogia"]["recomfamiliares"]='pedago_recomfamiliares';
$grupo_blck["faesa_lenguaje"]["recomfamiliares"]='lenguaj_recomfamiliares';
$grupo_blck["faesa_terapiafisica"]["recomfamiliares"]='terfisic_recomfamiliares';
$grupo_blck["faesa_ocupacional"]["recomfamiliares"]='ocupacio_recomfamiliares';


$grupo_blck["faesa_psicologia"]["recomescolares"]='psic_recomescolares';
$grupo_blck["faesa_pedagogia"]["recomescolares"]='pedago_recomescolares';
$grupo_blck["faesa_lenguaje"]["recomescolares"]='lenguaj_recomescolares';
$grupo_blck["faesa_terapiafisica"]["recomescolares"]='terfisic_recomescolares';
$grupo_blck["faesa_ocupacional"]["recomescolares"]='ocupacio_recomescolares';

$grupo_blck["faesa_psicologia"]["recommultidiciplinarias"]='psic_recommultidiciplinarias';
$grupo_blck["faesa_pedagogia"]["recommultidiciplinarias"]='pedago_recommultidiciplinarias';
$grupo_blck["faesa_lenguaje"]["recommultidiciplinarias"]='lenguaj_recommultidiciplinarias';
$grupo_blck["faesa_terapiafisica"]["recommultidiciplinarias"]='terfisic_recommultidiciplinarias';
$grupo_blck["faesa_ocupacional"]["recommultidiciplinarias"]='ocupacio_recommultidiciplinarias';


$grupo_blck["faesa_psicologia"]["medico"]='usua_id';
$grupo_blck["faesa_pedagogia"]["medico"]='usua_id';
$grupo_blck["faesa_lenguaje"]["medico"]='usua_id';
$grupo_blck["faesa_terapiafisica"]["medico"]='usua_id';
$grupo_blck["faesa_ocupacional"]["medico"]='usua_id';

$grupo_blck["faesa_psicologia"]["medico2"]='usua2_id';
$grupo_blck["faesa_pedagogia"]["medico2"]='usua2_id';
$grupo_blck["faesa_lenguaje"]["medico2"]='usua2_id';
$grupo_blck["faesa_terapiafisica"]["medico2"]='usua2_id';
$grupo_blck["faesa_ocupacional"]["medico2"]='usua2_id';



$datos_diagnosticos='';
$datos_terapeutica='';
$datos_recomfamiliares='';
$datos_recomescolares='';
$datos_recommultidiciplinarias='';
$usuario_lista='';
$usuario_lista2='';


//-------------------------------------------------
for($i=0;$i<count($lista_tbl);$i++)
{

$busca_dtabla="select * from gogess_sistable where tab_name='".$lista_tbl[$i]."'";
$rs_dtabla = $DB_gogess->executec($busca_dtabla,array());
$table=$rs_dtabla->fields["tab_name"];  
$campo_primariodata=$rs_dtabla->fields["tab_campoprimario"];  
$busca_sihaydata="select * from ".$table." where ".$rs_datainfo->fields["faereport_campoenlace"]."='".$valor_busca."'";
$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array());

$psic_id_valor=0;
$psic_id_valor=@$rs_sihaydata->fields[$campo_primariodata];

if($psic_id_valor)
{
   //echo $rs_sihaydata->fields[$campo_primariodata]."<br>";
   
	
	 $contenido_informes.=$objvarios->obtiene_datos($director,$lista_tbldata,$objformulario,$lista_tbl[$i],$rs_datainfo->fields["faereport_campoenlace"],$psic_id_valor,$rs_sihaydata,0,$DB_gogess);
	 
	 //$datos_diagnosticos=$rs_sihaydata->fields[$grupo_blck[$lista_tbl[$i]]["campodiagnostico"]]."<br>";
	 //$datos_terapeutica=$rs_sihaydata->fields[$grupo_blck[$lista_tbl[$i]]["terapeutica"]]."<br>";
	 //$datos_recomfamiliares=$rs_sihaydata->fields[$grupo_blck[$lista_tbl[$i]]["recomfamiliares"]]."<br>";
	 //$datos_recomescolares=$rs_sihaydata->fields[$grupo_blck[$lista_tbl[$i]]["recomescolares"]]."<br>";
	// $datos_recommultidiciplinarias=$rs_sihaydata->fields[$grupo_blck[$lista_tbl[$i]]["recommultidiciplinarias"]]."<br>";
	 $usuario_lista.=$rs_sihaydata->fields[$grupo_blck[$lista_tbl[$i]]["medico"]].",";
	 $usuario_lista2.=@$rs_sihaydata->fields[$grupo_blck[$lista_tbl[$i]]["medico2"]].","; 
	 
     

}



}

$lee_plantilla=str_replace("-resultados-",$contenido_informes,$lee_plantilla);
//-------------------------------------------------


$lista_medico=array();
$lista_medico=explode(",",$usuario_lista.$usuario_lista2.$tomadatos_persona);


$lista_medico = array_values(array_unique($lista_medico));



$obtiene_nombres=array();
$cuantadata=0;
for($id=0;$id<count($lista_medico);$id++)
{
        $busca_cliente="select * from app_usuario inner join app_jobtitle on app_usuario.jobt_id=app_jobtitle.jobt_id where usua_id='".$lista_medico[$id]."'";
        $rs_bcliente = $DB_gogess->executec($busca_cliente,array());
		
		if($rs_bcliente->fields["usua_nombre"]!='' and $rs_bcliente->fields["usua_codigo"]!='')
		{
		$obtiene_nombres[$cuantadata]="<b>".$rs_bcliente->fields["usua_siglastitulo"]." ".$rs_bcliente->fields["usua_nombre"]." ".$rs_bcliente->fields["usua_apellido"]."</b><br>".$rs_bcliente->fields["jobt_name"]."<br>COD: ".$rs_bcliente->fields["usua_codigo"]."<br>MSP: ".$rs_bcliente->fields["usua_msp"]."<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
		$cuantadata++;
		}

}

//print_r($obtiene_nombres);
$responsables_cuadro='';
$responsables_cuadro=$objvarios->desplegarencuadrosv2($obtiene_nombres,0,15,0,2);

// recommultidiciplinarias

$pie_responsable='';
$pie_responsable.='';
if($_GET["dhoja"]==1)
{
$pie_responsable.='<p class="saltodepagina" />';
}
$pie_responsable.=utf8_encode("<p><strong>V. RESPONSABLES </strong> </p><p>&nbsp;</p><div align='center'>".$responsables_cuadro."</div>");


$lee_plantilla=str_replace("-responsables-",$pie_responsable,$lee_plantilla);
//$comprobantepdf='';
//$comprobantepdf=$lee_plantilla;

//echo utf8_encode($contenido_informes);
//$logo='<div align="center"><img src="../images/informe_logo.jpg" width="161" height="70" />kk</div>';
//$lee_plantilla=str_replace("-logo-",$logo,$lee_plantilla);
echo utf8_encode($lee_plantilla);


//$pdf->writeHTML(utf8_encode("<p><strong>V. RESPONSABLES </strong> </p><p></p><div align='center'>".$responsables_cuadro."</div>"), true, false, false, false, '');


}
else
{
 echo '<div style="font-family:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000">No hay datos en reactivos para este informe</div>';

}

}
else
{
 echo '<div style="font-family:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000">Sesi&oacute;n de usuario ha terminado porfavor de clic en F5 para continuar...</div>';
 
 ?>
<script type="text/javascript">
<!--
    location.href = "../index.php";
 //  End -->
</script>
 <?php
}	

?>