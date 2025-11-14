<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
ini_set('memory_limit', '-1');
$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");
include ("lib/nusoap.php");
$fechahoy=date("Y-m-d");

//phpinfo();

$DB_gogess_int = NewADOConnection('mysqli');
$DB_gogess_int->Connect("localhost","root", "79Drodri$", "publicador");

function leer_xmlpj_v2($xml)
{
   //$struct = new SimpleXMLElement($xml);
        //Extraer xml embebido
		//print_r($struct->soap:Envelope);
 $struct_detail = new SimpleXMLElement($xml);
//print_r($struct_detail);
 
 


$estadoautoriacion=$struct_detail->estado->__toString();
$nautorizacion=$struct_detail->numeroAutorizacion->__toString();
$fechaautorizacion=$struct_detail->fechaAutorizacion->__toString();
$ambienteautorizacion=$struct_detail->ambiente->__toString();
$comprobante=$struct_detail->comprobante->__toString();

$datosrr=leercampos_xmlx($comprobante);


$clavedeacceso=$datosrr["claveAcceso"];

$valores_generados=$clavedeacceso."|".$estadoautoriacion."|".$nautorizacion."|".$fechaautorizacion."|".$ambienteautorizacion;

//echo $valores_generados;
       //$xmlstr_detail=$struct->comprobante;	
	$res_lectura[0]= $valores_generados; 
	$res_lectura[1]=$struct_detail->comprobante->__toString();
	$res_lectura[2]=$clavedeacceso;
	if($ambienteautorizacion=='PRUEBAS')
	{
		$res_lectura[3]=1;
	}
	else
	{
		
		$res_lectura[3]=2;
	}
	
	   return $res_lectura;

	
}


function leercampos_xmlx($xml)
	{
	  //echo $xml;
	  $struct_detail = new SimpleXMLElement($xml);

       $datosrr["ambiente"] = $struct_detail->infoTributaria->ambiente->__toString();
	   $datosrr["claveAcceso"] = $struct_detail->infoTributaria->claveAcceso->__toString();
	    $datosrr["ruc"] = $struct_detail->infoTributaria->ruc->__toString();
	   $datosrr["tipoEmision"] = $struct_detail->infoTributaria->tipoEmision->__toString();
	   $datosrr["codDoc"] =$struct_detail->infoTributaria->codDoc->__toString();
	   
	   
	   
	   
	  if($datosrr["codDoc"]=='01')
	  {
      $datosrr["nombrerazon_cliente"] = $struct_detail->infoFactura->razonSocialComprador->__toString();
	  $datosrr["rucci_cliente"] = $struct_detail->infoFactura->identificacionComprador->__toString();
	  $datosrr["direccion_cliente"] = $struct_detail->infoFactura->dirEstablecimiento->__toString();	 
      }
	  
	   
	  if($datosrr["codDoc"]=='03')
	  {
      $datosrr["nombrerazon_cliente"] = $struct_detail->infoLiquidacionCompra->razonSocialProveedor->__toString();
	  $datosrr["rucci_cliente"] = $struct_detail->infoLiquidacionCompra->identificacionProveedor->__toString();
	  $datosrr["direccion_cliente"] = $struct_detail->infoLiquidacionCompra->direccionProveedor->__toString();
	 
      }
	  
	   if($datosrr["codDoc"]=='04')
	  {
      $datosrr["nombrerazon_cliente"] = $struct_detail->infoNotaCredito->razonSocialComprador->__toString();
	  $datosrr["rucci_cliente"] = $struct_detail->infoNotaCredito->identificacionComprador->__toString();
	  $datosrr["direccion_cliente"] = $struct_detail->infoNotaCredito->dirEstablecimiento->__toString();
	
      }
	 
	  
	  
	  if($datosrr["codDoc"]=='05')
	  {
      $datosrr["nombrerazon_cliente"] = $struct_detail->infoNotaDebito->razonSocialComprador->__toString();
	  $datosrr["rucci_cliente"] = $struct_detail->infoNotaDebito->identificacionComprador->__toString();
	  $datosrr["direccion_cliente"] = $struct_detail->infoNotaDebito->dirEstablecimiento->__toString();

      }
	  
	  
	  if($datosrr["codDoc"]=='07')
	  {
      $datosrr["nombrerazon_cliente"] = $struct_detail->infoCompRetencion->razonSocialSujetoRetenido->__toString();
	  $datosrr["rucci_cliente"] = $struct_detail->infoCompRetencion->identificacionSujetoRetenido->__toString();
	 // $datosrr["comcab_direccion_cliente"] = $struct_detail->infoCompRetencion->dirEstablecimiento->__toString();
	
      }
	   
	   if($datosrr["codDoc"]=='06')
	  {
      $datosrr["nombrerazon_cliente"] = $struct_detail->destinatarios->destinatario->razonSocialDestinatario__toString();
	  $datosrr["rucci_cliente"] = $struct_detail->destinatarios->destinatario->identificacionDestinatario->__toString();
	  $datosrr["direccion_cliente"] = $struct_detail->infoGuiaRemision->dirEstablecimiento->__toString();

      }
	  
	   
	  
	   return $datosrr;
}



