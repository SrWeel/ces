<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
//include("adodb/adodb.inc.php");
//include("cfgclases/config.php");
//include("lib.php");
//include("lib_retencion.php");
//include ("libreria/nusoap/lib/nusoap.php"); 
require_once("c:/xampp/htdocs/JavaBridge/java/Java.inc");
$fechahoy=date("Y-m-d");
//datos de firma

$busca_conf="select * from gogess_automatico where auto_id=1";
							
							$rs_conf= $DB_gogess->Execute($busca_conf);
							if($rs_conf)
							{ 	
								
								$id_empresa_val=$rs_conf->fields["emp_id"];
							    $tipodocumento=$rs_conf->fields["tipocmp_codigo"];
								$cedulafirma=$rs_conf->fields["auto_cedulafirma"];
								
							
							}
							
						   $datosfirma=datos_firmar($cedulafirma,$DB_gogess);

//datos de firma


$emp_id_valor=$id_empresa_val;

//------------------------------

 $datos_empresasql="select * from factura_empresa where emp_id=".$emp_id_valor;
						   $rs_empresa = $DB_gogess->Execute($datos_empresasql);
						   if($rs_empresa)
						   {
								while (!$rs_empresa->EOF) {
								
								  $emp_nombre=$rs_empresa->fields["emp_nombre"];
								  $datos_empresadata["emp_nombre"]=$rs_empresa->fields["emp_nombre"];
								  
								  $emp_ruc=$rs_empresa->fields["emp_ruc"];
								  $datos_empresadata["emp_ruc"]=$rs_empresa->fields["emp_ruc"];
								  
								  $emp_direccion=$rs_empresa->fields["emp_direccion"];
								  $datos_empresadata["emp_direccion"]=$rs_empresa->fields["emp_direccion"];
								  
								  $emp_ambiente=$rs_empresa->fields["emp_ambiente"];
								  $datos_empresadata["emp_ambiente"]=$rs_empresa->fields["emp_ambiente"];
								  
								  $emp_emision=$rs_empresa->fields["emp_emision"];
								  $datos_empresadata["emp_emision"]=$rs_empresa->fields["emp_emision"];
								  
								  $emp_especial=$rs_empresa->fields["emp_especial"];
								  $datos_empresadata["emp_especial"]=$rs_empresa->fields["emp_especial"];
								  
								  if($rs_empresa->fields["emp_contabilidad"]==1)
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

//------------------------------
 $buscafacsinxml="select * from comprobante_retencion_cab where not(compretcab_firmado='SI') and not(compretcab_estadosri='AUTORIZADO') and emp_id=".$emp_id_valor;
  $rs_lista = $DB_gogess->Execute($buscafacsinxml);
				if($rs_lista)
				{   
				   while (!$rs_lista->EOF) {	
				   
				  
				   
				   firmando($datosfirma,$emp_id_valor,'07',$rs_lista->fields["compretcab_id"],$DB_gogess);
				 
				   
				    $rs_lista->MoveNext();
				   }
				}   
echo "Firmado con exito...";				
?>