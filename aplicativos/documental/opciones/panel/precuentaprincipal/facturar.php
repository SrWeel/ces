<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if(@$_SESSION['ces1313777_sessid_inicio'])
{
//Llamando objetos
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();




function numero_secuencial($camposec,$table,$DB_gogess)
{

   $obtiene_estb_punto="select estab_codigo,pemision_num,pemision_inicia from efacsistema_puntoemision inner join efacsistema_establecimiento on efacsistema_puntoemision.estab_id=efacsistema_establecimiento.estab_id where pemision_id=".$_SESSION['ces1313777_pemision_id'];

	 $rs_estbpunto= $DB_gogess->executec($obtiene_estb_punto,array());

	    $banderaexistelote=1;
		$loteinicial=$rs_estbpunto->fields["pemision_inicia"];
		$lotefinal= 1000000000000000;	
		$idlotex= 1;
	 if($banderaexistelote==1)
	 {

	   //$buscaultimonum="select 	".$camposec." from ".$table." where doccab_ndocumento like '".$rs_estbpunto->fields["estab_codigo"]."-%' order by ".$camposec." desc limit 1";
	   $buscaultimonum="select 	".$camposec." from ".$table." where doccab_ndocumento like '".$rs_estbpunto->fields["estab_codigo"]."-".$rs_estbpunto->fields["pemision_num"]."-%' order by ".$camposec." desc limit 1"; 
	   
/*$file = fopen("archivoinsert".date("Y-m-d").".txt", "w");
fwrite($file, $buscaultimonum . PHP_EOL);
fclose($file);*/
	   $rs_disponible= $DB_gogess->executec($buscaultimonum,array());
	   $banderanumeroinicial=0;
				 if($rs_disponible)
				 {
					  while (!$rs_disponible->EOF) {
					  $gastadofac=$rs_disponible->fields[$camposec];
  			          $banderanumeroinicial=1;
					  $rs_disponible->MoveNext();
					  }
				}

				   if($banderanumeroinicial==1)
				   {
			  //verifica si esta en rango
							  $numerodesarmado=explode("-",$gastadofac);
							  $mumeroactual=($numerodesarmado[2]*1)+1;
							   //verifica si esta en rango
							   $nuevonumero_sig=$rs_estbpunto->fields["estab_codigo"]."-".$numerodesarmado[1]."-".str_pad($mumeroactual,9, "0", STR_PAD_LEFT);

				   }
				   else
				   {
						 $nuevonumero_sig=$rs_estbpunto->fields["estab_codigo"]."-".$rs_estbpunto->fields["pemision_num"]."-".str_pad($loteinicial,9, "0", STR_PAD_LEFT);
				   }   



	 }
	 else
	 {	
	  // echo "Alerta Lote no asignado al sistema...";
	   $nuevonumero_sig=2;
	 } 

   return $nuevonumero_sig;
  // echo $lista_datoslote;
}


$precu_id=$_POST["precu_id"];

$valorunico=uniqid().$_SESSION['ces1313777_sessid_inicio'].$_POST["precu_id"].date("YmdHis");

$secuan_data='';
$camposec='doccab_ndocumento'; 
$table='beko_documentocabecera';
$secuan_data=numero_secuencial($camposec,$table,$DB_gogess);

//datos empresa
$lista_emp="select * from app_empresa where emp_id='1'";
$rs_emp = $DB_gogess->executec($lista_emp,array());
//datos empresa

//datos del cliente
$predata="select * from dns_precuenta where precu_id='".$precu_id."'";
$rs_predata = $DB_gogess->executec($predata,array());


$lista_cli="select * from app_cliente inner join cesdb_arcombos.faesa_tipoci on app_cliente.tipoci_id=cesdb_arcombos.faesa_tipoci.tipoci_id where clie_id='".$rs_predata->fields["clie_id"]."'";
$rs_cli = $DB_gogess->executec($lista_cli,array());
//datos del cliente



$doccab_id=$valorunico;
$emp_id=1;
$estaf_id=1;
$ambi_valor=1;
$emis_valor=1;
$tipocmp_codigo='01';
$doccab_ndocumento=$secuan_data;
$doccab_clavedeaccesos='';
$doccab_rucempresa=$rs_emp->fields["emp_ruc"];
$doccab_rucci_cliente=$rs_cli->fields["clie_rucci"];
$tipoident_codigo=$rs_cli->fields["tipoci_codigo"];
$doccab_nombrerazon_cliente=$rs_cli->fields["clie_nombre"];
$doccab_apellidorazon_cliente=$rs_cli->fields["clie_apellido"];
$doccab_direccion_cliente=$rs_cli->fields["clie_direccion"];
$doccab_telefono_cliente=$rs_cli->fields["clie_celular"];
$doccab_email_cliente=$rs_cli->fields["clie_email"];
$doccab_fechaemision_cliente=date("Y-m-d H:i:s");
$doccab_subtotaliva='';
$doccab_subtotalsiniva='';
$doccab_subtnoobjetoi='';
$doccab_subtexentoiva='';
$doccab_iva='';
$doccab_descuento='';
$doccab_propina='';
$doccab_ice='';
$doccab_total='';
$doccab_xml='';
$doccab_xmlfirmado='';
$doccab_firmado='';
$doccab_estadosri='';
$doccab_motivodev='';
$doccab_nautorizacion='';
$doccab_fechaaut='';
$doccab_enviomail='';
$doccab_enviomailfecha='';
$doccab_publicado='';
$doccab_fechapublicado='';
$doccab_ndet='';
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$doccab_anulado='';
$doccab_fechaanulado='';
$doccab_motivoanulado='';
$doccab_usuarioanula='';
$tipase_id=10;
$tippo_id=3;
$conve_id=0;
$doccab_autorizacion='';
$centro_id=1;
$doccab_impresion='';
$doccab_identificacionpaciente=$rs_cli->fields["clie_rucci"];
$doccab_pagacon='';
$doccab_cambio='';
$doccab_fpago='01';



$ins_cabecera="INSERT INTO beko_documentocabecera (doccab_id, emp_id, estaf_id, ambi_valor, emis_valor, tipocmp_codigo, doccab_ndocumento, doccab_clavedeaccesos, doccab_rucempresa, doccab_rucci_cliente, tipoident_codigo, doccab_nombrerazon_cliente, doccab_apellidorazon_cliente, doccab_direccion_cliente, doccab_telefono_cliente, doccab_email_cliente, doccab_fechaemision_cliente, doccab_subtotaliva, doccab_subtotalsiniva, doccab_subtnoobjetoi, doccab_subtexentoiva, doccab_iva, doccab_descuento, doccab_propina, doccab_ice, doccab_total, doccab_xml, doccab_xmlfirmado, doccab_firmado, doccab_estadosri, doccab_motivodev, doccab_nautorizacion, doccab_fechaaut, doccab_enviomail, doccab_enviomailfecha, doccab_publicado, doccab_fechapublicado, doccab_ndet, usua_id, doccab_anulado, doccab_fechaanulado, doccab_motivoanulado, doccab_usuarioanula, tipase_id, tippo_id, conve_id, doccab_autorizacion, centro_id, doccab_impresion, doccab_identificacionpaciente, doccab_pagacon, doccab_cambio, doccab_fpago) VALUES
('".$doccab_id."','".$emp_id."','".$estaf_id."','".$ambi_valor."','".$emis_valor."','".$tipocmp_codigo."','".$doccab_ndocumento."','".$doccab_clavedeaccesos."','".$doccab_rucempresa."','".$doccab_rucci_cliente."','".$tipoident_codigo."','".$doccab_nombrerazon_cliente."','".$doccab_apellidorazon_cliente."','".$doccab_direccion_cliente."','".$doccab_telefono_cliente."','".$doccab_email_cliente."','".$doccab_fechaemision_cliente."','".$doccab_subtotaliva."','".$doccab_subtotalsiniva."','".$doccab_subtnoobjetoi."','".$doccab_subtexentoiva."','".$doccab_iva."','".$doccab_descuento."','".$doccab_propina."','".$doccab_ice."','".$doccab_total."','".$doccab_xml."','".$doccab_xmlfirmado."','".$doccab_firmado."','".$doccab_estadosri."','".$doccab_motivodev."','".$doccab_nautorizacion."','".$doccab_fechaaut."','".$doccab_enviomail."','".$doccab_enviomailfecha."','".$doccab_publicado."','".$doccab_fechapublicado."','".$doccab_ndet."','".$usua_id."','".$doccab_anulado."','".$doccab_fechaanulado."','".$doccab_motivoanulado."','".$doccab_usuarioanula."','".$tipase_id."','".$tippo_id."','".$conve_id."','".$doccab_autorizacion."','".$centro_id."','".$doccab_impresion."','".$doccab_identificacionpaciente."','".$doccab_pagacon."','".$doccab_cambio."','".$doccab_fpago."');";

//echo $ins_cabecera."<br>";
$rs_cabecera = $DB_gogess->executec($ins_cabecera,array());


$lista_precuentas="select * from dns_detalleprecuentaprincipal left join api_bodega on dns_detalleprecuentaprincipal.bodega_id=api_bodega.bode_id  where precu_id='".$precu_id."'";
$rs_lprecuentas = $DB_gogess->executec($lista_precuentas,array());
if($rs_lprecuentas)
 {

	  while (!$rs_lprecuentas->EOF) {  
	  
	  $docdet_codprincipal=$rs_lprecuentas->fields["detapre_codigop"];
	  $docdet_codaux='';
	  $docdet_cantidad=$rs_lprecuentas->fields["detapre_cantidad"];
	  $docdet_descripcion=$rs_lprecuentas->fields["detapre_detalle"];
	  $docdet_detallea='';
	  $docdet_detalleb='';
	  $docdet_detallec='';
	  $docdet_preciou=$rs_lprecuentas->fields["detapre_precio"];
	  $impu_codigo=2;
	  $tari_codigo=0;
	  $docdet_porcentaje=0;
	  $docdet_valorimpuesto=0;
	  $docdet_descuento=0;
	  $docdet_porcent_descuento=0;
	  $docdet_descuento_general=0;	  
	  $total_valor=$docdet_cantidad*$docdet_preciou;	  
	  $docdet_total=$total_valor;
	  $usua_id=$_SESSION['ces1313777_sessid_inicio'];
	  $eteneva_id=0;
	  $terap_id=0;
	  $atenc_hc=0;
	  $docdet_codigoterapeutas='';
	  $docdet_nombreterapeutas='';
	  $usuaat_id=0;
	  $prof_id=0;
	    
	 $lista_us="INSERT INTO beko_documentodetalle (doccab_id, docdet_codprincipal, docdet_codaux, docdet_cantidad, docdet_descripcion, docdet_detallea, docdet_detalleb, docdet_detallec, docdet_preciou, impu_codigo, tari_codigo, docdet_porcentaje, docdet_valorimpuesto, docdet_descuento, docdet_porcent_descuento, docdet_descuento_general, docdet_total, usua_id, eteneva_id, terap_id, atenc_hc, docdet_codigoterapeutas, docdet_nombreterapeutas, usuaat_id, prof_id) VALUES
('".$doccab_id."','".$docdet_codprincipal."','".$docdet_codaux."','".$docdet_cantidad."','".$docdet_descripcion."','".$docdet_detallea."','".$docdet_detalleb."','".$docdet_detallec."','".$docdet_preciou."','".$impu_codigo."','".$tari_codigo."','".$docdet_porcentaje."','".$docdet_valorimpuesto."','".$docdet_descuento."','".$docdet_porcent_descuento."','".$docdet_descuento_general."','".$docdet_total."','".$usua_id."','".$eteneva_id."','".$terap_id."','".$atenc_hc."','".$docdet_codigoterapeutas."','".$docdet_nombreterapeutas."','".$usuaat_id."','".$prof_id."');";

    //echo $lista_us."<br>";

$rs_uslista = $DB_gogess->executec($lista_us,array());



	  
	    $rs_lprecuentas->MoveNext();	
	  }
 }	  


}
?>