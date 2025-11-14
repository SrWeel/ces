<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
include('codebarra/Barcode.php');

$objformulario= new  ValidacionesFormulario();

include("lib_general.php");
include("lib.php");

$compra_id=$_POST["compra_id"];
$fecha_emisionret=$_POST["fecha_emisionret"];
$compretcab_codsustento=$_POST["compretcab_codsustento"];

$actualizar=$_POST["actualizar"];

$busca_compra="select * from dns_compras left join dns_tipodocumentogeneral on dns_compras.tipdoc_id=dns_tipodocumentogeneral.tipdoc_id where compra_id='".$compra_id."'";
$rs_compra = $DB_gogess->executec($busca_compra);

$tipdoc_codigo=$rs_compra->fields["tipdoc_codigo"];
$compra_nfactura=$rs_compra->fields["compra_nfactura"];
$compra_fecha=$rs_compra->fields["compra_fecha"];
$proveevar_id=$rs_compra->fields["proveevar_id"];

$compra_subtotaliva=$rs_compra->fields["compra_subtotaliva"];
$compra_subtotalceroiva=$rs_compra->fields["compra_subtotalceroiva"];
$compra_total=$rs_compra->fields["compra_total"];

$compra_enlace=$rs_compra->fields["compra_enlace"];
$compra_iva=$rs_compra->fields["compra_iva"];

//busca proveedor
$b_pr="select * from app_proveedor where provee_id='".$proveevar_id."'";
$rsbpr = $DB_gogess->executec($b_pr);
$provee_nombre=$rsbpr->fields["provee_nombre"];
$tipoident_codigocl=$rsbpr->fields["tipoident_codigocl"];
if($tipoident_codigocl=='04')
{
$provee_ruc=$rsbpr->fields["provee_ruc"];
}
else
{
$provee_ruc=$rsbpr->fields["provee_cedula"];
}
$provee_direccion=$rsbpr->fields["provee_direccion"];
$provee_telefono=$rsbpr->fields["provee_telefono"];
$provee_email=$rsbpr->fields["provee_email"];
//busca proveedor

$datos_empresa="select * from app_empresa where emp_id=1";
$rs_empresa = $DB_gogess->executec($datos_empresa);



$datos_empresasql="select * from app_empresa left join efacsistema_cfgempresa on app_empresa.emp_id=efacsistema_cfgempresa.emp_id where app_empresa.emp_id=1";
$rs_empresa = $DB_gogess->executec($datos_empresasql,array());
if($rs_empresa)
{
	while (!$rs_empresa->EOF) {
	
	   $emp_id_val=$rs_empresa->fields["emp_id"];
	   
	  $emp_nombre=$rs_empresa->fields["emp_nombre"];
	  $datos_empresadata["emp_nombre"]=$rs_empresa->fields["emp_nombre"];
	  $emp_ruc=$rs_empresa->fields["emp_ruc"];
	  $datos_empresadata["emp_ruc"]=$rs_empresa->fields["emp_ruc"];
	  $emp_direccion=$rs_empresa->fields["emp_direccion"];
	  $datos_empresadata["emp_direccion"]=$rs_empresa->fields["emp_direccion"];
							  
	  
	  $emp_ambiente=$ambiente_valor;
	  $datos_empresadata["emp_ambiente"]=$rs_empresa->fields["ambi_valor"];								  
	  $datos_empresadata["emp_emision"]=$rs_empresa->fields["tipoemi_codigo"];
	  
	  $emp_especial=$rs_empresa->fields["cgfe_especial"];
	  $datos_empresadata["emp_especial"]=$rs_empresa->fields["cgfe_especial"];
	  
	  if($rs_empresa->fields["cgfe_contabilidad"]=='SI')
	  {
	  $emp_contabilidad='SI';
	  }
	  else
	  {
	  $emp_contabilidad='NO';
	  }
	  
	  $datos_empresadata["emp_contabilidad"]=$emp_contabilidad;
	 
	 $rs_empresa->MoveNext();
	}	
}

$busca_autorizada1="select * from comprobante_retencion_cab where compretcab_estadosri in ('AUTORIZADO','RECIBIDA') and compretcab_anulado!='1' and compra_id='".$compra_id."'";
$rsburet_auto = $DB_gogess->executec($busca_autorizada1);