$factura=array();
//PUBLICA FACTURA
$buscafacturas="select * from beko_documentocabecera where doccab_estadosri IN ('AUTORIZADO') and doccab_publicado not in ('1')";
//echo $buscafacturas;
$rs_gogessform = $DB_gogess->executec($buscafacturas,array());
if($rs_gogessform)
{
     	while (!$rs_gogessform->EOF) {
		


$datosrr=leercampos_xmlx(base64_decode($rs_gogessform->fields["doccab_xmlfirmado"]));

//print_r($datosrr);
$comprovante_aut='<?xml version="1.0" encoding="UTF-8"?>
<autorizacion>
<estado>'.$rs_gogessform->fields["doccab_estadosri"].'</estado>
<numeroAutorizacion>'.$rs_gogessform->fields["doccab_nautorizacion"].'</numeroAutorizacion>
<fechaAutorizacion>'.$rs_gogessform->fields["doccab_fechaaut"].'</fechaAutorizacion>
<ambiente>'.$datosrr["ambiente"].'</ambiente>
<comprobante><![CDATA[';

$comprovante_autpie=']]></comprobante>
<mensajes/>
</autorizacion>';

$completo=$comprovante_aut.base64_decode($rs_gogessform->fields["doccab_xmlfirmado"]).$comprovante_autpie;
		
$res_lectura=leer_xmlpj_v2($completo);	

//print_r($res_lectura);  
$factura['xml']=base64_encode ($res_lectura[1]);
$factura['coop']=$datosrr["ruc"];
$factura['acceso']=$res_lectura[2];;
$factura['ruccli']="";
$factura['amb_val']=$res_lectura[3];
$factura['path_firma']="";
$factura['clave_firma']="";
$factura['quiere_firma']="";
$factura['txt_linea']='';
$factura['solo_publicar']='1';
$factura['data_publicar']=$res_lectura[0];
		
		

		
		print_r($factura);
		
		$resultado=publicar_interno($factura,$DB_gogess_int);

    //$cliente = new nusoap_client('http://181.112.155.5/publicador/gogess/wspublicar/server.php?wsdl');
    //$resultado = $cliente->call('ValidarSri', array('factura' =>$factura));
	
	//$error = $cliente->getError();
	//print_r($error); 
	
	echo "Resultado".$resultado["estado"]."<br>";
	if ($resultado["estado"]=='FACTURA YA ESTA PUBLICADA' or   $resultado["estado"]=='FACTURA PUBLICADA')
	{
	    $actualizacomp="update beko_documentocabecera set  doccab_publicado=1 where doccab_id='".$rs_gogessform->fields["doccab_id"]."'";
	     $okv=$DB_gogess->executec($actualizacomp,array());
	}
     
		
		
		$rs_gogessform->MoveNext();	
		}
}
	

function regitra_cliente($cedruc,$xml,$DB_gogess_int)
	{
	    $fechahoyva=date("Y-m-d H:i:s");  
		 if(strlen($cedruc)>10)
		  {
			 if(strlen($cedruc)==13)
			{
			   $buscaced=substr($cedruc,0,-3);
			}
			else
			{
			  $buscaced=$cedruc;
			}
		  }
		  else
		  {
			 $buscaced=$cedruc;
		  }
	    $busca_siexiste="select * from control_cliente where usr_cedula like '".$buscaced."%'";
		$rs_busca_cli = $DB_gogess_int->Execute($busca_siexiste); 
		if(!($rs_busca_cli->fields["usr_cedula"]))
		{
		  $datosbxml=leer_xml_infodoc($xml);
		  $inserta_cliente="
INSERT INTO control_cliente (usr_cedula, usr_nombre, usr_username, usr_clave, usr_direccion, usr_activo, usr_fecha_alta, usr_fecha_uingreso, usr_fecha_cambioclv, guia_codes, usr_email) VALUES
('".$datosbxml["comcab_rucci_cliente"]."', '".$datosbxml["comcab_nombrerazon_cliente"]."', '".$datosbxml["comcab_rucci_cliente"]."', '".md5($datosbxml["comcab_rucci_cliente"])."','".$datosbxml["comcab_direccion_cliente"]."', '1', '". $fechahoyva."', '', '0000-00-00', '', '');
";
         $okcli=$DB_gogess_int->Execute($inserta_cliente); 
		 if($okcli)
		 {
		   $insertapermiso="INSERT INTO ecofac_usuarios_perfil (usr_cedula, perusu_codobj, perusu_activo, perusu_maker, perusu_checker, perusu_consulta, perusu_desactivar) VALUES ( '".$datosbxml["comcab_rucci_cliente"]."', 14, '1', '0', '0', '1', '0'),( '".$datosbxml["comcab_rucci_cliente"]."', 13, '1', '0', '0', '1', '0');";
		   $okpermi=$DB_gogess_int->Execute($insertapermiso); 
		   
		   //guardar_log('2',$inserta_cliente,'GUARDADO EXITO','','','','','','','','','','',$DB_gogess);
		   
		 }
		 else
		 {
		  //guardar_log('2',$inserta_cliente,'ERROR GUARDADO CONECCION','','','','','','','','','','',$DB_gogess);
		 }
		 
          
		}
	
	}
	


function publicar_interno($factura,$DB_gogess_int)
{


//===============================================

        $buscafactura="select * from ws_facturas where wsfac_claveacceso='".$factura['acceso']."'";
		$rs_busca = $DB_gogess_int->Execute($buscafactura); 
		
		//$file = fopen("archivo.txt", "w");
       // fwrite($file, $buscafactura . PHP_EOL);
       // fwrite($file, "Otra más" . PHP_EOL);
       // fclose($file);
		
		if($rs_busca->fields["wsfac_claveacceso"])
		{
			
			
			return array(
			'motivo' => 'EXITO',
			'estado' => 'FACTURA YA ESTA PUBLICADA',
			'nauto' => '',
			'fauto' => '',
			'fformat' => '',
			'xmlresp' => ''
		    );
		}
		else
		{
			$datosxml=leer_xml_infodoc($factura['xml']);
			
			$datapl=explode("|",$factura['data_publicar']);
			
			
			$fechaformatea=explode("T",$datapl[3]);
			$nuevafecha=explode("-",$fechaformatea[0]);
			$horatime=explode(".",$fechaformatea[1]);
			$fechaenvio=$nuevafecha[0]."-".$nuevafecha[1]."-".$nuevafecha[2]." ".$horatime[0];
			
			$guardafactura="insert into ws_facturas (wsfac_factura,wsfac_claveacceso,wsfac_idcop,wsfac_ruccliente,wsfac_ambiente,wsfac_nfactura,wsfac_tipocomp,wsfac_fechautformato,wsfac_estado,wsfac_fechaaut,wsfac_nautorizacion)values('".$factura['xml']."','".$factura['acceso']."','".$factura['coop']."','".$datosxml['comcab_rucci_cliente']."','".$factura['amb_val']."','".$datosxml["estab"]."-".$datosxml["ptoEmi"]."-".$datosxml["comcab_nfactura"]."','".$datosxml["comcab_codDoc"]."','".$fechaenvio."','".$datapl[1]."','".$datapl[3]."','".$datapl[2]."')";		
		
	    $rs_ok = $DB_gogess_int->Execute($guardafactura);
		if($rs_ok)
		{
			//registra_cliente
		    regitra_cliente($datosxml['comcab_rucci_cliente'],$factura['xml'],$DB_gogess_int);
		    //registra cliente
			
			return array(
			'motivo' => 'EXITO',
			'estado' => 'FACTURA PUBLICADA',
			'nauto' => '',
			'fauto' => '',
			'fformat' => '',
			'xmlresp' => ''
		    );
		}
		else
		{
		return array(
			'motivo' => 'ERROR',
			'estado' => 'PROBLEMA DE CONECCION',
			'nauto' => '',
			'fauto' => '',
			'fformat' => '',
			'xmlresp' => ''
		    );	
			
		}
			
			
			
		}

//===============================================

}


function leer_xml_infodoc($xml)
	{
	  $deco_xml=base64_decode($xml);
	  $struct_detail = new SimpleXMLElement($deco_xml);

	  $datosrr["comcab_nfactura"] = $struct_detail->infoTributaria->secuencial->__toString();
	  $datosrr["comcab_codDoc"] = $struct_detail->infoTributaria->codDoc->__toString();
	  
	  if($datosrr["comcab_codDoc"]=='01')
	  {
      $datosrr["comcab_nombrerazon_cliente"] = $struct_detail->infoFactura->razonSocialComprador->__toString();
	  $datosrr["comcab_rucci_cliente"] = $struct_detail->infoFactura->identificacionComprador->__toString();
	  $datosrr["comcab_direccion_cliente"] = $struct_detail->infoFactura->dirEstablecimiento->__toString();
	  $datosrr["estab"] = $struct_detail->infoTributaria->estab->__toString();
	  $datosrr["ptoEmi"] = $struct_detail->infoTributaria->ptoEmi->__toString();
	  $datosrr["ambiente"] = $struct_detail->infoTributaria->ambiente->__toString();
      }
	  
	  if($datosrr["comcab_codDoc"]=='03')
	  {
      $datosrr["comcab_nombrerazon_cliente"] = $struct_detail->infoLiquidacionCompra->razonSocialProveedor->__toString();
	  $datosrr["comcab_rucci_cliente"] = $struct_detail->infoLiquidacionCompra->identificacionProveedor->__toString();
	  $datosrr["comcab_direccion_cliente"] = $struct_detail->infoLiquidacionCompra->direccionProveedor->__toString();
	  $datosrr["estab"] = $struct_detail->infoTributaria->estab->__toString();
	  $datosrr["ptoEmi"] = $struct_detail->infoTributaria->ptoEmi->__toString();
	  $datosrr["ambiente"] = $struct_detail->infoTributaria->ambiente->__toString();
      }
	  
	   if($datosrr["comcab_codDoc"]=='04')
	  {
      $datosrr["comcab_nombrerazon_cliente"] = $struct_detail->infoNotaCredito->razonSocialComprador->__toString();
	  $datosrr["comcab_rucci_cliente"] = $struct_detail->infoNotaCredito->identificacionComprador->__toString();
	  $datosrr["comcab_direccion_cliente"] = $struct_detail->infoNotaCredito->dirEstablecimiento->__toString();
	  $datosrr["estab"] = $struct_detail->infoTributaria->estab->__toString();
	  $datosrr["ptoEmi"] = $struct_detail->infoTributaria->ptoEmi->__toString();
	  $datosrr["ambiente"] = $struct_detail->infoTributaria->ambiente->__toString();
      }
	 
	  
	  
	  if($datosrr["comcab_codDoc"]=='05')
	  {
      $datosrr["comcab_nombrerazon_cliente"] = $struct_detail->infoNotaDebito->razonSocialComprador->__toString();
	  $datosrr["comcab_rucci_cliente"] = $struct_detail->infoNotaDebito->identificacionComprador->__toString();
	  $datosrr["comcab_direccion_cliente"] = $struct_detail->infoNotaDebito->dirEstablecimiento->__toString();
	  $datosrr["estab"] = $struct_detail->infoTributaria->estab->__toString();
	  $datosrr["ptoEmi"] = $struct_detail->infoTributaria->ptoEmi->__toString();
	  $datosrr["ambiente"] = $struct_detail->infoTributaria->ambiente->__toString();
      }
	  
	   if($datosrr["comcab_codDoc"]=='06')
	  {
      $datosrr["comcab_nombrerazon_cliente"] = $struct_detail->destinatarios->destinatario->razonSocialDestinatario->__toString();
	  $datosrr["comcab_rucci_cliente"] = $struct_detail->destinatarios->destinatario->identificacionDestinatario->__toString();
	  
	  $datosrr["estab"] = $struct_detail->infoTributaria->estab->__toString();
	  $datosrr["ptoEmi"] = $struct_detail->infoTributaria->ptoEmi->__toString();
	  $datosrr["ambiente"] = $struct_detail->infoTributaria->ambiente->__toString();
      }
	  
	  
	  if($datosrr["comcab_codDoc"]=='07')
	  {
      $datosrr["comcab_nombrerazon_cliente"] = $struct_detail->infoCompRetencion->razonSocialSujetoRetenido->__toString();
	  $datosrr["comcab_rucci_cliente"] = $struct_detail->infoCompRetencion->identificacionSujetoRetenido->__toString();
	 // $datosrr["comcab_direccion_cliente"] = $struct_detail->infoCompRetencion->dirEstablecimiento->__toString();
	  $datosrr["estab"] = $struct_detail->infoTributaria->estab->__toString();
	  $datosrr["ptoEmi"] = $struct_detail->infoTributaria->ptoEmi->__toString();
	  $datosrr["ambiente"] = $struct_detail->infoTributaria->ambiente->__toString();
      }
	  
	  
	   return $datosrr;
	}
	
?>