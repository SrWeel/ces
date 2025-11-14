<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
include("cfg.php");

for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
$objformulario= new  ValidacionesFormulario();
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;

$arreglo_data=array();

function agregar_dv($_rol) {
    /* Remuevo los ceros del comienzo. */
    while($_rol[0] == "0") {
        $_rol = substr($_rol, 1);
    }
    $factor = 2;
    $suma = 0;
    for($i = strlen($_rol) - 1; $i >= 0; $i--) {
        $suma += $factor * $_rol[$i];
        $factor = $factor % 7 == 0 ? 2 : $factor + 1;
    }
    $dv = 11 - $suma % 11;
    /* Por alguna razón me daba que 11 % 11 = 11. Esto lo resuelve. */
    $dv = $dv == 11 ? 0 : ($dv == 10 ? "1" : $dv);
    return $dv;
}

$lista_facturado="select * from app_facturatemporal where facttmp_codetemp='".$_POST["facttmp_codetempp"]."'";
$enlace_temp=$_POST["facttmp_codetempp"];
$rs_facturado = $DB_gogess->executec($lista_facturado,array());
  if($rs_facturado)
  {
  
  $doccab_rucempresa=$objformulario->replace_cmb("app_empresa","emp_id,emp_ruc","where emp_id=",$empresa_id,$DB_gogess);
  $valoralet=mt_rand(1,500);
  $aletorioid='01'.$cedula_cajero.$doccab_rucempresa.date("Ymdhis").$valoralet;
 
  $arreglo_data["doccab_id"]=$aletorioid;
  $arreglo_data["emp_id"]=$empresa_id;
  $arreglo_data["estaf_id"]=1;
  $arreglo_data["ambi_valor"]=1;
  $arreglo_data["emis_valor"]=1;
  $arreglo_data["tipocmp_codigo"]='01';
  $arreglo_data["doccab_ndocumento"]='-documento-';
  $arreglo_data["doccab_clavedeaccesos"]='';
  $arreglo_data["doccab_rucempresa"]=$doccab_rucempresa;
  //datos cliente
  $cliente_b="select * from app_cliente where clie_id=".$rs_facturado->fields["clie_id"];
  $rs_cliente = $DB_gogess->executec($cliente_b,array());
  
  //datos cliente
  
  $arreglo_data["doccab_rucci_cliente"]=$rs_cliente->fields["clie_rucci"];
  $arreglo_data["doccab_nombrerazon_cliente"]=$rs_cliente->fields["clie_nombre"];
  $arreglo_data["doccab_direccion_cliente"]=$rs_cliente->fields["clie_direccion"];
  $arreglo_data["doccab_telefono_cliente"]=$rs_cliente->fields["clie_telefono"];
  $arreglo_data["doccab_email_cliente"]=$rs_cliente->fields["clie_email"];
  $arreglo_data["doccab_fechaemision_cliente"]=date("Y-m-d");
  $arreglo_data["doccab_subtotaliva"]=0;
  $arreglo_data["doccab_subtotalsiniva"]=0;
  $arreglo_data["doccab_subtnoobjetoi"]=0;
  $arreglo_data["doccab_subtexentoiva"]=0;
  $arreglo_data["doccab_iva"]=0;
  $arreglo_data["doccab_descuento"]=0;
  $arreglo_data["doccab_propina"]=0;
  $arreglo_data["doccab_ice"]=0;
  $arreglo_data["doccab_total"]=0;
  $arreglo_data["doccab_xml"]='';
  $arreglo_data["doccab_xmlfirmado"]='';
  $arreglo_data["doccab_firmado"]='';
  $arreglo_data["doccab_estadosri"]='';
  $arreglo_data["doccab_motivodev"]='';
  $arreglo_data["doccab_nautorizacion"]='';
  $arreglo_data["doccab_fechaaut"]='';
  $arreglo_data["doccab_enviomail"]='';
  $arreglo_data["doccab_enviomailfecha"]='';
  $arreglo_data["doccab_publicado"]='';
  $arreglo_data["doccab_fechapublicado"]='';
  $arreglo_data["usua_id"]=30;
  
  
  $cantidad_nueva=0;
  $cantidad_actual=0;
  $icuente=0;
  //detalle
  
  $lista_detalle="select produ_id,count(produ_id) as cantidad from app_detalletemporal where facttmp_codetemp='".$_POST["facttmp_codetempp"]."' group by produ_id";
  $rs_detalle = $DB_gogess->executec($lista_detalle,array());
  if($rs_detalle)
   {
    while (!$rs_detalle->EOF) {	
	$icuente++;
	//inserta
	$busca_serial="select produ_codigoserial from app_producto where produ_id=".$rs_detalle->fields["produ_id"];
    $rs_serial = $DB_gogess->executec($busca_serial,array());
	
	
	$cantidad_nueva=$rs_detalle->fields["cantidad"];
	
	$busca_dataproducto="select '".$aletorioid."' as doccab_id,produ_codigoserial,produ_nombre,'".$cantidad_nueva."' as docdet_cantidad,produ_preciogen,app_producto.impu_codigo,app_producto.tari_codigo,tari_valor,(((".$cantidad_nueva."*produ_preciogen)*tari_valor)/100) as docdet_valorimpuesto,(".$cantidad_nueva."*produ_preciogen) as docdet_total,".$usua_id." as usua_id from app_producto inner join app_tarifa on app_producto.tari_codigo=app_tarifa.tari_codigo where  produ_id=".$rs_detalle->fields["produ_id"];
    $rs_dataproducto = $DB_gogess->executec($busca_dataproducto,array());
    $inserta_producto="insert into app_documentodetalle (doccab_id,docdet_codprincipal,docdet_descripcion,docdet_cantidad,docdet_preciou,impu_codigo,tari_codigo,docdet_porcentaje,docdet_valorimpuesto,docdet_total,usua_id) values ('".$rs_dataproducto->fields["doccab_id"]."','".$rs_dataproducto->fields["produ_codigoserial"]."','".$rs_dataproducto->fields["produ_nombre"]."','".$rs_dataproducto->fields["docdet_cantidad"]."','".$rs_dataproducto->fields["produ_preciogen"]."','".$rs_dataproducto->fields["impu_codigo"]."','".$rs_dataproducto->fields["tari_codigo"]."','".$rs_dataproducto->fields["tari_valor"]."','".$rs_dataproducto->fields["docdet_valorimpuesto"]."','".$rs_dataproducto->fields["docdet_total"]."','".$rs_dataproducto->fields["usua_id"]."')";
    $rs_insdetalle = $DB_gogess->executec($inserta_producto,array());

	
	//inserta
	
	
	
	
	$rs_detalle->MoveNext();	
	}
  }
  
  $arreglo_data["doccab_ndet"]=$icuente;
  
  $objtableform= new templateform();
  $objtableform->select_templateform("app_documentocabecera",$DB_gogess);
  $objformulario->essri=$objtableform->tab_sri;
  $objformulario->camposri=$objtableform->tab_camposecsri;
  $objformulario->formulario_guardar("app_documentocabecera",$arreglo_data,@$typesql,@$listab,@$campo,@$obp,$DB_gogess);
  
  
  
   
   //clave de acceso
$busca_datosfactura="select * from app_documentocabecera where doccab_id='".$aletorioid."'";   
$rs_acceso = $DB_gogess->executec($busca_datosfactura,array());
 
$fechaemi=$rs_acceso->fields["doccab_fechaemision_cliente"];
$tipocx=$rs_acceso->fields["tipocmp_codigo"];
$idempval=$rs_acceso->fields["emp_id"];

$faccab_nfactura=$rs_acceso->fields["doccab_ndocumento"];
$banderaencontro=$rs_acceso->fields["doccab_id"];


$fechahora_clv=explode(" ",$fechaemi);
$solofecha_clv=explode("-",$fechahora_clv[0]);

$rucempresa=$objformulario->replace_cmb("app_empresa","emp_id,emp_ruc","where emp_id=",$empresa_id,$DB_gogess);	

$ambiente_valorc=$objformulario->replace_cmb("app_empdocumento","emp_id,ambi_valor","where tipocmp_codigo='".$tipocx."' and emp_id=",$empresa_id,$DB_gogess);
$emision_valorc=$objformulario->replace_cmb("app_empdocumento","emp_id,tipoemi_codigo","where tipocmp_codigo='".$tipocx."' and emp_id=",$empresa_id,$DB_gogess);

$claveacc=$solofecha_clv[2].$solofecha_clv[1].$solofecha_clv[0].$tipocx.$rucempresa.$ambiente_valorc.str_replace("-","",$faccab_nfactura);	

//$numocho_dig=randomString(8);	

//---codigo
			//$codigoclv8=$sacacamposc[12]*1;
$numocho_dig= substr($banderaencontro, -8); 
	
//---codigo

$numerogenerado=$claveacc.$numocho_dig.$emision_valorc;
$numerovalidador=agregar_dv($numerogenerado);
$clavegenerada=$claveacc.$numocho_dig.$emision_valorc.$numerovalidador;

$actualiza_data="update app_documentocabecera set doccab_clavedeaccesos='".$clavegenerada."' where doccab_id='".$banderaencontro."'";
$rs_acceso = $DB_gogess->executec($actualiza_data,array());
   
   //clave de acceso
    
	
$cierra_facturado="update app_facturatemporal set facttmp_estado=2 where facttmp_codetemp='".$enlace_temp."'";
$rs_cierra = $DB_gogess->executec($cierra_facturado,array());


	
echo "<center><b>Ya fue enviado a caja para facturaci&oacute;n...</b></center>";	


	
  }	


?>