if($rsburet_auto->fields["compretcab_id"]!='')
{
   echo "Retenci&oacute;n ya fue autorizada";

}
else
{
///no autorizado===============================


$busca_retencion="select * from comprobante_retencion_cab where (compretcab_anulado='' or compretcab_anulado='0') and  compra_id='".$compra_id."'";
$rsburet = $DB_gogess->executec($busca_retencion);
if($rsburet->fields["compretcab_id"]!='')
{
 
  if($actualizar==0)
  {  
   echo "Retencion ya esta generada";
  }
  else
  {
     //actualiza retencion
	 
	 
	 
unset($cabecera);
unset($detalle);
$cabecera = array();
$detalle = array();
$nvlretencion=$rsburet->fields["compretcab_nretencion"];
$aletorioid=$rsburet->fields["compretcab_id"];
$iddocumento='';
$iddocumento=trim($compra_id);
$cabecera[$iddocumento]["compretcab_id"]=$aletorioid;
$compretcab_id=$aletorioid;
$cabecera[$iddocumento]["emp_id"]=$emp_id_val;
$cabecera[$iddocumento]["compretcab_nfactura"]=str_replace("-","",$compra_nfactura);
$cabecera[$iddocumento]["compretcab_nfacturafecha"]=$compra_fecha;
$cabecera[$iddocumento]["compretcab_nretencion"]=$nvlretencion;
$cabecera[$iddocumento]["compretcab_guiaremision"]='';
$cabecera[$iddocumento]["compretcab_rucempresa"]=$emp_ruc;
$cabecera[$iddocumento]["compretcab_nombrerazon_cliente"]=$provee_nombre;
$cabecera[$iddocumento]["compretcab_rucci_cliente"]=$provee_ruc;
$cabecera[$iddocumento]["compretcab_direccion_cliente"]=$provee_direccion;
$cabecera[$iddocumento]["compretcab_telefono_cliente"]=$provee_telefono;
$cabecera[$iddocumento]["compretcab_email_cliente"]=$provee_email;
$cabecera[$iddocumento]["compretcab_fechaemision_cliente"]=$fecha_emisionret;
$cabecera[$iddocumento]["compretcab_coddocsustento"]=$tipdoc_codigo;
$cabecera[$iddocumento]["compretcab_subtotal"]=0;
$cabecera[$iddocumento]["compretcab_iva"]=0;
$cabecera[$iddocumento]["compretcab_total"]=0;
$cabecera[$iddocumento]["compretcab_ice"]=0;
$cabecera[$iddocumento]["compretcab_descuento"]=0;
$cabecera[$iddocumento]["compretcab_propina"]=0;
$cabecera[$iddocumento]["compretcab_estado"]=0;
$cabecera[$iddocumento]["compretcab_offline"]=1; 
$cabecera[$iddocumento]["compretcab_usuarioacepto"]='';
$cabecera[$iddocumento]["usua_id"]=$_SESSION['ces1313777_sessid_inicio'];
$cabecera[$iddocumento]["compretcab_tipocomprobante"]='07';

//CREA CLAVE DE ACCESO
$tipoemi_codigo=1;
$ambi_valor=2;
$tipocx=$cabecera[$iddocumento]["compretcab_tipocomprobante"];
$solofecha_clv=explode("-",$cabecera[$iddocumento]["compretcab_fechaemision_cliente"]);
$claveacc=$solofecha_clv[2].$solofecha_clv[1].$solofecha_clv[0].$tipocx.$emp_ruc.$ambi_valor.str_replace("-","",$nvlretencion);
$codigoclv8=trim($cabecera[$iddocumento]["compretcab_rucci_cliente"]);
$numocho_dig=substr($codigoclv8, -8);	
$numerogenerado=$claveacc.$numocho_dig.$tipoemi_codigo;
echo $numerovalidador=agregar_dv($numerogenerado);
$clavegenerada=$claveacc.$numocho_dig.$tipoemi_codigo.$numerovalidador;	

$cabecera[$iddocumento]["compretcab_clavedeaccesos"]=$clavegenerada;
$cabecera[$iddocumento]["compretcab_verificador"]='';
$cabecera[$iddocumento]["compretcab_rucfactoring"]='';
$cabecera[$iddocumento]["compretcab_fechafactoring"]='';
$cabecera[$iddocumento]["lote_id"]=1;
$cabecera[$iddocumento]["compretcab_sriemitido"]='';
$cabecera[$iddocumento]["compretcab_autorizacion"]='';
$cabecera[$iddocumento]["compretcab_origen"]='RETENCION-AUTOMATICO';
$cabecera[$iddocumento]["compretcab_paracheker"]='2';
$cabecera[$iddocumento]["compretcab_moneda"]='DOLAR';
$cabecera[$iddocumento]["compretcab_usuarioactiva"]='';
$cabecera[$iddocumento]["compretcab_fechaactiva"]='';
$cabecera[$iddocumento]["compretcab_motivo"]='';
$cabecera[$iddocumento]["tipodoc_codigo"]=$tipoident_codigocl;
$cabecera[$iddocumento]["compretcab_estadosri"]='';
$cabecera[$iddocumento]["compretcab_motivodev"]='';
$cabecera[$iddocumento]["compretcab_nautorizacion"]='';
$cabecera[$iddocumento]["compretcab_fechaaut"]='';
$cabecera[$iddocumento]["compretcab_firmado"]='';
$cabecera[$iddocumento]["compretcab_fechacheker"]='';
$cabecera[$iddocumento]["compretcab_archivo"]='';
$cabecera[$iddocumento]["compretcab_accesolote"]='';
$cabecera[$iddocumento]["compretcab_adicional1"]='';
$cabecera[$iddocumento]["compretcab_adicional2"]='';
$cabecera[$iddocumento]["compretcab_adicional3"]='';
$cabecera[$iddocumento]["compretcab_codsustento"]=$compretcab_codsustento;
$cabecera[$iddocumento]["compretcab_numsustento"]=str_replace("-","",$compra_nfactura);
$cabecera[$iddocumento]["compretcab_totalsinimpuesto"]=$compra_subtotaliva+$compra_subtotalceroiva;
$cabecera[$iddocumento]["compretcab_importetotal"]=$compra_total;
$compra_subtotaliva=$rs_compra->fields["compra_subtotaliva"];
$compra_subtotalceroiva=$rs_compra->fields["compra_subtotalceroiva"];

$lista_v='';

if($rs_compra->fields["compra_fecha"]>='2024-04-01')
{

if($compra_subtotaliva>0)
{
$lista_v.='2|15|'.$compra_subtotaliva.'|'.$compra_iva.'-';
}

}
else
{

if($compra_subtotaliva>0)
{
$lista_v.='2|12|'.$compra_subtotaliva.'|'.$compra_iva.'-';
}

}

if($compra_subtotalceroiva>0)
{
$lista_v.='2|0|'.$compra_subtotalceroiva.'|0-';
}

$cabecera[$iddocumento]["compretcab_listaimpuestos"]=$lista_v;
$resultado_insertado=0;
if($cabecera[$iddocumento]["compretcab_id"]!='')
		{
		                              
		$resultado_insertado=actualizar_retencion($aletorioid,$emp_ruc,$ifactura,$cabecera[$iddocumento],$detalle[$iddocumento],$DB_gogess);
		unset($cabecera);
		unset($detalle);
		$cabecera = array();
		$detalle = array();	
		
		if($resultado_insertado==1)
		{
		   $vacia_data="update comprobante_retencion_detalle set  compretcab_id='".$aletorioid."' where compra_enlace='".$compra_enlace."'";
           $rsvdata = $DB_gogess->executec($vacia_data,array());		   
		   $vacia_data="update comprobante_retencion_cab set  compra_id='".$compra_id."' where 	compretcab_id='".$aletorioid."'";
           $rsvdata = $DB_gogess->executec($vacia_data,array()); 		   
		}
								
		}

    lista_retencion($compretcab_id,$auto_id,$datosfirma,$DB_gogess);
	 
	 
	 
	 
	 
     //actualiza retencion
  }
  
}
else
{

unset($cabecera);
unset($detalle);
$cabecera = array();
$detalle = array();
echo $nvlretencion=numero_secuencialretenciones($DB_gogess);
$valoralet=mt_rand(1,500);
$aletorioid=$emp_ruc.uniqid().date("YmdHis");
$iddocumento='';
$iddocumento=trim($compra_id);
$cabecera[$iddocumento]["compretcab_id"]=$aletorioid;
$compretcab_id=$aletorioid;
$cabecera[$iddocumento]["emp_id"]=$emp_id_val;
$cabecera[$iddocumento]["compretcab_nfactura"]=str_replace("-","",$compra_nfactura);
$cabecera[$iddocumento]["compretcab_nfacturafecha"]=$compra_fecha;
$cabecera[$iddocumento]["compretcab_nretencion"]=$nvlretencion;
$cabecera[$iddocumento]["compretcab_guiaremision"]='';
$cabecera[$iddocumento]["compretcab_rucempresa"]=$emp_ruc;
$cabecera[$iddocumento]["compretcab_nombrerazon_cliente"]=$provee_nombre;
$cabecera[$iddocumento]["compretcab_rucci_cliente"]=$provee_ruc;
$cabecera[$iddocumento]["compretcab_direccion_cliente"]=$provee_direccion;
$cabecera[$iddocumento]["compretcab_telefono_cliente"]=$provee_telefono;
$cabecera[$iddocumento]["compretcab_email_cliente"]=$provee_email;
$cabecera[$iddocumento]["compretcab_fechaemision_cliente"]=$fecha_emisionret;
$cabecera[$iddocumento]["compretcab_coddocsustento"]=$tipdoc_codigo;
$cabecera[$iddocumento]["compretcab_subtotal"]=0;
$cabecera[$iddocumento]["compretcab_iva"]=0;
$cabecera[$iddocumento]["compretcab_total"]=0;
$cabecera[$iddocumento]["compretcab_ice"]=0;
$cabecera[$iddocumento]["compretcab_descuento"]=0;
$cabecera[$iddocumento]["compretcab_propina"]=0;
$cabecera[$iddocumento]["compretcab_estado"]=0;
$cabecera[$iddocumento]["compretcab_offline"]=1; 
$cabecera[$iddocumento]["compretcab_usuarioacepto"]='';
$cabecera[$iddocumento]["usua_id"]=$_SESSION['ces1313777_sessid_inicio'];
$cabecera[$iddocumento]["compretcab_tipocomprobante"]='07';


$tipoemi_codigo=1;
$ambi_valor=2;
//CREA CLAVE DE ACCESO
$tipocx=$cabecera[$iddocumento]["compretcab_tipocomprobante"];
$solofecha_clv=explode("-",$cabecera[$iddocumento]["compretcab_fechaemision_cliente"]);
$claveacc=$solofecha_clv[2].$solofecha_clv[1].$solofecha_clv[0].$tipocx.$emp_ruc.$ambi_valor.str_replace("-","",$nvlretencion);
$codigoclv8=trim($cabecera[$iddocumento]["compretcab_rucci_cliente"]);
$numocho_dig=substr($codigoclv8, -8);	
$numerogenerado=$claveacc.$numocho_dig.$tipoemi_codigo;
echo $numerovalidador=agregar_dv($numerogenerado);
$clavegenerada=$claveacc.$numocho_dig.$tipoemi_codigo.$numerovalidador;	

$cabecera[$iddocumento]["compretcab_clavedeaccesos"]=$clavegenerada;
$cabecera[$iddocumento]["compretcab_verificador"]='';
$cabecera[$iddocumento]["compretcab_rucfactoring"]='';
$cabecera[$iddocumento]["compretcab_fechafactoring"]='';
$cabecera[$iddocumento]["lote_id"]=1;
$cabecera[$iddocumento]["compretcab_sriemitido"]='';
$cabecera[$iddocumento]["compretcab_autorizacion"]='';
$cabecera[$iddocumento]["compretcab_origen"]='RETENCION-AUTOMATICO';
$cabecera[$iddocumento]["compretcab_paracheker"]='2';
$cabecera[$iddocumento]["compretcab_moneda"]='DOLAR';
$cabecera[$iddocumento]["compretcab_usuarioactiva"]='';
$cabecera[$iddocumento]["compretcab_fechaactiva"]='';
$cabecera[$iddocumento]["compretcab_motivo"]='';
$cabecera[$iddocumento]["tipodoc_codigo"]=$tipoident_codigocl;
$cabecera[$iddocumento]["compretcab_estadosri"]='';
$cabecera[$iddocumento]["compretcab_motivodev"]='';
$cabecera[$iddocumento]["compretcab_nautorizacion"]='';
$cabecera[$iddocumento]["compretcab_fechaaut"]='';
$cabecera[$iddocumento]["compretcab_firmado"]='';
$cabecera[$iddocumento]["compretcab_fechacheker"]='';
$cabecera[$iddocumento]["compretcab_archivo"]='';
$cabecera[$iddocumento]["compretcab_accesolote"]='';
$cabecera[$iddocumento]["compretcab_adicional1"]='';
$cabecera[$iddocumento]["compretcab_adicional2"]='';
$cabecera[$iddocumento]["compretcab_adicional3"]='';
$cabecera[$iddocumento]["compretcab_codsustento"]=$compretcab_codsustento;
$cabecera[$iddocumento]["compretcab_numsustento"]=str_replace("-","",$compra_nfactura);
$cabecera[$iddocumento]["compretcab_totalsinimpuesto"]=$compra_subtotaliva+$compra_subtotalceroiva;
$cabecera[$iddocumento]["compretcab_importetotal"]=$compra_total;
$compra_subtotaliva=$rs_compra->fields["compra_subtotaliva"];
$compra_subtotalceroiva=$rs_compra->fields["compra_subtotalceroiva"];

$lista_v='';
if($rs_compra->fields["compra_fecha"]>='2024-04-01')
{

if($compra_subtotaliva>0)
{
$lista_v.='2|15|'.$compra_subtotaliva.'|'.$compra_iva.'-';
}

}
else
{

if($compra_subtotaliva>0)
{
$lista_v.='2|12|'.$compra_subtotaliva.'|'.$compra_iva.'-';
}

}

if($compra_subtotalceroiva>0)
{
$lista_v.='2|0|'.$compra_subtotalceroiva.'|0-';
}

$cabecera[$iddocumento]["compretcab_listaimpuestos"]=$lista_v;
$resultado_insertado=0;
if($cabecera[$iddocumento]["compretcab_id"]!='')
		{
		
		$resultado_insertado=insertadatos_retencion($emp_ruc,$ifactura,$cabecera[$iddocumento],$detalle[$iddocumento],$DB_gogess);
		unset($cabecera);
		unset($detalle);
		$cabecera = array();
		$detalle = array();	
		
		if($resultado_insertado==1)
		{
		   $vacia_data="update comprobante_retencion_detalle set  compretcab_id='".$aletorioid."' where compra_enlace='".$compra_enlace."'";
           $rsvdata = $DB_gogess->executec($vacia_data,array());		   
		   $vacia_data="update comprobante_retencion_cab set  compra_id='".$compra_id."' where 	compretcab_id='".$aletorioid."'";
           $rsvdata = $DB_gogess->executec($vacia_data,array()); 		   
		}
								
		}

    lista_retencion($compretcab_id,$auto_id,$datosfirma,$DB_gogess);
	
}


///no autorizado===============================
}



              /*   
				 
				  
				  
				 
				  
				
				  
				  
				
				//cabecera valor
				//detalles retencion
				$dt=0;
				 $sacadetalles="select distinct * from temporal_temporalcargarret where  (tmpcarga_enlace='".$rs_ldocumento->fields["tmpcarga_enlace"]."') and emp_id=".$emp_id_val;
					$resultdetalle = $DB_gogess->Execute($sacadetalles);
					//echo  $sacadetalles."<br>";
					if($resultdetalle)
					{   
						while (!$resultdetalle->EOF) {
				   
				   
				   
						$detalle[$iddocumento][$dt]["compretcab_id"]=$aletorioid;
						$detalle[$iddocumento][$dt]["compretdet_ejerfiscal"]=$resultdetalle->fields["tmpcarga_inofiscal"];
						$detalle[$iddocumento][$dt]["compretdet_baseimponible"]=$resultdetalle->fields["tmpcarga_basimponible"];
						$detalle[$iddocumento][$dt]["impur_id"]=$resultdetalle->fields["tmpcarga_tipoimp"];
						
						//$sacaid="select * from gogess_porcentajesrenta where porcentaje_codigo='".trim($resultdetalle->fields["tmpcarga_codretencion"])."'";
						//$codeporcent=$DB_gogess->Execute($sacaid);
						
					
						//$detalle[$iddocumento][$dt]["porcentaje_id"]=$resultdetalle->fields["tmpcarga_codretencion"];
						$codigoret=0;
						$codigoret=$resultdetalle->fields["tmpcarga_codretencion"]*1;
						if($codigoret==524)
						{
							$codigoret=351;
						}
						
						$detalle[$iddocumento][$dt]["porcentaje_id"]=$codigoret;
						
						
						
						$detalle[$iddocumento][$dt]["compretdet_porcentaje"]=$resultdetalle->fields["tmpcarga_xreten"];
						$detalle[$iddocumento][$dt]["compretdet_valorretenido"]=$resultdetalle->fields["tmpcarga_valorreten"];
					$detalle[$iddocumento][$dt]["compretdet_adicional1"]=$resultdetalle->fields["tmpcarga_desreten"];
						$detalle[$iddocumento][$dt]["usua_id"]=0;
						$detalle[$iddocumento][$dt]["compretdet_archivo"]=$narchivo;
						$detalle[$iddocumento][$dt]["compretdet_accesolote"]='';
						///$detalle[$iddocumento][$dt]["compretdet_adicional1"]='';
						
						$dt++;
				  
				   
						 $resultdetalle->MoveNext();
						}
					    $numfacreg++;
					}	
				
				//detalles retencion
				//guarda retencion
				 $resultado_insertado=0;
				 if(count($detalle[$iddocumento])>0)
							{
								//print_r($cabecera);
							//	print_r($detalle);
						    $resultado_insertado=insertadatos_retencion($rucempresa,$ifactura,$cabecera[$iddocumento],$detalle[$iddocumento],$DB_gogess);
							unset($cabecera);
							unset($detalle);
							$cabecera = array();
							$detalle = array();
							
							}

*/

?>